<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende.php');
include_once('../class/c_intakeform.php');

function updateIntakeform ($wkz, $wkz_nw, $intakeform, $intakeform_nw)
{
	if ($intakeform_nw != $intakeform)
	{
		if ($intakeform_nw->id == '')
		{
			$intakeform_nw->saveToDB($wkz_nw->id);
			$wkz_nw->id_intakeform = $intakeform_nw->id;
		}
		else 
		{
			$intakeform_nw->updateToDB();
		}
	} 
	if ($wkz_nw != $wkz)
	{
		$wkz_nw->updateToDB();
	}
	return TRUE;
}

if (isset($_POST['backWzBut']) && $_POST['backWzBut'] == 'back')
{
	header("location: overz_werkzoekenden.php");
	exit();	
}

$wkz = new Werkzoekende ();
$intakeform = new Intakeform ();
if (isset($_GET['id']) && is_numeric($_GET['id']))
{
	$wkz = new Werkzoekende ('id', $_GET['id']);
	if ($wkz->id_intakeform != NULL)
	{
		$intakeform = new Intakeform ('id', $wkz->id_intakeform);
	}
}
// error_log ($wkz . $intakeform);
if (isset($_POST['saveWzBut']))
{
	$wkz_nw = clone $wkz;
	$intakeform_nw = clone $intakeform;
	
	switch ($_POST['saveWzBut']) 
	{
		case 'bewaar1':
			$wkz_nw->voornaam				= $_POST['voornaam'];
			$wkz_nw->achternaam				= $_POST['achternaam'];
			$wkz_nw->tussenvoegsels			= $_POST['tussenvoegsels'];
			$wkz_nw->geslacht				= $_POST['geslacht'];
			$intakeform_nw->roepnaam		= $_POST['roepnaam'];
			$wkz_nw->straat					= $_POST['straat'];
			$wkz_nw->huisnummer				= $_POST['huisnummer'];
			$wkz_nw->postcode				= $_POST['postcode'];
			$wkz_nw->woonplaats				= $_POST['woonplaats'];
			$wkz_nw->telefoonnr				= $_POST['telefoonnr'];
			$wkz_nw->link_linkedin			= $_POST['link_linkedin'];
			if ($_POST['gebdatum'] != '')
			{
				if (preg_match("/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/", $_POST['gebdatum']) !== 0)
				{
					$date = DateTime::createFromFormat('d-m-Y', $_POST['gebdatum']);
					$wkz_nw->date_geboorte		= $date->format('Y-m-d');
				} 
			} else
			{
				$wkz_nw->date_geboorte			= '';
			}
			$intakeform_nw->gebplaats		= $_POST['gebplaats'];
			$intakeform_nw->gebland			= $_POST['gebland'];
			$intakeform_nw->nationaliteit	= $_POST['nationaliteit'];
			if (isset($_POST['legitimatieind']) && $_POST['legitimatieind'] == 'j') 
				$intakeform_nw->legitimatieind = 'j'; 
				else $intakeform_nw->legitimatieind = 'n';
			break;
		case 'bewaar3':
			$intakeform_nw->relatie			= $_POST['relatie'];
			$intakeform_nw->volw_kind		= $_POST['volw_kind'];
			$intakeform_nw->partner_beroep	= $_POST['partner_beroep'];
			break;
		case 'bewaar4':
			$intakeform_nw->aanmelding		= $_POST['aanmelding'];
			$intakeform_nw->regeling		= $_POST['regeling'];
			$intakeform_nw->uitdagingen		= $_POST['uitdagingen'];
			$intakeform_nw->beperking		= $_POST['beperking'];
			$intakeform_nw->motivatie		= $_POST['motivatie'];
			$intakeform_nw->eisen			= $_POST['eisen'];
			$intakeform_nw->netwerken		= $_POST['netwerken'];
			$intakeform_nw->andere_hulp		= $_POST['andere_hulp'];
			break;
		case 'bewaar5':
			$intakeform_nw->CVind			= $_POST['CVind'];
			$wkz_nw->opleiding				= $_POST['opleiding'];
			$intakeform_nw->diploma			= $_POST['diploma'];
			$intakeform_nw->studie			= $_POST['studie'];
			$intakeform_nw->werkervaring	= $_POST['werkervaring'];
			break;
		case 'bewaar6':
			$intakeform_nw->werk_gewenst	= $_POST['werk_gewenst'];
			$intakeform_nw->voorwaarden		= $_POST['voorwaarden'];
			$intakeform_nw->taalbeh			= $_POST['taalbeh'];
			$intakeform_nw->reistijd		= $_POST['reistijd'];
			$intakeform_nw->vervoer			= $_POST['vervoer'];
			$intakeform_nw->werkbijzh		= $_POST['werkbijzh'];
			break;
		case 'bewaar7':
			$intakeform_nw->overige_opm		= $_POST['overige_opm'];
			$intakeform_nw->besprmis		= $_POST['besprmis'];
			$intakeform_nw->besprtkn		= $_POST['besprtkn'];
			$intakeform_nw->besprvwk		= $_POST['besprvwk'];
			$intakeform_nw->besprprv		= $_POST['besprprv'];
			break;
		case 'bewaar8':
			$intakeform_nw->akkoord_datum	= $_POST['akkoord_datum'];
			$intakeform_nw->akkoord_plaats	= $_POST['akkoord_plaats'];
			$intakeform_nw->akkoord_naam	= $_POST['akkoord_naam'];
			$intakeform_nw->akkoord_handtek	= $_POST['akkoord_handtek'];
			break;
		default:
	}
	updateIntakeform ($wkz, $wkz_nw, $intakeform, $intakeform_nw);
	header('location: intake.php?id=' . $wkz_nw->id);
	exit();	

}

?>
