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

/* haal de filenames van de fotootjes op */

$list = scandir('fotoos_person', SCANDIR_SORT_NONE);
unset($list[0]);
unset($list[1]);

shuffle($list);

// print_r($list);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php include('includes/head.inc'); ?>			
		<style>
			.bluefont {
				color: #304280;
			}			
			.bluefont h1, h2, h3, h4, h5 {
				font-weight: 300;
			}

			.pinkfont {
				color: #be5a9d;
			}
			.pinkfont h1, h2, h3, h4, h5 {
				font-weight: 300;
			}
			.redfont {
				color: #bd0011;
			}
			.stripedthrough {
				text-decoration: line-through;
			}

			
		</style>
	<!-- Custom styles for this page -->
		<link href="css/jumbotron.css" rel="stylesheet" type="text/css" >
		<link href="css/sticky_notes.css" rel="stylesheet" type="text/css" >
		<link href="css/mystyle.css" rel="stylesheet" type="text/css" >
		<link href="https://fonts.googleapis.com/css2?family=Gloria+Hallelujah&display=swap" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600' rel='stylesheet' type='text/css'>

	</head>
 
<body style="background-color: #dddddd; font-size: 16px;">
	<?php include('includes/navbar.inc'); ?>
	<main role="main">
	<div class="container">
		<div class="row">
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[0]; ?>" alt="<?php  echo $list[0]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[1]; ?>" alt="<?php  echo $list[1]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[2]; ?>" alt="<?php  echo $list[2]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[3]; ?>" alt="<?php  echo $list[3]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[4]; ?>" alt="<?php  echo $list[4]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[5]; ?>" alt="<?php  echo $list[5]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[6]; ?>" alt="<?php  echo $list[6]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[7]; ?>" alt="<?php  echo $list[7]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[8]; ?>" alt="<?php  echo $list[8]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[9]; ?>" alt="<?php  echo $list[9]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[10]; ?>" alt="<?php  echo $list[10]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[11]; ?>" alt="<?php  echo $list[11]; ?>" width="100%"></div>
		</div>
		<div class="row">
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[12]; ?>" alt="<?php  echo $list[12]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[13]; ?>" alt="<?php  echo $list[13]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[14]; ?>" alt="<?php  echo $list[14]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[15]; ?>" alt="<?php  echo $list[15]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[16]; ?>" alt="<?php  echo $list[16]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[17]; ?>" alt="<?php  echo $list[17]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[18]; ?>" alt="<?php  echo $list[18]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[19]; ?>" alt="<?php  echo $list[19]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[6]; ?>" alt="<?php  echo $list[6]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[13]; ?>" alt="<?php  echo $list[13]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[5]; ?>" alt="<?php  echo $list[5]; ?>" width="100%"></div>
			<div class="col p-0 m-0""><img src="fotoos_person/<?php  echo $list[0]; ?>" alt="<?php  echo $list[0]; ?>" width="100%"></div>
		</div>
	</div>	
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="jumbotron">
		<div class="container" id="sticky">
			<div class="container">
			<ul>
				<li>
				  <a href="enquete.php">
					<p>Heb je de enquête al ingevuld?</p>
					<p>Help even mee ajb! Slechts een paar vragen, zo gebeurd.</p>
					<p>Klik op mij!</p>
				  </a>
				</li>
			</ul>
			<img src="img/Logo_JobHulpMaatje_Zoetermeer.svg" class="mx-auto d-block mb-5" style="width: 350px;">
			<!-- class="mb-4 p-3 rounded mx-auto d-block bg-white" --> 
			</div>
		</div>
		<div class="container">
			<div class="row py-4 border-top border-primary">
				<div class="col-md">
					<h3 class="bluefont">Zaterdag 7-11, landelijke (digitale) maatjesdag</h3>
					<h5 class="bluefont">9-10-2020</h5>
					<p>De landelijke maatjesdag is door alle Corona-perikelen veranderd van opzet. Geen samenkomen dit jaar in Veenendaal, maar een digitale bijeenkomst via Microsoft Teams.</p>
					<img src="img/microsoftteams-rz_-1200x600-1.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>Hiervoor wordt de zaterdagochtend gereserveerd van 9:30h tot 12:30h. Er zijn verschillende onderdelen gepland. Meer daarover kun je lezen op de website van JobHulpMaatje Nederland. Je kunt je daar ook inschrijven voor digitale workshops.</p>
					<p>Belangrijk is natuurlijk dat je Microsft Teams hebt geïnstalleerd en weet hoe je het moet gebruiken. Het programma heeft een gratis versie en die is voldoende. Als je vragen hebt, stel ze in het forum! Daar is het voor.</p>
					<p><a class="btn btn-primary" href="https://jobhulpmaatje.nl/aanmelden-digitale-landelijke-dag/" role="button">Lees meer en meld je aan &raquo;</a></p>
				</div>
				<div class="col-md">
					<h3 class="bluefont">Verslag van de bestuursvergadering van maandag 5 oktober</h3>
					<h5 class="bluefont">7-10-2020</h5>
					<p>We hebben als bestuur van JobHulpMaatje Zoetermeer een goede gewoonte: bij toerbeurt openen de deelnemers met een korte meditatie. Deze keer was het Jan Waaijer, hij las uit de memoires van Ruud Lubbers: de tijden – dat zijn wij. We staan niet buiten de tijd, de actualiteit zijn wij zelf.</p>
					<p>We volgen een standaard-agenda, de JHM-activiteiten: maatjes, werkzoekenden, jobgroup/workshop, ondernemers, organisatie, ondersteuning/ict, financiën, pr/communicatie. Vanochtend hebben we die punten vooral bezien in het licht van het bestuurlijk overleg deze week met wethouder Margreet van Driel. We hebben daarvoor besproken hoe we JHM het beste kunnen positioneren. En wat de maatschappelijke meerwaarde is:</p>
						<ol>
						<li>Financieel: besparing uitkeringen (2019: 8 uit bijstand, 11 uit ww/wia)</li>
						<li>Individueel: werkzoekenden naar werk</li>
						<li>Individueel: maatschappelijke inzet vrijwilligers (maatjes)</li>
						<li>Collectief: bijdrage aan Participatie-doelstelling Zoetermeer</li>
						<li>Last but not least: preventie schuldenproblematiek</li>
						</ol>
						<p>Als vrijwilligersorganisatie – zonder personeelslasten – dus een groot rendement!</p>
						</p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row py-4 border-top border-primary">		
				<div class="col-md">
					<h3 class="bluefont">GAK-pilot en succesvolle uitstroom</h3>
					<h5 class="bluefont">7-10-2020</h5>
					<p>Op de online-maatjesavond heeft Flip aangegeven dat we heel succesvol hebben gescoord in de zgn. GAK-pilot Over de Brug. Samen met 3 andere JHM-locaties (Leiden, Oss, Zwolle) hebben we daarvoor ingetekend: mensen niet alleen maar beter bemiddelbaar maken, maar daadwerkelijk de brug over helpen naar werk. We mochten daarvoor in het afgelopen jaar:</p>
					<ul>
						<li>40 werkzoekenden aanmelden waarmee we een JHM-traject in gingen.
						Daarvoor kregen we een vergoeding van € 250 per persoon.</li>
						<li>Daarboven mochten we nog eens 10 extra werkzoekenden aanmelden, maar dan zonder die startbijdrage.</li>
						<li>Uit die groep van 50 aangemelde werkzoekenden, mochten we er ca. 10 weer afmelden als die aantoonbaar succesvol naar werk of opleiding werden bemiddeld.</li>
						<li>In die afmelding zijn we als Zoetermeer zeer succesvol geweest! Omdat de andere JHM-locaties mogelijk met minder afmeldingen zouden komen, hebben we als Zoetermeer die ruimte gevuld. Uiteindelijk met 15 succesvol uitgestroomde werkzoekenden.</li>
						<li>Zeven voor de ‘hoofdprijs’ € 1500, voor een contract > 6 mnd. en > 16u/week.</li>
						<li>Zes voor € 1000 voor een kleiner contract < 6 mnd / uitzendcontract</li>
						<li>Twee voor € 500 voor een doorstroom naar een reguliere vervolgopleiding.</li>
					</ul>
						<p>Aantoonbaar: dat wil zeggen dat we daarvoor de contracten, inschrijfbewijzen moesten overleggen. We hadden geen kandidaten voor de categorie: gestart als ZZP/ondernemer (€1000), tenminste niet in die groep van 50 aangemelden. 
						</p>
					<h5>Meer succesvolle uitstroom</h5>
						<p>Maar bij die 15 uit 50 is het echt niet gebleven wat betreft onze resultaten. We hebben in 2018 de eerste 12 werkzoekenden aan een baan geholpen. In 2019 waren dat er meer: 32 werkzoekenden stroomden succesvol uit naar werk. In 2020 gaan we de coronacrisis merken: we zitten nu op 17 succesvolle uitstromers; een verdubbeling zit er waarschijnlijk niet meer in.</p>
						<p>Binnenkort zullen we de lijst van maatjes en gekoppelde werkzoekenden actualiseren. Daarbij zullen we ook de status van de uitgestroomden in beeld brengen. Dan krijgt ons werk ook meer gezicht (in meervoud).</p>							
				</div>
				<div class="col-md">
					<h3 class="bluefont">Regels voor het gebruik van het Forum Zoetermeer</h3>
					<h5 class="bluefont">1-10-2020</h5>
					<p>Regelmatig maken we gebruik van het Forum in Zoetermeer voor afspraken en bijeenkomsten. Onlangs zijn de regels hiervoor aangescherpt. Lees in de email waar je op moet letten dan.</p>
					<p><a class="btn btn-primary" href="pages/bericht20201001_1.php" role="button">Naar de email &raquo;</a></p>

				</div>
			</div>
		</div>
		<div class="container">
			<div class="row py-4 border-top border-primary">
				<div class="col-md">		
					<h3 class="bluefont">Maandag 5-10, Maatjesavond</h3>
					<h5 class="pinkfont">30-9-2020, aanvulling</h5>
					<p class="pinkfont">Na rijp beraad heeft het bestuur besloten dat de geplande bijeenkomsten normaal doorgang kunnen vinden. Wel wordt aangeraden mondkapjes te gebruiken 
						en de 1,5 meter afstand heel goed in de gaten te houden. Het Forum is gewoon open en bereikbaar.</p>
						<p class="pinkfont">Als je vragen hebt of opmerkingen, laat ze weten in de WhatsApp-groep van JobHulpMaatje. Houdt dit in de gaten!</p>
						<p class="pinkfont">Ook heel belangrijk is dat je laat weten of je deel gaat nemen of juist niet. We kunnen hier dan rekening meehouden bij het nemen van afdoende maatregelen.</p>
					<p>Op maandag a.s. is weer een Maatjesavond gepland. Op deze avond presenteert het bestuur de laatste stand van zaken rond JobHulpMaatje en werpt een blik op de toekomst. Uiteraard komen ook andere zaken aan de orde.</p>
					<p>Echter, op dit moment is nog niet helemaal duidelijk wat de gevolgen zijn van de nieuwste Corona-maatregelen van de regering van maandag 28-9. Het ziet er naar uit dat we formeel bij elkaar mogen komen maar dat besluit
						dient wel genomen te worden. Wat is toegestaan is niet altijd automatisch wat verstandig is.</p>
					<p>Een definitieve beslissing volgt zo snel mogelijk!</p>
					<p><a class="btn btn-primary" href="agenda.php" role="button">Naar de agenda &raquo;</a></p>
				</div>
				<div class="col-md">
					<h3 class="bluefont">Computers enzo, wat hebben we nodig?</h3>
					<h5 class="bluefont">29-9-2020</h5>
					<p>Voor een vrijwilligersorganisatie als JobHulpMaatje zonder vaste woon- of verblijfplaats is het belangrijk om de onderlinge contacten zo goed mogelijk te faciliteren. Hierbij spelen de digitale middelen een grote rol. Zeker als je ook rekening houdt met de Corona-pandemie waardoor het voorlopig onduidelijk blijft of echt samenkomen toegestaan is.</p>
					<p>Een onvermijdelijke bijkomstigheid is dat medewerkers zelf bepalen welke digitale spullen ze gebruiken voor hun werkzaamheden. Het is immers hun eigendom. Daarom wllen we graag weten hoe wij, als stichting, iedereen zo goed mogelijk kunnen helpen om die middelen in te zetten voor JobHulpMaatje. Daarom vind je hier een kleine enquete om inzicht te krijgen wat er al is en wat we kunnen doen om te helpen.</p>
					<p>Bij deze dus graag even wat van je tijd om de vragen te beantwoorden. Alvast bedankt!</p>
					<p><a class="btn btn-primary" href="enquete.php" role="button">Naar de enquête &raquo;</a></p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row py-4 border-top border-primary">					
				<div class="col-md">
					<h3 class="bluefont">JobHulpMaatje nieuwsbrieven</h3>
					<h5 class="bluefont">20-9-2020</h5>
					<p>Regelmatig maakt bestuurslid van JHM Zoetermeer Peter Veld een nieuwsbrief met de laatste nieuwtjes voor iedereen die geïnteresseerd is in de stand van zaken rond JobHulpMaatje, zowel lokaal als nationaal.</p>
					<p>Kijk hier om te lezen wat er gaande is en was bij het ter perse gaan van de nieuwsbrieven.</p>
					<p><a class="btn btn-primary" href="nieuwsbrief.php" role="button">Naar de nieuwsbrieven &raquo;</a></p>
				</div>
				<div class="col-md">
					<h3 class="bluefont">Workshop: Solliciteren nu – Netwerken</h3>
					<h5 class="bluefont">11-9-2020</h5>
					<p>Iedere week worden er workshops gegeven voor werkzoekenden waar maatjes bij aanwezig zijn. Als je meer wilt weten hierover, klik dan op onderstaande knop.</p>
					<img src="img/schema_workshopdeelname.png" class="float-right" style="width: 50%;">
					<p><a class="btn btn-primary" href="procedure.php" role="button">Workshops? &raquo;</a></p>					
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row py-4 border-top border-primary">					
				<div class="col-md">
					<h3 class="bluefont">Intranet voor JobHulpMaatje Zoetermeer</h3>
					<p>JobHulpMaatje Zoetermeer is een vrijwilligersorganisatie. De mensen die zich inzetten voor de stichting doen dat allemaal op vrijwillige basis en meestal ook voor een beperkte tijd van de week. 
					JobHulpMaatje is ook een virtuele organisatie, dus zonder eigen kantoor of andere werkruimte. De mensen zien en spreken elkaar alleen op afspraak, dus meestal alleen als er een zekere noodzaak voor is. 
					Om die reden is het des te belangrijker dat alle medewerkers van JobHulpMaatje Zoetermeer toch een gezamenlijke en publiek afgesloten ruimte voor zichzelf beschikbaar hebben.</p>
					<p>Het intranet, waar je nu bent, is die ruimte.</p>
					<p>Belangrijk om te weten: het intranet is een besloten website. Niet vindbaar op Google, zonder toestemming niet toegankelijk. Er is geen aanmeldprocedure. Inlogggevens worden verstrekt door de ICT-coördinator in overleg met bestuur en andere coördinatoren.</p>
				</div>
				<div class="col-md">
				<h3 class="bluefont">Corona</h3>
					<p>We leven op dit moment in onzekere tijden door de pandemie die wereldwijd heeft toegeslagen. Alle media berichten gretig over alle vervelende zaken die door het Corona-virus op ons af dreigen te komen.</p>
					<p>Zo wordt er o.a een flinke toename in het aantal werkzoekenden verwacht en dat kan betekenen dat JobHulpMaatje mogelijk drukke tijden tegemoet gaat.</p>
					<p>Wat deze en andere ontwikkelingen voor de stichting betekenen, kun je hier lezen.
				</div>				
			</div>
		</div>
		<div class="container">
			<div class="row py-4 border-top border-primary">
				<div class="col-md">
					<h3 class="bluefont">Wat kun je verwachten?</h3>
					<p>Het intranet wordt, zoals alles hier, op vrijwillige basis ontwikkeld. Hoogstens worden eventuele onkosten vergoed zolang deze binnen de perken blijven. Gelukkig is er op het internet veel gratis voorhanden.</p>
					<p>Hoewel niets zeker is, is het de bedoeling het intranet uit te breiden met o.a. een agenda-overzicht en een forum voor vragen en antwoorden. Andere suggesties zijn van harte welkom. <a href="mailto:jang@jhm-zoetermeer.nl">Laat het weten en email!</a></p>
				</div>
			</div>
			<!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
		</div>
	</div>
		
	<!-- einde jumbotron -->
	</div>
			
		<div class="container">
			<!-- Example row of columns -->
				<div class="row py-3">
					<div class="col-md-4">
						<h2 class="bluefont">Wie is wie?</h2>
						<p>Hier vind je foto's en wat informatie over de mensen die zich belangeloos inzetten voor JobHulpMaatje.</p>
						<p>Sta je er niet bij of wil je iets wijzigen aan je eigen kaartje? Laat het dan weten aan de ICT-coördinator, b.v. per <a href="mailto:jang@jhm-zoetermeer.nl">email.</a>.</p>
						<p><a class="btn btn-secondary" href="faces.php" role="button">Laat maar zien &raquo;</a></p>
					</div>
					<div class="col-md-4">
						<h2 class="bluefont">Forum</h2>
						<p>Het forum is de besloten online plaats waar je de andere vrijwilligers vragen kunt stellen en discussies met anderen kunt voeren. Het intranet is nadrukkelijk  niet toegangkelijk voor Werkzoekenden, wel voor Maatjes, zodat enige vrijheid mogelijk is. Maar houd je uiteraard wel aan de fatsoensnormen.</p>
						<p><a class="btn btn-secondary" href="forum/overz_forum.php" role="button">Laat maar zien &raquo;</a></p>
					</div>
					<div class="col-md-4">
						<h2 class="bluefont">Agenda</h2>
						<p>Wanneer zijn er bijeenkomsten, wanneer en waar worden jobgroup-meetingen gehouden, etc.</p>
						<p>Het is altijd handig om te weten wanneer er bepaalde zaken plaatsvinden in de toekomst. Een agenda-overzicht helpt daarbij. 
						<p><a class="btn btn-secondary" href="agenda.php" role="button">Laat maar zien &raquo;</a></p>
					</div>
				</div>
				
				<hr>
				
		</div> <!-- /container -->
					
	</main>
	<?php include('includes/footer.inc'); ?>
</body>
</html>
