<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende.php');
include_once('../class/c_processtap.php');
include_once('../class/c_maatje_coll.php');

function calculateAge($date)
{
	  //explode the date to get month, day and year
	  $birthDate = explode("-", $date);
	  //get age from date or birthdate
	  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
		? ((date("Y") - $birthDate[0]) - 1)
		: (date("Y") - $birthDate[0]));
	  return $age;
}

$statusArray = array (
	'---' => '',
	'000' => 'Nieuw',
	'100' => 'Intake gepland',
	'110' => 'Intake afgenomen',
	'120' => 'Intake gegevens bijgewerkt',
	'200' => 'Intake akkoord en gearchiveerd',
	'250' => 'Aangemeld voor Workshop NetWerken',
	'300' => 'JobGroup geplaatst',
	'310' => 'JobGroup iWIN geplaatst',
	'320' => 'JobGroup ZZP geplaatst',
	'400' => 'Jobgroup afgerond',
	'500' => 'Maatje aangemeld',
	'510' => 'Match-afspraak gemaakt',
	'520' => 'Begeleidingsovereenkomst getekend en gearchiveerd',
	'550' => 'Groepsmaatje',
	'750' => 'Dolaard',
	'800' => 'Uitstroom',
	'810' => 'Uitstroom naar Werk/Opleiding',
	'820' => 'Kopie contract aangeleverd',
	'900' => 'Afronding',
	'910' => 'Evaluatie-formulier verzonden',
	'920' => 'Afzwaaibrief verzonden',
	'950' => 'Uitgeschreven'
);

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
	$_SESSION['werkzkd_id'] = $_GET['id'];
	else
	{
		if(!isset($_SESSION['werkzkd_id'])) $_SESSION['werkzkd_id'] = '15';
	}

if (isset($_POST['backWzBut']) && $_POST['backWzBut'] == 'back')
{
	header("location: overz_werkzoekenden.php");
	exit();	
}

$wkz = new Werkzoekende('id', $_SESSION['werkzkd_id']);

if (isset($_POST['deleteWzBut']) && $_POST['deleteWzBut'] == 'delete')
{
	// echo '<script>alert("De gegevens zijn in de database opgenomen."); window.location.href ="http://jhmintra:8888/beheer/overz_werkzoekenden.php";</script>';
	$wkz->delind = 'j';
	$wkz->updateToDB();
	header("location: overz_werkzoekenden.php");
	exit();	
}

if (isset($_POST['updateWzBut']) && $_POST['updateWzBut'] == 'wijzig')
{
	$wkz_nw = clone $wkz;
	$wkz_nw->voornaam				= $_POST['voornaam'];
	$wkz_nw->achternaam				= $_POST['achternaam'];
	$wkz_nw->tussenvoegsels			= $_POST['tussenvoegsels'];
	$wkz_nw->geslacht				= $_POST['geslacht'];
	$wkz_nw->straat					= $_POST['straat'];
	$wkz_nw->huisnummer				= $_POST['huisnummer'];
	$wkz_nw->postcode				= $_POST['postcode'];
	$wkz_nw->woonplaats				= $_POST['woonplaats'];
	$wkz_nw->emailadres				= $_POST['emailadres'];
	$wkz_nw->telefoonnr				= $_POST['telefoonnr'];
	$wkz_nw->link_linkedin			= $_POST['link_linkedin'];
	if ($_POST['date_geboorte'] != '')
	{
		if (preg_match("/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/", $_POST['date_geboorte']) !== 0)
		{
			$date = DateTime::createFromFormat('d-m-Y', $_POST['date_geboorte']);
			$wkz_nw->date_geboorte		= $date->format('Y-m-d');
		} 
	} else
	{
		$wkz_nw->date_geboorte		= '';
	}
	// $wkz_nw->picfile				= $_POST['picfile'];
	if(isset($_POST['nnind'])) $wkz_nw->nnind = 'j'; else $wkz_nw->nnind = 'n';
	$wkz_nw->startsituatie			= $_POST['startsituatie'];
	if(isset($_POST['GAKind'])) $wkz_nw->GAKind = 'j'; else $wkz_nw->GAKind = 'n';
	$wkz_nw->opleiding				= $_POST['opleiding'];
	$wkz_nw->instroomtrede			= $_POST['instroomtrede'];
	$wkz_nw->instroomscore			= $_POST['instroomscore'];
	$wkz_nw->uitstroomscore			= $_POST['uitstroomscore'];
	$wkz_nw->soortwerk				= $_POST['soortwerk'];
	$wkz_nw->id_maatje				= $_POST['id_maatje'];
	$wkz_nw->toelichting			= $_POST['wztoelichting'];
	
	if ($wkz_nw != $wkz)
	{
		$wkz_nw->updateToDB();
	} 
	/* start de page opnieuw om een tweede update te voorkomen */
	header("location: mut_persoon.php");
	exit();	
}

if (isset($_POST['savePsBut']) && $_POST['savePsBut'] == 'bewaar')
{
	if (isset($_POST['psstatus']) && $_POST['psstatus'] != '---')
	{
		$newPs= new Processtap();
		$newPs->id_user = $curr_user->id;
		$newPs->id_werkzkd = $_SESSION['werkzkd_id'];
		$date = new DateTime();
		$newPs->dt_stap = $date->format('Y-m-d H:i:s');
		$newPs->wzstatus = $_POST['psstatus'];	
		// $newPs->drstrnaar = $_POST['drstrnaar'];	
		$newPs->toelichting = $_POST['pstoelichting'];
		$newPs->saveToDB();	
		
		$wkz->status = $_POST['psstatus'];
		$wkz->updateToDB();
	}
	unset($_POST['savePsBut']);
	/* start de page opnieuw om een tweede update te voorkomen */
	header("location: mut_persoon.php");
	exit();	
}

$arr1 = array ();
$arr2 = array ();
$jhmz = new Maatje_coll ($arr1, $arr2);
$maatjesLijst = $jhmz->maatjesList();
$maatjesListHTML = '<option value="">---</option>';;
// print_r($maatjesLijst);
foreach ($maatjesLijst as $maatje)
{
	if($wkz->id_maatje == $maatje[0]) $sel = 'selected'; else $sel = '';
	$maatjesListHTML .= '<option value="' . $maatje[0] . '" ' . $sel . '>' . $maatje[1] . '</option>';
}

/* Haal alle stappen op */
$sql = 'SELECT processtap.* FROM processtap WHERE processtap.id_werkzkd = ' . $_SESSION['werkzkd_id'] . ' ORDER BY processtap.dt_stap DESC;';
$psList = array();
global $connection;
try
{
	openDB();
	$stmt = $connection->prepare( $sql);
	$stmt->execute();
	$rows = $stmt->fetchAll();
	foreach ($rows as $row)
	{
		$ps = new Processtap ($row);
		$psList[] = $ps;
	}
} catch (PDOException $e) 
{
	  error_log('Connectie (processtap 1 in mut_persoon.php) met de database mislukt: ' . $e->getMessage());
	  return FALSE;
}

/* Haal alle opmerkingen op */
$ps_html = '';
foreach ($psList as $ps)
{
	$user = new User('id', $ps->id_user);
	$ps_html .= 
		'<div><div class="input-group-text" style="font-size: .8em; display: inline-block;">' . $ps->dt_stap . '</div>
		<div class="input-group-text" style="font-size: .8em; display: inline-block;">' . $user->username . '</div>
		<div class="input-group-text mb-1" style="font-size: .8em; display: inline-block;">' .  $ps->wzstatus . ' - ' . (isset($statusArray[$ps->wzstatus]) ? $statusArray[$ps->wzstatus] : 'onbekend') . '</div></div>';
	if ($ps->toelichting != '')
	{
		$ps_html .=
		'<div class="input-group input-group-sm mb-1">
	    	<div class="input-group-prepend" style="width: 30%;">
			<span class="input-group-text" style="width: 100%;">Toelichting</span>
	    	</div>
	    	<textarea type="textarea" rows="3" class="form-control" disabled>' . $ps->toelichting . '</textarea>
		</div>';
	}
}

?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>				
		<!-- <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css">
		<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script> -->
		<style>
		.scrolling-wrapper {
			  overflow-x: scroll;
			  overflow-y: hidden;
			  white-space: nowrap;
			
			  .card {
				display: inline-block;
			  }
			}
		.scrolling-wrapper-flexbox {
			  display: flex;
			  flex-wrap: nowrap;
			  overflow-x: auto;
			
			  .card {
				flex: 0 0 auto;
			  }
			}
			input.invalid, textarea.invalid{
				border: 2px solid red;
			}
			
			input.valid, textarea.valid{
				border: 2px solid green;
			}
		</style>
		<script>
		$(document).ready(function() {
			$('#date_geboorte').on('input', function() {
				var input=$(this);
				var datum= input.val();
				if (datum.substr(0, 2) > 0 && datum.substr(0, 2) < 32 && datum.substr(3, 2) > 0 && datum.substr(3, 2) < 13 && datum.substr(6, 4) > 1940 && datum.substr(6, 4) < 2004 && datum.substr(2, 1) == '-' && datum.substr(5, 1) == '-')
					{input.removeClass("invalid").addClass("valid");}
				else
					{input.removeClass("valid").addClass("invalid");}
			});
		});
		</script>
	</head>
	<body style="background-color: #dddddd;">
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container-fluid"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto text-capitalize">Persoonsgegevens</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
        <!-- <div class="container">
            <div class="row mt-4">
				<div class="col-md-12 p-0">
					<button type="button" class="btn btn-primary" style="width: 120px;"><a class="text-white" href="beheer.php">terug</a></button>
	            </div>
            </div>
        </div> -->
        <div class="container-fluid" style="padding-bottom: 80px;">	
			<form method="POST" action="mut_persoon.php" id="postwz" novalidate>
			<div class="row">
				<div class="col-lg-4 mt-2 pt-2" style="background-color:#a5cad8">
					<img class="card-img-top mb-2" src="fotoos_wkz/<?php echo $wkz->picfile; ?>" style="max-width: 160px;" alt="">

					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Voornaam</span>
						</div>
						<input type="text" name="voornaam" class="form-control" value="<?php echo $wkz->voornaam; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Tussenvoegsels</span>
						</div>
						<input type="text" name="tussenvoegsels" class="form-control" value="<?php echo $wkz->tussenvoegsels; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Achternaam</span>
						</div>
						<input type="text" name="achternaam" class="form-control" value="<?php echo $wkz->achternaam; ?>" required>
					</div>
					<div class="input-group input-group-sm mb-1">
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
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Id person</span>
						</div>
						<input type="text" name="id_person" class="form-control" disabled value="<?php echo $wkz->id_person; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Datum/tijd nieuw</span>
						</div>
						<input type="text" name="datetime_created" class="form-control" disabled value="<?php echo $wkz->datetime_created; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Datum/tijd gewijzigd</span>
						</div>
						<input type="text" name="datetime_modified" class="form-control" disabled value="<?php echo $wkz->datetime_modified; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Emailadres</span>
						</div>
						<input type="email" name="emailadres" class="form-control" value="<?php echo $wkz->emailadres; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Telefoonnummers</span>
						</div>
						<input type="telnr" name="telefoonnr" class="form-control" value="<?php echo $wkz->telefoonnr; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">URL LinkedIn</span>
						</div>
						<input type="text" name="link_linkedin" class="form-control" value="<?php echo $wkz->link_linkedin; ?>"></a>
					</div>					
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Straat</span>
						</div>
						<input type="text" name="straat" class="form-control" value="<?php echo $wkz->straat; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Huisnummer</span>
						</div>
						<input type="text" name="huisnummer" class="form-control" value="<?php echo $wkz->huisnummer; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Postcode</span>
						</div>
						<input type="text" name="postcode" class="form-control" value="<?php echo $wkz->postcode; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Woonplaats</span>
						</div>
						<input type="text" name="woonplaats" class="form-control" value="<?php echo $wkz->woonplaats; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Geboortedatum</span>
						</div>
						<input type="text" name="date_geboorte" id="date_geboorte" class="form-control" value="<?php 
						// error_log ($wkz->date_geboorte);
						if ($wkz->date_geboorte == '') echo ''; else echo (DateTime::createFromFormat('Y-m-d', $wkz->date_geboorte))->format('d-m-Y'); ?>" maxlength="10" placeholder="dd-mm-jjjj">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Leeftijd</span>
						</div>
						<input type="text" class="form-control" value="<?php if ($wkz->date_geboorte != '') echo calculateAge($wkz->date_geboorte); else echo ''; ?>" disabled>
					</div>

				</div>


				<div class="col-lg-4 mt-2 pt-2" style="background-color:#a5cad8">
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Id werkzoekende</span>
						</div>
						<input type="text" name="id" class="form-control" disabled value="<?php echo $wkz->id; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Status</span>
						</div>
						<input type="text" name="wzstatus" class="form-control" disabled value="<?php echo $wkz->status . ' - ' . (isset($statusArray[$wkz->status]) ? $statusArray[$wkz->status] : 'onbekend'); ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Situatie bij aanmelding</span>
						</div>
						<textarea type="textarea" name="situatie" rows="5" class="form-control" value="" disabled><?php echo $wkz->situatie; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Opmerkingen bij aanmelding</span>
						</div>
						<textarea type="textarea" name="opmerkingen" rows="5" class="form-control" value="" disabled><?php echo $wkz->opmerkingen; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Startsituatie</span>
						</div>
						<select class="form-control"  name="startsituatie" id="startsituatie">
							<option value="" <?php if($wkz->startsituatie == '') echo 'selected'; ?>>---</option>
							<option value="nug" <?php if($wkz->startsituatie == 'nug') echo 'selected'; ?>>Niet uitkering gerechtigd</option>
							<option value="wkw" <?php if($wkz->startsituatie == 'wkw') echo 'selected'; ?>>WW</option>
							<option value="wrk" <?php if($wkz->startsituatie == 'wrk') echo 'selected'; ?>>Werk</option>
							<option value="zkw" <?php if($wkz->startsituatie == 'zkw') echo 'selected'; ?>>Ziektewet</option>
							<option value="bst" <?php if($wkz->startsituatie == 'bst') echo 'selected'; ?>>Bijstand</option>
							<option value="wza" <?php if($wkz->startsituatie == 'wza') echo 'selected'; ?>>WIA</option>
							<option value="zzp" <?php if($wkz->startsituatie == 'zzp') echo 'selected'; ?>>ZZP</option>
						</select>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Nieuwe Nederlander</span>
						</div>
						<input type="checkbox" name="nnind" class="form-control" value="j" <?php if($wkz->nnind == 'j') echo ' checked'; ?>>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">GAK</span>
						</div>
						<input type="checkbox" name="GAKind" class="form-control" value="j" <?php if($wkz->GAKind == 'j') echo ' checked'; ?>>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Opleiding</span>
						</div>
						<select class="form-control"  name="opleiding" id="opleiding">
							<option value="" <?php if($wkz->opleiding == '') echo 'selected'; ?>>---</option>
							<option value="GO" <?php if($wkz->opleiding == 'GO') echo 'selected'; ?>>Geen opleiding</option>
							<option value="VMBO" <?php if($wkz->opleiding == 'VMBO/Mavo') echo 'selected'; ?>>VMBO/Mavo</option>
							<option value="Havo" <?php if($wkz->opleiding == 'Havo') echo 'selected'; ?>>Havo</option>
							<option value="VWO" <?php if($wkz->opleiding == 'VWO') echo 'selected'; ?>>VWO</option>
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
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Instroomtrede</span>
						</div>
						<input type="text" name="instroomtrede" class="form-control" value="<?php echo $wkz->instroomtrede; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Instroomscore</span>
						</div>
						<input type="text" name="instroomscore" class="form-control"  value="<?php echo $wkz->instroomscore; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Uitstroomscore</span>
						</div>
						<input type="text" name="uitstroomscore" class="form-control" value="<?php echo $wkz->uitstroomscore; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Soort werk</span>
						</div>
						<input type="text" name="soortwerk" class="form-control" value="<?php echo $wkz->soortwerk; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Maatje</span>
						</div>
						<select class="form-control"  name="id_maatje">
							<?php echo $maatjesListHTML; ?>
						</select>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Toelichting</span>
						</div>
						<textarea type="textarea" name="wztoelichting" rows="5" class="form-control" value=""><?php echo $wkz->toelichting; ?></textarea>
					</div>
					<div class="forms-group mb-1">
						<button name="updateWzBut" value="wijzig" type="submit" class="btn btn-primary btn-width btn-sm">Wijzig</button>
						<button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button>
						<button name="deleteWzBut" value="delete" type="submit" class="btn btn-danger btn-width btn-sm" style="float: right;">Delete</button>
					</div>
				</div>


				<div class="col-lg-4 mt-2 pt-2 bg-light">
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Status</span>
						</div>
						<select class="form-control"  name="psstatus" id="psstatus">
							<?php
							$optionHtml = '';
							foreach ($statusArray as $i => $status)
							{
								$optionHtml .= '<option value="' . $i . '">' . $i . ' - ' . $status . '</option>'; 
							}
							echo $optionHtml;
							?>
						</select>
						<!-- <input type="text" name="psstatus" class="form-control" value=""> -->
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Toelichting</span>
						</div>
						<textarea type="textarea" name="pstoelichting" rows="5" class="form-control" value=""></textarea>
					</div>
					<div class="forms-group mb-1">
						<button name="savePsBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
						<button name="resetPsBut" value="reset" type="submit" class="btn btn-secondary btn-width btn-sm">Cancel</button>
					</div>
					<?php echo $ps_html; ?>
				</div>
				</form>
			</div>
		<!-- </form> -->
		</div>
		<!-- <div class="container">
			<div class="d-flex flex-row">
				<div class="input-group input-group-sm mb-1">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Instroomscore</span>
					</div>
					<input type="text" name="instroomscore" class="form-control"  value="<?php // echo $wkz->instroomscore; ?>">
				</div>
				<div class="input-group input-group-sm mb-1">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Uitstroomscore</span>
					</div>
					<input type="text" name="uitstroomscore" class="form-control" value="<?php // echo $wkz->uitstroomscore; ?>">
				</div>
				<div class="input-group input-group-sm mb-1">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Soort werk</span>
					</div>
					<input type="text" name="soortwerk" class="form-control" value="<?php // echo $wkz->soortwerk; ?>">
				</div>
				<div class="input-group input-group-sm mb-1">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Toelichting</span>
					</div>
					<textarea type="textarea" name="wztoelichting" rows="5" class="form-control" value=""><?php // echo $wkz->toelichting; ?></textarea>
				</div>
			</div>
			<div class="row">
			</div>
		</div> -->
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
