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
			<h3 class="bluefont">13 maart 2025</h4>
			<h1 class="text-black mb-2 bluefont">Verslag maatjesavond 12 maart</h1>
			<h5 class="text-black mb-5 bluefont">door Peter Veld</h5>
			<p>12 maart 19.:30h uur<br/>
			Aanwezig:<br/>
			Afwezig:<br/>
			(opvragen bij Peter)</p>
			
			<h5>Welkom door Peter</h5>
			<h4 class="bluefont">Een fijne Maatjesavond</h4>
			<p>Woensdag 12 maart was de eerste Maatjesavond van 2025. Het was een hele fijne avond. Er was veel interactie in een positieve sfeer.</p>
			<figure class="figure float-left" style="width: 100%; margin-right: 15px;">
			<img src="/img/maatjesavond2503122.jpg" class="figure-img img-fluid" alt="Maatjesavond">
			</figure>
			<h4 class="bluefont">Trjct</h4>
			<p>Hoofdschotel was een uitleg door Flip van het systeem Trjct van LDC, waarin werkzoekenden testen kunnen maken, beroepen kunnen verkennen en bijbehorende actuele vacatures kunnen vinden. Het idee is dat ook Maatjes dit kunnen gaan aanbieden aan door hen begeleide werkzoekenden. Nu kon dat alleen door de coördinatoren. De uitleg werkte uitstekend en leverde de nodige vragen en discussie op. De puntjes op de i worden nu nog gezet en daarna krijgen de Maatjes een definitieve aanpak voorgeschoteld. JHMZ heeft een ruim abonnement op dit systeem, zodat er ruim gebruik van kan worden gemaakt. Hopelijk gaat dat ook gebeuren!</p>
			<h4 class="bluefont">Nieuwe opzet Walk&Talk</h4>
			<p>Jan Waaijer vertelde onder meer, dat JHMZ samen met de Bibliotheek en met 4 grote bedrijven in Zoetermeer een nieuwe opzet van Walk&Talk aan het organiseren is. Het idee is, dat de maandelijkse Walk&Talks vervangen worden door een tweetal grotere evenementen per jaar.</p> 
			<h4 class="bluefont">Jaarverslag</h4> 
			<p>Peter gaf een toelichting op het Jaarverslag en op de Financiën. We hebben weer goed gescoord in 2024 en tegen zeer lage kosten. Het verslag zal worden gepubliceerd op onze website. Dat zijn we als ANBI ook verplicht. Dank aan alle vrijwilligers voor hun bijdrage aan het goede resultaat in 2024!</p>
			<h4 class="bluefont">Kascommissie</h4>
			<p>Voor Sjaak was dit de laatste keer dat hij lid was van de Kascommissie. Hij heeft dit vanaf de aanvang gedaan. Bedankt Sjaak! Een van de andere Maatjes zal nu de kascommissie kunnen vormen samen met John Zandbergen, die daar lid van blijft. Meld je bij Peter. Het is maar enkele uren werk per jaar en wel belangrijk!</p>
			<h4 class="bluefont">Werving nieuwe maatjes</h4>
			<p>Omdat we veel werkzoekenden registreren en daarvoor te weinig Maatjes hebben gaan we Maatjes werven. Daar beginnen we direct mee via onze eigen Maatjes. Dat blijkt toch een probaat middel te zijn. Alle aanwezige Maatjes namen een stapeltje flyers voor Maatjes mee. Er zijn er nog meer! De werving gaat ook nog gebeuren via Streekblad, website en de diverse social media. Corrie zal werken aan een mooie tekst daarvoor. Ook bij de werving kunnen de Maatjes een rol spelen. We zullen op LinkedIn proberen te werven. En dat bericht kunnen alle Maatjes  via hun eigen LinkedIn account verder verspreiden! Marius heeft momenteel echt moeite om alle nieuwe aanmeldingen te koppelen. Dus doe extra je best als werver!</p>
			<h4 class="bluefont">Werkcentrum in oprichting</h4>
			<p>Als opvolger van het RMT is overal in het land een Werkcentrum in oprichting. Dat is een samenwerking van gemeenten, UWV, opleidingsinstituten, werkgeversorganisaties en vakbonden. Zoetermeer gaat deel uit maken van Werkcentrum Zuid Holland Centraal. Het wordt gevestigd in het Stadshart (het pand naast Zeeman). Met het Werkcentrum i.o. is gesproken. Zij willen graag samenwerken met JobHulpMaatje. Dat omvat dan informatieverstrekking, doorverwijzen naar JobHulpMaatje en vermelding activiteiten op hun website. Op 2 april organiseert het Werkcentrum een middag, waarin vakbonden en JobHulpMaatje informatie kunnen verstrekken aan belangstellenden. Flip Bakker neemt dat voor zijn rekening. Ook Jan Waaijer en Marius Cusell zullen present zijn. Zo maken we een mooie start.</p>
			<p>Laatste nieuws Werkcentrum :Het Werkcentrum nodigt alle vrijwilligers van JobHulpMaatje uit om op woensdag 11 juni naar het Werkcentrum te komen voor wederzijdse informatie en kennismaking. Dat betekent dat de al geplande Maatjesavond op die datum niet in Forum plaatsvindt en wel  bij het Werkcentrum.</p>


			

		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
