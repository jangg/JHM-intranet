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
			<h3 class="bluefont">3 oktober 2021</h3>
			<h1 class="text-black mb-3 bluefont">Het verhaal van Max</h1>
			<h5 class="text-black mb-5 bluefont">door Corrie Buren</h5>
			<p><strong>Flip Bakker liep een paar weken geleden Max, oud-deelnemer van een JobGroup, tegen het lijf. Max vertelde dat het goed met hem ging en hij werk had. Flip vroeg Max of hij mij mocht bellen om over zijn ervaringen een verhaal 
			te schrijven voor onze nieuwsbrief of onze interne site. 
			Max stemde hier mee in. Via een telefonisch interview kreeg ik wel een heel persoonlijk en bijzonder verhaal te horen. In overleg met Max is het dit stuk geworden wat ik graag met jullie wil delen.</strong><p>
			
			<p>Max woonde nog bij zijn ouders en was eigenlijk niet met werk bezig.
			Na afronding van zijn studie MBO Marketing en communicatie was de motivatie om naar werk te zoeken nog ver weg.
			Zijn moeder pushte nogal en zijn vader zei subtiel “ Max, misschien is een JobGroup bij JobHulpMaatje wat voor jou om je te oriënteren”.</p>
			
			<h4>JobGroup</h4>
			<p>Zo kwam Max via de netwerkbijeenkomsten in een JobGroup terecht.
			Tijdens de JobGroupbijeenkomsten merkte hij steeds dat persoonlijke groei voor hem het belangrijkste was. Door persoonlijke problemen had hij het gevoel dat de JobGroup geen goede match was. 
			Pushen richting vacatures of banen had geen zin, daar was hij nog niet aan toe.</p> 
			<p>“Het zijn aardige vrijwilligers van JobHulpMaatje. Die willen graag helpen. Misschien een mooie kans voor mij met mijn ups en downs”, dacht Max.
			“In de JobGroup zat ik met aardige mededeelnemers”, herinnerde Max zich. Tussen mensen van middelbare leeftijd zat hij als enige twintiger. “Ik heb het wel als een prettige periode ervaren”, vertelde Max. 
			“Leuke menscontacten, ik kon mijn verhaal kwijt en kreeg hulp”.</p>  
			<p>Zijn elevatorpitch was niet gericht op een baan maar helemaal gericht op persoonlijke groei, dat op dat moment het allerbelangrijkste voor hem was.  
			Max vertelde: “Dat was voor mij het moment om uit mijn schulp te komen en me kwetsbaar op te stellen”. Hij herinnerde zich nog dat Jan Waaijer  n.a.v. van zijn pitch kritische vragen stelde, omdat zijn pitch niet werk-gerelateerd was. 
			Bij de uitreiking van de certificaten herinnerde Max zich ook nog dat Jan zei: “Max, jij bent nog wat onzeker over je toekomst, maar jij komt er wel op jouw manier”.</p>
			
			<h4>Heftige periode</h4>
			<p>Daarna volgde een moeilijk en heftige periode in zijn leven, met veel tegenslagen. Max probeerde rust in zijn leven te vinden. Hij kreeg het besef, dat alléén hij zaken kon veranderen en dat hij het zelf moest doen.  Het bekeren tot de Islam zorgde voor innerlijk rust en regelmaat.   
			Inmiddels heeft Max woonruimte gevonden, werkervaring opgedaan bij de Gemeente Den Haag en heeft hij nu een baan bij een Callcenter in Zoetermeer.</p>
			
			<h4>Werken aan jezelf</h4>
			<p>Soms komen er mensen zoals Max in een JobGroup terecht, die weten dat, als je op eigen benen wilt staan, werk zoeken belangrijk is. 
				Helaas zitten ze vaak persoonlijk zo in de knoop dat ze eerst op zoek zijn om een persoonlijke ontwikkeling door te maken en daarna pas aan werk denken. 
			Hoe mooi is het dan dat je in een JobGroup in de eerste vier bijeenkomsten aan jezelf werkt: ‘Hoe kom ik hier’, ‘Wie ben ik’, ‘Wat kan ik’ en ‘Wat wil ik”
			Allemaal thema’s die hem aan het denken hebben gezet en waardoor zaken op zijn plek vallen. Max is verder gekomen, mede door de hulp die hij kreeg bij JobHulpMaatje.</p>
			
			<h4 class="italic">Nawoord</h4>
			<p class="italic">Intussen weet Max dat wat hij nu doet als werk, niet voor de rest van z'n leven is bestemd. Zijn zoektocht gaat door. En ook voor de volgende stap heeft hij aangeklopt bij JobHulpMaatje Zoetermeer.
				Vanaf 24 september jl. volgt hij de JobGroup ZZP, vijf vrijdagochtenden op een rij. Hij hoopt er achter te komen of voor zichzelf beginnen misschien iets voor hem is.</p>
			<p class="italic">Wij helpen hem graag. Als Max nieuwe stappen gaat zetten zijn wij daar natuurlijk benieuwd naar. Misschien horen we hoe het verder met hem gaat!</p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
