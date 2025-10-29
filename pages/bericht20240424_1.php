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
			
			<h2>Kort verslag</h2>
			<p>10 april 20.00 uur<br/>
			Aanwezig:<br/>
			Afwezig:<br/>
			(opvragen bij Marius)</p>
			
			<h5>Welkom door Marius</h5>
			<h5>Mededelingen</h5>
			<p><ul>
			<li>Joke is afwezig, we hebben allen het bericht kunnen lezen.</li>
			<li>Jan W. Contact met MVO Zoetermeer (bij het MVO is weinig gevoel/samenwerking onderling) Jan heeft aangegeven om meer te stimuleren bij de burgermeester. Uitgangspunt dat de ondernemingen meer samen gaan doen voor en met de samenleving van Zoetermeer.</li>
			<li>Forum toekomst; mogen stichtingen hier blijven, het is onder de aandacht. Ook zorgen dat de stichtingen en vrijwilligers elkaar kennen.</li>
			<li>Buytenweg Diaconie initiatief van de kerken in Zoetermeer. Doel; armoede bestrijding, hulp bij problemen etc. Idee; Jobgroup starten? Hier 1x in de maand zitten? Marius en Flip willen hier dinsdag middag heen om de ideeen voor te leggen.</li>
			</ul></p>
			
			<h5>Presentatie Jaarverslag en stukken door Peter</h5>
			<p><ul>
			<li>John en Sjaak hebben de kascommissie gedaan en de stukken goed gekeurd.</li>
			<li>Er is een paar duizend euro over, deze wordt doorgeschoven naar volgend jaar als reservering. Het geld is overgebleven door minder uitgaven aan cursussen, deze zijn minder gegeven.</li>
			<li>Multiproblematiek blijft een kernwoord.</li>
			<li>Dank aan iedereen die weer voor een mooi boekjaar heeft gezorgd, dankzij de vrijwilligers is het weer goed gekomen.</li>
			</ul></p>
			
			<h5>Tijd voor intervisie – Marius brengt een case in en krijgt hierover advies en feedback</h5>
			<h5>Rondvraag</h5>
			<h5>Afsluiting met een drankje</h5>

			

		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
