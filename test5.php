<?php
include_once('config.php');
include_once('class/c_werkzoekende_coll.php');

/* haal alle in aanmerking komende wkz op
/* geef overzicht van gevonden wkz
/* geef teken dat ze verwijderd kunnen worden
*/

// $arr1 = array ();
// $arr2 = array ();
// $arr1 = array (array (0 => 'werkzkd.status', 1 => 0));
// $arr2 = array (array (0 => 'person.datetime_created', 1 => 'ASC'));
// 
// $wzColl = new Werkzoekende_coll($arr1, $arr2);
// $i = 0;
// 
// foreach ($wzColl->werkzoekendeColl as $wkz)
// {	
// 	if ($wkz->datetime_created < '2020-07-01')
// 	{
// 		$i++;
// 		echo $wkz->datetime_created . ' - ' . $wkz->achternaam . ' - ' . $wkz->status . '<br/>';
// 	}
// }
// echo 'Aantal : ' . $i . '<br/>';

// foreach ($wzColl->werkzoekendeColl as $wkz)
// {	
// 	if ($wkz->datetime_created < '2020-07-01')
// 	{
// 		$i++;
// 		$wkz->delind = 't';
// 		$wkz->updateToDB();
// 	}
// }

$wzColl2 = new Werkzoekende_coll();
$wzColl2->getAllWerkzoekenden();
echo 'Aantal : ' . count($wzColl2->werkzoekendeColl) . '<br/>';
foreach ($wzColl2->werkzoekendeColl as $wkz)
{	
	echo $wkz->datetime_created . ' - ' . $wkz->achternaam . ' - ' . $wkz->status;
	if ($wkz->delind == 't')
	{
		$i++;
		echo ' - X<br/>';
		$wkz->delind = 'n';
		$wkz->updateToDB();
	}
	else echo  '<br/>';
}
echo 'Aantal : ' . $i . '<br/>';
?>
