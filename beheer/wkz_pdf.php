<?php
// Include the main TCPDF library (search for installation path).
include_once('../config.php');
require_once('../class/c_werkzoekendepdf.php');
include_once('../class/c_werkzoekende.php');
include_once('../class/c_processtap.php');
include_once('../class/c_intakeform.php');

function chkchkbx ($val)
{
	$textstring = '';
	if (($val & 1) ==  1) $textstring = 'Individueel traject<br/>';
	if (($val & 2) ==  2) $textstring .= 'Jobgroup<br/>';
	if (($val & 4) ==  4) $textstring .= 'Jobgroup "Ik Werk In Nederland"<br/>';
	if (($val & 8) ==  8) $textstring .= 'Jobgroup voor ZZP\'ers<br/>';
	if (($val & 16) ==  16) $textstring .= 'Anders';
	return $textstring;
}

function chkrelatie ($val)
{
	switch ($val)
	{
		case 'ong': $textstring = 'Ongehuwd'; break;
		case 'geh': $textstring = 'Gehuwd'; break;
		case 'smw': $textstring = 'Samenwonend'; break;
		case 'ges': $textstring = 'Gescheiden'; break;
		case 'wed': $textstring = 'Weduwe/weduwenaar'; break;
		default: $textstring = '';
	}
	return $textstring;
}

function chkaanmelding ($val)
{
	switch ($val)
	{
		case 'zlf': $textstring = 'Zelf aangemeld'; break;
		case 'uwv': $textstring = 'door UWV'; break;
		case 'and': $textstring = 'Anders'; break;
		default: $textstring = '';
	}
	return $textstring;
}

function chkregeling ($val)
{
	switch ($val)
	{
		case 'nug': $textstring = 'Is niet uitkering gerechtigd'; break;
		case 'wwe': $textstring = 'Ontvangt WW/Uitkering sociale verzekering'; break;
		case 'opl': $textstring = 'Outplacement'; break;
		case 'wia': $textstring = 'WIA'; break;
		case 'bst': $textstring = 'Ontvangt bijstand/participatiewet'; break;
		case 'wrk': $textstring = 'Heeft werk'; break;
		default: $textstring = '';
	}
	return $textstring;
}

function chktaalbeh ($val)
{
	switch ($val)
	{
		case '1': $textstring = 'Goed'; break;
		case '2': $textstring = 'Redelijk'; break;
		case '3': $textstring = 'Slecht'; break;
		default: $textstring = '';
	}
	return $textstring;
}

function chkmotivatie ($val)
{
	switch ($val)
	{
		case '1': $textstring = 'Weinig'; break;
		case '2': $textstring = 'Normaal'; break;
		case '3': $textstring = 'Sterk'; break;
		default: $textstring = '';
	}
	return $textstring;
}

function chkfinsituatie ($val)
{
	switch ($val)
	{
		case '0': $textstring = 'N.v.t.'; break;
		case '1': $textstring = 'Uitstekend'; break;
		case '2': $textstring = 'Goed'; break;
		case '3': $textstring = 'Redelijk'; break;
		case '4': $textstring = 'Matig'; break;
		case '5': $textstring = 'Slecht'; break;
		default: $textstring = '';
	}
	return $textstring;
}

function chkopleiding ($val)
{
	switch ($val)
	{
		case 'GO': $textstring = 'Geen aanvullende opleiding'; break;
		case 'VMBO': $textstring = 'VMBO/Mavo'; break;
		case 'Havo': $textstring = 'Havo/VWO'; break;
		case 'MBO1': $textstring = 'MBO 1/2'; break;
		case 'MBO2': $textstring = 'MBO 3/4'; break;
		case 'HBO1': $textstring = 'HBO bachelor'; break;
		case 'HBO2': $textstring = 'HBO master'; break;
		case 'HBO3': $textstring = 'HBO post'; break;
		case 'WO1': $textstring = 'WO bachelor'; break;
		case 'WO2': $textstring = 'WO master'; break;
		case 'WO3': $textstring = 'WO post'; break;
		default: $textstring = '';
	}
	return $textstring;
}


if (!isset($_GET['id']) || !is_numeric($_GET['id']))
{
	header('location: mut_persoon.php');
	exit();
}
$wkz = new Werkzoekende ('id', $_GET['id']);
if ($wkz->id_intakeform != '')
	$intakeform = new Intakeform ('id', $wkz->id_intakeform);
	else
	$intakeform = new Intakeform ();
// create new PDF document
$pdf = new WerkzoekendePDF (PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Coördinator werkzoekende');
$pdf->SetTitle('Overzicht werkzoekende');
$pdf->SetSubject('JHMZ wkz');
$pdf->SetKeywords('');

$today = (new DateTime())->format('d-m-Y');
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, 30, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(1,64,255), array(1,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 8, '', true);
$pdf->setCellHeightRatio(1.5);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
if ($wkz->date_geboorte != '')
{
	$date = DateTime::createFromFormat('Y-m-d', $wkz->date_geboorte);
	if ($date)
		$date_geboorte = $date->format('d-m-Y');
		else $date_geboorte = '';
} else
{
	$date_geboorte = '';
}

$html =
'<h1 style="">' . $wkz->voornaam . ' ' . $wkz->tussenvoegsels . ' ' . $wkz->achternaam . '</h1><br/>
<h5>Printdatum: ' . $today . '</h5><br/><br/>
<h4 style="border-top: 2px solid black;">Persoonsgegevens</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Naam</td><td>:</td><td>' . $wkz->voornaam . ' ' . $wkz->tussenvoegsels . ' ' . $wkz->achternaam . '</td></tr>
<tr><td>Roepnaam</td><td>:</td><td>' . $intakeform->roepnaam . '</td></tr>
<tr><td>Adres</td><td>:</td><td>' . $wkz->straat . ' ' . $wkz->huisnummer . '</td></tr>
<tr><td>Postcode</td><td>:</td><td>' . $wkz->postcode . '</td></tr>
<tr><td>Woonplaats</td><td>:</td><td>' . $wkz->woonplaats . '</td></tr>
<tr><td>Emailadres</td><td>:</td><td>' . $wkz->emailadres . '</td></tr>
<tr><td>Telefoon</td><td>:</td><td>' . $wkz->telefoonnr . '</td></tr>
<tr><td>Geboortedatum</td><td>:</td><td>' . $date_geboorte . '</td></tr>
<tr><td>Leeftijd</td><td>:</td><td>' . Tools::calculateAge($wkz->date_geboorte) . '</td></tr>
<tr><td>Geboorteplaats</td><td>:</td><td>' . $intakeform->gebplaats . '</td></tr>
<tr><td>Geboorteland</td><td>:</td><td>' . $intakeform->gebland . '</td></tr>
<tr><td>Nationaliteit</td><td>:</td><td>' . $intakeform->nationaliteit . '</td></tr>
<tr><td>URL LinkedIn</td><td>:</td><td>' . $wkz->link_linkedin . '</td></tr><br/>
</table><br/><br/><br/>
';
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('werkzkd.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>