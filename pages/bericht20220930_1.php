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
			.bg-JobHulpMaatjez {
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
			<h3 class="bluefont">30 september 2022</h3>
			<h1 class="text-black mb-2 bluefont">Uit de bestuursvergadering van 28 september</h1>
			<h5 class="text-black mb-5 bluefont">door Peter Veld</h5>
				  <h4>Verslag bestuursvergadering 26 september</h4> 
				  
				  <p>Het bestuur kon terugkijken op een erg geslaagde Maatjesavond op maandag 19 september. De gesprekken waren goed en het diner viel in de smaak. Dank aan iedereen die aan deze avond een bijdrage leverde. Alhoewel er zeker vraagpunten bleven concludeert het bestuur dat er draagvlak is voor koers en organisatie. Het voornemen is om geregeld met elkaar de balans op te maken in Maatjesavonden. Naast koers en organisatie zal daar plaats ingeruimd worden voor intervisie. Dat helpt om een slag dieper met elkaar te ervaren of we nog steeds op het goede spoor zitten. Want de veranderende arbeidsmarkt vraagt erom geregeld onze bijdrage daaraan te blijven toetsen. Want we willen maatschappelijk relevant zijn en blijven! Er zal dit jaar in elk geval nog één Maatjesavond plaatsvinden.</p>
				  
				  <p>De stand van zaken van de samenwerking met andere organisaties werd onder de loep genomen. De partnerbijeenkomst krijgt een vervolg. Zo zal de Binnenbaan een bijeenkomst organiseren over het onderwerp intake. Waarschijnlijk kunnen meerdere organisaties van elkaar leren, onnodige vragen vermijden en de relevante vragen blijven stellen. De bijeenkomst zal in november georganiseerd worden. Voor iWIN zijn mooie stappen gezet om meer organisaties daarbij te benutten. Dat kan voor de flinke groep (potentiële) deelnemers opleveren. Op 29 december studeert weer een groep af en alles wijst er op dat er nog meer groepen gaan volgen.</p>
				  
				  <p>Het proefproject met de Binnenbaan met deelnemers die vaak al langere tijd een bijstandsuitkering hebben werd in een eerste tussenevaluatie besproken met de Binnenbaan. Op dat moment was de stand, dat met 1 deelnemer in de intake is overeengekomen dat JobHulpMaatje deze niet zal begeleiden. 1 deelnemer stroomde uit naar werk en 4 deelnemers zaten op dat moment na de intake in de fase van matching dan wel begeleiding. Er werden afspraken gemaakt over de terugkoppeling en de (AVB-proof) contactmogelijkheden tussen JobHulpMaatje en de Binnenbaan. de Binnenbaan bevestigde dat zij alleen kandidaten na overleg met de kandidaat voordragen en alleen als er een perspectief is op resultaat. In november volgt een tweede evaluatiegesprek.</p>
				  <p>Het is de bedoeling dat de andere maatschappelijke organisaties meer betrokken worden bij het aandragen van deelnemers voor JobGroups. Dat betekent ook de communicatie direct op hen richten naast de al gebruikelijke kanalen. Het bestuur hoopt dat bij het organiseren van de volgende reguliere JobGroup hiermee een start gemaakt kan worden.</p> 
				  
				  <p>De bijeenkomst van Netwerk Zoetermeer in het kader van de rijksbegroting 2023 werd bijgewoond. Ook het eerste Netwerk café van Maatschappelijk Verantwoord Ondernemen Zoetermeer werd bijgewoond. JobHulpMaatje presenteerde zich ook in het vredesfestival en ook een aantal werkzoekenden die JobHulpMaatje in iWIN begeleidt waren aanwezig. Gelukkkig laten we ons dus goed zien. Van belang is dat het gemeentebestuur actief ondersteunt. Dat zal met wethouder Bouke Velzen besproken worden. Ook de financiële bijdrage van de gemeente aan JobHulpMaatje komt dan aan de orde. Daarvoor is een aanvraag ingediend.</p>
				  
				  <p>Het bestuur constateert dat door de campagne voor de zomer de belangstelling voor JobHulpMaatje is gestegen en dat vertaalt zich stap voor stap ook in het aantal deelnemers. Het is dan ook belangrijk dat we tijdig werken aan het werven van voldoende vrijwilligers.</p> 
				  
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
