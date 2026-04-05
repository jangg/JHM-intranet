<?php
/*  Verjaardagskaarten versturen.
    Deze app leest dagelijks de personentabel uit de database
	Als de geboorte dag-maand gelijk is aan de vandaag dag-maand dan wordt een verjaarskaart verstuur
	met daarop:
		de naam van de jarige
		de felicitaties van bestuur en de rest van jobhulpmaatje zoetermeer
		de kaart staat in een HTML bestand 
	----------
	1. Haal jarigen op
	2. Als er geen jarigen zijn dan eindig job
	3. Haal kaart op, random
	4. Stuur voor iedere jarige een kaart met email.
	5. Stuur email naar beheerder met resultaten.
*/

include_once(__DIR__ . '/../config.php');
include_once __DIR__ . '/../class/c_maatje_coll.php';
include_once __DIR__ . '/../class/c_werkzoekende_coll.php';

function getMsgHtml ()
{
	$html =  file_get_contents(__DIR__ . '/../kaarten/felicitatiekaart.html', TRUE);
//	error_log($html);
	return $html;
}

$arr1 = array (array (0 => 'person.type', 1 => 'mtj'));
$arr2 = array (array (0 => 'person.achternaam', 1 => 'ASC'));
$maatjesColl = new Maatje_coll ($arr1, $arr2);
$jarigeMaatjes = $maatjesColl->jarigeMaatjes();

$arr1 = array (array (0 => 'person.type', 1 => 'wkz'));
$arr2 = array (array (0 => 'person.achternaam', 1 => 'ASC'));
$wkzsColl = new Werkzoekende_coll ($arr1, $arr2);
$jarigeWkzs = $wkzsColl->jarigeWkzs();

// echo 'De jarigen zijn opgehaald. Ik ga starten\n';

/*********************
** Let op: maatjes en werkzoekenden zijn verschillende records. Toch worden ze gemerged omdat voor de 
** deze app alleen gebruik wordt gemaakt van de person class data.
**********************/

$jarigen = array_merge($jarigeMaatjes, $jarigeWkzs);
if (empty($jarigen))
	{
		Tools::MailRoom ('Coordinatoren', 'coordinatoren@jobhulpmaatjezoetermeer.nl', 'Verjaardagen', 'We kunnen geen jarigen vinden vandaag. Jammer!');
		// echo "We kunnen geen jarigen vinden vandaag. Jammer!\n";
		exit();
	}

// echo 'Ok, er zijn jarigen. Nu kaartje ophalen!\n';

$onderwerp = 'Een felicitatiekaart voor jou!';

$kaart = getMsgHtml ();

// echo 'Kaart is opgehaald.\n';

foreach ($jarigen as $jarige)
{	
/*************************************/
/*  HIER wordt de email verstuurd!   */				
/*************************************/	 
	if ($jarige->emailadres != '')
	{
		$kaart_temp = str_replace('###naam###', $jarige->voornaam, $kaart);
		Tools::MailRoom ($jarige->voornaam, $jarige->emailadres, $onderwerp, $kaart_temp);
		// echo 'Kaart verstuurd!\n';
		Tools::MailRoom ('Coordinatoren', 'coordinatoren@jobhulpmaatjezoetermeer.nl', 'Hoera! Een jarige vandaag.', $jarige->voornaam . ' ' . $jarige->tussenvoegsels . ' ' . $jarige->achternaam . ' is vandaag jarig en heeft een verjaardagskaart van JobHulpMaatje ontvangen!');
		// echo 'Bericht naar coord verstuurd.\n';
	}
}
?>
