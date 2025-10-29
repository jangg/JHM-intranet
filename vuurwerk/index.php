<?php
	/************************
	Dit stukje is nodig om misbruik van de website voorkomen
	*************************/
	header("location:../index.php");
	exit();
	
	
	// if (!isset($_SESSION["username"])) {
  	// header("location:../index.php");
  	// exit();
	// }
	// if (isset($_SESSION["userid"])) {
  	// $curr_user = new User("id", $_SESSION["userid"]);
	// } else {
  	// $curr_user = new User();
	// }
	/**********************/

	$receiver_message = 'Hallo,';
	$afzender = 'van JobHulpMaatje Zoetermeer.';
	if (isset($_GET['rv']))
	{
		$receiver = $_GET['rv'];
		switch ($receiver) {

			case 'mt':
				$receiver_message = 'Hallo maatjes,';
				$afzender = 'van JobHulpMaatje Zoetermeer';
				break;

			default:
				$receiver_message = 'Hallo bekende van ons,';
				$afzender = 'van JobHulpMaatje Zoetermeer';
								
		}
		
	} else {
		if (isset($_GET['nm'])) {
			$receiver_message = 'Hallo ' . $_GET['nm'];
			$afzender = 'JobHulpMaatje Zoetermeer';
		}
	}
	unset($_GET['rv']);	
?>
<!DOCTYPE html>
<meta name = "viewport" content = "width = device-width, initial-scale = 1.0">

<html>
	<head>
		<meta property="og:url"				content="https://giekwerf.nl" />
		<meta property="og:type"			   content="website" />
		<meta property="og:title"			  content="Steek wat zelfgemaakte vuurpijlen af met oud en nieuw" />
		<meta property="og:description"		content="Licht en lawaai, en dat zonder gevaar voor mens en milieu, wie wil dat nou niet?" />
		<meta property="og:image"			  content="img/nightsky1.jpg" />
		<meta property="fb:app_id"			   content="222292728203628" />

		<title>Vuurwerk ovan JobHulpMaatje Zoetermeer</title>
		<meta name="description" content="">
		<link href="css/mycss.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		<div id = "board"></div>
		<center>
			<h2 style="color:  gold;"><font style = "font-family:garamond;"><?php echo $receiver_message; ?></font></h2>
			<h1 style=" color: lightblue;"><font style = "font-family:Brush Script MT;">Een gelukkig en gezond 2022!<font></h1>
			<h3 style="color: pink; opacity: .9; font-size: 2em;"><font style = "font-family:garamond;"><?php echo $afzender;?><font></h3> 
			<h3 style=" color: lightblue;">(<a style="color: pink;" href="mailto:info@jhm-zoetermeer.nl">mail ons</a> als je wilt)</h3>
			<p style="color: lightgreen;">Zet je geluid flink hard, tap of klik op het scherm zo vaak je wil en geniet van het vuurwerk!</p>
			
		</center>
		<audio id="audio1" src="https://www.giekwerf.nl/sound/firework_rocket_launch.mp3" preload="auto"></audio>
		<audio id="audio2" src="https://www.giekwerf.nl/sound/firework_explosion_002.mp3" preload="auto"></audio>
		<audio id="audio3" src="https://www.giekwerf.nl/sound/firework_rocket_launch.mp3" preload="auto"></audio>
		<audio id="audio4" src="https://www.giekwerf.nl/sound/firework_explosion_fizz_001.mp3" preload="auto"></audio>
		<audio id="audio5" src="https://www.giekwerf.nl/sound/firework_rocket_launch.mp3" preload="auto"></audio>
		<audio id="audio6" src="https://www.giekwerf.nl/sound/firework_explosion_002.mp3" preload="auto"></audio>
		<audio id="audio7" src="https://www.giekwerf.nl/sound/firework_rocket_launch.mp3" preload="auto"></audio>
		<audio id="audio8" src="https://www.giekwerf.nl/sound/firework_explosion_fizz_005.mp3" preload="auto"></audio>
		<audio id="audio9" src="https://www.giekwerf.nl/sound/firework_rocket_launch.mp3" preload="auto"></audio>
		<audio id="audio10" src="https://www.giekwerf.nl/sound/firework_explosion_002.mp3" preload="auto"></audio>
		<audio id="audio11" src="https://www.giekwerf.nl/sound/firework_rocket_launch.mp3" preload="auto"></audio>
		<audio id="audio12" src="https://www.giekwerf.nl/sound/firework_explosion_002.mp3" preload="auto"></audio>
		<audio id="audio13" src="https://www.giekwerf.nl/sound/firework_rocket_launch.mp3" preload="auto"></audio>
		<audio id="audio14" src="https://www.giekwerf.nl/sound/firework_explosion_fizz_005.mp3" preload="auto"></audio>
		<audio id="audio15" src="https://www.giekwerf.nl/sound/firework_rocket_launch.mp3" preload="auto"></audio>
		<audio id="audio16" src="https://www.giekwerf.nl/sound/firework_explosion_002.mp3" preload="auto"></audio>
		<audio id="audio17" src="https://www.giekwerf.nl/sound/firework_rocket_launch.mp3" preload="auto"></audio>
		<audio id="audio18" src="https://www.giekwerf.nl/sound/firework_explosion_002.mp3" preload="auto"></audio>
		<audio id="audio19" src="https://www.giekwerf.nl/sound/firework_rocket_launch.mp3" preload="auto"></audio>
		<audio id="audio20" src="https://www.giekwerf.nl/sound/firework_explosion_fizz_001.mp3" preload="auto"></audio>
	</body>
	<script src="js/myjs.js"></script>
</html>