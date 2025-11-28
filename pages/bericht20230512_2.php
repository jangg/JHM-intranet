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
			<h3 class="bluefont">12 mei 2023</h3>
			<h1 class="text-black mb-2 bluefont">Rollen JobHulpMaatje Zoetermeer</h1>
			<h5 class="text-black mb-5 bluefont">door Peter Veld</h5>
			<figure class="figure float-left" style="width: 100%; margin-right: 15px;">
			  <img src="../img/rollen.jpg" class="figure-img img-fluid" alt="rollen">
			  <figcaption class="figure-caption">Rollen</figcaption>
			 </figure>
			<p>In de Maatjesavond van 10 mei werden de coördinerende rollen en de bemensing daarvan doorgenomen. Omdat niet iedereen aanwezig was en er meerdere vragen over gesteld zijn wordt deze informatie hier nog een keer gedeeld.</p>
			<ul>
			<li>Het belangrijkste is uiteraard de vrijwilliger: Maatjes en JobGroupleiders</li>
			<li>Coördinator Maatjes: Joke Sikking</li>
			<li>Coördinator JobGroups en Workshops: Flip Bakker</li>
			<li>Coördinator Intake en deelnemers: Marius Cusell</li>
			<li>Coördinator IT middelen: Jan Geerdes (tot eind 2023)</li>
			<li>Adviseur relatie Maatjes-Werkzoekenden: Jos Borsboom</li>
			<li>Communicatie Streekblad: Corrie Buren</li>
			<li>Bestuursleden: Jan Waaijer (voorzitter), Saskia Koerselman (lid), Peter Veld (secr/penn)</li>
			</ul>
			<p>Vanaf dit jaar probeert het bestuur steeds te vergaderen met een deel van de coördinatoren en vrijwilligers afhankelijk van de onderwerpen.</p> 




		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
