<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende.php');
include_once('../class/c_intakeform.php');
include_once('../class/c_maatje_coll.php');

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
		case 6:
			if (($pos & 32) ==  32) return TRUE;
			break;
		case 7:
			if (($pos & 64) ==  64) return TRUE;
			break;
		default:
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
}

/* Haal alle beschikbare intakers op */
$arr1 = array (array (0 => 'person.type', 1 => 'mtj'));
$arr2 = array (array (0 => 'person.achternaam', 1 => 'ASC'));
$jhmz = new Maatje_coll ($arr1, $arr2);
$intakerLijst = $jhmz->maatjeColl;
$intakerListHTML = '<option value="">---</option>';
foreach ($intakerLijst as $intaker)
{
	if($intakeform->id_intaker == $intaker->id) 
	{
		$sel = 'selected';
	}
	else $sel = '';
	$intakerListHTML .= '<option value="' . $intaker->id . '" ' . $sel . '>' . $intaker->voornaam . ' ' . $intaker->tussenvoegsels . ' ' . $intaker->achternaam . '</option>';
}


?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>
	<style>
	.error-border {
		border:	2px solid red;
	}
	input.invalid, textarea.invalid{
		border: 2px solid red;
	}
	
	input.valid, textarea.valid{
		border: 2px solid green;
	}
	/* .nav-tabs .active > a, .nav-tabs .active > a:hover, .nav-tabs .active > a:focus { */
	.nav-tabs .nav-link {
		border: 1px solid #999999;
		/* border-bottom: 2px solid #000000; */
	}
	.nav-tabs .nav-item > .active, .nav-tabs .nav-item:hover .active, .nav-tabs .nav-item:focus .active {
		/* border-left: 2px solid #000000;
		border-top: 2px solid #000000;
		border-right: 2px solid #000000; */
		border-bottom-color: #a5cad8;
		background-color: #a5cad8;
	}
	#myTabContent > .container {
		background-color: #a5cad8;
		padding-top: 0em;
		padding-bottom: 2em;
		border-radius: 6px;
	}
	.but-size {
		width: 125px;
	}
	
	

	</style>
	<script>
		$(document).ready(function() {
			$("#gebdatum" ).datepicker(
				{
					dateFormat: "yy-mm-dd",
					minDate: "1950-01-01",
					maxDate: "2007-12-31",
					yearRange: '1950:2007',
					changeMonth: true,
					changeYear: true,
				});
			$("#akkoord_datum" ).datepicker(
				{
					dateFormat: "yy-mm-dd",
				});
			$("#advverwdatum" ).datepicker(
				{
					dateFormat: "yy-mm-dd",
				});
			$('div.ui-datepicker').css({ fontSize: '0.9em' });
			
			/* met onderstaande code wordt direct springen naar een bepaalde tab mogelijk */
			let url = location.href.replace(/\/$/, "");
			 
			  if (location.hash) {
				const hash = url.split("#");
				$('#myTab a[href="#'+hash[1]+'"]').tab("show");
				url = location.href.replace(/\/#/, "#");
				history.replaceState(null, null, url);
				setTimeout(() => {
				  $(window).scrollTop(0);
				}, 400);
			  } 
			   
			  $('a[data-toggle="tab"]').on("click", function() {
				let newUrl;
				const hash = $(this).attr("href");
				if(hash == "#personalia") {
				  newUrl = url.split("#")[0];
				} else {
				  newUrl = url.split("#")[0] + hash;
				}
				newUrl += "/";
				history.replaceState(null, null, newUrl);
			  });
			/**********************************************************************************/
			
		});
		</script>				
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

		<div class="container" id="tabContainer">
			<p>
				<a class="btn btn-primary but-size" href="intake_pdf.php?id=<?php echo $wkz->id; ?>" role="button">maak PDF</a>
				<a class="btn btn-primary but-size" href="overz_werkzoekenden.php" role="button">terug</a>
			</p>
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item" role="presentation">
					<a class="nav-link active" data-toggle="tab" href="#personalia" id="personalia-tab" role="tab" aria-controls="personalia" aria-selected="true">Basis info</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#aanmelding" id="aanmelding-tab" role="tab" aria-controls="aanmelding" aria-selected="false">Aanmelding</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#gezin" id="gezin-tab" role="tab" aria-controls="gezin" aria-selected="false">Gezin</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#ondersteuning" id="ondersteuning-tab" role="tab" aria-controls="ondersteuning" aria-selected="false">Ondersteuning</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#ervaring" id="ervaring-tab" role="tab" aria-controls="ervaring" aria-selected="false">Ervaring en opleiding</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#nieuw_werk" id="nieuw_werk-tab" role="tab" aria-controls="nieuw_werk" aria-selected="false">Werk</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#overig" id="overig-tab" role="tab" aria-controls="overig" aria-selected="false">Overig</a>
				</li>
				<!-- <li class="nav-item">
					<a class="nav-link disabled" data-toggle="tab" href="#akkoord" id="akkoord-tab" role="tab" aria-controls="akkoord" aria-selected="false">Akkoord</a>
				</li> -->
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#advies" id="advies-tab" role="tab" aria-controls="advies" aria-selected="false">Advies</a>
				</li>				
			</ul>
			
		</div>
		<!-- Tab panes -->
		<div class="tab-content" id="myTabContent" style="color: black;">
<!--1---------------------------------------------------------------------------------------------->			
			<div id="personalia" class="container tab-pane fade show active" role="tabpanel" aria-labelledby="personalia-tab"><br>
				<h3>Basisinformatie</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>#personalia" id="postwz" novalidate>
					<div class="input-group input-group-sm mb-2">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Voornaam</span>
						</div>
						<input type="text" name="voornaam" class="form-control" value="<?php echo $wkz->voornaam; ?>">
					</div>
					<div class="input-group input-group-sm mb-2">
						<div class="input-group-prepend" style="width: 30%;">
							  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Tussenvoegsels</span>
						</div>
						<input type="text" name="tussenvoegsels" class="form-control" value="<?php echo $wkz->tussenvoegsels; ?>">
					</div>
					<div class="input-group input-group-sm mb-2">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Achternaam</span>
						</div>
						<input type="text" name="achternaam" class="form-control" value="<?php echo $wkz->achternaam; ?>" required>
					</div>
					<div class="input-group input-group-sm mb-2">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">M/V/G</span>
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
						  <span class="input-group-text text-left text-wrap" style="width: 100%;">Roepnaam</span>
					  </div>
					  <input type="text" name="roepnaam" class="form-control" value="<?php echo $intakeform->roepnaam; ?>">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Straat</span>
					  </div>
					  <input type="text" name="straat" class="form-control" value="<?php echo $wkz->straat; ?>">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Huisnummer</span>
					  </div>
					  <input type="text" name="huisnummer" class="form-control" value="<?php echo $wkz->huisnummer; ?>">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Postcode</span>
					  </div>
					  <input type="text" name="postcode" class="form-control"  maxlength="7" value="<?php echo $wkz->postcode; ?>">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Woonplaats</span>
					  </div>
					  <input type="text" name="woonplaats" class="form-control" value="<?php echo $wkz->woonplaats; ?>" required>
				  </div>
			
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Emailadres</span>
					  </div>
					  <input type="email" name="emailadres" class="form-control" value="<?php echo $wkz->emailadres; ?>" disabled>
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Telefoonnummer</span>
					  </div>
					  <input type="tel" name="telefoonnr" class="form-control"  maxlength="11" value="<?php echo $wkz->telefoonnr; ?>" required>
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Geboortedatum</span>
					  </div>
					  <input type="text" name="gebdatum" id="gebdatum" class="form-control" value="<?php echo $wkz->date_geboorte; ?>" maxlength="10" placeholder="jjjj-mm-dd">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Geboorteplaats</span>
					  </div>
					  <input type="text" name="gebplaats" class="form-control" value="<?php echo $intakeform->gebplaats; ?>">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Geboorteland</span>
					  </div>
					  <input type="text" name="gebland" class="form-control" value="<?php echo $intakeform->gebland; ?>">
				  </div>
				  
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Nationaliteit</span>
					  </div>
					  <input type="text" name="nationaliteit" class="form-control"  maxlength="3" value="<?php echo $intakeform->nationaliteit; ?>">
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text text-left text-wrap" style="width: 100%;">Legitimatie gecheckt?</span>
					  </div>
					  <input type="checkbox" name="legitimatieind" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->legitimatieind == 'j') echo ' checked'; ?>>				
				  </div>
				  <div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">URL LinkedIn</span>
					  </div>
					  <input type="text" name="link_linkedin" class="form-control" value="<?php echo $wkz->link_linkedin; ?>">
					  	<?php if ($wkz->link_linkedin != ''): ?>
							<a href="<?php echo $wkz->link_linkedin; ?>" target="_blank"><i class="fab fa-linkedin" style="font-size: 2em;"></i></a>
						<?php endif; ?>
				  </div>
				  <div class="forms-group mb-1">
					  <button name="saveWzBut" value="bewaar1" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					  <!-- <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button> -->
				  </div>				
			  </form>
			</div>
<!--2---------------------------------------------------------------------------------------------->			
			
			<div id="aanmelding" class="container tab-pane fade" role="tabpanel" aria-labelledby="aanmelding-tab"><br>
				<h3>Aanmelding</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>#aanmelding" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Situatie</span>
					</div>
					<textarea type="text" name="situatie" class="form-control" rows="8" disabled><?php echo $wkz->situatie; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Opmerkingen</span>
					</div>
					<textarea type="text" name="opmerkingen" class="form-control" rows="8" disabled><?php echo $wkz->opmerkingen; ?></textarea>				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Opties</span>
					</div>
					<div class="pl-3" style="font-size: .9em;">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" disabled <?php  if(chkchkbx(1, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label">&nbsp;Individueel traject</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" disabled <?php  if(chkchkbx(2, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label">&nbsp;Jobgroup</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" disabled <?php  if(chkchkbx(3, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label">&nbsp;Jobgroup "Ik Werk In Nederland"</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" disabled <?php  if(chkchkbx(4, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label">&nbsp;Jobgroup voor ZZP'ers</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" disabled <?php  if(chkchkbx(5, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label">&nbsp;Workshop volgen</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox"" disabled <?php  if(chkchkbx(6, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label">&nbsp;Helpen als vrijwilliger</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" disabled <?php  if(chkchkbx(7, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label">&nbsp;Weet het nog niet</label>
						</div>
					</div>
				</div>
				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar2" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<!-- <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button> -->
				</div>
				</form>
		    </div>
<!--3---------------------------------------------------------------------------------------------->			
		 
			<div id="gezin" class="container tab-pane fade" role="tabpanel" aria-labelledby="gezin-tab"><br>
			
				<h3>Gezin</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>#gezin" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Echtelijke staat</span>
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
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Aantal volwassenen/kinderen</span>
					</div>
					<input type="text" name="volw_kind" class="form-control" value="<?php echo $intakeform->volw_kind; ?>" maxlength="120">				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Opleiding/beroep partner (indien relevant)</span>
					</div>
					<input type="text" name="partner_beroep" class="form-control" value="<?php echo $intakeform->partner_beroep; ?>" maxlength="120">
				</div>
				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar3" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<!-- <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button> -->
				</div>
				</form>			
 			</div>
<!--4---------------------------------------------------------------------------------------------->			

			<div id="ondersteuning" class="container tab-pane fade" role="tabpanel" aria-labelledby="ondersteuning-tab"><br>
				<h3>Ondersteuning</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>#ondersteuning" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Wie heeft de werkzoekende aangemeld?</span>
					</div>
					<select class="form-control"  name="aanmelding">
						<option value="" 	<?php if($intakeform->aanmelding == '') echo 'selected'; ?>>---</option>
						<option value="zlf" <?php if($intakeform->aanmelding == 'zlf') echo 'selected'; ?>>Zelf</option>
						<option value="vrd" <?php if($intakeform->aanmelding == 'vrd') echo 'selected'; ?>>UWV</option>
						<option value="bnb" <?php if($intakeform->aanmelding == 'bnb') echo 'selected'; ?>>De Binnenbaan</option>
						<option value="and" <?php if($intakeform->aanmelding == 'and') echo 'selected'; ?>>Anders</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Hoe is werkzoekende bij JobHulpMaatje Zoetermeer terechtgekomen?</span>
					</div>
					<textarea type="text" name="bron" class="form-control"  rows="4" maxlength="8192"><?php echo $intakeform->bron; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<div class=" input-group-text text-left text-wrap" style="width: 100%;">In welke situatie/regeling zit werkzoekende momenteel?</div>
					</div>
					<select class="form-control"  name="regeling">
						<option value="" 	<?php if($intakeform->regeling == '') 	  echo 'selected'; ?>>---</option>
						<option value="nug" <?php if($intakeform->regeling == 'nug') echo 'selected'; ?>>Is niet uitkering gerechtigd</option>
						<option value="wwe" <?php if($intakeform->regeling == 'wwe') echo 'selected'; ?>>Ontvangt WW/Uitkering sociale verzekering</option>
						<option value="bst" <?php if($intakeform->regeling == 'bst') echo 'selected'; ?>>Ontvangt bijstand/participatiewet</option>
						<option value="opl" <?php if($intakeform->regeling == 'opl') echo 'selected'; ?>>Outplacement</option>
						<option value="wrk" <?php if($intakeform->regeling == 'wrk') echo 'selected'; ?>>Heeft werk</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Waar loopt werkzoekende tegenaan in huidige situatie/zoektocht naar (ander) werk?</span>
					</div>
					<textarea type="text" name="uitdagingen" class="form-control"  rows="4" ><?php echo $intakeform->uitdagingen; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Is er sprake van iets waardoor JHM niet zou kunnen helpen? (bv. alcohol, drugs, psychische problemen etc.)</span>
					</div>
					<textarea type="text" name="beperking" class="form-control"  rows="4" ><?php echo $intakeform->beperking; ?></textarea>
				</div>
				<!-- <div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Waarom heeft de werkzoekende hulp gezocht bij JobHulpMaatje?</span>
					</div>
					<textarea type="text" name="redenen" class="form-control"  rows="4" ><?php // echo $intakeform->redenen; ?></textarea>
				</div> -->
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<div class=" input-group-text text-left text-wrap" style="width: 100%;">Wat is de situatie m.b.t. de persoonlijke financiële omstandigheden?</div>
					</div>
					<div class="pl-3" style="font-size: .9em;">
					<div class="form-check">
						<input class="form-check-input" type="radio" name="finsituatie" id="finsituatie" value="1" <?php if($intakeform->finsituatie == '0') echo ' checked'; ?>>
						<label class="form-check-label" for="finsituatie">&nbsp;N.v.t.</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="finsituatie" id="finsituatie" value="1" <?php if($intakeform->finsituatie == '1') echo ' checked'; ?>>
						<label class="form-check-label" for="finsituatie">&nbsp;Uitstekend (geen schulden, geen BKR notering)</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="finsituatie" id="finsituatie" value="2"<?php if($intakeform->finsituatie == '2') echo ' checked'; ?>>
						<label class="form-check-label" for="finsituatie">&nbsp;Goed (weinig schulden, geen BKR notering)</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="finsituatie" id="finsituatie" value="3"<?php if($intakeform->finsituatie == '3') echo ' checked'; ?>>
						<label class="form-check-label" for="finsituatie">&nbsp;Redelijk (schulden onder controle, mogelijk BKR notering</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="finsituatie" id="finsituatie" value="3"<?php if($intakeform->finsituatie == '4') echo ' checked'; ?>>
						<label class="form-check-label" for="finsituatie">&nbsp;Matig (behoorlijke schulden, BKR notering waarschijnlijk)</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="finsituatie" id="finsituatie" value="3"<?php if($intakeform->finsituatie == '5') echo ' checked'; ?>>
						<label class="form-check-label" for="finsituatie">&nbsp;Slecht (veel schulden, geen eigen controle, BKR notering vrijwel zeker</label>
					</div>
					</div>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Motivatie werkzoekende</span>
					</div>
					<select class="form-control"  name="motivatie" id="motivatie">
						<option value="" <?php if($intakeform->motivatie == '') echo 'selected'; ?>>---</option>							
						<option value="1" <?php if($intakeform->motivatie == '1') echo 'selected'; ?>>Weinig</option>
						<option value="2" <?php if($intakeform->motivatie == '2') echo 'selected'; ?>>Normaal</option>
						<option value="3" <?php if($intakeform->motivatie == '3') echo 'selected'; ?>>Sterk</option>
					</select>

				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">In geval van een uitkering of bijstand: wordt voldaan aan de sollicitatie-eis van de uitkerende instantie?</span>
					</div>
					<textarea type="text" name="eisen" class="form-control"  rows="4" ><?php echo $intakeform->eisen; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Welk netwerk of welke hulpverlening is/was al aanwezig?</span>
					</div>
					<textarea type="text" name="netwerken" class="form-control" rows="4" ><?php echo $intakeform->netwerken; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Is andere hulp gewenst? Zo ja, welke?</span>
					</div>
					<textarea type="text" name="andere_hulp" class="form-control" rows="4" ><?php echo $intakeform->andere_hulp; ?></textarea>
				</div>
				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar4" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<!-- <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button> -->
				</div>				
				</form>
			</div>
<!--5---------------------------------------------------------------------------------------------->			
			
			<div id="ervaring" class="container tab-pane fade" role="tabpanel" aria-labelledby="ervaring-tab"><br>
				<h3>Ervaring en opleiding</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>#ervaring" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
				  	<div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text text-left text-wrap" style="width: 100%;">Recent CV aanwezig? (Alleen nodig als er geen goed LinkedIn profiel is)</span>
				  	</div>
				  	<input type="checkbox" name="CVind" class="form-control" value="j"  style="margin-left: 15px;" <?php if($intakeform->CVind == 'j') echo ' checked'; ?>>				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Hoogst genoten opleiding</span>
					</div>
					<select class="form-control"  name="opleiding" id="opleiding">
						<option value="" <?php if($wkz->opleiding == '') echo 'selected'; ?>>---</option>
						<option value="GO" <?php if($wkz->opleiding == 'GO') echo 'selected'; ?>>Geen opleiding</option>
						<option value="VMBO" <?php if($wkz->opleiding == 'VMBO') echo 'selected'; ?>>VMBO/Mavo</option>
						<option value="Havo" <?php if($wkz->opleiding == 'Havo') echo 'selected'; ?>>Havo/VWO</option>
						<option value="MBO1" <?php if($wkz->opleiding == 'MBO1') echo 'selected'; ?>>MBO 1/2</option>
						<option value="MBO2" <?php if($wkz->opleiding == 'MBO2') echo 'selected'; ?>>MBO 3/4</option>
						<option value="HBO1" <?php if($wkz->opleiding == 'HBO1') echo 'selected'; ?>>HBO bachelor</option>
						<option value="HBO2" <?php if($wkz->opleiding == 'HBO2') echo 'selected'; ?>>HBO master</option>
						<option value="HBO3" <?php if($wkz->opleiding == 'HBO3') echo 'selected'; ?>>HBO post</option>
						<option value="WO1" <?php if($wkz->opleiding == 'WO1') echo 'selected'; ?>>WO bachelor</option>
						<option value="WO2" <?php if($wkz->opleiding == 'WO2') echo 'selected'; ?>>WO master</option>
						<option value="WO3" <?php if($wkz->opleiding == 'WO3') echo 'selected'; ?>>WO post</option>
					</select>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Diploma behaald?</span>
					</div>					
					<div class="pl-3 pt-1" style="font-size: .9em;">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="diploma" id="diploma" value="j" <?php if($intakeform->diploma == 'j') echo ' checked'; ?>>
							<label class="form-check-label" for="diploma">&nbsp;Ja</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="diploma" id="diploma" value="n"<?php if($intakeform->diploma == 'n') echo ' checked'; ?>>
							<label class="form-check-label" for="diploma">&nbsp;Nee</label>
						</div>
					</div>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Is er bereidheid om tijd en/of middelen te steken in een aanvullende opleiding of stage? Zijn er beperkende factoren?</span>
					</div>
					<textarea type="text" name="studie" class="form-control" rows="4"><?php echo $intakeform->studie; ?></textarea>
				</div>
	
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Werkervaring (indien er geen CV is en geen LinkedIn profiel)</span>
					</div>
					<textarea type="text" name="werkervaring" class="form-control" rows="4" ><?php echo $intakeform->werkervaring; ?></textarea>
				</div>
				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar5" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<!-- <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button> -->
				</div>				
				</form>
			</div>
<!--6---------------------------------------------------------------------------------------------->			
			
			<div id="nieuw_werk" class="container tab-pane fade" role="tabpanel" aria-labelledby="nieuw_werk-tab"><br>
				<h3>Eisen en wensen voor nieuw werk</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>#nieuw_werk" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text text-left text-wrap" style="width: 100%;">In welke richting wil de werkzoekende betaald werk vinden?</span>
					  </div>
					  <textarea type="text" name="werk_gewenst" class="form-control" rows="4"><?php echo $intakeform->werk_gewenst; ?></textarea>				
				</div>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text text-left text-wrap" style="width: 100%;">Zijn er sociale of medische beperkingen? (bv. arbeidsongeschiktheid, laaggeletterdheid, autisme, aphasie etc.)</span>
					  </div>
					  <textarea type="text" name="voorwaarden" class="form-control" rows="4"><?php echo $intakeform->voorwaarden; ?></textarea>				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
					<span class="input-group-text text-left text-wrap" style="width: 100%;">Beheersing spreken van de Nederlandse taal</span>
					</div>
					<div class="pl-3 pt-1" style="font-size: .9em;">
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
					<span class="input-group-text text-left text-wrap" style="width: 100%;">Beheersing schrijven van de Nederlandse taal</span>
					</div>
					<div class="pl-3 pt-1" style="font-size: .9em;">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="taalbeh_schr" id="taalbeh1" value="1" <?php if($intakeform->taalbeh_schr == '1') echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh1">&nbsp;Goed</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="taalbeh_schr" id="taalbeh2" value="2"<?php if($intakeform->taalbeh_schr == '2') echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh2">&nbsp;Redelijk</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="taalbeh_schr" id="taalbeh3" value="3"<?php if($intakeform->taalbeh_schr == '3') echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Niet goed</label>
						</div>
					</div>
				</div>
				
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text text-left text-wrap" style="width: 100%;">Maximale reistijd</span>
					  </div>
					  <input type="text" name="reistijd" class="form-control" value="<?php echo $intakeform->reistijd; ?>">				
				</div>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text text-left text-wrap" style="width: 100%;">Beschikbaar vervoer</span>
					  </div>
					  <input type="text" name="vervoer" class="form-control" value="<?php echo $intakeform->vervoer; ?>">				
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Verdere bijzonderheden</span>
					</div>
					<textarea type="text" name="werkbijzh" class="form-control" rows="4"><?php echo $intakeform->werkbijzh; ?></textarea>
				</div>
				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar6" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<!-- <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button> -->
				</div>				
				</form>
			</div>
<!--7---------------------------------------------------------------------------------------------->			
			
			<div id="overig" class="container tab-pane fade" role="tabpanel" aria-labelledby="overig-tab"><br>
				<h3>Overige informatie</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>#overig" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text text-left text-wrap" style="width: 100%;">Intake afgenomen door</span>
					  </div>
					  <select class="form-control"  name="intaker" id="intaker">
						  <?= $intakerListHTML; ?>
					  </select>
 				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text text-left text-wrap" style="width: 100%;">Overige opmerkingen</span>
					</div>
					<textarea type="text" name="overige_opm" class="form-control" rows="8"><?php echo $intakeform->overige_opm; ?></textarea>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Besproken Missie & Visie JHM Zoetermeer</span>
					</div>
					<input type="checkbox" name="besprmis" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->besprmis == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Besproken taken maatje</span>
					</div>
					<input type="checkbox" name="besprtkn" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->besprtkn == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Besproken verantwoordelijkheden werkzoekende</span>
					</div>
					<input type="checkbox" name="besprvwk" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->besprvwk == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Besproken privacy verklaring</span>
					</div>
					<input type="checkbox" name="besprprv" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->besprprv == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Besproken statiegeldregeling cursusboeken</span>
					</div>
					<input type="checkbox" name="besprstatgeld" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->besprstatgeld == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Besproken toesturen kopie nieuwe arbeidsovereenkomst</span>
					</div>
					<input type="checkbox" name="besprkopie_ao" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->besprkopie_ao == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Besproken optie vrijwillige bijdrage</span>
					</div>
					<input type="checkbox" name="besprvrijwbijd" class="form-control" value="j" style="margin-left: 15px;" <?php if($intakeform->besprvrijwbijd == 'j') echo ' checked'; ?>>
				</div>

				<div class="forms-group mb-1">
					<button name="saveWzBut" value="bewaar7" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
					<!-- <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button> -->
				</div>				
				</form>
			</div>
<!--8---------------------------------------------------------------------------------------------->			
			
			<div id="akkoord" class="container tab-pane fade" role="tabpanel" aria-labelledby="akkoord-tab"><br>
				<h3>Akkoord</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>#akkoord" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Datum</span>
					</div>
					<input type="date" id="akkoord_datum" name="akkoord_datum" class="form-control" value="<?php echo $intakeform->akkoord_datum; ?>" placeholder="jjjj-mm-dd">
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
					<!-- <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button> -->
				</div>
				</form>			
			</div>
<!--9---------------------------------------------------------------------------------------------->			
	
			<div id="advies" class="container tab-pane fade" role="tabpanel" aria-labelledby="advies-tab"><br>
				<h3>Advies</h3>
				<form method="POST" action="proces_intake.php?id=<?php echo $wkz->id?>#advies" id="postwz" novalidate>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Advies deelname jobgroup</span>
					</div>
					<div class="pl-3 pt-1" style="font-size: .9em;">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="advjobgroup" id="advjobgroup" value="j" <?php if($intakeform->advjobgroup == 'j') echo ' checked'; ?>>
							<label class="form-check-label" for="advjobgroup">&nbsp;Ja</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="advjobgroup" id="advjobgroup" value="n"<?php if($intakeform->advjobgroup == 'n') echo ' checked'; ?>>
							<label class="form-check-label" for="advjobgroup">&nbsp;Nee</label>
						</div>
					</div>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Advies begeleiding maatje</span>
					</div>
					<div class="pl-3 pt-1" style="font-size: .9em;">
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="advmaatje" id="advmaatje" value="j" <?php if($intakeform->advmaatje == 'j') echo ' checked'; ?>>
							<label class="form-check-label" for="advmaatje">&nbsp;Ja</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="advmaatje" id="advmaatje" value="n"<?php if($intakeform->advmaatje == 'n') echo ' checked'; ?>>
							<label class="form-check-label" for="advmaatje">&nbsp;Nee</label>
						</div>
					</div>
				</div>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text text-left text-wrap" style="width: 100%;">JobHulpMaatje kan helaas niet helpen want ...</span>
					  </div>
					  <textarea type="text" name="advnietontv" class="form-control" rows="4"><?php echo $intakeform->advnietontv; ?></textarea>				
				</div>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text text-left text-wrap" style="width: 100%;">Overige opmerkingen.</span>
					  </div>
					  <textarea type="text" name="advopmerkingen" class="form-control" rows="4"><?php echo $intakeform->advopmerkingen; ?></textarea>				
				</div>
				<div class="input-group input-group-sm mb-2">
					  <div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text text-left text-wrap" style="width: 100%;">Verwachte datum antwoord aan werkzoekende</span>
					  </div>
					  <input type="text" name="advverwdatum" id="advverwdatum" class="form-control" value="<?php 
					  if ($intakeform->advverwdatum == '') echo ''; else echo $intakeform->advverwdatum; ?>" maxlength="10" placeholder="jjjj-mm-dd">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="forms-group mb-1">
						<button name="saveWzBut" value="bewaar9" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
						<!-- <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button> -->
					</div>
				</div>
				</form>			
			</div>
		</div>
			
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
