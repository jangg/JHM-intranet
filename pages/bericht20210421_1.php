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
			<h3 class="bluefont">21 april 2021</h3>
			<h1 class="text-black mb-3 bluefont">Terugblik digitale maatjesavond 19 april</h1>
			<h5 class="text-black mb-5 bluefont">Corrie Buren</h5>
			<p>Maandag 19 april 2021</p>
			<h3>Inleiding en mededelingen</h3>
			<p>Om iets over 19.00 uur met een kop thee op mijn bureau, log ik in voor de tweede digitale maatjesavond dit jaar.  
				Het is nog rustig, alleen Joke en Sjanet zijn ingelogd en hebben we eerst gezellig een praatje ‘pot’. 
				Langzaam komt iedereen digitaal binnen druppelen zodat Jan Waayer klokslag 19.30 uur ons allemaal welkom kan heten met ‘niet bij elkaar, blij met elkaar’. 
				Jan geeft aan dat er bij JobHulpMaatje veel in de knop en op open springen staat. Dat we samen voor een klus staan:  “Alleen ga je sneller, samen  kom je verder”.</p>
				<p>We merken, doordat alles helaas nog steeds digitaal gaat, er niet voldoende kandidaten zijn voor de JobGroups. 
				Verder geeft Jan aan dat hij samen met Chrystal bezig is om ondernemers te betrekken bij JHM.  
				Hiervoor zijn er o.a. contacten gelegd met van Dorp en het Netwerk Zoetermeer. Jan vertelt ook dat de politieke partijen aan het inventariseren zijn welke maatschappelijke organisaties actief zijn.</p>
			<h3>Vacatures</h3>
			<p>Per 1 september gaat Flip een stapje terug doen en komt de functie van algemeen coördinator vacant.
			Crystal vraag versterking voor de werkgroep ondernemers netwerk, graag iemand met een ondernemers achtergrond.</p>
			
			<h3>De stand van zaken</h3>
			<p>Hierin geeft Joke eerst het woord aan Pieter Hoevers, die sinds kort JHMZ versterkt als maatje.</p> 
			<p>“Ik ben al vrij actief in het vrijwilligerswerk”, vertelt Pieter.</p> 
			<p>“ik doe vrijwilligerswerk in de zorg sector en voor de korfbalclub, ik wil graag iets voor anderen betekenen”.</p> 
			<p>“Ik ben mijn kennis aan het verleggen richting hulpverlening”</p>
			<p>Joke geeft aan dat de volgende activiteiten op de planning staan</p>
			<ul>
			<li>6-11-2021 landelijke maatjes dag, nog digitaal.</li>
			<li>22-5 en 17-6 her certificering voor vrijwilligers die vóór 2020 hun certificaat hebben behaald.</li> 
			<li>11-6 een IWIN training. Tevens wil zij evaluatie gesprekken  plannen, wel als dit weer fysiek kan.</li>
			</ul>
			<p>Daarna neemt Flip ons mee in de kwartaal rapportage ‘JobHulpMaatje netwerken met de corona (straks) voorbij nu wij vast een tandje bij’. Hier komt o.a. het communicatieplan aan de orde waarin zaken moeten worden opgepakt.  
			Jan Geerdes doet Social Media, Corrie zorgt dat zaken in Streekblad komen, Flip en Johan houden contacten met de Stakeholders.
			Tevens benadrukt Flip de mogelijkheid van één op één gesprekken op diverse locaties, tijdstippen staan op Intranet.</p>
			
			<h3>JobGroups</h3>
			<p>“Helaas is er dit jaar nog maar één reguliere JobGroup doorgegaan”, vertelt Johan. De nieuwe JobGroups IWIN en ZPP zijn 1x gedraaid in 2020 en willen we zeker dit jaar organiseren. De JobGroup ZPP is voor werkzoekenden die in coronatijd hun baan zijn kwijt geraakt of van betaald werk voor zichzelf gaan beginnen. 
			Tip van Crystal: neem voor bonding de ervaring van ex werkzoekenden mee.</p>
			
			<h3>Rondleiding Intranet</h3>
			<p>Jan Geerdes geeft ons een mooie rondleiding door het Intranet.  “Een levend verhaal” zoals hij dit noemt, zodat iedereen weer helder heeft waar staat wat en hoe werkt het. 
			Jan besteedt hier veel werk aan en hoopt dat iedereen het gebruikt en er wat aan heeft. 
			Zo kun je op het forum zaken delen en hoef je minder de whatsapp te gebruiken. In het forum blijven zaken ook duidelijk zichtbaar en vindbaar.</p>
			
			<h3>Corona-tijd en de maatjes hoe gaat het?</h3>
			<p>Sjanet heeft haar eerste werkzoekende begeleid, zo vertelt ze “het was een man van 61 jaar met een technische achtergrond” Doordat Sjanet ook bekend is met de techniek was er een klik en zag het er naar uit dat hij  ook al een baan had gevonden. Helaas liepen de salaris onderhandelingen stuk en ging de baan niet door. 
			Crystal geeft aan dat zij met een werkzoekenden die zij heeft begeleid een interview voor de EO heeft gehad. Het heeft lang op zich laten wachten, uiteindelijk is het interview er toch gekomen.</p>
			
			<h3>Pubquiz</h3>
			<p>Daarna is het tijd voor een gezellige pub quiz en zijn de deelnemers in teams verdeeld en krijgen per mail/Whatsapp de vragen die zij moeten beantwoorden. Hiervoor staat een half uur. 
			De vragen zijn goed in elkaar gezet door Jan en Joke. Uiteindelijk winnen er twee teams De Gorilla’s en de Chimpansees, beiden hebben 18 van de 20 vragen goed. 
			Helaas is de uitslag van de Bavianen niet goed ingevoerd en daarom niet zichtbaar, gelukkig komt de uitslag de volgende ochtend boven water en zijn zij goed voor een derde plaats, op de tweede plaats de Bonobo’s. 
			Het team  waar ik zelf deelgenoot van ben, de Oerang Oetans, helaas op de laatste plaats.</p> 
			
			<h3>Rondvraag en sluiting</h3>
			<p>Bij de rondvraag komt  het ondertekenen met de werkzoekende aan de orde. Dit mag gewoon met een akkoord via de mail. Tevens geeft Joke nog aan dat life gesprekken alleen plaats vinden als  beiden personen die echt willen.</p>
			
			<p>Het was een leuke leerzame maatjes avond met bijpraten, kennismaken en een zeer geslaagde pub quiz, professioneel in elkaar gezet door Joke en Jan.</p>
			
			<p>Corrie Buren</p>
			
			
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
