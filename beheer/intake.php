<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende.php');
include_once('../class/c_intakeform.php');
include_once('proces_intake.php');

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
// if (!isset($_SESSION['username'])) {
// 	header('location:../index.php');
// 	exit();
// }
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
			<div class="row header rounded text-white py-2 mb-3">
				<h1 class="mx-auto">Werkzoekende intakeformulier</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
		<div class="container pb-3" style="padding: 35px auto; border-bottom: 5px solid black;">
			<h3>Het emailadres is uniek voor iedere werkzoekende</h3>
			<form method="POST" action="intake.php" id="getwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Emailadres</span>
					</div>
					<input type="email" name="emailid" class="form-control <?php if ($error == 1) echo ' error-border'; ?>" value="<?php if(isset($_SESSION['emailadres'])) echo $_SESSION['emailadres'];?>">
				</div>
				<div class="forms-group mb-1">
					<button name="GetWzBut" value="get" type="submit" class="btn btn-primary btn-width btn-sm">Haal op</button>
					<button name="MakeWzBut" value="make" type="submit" class="btn btn-primary btn-width btn-sm">Maak nieuwe</button>
					<button name="DelWzBut" value="del" type="submit" class="btn btn-primary btn-width btn-sm">Verwijder</button>
					<button name="BackWzBut" value="back" type="submit" class="btn btn-secundary btn-width btn-sm">Terug</button>

				</div>					
			</form>
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
				<form method="POST" action="intake.php" id="postwz" novalidate>
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
					  <input type="email" name="emailadres" class="form-control" value="<?php echo $wkz->emailadres; ?>" disabled>
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">Telefoonnummer</span>
					  </div>
					  <input type="tel" name="telefoonnr" class="form-control" value="<?php echo $wkz->telefoonnr; ?>" required>
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">Geboortedatum</span>
					  </div>
					  <input type="date" name="gebdatum" class="form-control" value="<?php echo $intakeform->gebdatum; ?>">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">Geboorteplaats</span>
					  </div>
					  <input type="text" name="gebplaats" class="form-control" value="<?php echo $intakeform->gebdatum; ?>">
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
					  <input type="text" name="nationaliteit" class="form-control" value="<?php echo $intakeform->nationaliteit; ?>">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Legitimatie gecheckt?</span>
					  </div>
					  <input type="checkbox" name="GAKind" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->legitimatieind == 'j') echo ' checked'; ?>>				
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">URL LinkedIn</span>
					  </div>
					  <input type="text" name="link_linkedin" class="form-control" value="<?php echo $wkz->link_linkedin; ?>">
				  </div>
				  <div class="forms-group mb-1">
					  <button name="saveWzBut" value="bewaar1" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
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
					<button name="savePsBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
				</div>		
		    </div>
<!--3---------------------------------------------------------------------------------------------->			
		 
			<div id="gezin" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Gezin</h3>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Echtelijke staat</span>
					</div>
					<select class="form-control"  name="relatie">
						<option value="---" <?php // if($wkz->startsituatie == '---') echo 'selected'; ?>>---</option>
						<option value="ong" <?php // if($wkz->startsituatie == 'nug') echo 'selected'; ?>>Ongehuwd</option>
						<option value="geh" <?php // if($wkz->startsituatie == 'wkw') echo 'selected'; ?>>Gehuwd</option>
						<option value="smw" <?php // if($wkz->startsituatie == 'wrk') echo 'selected'; ?>>Samenwonend</option>
						<option value="ges" <?php // if($wkz->startsituatie == 'zkw') echo 'selected'; ?>>Gescheiden</option>
						<option value="wed" <?php // if($wkz->startsituatie == 'bst') echo 'selected'; ?>>Weduwe/weduwenaar</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Aantal volwassenen/kinderen</span>
					</div>
					<input type="text" name="volw_kind" class="form-control" value="<?php // echo $wkz->volw_kind; ?>">				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Opleiding/beroep partner</span>
					</div>
					<input type="text" name="partner_beroep" class="form-control" value="<?php // echo $wkz->partner_beroep; ?>">
				</div>
				<div class="forms-group mb-1">
					<button name="savePsBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
				</div>				
 			</div>
<!--4---------------------------------------------------------------------------------------------->			

			<div id="ondersteuning" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Ondersteuning</h3>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Wie heeft aangemeld?</span>
					</div>
					<select class="form-control"  name="aanmelding">
						<option value="---" <?php // if($wkz->startsituatie == 'zlf') echo 'selected'; ?>>---</option>
						<option value="zlf" <?php // if($wkz->startsituatie == 'zlf') echo 'selected'; ?>>Zelf</option>
						<option value="vrd" <?php // if($wkz->startsituatie == 'vrd') echo 'selected'; ?>>UWV</option>
						<option value="and" <?php // if($wkz->startsituatie == 'and') echo 'selected'; ?>>Anders</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Huidige regeling</span>
					</div>
					<select class="form-control"  name="regeling">
						<option value="---" <?php // if($wkz->startsituatie == 'gen') echo 'selected'; ?>>---</option>
						<option value="gen" <?php // if($wkz->startsituatie == 'gen') echo 'selected'; ?>>Geen</option>
						<option value="wwe" <?php // if($wkz->startsituatie == 'wwe') echo 'selected'; ?>>WW</option>
						<option value="opl" <?php // if($wkz->startsituatie == 'opl') echo 'selected'; ?>>Outplacement</option>
						<option value="wia" <?php // if($wkz->startsituatie == 'wia') echo 'selected'; ?>>WIA</option>
						<option value="bst" <?php // if($wkz->startsituatie == 'bst') echo 'selected'; ?>>Bijstand</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Uitdagingen</span>
					</div>
					<input type="text" name="uitdagingen" class="form-control" value="<?php // echo $wkz->uitdagingen; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Beperkingen</span>
					</div>
					<input type="text" name="beperking" class="form-control" value="<?php // echo $wkz->beperking; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Motivatie</span>
					</div>
					<input type="text" name="motivatie" class="form-control" value="<?php // echo $wkz->motivatie; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Aanvullende eisen en welke</span>
					</div>
					<input type="text" name="eisen" class="form-control" value="<?php // echo $wkz->eisen; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Andere netwerken en hulpverlening</span>
					</div>
					<textarea type="text" name="netwerken" class="form-control" rows="4"><?php // echo $wkz->netwerken; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Is andere hulp gewenst? Zo ja, welke?</span>
					</div>
					<textarea type="text" name="andere_hulp" class="form-control" rows="4"><?php // echo $wkz->andere_hulp; ?></textarea>
				</div>
				<div class="forms-group mb-1">
					<button name="savePsBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
				</div>				

			</div>
<!--5---------------------------------------------------------------------------------------------->			
			
			<div id="ervaring" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Ervaring en opleiding</h3>
				<div class="input-group input-group-sm mb-2">
				  	<div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Recent CV aanwezig?</span>
				  	</div>
				  	<input type="checkbox" name="CVind" class="form-control" value="j"  style="margin-left: 15px;" <?php // if($wkz->CVind == 'j') echo ' checked'; ?>>				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Hoogst genoten opleiding</span>
					</div>
					<select class="form-control"  name="opleiding">
						<option value="---" <?php // if($wkz->startsituatie == 'gop') echo 'selected'; ?>>---</option>
						<option value="gop" <?php // if($wkz->startsituatie == 'gop') echo 'selected'; ?>>Geen</option>
						<option value="bas" <?php // if($wkz->startsituatie == 'bas') echo 'selected'; ?>>Basisschool</option>
						<option value="wmb" <?php // if($wkz->startsituatie == 'wmb') echo 'selected'; ?>>VMBO</option>
						<option value="mbo" <?php // if($wkz->startsituatie == 'mbo') echo 'selected'; ?>>MBO</option>
						<option value="hbo" <?php // if($wkz->startsituatie == 'hbo') echo 'selected'; ?>>HBO</option>
						<option value="won" <?php // if($wkz->startsituatie == 'won') echo 'selected'; ?>>WO</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Diploma behaald in</span>
					</div>
					<input type="text" name="diploma" class="form-control" value="<?php // echo $wkz->diploma ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Tijd en middelen voor studie?</span>
					</div>
					<textarea type="text" name="studie" class="form-control" rows="4"><?php // echo $wkz->studie; ?></textarea>
				</div>
	
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Werkervaring</span>
					</div>
					<textarea type="text" name="werkervaring" class="form-control" rows="4"><?php // echo $wkz->werkervaring; ?></textarea>
				</div>
				<div class="forms-group mb-1">
					<button name="savePsBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
				</div>				

			</div>
<!--6---------------------------------------------------------------------------------------------->			
			
			<div id="nieuw_werk" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Eisen en wensen voor nieuw werk</h3>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Wat voor werk is gewenst?</span>
					  </div>
					  <textarea type="text" name="werk_gewenst" class="form-control" rows="4"><?php // echo $wkz->werk_gewenst; ?></textarea>				
				</div>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Zijn er beperkingen/voorwaarden?</span>
					  </div>
					  <textarea type="text" name="voorwaarden" class="form-control" rows="4"><?php // echo $wkz->voorwaarden; ?></textarea>				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
					<span class="input-group-text" style="width: 100%;">Spreekt Nederlands</span>
					</div>
					<div class="pl-3">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="taalbeh" id="taalbeh1" value="Goed" checked>
							<label class="form-check-label" for="taalbeh1">&nbsp;Goed</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="taalbeh" id="taalbeh2" value="Redelijk">
							<label class="form-check-label" for="taalbeh2">&nbsp;Redelijk</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="taalbeh" id="taalbeh3" value="Niet goed">
							<label class="form-check-label" for="taalbeh3">&nbsp;Niet goed</label>
						</div>
					</div>
				</div>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Maximale reistijd</span>
					  </div>
					  <input type="text" name="reistijd" class="form-control" value="<?php // echo $wkz->reistijd; ?>">				
				</div>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Beschikbaar vervoer</span>
					  </div>
					  <input type="text" name="vervoer" class="form-control" value="<?php // echo $wkz->vervoer; ?>">				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Verdere bijzonderheden</span>
					</div>
					<textarea type="text" name="werk_bijzonderheden" class="form-control" rows="4"><?php // echo $wkz->werk_bijzonderheden; ?></textarea>
				</div>
				<div class="forms-group mb-1">
					<button name="savePsBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
				</div>				

			</div>
<!--7---------------------------------------------------------------------------------------------->			
			
			<div id="overig" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Overige informatie</h3>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Overige opmerkingen</span>
					</div>
					<textarea type="text" name="overige_opm" class="form-control" rows="8"><?php // echo $wkz->overige_opm; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Besproken Missie & Visie JHM Zoetermeer</span>
					</div>
					<input type="checkbox" name="bespr_missie" class="form-control" value="j" style="margin-left: 15px;" <?php // if($wkz->GAKind == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Besproken taken maatje</span>
					</div>
					<input type="checkbox" name="bespr_missie" class="form-control" value="j" style="margin-left: 15px;" <?php // if($wkz->GAKind == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Besproken verantwoordelijkheden werkzoekende</span>
					</div>
					<input type="checkbox" name="bespr_missie" class="form-control" value="j" style="margin-left: 15px;" <?php // if($wkz->GAKind == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Besproken privacy verklaring</span>
					</div>
					<input type="checkbox" name="bespr_missie" class="form-control" value="j" style="margin-left: 15px;" <?php // if($wkz->GAKind == 'j') echo ' checked'; ?>>
				</div>

				<div class="forms-group mb-1">
					<button name="savePsBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
				</div>				

			</div>
<!--8---------------------------------------------------------------------------------------------->			
			
			<div id="akkoord" class="container tab-pane fade bg-tab pb-2"><br>
				<h3>Akkoord</h3>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Datum</span>
					</div>
					<input type="text" name="akkoord_datum" class="form-control" value="<?php // echo $wkz->akkoord_datum; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Plaats</span>
					</div>
					<input type="text" name="akkoord_plaats" class="form-control" value="<?php // echo $wkz->akkoord_plaats; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Naam</span>
					</div>
					<input type="text" name="akkoord_naam" class="form-control" value="<?php // echo $wkz->akkoord_naam; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Handtekening</span>
					</div>
					<select class="form-control"  name="handtekening">
						<option value="ong" <?php // if($wkz->handtekening == 'nug') echo 'selected'; ?>>Niet ondertekend</option>
						<option value="geh" <?php // if($wkz->handtekening == 'wkw') echo 'selected'; ?>>Ondertekend</option>
					</select>
				</div>
				<div class="forms-group mb-1">
					<button name="savePsBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
				</div>				
			</div>
<!--8---------------------------------------------------------------------------------------------->			
		</div>
			
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
