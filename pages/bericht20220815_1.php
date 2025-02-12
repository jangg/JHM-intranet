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
			<h3 class="bluefont">15 augustus 2022</h3>
			<h1 class="text-black mb-2 bluefont">Pilot Samenwerking JobHulpMaatje</h1>
			<h5 class="text-black mb-5 bluefont">Betrokkenen: Peter Veld (namens JHM), 
				  Khalid Belhadj, Cajetan Lieszner en Wouter Nieuwenhuis (namens de Binnenbaan)</h5>
				  <h4>Aanleiding:</h4>
				  <p>JobHulpMaatje ondersteunt inwoners van Zoetermeer die dat nodig hebben in hun zoektocht naar werk of vrijwilligerswerk. Zij doen dit op verschillende manieren. Dit kan individuele begeleiding door een maatje zijn, een jobgroup van zeven bijeenkomsten of workshops.</p> 
				  <p>JobHulpMaatje heeft aangegeven haar dienstverlening graag aan te bieden aan kandidaten van de Binnenbaan, om zodoende nog meer mensen de kans te geven de stap naar werk- of vrijwilligerswerk te maken.</p> 
				  <p>De pilot richt zich op kandidaten die in kwadrant 4 van de zelfredzaamheidsmatrix vallen en gemotiveerd zijn een stap naar betaald werk of vrijwilligerswerk te zetten. 
				  De kandidaten in kwadrant 4 ontvangen, conform de opdracht van de gemeente Zoetermeer, ‘volgende dienstverlening’ van de Binnenbaan. Dit houdt in dat er vanuit de Binnenbaan geen actieve inzet gepleegd wordt, anders dan monitoring.</p> 
				  
				  <p>Begeleiding van JobHulpMaatje biedt het voordeel dat zij meer tijd en energie aan deze kandidaten kunnen besteden dan mogelijk is voor de Binnenbaan. Daarnaast is de verwachting dat de dynamiek anders is omdat het geen overheidsorganisatie is en de begeleiding op basis van vrijwilligheid geschiedt.</p> 
				  <p>De doelstelling is om voor 1 september 10 kandidaten te hebben aangemeld. Dit is geen harde prestatieafspraak, aangezien aanmelden op basis van vrijwilligheid zal zijn. 
				  JobHulpMaatje gaat deze kandidaten ondersteunen bij het zetten van stappen richting betaald of onbetaald werk.</p> 
				  <h4>Proces: </h4>
				  <ol>
				 <li>Khalid en Cajetan spreken deze kandidaten en polsen goed of zij open staan voor de begeleiding van JobHulpMaatje;</li> 
				 <li>De contactgegevens worden in overleg met de kandidaat gedeeld met JobHulpMaatje, waarna JobHulpMaatje contact zal opnemen;</li>
				 <li>JobHulpMaatje bepaalt op basis van een intake welke dienstverlening ze de kandidaat bieden. Uitgangspunt is om snel na aanmelding te starten met individuele begeleiding. In overleg met een deelnemer kan deze ook deelnemen aan een JobGroup of workshops.</li> 
				 <li>Cajetan en Khalid blijven contactpersoon voor de kandidaten en voor de vrijwilligers van JobHulpMaatje. Dit betekent dat ze een caseload opbouwen in het kader van deze pilot; vrijwilligers van JobHulpMaatje spreken de contactpersonen bij Binnenbaan altijd met medeweten van de deelnemer.</li> 
				  <li>Indien een kandidaat klaar is om de stap naar betaald werk te zetten kunnen deze kandidaten, via Khalid en Cajetan, onder de aandacht worden gebracht van het Werkgevers Service Punt.</li>
				  </ol>
				  <h4>Randvoorwaarden:</h4> 
				  <ul>
				 <li>De kandidaten worden aangemeld op basis van vrijwilligheid;</li>
				 <li>Kandidaten worden 4 maanden begeleid door JobHulpMaatje. Gedurende deze maanden worden er vanuit de Binnenbaan geen andere re-integratieverplichtingen opgelegd;</li>
				 <li>Als er na 4 maanden aanleiding is de begeleiding door JobHulpMaatje voort te zetten, al dan niet in combinatie met de stap naar het Werkgevers Service Punt, dan kan dat door de deelnemer, Binnenbaan en JobHulpMaatje worden afgesproken.</li> 
				 <li>Mocht een kandidaat bij nader inzien toch niet openstaan voor ondersteuning van JobHulpMaatje wordt dit teruggekoppeld aan de Binnenbaan. Er wordt dan een gesprek gevoerd met de kandidaat, maar dit zal in verband met de vrijwilligheid in geen geval tot een maatregel leiden.</li>
			 </ul> 
				  <h4>Evaluatie</h4>
				  <p>Na afloop van de pilot willen we een aantal vragen beantwoord zien:</p>
				  <ol>

				  <li>Zijn dit kandidaten voor wie ondersteuning vanuit JobHulpMaatje toegevoegde waarde heeft?</li>
				 <li>Hoe ziet de ondersteuning er in de praktijk uit en welke resultaten zijn er geboekt?</li>
				 <li>Hoe ervaren de kandidaten de begeleiding van JobHulpMaatje?</li>
				  <li>Wat vraagt het aan inzet van de Binnenbaan?</li>
				  <li>Wat vraagt het van de vrijwilligers van JobHulpMaatje?</li>
				  </ol>
				  <p>Om deze vragen te kunnen beantwoorden worden twee gesprekken gepland met Peter Veld namens JobHulpMaatje en Cajetan, Khalid en Wouter namens de Binnenbaan. 
				  Lisanne Vis is vanuit de Binnenbaan opdrachtgever van deze pilot. </p>

		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
