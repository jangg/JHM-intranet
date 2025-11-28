<?php
include_once('../config.php');
include_once('../class/c_user.php');
/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
	exit();
}
if (isset($_SESSION['userid']))
{
	$curr_user = new User ('id', $_SESSION['userid']);
} else
{
	$curr_user = new User ();
}
/**********************/

?>
<!DOCTYPE HTML>
<html lang="nl-NL">
	<head>
		<?php include('../includes/head.inc'); ?>			
		<style>
			.bluefont {
				color: #304280;
				font-weight: 300;
			}
			.bg-jhmz {
				background-color: #eeeeee;
			}
			.errormessage {
				color: red;
			}
			bold {
				color: red;
				font-style: italic;
				font-weight: bold;
			}
			td {
				text-align: left;
			}
			
		</style>
	<!-- Custom styles for this template -->
		<link href="../css/jumbotron.css" rel="stylesheet" type='text/css'>
		<link href="../css/mystyle.css" rel="stylesheet" type='text/css'>
		<link href="https://fonts.googleapis.com/css2?family=Courier+Prime&family=Source+Serif+Pro&display=swap" rel="stylesheet">
	</head>
 
<body style="background-color: #dddddd; font-size: 16px;">
	
<?php include('../includes/navbar.inc'); ?>
<div class="jumbotron">
	<div id="main">
		<div class="container verslag my-5">
			<h3 class="bluefont">17 september 2025</h4>
			<h1 class="text-black mb-2 bluefont">Verslag Maatjesavond 10 september 2025</h1>
			<h5 class="text-black mb-5 bluefont">door Peter Veld</h5>
			<p>Joke werd gemist. Zij heeft een arm gebroken. Een kaart ging rond. En als nieuw Maatje werd welkom geheten Edu Fisscher. Hij zal zich vooral richten op de workshops. Hij gaat in oktober ook de Maatjestraining volgen.</p>
			<p>Het programma workshops werd doorgenomen. Flip deed de oproep aan de Maatjes om de komende tijd één of twee workshops bij te wonen. Jos Borsboom gaat eind dit jaar stoppen. Hij zal wel de twee geplande workshops begeleiden. Twee nieuwe workshops trokken de aandacht:</p> 
			<ul>
			<li>Workshop op 21 november Bedrijfsbezoekdag. Afgesproken werd dat Flip en Edu een voorzet doen voor een praktisch werkbare invulling en dat met Jan en Peter bespreken.</li>
			<li>Workshop op 12 december Mijn Pitch-Dit ben ik. Het voorstel is om dit in een vorm te gieten met Maatjes en met oud-deelnemers. In de sfeer zoals afgelopen jaar van de Kerst-Maatjesavond. De consequentie is dan dat te combineren met de eerder voor 17 december geplande Maatjesavond. Deze insteek zal komende tijd verder uitgewerkt worden. Definitief bericht volgt.</li>
			</ul>
			<p>Gediscussieerd werd over onze werkwijze en de afstemming tussen individuele Maatjestrajecten en de workshops. En daarmee samenhangend hoe de administratie hiervan effectiever en voor Marius beter behapbaar te maken. Nu er niet veel Maatjes zijn is het idee zoveel mogelijk eerst nieuwe deelnemers een paar workshops te laten bijwonen en dan in overleg (4 ogen) te bezien of een individueel traject wel of niet moet volgen en aan wie dat het best gekoppeld kan worden. Edu en Peter gaan hierover meedenken om dit een praktische vorm te geven. Diverse Maatjes gaven aan wel een nieuwe begeleiding aan te kunnen om daarmee wachtenden te kunnen helpen.</p>
			<p>Aan de hand van twee recent met succes afgesloten trajecten werd gesproken over de succesfactoren. Duidelijk werd dat beide situaties totaal anders waren en dus niet vergeleken kunnen worden. Opvallend was wel dat in beide trajecten de brede achtergrond van gezinssituatie en andere persoonlijke factoren een belangrijke rol speelden. En dat in beide gevallen er momenten waren dat de deelnemers ‘stevig’ toegesproken moesten worden. Dat leidde dan wel tot een doorbraak.</p>  
			<h5>Programma komende tijd</h5>
			<p>De eigen activiteiten staan op intranet in de agenda.</p>
			<p>Door anderen georganiseerde en voor JobHulpMaatje zinvolle activiteiten zijn:</p>
			<ul>
			<li>Zaterdag 11 oktober is de tweede MeerZoetermeer in het Forum en op het Stadhuisplein. Tijd: van 11.30-16.00. Dit is een gelegenheid vooral naast het Zoetermeerse publiek en werkzoekenden ook nieuwe vrijwilligers te interesseren. Marius en Peter meldden zich aan. Graag nog een paar andere vrijwilligers om (een deel van) deze dag mee te helpen.  Leden bij Peter.</li>
			<li>Dinsdag 14 oktober Banenmarkt bij Dekker Sport van 10.00-13.00. Deze is exclusief gericht op personen die in het doelgroepenregister staan. Flip zal betrokken werkzoekenden hierop wijzen.</li> 
			<li>Op 14 oktober en 13 november is er een training Herkennen en doorverwijzen laaggeletterdheid. Ina Blom en Jan Waaijer zijn hiervoor inmiddels aangemeld.</li>
			<li>Donderdag 16 oktober Event geldzaken in het CKC van 13.00-17.00. Het is een lezing van Eef van Opdorp (van het boek Gek van Geld) en interactieve workshops. Als een van onze Maatjes hieraan mee wil doen graag. Deze kan dan later in een Maatjesavond of op een andere manier de andere Maatjes informeren. Wie wil? Graag melden bij Peter</li>
			<li>Zaterdag 1 november 5 jaar Zoetermeer Voor Elkaar in het Forum van 13.00-17.00. Ter gelegenheid van het vijfjarig bestaan wordt een gevarieerde workshopmiddag georganiseerd die zich speciaal richt op de vele vrijwilligers van diverse organisaties die zich dagelijks inzetten. Een aanrader voor al onze vrijwilligers. JobHulpMaatje is gevraagd ook een workshop te doen. Flip Bakker zal deze workshop voor zijn rekening nemen. Als het volledige programma bekend is zal dat op ons intranet gepubliceerd worden.</li>
			</ul>
			<p>Verslag: Peter Veld, 11 september</p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
