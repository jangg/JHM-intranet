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
		<link href="css/mystyle.css" rel="stylesheet" type="text/css">			
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
 
<body>
	
<?php include('../includes/navbar.inc'); ?>
<div class="jumbotron">
	<div id="main">
		<div class="container verslag my-5">
			<h3 class="bluefont">19 december 2023</h3>
			<h1 class="text-black mb-2 bluefont">Twee nieuwe flyers</h1>
			<h5 class="text-black mb-5 bluefont">door Peter Veld</h5>
			<h2> Nieuwe flyers voor 2024</h2>
			<p>Bij JobHulpMaatje werken we hard aan de werving van nieuwe mensen. Niet alleen bieden we werkzoekenden onze hulp aan maar
				ook zijn we op zoek naar nieuwe vrijwilligers. Nieuwe maatjes dus die helpen bij het helpen van de mensen die op zoek zijn naar passend werk.</p>
			<p>We hebben daarom twee nieuwe flyers laten ontwerpen waarmee we belangstellenden kunnen benaderen.</p>
			<p>Je kunt ze hier lezen maar ook downloaden als PDF document. Dat doe je door met de rechtermuisknop het document te selecteren en dan te kiezen voor download.</p>
			<p>Veel succes met de PDF's!</p>
			
			<h3>De PDF voor vrijwilligers</h3>
			<figure class="figure">
			  <img src="../docs/2023vrijwilliger.pdf" class="figure-img img-fluid" alt="PDF vrijwilliger">
			</figure>
			<h3>De PDF voor werkzoekenden</h3>
			<figure class="figure">
			  <img src="../docs/2023werkzoekend.pdf" class="figure-img img-fluid" alt="PDF werkzoekend">
			</figure>

		</div>
	</div>
</div>
</body>
<?php include('../includes/footer.inc'); ?>
</body>
</html>
