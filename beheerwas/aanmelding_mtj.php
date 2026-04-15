<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_maatje.php');

function calculateAge(string $date): int
{
	return (new DateTime($date))->diff(new DateTime('today'))->y;
}

function redirect(string $url): void
{
	header("location: $url");
	exit();
}

function h(string $value): string
{
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

/************************
 * Sessiebeveiliging
 ************************/
if (!isset($_SESSION['username'])) {
	redirect('../index.php');
}

$curr_user = new User('id', $_SESSION['userid'] ?? '1');

if (isset($_POST['backMtBut']) && $_POST['backMtBut'] === 'back') {
	redirect('overz_maatjes.php');
}

$mtj = new Maatje();

if (isset($_POST['saveMtBut']) && $_POST['saveMtBut'] === 'bewaar') {

	$mtj->voornaam      = filter_input(INPUT_POST, 'voornaam',      FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
	$mtj->achternaam    = filter_input(INPUT_POST, 'achternaam',    FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
	$mtj->tussenvoegsels= filter_input(INPUT_POST, 'tussenvoegsels',FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
	$mtj->straat        = filter_input(INPUT_POST, 'straat',        FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
	$mtj->huisnummer    = filter_input(INPUT_POST, 'huisnummer',    FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
	$mtj->postcode      = filter_input(INPUT_POST, 'postcode',      FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
	$mtj->woonplaats    = filter_input(INPUT_POST, 'woonplaats',    FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
	$mtj->emailadres    = filter_input(INPUT_POST, 'emailadres',    FILTER_SANITIZE_EMAIL)         ?? '';
	$mtj->telefoonnr    = filter_input(INPUT_POST, 'telefoonnr',    FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
	$mtj->link_linkedin = filter_input(INPUT_POST, 'link_linkedin', FILTER_SANITIZE_URL)           ?? '';
	$mtj->omschrijving  = filter_input(INPUT_POST, 'omschrijving',  FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
	$mtj->functie       = filter_input(INPUT_POST, 'functie',       FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
	$mtj->type          = 'mtj';

	$dateInput = $_POST['date_geboorte'] ?? '';
	$mtj->date_geboorte = Tools::checkDate($dateInput, 'jjjj-mm-dd') ? $dateInput : null;

	$mtj->mtjcrt_ind = $_POST['mtjcrt_ind'] ?? 'n';
	$mtj->jglcrt_ind = $_POST['jglcrt_ind'] ?? 'n';

	// Actief als maatje
	if (isset($_POST['actiefmtj'])) {
		$mtj->actief_als = in_array($mtj->actief_als, ['B', 'K']) ? 'K' : 'A';
	} else {
		if ($mtj->actief_als === 'K')     $mtj->actief_als = 'B';
		elseif ($mtj->actief_als === 'A') $mtj->actief_als = '';
	}

	// Actief als jobgroupleider
	if (isset($_POST['actiefjgl'])) {
		$mtj->actief_als = in_array($mtj->actief_als, ['A', 'K']) ? 'K' : 'B';
	} else {
		if ($mtj->actief_als === 'K')     $mtj->actief_als = 'A';
		elseif ($mtj->actief_als === 'B') $mtj->actief_als = '';
	}

	if ($mtj->achternaam !== '' && $mtj->emailadres !== '') {
		$mtj->saveToDB();
	}

	redirect('overz_maatjes.php');
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.php'); ?>
	<script>
		$(document).ready(function () {

			$("#date_geboorte").datepicker({
				dateFormat: "yy-mm-dd",
				minDate: "1950-01-01",
				maxDate: "2004-12-31",
				changeMonth: true,
				changeYear: true,
			});
			$('div.ui-datepicker').css({ fontSize: '0.9em' });

			function toggleCheckbox(certId, activeId) {
				const certified = $(certId).prop("checked");
				$(activeId).attr("disabled", !certified);
				if (!certified) $(activeId).prop("checked", false);
			}

			toggleCheckbox("#mtjcrt_ind", "#actiefmtj");
			toggleCheckbox("#jglcrt_ind", "#actiefjgl");

			$("#mtjcrt_ind").on("click", function () {
				toggleCheckbox("#mtjcrt_ind", "#actiefmtj");
			});
			$("#jglcrt_ind").on("click", function () {
				toggleCheckbox("#jglcrt_ind", "#actiefjgl");
			});

			$("#saveMtBut").on("click", function (event) {
				if ($("#achternaam").val() === '') {
					event.preventDefault();
					alert("Achternaam is verplicht");
					$("#achternaam").focus();
				} else if ($("#emailadres").val() === '') {
					event.preventDefault();
					alert("Emailadres is verplicht");
					$("#emailadres").focus();
				}
			});
		});
	</script>
	</head>
	<body style="background-color: #dddddd;">

		<div class="container">
			<?php include('../includes/navbar.php'); ?>
		</div>

		<div class="container" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto">Aanmelding nieuw maatje</h1>
			</div>
		</div>

		<div class="container" style="padding-bottom: 80px;">
			<form method="POST" action="aanmelding_mtj.php" novalidate>
				<div class="row">
					<div class="col-12 bg-light mt-2 pt-2">

						<?php
						$fields = [
							['label' => 'Voornaam',      'name' => 'voornaam',      'type' => 'text',  'value' => $mtj->voornaam],
							['label' => 'Tussenvoegsels','name' => 'tussenvoegsels','type' => 'text',  'value' => $mtj->tussenvoegsels],
							['label' => 'Achternaam',    'name' => 'achternaam',    'type' => 'text',  'value' => $mtj->achternaam, 'id' => 'achternaam', 'required' => true],
							['label' => 'Emailadres',    'name' => 'emailadres',    'type' => 'email', 'value' => $mtj->emailadres, 'id' => 'emailadres'],
							['label' => 'Telefoonnummer','name' => 'telefoonnr',    'type' => 'text',  'value' => $mtj->telefoonnr, 'id' => 'telefoonnr'],
							['label' => 'URL LinkedIn',  'name' => 'link_linkedin', 'type' => 'text',  'value' => $mtj->link_linkedin],
							['label' => 'Straat',        'name' => 'straat',        'type' => 'text',  'value' => $mtj->straat],
							['label' => 'Huisnummer',    'name' => 'huisnummer',    'type' => 'text',  'value' => $mtj->huisnummer],
							['label' => 'Postcode',      'name' => 'postcode',      'type' => 'text',  'value' => $mtj->postcode],
							['label' => 'Woonplaats',    'name' => 'woonplaats',    'type' => 'text',  'value' => $mtj->woonplaats],
						];

						foreach ($fields as $field):
							$id       = $field['id'] ?? $field['name'];
							$required = !empty($field['required']) ? 'required' : '';
						?>
						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class="input-group-text" style="width: 100%;"><?= h($field['label']) ?></span>
							</div>
							<input type="<?= $field['type'] ?>" name="<?= $field['name'] ?>" id="<?= $id ?>"
								   class="form-control" value="<?= h($field['value']) ?>" <?= $required ?>>
						</div>
						<?php endforeach; ?>

						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class="input-group-text" style="width: 100%;">Geboortedatum</span>
							</div>
							<input type="text" name="date_geboorte" id="date_geboorte"
								   class="form-control" value="<?= h($mtj->date_geboorte ?? '') ?>"
								   placeholder="jjjj-mm-dd">
						</div>

						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class="input-group-text" style="width: 100%;">Leeftijd</span>
							</div>
							<input type="text" class="form-control"
								   value="<?= ($mtj->date_geboorte ?? '') !== '' ? calculateAge($mtj->date_geboorte) : '' ?>"
								   disabled>
						</div>

						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class="input-group-text" style="width: 100%;">Functie</span>
							</div>
							<textarea name="functie" rows="5" class="form-control"><?= h($mtj->functie) ?></textarea>
						</div>

						<?php
						$checkboxes = [
							['label' => 'Maatje certificaat behaald',        'name' => 'mtjcrt_ind', 'id' => 'mtjcrt_ind', 'checked' => $mtj->mtjcrt_ind === 'j'],
							['label' => 'Actief als maatje',                 'name' => 'actiefmtj',  'id' => 'actiefmtj',  'checked' => in_array($mtj->actief_als, ['A', 'K'])],
							['label' => 'Jobgroupleider certificaat behaald','name' => 'jglcrt_ind', 'id' => 'jglcrt_ind', 'checked' => $mtj->jglcrt_ind === 'j'],
							['label' => 'Actief als jobgroupleider',         'name' => 'actiefjgl',  'id' => 'actiefjgl',  'checked' => in_array($mtj->actief_als, ['B', 'K'])],
						];

						foreach ($checkboxes as $cb):
						?>
						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class="input-group-text text-left text-wrap" style="width: 100%;"><?= h($cb['label']) ?></span>
							</div>
							<input type="checkbox" name="<?= $cb['name'] ?>" id="<?= $cb['id'] ?>"
								   class="form-control" value="j" style="margin-left: 15px;"
								   <?= $cb['checked'] ? 'checked' : '' ?>>
						</div>
						<?php endforeach; ?>

						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class="input-group-text" style="width: 100%;">Notities</span>
							</div>
							<textarea name="omschrijving" rows="5" class="form-control"><?= h($mtj->omschrijving) ?></textarea>
						</div>

						<div class="forms-group mb-1">
							<?php if ($curr_user->beheerind > 6): ?>
								<button name="saveMtBut" id="saveMtBut" value="bewaar" type="submit"
										class="btn btn-primary btn-width btn-sm">Bewaar</button>
							<?php else: ?>
								<button id="saveMtBut" value="bewaar" class="btn btn-primary btn-width btn-sm" disabled>Bewaar</button>
							<?php endif; ?>
							<button name="backMtBut" value="back" type="submit"
									class="btn btn-secondary btn-width btn-sm">Terug</button>
						</div>

					</div>
				</div>
			</form>
		</div>

		<?php include('../includes/footer.php'); ?>
	</body>
</html>