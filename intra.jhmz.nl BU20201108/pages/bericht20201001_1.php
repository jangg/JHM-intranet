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
		<script>
		$(document).ready(function(){
		});		
		</script>
	</head>
 
<body style="background-color: #dddddd; font-size: 16px;">
<?php include('../includes/navbar.inc'); ?>
<div class="jumbotron">
	<div id="main">
	<div class="container my-5" >
		<h3 class="bluefont">1 oktober 2020</h3>
		<h1 class="text-black mb-5 bluefont">Nieuwe Forum maatregelen per 30 september 2020</h1>
		<p>De tweede golf van de pandemie dringt nu snel door in Nederland, helaas. Hierbij de aanvullende maatregelen die door het Forum Zoetermeer worden genomen:</p>			
		<div class="m-sm-5 p-sm-5" id="email">
			<p>------------------------- Oorspronkelijk bericht -------------------------<br/>
			Onderwerp: Nieuwe maatregelen Forum en wijkvestigingen vanaf donderdag 1 oktober<br/>
			Van: "Sarah Pronk | Bibliotheek Zoetermeer" <Sarah.Pronk@bibliotheek-zoetermeer.nl><br/>
			Datum: Wo, 30 september, 2020 5:27 pm<br/>
			Aan: "Sarah Pronk | Bibliotheek Zoetermeer" <Sarah.Pronk@bibliotheek-zoetermeer.nl><br/>
			--------------------------------------------------------------------------</p>
			
			<p>Goedemiddag Forumpartners,</p>
				
			<p>Afgelopen maandagavond hebben we allemaal te horen gekregen dat de maatregelen weer aangescherpt worden en dat er aanvullende maatregelen vanuit de veiligheidsregio's komen.
			<p>De afgelopen dagen hebben er gesprekken plaatsgevonden om de nieuwe maatregelen te bespreken, hieronder zet ik ze graag voor jullie op een rij.</p>
			<p>Het huidige protocol blijft in het Forum en de wijkvestigingen gelden. Dat wil zeggen: we houden 1,5 meter afstand, was je handen meerdere malen per dag, gebruik van handgel, mandjes meenemen voor bezoekers en maak de tafels en handleuningen voorafgaand een spreekuur of activiteit goed schoon. De dienstverlening en activiteiten kunnen binnen de nieuwe maatregelen gelukkig gewoon doorgaan, binnen de aangegeven groepsgroottes van maximaal 30 voor afgesloten ruimtes. Wij hebben nooit boven dit aantal gezeten, aangezien de grootste ruimte van het Forum maar maximaal 30 personen kan toelaten op 1,5 m afstand.</p>
			
			<p>Wel zijn er vanuit de Veiligheidsregio Haaglanden aanvullende adviezen gekomen ten aanzien van het gebruik van mondkapjes en tijden voor kwetsbare bezoekers.
				
			We trekken hiermee op met de gemeente en volgende adviezen.</p>
			<p>Wat betekent dit voor ons?</p>
			<p>Mondkapjes:</p>
			<ul>
			
			<li>Zodra je de publieke ruimte in het Forum betreedt draag je een mondkapje. Dit zal dus niet gelden in de afgesloten ruimte zoals de trainingsruimtes of de leeskamer.</li>
			<li>Bezoekers worden dringend geadviseerd een mondkapje te dragen. Mondkapjes worden bij de entree aan het Stadhuisplein beschikbaar gesteld voor die bezoeker die er geen bij zich heeft.</li>
			<li>Als je plaatsneemt achter een balie/studieplek/leestafel/café kun je het mondkapje af doen. Dit kunnen bezoekers ook doen.</li>
			</ul>
			<p>Op bovenstaande plekken (balie, studieplek, leestafel en café) komt een lijst te liggen, waarop men zich kan registreren. Na twee weken vernietigen we de lijsten met persoonsgegevens.</p>
			
			<p>Uren voor kwetsbare mensen:</p>
			<p>Op verschillende momenten zal tijd gereserveerd worden voor dienstverlening aan kwetsbare mensen. Dit betreft:</p>
			<ul>
			<li>Bibliotheek Rokkeveen - maandag 14:00 - 15:00 uur</li>
			<li>Bibliotheek Oosterheem - dinsdag 17:00 - 18:00 uur</li>
			<li>Forum - donderdag 11:00 - 12:00 uur</li>
			</ul>
			<p>Natuurlijk zijn deze klanten ook op andere momenten welkom.
			Let op: de maatregelen gaan vanaf donderdag 1 oktober in! Momenteel wordt de communicatie geregeld.</p>
			
			<p>Het zal voor iedereen weer wennen zijn. Mochten jullie vragen, zorgen of opmerkingen hebben, neem dan gerust contact met mij op.</p>
			
			
			<p>Met vriendelijke groet,</p>
			
			
			
			<p>Sarah Pronk</p>
			
			<p>Coördinator Programmering / Specialist Educatie en Ontwikkeling</p>
			
			<p>Team Educatie en Ontwikkeling</p>							
		</div>
	</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
