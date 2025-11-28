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
	<img src="/img/megafoon.png" class="figure-img img-fluid rounded mr-2" style="float: left; width: 35%;" alt="megafoon">
	<div id="main">
		
		<div class="container verslag my-5">
			
			<h3 class="bluefont">3 oktober 2021</h3>
			<h1 class="text-black mb-3 bluefont">De website verandert</h1>
			<h5 class="text-black mb-5 bluefont">door Jan Geerdes</h5>
			
			<h4>Tijd voor vernieuwing</h4>
			<p>Een website is één van de belangrijkste communicatiemiddelen die onze organisatie heeft om te laten zien wie we zijn en wat we doen. Sinds 
				de start van JobHulpMaatje hebben we al een website en deze heeft tot nu toe zijn waarde wel bewezen. Tientallen werkzoekenden vonden de site en schreven zich in
				voor hulp van JobHulpMaatje, zij en vele anderen lazen het laatste nieuws dat we brachten.</p>
				
				<p>Maar de tijd staat niet stil. De website was aan verbetering toe omdat de vindbaarheid te wensen overliet. Ook niet alle belangstellenden (en belanghebbenden!) werden 
				goed bediend op de oude website. Kortom, reden om de site grondig onderhanden te nemen. Dat is nu dus gebeurd en het eerste resultaat leggen we nu aan jullie voor.</p>
				<p>Wat gaat er dan veranderen?</p>

				<h4>Een nieuwe domeinnaam</h4>
				<p>Om te beginnen gaan we gebruik maken van een nieuwe domeinnaam. Het wordt JobHulpMaatjeZoetermeer.nl. Dat lijkt op het eerste gezicht een hoop letters achter elkaar maar 
				bedenk wel: deze naam is makkelijk te onthouden en vrijwel iedereen kan zelf bedenken wat hij of zij moet intikken in de browser om op onze website te komen. Zo simpel kan het zijn.
				Omdat een URL (het websiteadres in de browser) niet let op grote of kleine letters, schrijven we de domeinnaam zoals net is aangegegeven. Dat leest makkelijker en onthoudt beter.</p>
				<!-- <p>De oude domeinnaam, jhm-zoetermeer.nl, is lastiger te onthouden voor werkzoekers. En als je alleen de domeinnaam voor het eerst ziet ziet, valt niet direct te achterhalen wie of wat er achter zit.
				De herkenbaarheid was niet groot, ook niet voor zoekmachines trouwens.</p> -->
				<p>Dit betekent niet dat de oude domeinnaam jhm-zoetermeer.nl gaat verdwijnen op korte termijn. Binnenkort zal deze domeinnaam gaan verwijzen naar de nieuwe domeinnaam. 
				En voorlopig blijven de JobHulpMaatje-emailadressen, die immers ook gebruik maken van de oude domeinnaam, ongewijzigd. Wees gerust.</p>
				<h4>Een agenda</h4>
				<p>Nieuw is ook een actuele agenda op de website. Hierin staan de evenementen en bijeenkomsten zoals Workshops en JobGroups die wij geven. Dat maakt het voor werkzoekenden veel makkelijk om te zien waaraan ze kunnen
				deelnemen en wanneer dat plaatsvindt.</p>
				<h4>Vier doelgroepen</h4>
				<p>De nieuwe website kent in feite 4 verschillende 'home'-pagina's, voor vier verschillende doelgroepen. De belangrijkste is (natuurlijk) de werkzoeker, maar ook potentiële vrijwilligers krijgen een eigen ingang, net als sponsors en 
				werkgevers. Dit is vooral belangrijk bij het gebruik van externe links naar de website. Zo kan iedere doelgroep direct terecht komen bij informatie die gewenst is. En uiteraard blijft bladeren gewoon mogelijk.</p>
				<h4>Nieuws</h4>
				<p>De nieuwspagina is nieuw opgezet maar kan wellicht nog beter. De overweging is dat nieuws van JobHulpMaatje Zoetermeer met name interessant is voor mensen die werken met of voor de stichting, in mindere mate voor de werkzoekenden.
				Mocht iemand hier goede ideeën voor hebben, laat het dan weten.</p>
				<h4>Tot slot</h4>
				<p>Een website is eigenlijk nooit klaar. Dat is vaak ook de moeilijkheid als een website eenmalig wordt gemaakt en er daarna niet of nauwelijks tijd en geld is voor onderhoud. Maar we blijven het proberen. Met hulp van jullie
					moeten we een eind kunnen komen. Ik reken op jullie inhoudelijke inbreng. Als je iets kwijt wilt m.b.t. de website, aarzel niet. Mail me. De enige weg voor de website is voorwaarts. ;-)</p>
				
				<a class="btn btn-primary" href="https://jobhulpmaatjezoetermeer.nl" target="_blank" role="button">Naar JobHulpMaatjeZoetermeer.nl &raquo;</a></p>
				<a class="btn btn-primary" href="mailto: jang@jhm-zoetermeer.nl" role="button">Mail opmerkingen naar Jan G. &raquo;</a></p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
