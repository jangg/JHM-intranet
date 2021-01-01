<?php
include('config.php');
include_once ('class/c_maatje.php');
include_once ('class/c_werkzoekende.php');
include_once ('class/c_processtap.php');
include_once ('class/c_user.php');

$ps = new Processtap ();

// $connection = new PDO("mysql:host=localhost; dbname=db_jhm_myhvs", "jhm_jangg", "Opgep1st!", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
// $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
// $wkz->saveToDB();

echo $ps;

// $wkz2 = new Werkzoekende ();
// $wkz->GAKind = 'j';
// $wkz->voornaam = 'Carla';
// $wkz->toelichting = 'Dit is de toelichting';
// 
// $wkz->updateToDB ();

// print_r ($wkz . '<br/>');

$ps->id_werkzkd = '200';
$ps->id_user = '3';
$ps->wzstatus = '100';
$ps->drstrnaar = 'werk';
$ps->toelichting = 'En dit is de toelichting!';

if($ps->saveToDB()) echo $ps;

$ps->toelichting = 'En dit is de tweede toelichting!';

if($ps->updateToDB()) echo $ps;
$user = new User ('id', $ps->id_user);
echo $user->voornaam . ' ' . $user->achternaam;
?>
