<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende.php');

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

function chkchkbx ($p, $pos)
{
	/* 1 3 7 15 31 */
	switch ($p) {
		case 1:
			if (($pos & 1) ==  1) return TRUE;
			break;
		case 2:
			if (($pos & 2) ==  2) return TRUE;
			break;
		case 3:
			if (($pos & 4) ==  4) return TRUE;
			break;
		case 4:
			if (($pos & 8) ==  8) return TRUE;
			break;
		case 5:
			if (($pos & 16) ==  16) return TRUE;
			break;
		}
		return FALSE;
}

if (isset($_POST['backWzBut']) && $_POST['backWzBut'] == 'back')
{
	header("location: beheer.php");
	exit();	
}

$wkz = new Werkzoekende ();

if (isset($_SESSION['getemailadres']))
{
	$wkz = new Werkzoekende ('emailadres', $_SESSION['getemailadres']);
	$_SESSION['wkz_id'] = $wkz->id;
	unset($_SESSION['getemailadres']);
}


if (isset($_POST['getWkzBut']) && $_POST['getWkzBut'] == 'get1' && $_POST['getemailadres'] != '')
{
	$_SESSION['getemailadres'] = $_POST['getemailadres'];
	header("location: aanmelding_wkz.php");
	exit();		
}

if (isset($_POST['saveWzBut']) && $_POST['saveWzBut'] == 'bewaar1')
{
	// if (isset($_SESSION['wkz_id']))
	// 	$wkz_nw = new Werkzoekende('id', $_SESSION['wkz_id']); 
	// 	else
	$wkz_nw = new Werkzoekende();
		
	$wkz_nw->voornaam				= $_POST['voornaam'];
	$wkz_nw->achternaam				= $_POST['achternaam'];
	$wkz_nw->tussenvoegsels			= $_POST['tussenvoegsels'];
	$wkz_nw->straat					= $_POST['straat'];
	$wkz_nw->huisnummer				= substr($_POST['huisnummer'], 0, 5);
	$wkz_nw->postcode				= substr($_POST['postcode'], 0, 7);
	$wkz_nw->woonplaats				= $_POST['woonplaats'];
	$wkz_nw->emailadres				= $_POST['emailadres'];
	$wkz_nw->telefoonnr				= substr($_POST['telefoonnr'], 0, 11);
	$wkz_nw->situatie				= $_POST['situatie'];
	$wkz_nw->opmerkingen			= $_POST['opmerkingen'];
	$wkz_nw->status					= '000';
	$opties = 0;
	if(isset($_POST['hulpvorm1'])) $opties = $opties + 1;
	if(isset($_POST['hulpvorm2'])) $opties = $opties + 2;
	if(isset($_POST['hulpvorm3'])) $opties = $opties + 4;
	if(isset($_POST['hulpvorm4'])) $opties = $opties + 8;
	if(isset($_POST['hulpvorm5'])) $opties = $opties + 16;
	$wkz_nw->opties				= $opties;
	
	// if (isset($_SESSION['wkz_id']))
	// {
	// 	$wkz_nw->updateToDB();
	// 	unset($_SESSION['wkz_id']);
	// } else
	// {
		$wkz_nw->saveToDB();
	// }
	echo '<script>alert("De gegevens zijn in de database opgenomen."); window.location.href = "https://intra.jhmz.nl/beheer/aanmelding_wkz.php";</script>';
	exit();	
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>
	<style>
	.bg-tab {
		background-color: #ccd9d9;
		border: 1px #000000 solid;
	}
	.error-border {
		border:	2px solid red;
	}
	.uitlegtekst {
		font-size:	.9em;
	}
	</style>
	</head>
	<body style="background-color: #dddddd;">
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-2 mb-3">
				<h1 class="mx-auto">Aanmelding werkzoekende</h1>
			</div>
		</div>
		<div id="personalia" class="container tab-pane active bg-tab pb-2" style="margin: 10px auto;"><br>
			<p class="uitlegtekst mx-1">Gebruik dit formulier voor inschrijvingen van werkzoekenden die zelf geen online aanmeldformulier hebben ingevuld. B.v. bij aanmeldingen aan de balie of via de telefoon of via JobHulpMaatje landelijk. Ook aanmeldingen die via email worden gedaan, dienen m.b.v. dit formulier in de administratie te worden opgenomen.</p>
			<p class="uitlegtekst mx-1">Een werkzoekende kan meerdere keren worden geregistreerd. Het emailadres is meestal identificerend voor de persoon. Met dit emailadres kan worden gechecked of het al in de database voorkomt. De bijbehorende gegevens worden dan getoond in het formulier. Opslaan betekent wel dat de persoon <strong>nogmaals</strong> onder dit emailadres wordt opgeslagen. Bij opnieuw opvragen kan slechts het meest recent opgeslagen persoon worden getoond.</p>
			<form method="POST" action="aanmelding_wkz.php" id="aanmwz" novalidate>
				<div class="input-group input-group-sm pb-3 border-bottom border-primary">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Emailadres
						</span>
					</div>
					<input id="emailadres" type="email" name="getemailadres" class="form-control" value="" required>
					<span id="availability"></span>
					<button name="getWkzBut" value="get1" class="btn btn-primary btn-width btn-sm">
						  <i class="fas fa-arrow-down" aria-hidden="true" style="font-size: 1.3em;"></i>
					</button>
				</div>
			</form>
			<form method="POST" action="aanmelding_wkz.php" id="aanmwz" novalidate>
				<div class="input-group input-group-sm mb-2 pt-3">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Voornaam</span>
					</div>
					<input type="text" name="voornaam" class="form-control" value="<?php echo $wkz->voornaam; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Tussenvoegsels</span>
					</div>
					<input type="text" name="tussenvoegsels" class="form-control" value="<?php echo $wkz->tussenvoegsels; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Achternaam</span>
					</div>
					<input type="text" name="achternaam" class="form-control" value="<?php echo $wkz->achternaam; ?>" required>
				</div>
				<div class="input-group input-group-sm mb-2">
			    	<div class="input-group-prepend" style="width: 30%;">
				    	<span class=" input-group-text" style="width: 100%;">Straat</span>
			  		</div>
			  		<input type="text" name="straat" class="form-control" value="<?php echo $wkz->straat; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
				  <div class="input-group-prepend" style="width: 30%;">
					  <span class=" input-group-text" style="width: 100%;">Huisnummer</span>
				  </div>
				  <input type="text" name="huisnummer" class="form-control" value="<?php echo $wkz->huisnummer; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Postcode</span>
					</div>
					<input type="text" name="postcode" class="form-control" value="<?php echo $wkz->postcode; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Woonplaats</span>
					</div>
					<input type="text" name="woonplaats" class="form-control" value="<?php echo $wkz->woonplaats; ?>" required>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">Emailadres</span>
					</div>
					<input id="emailadres" type="email" name="emailadres" class="form-control" value="<?php echo $wkz->emailadres; ?>" required>
					<span id="availability"></span>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Telefoonnummer</span>
					</div>
					<input type="telnr" name="telefoonnr" class="form-control" value="<?php echo $wkz->telefoonnr; ?>" required>
				  </div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Opties</span>
					</div>
					<div class="pl-3" style="font-size: .9em;">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="hulpvorm1" id="hulpvorm1" value="indiv" <?php if(chkchkbx(1, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh1">&nbsp;Individueel traject</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="hulpvorm2" id="hulpvorm2" value="jobgr" <?php if(chkchkbx(2, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh2">&nbsp;Jobgroup</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="hulpvorm3" id="hulpvorm3" value="jiwin" <?php if(chkchkbx(3, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Jobgroup "Ik Werk In Nederland"</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="hulpvorm4" id="hulpvorm4" value="jzzps" <?php if(chkchkbx(4, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Jobgroup voor ZZP'ers</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="hulpvorm5" id="hulpvorm5" value="weetn" <?php if(chkchkbx(5, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Weet ik nog niet</label>
						</div>
					</div>
				</div>
				<div class="input-group input-group-sm mb-2">
				  <div class="input-group-prepend" style="width: 30%;">
					  <span class=" input-group-text" style="width: 100%;">Situatie</span>
				  </div>
				  <textarea type="text" name="situatie" class="form-control" rows="8"><?php echo $wkz->situatie; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
				  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Opmerkingen</span>
				  </div>
				  <textarea type="text" name="opmerkingen" class="form-control" rows="8"><?php echo $wkz->opmerkingen; ?></textarea>				
				</div>
				
				<div class="forms-group mb-1">
				  <button name="saveWzBut" value="bewaar1" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
				  <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button>
				</div>				
				</form>
			</div>		 		
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
