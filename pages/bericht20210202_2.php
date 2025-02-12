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
			<h3 class="bluefont">2 februari 2021</h3>
			<h1 class="text-black mb-2 bluefont">Verslag bestuursvergadering 1 februari 2021</h1>
			<h5 class="text-black mb-5 bluefont">Flip Bakker</h5>
			<figure class="figure">
				  <img src="../img/1200px-Sandro_Botticelli_-_La_nascita_di_Venere_-_Google_Art_Project_-_edited.jpg" class="figure-img img-fluid rounded" alt="De geboorte van Venus">
				  <figcaption class="figure-caption">De geboorte van Venus door Botticelli.</figcaption>
				</figure>
			<p>Je hoeft niet ziek te zijn om beter te worden. Dat was het motto waar we bij de opening een moment bij hebben stilgestaan. Het schilderij ‘geboorte van Venus’ (Botticelli), hangt in Florence naast het werk ‘de zeven deugden’. Uiterlijke schoonheid en innerlijke schoonheid. ‘Fortitudo’, een van die zeven deugden staat voor ‘moed, zelfvertrouwen’. Dat kan ook doorslaan, dan wordt het oevermoed, zelfoverschatting. Ter illustratie: een onderzoek wees uit dat 74% van de hoogleraren zichzelf beter acht dan hun collega’s – daar heb je hogere wiskunde voor nodig om dat uit te leggen…. Dat gevaar schuilt in ons allemaal. Niet voor niets dat in de zeven deugden ook de ‘Prudentia’ is opgenomen – voorzichtigheid, wijsheid.</p>
			<figure class="figure">
				  <img src="../img/2880px-Botticelli+P.Pollaiolo_-_theological_and_cardinal_virtues_-_Uffizi.jpg" class="figure-img img-fluid rounded" alt="De 7 deugden">
				  <figcaption class="figure-caption">De 7 deugden door Botticelli en Pollaiolo.</figcaption>
				</figure>
			<p>We hebben even teruggeblikt op de Maatjesavond van vorige week – een geslaagd evenement, goed voor de teamspirit. En – tel je zegeningen – de toegenomen digitale vaardigheid, waardoor het nagenoeg probleemloos verliep. Dat mag ook worden geconstateerd bij de start van online-workshop: ook daar haakten de deelnemers al twee keer probleemloos en vol goede moed aan.</p>
			<p>Centraal deze vergadering stonden de (financiële) verantwoording over 2020 en het perspectief voor de komende jaren. Het jaarverslag is vastgesteld (komt binnenkort beschikbaar). Dat leidde tot het inzicht in twee corona-effecten: aan de ene kant een verschuiving naar meer hulpvragers vanuit de ww bij de instroom. Aan de andere kant stroomden meer hulpvragers door naar 2021. Duidelijke signalen dat het moeilijker wordt om op de arbeidsmarkt een goede plek te vinden.</p>
			<p>Meer uitvoerig hebben we gesproken over het (financiële) perspectief. De eerste jaren van projectsteun door Kans- en Oranjefonds zitten er nu bijna op: in 2021 worden die bijdragen afgebouwd. Dat betekent dat we dit jaar ook moeten gebruiken om voor de komende jaren meer in te zetten op bijdragen uit andere bronnen (mn. gemeente, bedrijfsleven, deelnemers) en nieuwe bronnen aan te boren (bijv. projectfinanciering door Fonds1818). Daarbij is het ook goed om de mogelijkheden te bezien van meer samenwerking met organisaties zoals SchuldHulpMaatje en Piëzo. Ook deze organisaties zullen nadenken over de (financiële) continuïteit. Mogelijk kunnen we wat van elkaar opsteken.</p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
