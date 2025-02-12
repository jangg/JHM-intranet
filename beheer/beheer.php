<?php
include_once('../config.php');
include_once('../class/c_user.php');


/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
	exit();
}
/**********************/

if (isset($_SESSION['userid']))
{
	$curr_user = new User ('id', $_SESSION['userid']);
} else
{
	$curr_user = new User ();
}

/* initieer jobgroup en maatje */
unset($_SESSION['jobgroup_id']);
unset($_SESSION['maatje_id']);

?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>				
		<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css">
		<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
	</head>
	<body style="background-color: #dddddd;">
		
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white pt-2">
				<h1 class="mx-auto">MENU</h1>
			</div>
			<div class="row header rounded text-white pb-2">
				<h1 class="mx-auto">JHM Zoetermeer doet de WAS</h1>
			</div>
		</div>
        <div class="container">
			<!-- <div class="row mt-4">
				<p>Maak je keuze ....</p>
			</div> -->
            <div class="row mt-4">
				<div class="col-md-4 p-0 text-center">
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="overz_werkzoekenden.php">Overzicht werkzoekenden</a></button>
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="aanmelding_wkz.php">Nieuwe werkzoekende</a></button>
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="overz_wkz_vrjrdgn.php">Verjaardagen werkzoekenden</a></button>
					<!-- <button type="button" class="btn btn-primary my-2" style="width: 300px;"><a class="text-white" href="intake.php">Intakeformulier</a></button> -->
	            </div>
				<div class="col-md-4 p-0 text-center">
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="overz_jobgroups.php">Overzicht jobgroups</a></button>
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="mut_jobgroup.php">Nieuwe jobgroup</a></button>
					<!-- <button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="mut_jobgroup.php">Nieuwe jobgroup</a></button> -->
				</div>

				<div class="col-md-4 p-0 text-center">
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="overz_maatjes.php">Overzicht maatjes</a></button>
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="aanmelding_mtj.php">Nieuw maatje</a></button>
				</div>
            </div>
			<hr>
			<div class="row mt-4">
				<div class="col-md-4 p-0 text-center">
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="overz_newsitems.php">Overzicht nieuwsberichten</a></button>
					<button type="button" class="btn btn-primary my-2" style="width: 70%;"><a class="text-white" href="mut_newsitem.php">Nieuw nieuwsbericht</a></button>
				</div>
			</div>
        </div>
        <div class="container">
			<div class="row">
			</div>
		</div>
		<div>
		</div>
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
