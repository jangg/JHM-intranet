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
			<h3 class="bluefont">12 juni 2022</h3>
			<h1 class="text-black mb-3 bluefont">Gedeeltelijk afscheid</h1>
			<h3 class="text-black mb-3 bluefont">Jan Geerdes vertrekt</h3>
			<p>Het gebeurt allemaal wat eerder dan ik gepland had toen ik aantrad als Algemeen Coördinator op 1 september 2021. Want op afgelopen 1 juni heb ik zelf de beslissing genomen om niet langer de leiding over JobHulpMaatje Zoetermeer op me te nemen.
			En overigens is juist de laatstgenoemde rol één van de redenen om er mee te stoppen. Want het leiden van een vrijwilligersorganisatie bleek veel lastiger dan ik hoopte en verwachtte.</p>
			<h4>Goede wil</h4>
			<p>Vrijwilligers zijn allemaal mensen van goede wil maar in de praktijk niet makkelijk aan te sturen. Dat is begrijpelijk natuurlijk, want als vrijwilliger doe je het ‘werk’ vanuit je intrinsieke motivatie en niet omdat je een contract hebt met je opdrachtgever. Dus doen waar je geen zin in hebt, dat kan niet aan de orde zijn. Dan ga je wel wat anders doen of je doet gewoon wat je zelf denkt dat goed is. En dan blijft er voor je taak als leider van de groep weinig over. Je wordt dan een soort van coach en klusjesman. Not my cup-of-tea.</p>
			<h4>Betaald werk</h4>
			<p>Dat moest ik even kwijt maar er zijn meer redenen waarom ik ben gestopt. Zo heb ik sinds 1 januari van dit jaar weer een betaalde baan. En dat dankzij JobHulpMaatje. Waarvan heel veel dank aan Joke! Ik werk nu met heel veel plezier zo’n 36 uren per week voor Teleperformance, met onregelmatige werktijden.  Je begrijpt, hierdoor heb ik veel minder tijd voor vrijwilligerswerk over. En je kunt het eerstgenoemde argument natuurlijk niet los hiervan zien.</p>
			<h4>Verhuizen</h4>
			<p>Tot slot nog een reden, hoewel deze niet speelde op het moment dat ik mijn besluit nam: ik ga binnen afzienbare termijn verhuizen richting Veenendaal of omstreken. Waarom? Omdat mijn partner Carla eigenlijk geheel onverwacht een nieuwe baan heeft gevonden, en wel in de omgeving van Barneveld. Daar gaat ze per 1 juli beginnen. Tel daar bij op het feit dat onze kleinkinderen in Veenendaal wonen en je begrijpt de logica achter de beslissing.<br/>
			Dat heeft natuurlijk een enorme impact, zeker voor haar maar ook voor mij. We zijn nu bezig alles in werking te zetten voor de grote transitie. Hoeveel tijd dat in beslag gaat nemen is moeilijk te zeggen maar dat we Zoetermeer gaan verlaten is zeker.</p>
			<h4>Veranderende tijden</h4>
			<p>JobHulpMaatje Zoetermeer vaart op dit moment onder een lastig gesternte. De organisatie ontstond in een tijd dat een behoorlijk aantal mensen moeilijk werk kon vinden en wij velen hulp konden bieden met hun zoektocht naar betaald werk. Maar de tijden zijn veranderd. Met 133 vacatures voor iedere 100 werkzoekenden liggen de banen voor het oprapen. Carla en ik hebben het zelf ondervonden. Iedereen die wil en kan is inmiddels aan de slag. Dat betekent niet dat er geen mensen meer aan de kant staan. Veel mensen met specifieke wensen of in bepaalde situaties hebben nog steeds behoefte aan extra hulp. Hulp die JobHulpMaatje mogelijk kan bieden. Maar die hulp verandert mee met de behoefte. Nu is vaak meer nodig dan alleen jezelf leren kennen, leren solliciteren en een goede CV schrijven. De nadruk komt steeds meer te liggen op persoonlijke begeleiding, de Nederlandse taal goed beheersen en omgaan met je persoonlijke mogelijkheden en beperkingen. 
			Daarom is de samenwerking met de Binnenbaan zo belangrijk.</p> 
			<h4>Zelfsturing?</h4>
			<p>Wat JobHulpMaatje Zoetermeer zelf betreft,  de organisatie gaat op zoek naar een of andere vorm van zelfsturing, waarbij zo min mogelijk top-down wordt bepaald wie wat doet en hoe dat te doen. Zolang de resultaten bevredigend zijn is alles mogelijk.</p>
			<h4>Niet helemaal weg</h4>
			<p>Ik vertrek maar nog niet helemaal. Want ik stond ook aan de wieg van het Intranet, de WAS, het administratiesysteem van JHMZ, en de publieke website. De kennis van deze systemen is moeilijk overdraagbaar. Tenzij iemand een full stack Webdeveloper is met ervaring in backend processen, is het beheer ervan niet eenvoudig. Dat werk kan gelukkig ook op afstand goed worden gedaan en dat blijft ik zeker nog tot 1 januari 2023 doen. En misschien nog wat langer als dat nodig is.</p>
			<h4>Tot slot</h4>
			<p>JobHulpMaatje is een prachtige organisatie maar staat ook voor een flinke uitdaging. Namelijk zichzelf weer opnieuw uitvinden in een periode die heel anders is dan toen ze werd opgericht.  Ik wens alle vrijwilligers heel veel succes en nog heel veel plezier bij JobHulpMaatje Zoetermeer.</p>
			
			<p>Jan Geerdes</p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
