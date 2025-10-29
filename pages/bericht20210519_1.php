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
			<h3 class="bluefont">24 mei 2021</h3>
			<h1 class="text-black mb-3 bluefont">Nederland kruipt uit het dal(letje)</h1>
			<h5 class="text-black mb-5 bluefont">Jan Geerdes</h5>
			<h4>Hoe gaat het met de instroom?</h4>
			<p>Het is al eerder geconstateerd: nog steeds merken we dat het aantal aanmeldingen bij JobHulpMaatje voor ondersteuning achterblijft bij wat we verwachtten. 
				En niet alleen wij zijn verbaasd.</p>
				<div class="image">
					<img src="../img/CBS2105191.png" class="my-2 float-right" style="width: 100%; margin-left: 15px;">
					<p>Het aantal werkende mensen stijgt weer<br/>(Bron: <a href="https://www.cbs.nl/?sc_itemid=69d70ce3-91e0-490f-b9a9-0539a9ff3467&sc_lang=nl-nl" _target="new">CBS.nl</a> 19 mei 2021)</p>
				</div>
				<p>Uit cijfers van het CBS blijkt dat de werkeloosheid, na een korte opleving aan het begin van de pandemie, weer afneemt en alweer bijna op het niveau van vóór Corona is gekomen. 
				En als je de berichten van vorige week (18 mei) heb gehoord of gelezen, dan weet je dat het aantal vacatures in Nederland nu heel snel stijgt door o.a. de versoepelingen van de Corona-maatregelen. 
				M.a.w. het wordt voor mensen die werk zoeken makkelijker om werk te vinden.</p>
				<div class="image">
					<img src="../img/CBS2105192.png" class="my-2 float-right" style="width: 100%; margin-left: 15px;">
					<p>De snelle daling van het aantal werkelozen<br/>(Bron: <a href="https://www.cbs.nl/?sc_itemid=a096c817-0062-463c-8540-5ae6e9e5c376&sc_lang=nl-nl" _target="new">CBS.nl</a> 19 mei 2021)</p>
				</div>
				<p>Uiteraard is dat een uitgesproken gunstige zaak voor Nederland. Maar voor JobHulpMaatje zou dat vooral kunnen betekenen dat er minder behoefte is aan Jobgroups en Maatjes.
				De vraag is natuurlijk of deze trend doorzet of dat er, o.a. als nawerking van de pandemie, de werkgelegenheid in de komende tijd toch zal dalen. 
				De steunmaatregelen van de overheid komen immers ook tot een einde.</p>
				<div class="image">
					<img src="../img/CBS2105193.png" class="my-2 float-right" style="width: 100%; margin-left: 15px;">
					<p>Het aantal langdurig werkelozen daalt minder snel<br/>(Bron: <a href="https://www.cbs.nl/?sc_itemid=a096c817-0062-463c-8540-5ae6e9e5c376&sc_lang=nl-nl" _target="new">CBS.nl</a> 19 mei 2021)</p>
				</div>
				 
				<p>Hoe het ook zij, het verleden heeft al aangetoond dat voorspellen een hachelijke onderneming is. Afwachten blijft over.</p>
				<h4>Verborgen werkeloosheid</h4>
				<p>Maar JobHulpMaatje heeft in de praktijk toch vooral te maken met mensen die, om de een of andere reden, het lastig vinden om geheel zelfstandig nieuw werk te vinden. Vaak zijn ze al wat langer bezig en soms staan ze ook niet
					als 'werkzoekende' in de statistieken genoteerd. Zij worden dan niet meegeteld in de officiële cijfers. De cijfers van het CBS geven dus maar een deel van de werkelijkheid weer.</p>
				<p>Juist voor deze mensen kan JobHulpMaatje een waardevolle steun in de rug zijn. Maar we moeten constateren dat ze ons lastiger kunnen vinden, mede door de achterstand op de arbeidsmarkt.</p>
				<h4>De komende tijd</h4>
				<p>Voor JobHulpMaatje betekent het twee dingen: voor dit jaar draaien we minder jobgroups dan we dachten en het aantal werkzoekenden dat een maatje zoekt is ook wat kleiner dan voorspeld.
				Volgend jaar is nog ver weg en zeker onder de huidige omstandigheden is het vrijwel onmogelijk er iets zinnigs over te zeggen. We weten dat er ooit een einde gaat komen aan de NOW-regelingen, de steun die bedrijven krijgen om hun werknemers 
				door te betalen tijdens de pandemie. Maar wat die beëindiging zal betekenen is nog onduidelijk.</p>
				<p>De zomer komt er nu aan, er mag weer meer, dus veel mensen willen leuke dingen doen.</p>
				<p>In de tussentijd blijven we klaar staan voor mensen die een steuntje in de rug kunnen gebruiken om nieuw werk te vinden. 
				Door harder op de grote trom te slaan (meer publiciteit, meer social media, een verbeterde website) willen we beter laten zien wie we zijn en wat we kunnen betekenen voor de samenleving. 
				JobHulpMaatje Zoetermeer wil klaar zijn voor de komende jaren, wat die ook mogen brengen.</p>
			
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
