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
			td {
				text-align: left;
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
			<h3 class="bluefont">21 mei 2025</h4>
			<h1 class="text-black mb-2 bluefont">SPECIALE MAATJESAVOND BIJ WERKCENTRUM</h1>
			<h5 class="text-black mb-5 bluefont">door Peter Veld</h5>
			<p>Onze Maatjesavond ons van woensdag 11 juni staat in het teken van het nieuwe Werkcentrum in Zoetermeer. Dit belooft een interessante avond te worden, waarvan we veel kunnen opsteken.</p> 
			<p>Het Werkcentrum zal gevestigd worden in heel Nederland en wel in elke Arbeidsmarktregio. Het gaat hierbij steeds om een samenwerking van UWV, Gemeenten in de betreffende regio, opleidingsinstituten, vakbonden. Dit stelsel treedt in de plaats nam RMT’s en het Leerwerkloket. De Werkcentra worden gerealiseerd vanaf midden dit jaar tot midden 2026. 
			Zoetermeer valt in de regio Zuid-Holland Centrum. Dit Werkcentrum heeft al een website in opbouw:  <a href="https://werkcentrumzuidhollandcentraal.nl">https://werkcentrumzuidhollandcentraal.nl</a>.</p>
			
			<img src="../img/WerkcentrumZH.png" align="center">
			
			<p>Het Werkcentrum Zuid-Holland Centrum draait vanaf 10 juni proef en gaat een week daarna officieel open. Wij worden in het Werkcentrum op woensdag 11 juni ontvangen door Nicole van der Aa. Zij is als projectmanager verantwoordelijk  voor de realisatie van het Werkcentrum. </p>
			<p>Wij worden ontvangen door Nicole, die na de koffie een presentatie zal geven over de ins en outs van het Werkcentrum. Er is volop gelegenheid tot het stellen van vragen. En natuurlijk kunnen we praten over hoe JobHulpMaatje en Werkcentrum gaan samenwerken! En vooral hoe we de werkzoekenden die wij begeleiden hiermee nog beter kunnen helpen.</p>
			<table class="table">
			<tr><td>Wat:</td><td style="text-align: left;">Maatjesavond special bij het Werkcentrum</td></tr>
			<tr><td>Waar:</td><td style="text-align: left;">Stadshart Zoetermeer aan de Promenade naast de Zeeman</td></tr>
			<tr><td>Tijd:</td><td style="text-align: left;">start 19.30 – uiterlijk 21.30</td></tr>
			</table>

		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
