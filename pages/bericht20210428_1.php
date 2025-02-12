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
			<h3 class="bluefont">28 april 2021</h3>
			<h1 class="text-black mb-2 bluefont">Verslag bestuursvergadering 26 april 2021</h1>
			<h5 class="text-black mb-5 bluefont">Flip Bakker</h5>
			<h2>Inzet voor een PR-offensief</h2>
			<h4>Vaccinaties in aantocht</h4>
			<p>Er komt beweging in: de vaccinaties bereiken nu de JobHulpMaatjes, ook die in het bestuur. Maar online vergaderen heeft ook z’n voordelen…. 
			Je kunt uitslapen tot het laatste moment.</p>
			<h4>Bezinning</h4>
			<p>We beginnen met een bezinningsmoment. Rechtvaardigheid. Dat is meer dan ‘iedereen hetzelfde geven’. 
			De een heeft nu eenmaal meer hulp nodig dan de ander. Een mooie uitwerking van rechtvaardigheid is: iemand tot zijn/haar recht laten komen. 
			In een brede betekenis: zoals je een kunstvoorwerp tot z’n recht laat komen. En gaat een mens die niet alle te boven?</p>
			<h4>Andere verhalen</h4>
			<p>We hebben mooie verhalen over hoe we mensen hebben kunnen helpen. Maar er zijn ook andere verhalen te verzamelen. 
			Bijvoorbeeld van de werkzoekende die een paar jaar lang door de uitkeringsinstantie aan het lijntje wordt gehouden met korte contracten. 
			Door dit ‘draaideur-beleid’ verspeelt ze ook kostbare (leef)tijd. Of dat van een migrante met jaren werkervaring in Nederland, die na een ziekteperiode weer in wil stromen. 
			Ze heeft alleen een verouderde telefoon, en kan daarmee niet een cv/brief opstellen.</p>
			<p>Maar een aanvraag voor een laptop (bijzondere bijstand) wordt afgewezen, omdat de noodzaak daarvoor niet is gebleken. 
			Het is goed om ook die verhalen te verzamelen. Niet om anderen de maat te nemen, wel om te illustreren waar werkzoekenden tegenaan lopen.</p>
			<h4>Publiciteit</h4>
			<p>Deze korte Stuurgroepvergadering staat ook verder in het teken van PR en communicatie.</p>
			
			<p>De plaatsing van een wervingsadvertentie voor Algemeen Coördinator in het Streekblad biedt de mogelijkheid om daar ook een halve pagina redactioneel aan te verbinden. 
			Wat we graag doen. Met een artikel over Stille Werkloosheid vanuit mn. de voorzitter. En met een promotie-artikel over de verschillende bijdragen van JobHulpMaatje. 
			Mooie bijdragen vanuit de werkgroep PR en Communicatie!</p>
			
			<p>Gewerkt wordt aan een publicatie van JHM samen met Piëzo en Taalmaatje over de inzet voor statushouders/migranten. Met daarin de aankondiging van de JobGroup iWIN, start 15 juni as.
			De Stuurgroep is ook in principe akkoord met een offerte van Zoetermeer Actief voor een marketing/pr-campagne voor het komende half jaar. 
			In de werkgroep PR en Communicatie zullen al deze ontwikkelingen op elkaar worden afgestemd en uitgewerkt.</p>
			<h4>Ombudsman voor vrijwilligers</h4>
			<p>Tenslotte spreken we nog kort over de vereisten die van buitenaf worden gesteld aan verenigingen/stichtingen en het bestuur daarvan. 
			Bijvoorbeeld over een klachtenprocedure. Bij JHM gelukkig niet actueel, maar wel goed om dat op orde te hebben. 
			We willen dat serieus bekijken, zo mogelijk in lokaal perspectief: een onafhankelijk klachten-adres voor (alle) verenigingen/stichtingen van vrijwilligers in Zoetermeer. 
			Daar komen we op terug!</p>
			
			<h3>Samen werkt het – we gaan ervoor!</h3>
			
			
			
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
