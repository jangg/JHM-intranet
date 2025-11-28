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
			<h3 class="bluefont">3 oktober 2021</h3>
			<h1 class="text-black mb-3 bluefont">Het verhaal van Max</h1>
			<h5 class="text-black mb-5 bluefont">door Corrie Buren</h5>
			Een paar weken geleden liep Flip Max, oud-deelnemer van een JobGroup, tegen het lijf. Hij hoorde dat het goed met hem ging en hij werk had. Flip vroeg Max mij hem mocht bellen om over zijn ervaringen een mooi verhaal te schrijven voor onze nieuwsbrief of onze interne site. 
			Max stemde hier mee in. Via een telefonisch interview kreeg ik wel een heel persoonlijk en bijzonder verhaal te horen. In overleg met Max is het dit stuk geworden wat ik graag met jullie wil delen.<p>
			
			<p>Max woonde nog bij zijn ouders en was eigenlijk niet met werk bezig.
			Na afronding van zijn studie MBO Marketing en communicatie is de motivatie om naar werk te zoeken nog ver weg.
			Zijn moeder pushte nogal en zijn vader zei subtiel “ Max misschien is een JobGroup wat voor jou om je te oriënteren”.</p>
			
			<h5>Jobgroup</h5>
			<p>Zo komt Max via de Netwerkbijeenkomsten in een JobGroup terecht.
			Tijdens de JobGroup bijeenkomsten merkt hij steeds, dat persoonlijke groei voor hem het belangrijkste is. Door persoonlijke problemen heeft hij het gevoel dat de JobGroup geen goede match is. 
			Pushen richting vacatures/banen heeft geen zin, daar is hij nog niet aan toe.</p> 
			<p>“Het zijn fijne vrijwilligers van JobHulpMaatje, die willen helpen”. “Misschien een mooie kans voor mij met mijn ups en downs”, dacht Max.
			“In de JobGroup zat ik met fijne mede deelnemers”, herinnert Max zich.  Dames rond de veertig en hij als enige jonge man. “Ik heb het wel als een prettige periode ervaren”, vertelt Max. 
			“Leuk menscontact, ik kon mijn verhaal kwijt en kreeg hulp”</p>  
			<p>Zijn elevator pitch is niet gericht op een baan, helemaal gericht op persoonlijke groei, op dat moment het aller belangrijkste voor hem.  
			Max vertelt “Dat was voor mij het moment om uit mijn schulp te komen en me kwetsbaar op te stellen” en herinnert zich nog dat Jan Waaijer  n.a.v. van zijn pitch kritische vragen stelt, omdat zijn pitch niet werk gerelateerd is. 
			Bij de uitreiking van de certificaten herinnert Max nog dat Jan Waaijer (voorzitter JHM-Zoetermeer) zei “Max jij bent nog wat onzeker over je toekomst, maar jij komt er wel op jouw manier”. </p>
			
			<h5>Heftige periode</h5>
			<p>Na een moeilijk en heftige periode in zijn leven, met veel tegenslagen  probeert Max rust in zijn leven te zoeken. Hij krijgt het besef, dat alléén hij zaken kan veranderen en het zelf moet doen.  Het bekeren tot de Islam zorgde voor innerlijk rust en regelmaat.   
			Inmiddels heeft Max woonruimte gevonden, werkervaring op gedaan bij de Gemeente Den Haag en heeft hij nu een baan bij een Callcenter in Zoetermeer.</p>
			
			<h5>Werken aan jezelf</h5>
			<p>Soms komen er mensen zoals Max in een JobGroup terecht, die weten als je op eigen benen wilt staan, werk zoeken belangrijk is. Helaas persoonlijk zo in de knoop zitten dat ze eerst op zoek zijn om een persoonlijke ontwikkeling door te maken en daarna pas aan werk denken. 
			Hoe mooi is het dat je in een JobGroup in de eerste vier bijeenkomsten aan jezelf werkt.; ‘Hoe kom ik hier’ ‘Wie ben ik’ ‘Wat kan ik’ en ‘Wat wil ik”
			Allemaal thema’s die hem aan het denken hebben gezet en waardoor zaken op zijn plek vallen.</p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
