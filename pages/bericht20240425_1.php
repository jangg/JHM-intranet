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
			<h3 class="bluefont">24 april 2024</h3>
			<h1 class="text-black mb-2 bluefont">Verslag maatjesavond 10 april</h1>
			<h5 class="text-black mb-5 bluefont">door Sjanet Beekman</h5>
			
			ARBEIDSONGESCHIKTHEID
			Ziek in de bijstand:
			‘Het voelt onrechtvaardig’
			De bijstand is het laatste vangnet voor wie geen baan heeft, maar wel kán werken. Toch zit de regeling vol mensen met langdurige lichamelijke of psychische problemen, die geen aanspraak kunnen maken op een hogere arbeidsongeschiktheidsuitkering. „Ik vraag me af: wat heb ik gedaan om dit te verdienen? Ik ben gewoon ziek.”
			Door onze redacteur Christiaan Pelgrim Fotografie Mona van den Berg
			Saskia Brandewijn had alles voor elkaar. Ze was 26 jaar, bijna afgestudeerd als psycho- loog en stond op het punt aan een promotieonderzoek te be- ginnen in Engeland. Maar toen begonnen de slapeloze nachten en werd het langzaam donker in haar hoofd.
			Een jeugdtrauma, dat zij jarenlang had weggestopt, kwam in 2016 naar boven. Brandewijn werd depressief en kreeg suï- cidale gedachten. Oude herinneringen aan seksueel misbruik kwamen terug. Ja- renlang volgt ze nu al intensieve thera- pieën. Na zo’n sessie is ze de rest van de dag moe. Een betaalde baan, zegt Brande- wijn (nu 34), is nu niet haalbaar. Haar contactpersoon bij de gemeente is dat met haar eens.
			Voor wie ziek is of een beperking heeft, of dat nu lichamelijk is of mentaal, zijn er in Nederland twee speciale uitkeringen: de WIA en de Wajong. Maar Brandewijn is een van de grofweg 200.000 mensen die voor beide niet in aanmerking komen. Zij is ziek in de bijstand.
			De bijstand is een basale uitkering. Het laatste vangnet voor wie geen baan heeft, maar wel kán werken. Maar de praktijk is anders. De meeste mensen in de bijstand kunnennunietwerken,ziengemeenten,
			hulpverleners en deskundigen. Meer dan de helft van de bijna
			400.000 bijstandsontvangers ervaart ge- zondheidsproblemen, blijkt uit onder- zoek van de Nederlandse Arbeidsinspec- tie. En iets meer dan de helft heeft moeite met handelingen als huishoudelijke ta- ken en traplopen, volgens het Sociaal en Cultureel Planbureau.
			De gemeente Den Haag kwam een paar jaar geleden tot een schokkende ontdek- king. Ambtenaren van die stad hadden ruim 18.000 inwoners gesproken die al meer dan anderhalf jaar in de bijstand za- ten. Hun conclusie: 90 procent kan niet op de korte termijn aan het werk gehol- pen worden. Bij hen zitten gezondheids- problemen, een verslaving of schulden in de weg. 40 procent zal waarschijnlijk nooit meer aan het werk komen, bijvoor- beeld door chronische ziekte.
			Toch hebben deze mensen geen recht op een arbeidsongeschiktheidsuitkering. Nederland heeft een vangnet voor ziekte, maar daar zitten grote gaten in.
			Wat een leven op bijstandsniveau bete- kent? Zuinig zijn, zegt Brandewijn. Op aanbiedingen letten, geen toetjes kopen. „Ik ben in de studentikoze maaltijden blij- ven hangen. Pasta met rode saus en de groentendieiknoghebliggen.”Soms
			moet ze een moeilijke keuze maken, ver- telt ze in haar appartement in Utrecht: „Ga ik voor het eerst in jaren weer een winter- jas kopen? Of wil ik gezond eten blijven kopen?” Brandewijn is zulke keuzes ge- wend, zegt ze. Zo redt ze het al zeven jaar.
			Toch had haar leven er heel anders uit kunnen zien. Vroeger was er een uitke- ring voor mensen die al van jongs af aan een handicap hebben: de Wajong. Maar die regeling is fors ingeperkt. Je krijgt de- ze uitkering alleen nog als je nooit meer kunt werken.
			Ook was het beter uitgekomen als haar depressie een paar jaar later was opgeko- men, als Brandewijn geen student, maar een werknemer was. „Dan was ik in de WIA beland”, zegt ze. Een hogere uitke- ring, alleen bereikbaar voor wie ziek uit- valt vanuit loondienst. Dat onderscheid vindt Brandewijn veel te willekeurig. „Wat maakt het uit of ik eerst gewerkt heb? Ik ben gewoon ziek.”
			Maar een baan in loondienst is geen ga- rantie. De bijstand zit ook vol met oud- werknemers die om andere redenen niet in aanmerking komen voor de arbeidson- geschiktheidsuitkering WIA, maar die volgens hun gemeente te ziek zijn om te werken.
			Gemeentenzittenermeeinhunmaag.
			De bijstand is een tijdelijk, sober vangnet met strenge regels, zegt Peter Heijkoop, wethouder Werk en Inkomen in Dor- drecht en bestuurder van de Vereniging van Nederlandse Gemeenten. „Maar een groot deel van de mensen zal daar nooit meer uitkomen. Zij kunnen niet werken, of hooguit een paar uur per week. Moeten zij dan altijd op zo’n laag inkomen blij- ven? Dat voelt onrechtvaardig.”
			Vergeten groep
			De regels rond arbeidsongeschiktheid zullen de komende jaren waarschijnlijk drastisch veranderen. Maar in de discus- sies hierover, lijken de zieken in de bij- stand tot nu toe een vergeten groep.
			Een commissie van deskundigen, inge- steld door het kabinet-Rutte IV, presen- teerde vorige maand een adviesrapport over hoe nieuwe regels rond arbeidsonge- schiktheid eruit moeten zien: menselijker en simpeler. Maar de adviescommissie focuste zich vooral op de WIA-uitkering, waarvoor ze drie alternatieve scenario’s uitwerkte. Over de zieken in de bijstand ontbraken vergaande aanbevelingen.
			Saskia Brandewijn snapt niet waarom ze zó wordt genegeerd. Zij hoort niet in de bijstand, zegt ze. „Ik ben arbeidsonge- schikt.Ikzouwelwillenwerken,enik

			

		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
