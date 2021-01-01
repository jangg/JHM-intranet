<?php
session_start();
include ('includes/configDB.inc');
/* een sessie blijft hoogstens 10 minuten in delucht. Daarna moet er opnieuw worden ingelogd */

// ini_set("session.cookie_lifetime","600");

error_reporting(E_ALL);
setlocale(LC_ALL, 'nl_NL');

/*
if (isset($_GET['uitloggen']) && $_GET['uitloggen'] == 'YES')
{
	unset($_SESSION['username']);
	unset($_SESSION['userID']);
	unset($_GET['uitloggen']);
	header("location: index.php");

}

*/

function openDB ()
{
	global $connection;
	if (!is_a($connection, 'PDO'))
	{
		$connection = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'') );
		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );		
	}
}


?>