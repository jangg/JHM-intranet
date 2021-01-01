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
			<h5 class="bluefont">4 december 2020</h5>
			<h2 class="text-black mb-2 bluefont">Jaarafsluiting JobHulpMaatje Zoetermeer</h2>
			<h3 class="text-black mb-4 bluefont">Programma voor maandagavond 14 december 2020</h3>
			<img src="../img/dekapelaan2018.jpg" class="float-right ml-2" style="width: 70%; margin-bottom: 15px;">
			<p>Op maandagavond 14 december sluit JobHulpMaatje Zoetermeer dit bijzondere jaar af. Omdat we graag iedereen rechtstreeks willen kunnen zien en spreken hebben we ervoor gekozen
				om bijeen te komen in de aula van ontmoetingscentrum De Kapelaan. We willen alles volgens de regels laten verlopen en daarom werken we met kleurcodes. Iedereen die komt krijgt bij binnenkomst
				een kleurcode toegekend. De kleur bepaalt direct waar je zit. Om te voorkomen dat mensen te dicht bij elkaar komen willen je vragen direct naar je aangewezen 
				plek te lopen en plaats te nemen.</p>
				<button type="button" class="btn btn-primary my-4" style="width: 300px;"><a class="text-white" href="../beheer/presentielijst.php">Kijk op de presentielijst</a></button>
			<p>Zo ziet de planning voor de avond eruit:</p>
			</p>
			<table class="table table-sm table-striped">
				<thead class="thead-dark">
					<tr>
						<th width="20%">Tijd</th>
						<th width="60%">Wat gaan we doen?</th>
						<th width="20%">Door</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>19:15 - 19:45</td>
						<td>Inloop</td>
						<td></td>
					</tr>
					<tr>
						<td>19:45 - 20:00</td>
						<td>Inleiding en mededelingen</td>
						<td>Jan Waaijer</td>
					</tr>
					<tr>
						<td>20:00 - 20:15</td>
						<td>In groepjes maken we kennis met elkaar. Hiervoor gebruiken we 3 vragen die allemaal met "W" beginnen.
							<ol>
								<li>Wie ben je? (Wat is je achtergrond?)</li>
								<li>Waarom ben je een maatje geworden bij JobHulpMaatje? (Wat was de aanleiding?)</li>
								<li>Waarom doe je dit vrijwilligerswerk? (En wat is het leukste dat je tot nu toe hebt meegemaakt?)</li>
							</ol>
						</td>
						<td>Allen</td>
					</tr>
					<tr>
						<td>20:15 - 20:30</td>
						<td>Het ontsluiten van het ondernemersnetwerk</td>
						<td>Chrystal Korving</td>
					</tr>
					<tr>
						<td>20:30 - 20:50</td>
						<td>Een nieuwe ronde met elkaar voorstellen, nu met andere mensen aan je tafel</td>
						<td>Allen</td>
					</tr>
					<tr>
						<td>20:50 - 21:00</td>
						<td>Uitleg over de nieuwe indeling van coördinatoren en hun werk.</td>
						<td>Joke Sikking</td>
					</tr>
					<tr>
						<td>21:00 - 21:15</td>
						<td>Derde en laatste ronde met elkaar voorstellen, nu met (alweer) andere mensen aan je tafel</td>
						<td>Allen</td>
					</tr>
					<tr>
						<td>21:15 - 21:30</td>
						<td>Afsluiting van de avond met hapje, drankje en een presentje van de gemeente Zoetermeer als dank voor de vrijwilligers.</td>
						<td>Allen</td>
					</tr>
					<tr>
						<td>21:30</td>
						<td>Einde maatjesavond</td>
						<td></td>
					</tr>
				</tbody>
			</table>
			<h3>Aanmelden</h3>
			<p>Uiteraard willen we graag weten wie we op de avond kunnen verwelkomen. We vragen je daarom om via de WhatsApp groep aan te geven of je op maandagavond 14 december wel of niet aanwezig zal zijn.</p>
			<p>Mocht het niet lukken of zie je een bijeenkomst onder de huidige Corona-maatregelen niet zitten, dan hebben we daar uiteraard alle begrip voor. We houden je op de hoogte!</p>
			<p>Hopelijk zien zo veel mogelijk JHMZ-vrijwilligers elkaar op 14 december.</p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
