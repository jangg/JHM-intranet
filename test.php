<?php
$testdate = '21-11-1955';
if ($testdate != '')
{
	if(preg_match("/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/", $testdate) === 0) 
	{
		  $daten		= 'ongeldige datum';
	} else
	{
		$date = DateTime::createFromFormat('d-m-Y', $testdate);
		$daten		= $date->format('Y-m-d');
	} 
} else
{
	  $daten		= 'leeg';
}

echo $daten;
?>
