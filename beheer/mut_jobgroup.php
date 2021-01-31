<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_jobgroup.php');
include_once('../class/c_maatje.php');
include_once('../class/c_werkzoekende_coll.php');

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
	$curr_user->id = '1';
}

if (isset($_GET['id']))
	$_SESSION['jobgroup_id'] = $_GET['id'];

if (isset($_POST['backJgBut']) && $_POST['backJgBut'] == 'back')
{
	header("location: overz_jobgroups.php");
	exit();	
}

$jgp = new Jobgroup ('id', $_SESSION['jobgroup_id']);

// $arr1 = a// rray (array (0 => 'werkzkd.id_maatje', 1 => $mtj->id));
// $arr2 = array (array (0 => 'person.achternaam', 1 => 'ASC'));
// $wkzList = new Werkzoekende_coll($arr1, $arr2);


if (isset($_POST['updateJgBut']) && $_POST['updateJgBut'] == 'wijzig')
{
	$jgp_nw = clone $jgp;
	$jgp_nw->titel				= $_POST['titel'];
	$jgp_nw->id_locatie			= $_POST['achternaam'];
	$jgp_nw->tussenvoegsels		= $_POST['id_locatie'];
	$jgp_nw->startdate			= $_POST['startdate'];
	$jgp_nw->soort				= $_POST['soort'];
	$jgp_nw->onlineInd			= $_POST['onlineInd'];
	$jgp_nw->nbrSessies			= $_POST['nbrSessies'];
	$jgp_nw->nbrPlaatsen		= $_POST['nbrPlaatsen'];
	
	if ($jgp_nw != $jgp)
	{
		$jgp_nw->updateToDB();
	} 
	/* start de page opnieuw om een tweede update te voorkomen */
	header("location: mut_jobgroup.php");
	exit();	
}

?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>				
	</head>
	<body style="background-color: #dddddd;">
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container-fluid"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto">Jobgroup gegevens</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
        <div class="container-fluid" style="padding-bottom: 80px;">	
			<form method="POST" action="mut_jobgroup.php" id="postmt" novalidate>
			<div class="row">
				<div class="col-md-6 bg-light mt-2 pt-2">
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Omschrijving</span>
						</div>
						<input type="text" name="titel" class="form-control" value="<?php echo $jgp->titel; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Soort training</span>
						</div>
						<select class="form-control"  name="soort" id="soort">
							<option value="" <?php if($jgp->soort == '') echo 'selected'; ?>>---</option>
							<option value="Algm" <?php if($jgp->soort == 'Algm') echo 'selected'; ?>>Algemeen</option>
							<option value="iWIN" <?php if($jgp->soort == 'iWIN') echo 'selected'; ?>>Ik Werk In Nederland</option>
							<option value="ZZP" <?php if($jgp->soort == 'ZZP') echo 'selected'; ?>>ZZP'ers</option>
						</select>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Online training</span>
						</div>
						<div class="pl-3 pt-1" style="font-size: .9em;">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="onlineInd" id="onlineInd" value="j" <?php if($jgp->onlineInd == 'j') echo ' checked'; ?>>
								<label class="form-check-label" for="onlineInd">&nbsp;Ja</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="onlineInd" id="onlineInd" value="n"<?php if($jgp->onlineInd == 'n') echo ' checked'; ?>>
								<label class="form-check-label" for="onlineInd">&nbsp;Nee</label>
							</div>
						</div>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Locatie</span>
						</div>
						<input type="text" name="locatie" class="form-control" value="<?php echo $jgp->locatie; ?>" required>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Startdatum</span>
						</div>
						<input type="text" name="startdate" class="form-control" value="<?php echo $jgp->startdate; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Aantal sessie</span>
						</div>
						<input type="text" name="nbrSessies" class="form-control" value="<?php echo $jgp->nbrSessies; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Aantal plaatsen</span>
						</div>
						<input type="text" name="nbrPlaatsen" class="form-control" value="<?php echo $jgp->nbrPlaatsen; ?>">
					</div>
					<div class="forms-group mb-1">
						<button name="updateJgBut" value="wijzig" type="submit" class="btn btn-primary btn-width btn-sm">Wijzig</button>
						<button name="backJgBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button>
					</div>
				</div>
				</form>
			</div>
		<!-- </form> -->
		</div>
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
