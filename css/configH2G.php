<?php
function openDB ()
{
	global $connection;
	if (!is_a($connection, 'PDO'))
	{
		$connection = new PDO("mysql:host=intra.jhmz.nl; dbname=prohuyg144_jhmiB", "prohuyg144_jhm", "JHM_user&123", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
}

?>