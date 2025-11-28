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
			<h3 class="bluefont">31 augustus 2021</h3>
			<h1 class="text-black mb-3 bluefont">Maatjesavond</h1>
			<h5 class="text-black mb-5 bluefont">Joke Sikking</h5>
			<p>Aanstaande maandag 6 september houden we een Maatjesavond. Voor het eerst in lange tijd wordt de avond weer gezamenlijk gehouden en kan iedereen aanwezig zijn. De bijeenkomst vindt plaats in
				de Kapelaan in de Dorpsstraat.
			</p>
			<p>Belangrijk om rekening mee te houden:</p>
			<div class="warning">
				<ul>
				<li>Houd 1,5 meter afstand van anderen.</li>
				<li>Heb je klachten of twijfel je, blijf thuis en laat je direct testen.</li>
				<li>Een mondkapje is niet verplicht, maar schroom niet er één te gebruiken als je dat prettig vindt.</li>
				</ul>
			</div>
			<h3>Programma</h3>
			<p>Het programma ziet er als volgt uit:</p>
			<table class="table table-striped">
			<tr>
				<th style="width: 20%;">Tijd</th>
				<th style="width: 80%;">Onderwerp</th>
			</tr>
			<tr><td>19.30 uur</td><td>Inloop</td></tr>
			<tr><td>19.45 uur</td><td>Inleiding en mededelingen (Jan Waaijer)</td></tr>
			<tr><td></td><td>Ontwikkeling JHM Landelijk (Peter Veld)</td></tr>
			<tr><td></td><td>Bespreken Job groups (Johan)</td></tr>
			<tr><td></td><td>Situatie op de arbeidsmarkt momenteel (Flip)</td></tr>
			<tr><td></td><td>Ontwikkelingen website (Jan)</td></tr>
			<tr><td></td><td>Bijpraten met en door de maatjes over casus vragen of andere dingen die men wil delen (maatjes aan woord laten) (Joke) </td></tr>
			<tr><td></td><td>Info over LDC (Johan)</td></tr>
			<tr><td></td><td>Over de ondernemers bijpraten ( Chrystal)</td></tr>
			<tr><td></td><td>Aankondiging evaluatiegesprekken laatste kwartaal 2021</td></tr>
			<tr><td>21.30 uur</td><td>Rondvraag en sluiting</td></tr>
			</table>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
