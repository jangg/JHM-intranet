<?php
include_once('config.php');
include_once('class/c_user.php');

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
<html>
	<head>
		<?php include('includes/head.inc'); ?>			
		<style>
			.bluefont {
				color: #304280;
				font-weight: 300;
			}
		</style>
	<!-- Custom styles for this template -->
		<link href="css/jumbotron.css" rel="stylesheet">
	</head>
 
<body style="background-color: #dddddd; font-size: 16px;">
	
	<?php include('includes/navbar.inc'); ?>
	<main role="main">
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
			<div class="container">
				<!-- <img src="img/LogoJobHulpMaatjeZoetermeer.jpg" class="mb-4 p-3 img-fluid rounded mx-auto d-block bg-white"> -->
				<h5 class="bluefont">11 september 2020, Flip Bakker</h5>
				<h2 class="display-4 bluefont">Workshop: Solliciteren nu – Netwerken</h2>
				<h3 class="bluefont">Inleiding</h3>
				<div class="row">
					<div class="col-md">
					<p>Vanaf 18 augustus 2020 organiseren we weer wekelijks, op dinsdagochtend, de workshops SolliciterenNu-NetWerken waar deelnemers in groepsverband kunnen oefenen aan de hand van een speciaal thema en waar hun specifieke problemen en/of vragen met elkaar kunnen worden besproken. Dit is de plek om aan je brief te werken, je cv te updaten, het sollicitatiegesprek te oefenen, naar vacatures te zoeken, enz. enz. En vooral de plek om met mensen in een vergelijkbare situatie te netwerken.</p>
					</div>				
					<div class="col-md">
						<p>	Daarnaast is er op de laatste dinsdagochtend van de maand het Netwerkcafe / Walk&Talk in samenwerking met de Bibliotheek: een ontmoetingsplaats waar werkzoekende elkaar in een informele omgeving kunnen ontmoeten om ervaringen uit te wisselen en om elkaar te helpen met hun netwerk. Meestal is er een korte inleiding rond een bepaald thema waarover eveneens van gedachten kan worden gewisseld.</p>
					</div>
				</div>
				<img src="img/schema_workshopdeelname.png" class="text-center" style="width: 85%;">
				<h3 class="bluefont">Doelgroep</h3>
				<p>Werkzoekenden die staan ingeschreven hij JobHulpMaatje Zoetermeer en deelnemen of deelgenomen hebben aan Jobgroups en/of werkzoekenden die op basis van intake door JHM voor de workshop zijn aangemeld.</p> 
				<h3 class="bluefont">Inzet</h3>
				<ul>
				<li>Jobfinding (obv LDC/TrjcT)</li>
				<li>Functie/vacature-analyse</li>
				<li>Netwerkversterking</li>
				<li>Netwerkactivering</li>
				<li>Sollicitatievaardigheden (mn. XYZ+ en STAR)</li>
				<li>Persoonlijke Vaardigheden (mn. Belemmerende Overtuigingen)</li>
				</ul>
				<h3 class="bluefont">Uitgangspunten</h3>
				<ul>
				<li>Deelname is vrij (geen opkomst-verplichting), maar opgave vooraf is verplicht.</li> 
				<li>Bij intake van de werkzoekende is met de werkzoekende gekeken naar zijn of haar mogelijkheden en beperkingen, alsmede het (opleidings-)niveau. (Zie nevenstaand  schema).</li>
				<li>Bij de intake-procedure heeft de deelnemer een TrjcT-account gekregen en is door werkzoekende reeds een vacature-alert aangemaakt.</li>  
				<li>Die vacature staat centraal: analyse, netwerkafspraken, oefeningen XYZ, STAR en B.O.</li>
				<li>Uitgangspunt van de workshop is coaching en intervisie.</li>
				<li>Deelnemers helpen zoveel mogelijk elkaar (elkaars netwerk).</li>
				<li>Stimuleren dat ook maatjes (van deelnemers) mee doen.</li> 
				<li>Voor deelnemers die niet op eigen kracht netwerk-afspraken voor elkaar krijgen, kan optioneel acquisitie worden gedaan.</li>
				<li>Successen markeren</li>
				</ul>
				<h3 class="bluefont">Opzet programma</h3>
				<p>Tijdens deze ochtenden doen we meestal een rondje ‘Keek op de week’, waarbij de deelnemers iets vertellen over hun sollicitaties of voorbereidingen erop. Daarna wordt ingezoomd op een specifiek onderdeel, eerder behandeld in de Jobgroup. Ook is het de bedoeling die ochtend zo veel mogelijk te netwerken of daarmee te oefenen, waarbij - obv de uitkomsten van de vacature alert - zoveel als mogelijk de netwerkcontacten in de Jobgroup, maatjes en het bedrijvennetwerk worden ingezet.</p>
				
				<table class="table table-light table-sm table-striped">
					<tr><td>08.45u</td><td></td><td></td><td>Inloop</td></tr>
					<tr><td>09.00 </td><td>–</td><td>09.30u</td><td>Uitwisseling ervaring afgelopen week</td></tr>
					<tr><td>09.30 </td><td>–</td><td>09.45u</td><td>blokje tips </td></tr>
					<tr><td>09.45 </td><td>–</td><td>10.15u</td><td>blok groepsoefening (wisselend XYZ+, STAR, Belemmerende Overtuigingen)</td></tr>
					<tr><td>10.15 </td><td>–</td><td>10.30u</td><td>pauze</td></tr>
					<tr><td>10.30 </td><td>–</td><td>11.00u</td><td>Netwerken: vacature – analyse obv TrjCT</td></tr>
					<tr><td>11.00 </td><td>–</td><td>11.30u</td><td>netwerkversterking/activering: netwerkgesprekken organiseren bij vacature</td></tr>
					<tr><td>11.30 </td><td>–</td><td>12.00u</td><td>uitwisseling tips voor komende week, uitloop</td></tr>
				</table>
				<h3 class="bluefont">Groepsoefeningen</h3>
				<table class="table table-light table-sm table-striped">
					<thead>
						<th>Groepsoefening</th><th></th><th>TrjcT</th>
					</thead>
					<tbody>
					<tr><td>Waar kom ik vandaan?</td><td>Belemmerende gedachten/Stimulerende gedachten<br/>Wat zijn mijn belemmerende gedachten? Hoe zet ik die om?</td><td>Nulmeting</td></tr>
					<tr><td>Wie ben ik?</td><td>Kwaliteiten en valkuilen<br/>Wat zijn mijn kwaliteiten en valkuilen?</td><td>QBF</td></tr>
					<tr><td>Wie kan ik?</td><td>Competentie/Kernkwadrant<br/>Wat zijn kerncompetenties?</td><td>LINC</td></tr>
					<tr><td>Wie wil ik?</td><td>Ambitie/werkwaarden</td><td>LINC</td></tr>
					<tr><td>Wie zoek ik?</td><td>TrjcT - analyse<br/>Waar ben ik goed in / waar wordt ik blij van?</td><td>FIV / WvW</td></tr>
					<tr><td>Hoe vind ik?</td><td>Netwerken<br/>Actie</td><td>Vacature alert</td></tr>
					<tr><td>Hoe presenteer ik?</td><td>XYZ<br/>Pitch / Starr</td><td>Eindmeting</td></tr>
				</table>
				<h3 class="bluefont">Voorstel Rooster begeleiding Workshop Netwerken 2e halfjaar 2020</h3>
				<table class="table table-light table-sm table-striped">
				<tr><td>18/08</td><td>Flip/Peter			</td><td>Waar kom ik vandaan? (Belemmerende/Stimulerende gedachten)  </td></tr>
				<tr><td>25/08</td><td>-						</td><td>Netwerkcafe Walk&Talk</td></tr>
				<tr><td>01/09</td><td>Flip/Nico				</td><td>Wie ben ik? (Kwaliteiten & Valkuilen)</td></tr>
				<tr><td>08/09</td><td>Nico/Rob				</td><td>Wat kan ik? (Competentie / Kernkwadrant)</td></tr>
				<tr><td>15/09</td><td>Rob/Sjaak				</td><td>Wat wil ik? (Ambitie / Werkwaarden)</td></tr>
				<tr><td>22/09</td><td>Sjaak/Chrystal		</td><td>Wat zoek ik? (Ambitie / Werkwaarden)</td></tr>
				<tr><td>29/09</td><td>-						</td><td>Netwerkcafe Walk&Talk</td></tr>
				<tr><td>06/10</td><td>Chrystal/Mariella		</td><td>Hoe vind ik? (Netwerken)</td></tr>
				<tr><td>13/10</td><td>Mariella/Flip			</td><td>Hoe presenteer ik? (XYZ)</td></tr>
				<tr><td>20/10</td><td>Flip/….				</td><td>Waar kom ik vandaan? (Belemmerende / Stimulerende gedachten)</td></tr>
				<tr><td>27/10</td><td>-						</td><td>Netwerkcafe Walk&Talk</td></tr>
				<tr><td>03/11</td><td>Flip/Nico				</td><td>Wie ben ik? (Kwaliteiten & Valkuilen)</td></tr>
				<tr><td>10/11</td><td>Nico/Rob				</td><td>Wat kan ik? (Competentie / Kernkwadrant)</td></tr>
				<tr><td>17/11</td><td>Rob/Sjaak				</td><td>Wat wil ik? (Ambitie / Werkwaarden)</td></tr>
				<tr><td>24/11</td><td>-						</td><td>Netwerkcafe Walk&Talk</td></tr>
				<tr><td>01/12</td><td>Sjaak/Chrystal		</td><td>Wat zoek ik? (Ambitie / Werkwaarden)</td></tr>
				<tr><td>08/12</td><td>Chrystal/Mariella		</td><td>Hoe vind ik? (Netwerken)</td></tr>
				<tr><td>15/12</td><td>Mariella/Flip			</td><td>Hoe presenteer ik? (XYZ)</td></tr>
				<tr><td>22/12</td><td>Flip/….				</td><td>Waar kom ik vandaan? (Belemmerende / Stimulerende gedachten)</td></tr>
				<tr><td>29/12</td><td>-						</td><td>Netwerkcafe Walk&Talk</td></tr>
				</table>
				<h3 class="bluefont">Beschikbaar bronmateriaal</h3>
				<ul>
					<li>Handboek Jobhulpmaatje</li>
					<li>Bijlage: Overzicht links diverse leerdoelen</li>
				</ul>
				<h3 class="bluefont">Locatie</h3>
				<p>Forum Zoetermeer, Trainingsruimte 1. Of digitaal.</p>
				<h3 class="bluefont">Maximaal aantal deelnemers</h3>
				<p>Nog onbekend.</p>
				<h3 class="bluefont">Benodigheden</h3>
				<p>Koffie, thee</p>
				<p>Computer</p>
												
			</div>
		</div>
			
	</main>
	<?php include('includes/footer.inc'); ?>
</body>
</html>