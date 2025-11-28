<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jan Geerdes');
$pdf->SetTitle('Intakeformulier');
$pdf->SetSubject('JHMZ intake');
$pdf->SetKeywords('');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, 40, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(1,64,255), array(1,64,128));
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

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
$html = <<<EOD
<h4>Persoonsgegevens</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Naam</td><td>:</td><td>Jan Geerdes</td></tr>
<tr><td>Roepnaam</td><td>:</td><td>	Jan</td></tr>
<tr><td>Adres</td><td>:</td><td>Giekwerf 19</td></tr>
<tr><td>Postcode</td><td>:</td><td>2725 DV</td></tr>
<tr><td>Woonplaats</td><td>:</td><td>Zoetermeer</td></tr>
<tr><td>Emailadres</td><td>:</td><td>jangg@mac.com</td></tr>
<tr><td>Telefoon</td><td>:</td><td>	06-24843535</td></tr>
<tr><td>Geboortedatum</td><td>:</td><td>21 november 1955</td></tr>
<tr><td>Genoorteplaats</td><td>:</td><td>Rotterdam</td></tr>
<tr><td>Nationaliteit</td><td>:</td><td>ned</td></tr>
<tr><td>URL LinkedIn</td><td>:</td><td>https://www.linkedin.com/1234 </td></tr><br/>
</table>
<h4>Aanmelding</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Situatie</td><td>:</td><td>Dit is een situatie</td></tr>
<tr><td>Opmerkingen</td><td> :	</td><td>Dit zijn opmerkingen</td></tr>
<tr><td>U heeft zich aangemeld voor</td><td> :	</td><td>Individuele begeleiding</td></tr>
</table>
<h4>Gezinssituatie</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Relatie</td><td> : </td><td>Samenwonend</td></tr>
<tr><td>Aantal volw/kinderen</td><td> :	</td><td>1 volwassene, 2 kinderen</td></tr>
<tr><td>Opleiding/beroep partner (indien relevant)</td><td> :	</td><td>Echtgenoot is leraar op een middelbare school</td></tr>
</table>
<h4>Ondersteuning</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Wie heeft de werkzoekende aangemeld?</td><td> : </td><td>Zelf</td></tr>
<tr><td>Huidige regeling</td><td> :	</td><td>Outplacement</td></tr>
<tr><td>Uitdagingen</td><td> :	</td><td>Meer initiatief nemen<br/>Nederlands beter beheersen</td></tr>
<tr><td>Beperkingen</td><td> :	</td><td>Bescheidenheid</td></tr>
<tr><td>Motivatie</td><td> :	</td><td>Sterk</td></tr>
<tr><td>Aanvullende eisen en welke</td><td> :	</td><td style="width: 57%;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td></tr>
<tr><td>Andere netwerken en hulpverlening</td><td> :	</td><td>N.v.t.</td></tr>
<tr><td>Is andere hulp gewenst? Zo ja, welke?</td><td> :	</td><td>Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. Summus brains sit​​, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris. Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium.</td></tr>
</table>
<h4>Ervaring en opleiding</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Recent CV aanwezig?</td><td> : </td><td>Ja</td></tr>
<tr><td>Hoogst genoten opleiding</td><td> :	</td><td>MBO</td></tr>
<tr><td>Diploma behaald in</td><td> :	</td><td>1978</td></tr>
<tr><td>Tijd en middelen voor studie?</td><td> :	</td><td>Tijd wel, middelen beperkt</td></tr>
<tr><td>Werkervaring</td><td> :	</td><td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td></tr>

</table>
<h4>Eisen en wensen voor nieuw werk</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Wat voor werk is gewenst?</td><td> : </td><td>Flink salaris</td></tr>
<tr><td>Zijn er beperkingen/voorwaarden?</td><td> :	</td><td>Geen</td></tr>
<tr><td>Spreekt Nederlands ...</td><td> :	</td><td>Goed</td></tr>
<tr><td>Maximale reistijd</td><td> :	</td><td>30 minuten</td></tr>
<tr><td>Beschikbaar vervoer</td><td> :	</td><td>Auto/fiets</td></tr>
<tr><td>Verdere bijzonderheden</td><td> :	</td><td>Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. Summus brains sit​​, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris. Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium.</td></tr>
</table>
<h4>Overige informatie</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Overige opmerkingen</td><td> : </td><td>Bro ipsum dolor sit amet gaper backside single track, manny Bike epic clipless. Schraeder drop gondy, rail fatty slash gear jammer steeps clipless rip bowl couloir bomb hole berm. Huck cruiser crank endo, sucker hole piste ripping ACL huck greasy flow face plant pinner. Japan air Skate park big ring trucks shuttle stoked rock-ectomy.</td></tr>
<tr><td>Besproken Missie & Visie JHM Zoetermeer</td><td> :	</td><td>Ja</td></tr>
<tr><td>Besproken taken maatje</td><td> :	</td><td>Ja</td></tr>
<tr><td>Besproken verantwoordelijkheden werkzoekende</td><td> :	</td><td>Ja</td></tr>
<tr><td>Besproken privacy verklaring</td><td> :	</td><td>Ja</td></tr>
</table>
<h4>Akkoord en ondertekening</h4>
<table>
<tr><td style="width: 30%;"></td><td style="width: 2%;"></td><td style="width: 73%;"></td></tr>
<tr><td>Datum</td><td> : </td><td>8 januari 2021</td></tr>
<tr><td>Plaats</td><td> :	</td><td>Zoetermeer</td></tr>
<tr><td>Naam</td><td> :	</td><td>Jan Geerdes</td></tr>
<tr><td>Ondertekening</td><td> :	</td><td></td></tr>
</table>

EOD;
// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('intakeformulier.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
