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
			<h3 class="bluefont">30 juni 2022</h3>
			<h1 class="text-black mb-2 bluefont">Verslag bestuursvergadering 28 juni 2022</h1>
			<h5 class="text-black mb-5 bluefont">Peter Veld</h5>
			<p>Het bestuur bedankt Jan Geerdes voor al zijn bijdragen nu hij stopt als Algemeen Coördinator. Gelukkig blijft Jan voorlopig nog een aantal cruciale activiteiten uitvoeren. Die zijn namelijk niet zo maar over te nemen. Dus heel fijn dat Jan die niet uit handen laat vallen. Bedankt Jan!</p>
			
			<p>Natuurlijk is ook stilgestaan bij de vraag hoe nu verder. De richting die volgens het bestuur de voorkeur verdient is een horizontale werkwijze, waarin maximaal gebruik wordt gemaakt van vrijwilligers. De gedachte is te werken in enkele werkgroepen. Daarin blijft ook plaats voor coördinatoren voor die activiteiten waarvoor dat nodig is zonder dat er nog een Algemeen Coördinator is. De komende weken wordt in gesprekken besproken of deze aanpak kan werken en wat daarvoor nodig is. De campagne in de afgelopen twee maanden heeft laten zien, dat een horizontale werkwijze kan werken als er een concreet beeld is van de activiteiten en er voldoende vrijwilligers zijn die een bijdrage leveren.</p> 
			
			<p>Het bestuur heeft ook stilgestaan bij de campagne. Deze was bedoeld om na een moeilijke periode van lockdowns en andere beperkingen door Corona dat van ons af te schudden met een aantal extra activiteiten en met publiciteit. En natuurlijk daarmee JobHulpMaatje weer stevig op de kaart te zetten. Dat is gelukt. De vele extra activiteiten op de dinsdagen, de succesvolle JobGroup iWIN voor mensen uit het AZC en de partnerbijeenkomst hebben heel wat teweeg gebracht. Er werd geflyerd in Zoetermeer en er waren ook gerichte flyers voor de doelgroep migranten en jongeren. Helaas lukte de eerste poging tot een JobGroup te komen met deelnemers via De Binnenbaan niet. Dat geeft aan hoe moeilijk dat is.De moed wordt niet opgegeven. Op 5 juli heeft Peter Veld daarover een gesprek met De Binnenbaan. Het bestuur bedankt alle vrijwilligers, die zich ingezet hebben voor deze campagne. De resultaten mogen er zijn.</p>
			
			<p>Het komt er nu op aan een plan voor vervolgactiviteiten te maken. Daaraan zal komende weken worden gewerkt. Je kunt ook zelf Peter Veld hiervoor benaderen.Deze activiteiten zullen samen met de uitgewerkte aanpak voor organisatie en werkwijze de kern vormen van een Maatjesavond, die direct na de vakantieperiode zal worden gehouden. Daar horen jullie nog meer over.</p>
			
			<p>Voor nu bedankt het bestuur iedereen voor haar of zijn bijdrage in de afgelopen periode en wenst het bestuur iedereen een fijne zomer toe.</p>
			
			<p>Het Bestuur</p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
