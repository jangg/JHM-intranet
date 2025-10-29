<?php
include_once('../config.php');
include_once('../class/c_user.php');
/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
// if (!isset($_SESSION['username'])) {
// 	header('location:../index.php');
// 	exit();
// }
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
			
			.italic {
				font-style: italic;
			}
			.bg-jhmz {
				background-color: #eeeeee;
			}
			.errormessage {
				color: red;
			}
			.warning {
				font-family: sans-serif;
				font-size: 1.3em;
				width: 100%; 
				border: 15px solid red; 
				background-color: yellow;
				color: black;
				padding: 20px 10px 10px 0px;
				margin-bottom: 20px;
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
			<h3 class="bluefont">12 mei 2022</h3>
			<h1 class="text-black mb-3 bluefont">Multiproblematiek in Zoetermeer</h1>
			<h3 class="text-black mb-3 bluefont">Partnerbijeenkomst</h3>
			<p>Wanneer en waar?</p>
			<p>Wanneer: donderdag 16 juni van 15.00-18.00</p> 
			<p>Waar: De Kapelaan</p> 
			<h3 class="text-black mb-3 bluefont">Doel van deze bijeenkomst?</h3>
			<p>Door de krapte op de arbeidsmarkt zou je denken dat er voor iedereen een eerlijke kans op werk is. Niets is echter minder waar. Veel mensen missen de boot. Alleen al in Zoetermeer gaat het om duizenden personen.
			Zij hebben vaak meerdere problemen en zijn moeilijk te bereiken. Daarom stellen we onszelf tijdens de bijeenkomst de vraag: Wat zijn die problemen, hoe kunnen we hen wél bereiken en hoe kunnen wij elkaar daarin ondersteunen? </p>
			<p>De problematiek wordt belicht vanuit meerdere perspectieven: dat van maatschappelijke organisaties, dat van kerken en vrijwilligers, dat van de Binnenbaan en andere betrokken organisaties en het perspectief van bedrijven.
			Als vrijwilligers van JobHulpMaatje Zoetermeer, willen we ons sterk maken voor de mensen voor wie die eerlijke kans op werk niet lijkt weggelegd. </p>
			<p>Samenwerking is daarbij hard nodig! De problemen zijn vaak ingewikkeld: geen werk, problemen thuis, problemen met taal, schulden, problemen met integratie. Dat moeten we onderkennen en andere organisaties betrekken bij de oplossing. En elkaar kennen is belangrijk.</p>  
			<p>Na het aflopen van de lockdowns is JobHulpMaatje in april gestart met een campagne om de werkzoekenden persoonlijk te benaderen en drempels te slechten. Wij willen onze ervaringen uitwisselen. 
			Wij willen met onze partners in Zoetermeer bespreken hoe wij de mensen beter in het vizier kunnen krijgen. En hoe we daarin effectiever kunnen samenwerken.</p> 
			<h3 class="text-black mb-3 bluefont">Het Programma</h3>
			<p>Er is een informatieve sessie over de Binnenbaan en er zijn drie rondetafelgesprekken. Alle aanwezigen kunnen actief participeren.</p>
			<ol>
			<li>Welkom door Voorzitter Jan Waaijer van JobHulpMaatje Zoetermeer</li>
			<li>Ronde tafel gesprek 1:<br/>Multiproblematiek in Zoetermeer
			Inwoners van Zoetermeer kunnen gelukkig al op veel plaatsen terecht.
			Vrijwilligersorganisaties en kerken spelen daarin een belangrijke rol. De samenwerking is groeiend. Wat kan meer gedaan worden? Hoe kunnen meer organisaties betrokken worden? Welke sociale problematiek ervaren kerken? Wat kunnen vrijwilligersorganisaties betekenen voor kerken?</li> 
			<li>Keynote: De Binnenbaan, een nieuw fenomeen.<br/>
			De afgelopen raadsperiode is door de gemeente Zoetermeer hard gewerkt om De Binnenbaan te realiseren. Maar wat doet De Binnenbaan eigenlijk? Directeur Patrick Verhoef vertelt over ambities, werkwijzen en kansen. Ook is er ruimte voor vragen en het gesprek wordt aangegaan. Ook personen van andere betrokken organisaties nemen deel aan het gesprek.</li>
			<li>PAUZE</li>
			<li>Ronde tafel gesprek 2: De ervaringen van JobHulpMaatje Zoetermeer.<br/> 
			Hoe kan dit beter verteld worden dan door de vrijwilligers en de werkzoekenden zelf? Wat zijn hun persoonlijke ervaringen, wat werkt wel en wat niet? Wat kwam er uit de campagne?</li>
			<li>Ronde tafel gesprek 3: de rol van bedrijven.<br/>
			Veel bedrijven ervaren krapte op de arbeidsmarkt. Tegelijkertijd staan veel mensen aan de kant zonder werk. Hoe kunnen zij een faire kans op werk krijgen? Welke ideeën leven daarover bij de bedrijven zelf? Wat is al gedaan en welke ideeën leven daar over?</li> 
			<li>Hoe verder: Jan Waaijer evalueert de middag.</li>
			
			<li>BORREL</li>
			</ol>
			
			<h3 class="text-black mb-3 bluefont">Voor wie is de partnerbijeenkomst bedoeld?</h3>
			<p>De bijeenkomst is bedoeld voor maatschappelijke organisaties, kerken, vrijwilligers, gemeente Zoetermeer, aan de overheid gerelateerde organisaties, Netwerk Zoetermeer, bedrijven en voor vrijwilligers van JobHulpMaatje Zoetermeer.</p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
