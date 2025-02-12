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
			<h1 class="text-black mb-2 bluefont">Verslag maatjesavond 11 mei</h1>
			<h5 class="text-black mb-5 bluefont">door Peter Veld</h5>
			
			<h2>Transactionele analyse</h2>
			<p>In een door afzeggingen tot 10 teruggebracht deelnemersveld lichtte Jos Borsboom het centrale onderwerp transactionele analyse toe. Daarin gaat het om het begrijpen en duiden van de opstellingen en rollen, die daarbij aan de orde zijn en hoe de persoonlijkheid en achtergrond daarbij een cruciale betekenis hebben.</p> 
			<p>Enkele van de genoemde voorbeelden: aanklager, redder, slachtoffer. Dat speelt in de relatie tussen bijvoorbeeld Ouder en Kind en ook in de relatie tussen Maatje en Werkzoekende. Er werd vervolgens levendig gediscussieerd over het thema van de avond. De aanwezigen droegen daarvoor persoonlijke ervaringen aan die gezamenlijk werden geduid in termen van het door Jos aangereikte gereedschap. De gebruikte dia’s zullen op het intranet komen, zodat de Maatjes de analyse zelf verder kunnen maken in de eigen situatie. Jos is bereid bij vragen daar wat extra begeleiding in te bieden. Er werden mooie nieuwe woorden genoteerd als: geweldloze communicatie en dramadriehoek! Mooi, dat zo in de Maatjesavond bijscholing en ondersteuning van Maatjes en Bestuur vorm begint te krijgen!</p>
			<figure class="figure float-left" style="width: 100%; margin-right: 15px;">
			  <img src="../img/maatjesavond0510.jpg" class="figure-img img-fluid" alt="maatjesavond">
			  <figcaption class="figure-caption">Met z'n allen aan de slag</figcaption>
			 </figure>
			<h3>Inbreng bestuur</h3>
			<p>In het tweede deel gaf voorzitter Jan Waaijer aan hoe de huidige arbeidsmarkt ons werk heeft beïnvloed.  Helaas is het voor de werkzoekenden met problemen nog steeds erg moeilijk te slagen op die markt. En steeds vaker is sprake van multiproblematiek. Het is belangrijk die tijdig te onderkennen. Het is nodig dicht bij de mensen te komen, maar dat is eigenlijk alleen maar moeilijker geworden. Alleen Het Streekblad volstaat niet meer. Jan gaf aan, dat onze speerpunten voor de komende tijd zijn:</p>
			<ul>
			<li>Maatjes centraal stellen </li>
			<li>Doelgroepen beter bereiken</li>
			<li>Samenwerking partners verdiepen</li>
			<li>Communicatie versterken</li>
			</ul>
			<p>Een recente sterkte-zwakteanalyse van enkele van de betrokken vrijwilligers, coördinatoren  en bestuursleden van onze JobGroups lieten het volgende beeld zien:</p>
			<ul>
			<li>Sterk:	De methode JG deugt (materiaal, opbouw in stappen)</li>
			<li>Sterk:	De kwaliteit van de JG-leiders hoog</li> 
			<li>Zwak:	doelgroepen moeilijker bereikbaar geworden</li>
			<li>Zwak:	taalproblemen en cultuuraspecten toegenomen</li>
			<li>Zwak:	selectie aan voorkant en achterkant te dun</li>
			</ul>
			<p>Als denkrichting van ‘Hoe Verder’ kwamen als elementen naar voren:</p>
			<p>Versterk de voorkant door aan de stappen toe te voegen een informatiebijeenkomst en een intakebijeenkomst. Probeer zo betere groepen te maken, die te begeleiden zijn en ook de eindstreep kunnen halen. Werk aan de voorkant samen met Gilde en mogelijk ook Piëzo en in geval van deelnemers van het AZC ook COA.</p>
			<p>Aan de achterkant is het met certificaat afronden van de JG al een succes. Niet voor iedereen zal dan direct een baan te bereiken zijn ook al hebben ze de eerste stappen gezet. De deelnemers waarvoor wel een baan een gerede mogelijkheid is kunnen we daarin begeleiden. In geval van AZC-deelnemers zal dan we een status beschikbaar moeten zijn. Aan de achterkant zal ook meer samenwerking met het RMT gezocht worden, omdat deze de regionale arbeidsmarkt bestrijken.</p>   
			<p>Dit aangepaste JG concept wordt de komende tijd verder uitgewerkt om na de grote vakantie toegepast te worden.</p> 
			<h3>Overige onderwerpen</h3>
			<ol>
			<li>De rollen binnen JHM en de bemensing daarvan werd doorgelopen. Peter zal een apart berichtje maken hierover.</li>
			<li>JHM doet mee aan de informatiemarkt op het Stadsfestival van 16 september. Wie helpt mee?</li>
			<li>Jan Geerdes blijft nog dit hele jaar zijn goede werk aan internet en intranet voor JHMZ doen. Daarna stopt dit. Jan gaat ook verhuizen. Wie wil dit gaan doen of kent iemand hiervoor? Is belangrijk voor ons!</li>
			<li>Dit jaar bestaat JHMZ vijf jaar. De Maatjesavond van 26 juni zal daarom een feestelijk karakter dragen. Reserveer allemaal alvast deze avond. Joke zal met nadere informatie komen!</li> 
			<li>JHM Nederland is toegetreden tot de Keten van Hoop. Dat is een samenwerking met SchuldHulpMaatje, Present, Hip Helpt, Tijd voor Aktie en JobHulpMaatje.</li> 
			<li>En JHM is toegetreden tot de Stichting Nederland Geldzorgenvrij. Dat gaat helpen effectiever in de multiproblematiek te kunnen optreden.</li>
			</ol> 
			<p>Peter houdt ons van de verdere ontwikkelingen op de hoogte.</p> 



		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
