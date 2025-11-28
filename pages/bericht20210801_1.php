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
			<h3 class="bluefont">13 augustus 2021</h3>
			<h1 class="text-black mb-2 bluefont">Verslag bestuursvergadering 27 juli 2021</h1>
			<h5 class="text-black mb-5 bluefont">Flip Bakker</h5>
			<h3>Communicatie en Campagne</h3>
			<p>We starten met een stukje bezinning op communicatie. Hoe binnen een op zich homogene gemeenschap mensen toch elkaar moeilijk verstaan. 
			Eenzelfde beleving wordt verschillend verwoord en verstaan, afstand kan dan niet echt worden overbrugd. 
			Erklären versus Verstehen – het verschil tussen de talen van enerzijds mensen met de wijsheid van het logische weten, en anderzijds die met de vragende wijsheid van de verbeelding.</p>
			Bij de gemeente hebben we kennis gemaakt met de nieuwe contactpersoon, een positieve ontvangst. 
			<p>Gesproken is over de voorbereiding van de subsidieaanvraag voor 2022, en de voorbeeldrol van de gemeente als werkgever.
			Ten behoeve van de subsidieaanvraag stelt het bestuur formeel de begroting voor 2022 vast.</p>
			<p>De werkgeversrol komt verder aan de orde als we spreken over het Ondernemersnetwerk. 
			Dat is vooral gericht op het ontvankelijk maken van ondernemers/ werkgevers voor de inzet van JHM. 
			Daarvoor hebben we ons aangemeld voor het zgn. SEBO-keurmerk: afgegeven door de gemeente Zoetermeer aan bedrijven die zich onderscheiden door maatschappelijk verantwoord ondernemen. 
			Eind september zal JHM een presentatie houden voor een gezelschap van MVO-ondernemers in Zoetermeer.</p>
			<p>De nieuwe website krijgt inmiddels vorm. Langs de volgende lijnen. 
			De belangrijkste is die van de werkzoekende; die moet snel en gemakkelijk kunnen ‘landen’ bij de contact-/ inschrijfmogelijkheden. 
			Daarnaast zijn er lijnen voor de vrijwilligers, de werkgevers en de fondsen. Om de content wervend te maken, zullen ook filmpjes worden toegevoegd.</p> 
			<p>Vanaf september willen we een wervingscampagne opzetten. Daarvoor zullen we ook gebruik maken van de ondersteuningsmogelijkheden van De Nieuwe Gevers. 
			Dat is een platform van sympathieke denkers, makers & doeners met een nieuwe mindset: skills geven aan het goede. Ze gaan ons helpen met een creatief campagneconcept.</p>
			
			
			
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
