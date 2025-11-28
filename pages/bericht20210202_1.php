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
			<h1 class="text-black mb-3 bluefont">Terugblik digitale maatjesavond JobHulpMaatje Zoetermeer</h1>
			<h5 class="text-black mb-5 bluefont">Corrie Buren</h5>
			<img class="img-fluid mb-3" src="../img/maatjesavond200125.png" />
			<h3>Maandag 25 januari 2021</h3>
		
			<p>Ik zat klaar met een heerlijk kopje thee en zag één voor één mijn collega maatjes online komen. Het blijft apart om virtueel bij elkaar te komen, mooi dat we in een tijd leven dat deze mogelijkheid er is. Natuurlijk vind ik het leuker om mijn medevrijwilligers fysiek te zien. Helaas is dit door corona niet mogelijk en moesten we in december de ‘maatjesavond’ al annuleren. We vinden het belangrijk om elkaar van tijd tot tijd te zien en te spreken, daarom hebben we nu gekozen voor een digitale bijeenkomst. Deze staat in het teken van  ‘verbinding’ met de gelegenheid voor de nieuwe maatjes Lou en Sjanet om zich voor te stellen.</p>
			
			<h3>Goede voorbereiding</h3>
			<p>Door een de goede voorbereiding van Joke en Flip zat het technisch goed in elkaar.
			Flip heeft gezorgd voor een kamerindeling (breakout rooms), voor bij de kennismakingsronden. Ik zag helaas maar negen collega-vrijwilligers op mijn scherm en was hierin niet de enige. Flip gaf ons een tip om je scherm instelling te wijzigen naar theater opstelling, zodat je alle collega’s op het scherm kunt zien.</p>
			
			<h3>Hoe kom je verder?</h3>
			<p>Onze voorzitter opende met een mooi verhaal over ‘hoe kom je verder’? JobHulpMaatje is dit geluk door steeds te kijken naar; hoe komen we verder, kan het beter en waar kunnen we op in spelen. De nieuwe JobGroups Werken in Nederland en de JobGroup voor ZZP’ers zijn hier mooie voorbeelden van. “Helaas zitten we nu in een winterslaap, er ligt veel werk” vertelde Jan. We gaan zoveel mogelijk digitaal door, zo is 22 januari een online Jobgroup van 7 dagen gestart voor werkzoekenden.</p>
			
			<h3>Opzet jaarverslag</h3>
			<p>Via een mooie PowerPointpresentatie, presenteerde Flip de opzet voor het jaarverslag ‘samen werkt het’ en ‘aanpassen en door ontwikkelen’. Hierin zagen we dat JHMZ mooie resultaten heeft bereikt in 2020. Helaas was er door corona wat meer uitval dan in 2019.</p>
			
			<h3>Kennismakingsronden</h3>
			<p>In drie kennismakingsronden, van vijftien minuten per ronde, werden de maatjes in groepjes van 3 of 4 personen ingedeeld, om nader kennis te maken. Dit met de vragen van de drie W's</p> 
			
			<ul><li>Wie ben je (uit wat voor gezin of familie kom);</li>  
			<li>Wat doe je bij de JHMZ (hoe ben je hier terecht gekomen);</li>  
			<li>Waarom doe je dit (wat is het leukste wat je als maatje hebt meegemaakt).</li></ul> 
			
			<p>Dit zorgde voor mooie verhalen. Ik ben zelf pas sinds de zomer werkzaam voor JobHulpMaatje Zoetermeer en heb door deze leuke, spontane manier kennis kunnen maken met collega maatjes en wat hen drijft.</p> 
			
			<h3>Ondernemersnetwerk</h3>
			<p>“Het doel van de het ondernemersnetwerk is een brugfunctie te zijn tussen werkzoekenden en bedrijven”, zo vertelde Chrystal. “Te denken aan snuffelstages en oriëntatiegesprekken bij bedrijven”. Het ligt in de bedoeling om in 2021 hiervoor vijftig bedrijven te hebben. Dit loopt door corona achter. Voor de maatjes is er een mooi overzicht gemaakt van de bedrijven en partners. De werkgroep heeft gezorgd voor een presentatie, waarmee je aan bedrijven kunt laten zien, wat JHMZ doet en wat bedrijven voor ons kunnen betekenen.</p>
			
			<h3>Geslaagde pilot JobGroup ZZP’ers en IWIN</h3>
			<p>Johan blikte nog even terug op succesvolle pilots iWIN en ZZP’ers, beiden zijn december online afgerond. Deze hebben zeker in 2021 vervolg. Een van de deelnemers van de Jobgroup ZZP heeft al een mooie website gemaakt van haar bedrijf.</p>
			
			<h3>Rondvraag en mededelingenronde</h3>
			<ul>
			<li>Chrystal deelde met allen het belang voor je werkzoekenden van een goed LinkedIn profiel, cv en motivatie.</li>
			<li>Marius liep ertegenaan dat er onder werkzoekenden soms behoefte is in het oefenen van specifieke onderwerpen, zoals bij LinkedIn voor ‘beginners’.</li>
			<li>Sjanet gaf een goede tip “vertel de werkzoekende dat het belangrijk is om je Facebook goed dicht te zetten, zodat bij sollicitaties je werkgevers geen mogelijkheden heeft om in je Facebook te kijken”.</li>
			
			<li>Joke sloot de avond af “het was een fijne avond, goed om elkaar digitaal te zien en leuk om zo in ‘kamertjes’ te werken”.</li></ul>
			
			<p>Het was gezellig en informatief, leuk om in groepjes kennis met elkaar te maken en te horen wat mensen drijft om voor JobHulpMaatje te werken.</p>
			
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
