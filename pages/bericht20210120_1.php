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
			<h3 class="bluefont">20 januari 2021</h3>
			<h1 class="text-black mb-3 bluefont">Maatjesavond met als thema "Verbinden"</h1>
			<h5 class="text-black mb-5 bluefont">Joke Sikking</h5>
			<p>Aanstaande maandag 25 januari houden we een Maatjesavond. Juist nu de lockdown in Nederland steeds strenger wordt, is het belangrijk dat we onderling contact houden, ook wij, van JobHulpMaatje Zoetermeer.</p>
			<p>De meeting is, zoals bekend, online. Iedere deelnemer kan meekijken en meedoen vanachter zijn of haar eigen scherm.</p>
			<p>We doen dat met Microsoft Teams. Teams is een gratis programma en is makkelijk in gebruik. Teams werkt op een PC of Mac, een tablet of een smartphone. Belangrijk zijn de volgende punten:</p>
			<ol>
				<li>Het apparaat dat je gebruikt moet een werkende microfoon en een werkende camera hebben.</li>
				<li>Het is dringend gewenst dat je gebruik maakt van het programma (of app) van Microsoft. Maak dus geen gebruik van de browser-versie van Teams. Dat kan tot problemen met de verbinding leiden.</li>
				<li>Om bij de meeting in te loggen hoef je alleen op een link te klikken. Deze wordt hieronder vermeld als je jezelf hebt aangemeld via de presentielijst.</li>
				<li>Je krijgt vervolgens de vraag of je de app wilt openen. Geef "Ja" als antwoord.</li>
				<li>Dan krijg je een scherm om de instellingen te regelen en de knop "Nu deelnemen". Klik deze knop en wacht dan tot je wordt toegelaten tot de meeting.</li>
				<li>Dat is alles!</li>
			</ol>
			<h3>Programma</h3>
			<table class="table table-striped">
			<tr>
				<th style="width: 20%;">Tijd</th>
				<th style="width: 80%;">Onderwerp</th>
			</tr>
			<tr><td>19.00 uur</td><td>Inloop (je kunt al online toegang vragen)</td></tr>
			<tr><td>19.30 uur</td><td>Inleiding en mededelingen (Jan Waaijer)</td></tr>
			<tr><td>19.40 uur</td><td>mededelingen en voorstellen nieuw maatje Lou (Joke)</td></tr>
			<tr><td>19.50 uur</td><td>introductie kennismakingsronden (Flip)</td></tr>
			<tr><td>20.00 uur</td><td>Dan  wordt er in de groepjes kennis gemaakt met elkaar en dat doen we met vragen van de 3 W's
			<br/>1. Wie ben je? (uit wat voor gezin of familie kom je)
			<br/>2. Wat doe je bij de maatjes? (hoe ben je hier terecht gekomen)
			<br/>3 .Waarom doe je dit? (wat is bijv het leukste dat je als maatje hebt meegemaakt)
			</td></tr>
			<tr><td>20.15 uur</td><td>komt Chrystal Korving aan het woord over ondernemers</td></tr>
			<tr><td>20:30 uur</td><td>nieuwe ronde, nieuwe mensen aan tafel met de 3 W's</td></tr>
			<tr><td>20.50 uur</td><td>komt Johan aan het woord over de afgelopen nieuwe jobgroups ZZP en Iwin</td></tr>
			<tr><td>21.00 uur</td><td>laatste tafelronde met de 3 W's en nieuwe mensen uiteraard.</td></tr>
			<tr><td>21.15 uur</td><td>afsluiting plenair</td></tr>
			</table>
			<p>Je bent uitgenodigd om deel te nemen aan een Microsoft Teams-vergadering</p>
			
			<p>Deelnemen via uw computer of mobiele app</p>
			<?php if ($curr_user->presentInd == 'j'): ?>
			<p><a href="https://teams.microsoft.com/l/meetup-join/19%3ameeting_MWMzMWE4ZGUtNjliYS00MWE1LTgxY2YtMzM4NjBmZjAzNTYw%40thread.v2/0?context=%7b%22Tid%22%3a%221bb0db20-422e-4f15-9a22-51c20c4cccf6%22%2c%22Oid%22%3a%228307987c-aa4a-41e8-a61c-8bea35f17616%22%7d">Klik hier om deel te nemen aan de vergadering</a></p>
			<?php else: ?>
			<p>Je vindt hier de link als je je <a href="presence_list200125.php">aangemeld</a> hebt.</p>
			<?php endif; ?>
			<p>NB. inloggen kan vanaf 19.00u, we willen graag op tijd beginnen.</p>
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
