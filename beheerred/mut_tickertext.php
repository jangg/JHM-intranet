<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_keyrecord.php');

/* Toegangsbeveiliging */
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
	exit();
}

/* Huidige gebruiker ophalen */
if (isset($_SESSION['userid'])) {
	$curr_user = new User('id', $_SESSION['userid']);
} else {
	$curr_user = new User();
	$curr_user->id = '1';
}

/* Terug-knop */
if (isset($_POST['backMtBut']) && $_POST['backMtBut'] == 'back') {
	header("location: beheer.php");
	exit();
}

/* Huidige waarden ophalen uit DB */
$tickerpublInd = Keyrecord::fromSleutel($connection, 'tickerpublInd');
$tickertext1   = Keyrecord::fromSleutel($connection, 'tickertext1');
$tickertext2   = Keyrecord::fromSleutel($connection, 'tickertext2');
$tickertext3   = Keyrecord::fromSleutel($connection, 'tickertext3');

/* Wijzigen */
if (isset($_POST['updateMtBut']) && $_POST['updateMtBut'] == 'wijzig') {

	/* publInd: checkbox geeft 'j' als aangevinkt, anders niet aanwezig in POST */
	$tickerpublInd_nw = clone $tickerpublInd;
	$tickerpublInd_nw->setWaarde(isset($_POST['publInd']) ? 'j' : 'n');

	$tickertext1_nw = clone $tickertext1;
	$tickertext1_nw->setWaarde(trim(htmlspecialchars($_POST['tickertext1'] ?? '', ENT_QUOTES, 'UTF-8')));

	$tickertext2_nw = clone $tickertext2;
	$tickertext2_nw->setWaarde(trim(htmlspecialchars($_POST['tickertext2'] ?? '', ENT_QUOTES, 'UTF-8')));

	$tickertext3_nw = clone $tickertext3;
	$tickertext3_nw->setWaarde(trim(htmlspecialchars($_POST['tickertext3'] ?? '', ENT_QUOTES, 'UTF-8')));

	/* Opslaan als gewijzigd */
	if ($tickerpublInd_nw->getWaarde() != $tickerpublInd->getWaarde()) {
		if ($tickerpublInd_nw->getId() !== null) {
			$tickerpublInd_nw->updateToDB();
		} else {
			$tickerpublInd_nw->saveToDB();
		}
	}

	if ($tickertext1_nw->getWaarde() != $tickertext1->getWaarde()) {
		if ($tickertext1_nw->getId() !== null) {
			$tickertext1_nw->updateToDB();
		} else {
			$tickertext1_nw->saveToDB();
		}
	}

	if ($tickertext2_nw->getWaarde() != $tickertext2->getWaarde()) {
		if ($tickertext2_nw->getId() !== null) {
			$tickertext2_nw->updateToDB();
		} else {
			$tickertext2_nw->saveToDB();
		}
	}

	if ($tickertext3_nw->getWaarde() != $tickertext3->getWaarde()) {
		if ($tickertext3_nw->getId() !== null) {
			$tickertext3_nw->updateToDB();
		} else {
			$tickertext3_nw->saveToDB();
		}
	}

	/* Herlaad pagina om dubbele submit te voorkomen */
	header("location: mut_tickertext.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.php'); ?>
	<style>
		span {
			overflow-wrap: break-word;
		}
	</style>
	</head>
	<body style="background-color: #dddddd;">

		<div class="container">
			<?php include('../includes/navbar.php'); ?>
		</div>

		<div class="container" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto">Ticker tekst op voorpagina van de Publieke website</h1>
				<h4 class="mx-auto">Max. 3 teksten van max. 120 tekens.</h4>
			</div>
		</div>

		<div class="container" style="padding-bottom: 80px;">
			<form method="POST" action="mut_tickertext.php" id="tickermt" novalidate>
				<div class="row">
					<div class="col-md-12 bg-light mt-2 pt-2">

						<!-- Publiceren -->
						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class="input-group-text" style="width: 100%;">Publiceren?</span>
							</div>
							<input type="checkbox"
								   name="publInd"
								   id="publInd"
								   class="form-control"
								   value="j"
								   style="margin-left: 15px;"
								   <?php if ($tickerpublInd && $tickerpublInd->getWaarde() == 'j') echo 'checked'; ?>>
						</div>

						<!-- Tekst 1 -->
						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class="input-group-text" style="width: 100%;">Tekst 1 (max. 60 char)</span>
							</div>
							<input type="text"
								   name="tickertext1"
								   class="form-control"
								   maxlength="120"
								   value="<?php echo htmlspecialchars($tickertext1->getWaarde(), ENT_QUOTES, 'UTF-8'); ?>">
						</div>

						<!-- Tekst 2 -->
						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class="input-group-text" style="width: 100%;">Tekst 2 (max. 60 char)</span>
							</div>
							<input type="text"
								   name="tickertext2"
								   class="form-control"
								   maxlength="120"
								   value="<?php echo htmlspecialchars($tickertext2->getWaarde(), ENT_QUOTES, 'UTF-8'); ?>">
						</div>

						<!-- Tekst 3 -->
						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class="input-group-text" style="width: 100%;">Tekst 3 (max. 60 char)</span>
							</div>
							<input type="text"
								   name="tickertext3"
								   class="form-control"
								   maxlength="120"
								   value="<?php echo htmlspecialchars($tickertext3->getWaarde(), ENT_QUOTES, 'UTF-8'); ?>">
						</div>

						<!-- Knoppen -->
						<div class="forms-group mb-1">
							<button name="updateMtBut" value="wijzig" type="submit" class="btn btn-primary btn-width btn-sm">Wijzig</button>
							<button name="backMtBut"   value="back"   type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button>
						</div>

					</div>
				</div>
			</form>
		</div>

		<?php include('../includes/footer.php'); ?>
	</body>
</html>
