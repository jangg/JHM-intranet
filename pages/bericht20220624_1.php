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
			<h3 class="bluefont">24 juni 2022</h3>
			<h1 class="text-black mb-3 bluefont">Indrukwekkende prestaties</h1>
			<h3 class="text-black mb-3 bluefont">Deelnemers iWIN-training JobHulpMaatje behalen certificaat</h3>
			<p>Acht bewoners van het AZC-Zoetermeer volgden de JobGroup-training Ik Werk In Nederland (iWIN), en presenteerden hun verworven inzichten voor een belangstellend publiek dat zichtbaar onder de indruk was van deze prestaties.
			Mohammad Juma verwoordde bij het begin van de bijeenkomst wat de deelnemers hadden geleerd in de training: “Een beter inzicht in jezelf; je persoonlijkheid, je kwaliteiten en competenties. En daarnaast hebben we gewerkt aan een goed cv voor de Nederlandse arbeidsmarkt. En geleerd dat we dat cv steeds moeten aanpassen voor de functie waarop je solliciteert.”</p>
			<p>En natuurlijk om je gericht te presenteren. En dat deden ze met verve. Kamal als ervaren electrotechnicus. Abdul en Ali als ambitieuze studenten. Ahmad, voormalig Officier van Justitie in Kabul. Mohamed Saleh als ervaren Public Afairs Officer. Ayma en Juma als civiel ingenieurs. Eén van de deelnemers zag af van een presentatie, omdat – naar eigen inzicht – zijn taalniveau nog niet voldoende was.</p>
			<figure class="figure float-left" style="width: 100%; margin-right: 15px;">
			  <img src="../img/iwin2022.jpg" class="figure-img img-fluid" alt="azc groep">
			  <figcaption class="figure-caption">De deelnemers met hun certificaat</figcaption>
			 </figure>
			<p>De JobGroup-training was tegelijk ook een leeromgeving voor de Nederlandse taal. Tien bijeenkomsten, aangevuld met vijf tussentijdse taalklassen, verzorgd door een aantal taalmaatjes uit de kerken en via Gilde Samenspraak. Indrukwekkend was de taalprestatie – nagenoeg vloeiend Nederlands - van de jongste deelnemer: Ali Sarhan uit Yemen, 19 jaar oud en 4 maanden in Nederland. En dat terwijl hij inmiddels is ingeschreven voor een internationale (engelstalige) studie aan de TU-Twente!</p>
			<p>Belangstelling voor de presentaties was er vanuit de gemeente Zoetermeer (Binnenbaan, en HRM), het Regionaal Mobiliteitsteam, ervaringsdeskundigen (ingeburgerde en werkende vluchtelingen), en ook uit het bedrijfsleven. Daar kwamen goede tips uit voor de deelnemers, en na afloop werden er levendig contacten en cv’s uitgewisseld. Kamal, de elektrotechnicus, kreeg al een baan aangeboden. Sanne Molendijk, van een technisch detacheringsbureau: “Dat gaat goed komen. Ik ga er mijn uiterste best voor doen!”</p>

		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
