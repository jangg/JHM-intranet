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
			bold {
				color: red;
				font-style: italic;
				font-weight: bold;
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
			<div class="row">
				<div class="col-md-12>"
					<h3 class="bluefont">17 januari 2025</h3>
					<h1 class="text-black mb-2 bluefont">Voorjaarsprogramma 2025.</h1>
					<p>Dit is de nieuwe flyer van JobHulpMaatje van het programma voor de eerste helft van 2025. Je kunt de flyer <a href="https://jobhulpmaatjezoetermeer.nl/stichting.php#downloads" tab="new">hier</a> als PDF downloaden.</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/2025voorjaarsprogramma1.jpg" class="figure-img img-fluid" alt="foto 1">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/2025voorjaarsprogramma2.jpg" class="figure-img img-fluid" alt="foto 2">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/2025voorjaarsprogramma3.jpg" class="figure-img img-fluid" alt="foto 1">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/2025voorjaarsprogramma4.jpg" class="figure-img img-fluid" alt="foto 2">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
<!----------->
		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
