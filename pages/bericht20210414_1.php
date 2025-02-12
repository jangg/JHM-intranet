<?php
include_once('../config.php');
include_once('../class/c_user.php');
/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
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
			<h3 class="bluefont">14 april 2021</h3>
			<h1 class="text-black mb-3 bluefont">Laatste (?) Maatjesavond in Coronatijd</h1>
			<h5 class="text-black mb-5 bluefont">Joke Sikking</h5>
			<h4>Online</h4>
			<p>Aanstaande maandag 19 april houden we weer een Maatjesavond. Tot ieders verbazing en verdriet zitten we nog steeds in een lockdown en kunnen we weer niet met z'n allen bij elkaar komen.</p>
			<p>Nou ja, inmiddels zijn we al gewend dat alles via beeldschermen gaat. Dus ook deze Maatjeavond.</p>
			<h4>Met Teams</h4>
			<p>We doen dat weer met Microsoft Teams. Teams is een gratis en relatief makkelijk in gebruik. Let op de volgende punten:</p>
			<ol>
				<li>Het apparaat dat je gebruikt moet een werkende microfoon en een werkende camera hebben.</li>
				<li>Het is dringend gewenst dat je gebruik maakt van het programma (of app) van Microsoft. Maak dus geen gebruik van de browser-versie van Teams. Dat kan tot problemen met de verbinding leiden.</li>
				<li>Om bij de meeting in te loggen hoef je alleen op een link te klikken. Deze wordt hieronder vermeld als je jezelf hebt aangemeld via de presentielijst.</li>
				<li>Je krijgt vervolgens de vraag of je de app wilt openen. Geef "Ja" als antwoord.</li>
				<li>Dan krijg je een scherm om de instellingen te regelen en de knop "Nu deelnemen". Klik deze knop en wacht dan tot je wordt toegelaten tot de meeting.</li>
				<li>Dat is alles!</li>
			</ol>
			<h4>Programma van de avond</h4>
			<table class="table table-striped">
			<tr>
				<th style="width: 20%;">Tijd</th>
				<th style="width: 80%;">Onderwerp</th>
			</tr>
			<tr><td>19.00 uur</td><td>Inloop (je kunt al online toegang vragen)</td></tr>
			<tr><td>19.30 uur</td><td>Inleiding en mededelingen (Jan Waaijer)</td></tr>
			<tr><td>19.40 uur</td><td>De stand van zaken rond JobHulpMaatje in cijfers (Flip)</td></tr>
			<tr><td>19.50 uur</td><td>Hoe gaat het met de jobgroups in 2021 (Johan)</td></tr>
			<tr><td>20.00 uur</td><td>Korte rondleiding door het intranet (Jan Geerdes)</td></tr>
			<tr><td>20.10 uur</td><td>Corona-tijd en de maatjes, hoe gaat het? (allen, o.l.v Joke)</td></tr>
			<tr style="background-color: #eed8d8;"><td>20.30 uur</td><td>Pubquiz (allen, meer info volgt in de komende dagen)</td></tr>
			<tr style="background-color: #eed8d8;"><td>21.00 uur</td><td>Wie zijn de winnaars en wie zijn de verliezers?</td></tr>
			<tr><td>21.10 uur</td><td>Rondvraag</td></tr>
			<tr><td>21.15 uur</td><td>Afsluiting plenair</td></tr>
			</table>
			
			<h4>Tot slot</h4>
			<p>Je bent uitgenodigd om deel te nemen aan een Microsoft Teams-vergadering</p>
			
			<p>Deelnemen via uw computer of mobiele app</p>
			<?php if ($curr_user->presentInd == 'j'): ?>
			<p><a href="https://teams.microsoft.com/l/meetup-join/19%3ameeting_MWRlNTVhN2MtYzk5Ni00ZjhjLWI2MmEtNGM4ZTg4ZjBlNTYy%40thread.v2/0?context=%7b%22Tid%22%3a%2202c9bfeb-102a-4cf9-a91f-7b04c9dd3041%22%2c%22Oid%22%3a%222f367c44-806e-4f10-94b9-0f2d1c971511%22%7d">Klik hier om deel te nemen aan de vergadering</a></p>
			<?php else: ?>
			<p>Je vindt hier de link als je je <a href="presence_list200419.php">aangemeld</a> hebt.</p>
			<?php endif; ?>
			<p>NB. inloggen kan vanaf 19.00u, we willen graag op tijd beginnen.</p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
