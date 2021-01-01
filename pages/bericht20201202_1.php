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
			<h3 class="bluefont">2 december 2020</h3>
			<h1 class="text-black mb-2 bluefont">Bericht uit de stuurgroepvergadering van 30-11-2020</h1>
			<h5 class="text-black mb-5 bluefont">Flip Bakker</h5>
			<p>In de Stuurgroep beginnen we standaard met een stukje bezinning. Beurtelings ingeleid door de deelnemers vanuit een inspirerende tekst, gedicht; of vanuit de actualiteit. Dit keer hebben we stil gestaan bij de gedachte van ‘open hiring’ (een baan zonder sollicitatiegesprek), en de maatschappelijke context van toenemende tweedeling door de drang naar de perfecte match en de uitsluiting van wat daar niet bij past…. Daarna stonden we weer met de voeten in de klei.</p> 
			<p>De Stuurgroep heeft ingestemd met het voorstel om taken tussen coördinatoren te herschikken. De concentratie van aandacht voor werkzoekenden en maatjes bij een persoon blijkt in de praktijk een te grote opgave. Daarom zijn die twee zaken gescheiden, waarbij Joke Sikking zich primair zal richten op de maatjes, en Peter Gabel dat gaat doen voor de werkzoekenden. Op de maatjesavond van 14 dec. as. zal dat meer worden toegelicht.</p>
			<p>We hebben even stil gestaan bij het voorstel voor de invulling van de maatjes-avond: het is een jaarafsluiting, dus een passend programma van samenzijn-binnen-corona-afspraken. Het kan, en we gaan het laten zien! Joke Sikking is daar al volop mee bezig.</p>
			<p>Standaard passeren ook de diverse JHM-activiteiten: de start va de JobGroups iWIN en ZZP, de samenwerking met de bieb in het maandelijkse JobOn-programma. Dat laatste weliswaar opgelegd, maar zal in de praktijk z’n meerwaarde kunnen bewijzen – zeker waar het gaat om het aanbod van een breed scala aan e-learningsprogramma’s.</p>
			<p>We hebben gesproken over de evaluatie van het GAK-project: mensen niet alleen werkfit maken (de oorspronkelijke doelstelling van JHM), maar over de brug aan werk helpen – aantoonbaar op basis van arbeidscontracten. In Zoetermeer volledig geslaagd op de doelstelling 40 mensen begeleid (instroom) waarvan 10 succelvol naar een baan. Meer dan volledig, want het aantal daadwerkelijk geslaagden lag hoger (16).</p>
			<p>Een van de randvoorwaarden vanuit het GAK-programma is dat ook wordt ingezet op de ontsluiting van het ondernemersnetwerk. We zijn aangesloten bij RVOZ en Floravontuur, de beide businessclubs in Zoetermeer. We hebben ook een werkgroepje waarin we dat ondernemersnetwerk met beleid meer effectief kunnen benutten. Chrystal Korving leidt dat groepje; zij zal daar 14 dec. ook wat meer over vertellen.</p>
			<p>Dat GAK-project heeft financieel goed geresulteerd. Omdat inmiddels ook fondsen en gemeente over de brug zijn voor 2021, constateerde de penningmeester dat we er florissant bij staan.</p>
			<p>Last but not least hebben we het gehad over de mooie PR-prestaties die we hebben gezien. Een prima team: Corrie Buren die de verhalen heeft opgehaald, samen met Hilde van Leenen (extern) voor eindredactie en productie. En over de inzet die we nodig hebben bij het geplande programma voor 2021: zes reguliere JobGroups en drie bijzondere (iWIN/ZZP). Met de bijbehorende vraag naar individuele maatjes-begeleiding.</p>
			<p>In het licht van de jaarafsluiting mooie resultaten, waar we samen trots op mogen zijn. En een inzet met ambitie voor het komende jaar! Tijdens de Maatjesavond op 14 december zullen we daar zeker ook een moment bij stil staan.</p>	
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
