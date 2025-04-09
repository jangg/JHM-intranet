<?php
include_once('../config.php');
include_once('../class/c_tools.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende.php');
include_once('../class/c_processtap.php');
include_once('../class/c_aantekening.php');
include_once('../class/c_maatje_coll.php');
include_once('../class/c_jobgroup_coll.php');

$nbrPS = 0;
$nbrAant = 0;

function addPS ($user_id, $statuscode, $toelichting)
{
	$newPs= new Processtap();
	$newPs->id_user = $user_id;
	$newPs->id_werkzkd = $_SESSION['werkzkd_id'];
	$date = new DateTime();
	$newPs->dt_stap = $date->format('Y-m-d H:i:s');
	$newPs->wzstatus = $statuscode;	
	// $newPs->drstrnaar = $_POST['drstrnaar'];	
	$newPs->toelichting = $toelichting;
	$result = $newPs->saveToDB();
}

function getMaatjeName ($id)
{
	$maatje = new Maatje ('id', $id);
	if ($maatje->id == '' || $maatje->id == NULL)
		return 'Geen';
	else
		return ($maatje->voornaam . ' ' . $maatje->tussenvoegsels . ' ' . $maatje->achternaam);
}

function getJgName ($id)
{
	$jobgroup = new Jobgroup ('id', $id);
	if ($jobgroup->id == '' || $jobgroup->id == NULL)
		return 'Geen';
	else
		return ($jobgroup->titel);
}

function getAllPs()
{
	global $nbrPS;
	$statusArray = Tools::getStatusArray();
	
	$sql = 'SELECT processtap.* FROM processtap WHERE processtap.id_werkzkd = ' . $_SESSION['werkzkd_id'] . ' AND processtap.delind = "n" ORDER BY processtap.dt_stap DESC;';
	$psList = array();
	global $connection;
	try
	{
		global $nbrPS;
		openDB();
		$stmt = $connection->prepare( $sql);
		$stmt->execute();
		$rows = $stmt->fetchAll();		
		$nbrPS = count($rows);
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
		$user = new User('histid', $ps->id_user);
		$ps_html .= 
		'<div class="processtap" style="border: solid 2px #979a97; border-radius: 4px; margin: 3px 0px;">
		<div style="background-color: #a5cad8; color: #3c3c3c;">
		<div class="" style="font-size: .8em; display: inline-block; padding: 0px 10px; width: 20%; vertical-align: top;">' . Tools::ConvertTS($ps->dt_stap) . '</div>
		<div class="" style="font-size: .8em; display: inline-block; padding: 0px 10px; width: 10%; vertical-align: top;">' . $user->username . '</div>
		<div class="" style="font-size: .8em; display: inline-block; padding: 0px 10px; width: 50%; vertical-align: top;">' .  $ps->wzstatus . ' - ' . (isset($statusArray[$ps->wzstatus]) ? $statusArray[$ps->wzstatus] : 'Verandering') . '</div>
		<div class="" style="font-size: .8em; display: inline-block; padding: 0px 10px; float: right; vertical-align: top;"><button class="psdel" data-idps=' . $ps->id . '><i class="fa fa-trash-alt ifont"></i></button></div>
		</div>';
		if ($ps->toelichting != '')
		{
			$ps_html .=
			'<div class="" style="background-color: #e8eeea; color: #757775;">
				<div class="" style="font-size: .8em; display: inline-block; padding: 0px 10px; white-space: pre-line;">' . $ps->toelichting . '</div>
			</div>';
		}
		$ps_html .= '</div>';
	}
	return $ps_html;	
}

function getAllAant()
{
	global $nbrAant;
	$sql = 'SELECT aantekening.* FROM aantekening WHERE aantekening.id_werkzkd = ' . $_SESSION['werkzkd_id'] . ' AND aantekening.delind = "n" ORDER BY aantekening.datetime_created DESC;';
	$aantList = array();
	global $connection;
	try
	{
		openDB();
		$stmt = $connection->prepare( $sql);
		$stmt->execute();
		$rows = $stmt->fetchAll();
		$nbrAant = count($rows);
		foreach ($rows as $row)
		{
			$aant = new Aantekening ($row);
			$aantList[] = $aant;
		}
	} catch (PDOException $e) 
	{
		  error_log('Connectie (aantekening 1 in mut_persoon.php) met de database mislukt: ' . $e->getMessage());
		  return FALSE;
	}
	
	/* Haal alle aantekeningen op */
	$aant_html = '';
	foreach ($aantList as $aant)
	{
		$user = new User('histid', $aant->id_user);
		$aant_html .= 
			'<div><div class="input-group-text" style="font-size: .8em; display: inline-block;">' . Tools::ConvertTS($aant->datetime_created) . '</div>
			<div class="input-group-text" style="font-size: .8em; display: inline-block;">' . $user->username . '</div>';
			$aant_html .=
			'<div class="input-group input-group-sm mb-1">
				<div class="input-group-prepend" style="width: 30%;">
				<span class="input-group-text" style="width: 100%;">Aantekening</span>
				</div>
				<textarea type="textarea" rows="7" class="form-control" disabled>' . $aant->tekst . '</textarea>
			</div></div>';
	}
	return $aant_html;	
}

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
	if (isset($_SESSION['jobgroup_id']))
		header("location: mut_jobgroup.php?id=" . $_SESSION['jobgroup_id']);
	else
	{
		if (isset($_SESSION['maatje_id']))
		header("location: mut_maatje.php?id=" . $_SESSION['maatje_id']);
		else
		header("location: overz_werkzoekenden.php");
		exit();	
	}
		
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
	if($curr_user->beheerind >= 9)
		$wkz_nw->picfile					= $_POST['picfile'];
	$wkz_nw->voornaam						= $_POST['voornaam'];
	$wkz_nw->achternaam					= $_POST['achternaam'];
	$wkz_nw->tussenvoegsels				= $_POST['tussenvoegsels'];
	$wkz_nw->geslacht						= $_POST['geslacht'];
	$wkz_nw->straat						= $_POST['straat'];
	$wkz_nw->huisnummer					= $_POST['huisnummer'];
	$wkz_nw->postcode						= $_POST['postcode'];
	$wkz_nw->woonplaats					= $_POST['woonplaats'];
	$wkz_nw->emailadres					= $_POST['emailadres'];
	$wkz_nw->telefoonnr					= $_POST['telefoonnr'];
	$wkz_nw->link_linkedin				= $_POST['link_linkedin'];
	if (Tools::checkDate($_POST['date_geboorte'], 'jjjj-mm-dd'))
		$wkz_nw->date_geboorte			= $_POST['date_geboorte'];
	if(isset($_POST['nnind'])) $wkz_nw->nnind = 'j'; else $wkz_nw->nnind = 'n';
	if (Tools::checkDate($_POST['date_aanmelding'], 'jjjj-mm-dd'))
		$wkz_nw->date_aanmelding		= $_POST['date_aanmelding'];
	if (Tools::checkDate($_POST['date_uitstroom'], 'jjjj-mm-dd'))
		$wkz_nw->date_uitstroom			= $_POST['date_uitstroom'];
	if ($_POST['date_uitstroom'] == '')
		$wkz_nw->date_uitstroom			= NULL;
	$wkz_nw->startsituatie				= $_POST['startsituatie'];
	if(isset($_POST['GAKind'])) $wkz_nw->GAKind = 'j'; else $wkz_nw->GAKind = 'n';
	if(isset($_POST['DBBind'])) $wkz_nw->DBBind = 'j'; else $wkz_nw->DBBind = 'n';
	$wkz_nw->opleiding					= $_POST['opleiding'];
	$wkz_nw->instroomtrede				= $_POST['instroomtrede'];
	$wkz_nw->instroomscore				= $_POST['instroomscore'];
	$wkz_nw->uitstroomscore				= $_POST['uitstroomscore'];
	$wkz_nw->soortwerk					= $_POST['soortwerk'];
	
	if($_POST['id_maatje'] == '') 
		$post_id_maatje = 0;
	else
		$post_id_maatje = $_POST['id_maatje'];
	if ($post_id_maatje != $wkz_nw->id_maatje)
	{
		/**** Als id_maatje is gewijzigd moet er ook een processtap record worden gemaakt  **/
		addPS($curr_user->id, '999', ('Maatje veranderd: ' . getMaatjeName($wkz_nw->id_maatje) . ' ---> ' . getMaatjeName($post_id_maatje)));
		$wkz_nw->id_maatje = $post_id_maatje;
	}
	
	if($_POST['id_jobgroup'] == '') 
		$post_id_jobgroup = 0;
	else
		$post_id_jobgroup = $_POST['id_jobgroup'];
	if ($post_id_jobgroup != $wkz_nw->id_jobgroup)
	{
		/**** Als id_jobgroup is gewijzigd moet er ook een processtap record worden gemaakt  **/
		addPS($curr_user->id, '999', ('JobGroup veranderd: ' . getJgName($wkz_nw->id_jobgroup) . ' ---> ' . getJgName($post_id_jobgroup)));
		$wkz_nw->id_jobgroup = $post_id_jobgroup;
	} 
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
		addPS($curr_user->id, $_POST['psstatus'], $_POST['pstoelichting']);		
		$wkz->status = $_POST['psstatus'];
		if ($wkz->status >= '950' && $wkz->date_uitstroom == '')
		{
			$date = new DateTime();
			$wkz->date_uitstroom = $date->format('Y-m-d');
		}
		$wkz->updateToDB();
	}
	/* start de page opnieuw om een tweede update te voorkomen */
	header("location: mut_persoon.php");
	exit();	
}

if (isset($_POST['saveAtBut']) && $_POST['saveAtBut'] == 'bewaar')
{
	if (isset($_POST['tekst']) && $_POST['tekst'] != '')
	{
		$newAt= new Aantekening();
		$newAt->id_user = $curr_user->id;
		$newAt->id_werkzkd = $_SESSION['werkzkd_id'];
		$date = new DateTime();
		$newAt->datetime_created = $date->format('Y-m-d H:i:s');
		$newAt->tekst = $_POST['tekst'];
		$newAt->saveToDB();	
	}
	/* start de page opnieuw om een tweede update te voorkomen */
	header("location: mut_persoon.php");
	exit();	
}

$statusArray = Tools::getStatusArray();

/* Haal alle maatjes op */
$arr1 = array ();
$arr2 = array ();
$jhmz = new Maatje_coll ($arr1, $arr2);
$maatjesLijst = $jhmz->maatjesList();
$maatjesListHTML = '<option value="">---</option>';;
// print_r($maatjesLijst);
foreach ($maatjesLijst as $maatje)
{
	if($wkz->id_maatje == $maatje[0]) 
	{
		$sel = 'selected';
	}
	else $sel = '';
	$maatjesListHTML .= '<option value="' . $maatje[0] . '" ' . $sel . '>' . $maatje[1] . '</option>';
}

/* Haal alle beschikbare jobgroups op */
$arr1 = array ();
$arr2 = array (array (0 => 'jobgroup.startdate', 1 => 'ASC'));
$jhmz = new Jobgroup_coll ($arr1, $arr2);
$jobgroupLijst = $jhmz->jobgroupColl;
$jobgroupListHTML = '<option value="">---</option>';
foreach ($jobgroupLijst as $jobgroup)
{
	if ($jobgroup->status >= 200 && $jobgroup->status < 600)
	{
		if($wkz->id_jobgroup == $jobgroup->id) 
		{
			$sel = 'selected';
		}
		else $sel = '';
		$jobgroupListHTML .= '<option value="' . $jobgroup->id . '" ' . $sel . '>' . $jobgroup->titel . '</option>';
	}
}


?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>				
		<style>
			input.invalid, textarea.invalid{
				border: 2px solid red;
			}
			
			input.valid, textarea.valid{
				border: 2px solid green;
			}
			/* when not active use specificity to override the !important on border-(color) */
			.nav-tabs .nav-link:not(.active) {
				border-color: transparent !important;
				border-width: 3px;
				color: grey;
			}
			.but-size {
				width: 125px;
			}
		
		</style>
		<script>
		$(document).ready(function() {
			$("#date_geboorte" ).datepicker(
				{
					dateFormat: "yy-mm-dd",
					minDate: "1950-01-01",
					maxDate: "2005-12-31",
					yearRange: '1950:2005',
					changeMonth: true,
					changeYear: true,
				});
			$('div.ui-datepicker').css({ fontSize: '0.9em' });
			$('.psdel').on('click', function() 
			{
				const el = this;
				const deleteid = $(this).data('idps');
				if (confirm('Weet u het zeker?')) 
				{
					$.ajax(
					{
						url: 'proces_ps.php',
						type: 'POST',
						data:	{ idps: deleteid,
								  delPs: 'delete'
									},
						success: function(response)
						{
							$(el).closest('.processtap').css('background','tomato');
							$(el).closest('.processtap').fadeOut(800,function()
							{
									$(this).remove();
							});
							// alert('Het is gelukt!');
						}
					});
				}
			});
			$(".date" ).datepicker(
			{
				dateFormat: "yy-mm-dd",
				minDate: "2018-01-01",
				yearRange: '2018:2050',
				changeMonth: true,
				changeYear: true,
			});
			// $('div.ui-datepicker').css({ fontSize: '0.9em' });				
		});
		</script>
		
	</head>
	<body style="background-color: #dddddd;">
		
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container-fluid"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto">Werkzoekende gegevens</h1>
			</div>
			<div class="row rounded text-center text-white pb-2 mb-2">
				<div class="col-sm-12">
					<h4 class="mx-auto"><?php echo $wkz->voornaam . ' ' . $wkz->tussenvoegsels . ' ' . $wkz->achternaam; ?></h4>
				</div>
			</div>
		</div>
		<div class="container">
			<p>
				<!-- <a class="btn btn-primary but-size" href="wkz_pdf.php?id=<?php //echo $wkz->id; ?>" role="button">overzicht</a> -->
				<a class="btn btn-primary but-size" href="overz_werkzoekenden.php" role="button">terug</a>
			</p>
<!-- 			<form method="POST" action="mut_persoon.php" id="postwz" novalidate>
			<button name="backWzBut" value="back" type="submit" class="btn btn-primary btn-width btn-sm" style="width: 120px;">Terug</button>
			<button name="backWzBut" value="back" type="submit" class="btn btn-primary btn-width btn-sm" style="width: 120px;">Terug</button>
			</form> -->
			<!-- <a class="btn btn-primary but-size" href="overz_werkzoekenden.php" role="button">terug</a> -->
		</div>
        <div class="container-fluid" style="padding-bottom: 80px;">	
			<div class="row">
				<div class="col-lg-4 mt-2 pt-2" style="background-color: #a5cad8;">
					<form method="POST" action="mut_persoon.php" id="postwz" novalidate>
						<img class="card-img-top mb-2" src="../fotoos_wkz/
							<?php if($wkz->picfile == '') echo 'unknown.png'; else echo $wkz->picfile; ?>"
							style="max-width: 160px;" alt=""/>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text text-left text-wrap" style="width: 100%;">Filenaam foto</span>
						</div>
						<input type="text" name="picfile" class="form-control" value="<?php echo $wkz->picfile; ?>" <?php if ($curr_user->beheerind < 9) echo ' disabled'; ?>/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text text-left text-wrap" style="width: 100%;">Voornaam</span>
						</div>
						<input type="text" name="voornaam" class="form-control" value="<?php echo $wkz->voornaam; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Tussenvoegsels</span>
						</div>
						<input type="text" name="tussenvoegsels" class="form-control" value="<?php echo $wkz->tussenvoegsels; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Achternaam</span>
						</div>
						<input type="text" name="achternaam" class="form-control" value="<?php echo $wkz->achternaam; ?>" required/>
					</div>
					<div class="input-group input-group-sm mb-1">
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
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Id person</span>
						</div>
						<input type="text" name="id_person" class="form-control" disabled value="<?php echo $wkz->id_person; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Datum/tijd nieuw</span>
						</div>
						<input type="text" name="datetime_created" class="form-control ps-date" disabled value="<?php echo Tools::ConvertTS($wkz->datetime_created); ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Datum/tijd gewijzigd</span>
						</div>
						<input type="text" name="datetime_modified" class="form-control" disabled value="<?php echo Tools::ConvertTS($wkz->datetime_modified); ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Emailadres</span>
						</div>
						<input type="email" name="emailadres" class="form-control" value="<?php echo $wkz->emailadres; ?>"/>
						<?php if ($wkz->emailadres != ''): ?>
							<a href="mailto: <?php echo $wkz->emailadres; ?>" target="_blank"><i class="fas fa-envelope" style="font-size: 2em;"></i></a>
						<?php endif; ?>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Telefoonnummer</span>
						</div>
						<input type="text" name="telefoonnr" class="form-control" value="<?php echo $wkz->telefoonnr; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">URL LinkedIn</span>
						</div>
						<input type="text" name="link_linkedin" class="form-control" value="<?php echo $wkz->link_linkedin; ?>"/>
						<?php if ($wkz->link_linkedin != ''): ?>
							<a href="<?php echo $wkz->link_linkedin; ?>" target="_blank"><i class="fab fa-linkedin" style="font-size: 2em;"></i></a>
						<?php endif; ?>
					</div>					
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Straat</span>
						</div>
						<input type="text" name="straat" class="form-control" value="<?php echo $wkz->straat; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Huisnummer</span>
						</div>
						<input type="text" name="huisnummer" class="form-control" value="<?php echo $wkz->huisnummer; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Postcode</span>
						</div>
						<input type="text" name="postcode" class="form-control" value="<?php echo $wkz->postcode; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Woonplaats</span>
						</div>
						<input type="text" name="woonplaats" class="form-control" value="<?php echo $wkz->woonplaats; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Geboortedatum</span>
						</div>
						<input type="text" name="date_geboorte" id="date_geboorte" class="form-control" value="<?= $wkz->date_geboorte; ?>"></p>
						<!-- <input type="text" name="date_geboorte" id="date_geboorte" class="form-control" value="<?php 
						// error_log ($wkz->date_geboorte);
						// echo $wkz->date_geboorte; ?>" maxlength="10" placeholder="jjjj-mm-dd"> -->
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Leeftijd</span>
						</div>
						<input type="text" class="form-control" value="<?php if ($wkz->date_geboorte != '') echo Tools::calculateAge($wkz->date_geboorte); else echo ''; ?>" disabled>
					</div>
				</div>
				<div class="col-lg-4 mt-2 pt-2" style="background-color:#a5cad8">
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text text-left text-wrap" style="width: 100%;">Id werkzoekende</span>
						</div>
						<input type="text" name="id" class="form-control" disabled value="<?php echo $wkz->id; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Status</span>
						</div>
						<input type="text" name="wzstatus" class="form-control" disabled value="<?php echo $wkz->status . ' - ' . (isset($statusArray[$wkz->status]) ? $statusArray[$wkz->status] : 'onbekend'); ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Datum aanmelding</span>
						</div>
						<input type="text" name="date_aanmelding" class="form-control date" value="<?= $wkz->date_aanmelding; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Situatie bij aanmelding</span>
						</div>
						<textarea type="textarea" name="situatie" rows="5" class="form-control" value="" disabled><?php echo $wkz->situatie; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Opmerkingen bij aanmelding</span>
						</div>
						<textarea type="textarea" name="opmerkingen" rows="5" class="form-control" value="" disabled><?php echo $wkz->opmerkingen; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Startsituatie</span>
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
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">De Binnenbaan</span>
						</div>
						<input type="checkbox" name="DBBind" class="form-control" value="j" <?php if($wkz->DBBind == 'j') echo ' checked'; ?>>
					</div>

					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Opleiding</span>
						</div>
						<select class="form-control"  name="opleiding" id="opleiding">
							<option value="" <?php if($wkz->opleiding == '') echo 'selected'; ?>>---</option>
							<option value="GO" <?php if($wkz->opleiding == 'GO') echo 'selected'; ?>>Geen opleiding</option>
							<option value="VMBO" <?php if($wkz->opleiding == 'VMBO/Mavo') echo 'selected'; ?>>VMBO/Mavo</option>
							<option value="Havo" <?php if($wkz->opleiding == 'Havo') echo 'selected'; ?>>Havo</option>
							<option value="VWO" <?php if($wkz->opleiding == 'VWO') echo 'selected'; ?>>VWO</option>
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
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Instroomtrede</span>
						</div>
						<input type="text" name="instroomtrede" class="form-control" value="<?php echo $wkz->instroomtrede; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Instroomscore</span>
						</div>
						<input type="text" name="instroomscore" class="form-control"  value="<?php echo $wkz->instroomscore; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Uitstroomscore</span>
						</div>
						<input type="text" name="uitstroomscore" class="form-control" value="<?php echo $wkz->uitstroomscore; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Soort werk</span>
						</div>
						<input type="text" name="soortwerk" class="form-control" value="<?php echo $wkz->soortwerk; ?>"/>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Maatje</span>
						</div>
						<select class="form-control"  name="id_maatje">
							<?php echo $maatjesListHTML; ?>
						</select>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Jobgroup</span>
						</div>
						<select class="form-control"  name="id_jobgroup" id="jobgroup">
							<?php echo $jobgroupListHTML; ?>
						</select>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Toelichting</span>
						</div>
						<textarea type="textarea" name="wztoelichting" rows="5" class="form-control" value=""><?php echo $wkz->toelichting; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Datum uitstroom</span>
						</div>
						<input type="text" name="date_uitstroom" class="form-control date" value="<?= $wkz->date_uitstroom; ?>"/>
					</div>
					<div class="forms-group mb-1">
						<button name="updateWzBut" value="wijzig" type="submit" class="btn btn-primary btn-width btn-sm">Wijzig</button>
						<!-- <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button> -->
						<!-- <button name="deleteWzBut" value="delete" type="submit" class="btn btn-danger btn-width btn-sm" style="float: right;">Delete</button> -->
					</div>
					</form>
				</div>		
				
				<div class="col-lg-4 mt-2 pt-2 bg-light">
					<?php $htmlPs = getAllPs(); 
						  $htmlAant = getAllAant(); ?>
					<ul class="nav nav-tabs nav-justified">
						<li class="nav-item"><a class="nav-link border border-primary border-bottom-0 active" data-toggle="tab" href="#statusreg">Statusregels (<?= $nbrPS ?>)</a></li>
						<li class="nav-item"><a class="nav-link border border-primary border-bottom-0" data-toggle="tab" href="#aantek">Aantekeningen (<?= $nbrAant ?>)</a></li>						
					</ul>
					<div class="tab-content">
						<div class="tab-pane container mx-0 px-0 mt-2" id="aantek">
							<form method="POST" action="mut_persoon.php" id="postaant" novalidate>
							<div class="input-group input-group-sm mb-1">							
								<div class="input-group-prepend" style="width: 30%;">
									<span class="input-group-text text-left text-wrap" style="width: 100%;">Aantekening</span>
								</div>
								<textarea type="textarea" name="tekst" rows="10" class="form-control" value=""></textarea>
							</div>
							<div class="forms-group mb-1">
								<button name="saveAtBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
								<button name="resetAtBut" value="reset" type="submit" class="btn btn-secondary btn-width btn-sm">Cancel</button>
							</div>
							</form>
							<?php echo $htmlAant; ?>
						</div>
						<div class="tab-pane container mx-0 px-0 mt-2 active" id="statusreg">
							<form method="POST" action="mut_persoon.php" id="postps" novalidate>
							<div class="input-group input-group-sm mb-1">							
								<div class="input-group-prepend" style="width: 30%;">
									<span class=" input-group-text text-left text-wrap" style="width: 100%;">Status</span>
								</div>
								<select class="form-control"  name="psstatus" id="psstatus">
								<?php
								$optionHtml = '';
								foreach ($statusArray as $i => $status)
								{
									$optionHtml .= '<option ';
									// if ($i < $wkz->status) $optionHtml .= 'disabled '; 				24-10-2 Statussen mogen	weer random wordt toegekend				
									$optionHtml .= 'value="' . $i . '">' . $i . ' - ' . $status . '</option>'; 
								}
								echo $optionHtml;
								?>
								</select>
							</div>
							<div class="input-group input-group-sm mb-1">							
								<div class="input-group-prepend" style="width: 30%;">
									<span class="input-group-text text-left text-wrap" style="width: 100%;">Toelichting</span>
								</div>
								<textarea type="textarea" name="pstoelichting" rows="5" class="form-control" value=""></textarea>
							</div>
							<div class="forms-group mb-1">
								<button name="savePsBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
								<button name="resetPsBut" value="reset" type="submit" class="btn btn-secondary btn-width btn-sm">Cancel</button>
							</div>
							</form>
							<?php echo $htmlPs; ?>
						</div>
					</div>
				</div>				
			</div>
		</div>
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
