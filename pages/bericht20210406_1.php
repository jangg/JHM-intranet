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
			<h3 class="bluefont">6 april 2021</h3>
			<h1 class="text-black mb-2 bluefont">Nieuw maatje Pieter Hoevers stelt zich voor....</h1>
			<img src="../img/pieterhoevers2.jpg" class="figure-img img-fluid rounded ml-2" style="float: right; width: 60%;" alt="pieter hoevers">
			<p>Mijn naam is Pieter Hoevers. Ten tijde van dit schrijven (april 2021) 55 jaar oud, de gelukkige vader van 2 dochters van 27 en 24 jaar en wonend in Nootdorp. 
			Inmiddels alweer ruim 15 jaar werkzaam bij bouwconcern VolkerWessels in diverse functies. Gestart met een financiële functie die ik sinds 2012 heb ingeruild voor functies op het gebied van HR/Payroll.</p> 
			<p>In beginsel de dagelijkse werkzaamheden op een HR/Payroll afdeling en in 2015 de overstap gemaakt naar de ondersteunende kant waarbij je moet denken aan de functie van HR/Payroll consultant. 
			Dat betekent in de praktijk het op projectbasis implementeren van software, trainingen verzorgen, begeleiding tijdens de livegang en de nazorg. 
			Na zo’n traject volgt dan normaliter nog een periode van optimalisaties en daarna staat meestal het volgende project klaar. 
			Naast HR/Payroll software is dat op dit moment de implementatie van een compleet ERP pakket. Ook leuk om te doen.</p>
			
			<p>Naast mijn werk doe ik het nodige vrijwilligerswerk alhoewel dat nu vanwege de Coronacrisis zo goed als stil staat.</p> 
			<p>ls dat allemaal voorbij is dan hoop ik weer actief bezig te zijn bij een woonzorgcentrum (activiteiten voor de bewoners), bij het theater in Nootdorp, als City Host in Den Haag en bij korfbalvereniging Avanti in Pijnacker.</p> 
			<p>Tussen alles door probeer ik mijn conditie op peil te houden door regelmatig hard te lopen en te wandelen. 
			Normaliter gaan we (dat zijn mijn vriendin en ik) graag in de zomer naar Italië op vakantie maar ook weekendjes weg in Nederland vinden we leuk. 
			Na Corona pakken we dat zeker weer op. Enkele jaren geleden kreeg het “verre reizen virus” mij te pakken. In 2019 ben ik in mijn uppie met mijn backpack op het vliegtuig naar Cambodja gestapt en heb daar 4 weken rondgereisd. 
			Wat een spannende en mooie ervaring was dat. Gewoon ter plekke dingen regelen en heel veel mensen in hostels ontmoeten. Dat smaakt naar meer!</p>
			
			 
			
			<p>Maar goed, op deze leeftijd ga je ook eens nadenken over de laatste 13 jaar van je werkzame leven. 
			Althans, ik ben dat gaan doen en laat je in de CAO Bouw & Infra nu net hele fijne voorzieningen hebben zoals een 4 daagse werkweek. 
			Daar ga ik vanaf deze maand gebruik van maken wat mij ruimte geeft om verder na te denken.</p> 
			
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
