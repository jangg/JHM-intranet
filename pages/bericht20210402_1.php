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
			<h3 class="bluefont">2 april 2021</h3>
			<h1 class="text-black mb-2 bluefont">Verslag bestuursvergadering 1 april 2021</h1>
			<h5 class="text-black mb-5 bluefont">Flip Bakker</h5>
			<h2>Niet alleen naar de bal kijken...</h2>
			<p>Nog steeds online, dit keer deels ook samen met de coördinatoren. Bij de opening sloten we een moment aan bij de actualiteit (kamerdebat over formatieperikelen). Waar maken we ons druk over? 
				De politiek krijgt met deze gelegenheidsdebatten steeds meer het karakter van een praat-programma. We missen een beetje de verbinding met de grote opgaven voor de toekomst. 
			Met een uitspraak van Cruyff: “kijk niet alleen naar de bal – heb je die zelf al ooit een doelpunt zien scoren? Kijk om je heen – naar je tegenstanders en je medespelers.”</p>
			<img src="../img/johancruijff.jpg" class="figure-img img-fluid rounded float-left mr-3" alt="Johan Cruijff" style="max-width: 40%;">
			
			<p>Om die bal gelijk bij ons zelf te leggen: waar maken we ons als JHM druk om, wat heeft onze aandacht nodig? 
			Dat is de stagnerende instroom van werkzoekenden; nu we door de lock-down vooral op online-contacten zijn aangewezen, zien we – ook landelijk – de animo van werkzoekenden afnemen. Die ontwikkeling neemt een belangrijke plaats in op de agenda.</p>
			
			<h2>Boren naar bronnen</h2>
			<img src="../img/geld.jpg" class="figure-img img-fluid rounded float-right ml-3" alt="geld" style="max-width: 40%;">
			<p>Bij het agendapunt Financiën zijn er twee bronnen om aan te boren. Bijdragen vanuit de KNR – een fonds vanuit de rooms-katholieke kerken en religieuzen – kunnen worden aangevraagd voor organisatie en uitbouw van het JHM-project Ik Werk in Nederland (iWIN). 
			Dat geeft ruimte voor gerichte aandacht en werving van deze aandachtsgroep (nieuwe nederlanders).</p>
			
			<p>Ook het Kansfonds biedt extra steun om weer op stoom te komen. We zien daar mogelijkheden om o.a. te werken aan een wervings-campagne. Door de gewenste aanpassing van onze website, en met name het genereren van meer bezoekers / werkzoekenden op die site.</p>
			
			<h2>Samen sterker</h2>
			<p>Het komt ook terug in de bestuurlijke contacten. Als je in gesprek raakt ga je meer raakpunten zien, en mogelijkheden voor synergie. Zo bijv. met Taalmaatje: zij werken graag met mensen die sterk gemotiveerd zijn om de taal te leren – en dat valt ook vaak samen met de motivatie om werk te zoeken. 
			Zij organiseren trainingen voor maatjes over het werken met verschillende culturen – zo ook onze maatjes met de iWIN-training.</p>
			
			<p>We willen graag met door ons geholpen werkzoekenden in gesprek over hun (toenmalige) hulpvragen, en hoe ze de hulp hebben ervaren – voor werk, geld, taal etc. 
			We beraden ons op de mogelijkheid om daar in het najaar – als we weer bij elkaar kunnen komen – een gericht symposium op te organiseren.</p>
			
			<p>We besteden aandacht aan de bevindingen van de werkgroep PR/Communicatie. Die heeft als motto ingezet: de corona (straks) voorbij – nu wij vast een tandje bij. 
			Er wordt ingezet op ontwikkelingslijnen voor verschillende doelgroepen: de werkzoekenden, de organisaties die voor hen iets kunnen betekenen (mn. ondernemersnetwerk), de organisaties die werkzoekenden kunnen signaleren (ook kerken), en de fondsen/sponsoren.</p>
			
			<h2>Gezocht: meer aanmeldingen</h2>
			<p>Maar vooral op de korte termijn is er werk aan de winkel. Op advies vanuit de werkgroep heeft het bestuur een besluit genomen voor een update van de website: mn. om meer aanmeldingen op die website te genereren. 
			Daarvoor zijn ook middelen beschikbaar voor een advertentie/wervingscampagne via de (sociale) media.</p>
			
			<h2>Flip treedt terug als coördinator</h2>
			<p>Aan het tweede deel van de stuurgroepvergadering namen ook de coördinatoren deel. Voor afstemming en beraad.</p>
			
			<p>Primair over de opvolging van Flip Bakker als algemeen coördinator. Nu binnenkort zijn vrouw stopt met werken, wil Flip wat meer tijd vrij maken om samen te ‘pensioenieren’. 
			Flip stopt per 1 september a.s. met de algemene coördinatie, maar blijft wel coördinator NetWerken (mn. voor de wekelijkse Workshop). En natuurlijk ook maatje en JobGroupLeider.</p>
			
			<p>We komen samen tot de conclusie om voor de Algemeen Coördinator een vrijwilligers-vacature open te stellen voor 16u/week. Met de oproep – bij deze – aan alle maatjes om mee te denken en suggesties/namen aan te dragen van kandidaten. 
			Dat kan bij Flip of bij onze voorzitter Jan Waaijer.</p>
			
			<h2>En de andere coördinatoren blijven druk</h2>
			<p>Daarna nemen we de tijd om de ontwikkelingen op de taakvelden van de coördinatoren door te nemen.</p>
			
			<img src="../img/meeting20210125.jpg" class="figure-img img-fluid rounded float-left mr-3" alt="maatjesavond" style="max-width: 50%;">
			<p>Joke Sikking (coördinator Maatjes) meldt de aanwas van nieuwe maatjes, en het plan om op maandagavond 19 april as. weer een maatjesavond te organiseren. 
			Met als insteek: meedenken met ideeën hoe we de werkzoekenden (straks) weer kunnen bereiken/werven. En met natuurlijk aandacht voor onderlinge hulp en samenhang. Een uitnodiging met meer info volgt.</p>
			
			<p>Met Peter Gabel (coördinator Werkzoekenden) en Johan Alebregtse (coördinator JobGroups) bespreken we de tegenvallende kwartaalcijfers over de instroom van werkzoekenden. 
			Daardoor is inmiddels 1 geplande JobGroup vervallen, en een andere (ZZP) aangehouden tot er voldoende deelnemers zijn. </p>
			
			<p>Dat is ook de reden waarom Jan Geerdes als coördinator ICT – en van daaruit ook sterk betrokken op het gebruik van sociale media – in de komende weken nauw gaat samenwerken op het vlak van communicatie (mn. Corrie Buren) om voldoende inschrijvers te werven voor de geplande JobGroup van 23 april as.</p>
			
			<h2>Tot slot</h2>
			<p>Al met al een goede stuurgroepbijeenkomst, onder het motto: de corona (straks) voorbij – nu wij vast een tandje bij!</p>
			
			
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
