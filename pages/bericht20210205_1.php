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
		<div class="container verslag my-5"">
			<h3 class="bluefont">5 februari 2021</h3>
			<h1 class="text-black mb-2 bluefont">Jaarverslag JobHulpMaatje Zoetermeer (Reliance) 2020</h1>
			<h5 class="text-black mb-5 bluefont">Jan Waaijer, voorzitter</h5>
			<p>Hier vind je het jaarverslag 2020 in PDF-formaat. Je kunt de versie hieronder doorscrollen of je kunt een versie downloaden.</p>
			<object  style="width:100%; height: 500px;" class="embed-fluid" data="../docs/jaarverslag2020.pdf?toolbar=0&navpanes=0" type="application/pdf" internalinstanceid="9" title="">
				 <p>
					Jouw browser ondersteunt niet het bekijken van PDF-bestanden.
					Je kunt het PDF-bestand downloaden
					<a href="../docs/jaarverslag2020.pdf">hier.</a>.
				 </p>
			  </object>
		</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
