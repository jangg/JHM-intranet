<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende.php');
include_once('../class/c_processtap.php');

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
	if (isset($_POST['nnind'])) $wkz_nw->nnind = 'j'; else $wkz_nw->nnind = 'n';
	if (isset($_POST['GAKind'])) $wkz_nw->GAKind = 'j'; else $wkz_nw->GAKind = 'n';
	if (isset($_POST['DBBind'])) $wkz_nw->DBBind = 'j'; else $wkz_nw->DBBind = 'n'; 
	$wkz_nw->opmerkingen			= $_POST['opmerkingen'];
	$wkz_nw->status					= '000';
	$opties = 0;
	if(isset($_POST['hulpvorm1'])) $opties = $opties + 1;
	if(isset($_POST['hulpvorm2'])) $opties = $opties + 2;
	if(isset($_POST['hulpvorm3'])) $opties = $opties + 4;
	if(isset($_POST['hulpvorm4'])) $opties = $opties + 8;
	if(isset($_POST['hulpvorm5'])) $opties = $opties + 16;
	if(isset($_POST['hulpvorm6'])) $opties = $opties + 32;
	if(isset($_POST['hulpvorm7'])) $opties = $opties + 64;
	$wkz_nw->opties				= $opties;
	if (
		$wkz_nw->voornaam	 == '' ||		
		$wkz_nw->achternaam 	 == '' ||		
		$wkz_nw->emailadres	 == '' ||		
		$wkz_nw->telefoonnr	 == ''		
		)
		{
			echo '<script>alert("Niet alle verplichte velden zijn ingevuld. Probeer het opnieuw."); window.location.href = "https://intra.jhmz.nl/beheer/aanmelding_wkz.php";</script>';
		}
		else
		{
			$wkz_nw->saveToDB();
			$ps = new Processtap();
			$ps->delind = 'n';
			$ps->id_werkzkd = $wkz_nw->id;
			$ps->id_user = $curr_user->id;
			$ps->dt_stap = new DateTime();
			$ps->wzstatus = '000';
			$ps->drstrnaar = '';
			$ps->toelichting = 'Nieuw';
			$ps->saveToDB();
			Tools::MailRoom('Coordinator Werkzoekenden', 'coordinatoren@jhm-zoetermeer.nl', 'Nieuwe werkzoekende toegevoegd in de WAS' . ' door ' . $curr_user->username, 
				$wkz_nw->voornaam . ' ' . $wkz_nw->tussenvoegsels . ' ' . $wkz_nw->achternaam);
			echo '<script>alert("De gegevens zijn in de database opgenomen."); window.location.href = "https://intra.jhmz.nl/beheer/aanmelding_wkz.php";</script>';
		}
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
				<p class="mb-1 pt-2">Velden met een <sup>*</sup> zijn verplicht</p>
				<div class="input-group input-group-sm mb-2 pt-0">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Voornaam<sup>*</sup></span>
					</div>
					<input type="text" name="voornaam" class="form-control" value="<?php echo $wkz->voornaam; ?>" require>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Tussenvoegsels</span>
					</div>
					<input type="text" name="tussenvoegsels" class="form-control" value="<?php echo $wkz->tussenvoegsels; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Achternaam<sup>*</sup></span>
					</div>
					<input type="text" name="achternaam" class="form-control" value="<?php echo $wkz->achternaam; ?>" required>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Postcode<sup>*</sup></span>
					</div>
					<input type="text" id="postcode" name="postcode" class="form-control" value="<?php echo $wkz->postcode; ?>" require>
				</div>
				<div class="input-group input-group-sm mb-2">
				  <div class="input-group-prepend" style="width: 30%;">
					  <span class=" input-group-text" style="width: 100%;">Huisnummer<sup>*</sup></span>
				  </div>
				  <input type="text" id="huisnummer" name="huisnummer" class="form-control" value="<?php echo $wkz->huisnummer; ?>" require>
				</div>

				<div class="input-group input-group-sm mb-2">
			    	<div class="input-group-prepend" style="width: 30%;">
				    	<span class=" input-group-text" style="width: 100%;">Straat</span>
			  		</div>
			  		<input type="text" id="straat" name="straat" class="form-control" value="<?php echo $wkz->straat; ?>" readonly>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Woonplaats</span>
					</div>
					<input type="text" id="woonplaats" name="woonplaats" class="form-control" value="<?php echo $wkz->woonplaats; ?>" readonly>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">Emailadres<sup>*</sup></span>
					</div>
					<input id="emailadres" type="email" name="emailadres" class="form-control" value="<?php echo $wkz->emailadres; ?>" required>
					<span id="availability"></span>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Telefoonnummer<sup>*</sup></span>
					</div>
					<input type="text" name="telefoonnr" class="form-control" value="<?php echo $wkz->telefoonnr; ?>" required>
				  </div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Opties</span>
					</div>
					<div class="pl-3" style="font-size: .9em;">
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if(chkchkbx(1, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh1">&nbsp;Individueel traject</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if(chkchkbx(2, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh2">&nbsp;Jobgroup</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if(chkchkbx(3, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Jobgroup "Ik Werk In Nederland"</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if(chkchkbx(4, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Jobgroup voor ZZP'ers</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if(chkchkbx(5, $wkz->opties)) echo ' checked'; ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Workshop</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if(chkchkbx(7, $wkz->opties)) echo ' checked'; ?>>
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
				
				<div class="input-group input-group-sm mb-1">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Nieuwe Nederlander</span>
					</div>
					<input type="checkbox" name="nnind" class="form-control" value="j" <?php if($wkz->nnind == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-1">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">GAK</span>
					</div>
					<input type="checkbox" name="GAKind" class="form-control" value="j" <?php if($wkz->GAKind == 'j') echo ' checked'; ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">De Binnenbaan</span>
					</div>
					<input type="checkbox" name="DBBind" class="form-control" value="j" <?php if($wkz->DBBind == 'j') echo ' checked'; ?>>
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
		<script>
			const postcode = document.getElementById("postcode");
			const huisnummer = document.getElementById("huisnummer");
			const straatnaam = document.getElementById("straat");
			const woonplaats = document.getElementById("woonplaats");
			// const rege = /^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i;
			const rege = /^[1-9][0-9]{3}\s*(?!sa|sd|ss)[a-z]{2}$/i;
			
			huisnummer.addEventListener('blur', haalDataOp);
			
			function haalDataOp () {
				if(rege.test(postcode.value)) {
					// let data = [];
					postcode.value = postcode.value.replace(/\s+/g, '').toUpperCase();

					fetch('https://geodata.nationaalgeoregister.nl/locatieserver/free?fq=postcode:' + postcode.value + '&fq=huisnummer:' + this.value)
					.then(result => result.json())
					.then(output => {
						// data.push(output.response.docs[0]['straatnaam']);
						// data.push(output.response.docs[0]['woonplaatsnaam']);
						straatnaam.value = output.response.docs[0]['straatnaam'];
						woonplaats.value = output.response.docs[0]['woonplaatsnaam'];
						// console.log('Output: ', output.response.docs[0]['straatnaam'] + ' ' + output.response.docs[0]['woonplaatsnaam']);
					})
		   		.catch(err => {
						// console.error(err);
						straatnaam.value = 'onbekend';
						woonplaats.value = '';
					})
					return data;
				} else {
				 // console.log('Foute output!');
				 straatnaam.value = 'ongeldig';
				 woonplaats.value = '';
				}
			}
		</script>
	</body>
</html>
