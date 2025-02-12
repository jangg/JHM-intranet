<?php
include_once('../config.php');
include_once('../class/c_werkzoekende.php');

// if (isset($_POST['emailadres']))
// {
// 	$wkz = new Werkzoekende ('emailadres', $_POST['emailadres']);
// 	if ($wkz->id == NULL)
// 		echo 'not found';
// 		else
// 		{
// 			echo json_encode($wkz);
// 		}
// }
	$wkz = new Werkzoekende ('emailadres', 'pietje@puk.nl');
	if ($wkz->id == NULL)
		echo 'not found';
		else
		{
			// echo $wkz->voornaam;
			print_r($wkz);
			print_r(json_encode($wkz));
			$age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
			echo json_encode($age);
			
		}

?>