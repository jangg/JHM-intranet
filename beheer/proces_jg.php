<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_jobgroup.php');
include_once('../class/c_jgsessie.php');
include_once('../class/c_werkzoekende.php');

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
	exit();
}
/**********************/

// error_log('Start van proces_jg.php');

if (isset($_POST['backJgBut']) && $_POST['backJgBut'] == 'back')
{
	header("location: overz_jobgroups.php");
	exit();	
}

if (isset($_POST['backJsBut']) && $_POST['backJsBut'] == 'back')
{
	header("location: mut_jobgroup.php?id=" . $_SESSION['jobgroup_id']);
	exit();	
}

if (isset($_POST['updateJgBut']) && $_POST['updateJgBut'] == 'wijzig')
{
	if ($_SESSION['jobgroup_id'] == '0')
	{
		$jgp = new Jobgroup ();
	}
	else
	{
		$jgp = new Jobgroup ('id', $_SESSION['jobgroup_id']);
	}
	
	$jgp_nw = clone $jgp;
	$jgp_nw->titel				= $_POST['titel'];
	$jgp_nw->omschrijving		= $_POST['omschrijving'];
	$jgp_nw->status				= $_POST['status'];
	$jgp_nw->id_locatie			= $_POST['locatie'];
	$jgp_nw->soort				= $_POST['soort'];
	$jgp_nw->onlineInd			= $_POST['onlineInd'];
	$jgp_nw->nbrPlaatsen		= $_POST['nbrPlaatsen'];
	$jgp_nw->jgleider1			= $_POST['jgleider1'];
	$jgp_nw->jgleider2			= $_POST['jgleider2'];
	$jgp_nw->opmerkingen		= $_POST['opmerkingen'];
	
	if ($jgp_nw != $jgp)
	{
		if ($jgp_nw->id == 0) $jgp_nw->saveToDB(); else $jgp_nw->updateToDB();
	} 
	/* start de page opnieuw om een tweede update te voorkomen */
	header('location: mut_jobgroup.php?id=' . $jgp_nw->id);
	exit();	
}

if (isset($_POST['updateJsBut']) && $_POST['updateJsBut'] == 'wijzig')
{
	if (!isset($_GET['idjs']) || $_GET['idjs'] == '0')
	{
		$js = new Jgsessie ();
	}
	else
	{
		$js = new Jgsessie ('id', $_GET['idjs']);
	}
	
	$js_nw = clone $js;
	$js_nw->titel				= $_POST['js-titel'];
	$js_nw->id_locatie			= $_POST['js-locatie'];
	$js_nw->datetime_start		= $_POST['js-startdate'] . ' ' . $_POST['js-starttime'] . ':00';
	$js_nw->datetime_end		= $_POST['js-startdate'] . ' ' . $_POST['js-endtime'] . ':00';
	$js_nw->id_jobgroup			= $_SESSION['jobgroup_id'];
	
	if ($js_nw != $js)
	{
		if ($js_nw->id == NULL) $js_nw->saveToDB(); else $js_nw->updateToDB();
	} 
	/* start de page opnieuw om een tweede update te voorkomen */
	header('location: mut_jobgroup.php?id=' . $_SESSION['jobgroup_id']);
	exit();	
}

if (isset($_POST['delJs']) && $_POST['delJs'] == 'delete')
{
//	error_log('delJs = ' . $_POST['delJs'] . ' , idjs = ' . $_POST['idjs'] . '<br/>');
	if (isset($_POST['idjs']))
	{
		$js = new Jgsessie ('id', $_POST['idjs']);
		$js->deleteFromDB();
		unset($js);
		header('location: mut_jobgroup.php?id=' . $_SESSION['jobgroup_id']);
		exit();
	}
}
if (isset($_POST['modJs']) && $_POST['modJs'] == 'modify')
{
	// error_log('modJs = ' . $_POST['modJs'] . ' , idjs = ' . $_POST['idjs']);
	if (isset($_POST['idjs']))
	{
		$js = new Jgsessie ('id', $_POST['idjs']);
		echo $js->objectToJSON();
		exit();
	}
}

if (isset($_POST['deleteJgBut']) && $_POST['deleteJgBut'] == 'delete')
{
	if (isset($_SESSION['jobgroup_id']))
	{
		$jg = new Jobgroup ('id', $_SESSION['jobgroup_id']);
		$jg->delind = 'j';
		$jg->updateToDB();
		/* verwijder alle referenties naar de jobgroup voor alle deelnemrs */
		$jg->delSubrecs();
		header('location: overz_jobgroups.php');
		exit();
	}
}

if (isset($_POST['delWkz']) && $_POST['delWkz'] == 'delete')
{
//	error_log('delJs = ' . $_POST['delJs'] . ' , idjs = ' . $_POST['idjs'] . '<br/>');
	if (isset($_POST['idwkz']))
	{
		$wkz = new Werkzoekende ('id', $_POST['idwkz']);
		$wkz->id_jobgroup = NULL;
		$wkz->updateToDB();
		header('location: mut_jobgroup.php?id=' . $_SESSION['jobgroup_id']);
		exit();
	}
}


// header("location: overz_jobgroups.php");
// exit();	

?>