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
		<link href="css/mystyle.css" rel="stylesheet" type="text/css">		
		<style>
			.bluefont {
				color: #304280;
				font-weight: 300;
			}
		</style>
	<!-- Custom styles for this template -->
		<link href="css/jumbotron.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
<!-- 		<script type="text/javascript" src="../../extras/jquery.min.1.7.js"></script> -->
		<script type="text/javascript" src="js/turnjs4/extras/modernizr.2.5.3.min.js"></script>
	</head>
 
<body class="bodystyle">
	
	<?php include('includes/navbar.inc'); ?>
	<main role="main">
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<div class="container">
			<div class="row">				
				<div class="col-12">
					<div id="flipbook" class="mt-5">
						<div class="flipbook">
							<div> <img src="img/jaarverslag2021/1.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/2.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/3.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/4.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/5.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/6.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/7.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/8.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/9.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/10.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/11.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/12.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/13.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/14.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/15.jpg" class='img-fluid'></div>
							<div> <img src="img/jaarverslag2021/16.jpg" class='img-fluid'></div>
							
						</div>
					</div>
				</div>
				<div class="col-12">
					<h5 class="mt-4">Klik op de hoeken om de bladzijden om te slaan.</h5>
				</div>
			</div>
			<!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->
		</div>								
	</main>
	<?php include('includes/footer.inc'); ?>
	<script type="text/javascript">
function loadApp() {

	// Create the flipbook

	
	$('.flipbook').turn({
			// Width
	
			width:922,
			
			// Height
	
			height:650,
	
			// Elevation
	
			elevation: 50,
			
			// Enable gradients
	
			gradients: true,
			
			// Auto center this flipbook
	
			autoCenter: true
	
	});

}

// Load the HTML4 version if there's not CSS transform

yepnope({
	test : Modernizr.csstransforms,
	yep: ['js/turnjs4/lib/turn.js'],
	nope: ['js/turnjs4/lib/turn.html4.min.js'],
	both: ['css/basic.css'],
	complete: loadApp
});
	</script>
</body>
</html>