<?php
//
include_once('../config.php');
include_once('../class/c_user.php');

// echo $_POST['userid'];
if(isset($_POST['userid']) && is_numeric($_POST['userid']))
{
	$user = new User('id', $_POST['userid']);
	if ($user->presentInd != 'j')
		$user->presentInd = 'j';
	else
		$user->presentInd = 'n';
	$user->updateToDB();
	// error_log('De userid is ' . $_POST['userid'] . '\n');
	header('location: presence_list.php');
	exit();
}

?>