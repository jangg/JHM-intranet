<?php
include_once('../config.php');
include_once('../class/c_user.php');
/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:index.php');
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
			<h3 class="bluefont">4 januari 2021</h3>
			<h1 class="text-black mb-2 bluefont">Verslag stuurgroepvergadering 4-1-2021</h1>
			<h5 class="text-black mb-5 bluefont">Flip Bakker</h5>
			<p>Een nieuw jaar van start. We houden het bij de traditie, en openen met een moment van bezinning. Naastenliefde staat daarin centraal: als motief om deel te nemen aan het vaccinatie-programma, en ook als referentie voor JobHulpMaatje in het gesprek met de overheid. Dat laatste naar aanleiding van o.a. de Toeslagen-affaire en het gemeentelijke vervolg met terugvordering en boete voor een bijstandsmoeder die boodschappen van haar ouders kreeg…. Voor ons actueel in het gesprek over de ontwikkeling van het nieuwe gemeentelijke werkbedrijf dat per 1 januari van start is gegaan: <a href="https://debinnenbaan.nl/" target="_blank">De Binnenbaan</a>.</p> 
			<p>En dan de orde van de dag. De Maatjesavond – (weer) moeten afzeggen in december. We hebben afgesproken om voor de komende periode de Maatjesavonden online in te plannen, en als het weer kan om te zetten in fysieke bijeenkomsten. De eerstvolgende willen we graag inplannen op maandagavond 25 januari. Online, met een plenair deel, en een deel met subgroepen waarin meer onderlinge uitwisseling mogelijk is. Joke als Maatjescoördinator stemt het programma af met de voorzitter..</p>
			<p>We hebben de resultaten over 2020 besproken:</p>
			<ul>
			<li>1 jongerenflyer gemaakt</li>
			<li>5 JobGroups gegeven</li>
			<li>13 1-op-1 trajecten gestart (en 29 begeleid)</li>
			<li>21 maatjes + 1 nieuw: Lou Mohafid</li>
			<li>26 uitstromers naar werk of opleiding</li>
			<li>36 Workshops NetWerken (waarvan 14 online)</li>
			<li>46 deelnemers in JobGroups</li>
			<li>56 instromers</li>
			</ul>
			
			<p>Opvallend was het verhoudingsgewijs beperkte aantal maatjeskoppelingen (tov. instroom en doorstroom in JobGroups). Dat vraagt meer aandacht van de organisatie. Inmiddels is er meer aandacht voor het stroomlijnen van afspraken over opvolging (maatjeskoppeling) na afronding JobGroups.</p>
			<p>WWe hebben teruggeblikt op de JobGroup iWIN die eind december met een sterk gereduceerde bezetting online is afgerond. Afgesproken is om deze Zoetermeerse start met de iWIN-groepsleiders te evalueren. En ook om voor een vervolg afstemming te zoeken met Piëzo en Vluchtelingenwerk.</p>
			<p>Ondanks covid-19 (of misschien wel dankzij – meer tijd voor bezinning), krijgt het contact met het ondernemersnetwerk meer body. Variërend van contacten met (sociale) ondernemers die willen meedenken (bijv. Lauwrens de Jong, directeur van <a href="https://www.henneken.nl/" target="_blank">Henneken Verhuizingen</a>), tot contacten met de ondernemersnetwerken: <a href="https://www.netwerkzoetermeer.nl/" target="_blank">Netwerk Zoetermeer</a> (de fusie van de businessclubs van RVOZ en Floravontuur), <a href="https://tzho.nl/informatie/sebo-keurmerk-sociaal-economisch-betrokken-onderneming/" target="_blank">Sebo</a> (Zoetermeers label van maatschappelijk verantwoord ondernemen). Bedrijven weten ook ons te vinden: o.a. <a href="https://webhelp.com/nl" target="_blank">WebHelp-Zoetermeer</a> heeft contact gezocht voor hun vacatures. </p>
			<p>Organisatie is een standaard-agendapunt. Het was even zoeken om grip te krijgen, en ook naar een goede taakverdeling. Inmiddels zijn de nieuwe coördinatoren helemaal ingewerkt, en worden taken nu voortvarend opgepakt! Dat is een mooie constatering bij de start van het nieuwe jaar.</p>
			<p>Eén van die taken betreft de ICT-ondersteuning. Het Intranet is inmiddels een goed gebruikt info-forum. Maar wat de meesten nog niet kunnen zien: onder de knop Beheer is inmiddels een hele database opgezet waarin de status van de werkzoekenden kan worden bijgehouden. De aanmeldingen die (meestal) via de website binnenkomen, worden automatisch geregistreerd. Deze database gaat dit jaar de houtje-touwtje administratie van instroom, doorstroom en uitstroom vervangen.</p>
			<p>Daarnaast gaan we met enkele maatjes het <a href="https://mijnjobhulpmaatje.nl/r2/" target="_blank">Hulpvragers-Volg-Systeem</a> (HVS) in de praktijk testen. Dan gaat het om het ‘logboek’ van contacten met de werkzoekenden: de registratie van de werk-afspraken die je als maatje maakt. In combinatie met een tijdsregistratie. Die pilot is opgezet vanuit JobHulpMaatje Nederland, en is afgeleid van het HVS-systeem dat voor SchuldHulpMaatje al operationeel is. Als hulpmiddel voor de maatjes, en als verantwoordingsinfo voor (geanonimiseerde en cumulatieve) resultaten en de daarbij behorende inspanning in mn. tijd.</p>
			<p>Het jaar 2020 sluiten we ook financieel af: positief – we hebben inkosten en uitgaven goed op orde. Een kascommissie gaat dat binnenkort controleren. En voor de controle op het eindverslag naar de start-fondsen zal een accountant worden aangezocht.</p> 
			<p>Standaard staat ook PR en Communicatie op de agenda. Met als belangrijkste aandachtspunt dit maal de tijdige en brede aankondigingen van de geplande activiteiten, zodat er voldoende ruimte is voor instroom en een goede verwerking daarvan: goed zicht op wat werkzoekenden vragen en wat wij als JHM kunnen bieden. Een content-kalender moet dat houvast kunnen bieden.</p>
			<p>De volgende Stuurgroepvergaderingen zijn vierwekelijks op de maandagochtend gepland.</p>
				
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
