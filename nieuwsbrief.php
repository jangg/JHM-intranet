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
	<!-- Custom styles for this template -->
		<!-- <link href="css/jumbotron.css" rel="stylesheet"> -->
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
				$("#11").click(function(){
					$(".nieuwsbrief").hide();
					$("#2020121").show();
				});
				$("#12").click(function(){
					$(".nieuwsbrief").hide();
					$("#2020122").show();
				});
				$("#13").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021021").show();
				});
				$("#14").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021041").show();
				});
				$("#15").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021042").show();
				});
				$("#16").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021043").show();
				});
				$("#17").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021061").show();
				});
				$("#18").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021071").show();
				});
				$("#19").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021072").show();
				});
				$("#20").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021091").show();
				});
				$("#21").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021092").show();
				});
				$("#22").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021101").show();
				});
				$("#23").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021111").show();
				});
				$("#24").click(function(){
					$(".nieuwsbrief").hide();
					$("#2021215").show();
				});
				$("#25").click(function(){
					$(".nieuwsbrief").hide();
					$("#2022021").show();
				});
				$("#26").click(function(){
					$(".nieuwsbrief").hide();
					$("#2022031").show();
				});
				$("#27").click(function(){
					$(".nieuwsbrief").hide();
					$("#2022041").show();
				});
				$("#28").click(function(){
					$(".nieuwsbrief").hide();
					$("#2022042").show();
				});
				$("#29").click(function(){
					$(".nieuwsbrief").hide();
					$("#2022051").show();
				});
				$("#30").click(function(){
					$(".nieuwsbrief").hide();
					$("#2022061").show();
				});
				$("#31").click(function(){
					$(".nieuwsbrief").hide();
					$("#2022101").show();
				});
				$("#32").click(function(){
					$(".nieuwsbrief").hide();
					$("#2022102").show();
				});
				$("#33").click(function(){
					$(".nieuwsbrief").hide();
					$("#20230405").show();
				});
				$("#34").click(function(){
					$(".nieuwsbrief").hide();
					$("#20230831").show();
				});
				$("#35").click(function(){
					$(".nieuwsbrief").hide();
					$("#20231025").show();
				});
				$("#36").click(function(){
					$(".nieuwsbrief").hide();
					$("#20231222").show();
				});
				$("#37").click(function(){
					$(".nieuwsbrief").hide();
					$("#20240213").show();
				});
				$("#38").click(function(){
					$(".nieuwsbrief").hide();
					$("#20240901").show();
				});
				$("#39").click(function(){
					$(".nieuwsbrief").hide();
					$("#20240927").show();
				});
				$("#40").click(function(){
					$(".nieuwsbrief").hide();
					$("#20250201").show();
				});
				$("#41").click(function(){
					$(".nieuwsbrief").hide();
					$("#20250329").show();
				});
				$("#42").click(function(){
					$(".nieuwsbrief").hide();
					$("#20250903").show();
				});




			});
		</script>
		<style>
			.bluefont {
				color: #304280;
				font-weight: 300;
			}
			li p {
				margin: 0;
				padding: 0;
			}
		</style>

	</head>
 
<body class="bodystyle">
	
	<?php include('includes/navbar.inc'); ?>
	<main role="main">
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="container">
			<h1 class="display-4 bluefont p-3">Nieuwsbrieven</h1>
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
				<div class="col-md-4">
					<ul>
					<li><p><a id="42" href="#">September 2025</a></p></li>
					<li><p><a id="41" href="#">April 2025</a></p></li>
					<li><p><a id="40" href="#">Februari 2025</a></p></li>
					</ul>
				</div>
				<div class="col-md-4">
					<ul>
					<li><p><a id="39" href="#">September 2024 nr2</a></p></li>
					<li><p><a id="38" href="#">September 2024 nr1</a></p></li>
					<li><p><a id="37" href="#">Februari 2024</a></p></li>
					</ul>
				</div>
				<div class="col-md-4">
					<ul>
					<li><p><a id="36" href="#">December 2023</a></p></li>
					<li><p><a id="35" href="#">November 2023</a></p></li>
					<li><p><a id="34" href="#">September 2023</a></p></li>
					<li><p><a id="33" href="#">April 2023, JHM Nederland</a></p></li>
					</ul>
				</div>
			</div>
			<div class="row">				
				<div class="col-12">
					<div id="20230405" class="nieuwsbrief"  style="display: none;">
						<?php include('nieuwsbrieven/nb20230405.html'); ?>
					</div>
					<div id="20230831" class="nieuwsbrief"  style="display: none;">
						<?php include('nieuwsbrieven/nb20230831.html'); ?>
					</div>
					<div id="20231025" class="nieuwsbrief"  style="display: none;">
						<?php include('nieuwsbrieven/nb20231025.html'); ?>
					</div>
					<div id="20231222" class="nieuwsbrief"  style="display: none;">
						<?php include('nieuwsbrieven/nb20231222.html'); ?>
					</div>
					<div id="20240213" class="nieuwsbrief"  style="display: none;">
						<?php include('nieuwsbrieven/nb20240213.html'); ?>
					</div>
					<div id="20240901" class="nieuwsbrief"  style="display: none;">
						<?php include('nieuwsbrieven/nb20240901.html'); ?>
					</div>
					<div id="20240927" class="nieuwsbrief"  style="display: none;">
						<?php include('nieuwsbrieven/nb20240927.html'); ?>
					</div>
					<div id="20250201" class="nieuwsbrief"  style="display: none;">
						<?php include('nieuwsbrieven/nb20250201.html'); ?>
					</div>
					<div id="20250329" class="nieuwsbrief"  style="display: none;">
						<?php include('nieuwsbrieven/nb20250329.html'); ?>
					</div>
					<div id="20250903" class="nieuwsbrief"  style="display: block;">
						<?php include('nieuwsbrieven/nb20250903.html'); ?>
					</div>


				</div>
			</div>
			<!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
		</div>								
	</main>
	<?php include('includes/footer.inc'); ?>
</body>
</html>