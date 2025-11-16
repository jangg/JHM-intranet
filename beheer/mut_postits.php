<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_postit.php');

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


if (isset($_POST['backMtBut']) && $_POST['backMtBut'] == 'back')
{
	header("location: beheer.php");
	exit();	
}
$postitL = new Postit ('id', 1);
$postitR = new Postit ('id', 2);

if (isset($_POST['updateMtBut']) && $_POST['updateMtBut'] == 'wijzig')
{
	$postitL_nw = clone $postitL;
	if (isset($_POST['publIndL']))
		$postitL_nw->publInd = 'j';
		else
		$postitL_nw->publInd = NULL;
	if (Tools::checkDate($_POST['publDatumL'], 'jjjj-mm-dd') || $_POST['publDatumL'] == '')
		$postitL_nw->publDatum			= $_POST['publDatumL'];
	$postitL_nw->titel					= $_POST['titelL'];
	$postitL_nw->tekst					= $_POST['tekstL'];
	$postitL_nw->linkTekst				= $_POST['linkTekstL'];
	$postitL_nw->link					= $_POST['linkL'];
	$postitL_nw->kleur					= $_POST['kleurL'];
	
	if ($postitL_nw != $postitL)
	{
		if ($postitL_nw->id != NULL) $postitL_nw->updateToDB(); else $postitL_nw->saveToDB();
	} 
	$postitR_nw = clone $postitR;
	if (isset($_POST['publIndR']))
		$postitR_nw->publInd = 'j';
		else
		$postitR_nw->publInd = NULL;
	if (Tools::checkDate($_POST['publDatumR'], 'jjjj-mm-dd') || $_POST['publDatumR'] == '')
		$postitR_nw->publDatum			= $_POST['publDatumR'];
	$postitR_nw->titel					= $_POST['titelR'];
	$postitR_nw->tekst					= $_POST['tekstR'];
	$postitR_nw->linkTekst				= $_POST['linkTekstR'];
	$postitR_nw->link					= $_POST['linkR'];
	$postitR_nw->kleur					= $_POST['kleurR'];
	
	if ($postitR_nw != $postitR)
	{
		if ($postitR_nw->id != NULL) $postitR_nw->updateToDB(); else $postitR_nw->saveToDB();
	} 

	/* start de page opnieuw om een tweede update te voorkomen */
	header("location: mut_postits.php");
	exit();	
}

?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>
	<script>
		$(document).ready(function() {
			$("#publDatumL" ).datepicker(
				{
					dateFormat: "yy-mm-dd",
				});
			// $('div.ui-datepicker').css({ fontSize: '0.9em' });
			$("#publDatumR" ).datepicker(
				{
					dateFormat: "yy-mm-dd",
				});
			// $('div.ui-datepicker').css({ fontSize: '0.9em' });
			
		
		});
		</script>
		<style>
		span {
			overflow-wrap: break-word;
		}
		</style>		
	</head>
	<body style="background-color: #dddddd;">
		
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container-fluid"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto">Post-its voorpagina</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
        <div class="container" style="padding-bottom: 80px;">	
			<form method="POST" action="mut_postits.php" id="postmt" novalidate>
			<div class="row">
				<div class="col-md-6 bg-light mt-2 pt-2">
					<h4 class="text-md-center">Post-it links</h4>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Publiceren?</span>
						</div>
						<input type="checkbox" name="publIndL"  id="publIndL" class="form-control" value="j" style="margin-left: 15px;" <?php if($postitL->publInd == 'j') echo ' checked'; ?>>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Datum</span>
						</div>
						<input type="text" name="publDatumL" id="publDatumL" class="form-control" value="<?php echo $postitL->publDatum; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Titel</span>
						</div>
						<input type="text" name="titelL" class="form-control" value="<?php echo $postitL->titel; ?>" required>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Tekst (max. 100 char)</span>
						</div>
						<input type="text" name="tekstL" class="form-control" value="<?php echo $postitL->tekst; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Link tekst</span>
						</div>
						<input type="text" name="linkTekstL" class="form-control" value="<?php echo$postitL->linkTekst; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Link (URL)</span>
						</div>
						<input type="text" name="linkL" class="form-control" value="<?php echo $postitL->link; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Kleur</span>
						</div>
						<input type="text" name="kleurL" class="form-control" value="<?php echo $postitL->kleur; ?>">
					</div>
				</div>
				<div class="col-md-6 bg-light mt-2 pt-2">
					<h4 class="text-md-center">Post-it rechts</h4>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Publiceren?</span>
						</div>
						<input type="checkbox" name="publIndR"  id="publIndR" class="form-control" value="j" style="margin-left: 15px;" <?php if($postitR->publInd == 'j') echo ' checked'; ?>>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Datum</span>
						</div>
						<input type="text" name="publDatumR" id="publDatumR" class="form-control" value="<?php echo $postitR->publDatum; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Titel</span>
						</div>
						<input type="text" name="titelR" class="form-control" value="<?php echo $postitR->titel; ?>" required>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Tekst (max. 100 char)</span>
						</div>
						<input type="text" name="tekstR" class="form-control" value="<?php echo $postitR->tekst; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Link tekst</span>
						</div>
						<input type="text" name="linkTekstR" class="form-control" value="<?php echo$postitR->linkTekst; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Link (URL)</span>
						</div>
						<input type="text" name="linkR" class="form-control" value="<?php echo $postitR->link; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Kleur</span>
						</div>
						<input type="text" name="kleurR" class="form-control" value="<?php echo $postitR->kleur; ?>">
					</div>
					<div class="forms-group mb-1">
						<button name="updateMtBut" value="wijzig" type="submit" class="btn btn-primary btn-width btn-sm">Wijzig</button>
						<button name="backMtBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button>
					</div>
				</div>

			</div>
			</form>
		</div>
		</div>
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
