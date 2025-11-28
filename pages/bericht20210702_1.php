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
			<h3 class="bluefont">2 juli 2021</h3>
			<h1 class="text-black mb-2 bluefont">Verslag bestuursvergadering 28 juni 2021</h1>
			<h5 class="text-black mb-5 bluefont">Flip Bakker</h5>
			<h3>Organisatie, resultaten en financiën</h3>
			<p>Hebben en zijn. Daar gaat het over in het gedicht van Ed Hoornik dat bij de start wordt voorgelezen. Zijn is wezenlijk, maar kan toch niet zonder hebben. Het zoeken van een goede balans, daar draait het om.</p>
			<p>We bespreken het halfjaar-resultaat: minder uitstroom, maar opvallend ook minder instroom dan verwacht. Er is gelukkig economisch herstel, 
				maar bestaande problemen zijn nog niet vermindert, eerder verdiept. En ook: toename van werkzoekenden onder schoolverlaters en schijn-zelfstandigen. Dat is dus geen verklaring voor de verminderde instroom, en de boodschap is dan ook: 
				vooral door gaan!</p>
			<h3>Nieuwe Algemeen Coördinator</h3>
			<p>Jan Geerdes heeft aangegeven de vacature voor Algemeen Coördinator te willen vervullen. Het bestuur is blij met deze ontwikkeling, en besluit Jan met ingang van 1 september as. 
				te benoemen in die functie. Dat betekent dat binnen het coördinatorenteam ook een zekere herverdeling van taken en verantwoordelijkheden zal moeten plaats vinden. 
				Het resultaat daarvan zal het bestuur in een volgende vergadering per besluit vastleggen.</p>
			<h3>Op weg naar een jaarplan voor 2022</h3>
			<p>We bespreken het voorstel voor de begroting 2022. Het uitgangspunt – beheerste groei naar 30 maatjes, 6 á 8 JobGroups, waarmee ca. 150 werkzoekenden kunnen worden geholpen – is akkoord voor verdere uitwerking. 
				 De definitieve begroting zal in de volgende vergadering worden vastgesteld voor fondswerving bij o.a. de gemeente Zoetermeer.</p>
			<p>Net na de bestuursvergadering krijgen we van het Kansfonds een positief bericht op onze ‘corona-aanvraag’: er komt € 6.000 beschikbaar voor een extra impuls om uit de corona-depressie te geraken. 
				Bij de aanvraag is aangegeven dat we daarmee met name willen inzetten op het versterken van de laagdrempelige instroom in o.a. de wekelijkse Workshop NetWerken. 
				Er zal een uitvoeringsprogramma worden opgesteld, dat na de zomer daadwerkelijk kan starten.</p>
			<h3>Wet Bestuur en Toezicht Rechtspersonen</h3>
			<p>We bespreken de gevolgen van de invoering van de WBTR per 1 juli; die gaat over mn. aangescherpte bestuursverantwoordelijkheden. 
				Er zullen mogelijk statutenwijzingen nodig zijn, maar daarover komen nog richtlijnen. 
				Het bestuur besluit om de WBTR- voorstellen als uitgangspunt vast te stellen, maar de eventuele statutenwijziging op te schorten tot daarover meer duidelijk is. 
				Dit besluit zal bij de ANBI-informatie op de website worden bijgeschreven.</p>
			<h3>Tot slot</h3>
			<p>Een productieve bestuursvergadering, waarbij ook verschillende PR-punten kunnen worden benoemd: (o.a.) 
				de vervulling van de vacature voor algemeen coördinator, de ervaringen uit de JobGroup die 25 juni met 5 kandidaten succesvol werd afgerond, 
				de start van twee JobGroups in september. Binnenkort meer hierover in de Nieuwsbrief.</p>
			
			
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
