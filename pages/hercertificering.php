<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_maatje.php');

function sendEmailMessage($emailTo, $voornaam)
{
	$message_subject = "Deelname JHM hercertificering";
	$to_email = $emailTo;
	$from_name = "Joke Sikking";
	$from_email = "joke@jhm-zoetermeer.nl";
	$message_body = "
	Beste " . $voornaam .
	"Je hebt aangegeven deel te kunnen nemen aan de hercertificering voor JobHulpMaatje op:". "\r\n";
	if ()
		$message_body += '22 mei' . '\r\n';
	if ()
		$message_body += '17 juni' . '\r\n';
	if ()
		$message_body += 'geen van de genoemde dagen' . '\r\n';
	$message_body += 'Je definitieve indeling vind je op het intranet.' . '\r\n';	
	$message_body += 'Met vriendelijke groeten' . '\r\n';
	$message_body += 'Joke Sikking' . '\r\n';
	$message_body += 'Coördinator Maatjes' . '\r\n';
		
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= "From: ".$from_name." <".$from_email.">"."\r\n";
		
	mail($to_email, $message_subject, $message_body, $headers);
}

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

if()
{
	
}
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
			
			th td:not(:first-child) {
				text-align: center;
			}
		</style>
	</head>
 
<body style="background-color: #dddddd; font-size: 16px;">
<?php include('../includes/navbar.inc'); ?>
<div class="container my-5">
	<div>
		<h3 class="bluefont">22 april 2021</h3>
		<h1 class="text-black mb-5 bluefont">Hercertificering voor maatjes</h1>
		<h3>Maatje zijn</h3>
		<p>Om als maatje ingezet te kunnen worden voor JobHulpMaatje Zoetermeer moet een vrijwilliger voldoen aan enkele eisen. Dit zijn:</p>
		<ol>
			<li>Het overleggen van een recent verkregen VOG (Verklaring Omtrent Gedrag) aan de Coördinator Maatjes.</li>
			<li>Het behalen van de training 'JobHulpMaatje', verzorgd door JobHulpMaatje Nederland.</li>
			<li>Aangeven dat de vrijwilliger daadwerkelijk als maatje wil worden ingezet aan de Coördinator Maatjes.</li>
		</ol>
		<h3>Maatje blijven</h3>
		<p>JobHulpMaatje vraagt veel aan vrijwilligers voordat ze als maatje aan de slag kunnen. Eénmalig een training volgen is niet voldoende want het is 
			noodzakelijk dat kennis actueel is en actief wordt bijgehouden. Daarom verplicht JobHulpMaatje iedere vrijwilliger zich periodiek te hercertificeren om blijvend als maatje te kunnen optreden.</p>
		<p>JobHulpMaatje Zoetermeer is gestart in 2018 met de eerste maatjes en vervolgens gestaag gegroeid. Inmiddels is de lichting maatjes van 2018 en 2019 toe aan een opfriscursus. 
			Deze is verplicht om ook na twee jaar nog als maatje te kunnen worden ingezet.</p>
		<p>Dit jaar zijn er twee data vastgesteld waarop hercertificering mogelijk is. Vanwege Corona zal dat alleen digitaal mogelijk zijn. De data zijn:</p>
		<ul>
			<li>donderdag 22 mei</li>
			<li>donderdag 17 juni</li>
		</ul>
		<h3>Hercertificering</h3>
		<p>Dit is de lijst van vrijwilligers die zich dit jaar moeten laten hercertificeren. 
			Het verzoek is om in de lijst aan te geven op welke dag je beschikbaar bent hiervoor. 
			Je kunt beide dagen aangeven. Joke zal dan aan je doorgeven op welke dag je vervolgens wordt ingedeeld.</p>
		<p>De bijgaande lijst wordt z.s.m. aangepast zodra je gegevens binnen zijn.</p>
	</div>
	<div class="jumbotron">
	<form href="" >
		<div class="mb-3">
			<h3><?= $curr_user->voornaam . ' ' . $curr_user->tussenvoegsels . ' ' . $curr_user->achternaam ?></h3>
		</div>
		<div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input" id="datum1">
			<label class="form-check-label" for="exampleCheck1">Ik kan op 22 mei</label>
		</div>
		<div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input" id="datum2">
			<label class="form-check-label" for="exampleCheck1">Ik kan op 17 juni</label>
		</div>
		<div class="mb-3 form-check">
			<input type="checkbox" class="form-check-input" id="exampleCheck1">
			<label class="form-check-label" for="exampleCheck1">Ik kan beide dagen niet</label>
		</div>
		<div class="mb-3">
		  <button type="submit" class="btn btn-primary">verstuur</button>
		</div>
	</form>
	</div>
	<table class="table table-sm">
		<thead>
			<tr>
				<th>Naam</th>
				<th>22 mei</th>
				<th>17 juni</th>
				<th>Beide data niet</th>
			</tr>
		</thead>
		<tbody>
			<tr><td>Johan Alebregtse</td></tr>
			<tr><td>Flip Bakker</td></tr>
			<tr><td>Marius Cusell</td></tr></td></tr>
			<tr><td>Sjaak Sibbing</td></tr>
			<tr><td>Jenny Sulkers</td></tr>
			<tr><td>Peter Veld</td></tr>
			<tr><td>Ton Vermeulen</td></tr>
			<tr><td>John Zandbergen</td></tr>
			<tr><td>Jan Geerdes</td><td>ja</td><td>ja</td></tr>
			<tr><td>Paula Keun</td></tr>
			<tr><td>Nico Leeuwen</td></tr>
			<tr><td>Rob Smit</td></tr>
		</tbody>
	</table>	
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
