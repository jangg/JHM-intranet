<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_agendaitem.php');

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
	exit();
}
/**********************/

// error_log('Start van proces_jg.php');

if (isset($_POST['backNiBut']) && $_POST['backNiBut'] == 'back')
{
	header("location: overz_agendaitems.php");
	exit();	
}

if (isset($_POST['saveNiBut']) && $_POST['saveNiBut'] == 'bewaar')
{
	if ($_SESSION['agendaitem_id'] == '0')
	{
		$agendaitem = new Agendaitem ();
		$agendaitem_nw = clone $agendaitem;
		$date = new DateTime();
		$agendaitem_nw->datetime_created = $date->format('Y-m-d H:i:s');
		$agendaitem_nw->datetime_modified	= $date->format('Y-m-d H:i:s');
	}
	else
	{
		$agendaitem = new Agendaitem ('id', $_SESSION['agendaitem_id']);
		$agendaitem_nw = clone $agendaitem;
		$date = new DateTime();
		$agendaitem_nw->datetime_modified		= $date->format('Y-m-d H:i:s');
	}
	
	$agendaitem_nw->id_user_created		= $_SESSION['userid'];
	$agendaitem_nw->type				= 'evnt';
	$agendaitem_nw->titel				= $_POST['titel'];
	$agendaitem_nw->omschrijving		= $_POST['omschrijving'];
	$agendaitem_nw->datum				= $_POST['datum'];
	$agendaitem_nw->begintijd			= $_POST['begintijd'];
	$agendaitem_nw->eindtijd			= $_POST['eindtijd'];
	$agendaitem_nw->locatie				= $_POST['locatie'];
	$agendaitem_nw->organisator			= $_POST['organisator'];
	$agendaitem_nw->publmed 			= 0;
	if (isset($_POST['pubind_extern']))
		$agendaitem_nw->publmed += 1;
	if (isset($_POST['pubind_intern']))
		$agendaitem_nw->publmed += 2;		
	
	$agendaitem_nw->freefld1				= $_POST['freefld1'];
	$agendaitem_nw->freefld2				= $_POST['freefld2'];
	$agendaitem_nw->freefld3				= $_POST['freefld3'];
	$agendaitem_nw->freefld4				= $_POST['freefld4'];
		
	/*****
	** hier moet de foto worden opgeslagen
	*****/
	// $ftp_server = 'localhost';
	// $ftp_user_name = 'root';
	// $ftp_user_pwd = 'root';
	// $conn_id = ftp_connect($ftp_server);
	// $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pwd); 
	// if ((!$conn_id) || (!$login_result)) { 
	// 	error_log ("FTP connection has failed!");
	// 	error_log ("Attempted to connect to $ftp_server for user $ftp_user_name"); 
	// 	exit; 
	// } else {
	// 	error_log ("Connected to $ftp_server, for user $ftp_user_name");
	// }
	// $imagename = $_FILES["chooseimage"]["name"];
	// $tempname = $_FILES["chooseimage"]["tmp_name"];
	// $imagefolder = "../newsimages/"; 
	// $agendaitem_nw->picfile = $imagefolder . $imagename;
	// $upload = ftp_put($conn_id, $imagefolder . $imagename, $imagename, FTP_BINARY);
	// 
	// // $upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);
	// // move_uploaded_file($tempname, $imagefolder);
	// ftp_close($conn_id);
	
	if ($agendaitem_nw != $agendaitem)
	{
		if ($agendaitem_nw->id == 0) $agendaitem_nw->saveToDB(); else $agendaitem_nw->updateToDB();
	} 
	/* start de page opnieuw om een tweede update te voorkomen */
	header('location: mut_agendaitem.php?id=' . $agendaitem_nw->id);
	exit();	
}

if (isset($_POST['deleteNiBut']) && $_POST['deleteNiBut'] == 'delete')
{
	if (isset($_SESSION['agendaitem_id']))
	{
		$agendaitem = new Agendaitem ('id', $_SESSION['agendaitem_id']);
		$agendaitem->delind = 'j';
		$agendaitem->updateToDB();
		header('location: overz_agendaitems.php');
		exit();
	}
}

// header("location: overz_agendaitems.php");
// exit();	

?>