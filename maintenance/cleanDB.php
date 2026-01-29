<?php
/**
 * CRONjob: verwijder werkzoekenden (wkz) die gemarkeerd zijn voor verwijdering
 * Criteria:
 *   person.delind = 'j'
 *   AND person.type = 'wkz'
 *
 * Voor elke matchende werkzkd:
 *   - delete aantekening where id_werkzkd = werkzkd.id
 *   - delete processtap  where id_werkzkd = werkzkd.id
 *   - delete intakeform  where id_werkzkd = werkzkd.id
 *   - delete werkzkd
 *   - delete person
 *
 * Usage:
 *   php cron/cleanup_werkzkd.php                 (DRY-RUN)
 *   php cron/cleanup_werkzkd.php --execute      (Echt verwijderen)
 *   php cron/cleanup_werkzkd.php --execute --limit=50 --verbose
 */

declare(strict_types=1);

function getFlag(string $key): bool
{
	if (!isset($_GET[$key])) return false;
	$v = $_GET[$key];

	// ?flag (zonder waarde) of ?flag=1 => true
	if ($v === '' || $v === '1' || $v === 1 || $v === true) return true;

	// ?flag=0 of ?flag=false => false
	if ($v === '0' || $v === 0 || $v === false) return false;
	if (is_string($v) && strtolower($v) === 'false') return false;

	// alles anders: beschouw als true (bijv. "yes")
	return true;
}

function log_line(string $msg, string $logFile, bool $verbose = false): void {
	$line = sprintf("[%s] %s\n", date('Y-m-d H:i:s'), $msg);
	@file_put_contents($logFile, $line, FILE_APPEND);
	if ($verbose) echo $line;
}

function acquire_lock(string $lockFile) {
	$fh = @fopen($lockFile, 'c');
	if (!$fh) return false;
	if (!flock($fh, LOCK_EX | LOCK_NB)) return false;
	ftruncate($fh, 0);
	fwrite($fh, (string)getmypid());
	fflush($fh);
	return $fh; // handle open houden
}

// flags
$execute = getFlag('execute');
$dryRun  = getFlag('dry-run') || !$execute; // default: dry-run
$verbose = getFlag('verbose');

// limit
$limit = 500;
if (isset($_GET['limit']) && is_numeric($_GET['limit'])) {
	$limit = max(1, (int)$_GET['limit']);
}

// $config = require __DIR__ . '/../config/config.php';
$config = require 'config.php';
$logFile  = $config['log_file'];
$lockFile = $config['lock_file'];

$lockHandle = acquire_lock($lockFile);
if ($lockHandle === false) {
	echo 'geen LockHandle? Jammer. Einde oefening.<br/>';
	log_line("SKIP: lock not acquired (script draait al).", $logFile, $verbose);
	exit(0);
}

$totals = [
	'werkzkd'     => 0,
	'person'      => 0,
	'aantekening' => 0,
	'processtap'  => 0,
	'intakeform'  => 0,
];

try {
	log_line("START cleanup_werkzkd (dryRun=" . ($dryRun ? 'yes' : 'no') . ", limit={$limit})", $logFile, $verbose);

	$pdo = new PDO(
		$config['db']['dsn'],
		$config['db']['user'],
		$config['db']['pass'],
		$config['db']['options']
	);

	// 1) Kandidaten selecteren
	$sqlSelect = "
		SELECT
			w.id       AS werkzkd_id,
			w.id_person AS person_id
		FROM werkzkd w
		INNER JOIN person p ON p.person_id = w.id_person
		WHERE p.delind = 'j'
		  AND p.type   = 'wkz'
		ORDER BY w.id ASC
		LIMIT :lim
	";
	$stSelect = $pdo->prepare($sqlSelect);
	$stSelect->bindValue(':lim', $limit, PDO::PARAM_INT);
	$stSelect->execute();
	$rows = $stSelect->fetchAll();

	if (!$rows) {
		echo 'Geen records gevonden. Pech!<br/>';
		log_line("INFO: geen records gevonden om te verwijderen.", $logFile, $verbose);
		exit(0);
	}

	// Prepared deletes (snel + veilig)
	$stDelAant  = $pdo->prepare("DELETE FROM aantekening WHERE id_werkzkd = :wid");
	$stDelProc  = $pdo->prepare("DELETE FROM processtap  WHERE id_werkzkd = :wid");
	$stDelIntk  = $pdo->prepare("DELETE FROM intakeform  WHERE id_werkzkd = :wid");
	$stDelWkz   = $pdo->prepare("DELETE FROM werkzkd     WHERE id = :wid");
	$stDelPers  = $pdo->prepare("DELETE FROM person     WHERE person_id = :pid");

	echo 'Nu komt de loop<br/>';
	$n = 0;
	foreach ($rows as $r) {
		// $n++;
		// echo $n . ' werkzoekende gevonden<br/>';
		$wid = (int)$r['werkzkd_id'];
		$pid = (int)$r['person_id'];

		// Per werkzoekende in eigen transactie (veiliger, kortere locks)
		$pdo->beginTransaction();

		// Tel eerst (voor logging / dry-run rapportage)
		$cntA = (int)$pdo->query("SELECT COUNT(*) FROM aantekening WHERE id_werkzkd = {$wid}")->fetchColumn();
		$cntP = (int)$pdo->query("SELECT COUNT(*) FROM processtap  WHERE id_werkzkd = {$wid}")->fetchColumn();
		$cntI = (int)$pdo->query("SELECT COUNT(*) FROM intakeform  WHERE id_werkzkd = {$wid}")->fetchColumn();

		if ($dryRun) {
			log_line("DRY-RUN wid={$wid}, pid={$pid} => delete aantekening={$cntA}, processtap={$cntP}, intakeform={$cntI}, werkzkd=1, person=1",
				$logFile, $verbose);
			$pdo->rollBack();
			continue;
		}

		// Deletes in juiste volgorde (children -> parent)
		$stDelAant->execute([':wid' => $wid]); $totals['aantekening'] += $cntA;
		$stDelProc->execute([':wid' => $wid]); $totals['processtap']  += $cntP;
		$stDelIntk->execute([':wid' => $wid]); $totals['intakeform']  += $cntI;

		$stDelWkz->execute([':wid' => $wid]);  $totals['werkzkd']++;
		$stDelPers->execute([':pid' => $pid]); $totals['person']++;

		$pdo->commit();
		// echo 'records zijn verwijderd!<br/>';

		log_line("OK wid={$wid}, pid={$pid} verwijderd (aant={$cntA}, proc={$cntP}, intk={$cntI})", $logFile, $verbose);
	}

	if ($dryRun) {
		echo 'alle records zijn niet verwijderd want dry-run!!<br/>';

		log_line("DONE DRY-RUN: geen wijzigingen doorgevoerd.", $logFile, $verbose);
	} else {
		echo 'alle records zijn WEL verwijderd want execute!!<br/>';
		log_line(
			"DONE: verwijderd => werkzkd={$totals['werkzkd']}, person={$totals['person']}, aantekening={$totals['aantekening']}, processtap={$totals['processtap']}, intakeform={$totals['intakeform']}",
			$logFile,
			$verbose
		);
	}

	exit(0);

} catch (Throwable $e) {
	if (isset($pdo) && $pdo->inTransaction()) {
		$pdo->rollBack();
	}
	log_line("ERROR: " . $e->getMessage(), $logFile, true);
	exit(1);

} finally {
	if (is_resource($lockHandle)) {
		flock($lockHandle, LOCK_UN);
		fclose($lockHandle);
	}
}