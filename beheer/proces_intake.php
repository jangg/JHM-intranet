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
			if (Tools::checkDate($_POST['gebdatum'], 'jjjj-mm-dd'))
				$wkz_nw->date_geboorte		= $_POST['gebdatum'];

			$intakeform_nw->gebplaats		= $_POST['gebplaats'];
			$intakeform_nw->gebland			= $_POST['gebland'];
			$intakeform_nw->nationaliteit	= $_POST['nationaliteit'];
			if (isset($_POST['legitimatieind']))		$intakeform_nw->legitimatieind = 'j'; 		else $intakeform_nw->legitimatieind = 'n';
			break;
		case 'bewaar3':
			$intakeform_nw->relatie			= $_POST['relatie'];
			$intakeform_nw->volw_kind		= $_POST['volw_kind'];
			$intakeform_nw->partner_beroep	= $_POST['partner_beroep'];
			break;
		case 'bewaar4':
			$intakeform_nw->aanmelding		= $_POST['aanmelding'];
			$intakeform_nw->regeling		= $_POST['regeling'];
			$intakeform_nw->bron			= $_POST['bron'];
			$intakeform_nw->uitdagingen		= $_POST['uitdagingen'];
			$intakeform_nw->beperking		= $_POST['beperking'];
			if (isset($_POST['finsituatie'])) 
				$intakeform_nw->finsituatie		= $_POST['finsituatie'];
			// $intakeform_nw->redenen			= $_POST['redenen'];
			$intakeform_nw->motivatie		= $_POST['motivatie'];
			$intakeform_nw->eisen			= $_POST['eisen'];
			$intakeform_nw->netwerken		= $_POST['netwerken'];
			$intakeform_nw->andere_hulp		= $_POST['andere_hulp'];
			break;
		case 'bewaar5':
			if (isset($_POST['CVind']))		$intakeform_nw->CVind = 'j'; 	else $intakeform_nw->CVind = 'n';
			$wkz_nw->opleiding				= $_POST['opleiding'];
			if (isset($_POST['diploma']))
				$intakeform_nw->diploma			= $_POST['diploma'];
			$intakeform_nw->studie			= $_POST['studie'];
			$intakeform_nw->werkervaring	= $_POST['werkervaring'];
			break;
		case 'bewaar6':
			$intakeform_nw->werk_gewenst	= $_POST['werk_gewenst'];
			$intakeform_nw->voorwaarden		= $_POST['voorwaarden'];
			if (isset($_POST['taalbeh']))
				$intakeform_nw->taalbeh			= $_POST['taalbeh'];
			if (isset($_POST['taalbeh_schr']))
				$intakeform_nw->taalbeh_schr	= $_POST['taalbeh_schr'];
			$intakeform_nw->reistijd		= $_POST['reistijd'];
			$intakeform_nw->vervoer			= $_POST['vervoer'];
			$intakeform_nw->werkbijzh		= $_POST['werkbijzh'];
			break;
		case 'bewaar7':
			if (isset($_POST['intaker']))
			{
				if (is_numeric($_POST['intaker']))
					$intakeform_nw->id_intaker			= $_POST['intaker'];
				else
					$intakeform_nw->id_intaker			= NULL;
			}
				
			$intakeform_nw->overige_opm		= $_POST['overige_opm'];
			if (isset($_POST['besprmis']))		$intakeform_nw->besprmis = 'j'; 		else $intakeform_nw->besprmis = 'n';
			if (isset($_POST['besprtkn']))		$intakeform_nw->besprtkn = 'j'; 		else $intakeform_nw->besprtkn = 'n';
			if (isset($_POST['besprvwk']))		$intakeform_nw->besprvwk = 'j'; 		else $intakeform_nw->besprvwk = 'n';
			if (isset($_POST['besprprv']))		$intakeform_nw->besprprv = 'j';		 	else $intakeform_nw->besprprv = 'n';
			if (isset($_POST['besprstatgeld']))	$intakeform_nw->besprstatgeld = 'j'; 	else $intakeform_nw->besprstatgeld = 'n';
			if (isset($_POST['besprkopie_ao']))	$intakeform_nw->besprkopie_ao = 'j'; 	else $intakeform_nw->besprkopie_ao = 'n';
			if (isset($_POST['besprvrijwbijd'])) $intakeform_nw->besprvrijwbijd = 'j'; 	else $intakeform_nw->besprvrijwbijd = 'n';
			break;
		case 'bewaar8':
			if (Tools::checkDate($_POST['akkoord_datum'], 'jjjj-mm-dd'))
				$intakeform_nw->akkoord_datum		= $_POST['akkoord_datum'];
			$intakeform_nw->akkoord_plaats	= $_POST['akkoord_plaats'];
			$intakeform_nw->akkoord_naam	= $_POST['akkoord_naam'];
			$intakeform_nw->akkoord_handtek	= $_POST['akkoord_handtek'];
			break;
		case 'bewaar9':
			if (isset($_POST['advjobgroup']))
				$intakeform_nw->advjobgroup		= $_POST['advjobgroup'];
			if (isset($_POST['advmaatje']))
				$intakeform_nw->advmaatje		= $_POST['advmaatje'];
			$intakeform_nw->advnietontv		= $_POST['advnietontv'];
			$intakeform_nw->advopmerkingen	= $_POST['advopmerkingen'];
			if (Tools::checkDate($_POST['advverwdatum'], 'jjjj-mm-dd'))
				$intakeform_nw->advverwdatum		= $_POST['advverwdatum'];
			break;

		default:
	}
	updateIntakeform ($wkz, $wkz_nw, $intakeform, $intakeform_nw);
	header('location: intake.php?id=' . $wkz_nw->id);
	exit();	

}

?>
