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
			table.table-bordered{
				border:1px solid black;
				margin-top:20px;
			  }
			table.table-bordered > thead > tr > th{
				border:1px solid black;
			}
			table.table-bordered > tbody > tr > td{
				border:1px solid black;
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
		<div class="container verslag my-5" style="padding-left: 5%; padding-right: 5%;">
			<h3 class="bluefont">5 februari 2021</h3>
			<h1 class="text-black mb-2 bluefont">Financiëel jaarverslag JobHulpMaatje Zoetermeer (Reliance) 2020</h1>
			<h5 class="text-black mb-5 bluefont">Namens het bestuur,<br/>Peter Veld, penningmeester</h5>
			<h3>Balans en Staat Baten en Lasten 2020</h3>
			
			<p>In 2018 werd de Stichting Reliance opgericht. Deze voert als enige activiteit JobHulpMaatje uit. </p>
			
			<h3>Algemene gegevens</h3>
			<table>
			<tr><td>Oprichtingsdatum 	</td><td>:	30 januari 2018</td></tr>
			<tr><td>Naam			</td><td>:	Stichting Reliance</td></tr>
			<tr><td>Statutaire zetel 		</td><td>:	Zoetermeer</td></tr>
			<tr><td>Adres			</td><td>:	Hoekerkade 12, 2725 AK, Zoetermeer</td></tr>
			<tr><td>Website			</td><td>:	jhm-zoetermeer.nl</td></tr>
			<tr><td>Mailadres		</td><td>:	info@jhm-zoetermeer.nl</td></tr>
			<tr><td>RSIN			</td><td>:	858451256</td></tr>
			<tr><td>KvK-nummer		</td><td>:	70766428</td></tr>
			<tr><td>ANBI 			</td><td>:	30 januari 2018</td></tr>
			</table>
			
			<h3>Doelstelling</h3>
			<p>Het verlenen van hulp op het gebied van het geestelijk en het maatschappelijk welzijn aan inwoners van Zoetermeer en omgeving; het vergroten van de zelfredzaamheid van de mensen met een hulpvraag door middel van het bieden van individuele (“hulpmaatjes”) of groepsgewijze sociale en praktische ondersteuning; het bevorderen van de effectiviteit van de hulpverlening door inzet van vrijwilligers; het bevorderen van de samenwerking tussen vrijwilligers en professionele hulpverlening.</p> 
			
			<h3>Bestuurssamenstelling</h3>
			<table>
			<tr><td>Voorzitter		</td><td>:	Jan Waaijer</td></tr>
			<tr><td>Secretaris		</td><td>:	Peter Veld</td></tr>
			<tr><td>Penningmeester		</td><td>:	Peter Veld</td></tr>
			<tr><td>Algemeen bestuurslid	</td><td>:	Johan Alebregtse</td></tr>	
			</table>
			<h3>Benoemen Statutair Bestuur</h3>
			<p>De leden van het bestuur worden door het bestuur benoemd. Het bestuur kiest uit zijn midden een voorzitter, een secretaris en een penningmeester. De functies van secretaris en penningmeester kunnen in een persoon worden verenigd. Bestuursleden worden benoemd voor een periode van ten hoogste vier jaar en zijn ten hoogste tweemaal herbenoembaar.</p>
			
			<h3>Beloningsbeleid</h3>
			<p>Er zijn geen medewerkers in loondienst bij Stichting Reliance. Aan de bestuurders wordt geen beloning toegekend. Kosten kunnen worden vergoed aan de bestuurders op vertoon van bewijsstukken.</p>
			
			<h3>Beleidsplan</h3>
			<p>JobHulpMaatje Zoetermeer zet zich in om mensen die op eigen kracht niet slagen in het verkrijgen van een baan daarin wel te laten slagen dan wel forse stappen te laten zetten op dat pad. Het doel is de vrijwilligers te koppelen aan hulpvragers. Deze vrijwilligers ondersteunen hulpvragers afgestemd op hun behoefte.</p> <p>De hulpverlening is erop gericht om hulpvragers weer grip te laten krijgen op hun eigen situatie. Daarbij heeft de ondersteuning een preventief karakter, ook gericht op het voorkomen van terugval.</p> <p>De hulpverlening vindt plaats in netwerkbijeenkomsten, in JobGroups van ongeveer 10 deelnemers, in workshops waarin werkzoekenden wekelijks begeleid worden met netwerken en solliciteren en in één op één Maatjestrajecten. De vrijwilliger is bij deze activiteiten HET aanspreekpunt voor hulpvragers. Zeker in geval van tegenslagen zal een vrijwilliger steun kunnen verlenen aan een hulpvrager waardoor deze gemotiveerd blijft.</p> <p>Geschikte vrijwilligers worden vanaf 2018 door professionele partners opgeleid en gecertificeerd als JobHulpMaatje.  Deze maatjes worden gekoppeld aan mensen die werk zoeken. Deelname van werkzoekenden is altijd vrijwillig en zij melden zichzelf aan. Het JobHulpMaatje is de steun en toeverlaat van mensen die zijn vastgelopen of dat dreigen te raken. De vrijwilliger kan iemand helpen om iemand weer in zijn/haar kracht te zetten, ondersteuning geven tijdens een traject van werk zoeken en ook daarna nog helpen dit vol te houden. De aanpak is daarmee gericht op het voorkomen van vergaande psychologische, relationele en financiële negatieve gevolgen van werkloos zijn.</p> <p>Waar nodig worden mensen doorverwezen naar hulpverleners. In het contact met een JobHulpMaatje worden mensen begeleid en ondersteund, het contact helpt mensen om het werk zoeken vol te houden. Met andere organisaties wordt actief samenwerking gezocht.</p>
			
			<h3>Financiën</h3> 
			<p>Voor de dienstverlening wordt aan de werkzoekende geen bijdrage in rekening gebracht. De kosten worden zo laag mogelijk gehouden door te werken met vrijwilligers. De kosten worden gedekt uit bijdragen van de overheid en met name de gemeente Zoetermeer, van goede doelen fondsen Kansfonds, Oranjefonds en Instituut GAK, bijdragen van kerken, bedrijven en particulieren.</p> <p>Werkzoekenden wordt met ingang van 2020 gewezen op de mogelijkheid bij een succesvol traject een vrijwillige bijdrage te betalen.</p><p> In 2020 moest worden ingespeeld op de gevolgen van COVID-19 op de werkzoekenden. Gebruikmakend van de extra inkomsten van het project De Brug (gesteund door Instituut GAK) werd geïnvesteerd in het ontwikkelen van extra activiteiten voor de doelgroepen ZZP’ers en Jeugd. De resterende netto-opbrengsten van de Brug zullen in 2021 worden ingezet voor voortzetting van deze succesvolle aanpak. De bestemmingsreserve betreft een accountantscontrole.</p> 
			
			<h3>Activa</h3>
			<p>Er zijn twee laptops in bezit, die door de coördinatoren worden gebruikt. Er is een mobiele telefoon in bezit op het algemene nummer waarmee JobHulpMaatje Zoetermeer bereikt kan worden.</p> 
			
			<h3>Balans per ultimo 2020</h3>
			
			<h4>Activa</h4>
			
			<table>
			<tr><td>Vorderingen				</td><td>0</td></tr>
			<tr><td>Liquide middelen	 (bankrekening)		</td><td>8306</td></tr>
			<tr><td><tr><td>Totaal Activa				</td><td>8306</td></tr>
			</table>
			
			<h4>Passiva</h4>
						
			<table>		
			<tr><td>Crediteuren				</td><td>0</td></tr>
			<tr><td>Bestemmingsreserve			</td><td>3000</td></tr>
			<tr><td>Kosten voortzetting De Brug 		</td><td>5306</td></tr>
			<tr><td>Algemene reserve			</td><td>0</td></tr>
			<tr><td>Totaal Passiva				</td><td>8306</td></tr>
			</table>
			 
			<h4>Staat van Baten en Lasten 2020</h4>
			
			<table class="table table-sm table-bordered" style="border-color: black;">
			<tr><td></td><td></td><td>							Realisatie</td><td></td><td>	Begroting</td></tr>
			<tr><td>Lasten</td><td></td><td></td><td></td><td></td></tr>
			<tr><td>Kosten organisatie en coördinatie</td><td></td><td>				8472</td><td></td><td>		14000</td></tr>
			<tr><td>Deelname projecten</td><td></td><td>					8126</td><td></td><td>		8500</td></tr>
			<tr><td>-	JHM NL</td><td>				3000</td><td></td><td>				3000</td><td></td></tr>
			<tr><td>-	LDC Trjct</td><td>				2626</td><td></td><td>				2500</td><td></td></tr>
			<tr><td>-	Ontwikkeling Projecten</td><td>		2500</td><td></td><td> 				3000</td><td></td></tr>
			<tr><td>Kosten Maatjes</td><td>	</td><td>				 	11479</td><td></td><td> 		11650</td></tr>
			<tr><td>Kosten JobGroups en Workshops Netwerken</td><td></td><td>		13248</td><td></td><td>		5490</td></tr>
			<tr><td>Kosten Kantoor en Algemeen</td><td> </td><td>				5525</td><td></td><td>		6500</td></tr>
			<tr><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>Totaal Uitgaven</td><td></td><td>					        	46850</td><td></td><td>		46140</td></tr>
			<tr><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>Inkomsten </td><td></td><td></td><td></td><td></td></tr>
			<tr><td></td><td></td><td></td><td>	</td><td>		</td></tr>
			<tr><td>Bijdrage gemeente Zoetermeer</td><td></td><td>				11673</td><td></td><td>		17257</td></tr>
			
			<tr><td>Bijdrage Oranjefonds en Kansfonds</td><td></td><td>		11500</td><td></td><td>		20708</td></tr>
			<tr><td>-	Bijdrage Kansfonds	2020</td><td></td><td>			10000</td><td></td><td>			</td></tr>
			<tr><td>-	Bijdrage Oranjefonds 2020	(7500 in dec 2019 betaald)</td><td></td><td></td><td></td><td></td></tr>
			<tr><td>-	Bijdrage Oranjefonds Appeltje Oranje</td><td></td><td>		1500</td><td></td><td>		0</td></tr>
			<tr><td>Bijdrage GAK in project De Brug</td><td></td><td>				19750</td><td></td><td>		3000</td></tr>
			<tr><td>Ontvangen giften	en bijdragen</td><td></td><td>				2113</td><td></td><td>		5175</td></tr>	
			<tr><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>Totaal Inkomsten</td><td></td><td>					45063</td><td></td><td>		46140</td></tr>
			<tr><td></td><td></td><td></td><td></td><td></td></tr>
			<tr><td>Resultaat 2020 (inkomsten-uitgaven)</td><td></td><td> 			-1787</td><td></td><td></td></tr>
			</table>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
