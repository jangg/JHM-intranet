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
					<h3 class="bluefont">18 december 2024</h3>
					<h1 class="text-black mb-2 bluefont">Fotoverslag kerstmaatjesavond 16 december</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto02l.jpg" class="figure-img img-fluid" alt="foto 1">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto03l.jpg" class="figure-img img-fluid" alt="foto 2">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto01p.jpg" class="figure-img img-fluid" alt="foto 1">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto08p.jpg" class="figure-img img-fluid" alt="foto 2">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
.
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto04l.jpg" class="figure-img img-fluid" alt="foto 4">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto05l.jpg" class="figure-img img-fluid" alt="foto 5">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>		
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto06l.jpg" class="figure-img img-fluid" alt="foto 6">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto07l.jpg" class="figure-img img-fluid" alt="foto 7">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
						
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto09p.jpg" class="figure-img img-fluid" alt="foto 9">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto10p.jpg" class="figure-img img-fluid" alt="foto 10">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
			.
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto11p.jpg" class="figure-img img-fluid" alt="foto 11">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto21p.jpg" class="figure-img img-fluid" alt="foto 12">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
<!----------->
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto22p.jpg" class="figure-img img-fluid" alt="foto 22">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto23p.jpg" class="figure-img img-fluid" alt="foto 23">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
						
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto24p.jpg" class="figure-img img-fluid" alt="foto 24">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto25p.jpg" class="figure-img img-fluid" alt="foto 25">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
			.
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto26p.jpg" class="figure-img img-fluid" alt="foto 26">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto27p.jpg" class="figure-img img-fluid" alt="foto 27">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
<!----------->

			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto32p.jpg" class="figure-img img-fluid" alt="foto 32">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto33p.jpg" class="figure-img img-fluid" alt="foto 33">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
						
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto34p.jpg" class="figure-img img-fluid" alt="foto 341">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
				<div class="col-md-6">
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto35p.jpg" class="figure-img img-fluid" alt="foto 35">
						<!-- <figcaption class="figure-caption">Sparkrender slaapt op de hoge toren</figcaption> -->
					</figure>
				</div>
			</div>
			.
			<div class="row">
				<div class="col-md-6">		
					<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="../img/kerstpics/foto31l.jpg" class="figure-img img-fluid" alt="foto 31">
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
