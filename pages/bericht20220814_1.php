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
			<h3 class="bluefont">14 augustus 2022</h3>
			<h1 class="text-black mb-2 bluefont">Notitie van JHM Landelijk</h1>
			<h5 class="text-black mb-5 bluefont">Karin Geertsma</h5>
			<p>Het zal niemand zijn ontgaan: de arbeidsmarkt is in korte tijd razendsnel veranderd. De werkloosheid is sterk gedaald en er is krapte. Dat wil niet zeggen, dat niet heel veel mensen nog steeds grote problemen hebben om aan werk te komen. JobHulpMaatje is daarom nog steeds hard nodig. Wel vraagt de huidige arbeidsmarkt om een nieuwe blik op het werk van JobHulpMaatje.</p>
			 
			 
			<h4>Veranderende arbeidsmarkt</h4>
			<p>Het bestuur heeft daarom besloten tot heroriëntatie op de activiteiten van de Stichting JobHulpMaatje i.v.m. de gewijzigde situatie op de arbeidsmarkt. De problemen concentreren zich nu vooral op de groepen langdurig in de bijstand, multiproblematiek buiten het zicht van de overheid en statushouders en migranten. Het bestuur wil in het najaar komen met voorstellen voor de komende periode en de bekostiging daarvan. Dit zal op de Landelijke dag van zaterdag 5 november een belangrijk onderwerp zijn. Noteer deze datum alvast in je agenda. Nadere informatie volgt nog.</p>
			 
			 
			<h4>Vertrek Gerard van Barneveld</h4>
			<p>De uitbreiding van het aantal locaties stagneert. Er zijn zelfs een paar locaties gestopt. Dat heeft ook financiële gevolgen. Het werken aan uitbreiding en het begeleiden van locaties kost veel geld. Daarom is besloten het contract met Gerard van Barneveld (Barna Advies) per eind oktober op te zeggen. De reden voor de beëindiging is, dat de kosten van deze overeenkomst inhuur externe deskundigheid niet langer in overeenstemming zijn met de opbrengsten ervan. Door de veranderde arbeidsmarkt is zoals al vermeld het bovendien noodzakelijk geworden dat JHM zich heroriënteert op de focus van haar activiteiten.</p> <p>Dat leidt waarschijnlijk tot een andere kijk op uitbreiding van en ondersteuning van locaties. Het bestuur bedankt Gerard voor al zijn goede en vele bijdragen in de afgelopen jaren. Veel locaties zijn door Gerard goed geholpen. Gerard blijft overigens beschikbaar om op inhuurbasis trainingen te verzorgen, zoals hij de afgelopen jaren ook al deed. En hij besteedt de resterende periode aan de afronding van lopende trajecten en activiteiten bij de betreffende locaties. Het landelijk servicebureau blijft onveranderd en dus beschikbaar voor de locaties.</p>
			 
			 
			<h4>Project Over de Brug</h4>
			<p>Met Instituut GAK is een gesprek gepland medio september over het Project Over de Brug. Doel van het gesprek is de probleempunten die uit het overleg met de locaties zijn gebleken te bespreken. Het ingediende plan en de toekenning eind 2021 droegen sterk de signatuur van de arbeidsmarkt van dat moment. Het is daarom zaak het project aan te passen. In het overleg met Instituut GAK zullen deze elementen een rol spelen: update i.v.m. veranderde arbeidsmarkt, geen verplichting mee te doen, minder administratieve belasting. Na het overleg worden de locaties geïnformeerd.</p>
			 
			 
			<p>Namens het bestuur, Peter Veld, wnd. Voorzitter</p>
			 
			 
			 
			 
			<p>Karin Geertsma<br/>
			Coordinator servicepunt Jobhulpmaatje<br/>
			Telefoon: 06-18419155</p>
			 
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
