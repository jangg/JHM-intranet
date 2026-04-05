<?php
/* een sessie blijft hoogstens 4 uur in de lucht. Daarna moet er opnieuw worden ingelogd */
ini_set("session.cookie_lifetime","14400");
/** Session hardening (zet dit liefst in config.php vóór session_start) */
ini_set('session.cookie_httponly', '1');
ini_set('session.use_only_cookies', '1');
if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
	ini_set('session.cookie_secure', '1');
}

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
if (isset($_SESSION['userid'])) {
	// idle time, na 30 minuten wordt de sessie afgebroken en moet opnieuw ingelogd worden.
	$ttl = 30 * 60; // 30 min
	if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $ttl) {
		session_unset();
		session_destroy();
		header('Location: /index.php');
		exit();
	}
	$_SESSION['last_activity'] = time();
}

include ('includes/configDB.php');
include_once ('class/c_tools.php');
error_reporting(E_ALL);
setlocale(LC_ALL, 'nl_NL');

function openDB ()
{
	global $connection;
	if (!is_a($connection, 'PDO'))
	{
		$connection = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'') );
		$connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		// error_log('Het openen van de database lukt wel!');	
	}
}

?>