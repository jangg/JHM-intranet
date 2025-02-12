<?php
include('config.php');
include_once('class/c_werkzoekende.php');

function PostcodeCheck($postcode)
{
	$remove = str_replace(" ","", $postcode);
	$upper = strtoupper($remove);

	if( preg_match("/^\W*[1-9]{1}[0-9]{3}\W*[a-zA-Z]{2}\W*$/",  $upper)) {
		return $upper;
	} else {
		return FALSE;
	}
}

function chkchkbx ($val)
{
	$textstring = '';
	if (($val & 1) ==  1) $textstring .= 'Individueel traject<br/>';
	if (($val & 2) ==  2) $textstring .= 'Jobgroup<br/>';
	if (($val & 4) ==  4) $textstring .= 'Jobgroup "Ik Werk In Nederland"<br/>';
	if (($val & 8) ==  8) $textstring .= 'Jobgroup voor ZZP\'ers<br/>';
	if (($val & 16) ==  16) $textstring .= 'Anders<br/>';
	return $textstring;
}


$voornaam = $_POST['voornaam'];
$tussenvoegsels = $_POST['tussenvoegsels'];
$achternaam = $_POST['achternaam'];
$straat = $_POST['straat'];
$huisnummer = $_POST['huisnummer'];
$postcode = PostcodeCheck($_POST['postcode']);
$woonplaats = $_POST['woonplaats'];
$optie1 = $_POST['optie1'];
$optie2 = $_POST['optie2'];
$optie3 = $_POST['optie3'];
$optie4 = $_POST['optie4'];
$optie5 = $_POST['optie5'];
$telefoon = $_POST['tel'];
$emailadres = $_POST['email'];
$situatie = $_POST['situatie'];
$opmerkingen = $_POST['opmerkingen'];

$opties = $optie1 . ' - ' . $optie2 . ' - ' . $optie3 . ' - ' . $optie4 . ' - ' . $optie5;

$error = 0;
// if (empty($voornaam)) $error++;
// if (empty($achternaam)) $error++;
// if (empty($straat)) $error++;
if ($postcode === FALSE) $error++;
// if (empty($huisnummer)) $error++;
// if (empty($woonplaats)) $error++;
// if (!filter_var($emailadres, FILTER_VALIDATE_EMAIL)) $error++;

/*    
	JobHulpMaatje       = ja ==> $opties +1
	Jobgroup            = ja ==> $opties +2
	JobGroupiWIN        = ja ==> $opties +4
	JobGroupZZP         = ja ==> $opties +8
	anders              = ja ==> $opties +16    
*/  
	$opties = 0;
	if ($_POST['optie1'] != '') $opties = $opties + 1;
	if ($_POST['optie2'] != '') $opties = $opties + 2;
	if ($_POST['optie3'] != '') $opties = $opties + 4;
	if ($_POST['optie4'] != '') $opties = $opties + 8;
	if ($_POST['optie5'] != '') $opties = $opties + 16;

	if ($opties == 0) $error++;

if ($error > 0){
	echo '<script>alert("Het formulier is niet juist ingevuld. Probeer het opnieuw aub."); window.location.href ="https://jhm-zoetermeer.nl/ik-zoek-werk/aanmelden/";</script>';
} else 
{
	$subject = 'Aanmeldformulier werkzoekende JHM-Zoetermeer.nl';
	$msg = "De aanmelder is in de JHM database toegevoegd.
		\n\nVia het aanmeldformulier op JHM-Zoetermeer.nl werd het volgende bericht achtergelaten:
		\n\nNaam: " .$voornaam. " " . $tussenvoegsels . " " .$achternaam. "
		\nStraat en huisnr: " .$straat. " " . $huisnummer . "
		\nPostcode en Woonplaats: " .$postcode. " " .$woonplaats. "
		\nE-mail: " .$emailadres. "
		\nTel: " .$telefoon. "
		\nOptie(s): " . chkchkbx($opties) . "
		\n\nSituatie:\n" .$situatie. "
		\n\nOpmerkingen:\n" .$opmerkingen;
	$headers = "From: aanmeldformulier@jhm-zoetermeer.nl" . "\r\n" .
		"CC: " . "\r\n" .
		"BCC: ";

	// mail('aanmelding@jhm-zoetermeer.nl', $subject, $msg, $headers);
	mail('jang@jhm-zoetermeer.nl', $subject, $msg, $headers);

	$subject = 'Aanmeldformulier JHM-Zoetermeer.nl';
		$msg = "U heeft de volgende gegevens aan JobHulpMaatje Zoetermeer doorgegeven:
		\n\nNaam: " .$voornaam. " " . $tussenvoegsels . " " .$achternaam. "
		\nStraat en huisnr: " .$straat. " " . $huisnummer . "
		\nPostcode en Woonplaats: " .$postcode. " " .$woonplaats. "
		\nE-mail: " .$emailadres. "
		\nTel: " .$telefoon. "
		\nU heeft interesse in de volgende mogelijkheden:
		\nOptie(s): " . chkchkbx($opties) . "
		\n\nSituatie:\n" .$situatie. "
		\n\nOpmerkingen:\n" .$opmerkingen . "
		\n\n\nDeze email kan niet worden beantwoord.
		\n\nJobHulpMaatje Zoetermeer neemt zo spoedig mogelijk contact met u op.";
	$headers = "From: aanmeldformulier@jhm-zoetermeer.nl" . "\r\n" .
		"CC: " . "\r\n" .
		"BCC: ";
	mail($emailadres, $subject, $msg, $headers);

	echo '<script>alert("We hebben je aanmeldingen goed ontvangen en we zullen snel contact opnemen. \n\nMet vriendelijke groet,\nJobHulpMaatje Zoetermeer"); window.location.href ="https://jhm-zoetermeer.nl/ik-zoek-werk/aanmelden/";</script>';

	/*********
	/****  vanaf hier moet de aanmelding in de database worden gezet
	/*********/     
		$wkz = new Werkzoekende();
		$wkz->voornaam = $voornaam;
		$wkz->tussenvoegsels = $tussenvoegsels;
		$wkz->achternaam = $achternaam;
		$wkz->straat	= $straat;
		$wkz->huisnummer	= $huisnummer;
		$wkz->postcode = $postcode;
		$wkz->woonplaats = $woonplaats;
		$wkz->emailadres = $emailadres;
		$wkz->telefoonnr = $telefoon;
		$wkz->situatie = $situatie;
		$wkz->opmerkingen = $opmerkingen;
		$wkz->opties = $opties;
	$wkz->status = '000';

		$wkz->saveToDB();
}


?>