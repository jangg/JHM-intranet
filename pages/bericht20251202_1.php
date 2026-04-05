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
		<?php include('../includes/head.php'); ?>			
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
	
<?php include('../includes/navbar.php'); ?>
<div class="jumbotron">
	<div id="main">
		<div class="container verslag my-5">
			<h3 class="bluefont">2 december 2025</h4>
			<h1 class="text-black mb-2 bluefont">Persbericht JobHulpMaatje Zoetermeer</h1>
			<h5 class="text-black mb-5 bluefont">door Edu Fisher</h5>
			<h4>Met JobHulpMaatje op bedrijfsbezoek bij Van Dorp en Henneken in Zoetermeer</h4>
			<p>Vrijdag 21 november organiseerde JobHulpMaatje voor werkzoekenden interessante bedrijfsbezoeken bij twee oer-Zoetermeerse bedrijven. Technisch installatiebedrijf Van Dorp en verhuisbedrijf Henneken. Hier kregen werkzoekenden de kans om kennis te maken met werkgevers en inzicht te krijgen in mogelijkheden op de arbeidsmarkt.</p>
			
			<h5>Bedrijfsbezoek Van Dorp</h5>
			<p>Joris en Elise van de afdeling Mens en Organisatie zorgden voor een hartelijk ontvangst. Van Dorp is een familiebedrijf waar techniek en duurzaamheid centraal staan. De deelnemende werkzoekenden hadden zich goed voorbereid en veel vragen opgesteld. Een vraag was: hoeveel kans maken open sollicitaties? Van Dorp is zeker geïnteresseerd in serieuze open sollicitaties, helaas is er niet altijd tijd om deze meteen te behandelen. Een goede manier om je vragen te stellen is om even te bellen met een recruiter. Een andere vraag was of er interne opleidingsmogelijkheden zijn? Bij Van Dorp is er een interne Academie waar opleidingen (soms verplicht) worden aangeboden, terwijl het salaris wordt doorbetaald. Voor  nieuwe collega’s bestaat er een inwerkprogramma. </p><p>Na afloop gaf het bedrijf aan dat geïnteresseerde deelnemers van dit bedrijfsbezoek altijd een kopje koffie kunnen komen drinken. Een opvallende en veelzeggende bijzonderheid is dat het bedrijf zijn maatschappelijke betrokkenheid invult met een foundation waarmee minimaal 5% van de winst naar goede doelen in binnen-en buitenland gaat.</p>
			
			<h5>Bedrijfsbezoek Henneken</h5>
			<p>Hier stond eigenaar/directeur Lauwrens de werkzoekenden te woord. Henneken is een verhuisbedrijf met ongeveer 25 werknemers. Het bedrijf werkt zowel in Nederland als in het buitenland, met focus op de UK. Duurzaam ondernemen en goed zorgen voor je personeel is een persoonlijke overtuiging voor Lauwrens. </p><p>Hoewel de meeste medewerkers al langer voor Henneken werken en er niet vaak vacatures zijn, had hij wel een aantal tips voor de werkzoekenden, waar hij op let bij het aannemen van personeel. Bijvoorbeeld een sollicitatiebrief met goede motivatie: Waarom wil je voor Henneken werken? Heb je je vooraf in het bedrijf verdiept? Dit sluit aan bij de boodschap van JobHulpMaatje om altijd vooraf met een werkgever te bellen.</p><p>Belangrijk is ook hoe de inzet van iemand is voor het bedrijf. Bij een verhuisbedrijf moet je als werknemer snel kunnen schakelen. Het allerbelangrijkste  is of iemand bij het team past, hoe is je karakter?</p><p>
			De deelnemers van JobHulpMaatje waren aangenaam verrast door de open en ontspannen sfeer waarin zij door de bedrijven werden ontvangen. Deze bedrijfsbezoeken zijn een waardevolle aanvulling op het programma van JobHulpMaatje en smaken naar meer!</p>
			
			<p><b>Meer weten over  JobHulpMaatje?   www.jobhulpmaatjezoetermeer.nl</b></p>
			 
			
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.php'); ?>
</body>
</html>
