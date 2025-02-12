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
			<h3 class="bluefont">2 maart 2021</h3>
			<h1 class="text-black mb-2 bluefont">Verslag bestuursvergadering 1 maart 2021</h1>
			<h5 class="text-black mb-5 bluefont">Flip Bakker</h5>
			<p>Een korte online-meeting, en daarom deze keer gelijk aan de slag. Met vooral een aantal rapportages van bezoeken aan bedrijven/organisaties in Zoetermeer.</p>
			<p>We hebben kennis gemaakt met het nieuwe gemeentelijke werkbedrijf: de Binnenbaan. Wil meer aansluiten bij de behoefte van hulpvragers, en staat ook meer open voor samenwerking met maatschappelijke partners zoals JobHulpMaatje.</p>
			<p>Er was een contactmoment met voorzitter en directeur van Piëzo. We vullen elkaar aan, en dat is goed om op voort te bouwen. 
				De daad bij het woord: JHM is aanwezig geweest bij twee Piëzo-sessies ‘Mannen in Ontwikkeling’, mannen die toegroeien naar de stap richting arbeidsmarkt.</p>
			<p>Er is een gesprek geweest met HenkWillem van Dorp (vDorp Installaties). Hij staat open voor netwerk-contacten met zijn bedrijf (de eerste keer even via Jan Waaijer of Chrystal Korving). 
			De toegevoegde waarde van JHM ligt volgens vDorp mn. in het vergroten van het sociaal vermogen en in de presentatie van netwerkers.</p>
			<p>Uit het contact tussen Forumpartners vloeiden enkele gesprekken voort met Taalmaatjes. 
			De JHM-wens om werkzoekers mogelijk sneller met ook hun taal te helpen, valt samen met de ervaring van de Taalmaatjes dat het beter werken is met gemotiveerde deelnemers. 
			Zo kunnen we elkaar vinden en helpen. Afgesproken is om binnenkort in elkaars nieuwsbrieven te publiceren.</p>
			<p>Wat betreft de voortgang hebben we even stil gestaan bij het besluit om de JobGroup 2021-2, gepland voor de donderdagavond en met een start op 4 maart, te cancellen. 
			Vanwege te weinig aanmeldingen.</p>
			<p>Voldoende aanmeldingen zijn er inmiddels voor de JobGroup-ZZP (start 19 maart).</p>
			<p>De volgende stuurgroepvergadering op 29 maart hopen we weer live te kunnen doen!</p>
			
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
