<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende.php');
include_once('../class/c_intakeform.php');

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

$wkz = new Werkzoekende ();
$intakeform = new Intakeform ();
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
	$wkz = new Werkzoekende ('id', $_GET['id']);
	if ($wkz->id_intakeform != '')
	{
		$intakeform = new Intakeform ('id', $wkz->id_intakeform);
	}
	// error_log($intakeform->id . ' - ' . $intakeform->nationaliteit);
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
	</style>				
	</head>
	<body style="background-color: #dddddd;">
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white pt-2 mb-0">
				<h1 class="mx-auto">Werkzoekende intakeformulier</h1>			
			</div>
			<div class="row rounded text-center text-white pb-2 mb-2">
				<div class="col-sm-12">
					<h4 class="mx-auto"><?php echo $wkz->voornaam . ' ' . $wkz->tussenvoegsels . ' ' . $wkz->achternaam; ?></h4>
				</div>
			</div>
		</div>

		<div class="container" style="margin: 10px auto;">
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="pill" href="#personalia">Persoon</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="pill" href="#aanmelding">Aanmelding</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="pill" href="#gezin">Gezin</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="pill" href="#ondersteuning">Ondersteuning</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="pill" href="#ervaring">Ervaring en opleiding</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="pill" href="#nieuw_werk">Werk</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="pill" href="#overig">Overig</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="pill" href="#akkoord">Akkoord</a>
				</li>
			</ul>
		</div>
		<!-- Tab panes -->
		<div class="tab-content" style="color: black;">
<!--1---------------------------------------------------------------------------------------------->			
			<div id="personalia" class="container tab-pane active bg-tab pb-2" style="margin: 10px auto;"><br>
				<h3>Persoon</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>" id="postwz" novalidate>
					<div class="input-group input-group-sm mb-2">
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
							<span class=" input-group-text" style="width: 100%;">M/V/G</span>
						</div>
						<select class="form-control"  name="geslacht" id="geslacht">
							<option value="" <?php if($wkz->geslacht == '') echo 'selected'; ?>>---</option>							
							<option value="m" <?php if($wkz->geslacht == 'm') echo 'selected'; ?>>Man</option>
							<option value="v" <?php if($wkz->geslacht == 'v') echo 'selected'; ?>>Vrouw</option>
							<option value="n" <?php if($wkz->geslacht == 'n') echo 'selected'; ?>>Genderneutraal</option>
						</select>
					</div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Roepnaam</span>
					  </div>
					  <input type="text" name="roepnaam" class="form-control" value="<?php echo $intakeform->roepnaam; ?>">
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
					  <input type="text" name="postcode" class="form-control"  maxlength="7" value="<?php echo $wkz->postcode; ?>">
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
					  <input type="email" name="emailadres" class="form-control" value="<?php echo $wkz->emailadres; ?>" disabled>
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">Telefoonnummer</span>
					  </div>
					  <input type="tel" name="telefoonnr" class="form-control"  maxlength="11" value="<?php echo $wkz->telefoonnr; ?>" required>
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">Geboortedatum</span>
					  </div>
					  <input type="date" name="gebdatum" class="form-control"  maxlength="10" value="<?php if ($wkz->date_geboorte != '') echo (DateTime::createFromFormat('Y-m-d', $wkz->date_geboorte))->format('d-m-Y'); ?>" placeholder="dd-mm-jjjj">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">Geboorteplaats</span>
					  </div>
					  <input type="text" name="gebplaats" class="form-control" value="<?php echo $intakeform->gebplaats; ?>">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">Geboorteland</span>
					  </div>
					  <input type="text" name="gebland" class="form-control" value="<?php echo $intakeform->gebland; ?>">
				  </div>
				  
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">Nationaliteit</span>
					  </div>
					  <input type="text" name="nationaliteit" class="form-control"  maxlength="3" value="<?php echo $intakeform->nationaliteit; ?>">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Legitimatie gecheckt?</span>
					  </div>
					  <input type="checkbox" name="legitimatieind" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->legitimatieind == 'j') echo ' checked'; ?>>				
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">URL LinkedIn</span>
					  </div>
					  <input type="text" name="link_linkedin" class="form-control" value="<?php echo $wkz->link_linkedin; ?>">
				  </div>
				  <div class="forms-group mb-1">
					  <button name="saveWzBut" value="bewaar1" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					  <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Cancel</button>
				  </div>				
			  </form>
			</div>
<!--2---------------------------------------------------------------------------------------------->			
			
			<div id="aanmelding" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Aanmelding</h3>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Situatie</span>
					</div>
					<textarea type="text" name="situatie" class="form-control" rows="8" disabled><?php echo $wkz->situatie; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Opmerkingen</span>
					</div>
					<textarea type="text" name="opmerkingen" class="form-control" rows="8" disabled><?php echo $wkz->opmerkingen; ?></textarea>				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Opties</span>
					</div>
					<div class="pl-3" style="font-size: .9em;">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="hulpvorm" id="hulpvorm1" value="indiv" disabled <?php  if(chkchkbx(1, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh1">&nbsp;Individueel traject</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="hulpvorm" id="hulpvorm2" value="jobgr" disabled <?php  if(chkchkbx(2, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh2">&nbsp;Jobgroup</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="hulpvorm" id="hulpvorm3" value="jiwin" disabled <?php  if(chkchkbx(3, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Jobgroup "Ik Werk In Nederland"</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="hulpvorm" id="hulpvorm4" value="jzzps" disabled <?php  if(chkchkbx(4, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Jobgroup voor ZZP'ers</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" name="hulpvorm" id="hulpvorm5" value="weetn" disabled <?php  if(chkchkbx(5, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Weet ik nog niet</label>
						</div>
					</div>
				</div>
				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar2" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Cancel</button>
				</div>
		    </div>
<!--3---------------------------------------------------------------------------------------------->			
		 
			<div id="gezin" class="container tab-pane fade bg-tab pb-2"><br>
			
				<h3>Gezin</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Echtelijke staat</span>
					</div>
					<select class="form-control"  name="relatie">
						<option value="" <?php if($intakeform->relatie == '') echo 'selected'; ?>>---</option>
						<option value="ong" <?php if($intakeform->relatie == 'ong') echo 'selected'; ?>>Ongehuwd</option>
						<option value="geh" <?php if($intakeform->relatie == 'geh') echo 'selected'; ?>>Gehuwd</option>
						<option value="smw" <?php if($intakeform->relatie == 'smw') echo 'selected'; ?>>Samenwonend</option>
						<option value="ges" <?php if($intakeform->relatie == 'ges') echo 'selected'; ?>>Gescheiden</option>
						<option value="wed" <?php if($intakeform->relatie == 'wed') echo 'selected'; ?>>Weduwe/weduwenaar</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Aantal volwassenen/kinderen</span>
					</div>
					<input type="text" name="volw_kind" class="form-control" value="<?php echo $intakeform->volw_kind; ?>" maxlength="120">				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Opleiding/beroep partner</span>
					</div>
					<input type="text" name="partner_beroep" class="form-control" value="<?php echo $intakeform->partner_beroep; ?>" maxlength="120">
				</div>
				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar3" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Cancel</button>
				</div>
				</form>			
 			</div>
<!--4---------------------------------------------------------------------------------------------->			

			<div id="ondersteuning" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Ondersteuning</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Wie heeft aangemeld?</span>
					</div>
					<select class="form-control"  name="aanmelding">
						<option value="" 	<?php if($intakeform->aanmelding == '') echo 'selected'; ?>>---</option>
						<option value="zlf" <?php if($intakeform->aanmelding == 'zlf') echo 'selected'; ?>>Zelf</option>
						<option value="vrd" <?php if($intakeform->aanmelding == 'vrd') echo 'selected'; ?>>UWV</option>
						<option value="and" <?php if($intakeform->aanmelding == 'and') echo 'selected'; ?>>Anders</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Huidige regeling</span>
					</div>
					<select class="form-control"  name="regeling">
						<option value="" 	<?php if($intakeform->regeling == '') 	  echo 'selected'; ?>>---</option>
						<option value="gen" <?php if($intakeform->regeling == 'gen') echo 'selected'; ?>>Geen</option>
						<option value="wwe" <?php if($intakeform->regeling == 'wwe') echo 'selected'; ?>>WW</option>
						<option value="opl" <?php if($intakeform->regeling == 'opl') echo 'selected'; ?>>Outplacement</option>
						<option value="wia" <?php if($intakeform->regeling == 'wia') echo 'selected'; ?>>WIA</option>
						<option value="bst" <?php if($intakeform->regeling == 'bst') echo 'selected'; ?>>Bijstand</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Uitdagingen</span>
					</div>
					<textarea type="text" name="uitdagingen" class="form-control"  rows="4" maxlength="180"><?php echo $intakeform->uitdagingen; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Beperkingen</span>
					</div>
					<textarea type="text" name="beperking" class="form-control"  rows="4" maxlength="180"><?php echo $intakeform->beperking; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Motivatie</span>
					</div>
					<textarea type="text" name="motivatie" class="form-control"  rows="4" maxlength="180"><?php echo $intakeform->motivatie; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Aanvullende eisen en welke</span>
					</div>
					<textarea type="text" name="eisen" class="form-control"  rows="4" maxlength="180"><?php echo $intakeform->eisen; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Andere netwerken en hulpverlening</span>
					</div>
					<textarea type="text" name="netwerken" class="form-control" rows="4" maxlength="180"><?php echo $intakeform->netwerken; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Is andere hulp gewenst? Zo ja, welke?</span>
					</div>
					<textarea type="text" name="andere_hulp" class="form-control" rows="4" maxlength="180"><?php echo $intakeform->andere_hulp; ?></textarea>
				</div>
				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar4" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Cancel</button>
				</div>				
				</form>
			</div>
<!--5---------------------------------------------------------------------------------------------->			
			
			<div id="ervaring" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Ervaring en opleiding</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
				  	<div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Recent CV aanwezig?</span>
				  	</div>
				  	<input type="checkbox" name="CVind" class="form-control" value="j"  style="margin-left: 15px;" <?php if($intakeform->CVind == 'j') echo ' checked'; ?>>				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Hoogst genoten opleiding</span>
					</div>
					<select class="form-control"  name="opleiding" id="opleiding">
						<option value="" <?php if($wkz->opleiding == '') echo 'selected'; ?>>---</option>
						<option value="GO" <?php if($wkz->opleiding == 'GO') echo 'selected'; ?>>Geen opleiding</option>
						<option value="VMBO" <?php if($wkz->opleiding == 'VMBO/Mavo') echo 'selected'; ?>>VMBO/Mavo</option>
						<option value="MBO1" <?php if($wkz->opleiding == 'MBO1') echo 'selected'; ?>>MBO 1/2</option>
						<option value="MBO2" <?php if($wkz->opleiding == 'MBO2') echo 'selected'; ?>>MBO 3/4</option>
						<option value="HB1O" <?php if($wkz->opleiding == 'HBO1') echo 'selected'; ?>>HBO bachelor</option>
						<option value="HBO2" <?php if($wkz->opleiding == 'HBO2') echo 'selected'; ?>>HBO master</option>
						<option value="HBO3" <?php if($wkz->opleiding == 'HBO3') echo 'selected'; ?>>HBO post</option>
						<option value="WO1" <?php if($wkz->opleiding == 'WO1') echo 'selected'; ?>>WO bachelor</option>
						<option value="WO2" <?php if($wkz->opleiding == 'WO2') echo 'selected'; ?>>WO master</option>
						<option value="WO3" <?php if($wkz->opleiding == 'WO3') echo 'selected'; ?>>WO post</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Diploma behaald in</span>
					</div>
					<input type="text" name="diploma" class="form-control" value="<?php echo $intakeform->diploma ?>" maxlength="120">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Tijd en middelen voor studie?</span>
					</div>
					<textarea type="text" name="studie" class="form-control" rows="4" maxlength="200"><?php echo $intakeform->studie; ?></textarea>
				</div>
	
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Werkervaring</span>
					</div>
					<textarea type="text" name="werkervaring" class="form-control" rows="4" maxlength="200"><?php echo $intakeform->werkervaring; ?></textarea>
				</div>
				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar5" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Cancel</button>
				</div>				
				</form>
			</div>
<!--6---------------------------------------------------------------------------------------------->			
			
			<div id="nieuw_werk" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Eisen en wensen voor nieuw werk</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Wat voor werk is gewenst?</span>
					  </div>
					  <textarea type="text" name="werk_gewenst" class="form-control" rows="4"><?php echo $intakeform->werk_gewenst; ?></textarea>				
				</div>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Zijn er beperkingen/voorwaarden?</span>
					  </div>
					  <textarea type="text" name="voorwaarden" class="form-control" rows="4"><?php echo $intakeform->voorwaarden; ?></textarea>				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
					<span class="input-group-text" style="width: 100%;">Spreekt Nederlands</span>
					</div>
					<div class="pl-3">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="taalbeh" id="taalbeh1" value="1" <?php if($intakeform->taalbeh == '1') echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh1">&nbsp;Goed</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="taalbeh" id="taalbeh2" value="2"<?php if($intakeform->taalbeh == '2') echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh2">&nbsp;Redelijk</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="taalbeh" id="taalbeh3" value="3"<?php if($intakeform->taalbeh == '3') echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Niet goed</label>
						</div>
					</div>
				</div>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Maximale reistijd</span>
					  </div>
					  <input type="text" name="reistijd" class="form-control" value="<?php echo $intakeform->reistijd; ?>" maxlength="120">				
				</div>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Beschikbaar vervoer</span>
					  </div>
					  <input type="text" name="vervoer" class="form-control" value="<?php echo $intakeform->vervoer; ?>" maxlength="120">				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Verdere bijzonderheden</span>
					</div>
					<textarea type="text" name="werkbijzh" class="form-control" rows="4"><?php echo $intakeform->werkbijzh; ?></textarea>
				</div>
				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar6" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Cancel</button>
				</div>				
				</form>
			</div>
<!--7---------------------------------------------------------------------------------------------->			
			
			<div id="overig" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Overige informatie</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Overige opmerkingen</span>
					</div>
					<textarea type="text" name="overige_opm" class="form-control" rows="8"><?php echo $intakeform->overige_opm; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Besproken Missie & Visie JHM Zoetermeer</span>
					</div>
					<input type="checkbox" name="besprmis" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->besprmis == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Besproken taken maatje</span>
					</div>
					<input type="checkbox" name="besprtkn" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->besprtkn == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Besproken verantwoordelijkheden werkzoekende</span>
					</div>
					<input type="checkbox" name="besprvwk" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->besprvwk == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Besproken privacy verklaring</span>
					</div>
					<input type="checkbox" name="besprprv" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->besprprv == 'j') echo ' checked'; ?>>
				</div>

				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar7" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Cancel</button>
				</div>				
				</form>
			</div>
<!--8---------------------------------------------------------------------------------------------->			
			
			<div id="akkoord" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Akkoord</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Datum</span>
					</div>
					<input type="date" name="akkoord_datum" class="form-control" value="<?php echo $intakeform->akkoord_datum; ?>" placeholder="dd-mm-jjjj">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Plaats</span>
					</div>
					<input type="text" name="akkoord_plaats" class="form-control" value="<?php echo $intakeform->akkoord_plaats; ?>" maxlength="80">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Naam</span>
					</div>
					<input type="text" name="akkoord_naam" class="form-control" value="<?php echo $intakeform->akkoord_naam; ?>" maxlength="80">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Handtekening</span>
					</div>
					<select class="form-control"  name="akkoord_handtek">
						<option value="" <?php if($intakeform->akkoord_handtek == '') echo ' selected'; ?>>Niet ondertekend</option>
						<option value="gtk" <?php if($intakeform->akkoord_handtek == 'gtk') echo ' selected'; ?>>Ondertekend</option>
					</select>
				</div>
				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar8" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Cancel</button>
				</div>
				</form>			
			</div>
<!--8---------------------------------------------------------------------------------------------->			
		</div>
			
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
