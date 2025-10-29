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
			table.table-bordered{
				border:1px solid black;
				margin-top:20px;
			  }
			table.table-bordered > thead > tr > th{
				border:1px solid black;
			}
			table.table-bordered > tbody > tr > td{
				border:1px solid black;
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
		<div class="container verslag my-5"">
			<h3 class="bluefont">2 maart 2021</h3>
			<h1 class="text-black mb-2 bluefont">Nieuw maatje Ben Schouten stelt zich voor....</h1>
			<p>Hoi beste medemaatjes,</p>
			<p>Door Joke is de vraag gesteld wat info over mijzelf te geven zodat een ieder een beeld van me kan krijgen.</p>
			
			<p>Mijn naam is Ben Schouten en gelukkig getrouwd met Annelies.</p>
			 
			<img src="../img/benschouten2.jpg" class="figure-img img-fluid rounded" alt="ben schouten">
			<p>Mijn maildres verraad mijn leeftijd al, bouwjaar 1958.
			Ons gezinnetje bestaat uit drie kinderen en 4 kleinkinderen. Een gezellig stel waar we graag onze energie en tijd in steken. Gezelligheid staat voorop. Als de mogelijkheid bestaat, wat helaas in deze tijd even niet kan, trekken we de weekenden erop uit. 
			Weerterbergen is ons lievelingsstekkie. Lekker huisje aan het water, hengeltje uitgooien en een heerlijk biertje erbij. 
			Heb het altijd leuk gevonden om dingen te organiseren. Familieweekenden met groepen van 60 man zie ik als leuke uitdaging. 
			Zo geeft het mij ook altijd veel voldoening als ik wat voor iemand in mijn omgeving wat kan betekenen. Ze weten me inmiddels te vinden voor klussen of ze met raad en daad te assisteren.
			Ik mag van onze regering nog een paar jaar werken, maar ben eigenlijk, na ruim 40 jaar, wel toe aan iets anders dan de logistieke wereld.  Heb een coach in de hand genomen die samen met mij de mogelijkheden aan het onderzoeken is. 
			Telkens komen we uit op hetzelfde punt, me inzetten voor de maatschappij, hetgeen ik kan en ook leuk vind.  
			Je merkt wel dat leeftijd een rol gaat spelen niet iedereen zit op een wat oudere vent te wachten. 
			Maar het gaat me lukken, dat weet ik zeker.  Altijd de positieve kant van het leven blijven zien.</p>  
			
			<p>Zo denk ik als toekomstig maatje dat het mes aan twee kaaten snijdt.  Als het me gaat lukken om iemand straks te kunnen helpen aan een stukje toekomst in een leuke baan is hij/zij tevreden, en heb ik voldoening.</p> 
			
			<p>Pluk de dag, maak er wat moois van.</p>
			
			<p>Groet Ben</p>
			
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
