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
			<h3 class="bluefont">30 augustus 2022</h3>
			<h1 class="text-black mb-2 bluefont">Uit de bestuursvergadering van 25 augustus</h1>
			<h5 class="text-black mb-5 bluefont">door Peter Veld</h5>
				  <h4>Gevolgen veranderde arbeidsmarkt</h4>
				  <p>We worden er allemaal mee geconfronteerd: de sterk veranderde arbeidsmarkt. Goed nieuws voor de werkzoekenden die op een krappe arbeidsmarkt hun kansen zien stijgen. Maar ook staan er nog meer dan een miljoen mensen aan de kant (bron:Minister van Gennip). Het herkennen en bereiken van deze mensen is één van de opgaven.</p>
				  <p>De locaties van JHM worden geconfronteerd met de gevolgen van deze veranderde arbeidsmarkt en zo ook JobHulpMaatje Zoetermeer. Het bestuur heeft in gesprek met personen binnen en buiten JHMZ en met organisaties ideeën ontwikkeld hoe hierop in te spelen. En door het vertrek van algemeen coordinator <bold>Jan Geerdes</bold> is het nodig ook opnieuw te kijken naar onze organisatie.</p>
				  
				  <h4>Focus</h4>
				  <p>Uitgangspunt is dat JobHulpMaatje Zoetermeer beschikbaar is en blijft voor werkzoekenden die een beroep doen op onze begeleiding. Onze aanpak met individuele begeleiding, JobGroups en workshops voldoet prima. Daar gaan we mee door.
				  We willen zonder anderen uit te sluiten de focus extra richten op enkele doelgroepen die het ook op de huidige arbeidsmarkt moeilijk hebben: langdurig in de bijstand, multiproblematiek en statushouders.</p> 
				  <p>Voor de groep langdurig in de bijstand is een samenwerking gestart met De Binnenbaan. Op het intranet van JHMZ werd daarover op 15 augustus jl. een projectbeschrijving geplaatst. De kern is dat het een proefproject is waarin de deelnemers individueel begeleid worden. <bold>Joke Sikking</bold> en <bold>Marius Cusell</bold> doen intake en matching.</p>
				  <p>Uit de partnerbijeenkomst van juni jl is een initiatief voortgekomen om een JobGroup te organiseren met deelnemers die door of via andere maatschappelijke organisaties worden voorgedragen. Het achterliggende idee is dat er nogal wat mensen zijn die door een andere organisatie begeleid worden en die vaak ook ‘geen werk’ als probleem hebben. Met dat probleem kan JHMZ hulp bieden. <bold>Paula Keun</bold> bereidt de organisatie van deze JobGroup voor.</p>
				  <p>Sinds de vestiging van het tijdelijk AZC is er in Zoetermeer ook een grotere groep statushouders. Deze zoeken werk maar vinden dat veelal toch niet gemakkelijk. Hiervoor heeft JHMZ al eerder een JobGroup gehouden en en ook op dit moment loopt er een JobGroup. <bold>Flip Bakker</bold> begeleidt met <bold>Ton Vermeulen</bold> (als aanstaand JobGroupleider) en met een groep vrijwilligers.</p>
				  
				  <h4>Organisatie</h4>
				  <p>We zetten in op een sterk ‘horizontale’ organisatie, die gedragen wordt door vrijwilligers. We zien af van de rol van algemeen coördinator. En we willen naar een werkwijze met werkgroepen. Met werkgroep bedoelen we dan niet een vergaderstructuur maar een groep mensen die samen werkt aan een aantal samenhangende activiteiten. Daarin staan de vrijwilligers centraal, die daarin ondersteund worden door een coordinator waar dat nodig is en door het bestuur. </p>
				  <p>We denken aan drie werkgroepen:</p> 
				  <ol>
					  <li>Werk. Het kernproces van Maatjes, JobGroups en workshops;</li><li>Samenwerking. Met maatschappelijke organisaties, overheidsorganisaties en het gemeentebestuur;</li><li>Binnen en buiten. Dat is de communicatie, IT, financiën en verslaglegging.</li>
				  </ol>
				  <p>Aan de praktische invulling van deze structuur wordt gewerkt.</p>
				  
				  <h4>Maatjesavond</h4>
				  <p>We willen deze plannen graag met alle vrijwilligers van JHMZ bespreken. Dat gaat gebeuren op maandag 19 september. We beginnen laat in de middag en we gaan ook eten met elkaar. <bold>Saskia Koerselman</bold> gaat voor ons koken! Noteer de datum. Hierover volgt binnenkort nog een nader bericht.</p> 

		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
