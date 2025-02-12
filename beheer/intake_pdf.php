<?php
// Include the main TCPDF library (search for installation path).
include_once('../config.php');
require_once('../class/c_intakeformpdf.php');
include_once('../class/c_werkzoekende.php');
include_once('../class/c_intakeform.php');

function chkchkbx ($val)
{
	$textstring = '';
	if (($val & 1) ==  1) $textstring = 'een Individueel traject<br/>';
	if (($val & 2) ==  2) $textstring .= 'een Jobgroup<br/>';
	if (($val & 4) ==  4) $textstring .= 'een Jobgroup "Ik Werk In Nederland"<br/>';
	if (($val & 8) ==  8) $textstring .= 'een Jobgroup voor ZZP\'ers<br/>';
	if (($val & 16) ==  16) $textstring .= 'een Workshop';
	if (($val & 32) ==  32) $textstring .= 'als Vrijwilliger';
	if (($val & 64) ==  64) $textstring .= 'iets anders';
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
	header('location: intake.php');
	exit();
}
$wkz = new Werkzoekende ('id', $_GET['id']);
if ($wkz->id_intakeform != '')
	$intakeform = new Intakeform ('id', $wkz->id_intakeform);
	else
	$intakeform = new Intakeform ();
// create new PDF document
$pdf = new IntakeformPDF (PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Coördinator werkzoekende');
$pdf->SetTitle('Intakeformulier');
$pdf->SetSubject('JHMZ intake');
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
<tr><td>Geboorteplaats</td><td>:</td><td>' . $intakeform->gebplaats . '</td></tr>
<tr><td>Geboorteland</td><td>:</td><td>' . $intakeform->gebland . '</td></tr>
<tr><td>Nationaliteit</td><td>:</td><td>' . $intakeform->nationaliteit . '</td></tr>
<tr><td>URL LinkedIn</td><td>:</td><td>' . $wkz->link_linkedin . '</td></tr><br/>
</table><br/><br/><br/>
<h4 style="border-top: 2px solid black;">Aanmelding</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Situatie</td><td>:</td><td>' . $wkz->situatie . '</td></tr>
<tr><td>Opmerkingen</td><td>:</td><td>' . $wkz->opmerkingen . '</td></tr>
<tr><td>U heeft zich aangemeld voor</td><td>:</td><td>' . chkchkbx($wkz->opties) . '</td></tr>
</table><br/><br/><br/>
<h4 style="border-top: 2px solid black;">Gezinssituatie</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Relatie</td><td>:</td><td>' . chkrelatie($intakeform->relatie) . '</td></tr>
<tr><td>Aantal volw/kinderen</td><td>:</td><td>' . $intakeform->volw_kind . '</td></tr>
<tr><td>Opleiding/beroep partner (indien relevant)</td><td>:</td><td>' . $intakeform->partner_beroep . '</td></tr>
</table><br/><br/><br/>
<h4 style="border-top: 2px solid black;">Ondersteuning</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Wie heeft de werkzoekende aangemeld?</td><td>:</td><td>' . chkaanmelding($intakeform->aanmelding) . '</td></tr>
<tr><td>Hoe is werkzoekende bij JobHulpMaatje terechtgekomen?</td><td>:</td><td>' . $intakeform->bron . '</td></tr>
<tr><td>Huidige regeling</td><td>:</td><td>' . chkregeling($intakeform->regeling) . '</td></tr>
<tr><td>Uitdagingen</td><td>:</td><td>' . $intakeform->uitdagingen . '</td></tr>
<tr><td>Beperkingen</td><td>:</td><td>' . $intakeform->beperking . '</td></tr>
<tr><td>Financiële situatie</td><td>:</td><td>' . chkfinsituatie($intakeform->finsituatie) . '</td></tr>
<tr><td>Redenen voor hulpaanvraag</td><td>:</td><td>' . $intakeform->redenen . '</td></tr>
<tr><td>Motivatie</td><td>:</td><td>' . chkmotivatie($intakeform->motivatie) . '</td></tr>
<tr><td>In geval van een uitkering of bijstand: wordt voldaan aan de sollicitatie-eis van de uitkerende instantie?</td><td>:</td><td>' . $intakeform->eisen . '</td></tr>
<tr><td>Andere netwerken en hulpverlening</td><td>:</td><td>' . $intakeform->netwerken . '</td></tr>
<tr><td>Is andere hulp gewenst? Zo ja, welke?</td><td>:</td><td>' . $intakeform->andere_hulp . '</td></tr>
</table><br/><br/><br/>
<h4 style="border-top: 2px solid black;">Ervaring en opleiding</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Recent CV aanwezig?</td><td>:</td><td>' . ($intakeform->CVind == 'j'?'Ja':'Nee') . '</td></tr>
<tr><td>Hoogst genoten opleiding</td><td>:</td><td>' . chkopleiding($wkz->opleiding) . '</td></tr>
<tr><td>Diploma behaald</td><td>:</td><td>' . ($intakeform->diploma == 'j'?'Ja':'Nee'). '</td></tr>
<tr><td>Tijd en middelen voor studie?</td><td>:</td><td>' . $intakeform->studie . '</td></tr>
<tr><td>Werkervaring</td><td>:</td><td>' . $intakeform->werkervaring . '</td></tr>

</table><br/><br/><br/>
<h4 style="border-top: 2px solid black;">Eisen en wensen voor nieuw werk</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Wat voor werk is gewenst?</td><td>:</td><td>' . $intakeform->werk_gewenst . '</td></tr>
<tr><td>Zijn er beperkingen/voorwaarden?</td><td>:</td><td>' . $intakeform->voorwaarden . '</td></tr>
<tr><td>Spreekt Nederlands ...</td><td>:</td><td>' . chktaalbeh($intakeform->taalbeh) . '</td></tr>
<tr><td>Schrijft Nederlands ...</td><td>:</td><td>' . chktaalbeh($intakeform->taalbeh_schr) . '</td></tr>
<tr><td>Maximale reistijd</td><td>:</td><td>' . $intakeform->reistijd . '</td></tr>
<tr><td>Beschikbaar vervoer</td><td>:</td><td>' . $intakeform->vervoer . '</td></tr>
<tr><td>Verdere bijzonderheden</td><td>:</td><td>' . $intakeform->werkbijzh . '</td></tr>
</table><br/><br/><br/>
<h4 style="border-top: 2px solid black;">Overige informatie</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Overige opmerkingen</td><td>:</td><td>' . $intakeform->overige_opm . '</td></tr>
<tr><td>Besproken Missie & Visie JHM Zoetermeer</td><td>:</td><td>' . ($intakeform->besprmis == 'j'?'Ja':'Nee') . '</td></tr>
<tr><td>Besproken taken maatje</td><td>:</td><td>' . ($intakeform->besprtkn == 'j'?'Ja':'Nee') . '</td></tr>
<tr><td>Besproken verantwoordelijkheden werkzoekende</td><td>:</td><td>' . ($intakeform->besprvwk == 'j'?'Ja':'Nee') . '</td></tr>
<tr><td>Besproken privacy verklaring</td><td>:</td><td>' . ($intakeform->besprprv == 'j'?'Ja':'Nee') . '</td></tr>
<tr><td>Besproken statiegeldregeling studieboeken (€25,=)</td><td>:</td><td>' . ($intakeform->besprstatgeld == 'j'?'Ja':'Nee') . '</td></tr>
<tr><td>Besproken toesturen kopie nieuwe arbeidsovereenkomst</td><td>:</td><td>' . ($intakeform->besprkopie_ao == 'j'?'Ja':'Nee') . '</td></tr>
<tr><td>Besproken vrijwillige bijdrage</td><td>:</td><td>' . ($intakeform->besprvrijwbijd == 'j'?'Ja':'Nee') . '</td></tr>
</table><br/><br/><br/>
<h4 style="border-top: 2px solid black;">Akkoord en ondertekening</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Datum</td><td>:</td><td>' . $intakeform->akkoord_datum . '</td></tr><br/>
<tr><td>Plaats</td><td>:</td><td>' . $intakeform->akkoord_plaats . '</td></tr><br/>
<tr><td>Naam</td><td>:</td><td>' . $wkz->voornaam . ' ' . $wkz->tussenvoegsels . ' ' . $wkz->achternaam . '</td></tr><br/>
<tr><td>Ondertekening</td><td>:</td><td>' . $intakeform->akkoord_handtek . '</td></tr><br/><br/><br/>
<tr><td>Privacy verklaring<br/></td><td>:</td><td>
Door ondertekening gaat u akkoord met de inhoud én met de opslag en het gebruik van bovenstaande gegevens en de tijdens het begeleidingstraject verzamelde gegevens.<br/>
JobHulpMaatje Zoetermeer verplicht zich om zorgvuldig om te gaan met alle gegevens die we van u ontvangen. We bewaren die gegevens tot maximaal 6 maanden na afronding van het traject; daarna zullen de gegevens worden verwijderd.
<br/><br/>JobHulpMaatje Zoetermeer aanvaart geen enkele aansprakelijkheid indien derden op illegale wijze deze gegevens hebben verkregen en/of gebruikt.
</td></tr>
</table><br/><br/><br/>
';
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('intakeformulier.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>