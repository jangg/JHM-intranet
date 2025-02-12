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
			<h3 class="bluefont">16 april 2021</h3>
			<h1 class="text-black mb-3 bluefont">Pubquiz 2021, regels en teams</h1>
			<h5 class="text-black mb-5 bluefont">Joke Sikking</h5>
			<h4>Online</h4>
			<p>Voor de maatjesavond van 19 april organiseren we een pubquiz. Een pubquiz is een spel tussen teams waarbij samenwerking en gezelligheid voorop staat. Het is een leuke variatie op het spel Triviant. 
				Ieder team krijgt dezelfde set van vragen en deze moeten in een vastgestelde tijd worden beantwoord.  Het zijn allemaal meerkeuze-vragen.
				Het team dat de meeste vragen goed heeft beantwoord, heeft gewonnen. Zo simpel is het.
			</p>
			<p>Samenwerken in een online omgeving is natuurlijk lastiger dan met z'n allen om een tafel. Daarom maken we gebruik van Microsoft Teams en delen we iedereen in in digitale kamertjes. Ieder kamertje is, uiteraard, een team.</p>
			
			<h4>Hoe werkt het?</h4>
			<p>We starten met de quiz om 20:30h. 
				Dan worden de teams verdeeld over de kamertjes en krijgen alle deelnemers de vragenlijst in een PDF of in een Word-document opgestuurd, per email en via Whatsapp.
				De vragen hoeven dus niet voorgelezen te worden, je mag ze zelf lezen en beantwoorden. Maar er is per team per vraag maar 1 (één!) antwoord mogelijk.</p>
			</p>
			<p>Ieder team wijst iemand aan die de antwoorden noteert. Dit teamlid moet inloggen op het intranet (waar je nu ook bent) en zoekt de quizpagina op. 
				Als het team een antwoord weet klikt het teamlid op het aangewezen antwoord bij de vraag en wordt verder gegaan
				met de volgende vragen. Je mag overal zoeken naar antwoorden, ook op het internet, maar denk aan de tijd! </p>
				<p class="text-center text-danger" style="font-size: 1.2em;">Je hebt 20 minuten!</p>
				<p>Het maakt niet uit in welke volgorde ze worden beantwoord maar let wel goed op:</p>
			<p class="text-center text-danger" style="font-size: 1.2em;">De antwoorden worden alleen bewaard als je de knop 'versturen' klikt, onderaan de pagina!</p>
			
			<p>Na 20 minuten is de tijd voorbij en kunnen de antwoorden niet meer gewijzigd worden. De kamertjes worden weer opgeheven en dan zijn we weer allemaal bij elkaar.</p>
			
			<p>Vervolgens lopen we met z'n allen kort door de vragen heen en geven we de goede antwoorden. Tot slot maken we bekend wie heeft gewonnen. En wie onderaan de lijst bungelt uiteraard.</p>
			<h4>Teamindeling</h4>
			<p>De teamindeling is al bekend. Dit zijn de teams:</p>
			<table class="table">
				<tr>
					<td>
					<p class="text-success">Team "De Gorilla's"</p>
					<ol>
						<li>Rina</li>
						<li>Jan W.</li>
						<li>Jantine</li>
						<li>Sjanet</li>
					</ol>
					</td>
					<td>
						<p class="text-success">Team "De Chimpansees"</p>
						<ol>
							<li>Nico</li>
							<li>Rob</li>
							<li>Johan</li>
							<li>John</li>
						</ol>
					</td>
					<td>
						<p class="text-success">Team "De Bavianen"</p>
						<ol>
							<li>Ton</li>
							<li>Flip</li>
							<li>Chrystal</li>
							<li>Pieter</li>
						</ol>
						</td>		
				</tr>
				<tr>
					<td>
					<p class="text-success">Team "De Bonobo's"</p>
					<ol>
						<li>Peter V.</li>
						<li>Jenny</li>
						<li>Sjaak</li>
						<li>Paula</li>
					</ol>
					</td>
					<td>
						<p class="text-success">Team "De Oerang-Oetans"</p>
						<ol>
							<li>Corrie</li>
							<li>Marius</li>
							<li>Peter G.</li>
							<li>Jan G.</li>
						</ol>
					</td>
					<td>
					</td>		
				</tr>
			</table>
			
			<h4>Tot slot</h4>
			<p>De pubquiz is vooral bedoeld om op een leuke manier samen te werken. De vragen zijn niet al te moeilijk. Er mag gelachen worden.</p>
			<p>Heb je vragen- of opmerkingen? Stuur ze naar mij of zet ze in de groepsapp.</p>
			
			<p>Hopelijk is dit een geslaagd experiment. Dan kunnen we het later misschien nog eens op een mooie locatie doen.
				
				<p>Veel plezier</p>
				<p>Joke Sikking</p>
			
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
