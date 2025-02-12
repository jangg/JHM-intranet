<?php
include_once('config.php');
include_once('class/c_user.php');

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
		<?php include('includes/head.inc'); ?>			
		<style>
			.bluefont {
				color: #304280;
				font-weight: 300;
			}
		</style>
	<!-- Custom styles for this template -->
		<link href="css/jumbotron.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<script>
			$(document).ready(function(){
				$("#1").click(function(){
					$(".nieuwsbrief").hide();
					$("#2020081").show();
				});
				$("#2").click(function(){
					$(".nieuwsbrief").hide();
					$("#2020071").show();
				});
				$("#3").click(function(){
					$(".nieuwsbrief").hide();
					$("#2020051").show();
				});
				$("#4").click(function(){
					$(".nieuwsbrief").hide();
					$("#2020041").show();
				});
				$("#5").click(function(){
					$(".nieuwsbrief").hide();
					$("#2020031").show();
				});
				$("#6").click(function(){
					$(".nieuwsbrief").hide();
					$("#2020021").show();
				});
				$("#7").click(function(){
					$(".nieuwsbrief").hide();
					$("#2019081").show();
				});
				$("#8").click(function(){
					$(".nieuwsbrief").hide();
					$("#2020101").show();
				});
				$("#9").click(function(){
					$(".nieuwsbrief").hide();
					$("#2020102").show();
				});
				$("#10").click(function(){
					$(".nieuwsbrief").hide();
					$("#2020111").show();
				});
			});
		</script>
	</head>
 
<body style="background-color: #dddddd; font-size: 16px;">
	<?php include('includes/navbar.inc'); ?>
	<main role="main">
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="container">
			<img src="img/LogoJobHulpMaatjeZoetermeer.jpg" class="mb-4 p-3 img-fluid rounded mx-auto d-block bg-white">
			<h1 class="display-4 bluefont">Nieuwsbrieven</h1>
			<p>Op deze pagina kun je de nieuwsbrieven die JobHulpMaatje Nederland en JobHulpMaatje Zoetermeer verspreiden, terug lezen.</p>
			<p>De originele nieuwsbrieven zijn uiteraard beschikbaar in je email zodra ze worden verspreid. Mocht je ze niet krijgen, dan is een emailtje naar Peter Veld (peter@jhm-zoetermeer.nl) voldoende om je hiervoor op te geven.</p>
			<br/><br/>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h2 class="bluefont">Uitgave nieuwsbrief</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-4">
					<ul>
					<li><p><a id="10" href="#">November 2020</a></p></li>
					<li><p><a id="9" href="#">Oktober 2020</a></p></li>
					<li><p><a id="8" href="#">Oktober special 2020</a></p></li>
					<li><p><a id="1" href="#">Augustus 2020</a></p></li>
					</ul>
				</div>
				<div class="col-4">
					<ul>
					<li><p><a id="2" href="#">Juli 2020</a></p></li>
					<li><p><a id="3" href="#">Mei 2020</a></p></li>
					<li><p><a id="4" href="#">April 2020</a></p></li>
					</ul>
				</div>
				<div class="col-4">	
					<ul>
						<li><p><a id="5" href="#">Maart 2020</a></p></li>
						<li><p><a id="6" href="#">Februari 2020</a></p></li>
						<li><p><a id="7" href="#">Augustus 2019</a></p></li>
					</ul>
				</div>
			</div>
			<div class="row">				
				<div class="col-12">
					<div id="2019081" class="nieuwsbrief"  style="display: none;">
					<?php include('nieuwsbrieven/nb2019081.html'); ?>
					</div>
					<div id="2020021" class="nieuwsbrief"  style="display: none;">
					<?php include('nieuwsbrieven/nb2020021.html'); ?>
					</div>
					<div id="2020031" class="nieuwsbrief"  style="display: none;">
					<?php include('nieuwsbrieven/nb2020031.html'); ?>
					</div>
					<div id="2020041" class="nieuwsbrief" style="display: none;">
					<?php include('nieuwsbrieven/nb2020041.html'); ?>
					</div>
					<div id="2020051" class="nieuwsbrief"  style="display: none;">
					<?php include('nieuwsbrieven/nb2020051.html'); ?>
					</div>
					<div id="2020071" class="nieuwsbrief" style="display: none;">
					<?php include('nieuwsbrieven/nb2020071.html'); ?>
					</div>
					<div id="2020081" class="nieuwsbrief"  style="display: none;">
					<?php include('nieuwsbrieven/nb2020081.html'); ?>
					</div>
					<div id="2020101" class="nieuwsbrief"  style="display: none;">
					<?php include('nieuwsbrieven/nb2020101.html'); ?>
					</div>
					<div id="2020102" class="nieuwsbrief"  style="display: none;">
					<?php include('nieuwsbrieven/nb2020102.html'); ?>
					</div>
					<div id="2020111" class="nieuwsbrief"  style="display: block;">
					<?php include('nieuwsbrieven/nb2020111.html'); ?>
					</div>
				</div>
			</div>
			<!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
		</div>								
	</main>
	<?php include('includes/footer.inc'); ?>
</body>
</html>