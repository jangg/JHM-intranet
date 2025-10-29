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
	<img src="/img/megafoon.png" class="figure-img img-fluid rounded mr-2" style="float: left; width: 20%;" alt="megafoon">
	<div id="main">
		
		<div class="container verslag my-5">
			
			<h3 class="bluefont">25 maart 2022</h3>
			<h1 class="text-black mb-3 bluefont">Publiciteitscampagne 2022</h1>
			<h5 class="text-black mb-5 bluefont">door Jan Geerdes</h5>
			<p>Hieronder staan alle activiteiten zoals ze op dit moment staan gepland voor de komende maanden. Niet alles is al volledig geregeld. Dat is waar jij erbij aan te pas komt!</p>
			<p>Als je ze doorloopt zie je hopelijk iets wat je bij kunt dragen op een datum en tijd die jou goed uitkomt. Geef dat dan door ajb!! Gebruik bijgaande knop om een email te sturen.</p>
			<p>We nemen dan contact met je op en bekijken samen hoe we je inzet het leukst kunnen maken.</p>
			<p>Tot snel!</p>
			<a class="btn btn-primary" href="mailto: campagneteam@jhm-zoetermeer.nl" role="button">Mail naar het campagneteam &raquo;</a></p>
			<figure class="figure">
			  <img src="../img/fairekans.png" class="figure-img img-fluid" alt="fairekans">
			</figure>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Maandag 11 april 19.00-21.00</h4>
			<p>Waar: Commissiezaal van het Forum</p>
			<ul><li>Maatjesavond </li>
			<li>Start van de campagne 2022</li>
			<li>Wat gaan we doen en hoe kun je helpen als je dat wilt?</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Dinsdag 19 april 9.00-11.30</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul>
			<li>JHM-Workshop begeleid door Flip Bakker en …</li>
			<li>Wat is een JobGroup en hoe helpt je dat? Informatieve sessie door JobGroupleider ….</li>
			<li>Spreek vrijwilliger …</li>
			<li>Informatiedesk en inschrijving</li>
			</ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Donderdag 21 april 14.00-17.00</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul>
			<li>Spreekuur met Joke Sikking, Marius Cusell en Flip Bakker</li>
			<li>Informatiedesk en inschrijving</li>
			</ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Dinsdag 26 april 9.30-11.30 </h4>
			<p>Waar: Forum</p>
			<ul>
			<li>Walk&Talk door Bibliotheek in samenwerking met JHM: Een leven lang leren met het “Leerwerkloket”</li>
			<li>Informatiedesk en inschrijving</li>
			</ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Donderdag 28 april 14.00-17.00</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul>
			<li>Spreekuur met Joke Sikking, Marius Cusell en Flip Bakker</li>
			<li>Informatiedesk en inschrijving</li>
			</ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Dinsdag 3 mei 9.00-11.30</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul><li>JHM-Workshop begeleid door Flip Bakker en…</li>
			<li>Ontmoet oud-deelnemer JHM </li>
			<li>Wat doet een Maatje en hoe helpt deze jou? Informatieve sessie voor werkzoekenden door….</li>
			<li>Informatiedesk en inschrijving</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Dinsdag 10 mei 9.00-11.30</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul><li>JHM-Workshop begeleid door Flip Bakker en…</li>
			<li>Ontmoet vrijwilligers JHM </li>
			<li>Informatiesessie: Vrijwilliger bij JHM. Het is interessant en leerzaam vrijwilliger te zijn bij JHM: sessie voor geïnteresseerden door…</li>
			<li>Informatiedesk en inschrijving</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Donderdag 12 mei 14.00-17.00</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul><li>Spreekuur met Joke Sikking, Marius Cusell en Flip Bakker</li>
			<li>Informatiedesk en inschrijving</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Vrijdag 13 mei 09.30-12.00</h4>
			<p>Waar: Forum trainingsruimte</p>
			<ul><li>Start reguliere JobGroup</li>
			<li>Introductie</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Maandag 16 mei 09.30-12.00</h4>
			<p>Waar: Forum trainingsruimte</p>
			<ul><li>Start JobGroup "Ik Werk In Nederland"</li>
			<li>Introductie</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Dinsdag 17 mei 9.00-11.30</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul><li>JHM-Workshop begeleid door Flip Bakker en…</li>
			<li>Ontmoet oud-deelnemer JHM</li> 
			<li>Wat is een JobGroup en hoe helpt je dat? Informatieve sessie door JobGroupleider ….</li>
			<li>Informatiedesk en inschrijving</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Donderdag 19 mei 14.00-17.00</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul><li>Spreekuur met Joke Sikking, Marius Cusell en Flip Bakker</li>
			<li>Informatiedesk en inschrijving</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Dinsdag 24 mei 9.3—11.30</h4>
			<p>Waar: Forum</p>
			<ul><li>Bibliotheek in samenwerking met JHM: Voor jezelf gaan beginnen in het “Ondernemershuis”</li>
			<li>Informatiedesk en inschrijving</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Dinsdag 31 mei 9.00-11.30</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul><li>JHM-Workshop begeleid door Flip Bakker en…</li>
			<li>Spreek een vrijwilliger</li>
			<li>Wat doet een Maatje en hoe helpt deze jou? Informatieve sessie voor werkzoekenden door….</li>
			<li>Informatiedesk en inschrijving</li></ul>
			
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Donderdag 2 juni 14.00-17.00</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul><li>Spreekuur met Joke Sikking, Marius Cusell en Flip Bakker</li>
			<li>Informatiedesk en inschrijving</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Dinsdag 7 juni 9.00-11.30</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul><li>JHM-Workshop begeleid door Flip Bakker en…</li>
			<li>Spreek een vrijwilliger</li>
			<li>Informatiesessie: Vrijwilliger bij JHM. Het is interessant en leerzaam vrijwilliger te zijn bij JHM: sessie voor geïnteresseerden door…</li>
			<li>Informatiedesk en inschrijving</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Donderdag 9 juni 14.00-17.00</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul><li>Spreekuur met Joke Sikking, Marius Cusell en Flip Bakker</li>
			<li>Informatiedesk en inschrijving</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Dinsdag 14 juni 9.00-11.30</h4>
			<p>Waar: Forum verdieping 2A: Forum Partners</p>
			<ul><li>JHM-Workshop begeleid door Flip Bakker en…</li>
			<li>Spreek een vrijwilliger</li>
			<li>Wat doet een Maatje en hoe helpt deze jou? Informatieve sessie voor werkzoekenden door….</li>
			<li>Informatiedesk en inschrijving</li></ul>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Donderdag 16 juni Partnerbijeenkomst van 15.00-18.00 of 14.00-17.00</h4> 
			<p>Waar: De Kapelaan Zie uitwerking</p>
			<ul><li>Hoe staat de arbeidsmarkt in Zoetermeer ervoor?</li>
			<li>De Binnenbaan: een nieuw fenomeen</li>
			<li>Hoe werkt JobHulpMaatje en met wie</li>
			<li>Ronde tafel</li>
			<li>Afsluitende borrel</li></ul>
			
			<p>JobHulpMaatje realiseert zich, dat Samenwerken Werkt en wil met deze bijeenkomst de samenwerking een impuls geven en nieuwe mogelijkheden verkennen. Tijdens de Partnerbijeenkomst zullen ook werkzoekenden en vrijwilligers bevraagd worden op hun ervaringen.</p>
			</div>
			<div style="border: solid 3px rgba(0, 0, 255, 0.323); padding: 7px;" class="mb-2">
			<h4>Maandag 27 juni 19.00-21.00</h4>
			<p>Waar: Forum of De Kapelaan</p>
			<ul><li>Maatjesavond </li>
			<li>Evaluatie campagne Faire kans op werk</li>
			<li>Hoe nu samen verder</li></ul>
			</div>

				
				<a class="btn btn-primary" href="mailto: campagneteam@jhm-zoetermeer.nl" role="button">Mail naar het campagneteam &raquo;</a></p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
