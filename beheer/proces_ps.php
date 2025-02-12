<?php
include_once('../config.php');
include_once('../class/c_processtap.php');

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
	exit();
}
/**********************/

// error_log('Start van proces_jg.php');

if (isset($_POST['delPs']) && $_POST['delPs'] == 'delete')
{
//	error_log('delJs = ' . $_POST['delJs'] . ' , idjs = ' . $_POST['idjs'] . '<br/>');
	if (isset($_POST['idps']))
	{
		$ps = new Processtap ('id', $_POST['idps']);
		$ps->delind = 'j';
		$ps->updateToDB();
		header('location: mut_persoon.php?id=' . $_SESSION['werkzkd_id']);
		exit();
	}
}

?>