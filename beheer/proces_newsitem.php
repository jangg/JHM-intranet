<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_newsitem.php');

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
	header("location: overz_newsitems.php");
	exit();	
}

if (isset($_POST['saveNiBut']) && $_POST['saveNiBut'] == 'bewaar')
{
	if ($_SESSION['newsitem_id'] == '0')
	{
		$newsitem = new Newsitem ();
		$newsitem_nw = clone $newsitem;
		$date = new DateTime();
		$newsitem_nw->datetime_created = $date->format('Y-m-d H:i:s');
		$newsitem_nw->datetime_modified	= $date->format('Y-m-d H:i:s');
	}
	else
	{
		$newsitem = new Newsitem ('id', $_SESSION['newsitem_id']);
		$newsitem_nw = clone $newsitem;
		$date = new DateTime();
		$newsitem_nw->datetime_modified		= $date->format('Y-m-d H:i:s');
	}
	
	$newsitem_nw->id_user_created		= $_SESSION['userid'];
	$newsitem_nw->titel					= $_POST['titel'];
	$newsitem_nw->subtitel				= $_POST['subtitel'];
	$newsitem_nw->tekst					= $_POST['tekst'];
	$newsitem_nw->tekst_kort			= $_POST['tekst_kort'];
	$newsitem_nw->tekst_samenvatting	= $_POST['tekst_samenvatting'];
	$newsitem_nw->tekst_knop			= $_POST['tekst_knop'];
	$newsitem_nw->link_knop				= $_POST['link_knop'];
	if (isset($_POST['pubind_intern']))
		$newsitem_nw->pubind_intern			= 'j';
		else
		$newsitem_nw->pubind_intern			= 'n';
	if ($_POST['datetime_pub_intern'] != '')
		$newsitem_nw->datetime_pub_intern			= $_POST['datetime_pub_intern'];
		else
		$newsitem_nw->datetime_pub_intern			= NULL;
	if (isset($_POST['pubind_extern']))
		$newsitem_nw->pubind_extern			= 'j';
		else
		$newsitem_nw->pubind_extern			= 'n';
	if ($_POST['datetime_pub_extern'] != '')
		$newsitem_nw->datetime_pub_extern			= $_POST['datetime_pub_extern'];
		else
		$newsitem_nw->datetime_pub_extern			= NULL;
	$newsitem_nw->picfile1				= $_POST['picfile1'];
	$newsitem_nw->picfile2				= $_POST['picfile2'];
	$newsitem_nw->picfile3				= $_POST['picfile3'];
	$newsitem_nw->picfile4				= $_POST['picfile4'];
		
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
	// $newsitem_nw->picfile = $imagefolder . $imagename;
	// $upload = ftp_put($conn_id, $imagefolder . $imagename, $imagename, FTP_BINARY);
	// 
	// // $upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);
	// // move_uploaded_file($tempname, $imagefolder);
	// ftp_close($conn_id);
	
	if ($newsitem_nw != $newsitem)
	{
		if ($newsitem_nw->id == 0) $newsitem_nw->saveToDB(); else $newsitem_nw->updateToDB();
	} 
	/* start de page opnieuw om een tweede update te voorkomen */
	header('location: mut_newsitem.php?id=' . $newsitem_nw->id);
	exit();	
}

if (isset($_POST['deleteNiBut']) && $_POST['deleteNiBut'] == 'delete')
{
	if (isset($_SESSION['newsitem_id']))
	{
		$newsitem = new Newsitem ('id', $_SESSION['newsitem_id']);
		$newsitem->delind = 'j';
		$newsitem->updateToDB();
		header('location: overz_newsitems.php');
		exit();
	}
}

// header("location: overz_newsitems.php");
// exit();	

?>