<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/class/c_user_coll.php';
require_once __DIR__ . '/class/c_topic.php';
require_once __DIR__ . '/class/c_post.php';

/**
 * -------- FUNCTIES --------
 */

function validateArgs(array $argv): array
{
	global $argc;
	// $cmd = 'php -f ../mailroom.php ' . $this->id_topic . ' ' . $connection->lastInsertId() . ' ' . $this->id_user . ' > /dev/null &';
	// exec($cmd);
	if ($argc !== 4 || !is_numeric($argv[1]) || !is_numeric($argv[2]) || !is_numeric($argv[3])) {
		fwrite(STDERR, "Gebruik: php -f mailroom.php <topic_id> <post_id> <user_id>  > /dev/null &\n");
		exit(1);
	}
	return [
		'topic_id' => (int)$argv[1],
		'post_id'  => (int)$argv[2],
		'user_id'  => (int)$argv[3],
	];
}

function logEmail(string $emailadres): void
{
	$timestamp = (new DateTime())->format('Y-m-d H:i:s.u e');
	$logtxt = sprintf("%s - e-mail verzonden naar %s\r\n", $timestamp, $emailadres);

	$logFile = __DIR__ . '/../logs/forum_emails.txt';
	if (!is_dir(dirname($logFile))) {
		mkdir(dirname($logFile), 0775, true);
	}

	file_put_contents($logFile, $logtxt, FILE_APPEND);
}

function getMsgTemplate(): string
{
	$templatePath = __DIR__ . '/mail_apps/JHMZforummsg.html';
	if (!file_exists($templatePath)) {
		fwrite(STDERR, "Fout: e-mailtemplate niet gevonden.\n");
		exit(1);
	}
	return file_get_contents($templatePath);
}

function buildForumMessage(string $template, Topic $topic, Post $post, string $userName): string
{
	// Post-tekst bevat al HTML; niet escapen
	$messageText = $post->tekst ?? '';
	$search = ['###message_topic###', '###message_text###', '###topic_id###', '###naam###', '###afzenderDomein###'];
	$replace = [
		$topic->onderwerp ?? '',
		$messageText,
		$topic->id ?? '',
		htmlspecialchars($userName),
		date('Y') . ' ' . LOC_NAME
	];
	return str_replace($search, $replace, $template);
}

function createMailer(): PHPMailer
{
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = MAIL_SMTP_SERVER;
	$mail->SMTPAuth = true;
	$mail->Username = MAIL_USERID;
	$mail->Password = MAIL_PASSWORD;
	$mail->SMTPSecure = MAIL_SMTPSECURE === 'tls' ? PHPMailer::ENCRYPTION_STARTTLS : PHPMailer::ENCRYPTION_SMTPS;
	$mail->Port = MAIL_SMTPSECURE === 'tls' ? 587 : 465;
	$mail->setFrom(MAIL_SENDEREMAIL, 'JobHulpMaatje Zoetermeer intranet forum');
	$mail->addReplyTo('no-reply@jhmz.nl', 'No Reply');
	$mail->isHTML(true);
	$mail->SMTPDebug = MAIL_DEBUG_IND ?? 0;

	return $mail;
}

/**
 * -------- SCRIPTSTART --------
 */

// $args = validateArgs($argv);
// 
// $topic = new Topic('id', $args['topic_id']);
// $post  = new Post('id', $args['post_id']);
// $userOfPost = new User('id', $args['user_id']);


$topic = new Topic('id', $_GET['id1']);
$post  = new Post('id', $_GET['id2']);
$userOfPost = new User('id', $_GET['id3']);

if (!$topic || !$post || !$userOfPost) {
	fwrite(STDERR, "Fout: onderwerp, post of gebruiker niet gevonden.\n");
	exit(1);
}

$userName = trim(sprintf(
	'%s %s %s',
	$userOfPost->voornaam,
	$userOfPost->tussenvoegsels,
	$userOfPost->achternaam
));

$template = getMsgTemplate();
$emailBody = buildForumMessage($template, $topic, $post, $userName);

$mailPrototype = createMailer();
$mailPrototype->Subject = $topic->onderwerp ?? '(zonder onderwerp)';

$users = new User_coll([['user.forumNoteInd', 't']], '');

foreach ($users->userColl as $user) {
	try {
		$mail = clone $mailPrototype;
		$mail->addAddress($user->emailadres);
		$mail->msgHTML($emailBody);
		
		// file_put_contents('/tmp/email_debug.html', $emailBody);
		
		$mail->send();
		logEmail($user->emailadres);
	} catch (Exception $e) {
		error_log("Fout bij verzenden e-mail aan {$user->emailadres}: " . $e->getMessage());
	}
	$mail->clearAddresses();
}

// echo "✅ E-mails verzonden.\n";
?>