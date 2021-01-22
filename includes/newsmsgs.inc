<?php

function getMsgs ($number, $naam)
{
	$newsmsg = array();

	$newsmsg[20] = '<h3 class="bluefont">Online maatjesavond 25 januari</h3>
	<h5 class="bluefont">20-1-2021</h5>
					<img src="img/onlinemeeting.png" class="float-right" style="width: 40%; margin-left: 15px;">
					<p>Maandag a.s. gaan we met z\'n allen online. De agenda is bekend. Als je je hebt aangemeld, dan vind je de link naar de meeting onder de agenda.</p>
					<p>We hopen dat zoveel mogelijk mensen erbij zijn. Het is voor ons een spannend experiment, en misschien voor jullie ook.</p>
					<p>Tot maandag!</p>
					<p><a class="btn btn-primary" href="pages/bericht20210120_1.php" role="button">Bekijk de agenda &raquo;</a></p>';

	$newsmsg[19] = '<h3 class="bluefont">Kort interview in het AD met Johan</h3>
	<h5 class="bluefont">15-1-2021</h5>
					<p>Afgelopen woensdag 13 januari stond er een interview met Johan Alebregtse in het AD over JobHulpMaatje en de nieuwe jobgroup die binnenkort start.</p>
					<img src="img/AlebregtseAD.png" class="float-right" style="width: 100%; margin-bottom: 15px;">';	
	
	$newsmsg[18] = '<h3 class="bluefont">Posters voor Zoetermeer en omgeving</h3>
	<h5 class="bluefont">15-1-2021</h5>
					<p>In 2021 worden weer verschillende workshops voor werkzoekenden door JobHulpMaatje Zoetermeer georganiseerd. De eerste start online en we hopen dat het daarbij blijft.</p>
					<p>De posters worden op A3 formaat geprint en op diverse plaatsen in de stad opgehangen. Als je ideeën hebt voor een goede plek, laat het dan weten aan <a href="mailto: flip@jhm-zoetermeer.nl">Flip</a>.</p>
					<img src="img/JobHulpMaatjeposter.jpg" class="float-right" style="width: 100%; margin-bottom: 15px;">';	
	
	$newsmsg[17] = '<h3 class="bluefont">Maatjes online</h3>
	<h5 class="bluefont">14-1-2021</h5>
					<img src="img/IMG_0050.jpeg" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>We gaan nog eens proberen een maatjesavond te organiseren. Het lukte vorige maand niet om in persoon bij elkaar te komen, nu gaan we op maandagavond 25 januari een online meeting houden.</p>
					<p>Dat vraagt natuurlijk enige voorbereiding. En bovendien ook wat aanpassingen van alle deelnemers. Het is online immers lastiger om elkaar even informeel te spreken of te groeten. Iets wat we zo gewend zijn maar wat nu 
					al enige tijd niet kan.</p>
					<p>We ontmoeten elkaar met behulp van Microsoft Teams, een programma waar de meesten van ons al wat ervaring mee hebben. Je kunt deelnemen met je PC, met je tablet en met je smartphone. Teams is gratis te gebruiken dus dat is geen probleem.<p>
					<p>Binnenkort ontvang je meer informatie over wat je nodig hebt en wat je kunt verwachten. Als je eerder al vragen hebt, stel ze bijvoorkeur via het Forum (zie boven in de menubalk). Iedereen kan dan makkelijk de discussie volgen
					 en er z\'n voordeel mee doen.</p>
					<p>Bijgaande foto laat zien hoe het in goede tijden gaat. Hopelijk komen die snel weer terug!</p>
					<p>Als je erbij bent, meld je aan in de presentielijst. Klik daarvoor op onderstaande knop.</p>
					<p>Tot 25 januari!</p>
					<p><a class="btn btn-primary" href="pages/presence_list200125.php" role="button">Meld je aan &raquo;</a></p>';

	$newsmsg[16] = '<h3 class="bluefont">Online Jobgroup gaat van start</h3>
	<h5 class="bluefont">11-1-2021</h5>
					<img src="img/online workshops.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>Gedwongen door het Corona-virus wordt de eerste Jobgroup van dit jaar online gegeven. Hoewel we al eerder online-sessies 
					hebben gehouden, is dit de eerste workshop die virtueel start,</p>
					<p>Op vrijdag 22 januari \'s-ochtends starten Johan en Paula vanachter hun PC en worden in 7 sessies werkzoekenden geholpen bij het vinden van nieuw werk.</p>
					<p>Er zijn nog enkele plaatsen open dus mocht je belangstellenden kennen, laat het dan weten.</p>';

	$newsmsg[15] = '<h3 class="bluefont">Prettige kerstdagen en een goed 2021!!</h3>
	<h5 class="bluefont">23-12-2020</h5>
					<p>Dit bijzondere, bizarre jaar loopt ten einde. De kerstdagen staan voor de deur en voor velen van ons zijn ze anders dan we ooit hebben meegemaakt.
					Dit jaar zijn we erg op onszelf aangewezen en dat valt zwaar met Kerstmis.</p>
					<p>Gelukkig zien we lichtpuntjes aan het eind van de tunnel. Het komend jaar belooft verbeteringen op vele gebieden.</p>
					<p>JobHulpMaatje wacht mogelijk een zware taak. Gebruik deze dagen om wat uit te rusten en na te denken over wat komen gaat.</p>			
					<img src="img/background-2909020_1280.jpg" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>Als coordinator ICT wens ik iedereen een heel fijne kerst en een voorspoedig en vooral gezond nieuwjaar. Let op: vuurwerk is verboden dit jaar (en hopelijk ook de volgende jaren ;-) maar als je toch wat wilt afsteken,
					klik dan op onderstaande knop. Veel plezier!</p>
					<p><a class="btn btn-primary" href="https://www.giekwerf.nl?nm=' . $naam . '" role="button">Knallen maar!! &raquo;</a></p>
			';


	$newsmsg[14] = '<h3 class="bluefont">Maatjesavond 14 december gaat niet door</h3>
		<h5 class="bluefont">11-12-2020</h5>
						<p>Wat nog mogelijk leek toen de jaarafsluiting voor de maatjes gepland werd, is inmiddels achterhaald door de werkelijkheid: het Corona-virus laat zich heel erg moeilijk in toom houden. </p>
						<p>Het bestuur van JobHulpMaatje neemt geen risicos en heeft besloten de maatjesavond niet door te laten gaan.</p>					
						<img src="img/whatsapp-1.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
						<p>Dat is natuurlijk jammer maar met wat geduld en ook wat geluk ziet het nieuwe jaar er een stuk beter uit. Zodra het weer mogelijk is, wordt er een nieuwe bijeenkomst voor de maatjes gepland. Intussen proberen we zo goed en zo veilig mogelijk onze diensten te verlenen aan alle werkzoekenden die we onder onze hoede hebben.</p>
				';

	
	$newsmsg[13] = '<h3 class="bluefont">JobHulpMaatje helpt ook jongeren met zoeken naar werk</h3>
		<h5 class="bluefont">1-12-2020</h5>
						<p>Het zoeken van werk voor jongeren (tot pakweg 30 jaar) vraagt om een andere benadering dan voor mensen die ouder zijn. Ze kunnen minder vaak wijzen op een ruime werkervaring en zijn vaak ook nog op zoek wat hen boeit.</p>
						<p>JobHulpMaatje Zoetermeer besteedt speciale aandacht aan hun wensen en mogelijkheden.</p>
						<img src="img/jongerenflyer1.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
						<p>Met deze advertentie willen we de jongeren die werk zoeken, bereiken, zodat ook zij geholpen kunnen worden door ons. Talitha Hulsebos heeft zich als maatje speciaal voor deze doelgroep beschikbaar gemaakt.</p>
				';
	

	$newsmsg[12] = '<h3 class="bluefont">Artikel in "Mijn Zaak"</h3>
	<h5 class="bluefont">28-11-2020</h5>
					<p>In de Zoetermeerse editie van het huis-aan-huis blad "Mijn Zaak" staat deze week onderstaande advertorial. Het blad geeft het woord aan Zoetermeerse organisaties en bedrijven om te vertellen wat ze doen en wat ze voor de lezer kunnen betekenen.</p>
					<p>Onze bijdrage borduurt voort op de berichten die we eerder publiceerden in het Streekblad en in de nieuwsbrief.</p>
					<img src="img/MZZ-13-jobhulpmaatje.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
			';


	$newsmsg[11] = '<h3 class="bluefont">Job On bijeenkomsten in de bibliotheek</h3>
	<h5 class="bluefont">26-11-2020</h5>
					<p>Als organisatie heb je niet alles in de hand. Zo blijkt dat de bibliotheek besloten heeft ook werkzoekenden te gaan ondersteunen en organiseert hiervoor een maandelijke bijeenkomst. 
					De eerste keer vindt plaats op donderdag 3 december van 9:30h tot 11:30h.</p>
					<img src="img/jobon.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>Niet meedoen lijkt voor JobHulpMaatje geen optie dus ook wij zullen er bij zijn. Hoe de bijeenkomsten eruit gaan zien en wat onze rol daarbij zal zijn is nog onduidelijk. 
					Over drie maanden gaan we samen evalueren om te bepalen hoe we verder gaan.</p>
			';
	
	

	$newsmsg[10] = '<h3 class="bluefont">Nieuw in het Streekblad</h3>
	<h5 class="bluefont">20-11-2020</h5>
					<p>De naam van JobHulpMaatje bekender maken is een kwestie van een lange adem.</p>
					<img src="img/IMG_0725.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>Afgelopen donderdag stonden er twee berichten over JobHulpMaatje in de krant.  De moeite waard om er kennis van te nemen. Laten we hopen dat veel mensen het gelezen hebben en er hun voordeel mee kunnen doen.</p>
					<img src="img/IMG_0727.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
			';



	$newsmsg[9] = '<h3 class="bluefont">Peter Veld in het nieuws</h3>
	<h5 class="bluefont">19-11-2020</h5>
					<p>Gisteren (18-11) is ons bestuurslid Peter Veld gehoord door de parlementaire onderzoekscommissie Toeslagen.</p>
					<img src="img/peterveld_nieuws201118.jpg" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>Het was een zeer uitgebreid verhoor waarin Peter kritisch werd bevraagd maar duidelijke antwoorden wist te geven. Het is een ingewikkeld verhaal maar Peter heeft hopelijk geholpen bij onderzoek hoe dit grote probleem is ontstaan en hoe het zo uit de hand is gelopen. Laten wij hopen dat de aanbevelingen er voor zorgen dat problemen die er zijn geweest nooit meer zullen voorkomen. Het menselijk leed is enorm en het mag nooit meer gebeuren. Laten wij hopen dat het verhaal van Peter hieraan heeft bijgedragen.</p>
			';
	

	$newsmsg[8] = '<h3 class="bluefont">Een oproep van het Oranje Fonds</h3>
	<h5 class="bluefont">9-11-2020</h5>
					<p>JobHulpMaatje Zoetermeer heeft zich ook dit jaar weer opgegeven voor de actie "Maatjes gezocht" van het Oranje Fonds.</p>
					<img src="img/OranjeFonds01.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>Met aandacht op landelijk niveau op radio en TV voor de zoektocht naar maatjes hopen ook wij nieuwe vrijwilligers te kunnen aantrekken.</p>
					<p>De actie start 25 november en duurt 3 weken.</p>
					<p>Wil je meer weten, klik dan op onderstaande knop.</p>
					<p><a class="btn btn-primary" href="pages/bericht20201109_1.php" role="button">Lees de gehele email &raquo;</a></p>
			';
		


	$newsmsg[7] = '<h3 class="bluefont">Grote opkomst bij digitale maatjesdag</h3>
	<h5 class="bluefont">7-11-2020</h5>
					<p>De landelijke maatjesdag die door JobHulpMaatje Nederland werd georganiseerd is druk bezocht. Maar i.p.v. een bruisend samenkomen in Veenendaal werd het een
					iets gestroomlijnder online versie m.b.v. Microsoft Teams.</p>
					<img src="img/maatjesdag1.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>En dat lukte behoorlijk goed. De opkomst was met ruim 50 mensen voor de camera en achter de microfoon heel goed. Dit aantal werd bereikt tijdens de plenaire
					bijeenkomst die door Ewout Suithoff van JobHulpMaatje Nederland werd voorgezeten.</p>
					<p>Daarna splitste de groep deelnemers zich in verschillende workshopbijeenkomsten.</p>
					<p>Niet voor iedereen was het allemaal even eenvoudig om Teams goed te gebruiken, temeer daar er verschillende versies in omloop zijn. Maar in het algemeen konden de deelnemers goed meedoen in de discussies en workshops.</p>
					<p>Uiteindelijk werd rond 12:30h de bijeenkomst afgesloten. De conclusie was dat er niets boven een bijeenkomst in persona gaat maar dat dit zeker een acceptabel alternatief was als \'in het echt\' niet mogelijk is.</p>
					<img src="img/maatjesdag2.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
			';
		

	$newsmsg[6] = '	<h3 class="bluefont">Nog een advertorial ....</h3>
	<h5 class="bluefont">6-11-2020</h5>
	<img src="img/IMG_0723.jpeg" class="float-left" style="width: 60%; margin-bottom: 15px; margin-right: 15px;
					  -o-transform: rotate(5deg);
					  -webkit-transform: rotate(5deg);
					  -moz-transform: rotate(5deg);
					  position: relative;
					  top: 10px;
					">
					<p>Nu het Forum gesloten is en geïnteresseerden niet in een gesprek aan de balie van JobHulpMaatje kennis kunnen maken, is het des te belangrijker dat we via andere media laten zien wat we kunnen doen.</p>
					<img src="img/IMG_0722.jpeg" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>De vorige advertentie was bedoeld voor mensen die, nieuw in Nederland, op zoek zijn naar werk. Deze advertorial (een ingezonden stuk onder redactie van en betaald door de inzender) vertelt over de jobgroup die JobHulpMaatje speciaal voor kleine ondernemers en ZZP\'ers 
					heeft ontwikkeld. Want deze groep heeft het juist in deze Corona-tijd een stuk moeilijker.</p>
					<p>We houden je wederom op de hoogte.</p>
			';

	$newsmsg[5] = '	<h3 class="bluefont">Het Forum/de bibliotheek in Zoetermeer gaat tijdelijk dicht</h3>
	<h5 class="bluefont">4-11-2020</h5>
					<p>Het is niet anders, het Forum van Zoetermeer gaat voor de komende weken, in ieder geval tot 19 november, volledig op slot.</p>
					<img src="img/gesloten corona_0.png" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>Dit betekent dat JobHulpMaatje tot die tijd geen activiteiten op locatie kan houden. Alle afspraken zullen worden afgezegd of naar online-afspraken worden omgezet.</p>
					<p>Ook de baliebezetting op elke donderdag in het Forum is daarmee komen te vervallen tot nader order.</p>
					<p>Houdt het intranet in de gaten!</p>
					<p><a class="btn btn-primary" href="https://www.forumzoetermeer.nl" role="button">Naar het Forum &raquo;</a></p>
			';
			
	$newsmsg[4] = '	<h3 class="bluefont">Opnieuw aandacht in de krant</h3>
	<h5 class="bluefont">30-10-2020</h5>
					<p>In het regiokatern van het AD van donderdag 29 oktober wordt aandacht besteed aan JobHulpMaatje.</p>
					<img src="img/jhmAD201029.jpg" class="float-right" style="width: 100%; margin-bottom: 15px;">
					<p>Dit keer gaat het over de jobgroup die JobHulpMaatje op 17 november start voor ZZP\'ers en kleine ondernemers. 
					Zij worden bij het wegvallen van omzet door de Corona-maatregelen extra hard getroffen omdat zij nauwelijks terug kunnen vallen op werkloosheidsuitkeringen.</p>
					<p>Tip: als mensen belangstelling hebben voor ondersteuning door JobHulpMaatje bij het zoeken naar nieuw werk, laat hen bij voorkeur het formulier invullen dat op de website wordt aangeboden.
					Het geeft ons direct meer inzicht in de situatie van de aanvrager en zijn wensen.</p> 
			';

	
	$newsmsg[3] = '	<h3 class="bluefont">Uitslag IT-enquête</h3>
						<h5 class="bluefont">25-10-2020</h5>
						
					<p>De enquête om een beeld te krijgen van IT gebruik binnen JHM Zoetermeer is nu beëindigd.</p>
					<p>De vraag om deze te in te vullen is gesteld aan alle 24 medewerkers van JHMZ. 15 mensen (63%) hebben hier gehoor gegeven, van 9 mensen is geen reactie gekomen.</p>
					<table class="table table-sm table-bordered">
					<thead class="thead-dark">
					<tr><th>Overzicht</th><th>Totaal</th><th>Gereageerd</th><th>Niet-gereageerd</th></tr>
					</thead>
					<tbody>
					<tr><td>Bestuursleden</td><td>3</td><td>1</td><td>2</td></tr>	
					<tr><td>Coördinatoren</td><td>3</td><td>3</td><td>0</td></tr>
					<tr><td>Maatjes</td><td>17</td><td>10</td><td>7</td></tr>
					<tr><td>Support</td><td>1</td><td>1</td><td>0</td></tr>
					</tbody>
					</table>
					
					<p>Op basis van de antwoorden kunnen enkele conclusies worden getrokken. Let op: op basis van alleen de respondenten natuurlijk!</p>
					<ol>
					<li>Iedereen (100%) gebruikt WhatsApp (duhhuh!)</li>
					<li>Ook iedereen gebruikt Microsoft Word. Dat lijkt minder logisch want voor zover ik weet heb je formeel een betaalde licentie nodig om Word te kunnen gebruiken. En dat zou betekenen dat alle 15 respondenten zo\'n licentie hebben, als onderdeel van een MS Office licentie. Klopt dit?</li>
					<li>73% gebruikt een PC, 27%, gebruikt een Mac.</li>
					<li>Maar liefst 80% maakt gebruik van Microsoft Teams. Dat is mooi. Als we er in slagen bij de laatste 20% ook Teams aan de praat te krijgen dan zijn we bij een volgende online-meeting compleet.</li>
					<li>Slechts een enkeling maakt geen gebruik van een smartphone. Maar wel van WhatsApp, ook dat valt op.</li>
					</ol>
					<p>Tot slot:</p>
					<ul>
					<li>Microsoft Office wordt algemeen gebruikt. De vraag is of gebruikers een officiële licentie hiervoor hebben of dat men oude of illegale versies gebruikt. Dit wordt nader uitgezocht.</li>
					<li>Een gezamenlijke cloud-oplossing voor maatjes kan helpen om documenten met elkaar te delen.</li>
					<li>Microsoft Teams wordt al breed gebruikt. Om hier als organisatie samen goed gebruik van te kunnen maken kan een gemeenschappelijke opzet en training erg helpen.</li>
					</ul>
					<p><strong>Alle vragen</strong></p>
					<table class="table table-sm table-bordered">
					<thead class="thead-dark">
					<tr><th>Wat</th><th>Aantal</th><th>%</th></tr>
					</thead>
					</tbody>
					<tr><td>Ik gebruik een Windows-PC of -laptop</td><td>11</td><td>73%</td></tr>
					<tr><td>Ik gebruik een iMac of MacBook</td><td>4</td><td>27%</td></tr>
					<tr><td>Ik gebruik een tablet (iPad of Android)</td><td>9</td><td>60%</td></tr>
					<tr><td>Ik gebruik een telefoon (iPhone of Android)</td><td>13</td><td>87%</td></tr>
					<tr><td>Ik gebruik (nog) iets anders</td><td>1</td><td>7%</td></tr>
					<tr><td>Ik gebruik niets</td><td>1</td><td>7%</td></tr>
					<tr><td>Ik werk met Windows</td><td>12</td><td>80%</td></tr>
					<tr><td>Ik werk met Mac OSX</td><td>7</td><td>47%</td></tr>
					<tr><td>Ik werk met MS Word</td><td>	15</td><td>100%</td></tr>
					<tr><td>Ik werk met MS Excel</td><td>11</td><td>73%</td></tr>
					<tr><td>Ik werk met MS Powerpoint</td><td>11</td><td>73%</td></tr>
					<tr><td>Ik werk met MS Teams</td><td>12</td><td>80%</td></tr>
					<tr><td>Ik maak gebruik van cloud-services (online-opslag van documenten)</td><td>10</td><td>67%</td></tr>
					<tr><td>Ik maak gebruik van SMS (op m\'n telefoon)</td><td>7</td><td>47%</td></tr>
					<tr><td>Ik maak gebruik van WhatsApp (op m\'n telefoon of op m\'n PC)</td><td>15</td><td>100%</td></tr>
					</tbody>
					</table>
			';
	


	$newsmsg[2] = '	<h3 class="bluefont">Reclame in Het Streekblad</h3>
			<h5 class="bluefont">23-10-2020</h5>
			<img src="img/IMG_0707.jpeg" class="float-left" style="width: 60%; margin-bottom: 15px; margin-right: 15px;
							  -o-transform: rotate(-5deg);
							  -webkit-transform: rotate(-5deg);
							  -moz-transform: rotate(-5deg);
							  position: relative;
							  top: 10px;
							">
							<p>Eerder schreven we het al: JobHulpmaatje gaat flink werven via de papieren media. Zoals nu met een paginagrote advertentie in het Zoetermeerse Streekblad.</p>
							<img src="img/IMG_0706.jpeg" class="float-right" style="width: 100%; margin-bottom: 15px;">
							<p>In de komende weken zal blijken hoeveel mensen zich bij JobHulpMaatje gaan melden.</p>
							<p>We houden je op de hoogte.</p>
					';
		
	
	$newsmsg[1] = '	<h3 class="bluefont">Microsoft Teams</h3>
			<h5 class="bluefont">19-10-2020</h5>
			<p>JobHulpMaatje Zoetermeer maakt gebruik van Microsoft Teams om elkaar online te kunnen ontmoeten en te vergaderen met mensen van zowel binnen als buiten de organisatie. Microsoft Teams is gratis te downloaden en te gebruiken. Wil je hier meer over weten, klik op de knop die onderaan dit artikel staat.</p>
			<img src="img/msteams1.png" class="float-right" style="width: 50%; margin-bottom: 15px; margin-right: 15px;">
			
			<p>Het gebruik van Teams kan soms verwarrend overkomen. Dat komt omdat Teams ook deel kan uitmaken van het Microsoft365 pakket dat naast Teams, ook de Microsoft Office programma’s bevat (Word, Excel, Powerpoint, Outlook etc.). 
			Om dat pakket te kunnen gebruiken heb je een licentie nodig. En voor sommige functies in Teams heb je ook zo’n licentie nodig. 
			Deze zijn echter niet noodzakelijk om te kunnen vergaderen met beeld en geluid met andere mensen met een gratis versie van Teams.</p>
			<p>Teams is daarom een goed programma voor gebruik bij online Jobgroups en online coach-gesprekken. Alle partijen moeten dan wel de beschikking hebben over:</p>
			<ul>
			<li>Of een smartphone (Android of Apple)</li>
			<li>Of een tablet (Android of Apple)</li>
			<li>Of een PC (Windows of Mac)</li>
			</ul>
			<p>Als het gebruikte apparaat  van redelijk recente makelij is zal het installeren van een gratis versie van Teams geen problemen moeten opleveren.</p>
			
			<p>Op dit moment is JobHulpMaatje Zoetermeer in gesprek met andere JHM-locaties om te kijken of het handig is om (goedkoop) licenties in te zetten voor het gebruik van Microsoft365. Dus zowel voor bestuursleden, coördinatoren als wellicht ook maatjes. Dat lijkt op het eerste gezicht een goede zet maar het gebruik van het pakket en de omvang is tamelijk complex en niet geheel kosteloos in een organisatie die bestaat uit vrijwilligers die zelfstandig bepalen waarmee ze willen werken. Later hierover meer.</p>
			
			<p>Voor de werkzoekenden geldt dat zij dus altijd de beschikking kunnen krijgen over de gratis versie van Teams.</p>
			
			<p>In dit kader is het ook handig voor JHMZ om te weten hoe de huidige situatie is mbt IT-hulpmiddelen. Vul ajb de enquete in die bovenaan de pagina wordt genoemd.</p>
			
			<p><a class="btn btn-primary" href="https://www.microsoft.com/nl-nl/microsoft-365/microsoft-teams/free" role="button">Naar Microsoft Teams voor nop &raquo;</a></p>
		';
	


	$newsmsg[0] = '	<h3 class="bluefont">Gratis persoonlijk ontwikkeladvies</h3>
			<h5 class="bluefont">15-10-2020</h5>
			<p><strong>Belangrijk bericht voor maatjes,</strong> bespreek dit met je werkzoekenden. Het biedt extra  mogelijkheden aan werkzoekenden die een carrière-switch overwegen. Let op: het vorige budget was snel volgeboekt, dus wacht niet te lang met aanmelden en help elkaar daarbij.</p>
			<p><strong>Vanaf 1 december 2020 gratis persoonlijk ontwikkeladvies. Meld je nu vast aan en start vanaf december!</strong></p>
			<p>Maak gebruik van het kosteloos ontwikkeladvies. Dit ontwikkeladvies is beschikbaar voor (niet) werkenden, flexwerkers en zelfstandigen vanaf 18 jaar en die nog niet de AOW leeftijd hebben. Het ontwikkeladvies bestaat uit 2-3 gesprekken en een arbeidsmarktscan. Er zijn ook mogelijkheden voor kosteloze online scholing vanuit hetzelfde overheidsprogramma. Op de website onder de knop vind je actueel nieuws vanuit de Rijksoverheid over NL leert door.</p>
			<p><strong>Werkzoekenden</strong> zijn hierover ook via de whatsapp-groepen geïnformeerd: neem contact op met je maatje/jobgroupleider.</p>
			<p><a class="btn btn-primary" href="https://www.hoewerktnederland.nl/werknemen/leren-en-ontwikkelen/loopbaanadvies/werkzoekenden" role="button">Naar de website &raquo;</a></p>
		';
	return $newsmsg;
}
