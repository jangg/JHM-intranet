<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende.php');
include_once('../class/c_intakeform.php');

$error = 0;
$wkz = new Werkzoekende ();
$intakeform = new Intakeform();

if (isset($_POST['BackWzBut']))
{
	header("location: beheer.php");
	exit();	
}
if (isset($_POST['GetWzBut']) && $_POST['GetWzBut'] == 'get' && $_POST['emailid'] != '')
{
	$wkz = new Werkzoekende('emailadres', $_POST['emailid']);
	$intakeform = new Intakeform('id', $wkz->id_intakeform);
	if ($wkz->emailadres == '') 
	{
		$wkz->emailadres = 'emailadres niet bekend';
	}
	unset($_POST['GetWzBut']);
}

if (isset($_POST['saveWzBut']))
{
	if($_POST['saveWzBut'] == 'bewaar1')
	{
		$wkz_nw = clone $wkz;
		$intakeform_nw = clone $intakeform;
		$wkz_nw->voornaam				= $_POST['voornaam'];
		$wkz_nw->achternaam				= $_POST['achternaam'];
		$wkz_nw->tussenvoegsels			= $_POST['tussenvoegsels'];
		$intakeform_nw->roepnaam		= $_POST['roepnaam'];
		$wkz_nw->straat					= $_POST['straat'];
		$wkz_nw->huisnummer				= $_POST['huisnummer'];
		$wkz_nw->postcode				= $_POST['postcode'];
		$wkz_nw->woonplaats				= $_POST['woonplaats'];
		$wkz_nw->telefoonnr				= $_POST['telefoonnr'];
		$wkz_nw->link_linkedin			= $_POST['link_linkedin'];
		$intakeform_nw->gebdatum		= $_POST['gebdatum'];
		$intakeform_nw->gebplaats		= $_POST['gebplaats'];
		$intakeform_nw->gebland			= $_POST['gebland'];
		$intakeform_nw->nationaliteit	= $_POST['nationaliteit'];
		if (isset($_POST['legitimatieind']) && $_POST['legitimatieind'] == 'j') 
			$intakeform_nw->legitimatieind = 'j'; 
			else $intakeform_nw->legitimatieind = 'n';
		
		// print_r ($wkz);
		// print_r ($wkz_nw);

		if ($intakeform_nw != $intakeform)
		{
			if($intakeform_nw->id == NULL)
			{
				// $intakeform_nw->saveToDB($wkz_nw->id);
				$wkz_nw->id_intakeform = $intakeform->id;
			}
			else $intakeform_nw->updateToDB();
		} 
		if ($wkz_nw != $wkz)
		{
			// if($wkz_nw->id == NULL)
			// 	 $wkz_nw->saveToDB(); 
			// else $wkz_nw->updateToDB();
		}
		unset($_POST['saveWzBut']);
		/* start de page opnieuw om een tweede update te voorkomen */
		header("location: intake.php");
		exit();	
	}
}

?>
