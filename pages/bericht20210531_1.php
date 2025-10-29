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
			<h3 class="bluefont">1 juni 2021</h3>
			<h1 class="text-black mb-2 bluefont">Verslag bestuursvergadering 31 mei 2021</h1>
			<h5 class="text-black mb-5 bluefont">Flip Bakker</h5>
			<h2>Hoe staan we er voor, waar gaan we heen?</h2>
			<h4>Lousy</h4>
			<p>Online vergaderen heeft ook z’n nadelen…. Soms heb je op je vakantieadres een lousy internetverbinding. 
				Dan worden we multimediaal en pakken de telefoon er bij. De volgende keer mag gelukkig weer real-live!</p>
			<h4>Meedogenloos<span><i class="far fa-angry fa-2x"></i></span></h4>
			
			<p>Meedogenloos. Dat was de insteek van de bezinning dit keer. Het bedrijf dat bij de herstart na corona niet de moeite nam om contact op te nemen 
				met een trouwe werknemer die vanwege de corona-bedrijfsstop was ontslagen.
				Hoeveel pijn moet je dan overwinnen voor je in een nieuwe baan kunt starten…. Er kwamen nog een paar voorbeelden langs van dit tegendeel van naastenliefde. 
				Die laatste term hoor je niet veel meer, maar was voor een nieuw bestuurslid van JHM-Nederland wel de centrale waarde om in te stappen. Mooi!</p>
			<h4>Nieuwe Algemeen Coördinator?</h4>
			<p>Een nieuwe algemeen coördinator heeft zich nog niet gemeld / is nog niet gevonden. We zoeken nog door in onze netwerken. Maar willen ook gaan nadenken over plan B. 
				Daarvoor willen we binnenkort rond de tafel met ook de andere coördinatoren: hoe staan we er voor, waar gaan we heen?</p>
			<p>Financieel wordt de ruimte krapper, nu Oranjefonds en Kansfonds hun startbijdragen afbouwen. Toch was er een financiële meevaller te melden: 
				het MAEX-fonds heeft een bijdrage beschikbaar gesteld voor een (ver)nieuw(d)e website. Daar wordt ook al aan gewerkt!</p>
			<p>Vanwege de matige internetverbinding houden we de Stuurgroepvergadering verder kort.</p>
			<h3>Samen werkt het – we gaan ervoor!</h3>		
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
