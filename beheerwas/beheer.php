<?php
include_once('../config.php');
include_once('../class/c_user.php');


/************************
 * Toegangsbeveiliging: alleen ingelogde gebruikers
 ************************/
if (!isset($_SESSION['username'])) {
	header('Location: ../index.php');
	exit();
}

// Huidige gebruiker initialiseren
$curr_user = isset($_SESSION['userid'])
	? new User('id', $_SESSION['userid'])
	: new User();

// Sessievariabelen resetten
unset($_SESSION['jobgroup_id'], $_SESSION['maatje_id']);
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.php'); ?>				
		<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css">
		<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
	</head>
	<body style="background-color: #dddddd;">
		
		<div class="container">
			<?php include('../includes/navbar.php'); ?>
		</div>
		<div class="container"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white pt-2">
				<h1 class="mx-auto">WAS MENU</h1>
			</div>
		</div>
        <div class="container">
			<!-- <div class="row mt-4">
				<p>Maak je keuze ....</p>
			</div> -->
            <div class="row mt-4">
				<div class="col-md-4 p-0 text-center">
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="overz_werkzoekenden.php">Werkzoekenden</a></button>
					<!-- <button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="overz_wkz_vrjrdgn.php">Verjaardagen werkzoekenden</a></button> -->
					<!-- <button type="button" class="btn btn-primary my-2" style="width: 300px;"><a class="text-white" href="intake.php">Intakeformulier</a></button> -->
	            </div>
				<div class="col-md-4 p-0 text-center">
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="overz_jobgroups.php">Jobgroups</a></button>
					<!-- <button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="mut_jobgroup.php">Nieuwe jobgroup</a></button> -->
				</div>

				<div class="col-md-4 p-0 text-center">
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="overz_maatjes.php">Maatjes</a></button>
				</div>
            </div>
        </div>
        <div class="container">
			<div class="row">
			</div>
		</div>
		<div>
		</div>
		<?php include('../includes/footer.php'); ?>
	</body>
</html>
