<?php
include_once "../config.php";
include_once "../class/c_user.php";
include_once "../class/c_werkzoekende_coll.php";
include_once "../class/c_maatje.php";
include_once "../class/c_jobgroup.php";

// ── Sessiebeveiliging ────────────────────────────────────────────────────────
if (!isset($_SESSION["username"])) {
	header("Location: ../index.php");
	exit();
}

// ── Huidige gebruiker ────────────────────────────────────────────────────────
$curr_user = isset($_SESSION["userid"])
	? new User("id", (int) $_SESSION["userid"])
	: new User();

// ── Werkzoekende soft-delete (delind = 'j') ──────────────────────────────────
if (filter_input(INPUT_GET, 'del') === 'j') {
	$del_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
	if ($del_id !== false && $del_id > 0) {
		$item = new Werkzoekende('id', $del_id);
		if ($item->delind !== 'j') {
			$item->delind = 'j';
			$item->updateToDB();
		}
	}
}

// ── Selectie (POST heeft prioriteit, daarna sessie, daarna default 'act') ────
if (isset($_POST["selection"])) {
	$_SESSION["selection"] = $_POST["selection"];
} else {
	$_SESSION["selection"] ??= "act";   // ??= nieuw in PHP 7.4
}
$selection = $_SESSION["selection"];

// ── Data ophalen ─────────────────────────────────────────────────────────────
$wzColl = new Werkzoekende_coll([], [[0 => "werkzkd.status", 1 => "ASC"]]);

// Helper: HTML-escaping (arrow function, nieuw in PHP 7.4)
$esc = fn(?string $val): string => htmlspecialchars($val ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

$html = "";
$nbr  = 0;

foreach ($wzColl->werkzoekendeColl as $werkzoekende) {

	// ── Filteren op selectie ─────────────────────────────────────────────────
	$ok = true;
	switch ($selection) {
		case 'new':
			$ok = ($werkzoekende->status === '000');
			break;
		case 'act':
			// Actief = status t/m '599'
			$ok = ($werkzoekende->status <= '599');
			break;
		case 'non':
			// Niet-actief = status '600' en hoger
			$ok = ($werkzoekende->status >= '600');
			break;
		// 'all': $ok blijft true
	}

	if (!$ok) {
		continue;
	}

	$nbr++;

	// ── Gebruiker die het record het laatste heeft gewijzigd ─────────────────
	$user_modified = ($werkzoekende->id_user_modified !== '')
		? new User("id", $werkzoekende->id_user_modified)
		: new User();

	// ── Acties opbouwen ──────────────────────────────────────────────────────
	$wzId   = (int) $werkzoekende->id;
	$acties = '';

	// Gebruikersicoon: solid = verwerkt, regular = nieuw (status 000)
	$userIconType = ($werkzoekende->status !== '000') ? 'fa-solid' : 'fa-regular';
	$acties .= '<a href="mut_persoon.php?id=' . $wzId . '">'
			 . '<i class="' . $userIconType . ' fa-user"></i></a>&nbsp;&nbsp;&nbsp;';

	// Intakeformulier-icoon: solid = ingevuld, regular = nog niet ingevuld
	$fileIconType = ($werkzoekende->id_intakeform !== NULL) ? 'fa-solid' : 'fa-regular';
	$acties .= '<a href="intake.php?id=' . $wzId . '">' . '<i class="' . $fileIconType . ' fa-file-lines"></i></a>&nbsp;&nbsp;&nbsp;';
	// $acties .= '<i class="' . $fileIconType . ' fa-file-lines"></i>&nbsp;&nbsp;&nbsp;';

	// E-mailicoon (onzichtbaar als e-mailadres ontbreekt, voor uitlijning)
	if ($werkzoekende->emailadres !== '') {
		$acties .= '<a href="mailto:' . $esc($werkzoekende->emailadres) . '">'
				 . '<i class="fa-regular fa-envelope"></i></a>&nbsp;&nbsp;&nbsp;';
	} else {
		$acties .= '<i class="fa-regular fa-envelope" style="opacity: 0;"></i>&nbsp;&nbsp;&nbsp;';
	}

	// Verwijderactie met bevestiging
	$acties .= '<a href="overz_werkzoekenden.php?id=' . $wzId . '&amp;del=j"'
			 . ' onclick="return confirm(\'Weet je zeker dat je deze werkzoekende wilt verwijderen?\');">'
			 . '<i class="fa-regular fa-trash-can"></i></a>&nbsp;&nbsp;&nbsp;';

	// ── Maatje-naam (trim om dubbele spaties bij leeg tussenvoegsels te vermijden) ──
	if ($werkzoekende->id_maatje !== '') {
		$mtj    = new Maatje("id", $werkzoekende->id_maatje);
		$maatje = trim(preg_replace(
			'/\s+/',
			' ',
			$mtj->voornaam . ' ' . $mtj->tussenvoegsels . ' ' . $mtj->achternaam
		));
	} else {
		$maatje = '';
	}

	// ── Jobgroup-titel ───────────────────────────────────────────────────────
	if ($werkzoekende->id_jobgroup !== '') {
		$jgp      = new Jobgroup("id", $werkzoekende->id_jobgroup);
		$jobgroup = $jgp->titel;
	} else {
		$jobgroup = '';
	}

	// ── Rijkleur voor nieuwe aanmeldingen ────────────────────────────────────
	// Bugfix: origineel had een extra ; na het sluitende aanhalingsteken
	$trstyle = ($werkzoekende->status === '000')
		? 'style="background-color: #ffbbb9;"'
		: '';

	// ── Volledige naam (achternaam, voornaam tussenvoegsels) ─────────────────
	$voornaamDeel = trim($werkzoekende->voornaam . ' ' . $werkzoekende->tussenvoegsels);
	$volnaam      = $werkzoekende->achternaam . ', ' . $voornaamDeel;

	// ── Tabelrij HTML ────────────────────────────────────────────────────────
	$html .= '<tr ' . $trstyle . '>
		<td class="text-center p-0">' . sprintf("%04d", $wzId) . '</td>
		<td class="text-center p-0">' . $esc($werkzoekende->status) . '</td>
		<td class="text-left p-0">'   . $esc(Tools::getStatusOms($werkzoekende->status)) . '</td>
		<td class="text-left p-0">'   . $esc($volnaam) . '</td>
		<td class="text-left p-0">'   . $esc($werkzoekende->emailadres) . '</td>
		<td class="text-left p-0">'   . $esc($werkzoekende->straat . ' ' . $werkzoekende->huisnummer) . '</td>
		<td class="text-left p-0">'   . $esc($werkzoekende->postcode . ' ' . $werkzoekende->woonplaats) . '</td>
		<td class="text-left p-0">'   . $esc($werkzoekende->date_geboorte) . '</td>
		<td class="text-left p-0">'   . $esc($werkzoekende->link_linkedin) . '</td>
		<td class="text-center p-0">' . $esc($werkzoekende->date_aanmelding) . '</td>
		<td class="text-center p-0">' . $esc($werkzoekende->date_uitstroom) . '</td>
		<td class="text-center p-0">' . $esc(substr($werkzoekende->datetime_created, 0, 10)) . '</td>
		<td class="text-center p-0">' . $esc(substr($werkzoekende->datetime_modified, 0, 10)) . '</td>
		<td class="text-center p-0">' . $esc(substr($user_modified->username, 0, 20)) . '</td>
		<td class="text-left p-0">'   . $esc($werkzoekende->telefoonnr) . '</td>
		<td class="text-left p-0">'   . $esc($maatje) . '</td>
		<td class="text-left p-0">'   . $esc($jobgroup) . '</td>
		<td class="text-center p-0 ifont">' . $acties . '</td>
	</tr>' . PHP_EOL;
}
?>
<!DOCTYPE html>
<html lang="nl-NL">
	<?php include "../includes/head.php"; ?>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.27.1/dist/bootstrap-table.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.27.1/dist/bootstrap-table.min.js"></script>
	<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.27.1/dist/extensions/export/bootstrap-table-export.min.js"></script>		
	<style>
		/* Buttons in cellen compacter */
		.fixed-table-container .table.table-sm td .btn {
			padding: .1rem .25rem;
			line-height: 1;
		}
		td {
			padding: .15rem .35rem;
			line-height: 1.3rem;
			font-size: .875rem;
			vertical-align: middle;
		}
		#toolbar {
			margin: 0;
		}
	</style>
	</head>
	<body style="background-color: #dddddd;">

		<div class="container">
			<?php include "../includes/navbar.php"; ?>
		</div>

		<div class="container-fluid" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto text-capitalize">Werkzoekenden</h1>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row mt-4">
				<div class="col-12">
					<div class="d-flex flex-wrap align-items-center gap-2">

						<!-- Navigatieknoppen links -->
						<div class="d-flex flex-wrap align-items-center gap-2">
							<a class="btn btn-primary mr-2" style="min-width:140px" href="beheer.php">Menu</a>
							<a class="btn btn-primary mr-2" style="min-width:140px" href="aanmelding_wkz.php">Nieuwe werkzkd</a>
							<a class="btn btn-primary mr-2" style="min-width:140px" href="photolib.php?q=wkz">Foto's</a>
							<a class="btn btn-primary mr-2" style="min-width:140px" href="overz_wkz_vrjrdgn.php">Verjaardagen</a>
						</div>

						<!-- Spacer -->
						<div class="flex-grow-1"></div>

						<!-- Selectie rechts -->
						<div class="d-flex align-items-center gap-2">
							<label for="sel1" class="mb-0">Toon</label>
							<form method="POST" action="overz_werkzoekenden.php" class="mb-0">
								<select name="selection" class="form-control" id="sel1"
										style="min-width:170px"
										onchange="this.form.submit()">
									<option value="act" <?php if ($selection === "act") echo "selected"; ?>>actieve werkzoekenden</option>
									<option value="non" <?php if ($selection === "non") echo "selected"; ?>>niet actieve werkzoekenden</option>
									<option value="all" <?php if ($selection === "all") echo "selected"; ?>>alle werkzoekenden</option>
								</select>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div id="toolbar" class="select">
						<select class="form-control">
							<option value="">Exporteer pagina</option>
							<option value="all">Exporteer alles</option>
						</select>
					</div>
					<table id="Thistable"
						   class="data-table table-sm table-striped table-hover"
						   data-toggle="table"
						   data-search="true"
						   data-pagination="true"
						   data-page-size="30"
						   data-page-list="20, 40, 60, 80, all"
						   data-show-columns="true"
						   data-show-columns-search="true"
						   data-cookie="true"
						   data-cookie-id-table="saveId"
						   data-show-export="true"
						   data-toolbar="#toolbar"
						   data-filter-control="true">
						<thead class="thead-dark">
							<tr>
								<th data-field="id"               data-sortable="true"  data-visible="false" class="text-center">id</th>
								<th data-field="statuscode"       data-sortable="true"  data-visible="true"  class="text-center">statuscode</th>
								<th data-field="status"           data-sortable="false" data-visible="false">status</th>
								<th data-field="naam"             data-sortable="true"  data-visible="true">naam</th>
								<th data-field="emailadres"       data-sortable="true"  data-visible="false">emailadres</th>
								<th data-field="straat"           data-sortable="false" data-visible="false">adres</th>
								<th data-field="plaats"           data-sortable="true"  data-visible="false">plaats</th>
								<th data-field="gebdatum"         data-sortable="true"  data-visible="false">geb.datum</th>
								<th data-field="linkedin"         data-sortable="true"  data-visible="false">LinkedIn</th>
								<th data-field="date_aanmelding"  data-sortable="true"  data-visible="true">datum aanmelding</th>
								<th data-field="date_uitstroom"   data-sortable="true"  data-visible="false">datum uitstroom</th>
								<th data-field="datetime_created" data-sortable="true"  data-visible="false">datum gemaakt</th>
								<th data-field="datetime_modified" data-sortable="true" data-visible="true">datum gewijzigd</th>
								<th data-field="user_modified"    data-sortable="true"  data-visible="true">gewijzigd door</th>
								<th data-field="telefoonnr"       data-sortable="false" data-visible="false">telefoonnr</th>
								<th data-field="maatje"           data-sortable="true"  data-visible="true">maatje</th>
								<th data-field="jobgroup"         data-sortable="true"  data-visible="true">jobgroup</th>
								<th data-field="acties"           data-sortable="false" data-visible="true">acties</th>
							</tr>
						</thead>
						<tbody>
							<?php echo $html; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<?php include "../includes/footer.php"; ?>

	</body>
<script>
	$(document).ready(function () {
		var $table  = $('#Thistable');
		var sortKey = 'wz_overzicht_sort';
		var pageKey = 'wz_overzicht_page';
	
		// Exporttype instellen
		$('#toolbar').find('select').change(function () {
			$table.bootstrapTable('refreshOptions', {
				exportDataType: $(this).val(),
				exportTypes: ['csv', 'txt', 'excel', 'pdf']
			});
		}).trigger('change');
	
		// Sortering opslaan en terugzetten
		$table.on('sort.bs.table', function (e, name, order) {
			localStorage.setItem(sortKey, JSON.stringify({ name: name, order: order }));
		});
		var savedSort = JSON.parse(localStorage.getItem(sortKey) || 'null');
		if (savedSort) {
			$table.bootstrapTable('refreshOptions', {
				sortName:  savedSort.name,
				sortOrder: savedSort.order
			});
		}
	
		// Pagina opslaan en terugzetten
		$table.on('page-change.bs.table', function (e, number, size) {
			localStorage.setItem(pageKey, JSON.stringify({ number: number, size: size }));
		});
		var savedPage = JSON.parse(localStorage.getItem(pageKey) || 'null');
		if (savedPage) {
			$table.bootstrapTable('refreshOptions', {
				pageNumber: savedPage.number,
				pageSize:   savedPage.size
			});
		}
	});
</script>
</html>
