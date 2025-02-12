<?php
include_once('../config.php');
include_once('../class/c_user.php');
/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:index.php');
	exit();
}
if (isset($_SESSION['userid']))
{
	$curr_user = new User ('id', $_SESSION['userid']);
} else
{
	$curr_user = new User ();
}
/**********************/

?>
<!DOCTYPE HTML>
<html lang="nl-NL">
	<head>
		<?php include('../includes/head.inc'); ?>			
		<style>
			.bluefont {
				color: #304280;
				font-weight: 300;
			}
			.bg-jhmz {
				background-color: #eeeeee;
			}
			.errormessage {
				color: red;
			}
			.oldphoto {
				border-style: solid;
				border-width: 35px 35px 35px 35px;
				-moz-border-image: url(../img/photoborder2.png) 65 65 65 65 stretch stretch;
				-webkit-border-image: url(../img/photoborder2.png) 65 65 65 65 stretch stretch;
				-o-border-image: url(../img/photoborder2.png) 65 65 65 65 stretch stretch;
				border-image: url(../img/photoborder2.png) 70 65 70 65 stretch stretch;
				-o-transform:rotate(5deg);
				-webkit-transform:rotate(5deg);
				-moz-transform:rotate(5deg);
				
			}
		</style>
	<!-- Custom styles for this template -->
		<link href="../css/jumbotron.css" rel="stylesheet" type='text/css'>
		<link href="../css/mystyle.css" rel="stylesheet" type='text/css'>
		<link href="https://fonts.googleapis.com/css2?family=Courier+Prime&family=Source+Serif+Pro&display=swap" rel="stylesheet">
	</head>
 
<body style="background-color: #dddddd; font-size: 16px;">
	
<?php include('../includes/navbar.inc'); ?>
<div class="jumbotron">
	<div id="main">
		<div class="container verslag my-5">
			<h3 class="bluefont">16 juli 2021</h3>
			<h1 class="text-black mb-2 bluefont">Foto impressie iWIN 2021</h1>
			<h5 class="text-black mb-5 bluefont">Jan Geerdes</h5>
			<img src="../img/IMG_0050.jpeg" class="my-2 float-right oldphoto" style="width: 100%; margin-left: 15px;">
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
