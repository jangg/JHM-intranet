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

$datetime = new DateTime();
$timestamp = $datetime->format('Y\-m\-d\ H:i:s');

// error_log($timestamp . ' -- ' . $_SESSION['username']);

if ($curr_user->username != 'jangg')
{
	if ($timestamp < '2021-04-19 20:10:00' || $timestamp > '2021-04-19 21:52:00')
	{
		header('location:home.php');
		exit();	
	}
}
$id_team = $curr_user->id_team;

try {
	openDB();
	$sql = "SELECT * FROM pubquizteams WHERE id = :id;";
	$stmt = $connection->prepare( $sql );
	$stmt->bindValue( ":id", $id_team, PDO::PARAM_STR);
	$stmt->execute();
	$teamrec = $stmt->fetch(PDO::FETCH_ASSOC);
	
	
} catch (PDOException $e) 
{
	error_log('Connectie (pubquizvragen 1) met de database mislukt: ' . $e->getMessage());
	return FALSE;
}

if (isset($_POST['verstuurBut']) && $_POST['verstuurBut'] == 'verstuur')
{
	if (isset($_POST['vr01'])) $vr01 = $_POST['vr01']; else $vr01 = '';
	if (isset($_POST['vr02'])) $vr02 = $_POST['vr02']; else $vr02 = '';
	if (isset($_POST['vr03'])) $vr03 = $_POST['vr03']; else $vr03 = '';
	if (isset($_POST['vr04'])) $vr04 = $_POST['vr04']; else $vr04 = '';
	if (isset($_POST['vr05'])) $vr05 = $_POST['vr05']; else $vr05 = '';
	if (isset($_POST['vr06'])) $vr06 = $_POST['vr06']; else $vr06 = '';
	if (isset($_POST['vr07'])) $vr07 = $_POST['vr07']; else $vr07 = '';
	if (isset($_POST['vr08'])) $vr08 = $_POST['vr08']; else $vr08 = '';
	if (isset($_POST['vr09'])) $vr09 = $_POST['vr09']; else $vr09 = '';
	if (isset($_POST['vr10'])) $vr10 = $_POST['vr10']; else $vr10 = '';
	if (isset($_POST['vr11'])) $vr11 = $_POST['vr11']; else $vr11 = '';
	if (isset($_POST['vr12'])) $vr12 = $_POST['vr12']; else $vr12 = '';
	if (isset($_POST['vr13'])) $vr13 = $_POST['vr13']; else $vr13 = '';
	if (isset($_POST['vr14'])) $vr14 = $_POST['vr14']; else $vr14 = '';
	if (isset($_POST['vr15'])) $vr15 = $_POST['vr15']; else $vr15 = '';
	if (isset($_POST['vr16'])) $vr16 = $_POST['vr16']; else $vr16 = '';
	if (isset($_POST['vr17'])) $vr17 = $_POST['vr17']; else $vr17 = '';
	if (isset($_POST['vr18'])) $vr18 = $_POST['vr18']; else $vr18 = '';
	if (isset($_POST['vr19'])) $vr19 = $_POST['vr19']; else $vr19 = '';
	if (isset($_POST['vr20'])) $vr20 = $_POST['vr20']; else $vr20 = '';
	
	global $connection;
	try {
		openDB();
		$sql = "UPDATE pubquizteams SET
				dt_modified = :dt_modified,
				vr01 = :vr01,
				vr02 = :vr02,
				vr03 = :vr03,
				vr04 = :vr04,
				vr05 = :vr05,
				vr06 = :vr06,
				vr07 = :vr07,
				vr08 = :vr08,
				vr09 = :vr09,
				vr10 = :vr10,
				vr11 = :vr11,
				vr12 = :vr12,
				vr13 = :vr13,
				vr14 = :vr14,
				vr15 = :vr15,
				vr16 = :vr16,
				vr17 = :vr17,
				vr18 = :vr18,
				vr19 = :vr19,
				vr20 = :vr20
				WHERE id = :id;
		";
		$stmt = $connection->prepare( $sql );
		$stmt->bindValue( ":id", $id_team, PDO::PARAM_STR);
		$stmt->bindvalue( ":dt_modified", $timestamp, PDO::PARAM_STR);
		$stmt->bindValue( ":vr01", $vr01, PDO::PARAM_STR);
		$stmt->bindValue( ":vr02", $vr02, PDO::PARAM_STR);
		$stmt->bindValue( ":vr03", $vr03, PDO::PARAM_STR);
		$stmt->bindValue( ":vr04", $vr04, PDO::PARAM_STR);
		$stmt->bindValue( ":vr05", $vr05, PDO::PARAM_STR);
		$stmt->bindValue( ":vr06", $vr06, PDO::PARAM_STR);
		$stmt->bindValue( ":vr07", $vr07, PDO::PARAM_STR);
		$stmt->bindValue( ":vr08", $vr08, PDO::PARAM_STR);
		$stmt->bindValue( ":vr09", $vr09, PDO::PARAM_STR);
		$stmt->bindValue( ":vr10", $vr10, PDO::PARAM_STR);
		$stmt->bindValue( ":vr11", $vr11, PDO::PARAM_STR);
		$stmt->bindValue( ":vr12", $vr12, PDO::PARAM_STR);
		$stmt->bindValue( ":vr13", $vr13, PDO::PARAM_STR);
		$stmt->bindValue( ":vr14", $vr14, PDO::PARAM_STR);
		$stmt->bindValue( ":vr15", $vr15, PDO::PARAM_STR);
		$stmt->bindValue( ":vr16", $vr16, PDO::PARAM_STR);
		$stmt->bindValue( ":vr17", $vr17, PDO::PARAM_STR);
		$stmt->bindValue( ":vr18", $vr18, PDO::PARAM_STR);
		$stmt->bindValue( ":vr19", $vr19, PDO::PARAM_STR);
		$stmt->bindValue( ":vr20", $vr20, PDO::PARAM_STR);
		//			echo $sql . '<br/>';
		$stmt->execute();
		// $row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		
	} catch (PDOException $e) 
	{
		error_log('Connectie (pubquizvragen 2) met de database mislukt: ' . $e->getMessage());
		return FALSE;
	}
	header("location:pubquiz.php");
	exit();
}
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
			.bg-jhmz {
				background-color: #eeeeee;
			}
			.errormessage {
				color: red;
			}
			span {
				color: red;
			}
		</style>
	<!-- Custom styles for this template -->
		<link href="css/jumbotron.css" rel="stylesheet">
		<script>
		$(document).ready(function(){
		});		
		</script>
	</head>
 
<body style="background-color: #dddddd; font-size: 16px;">
<?php include('includes/navbar.inc'); ?>
	<!-- <div id="alert" style="display: <?php // if ($enquete_ready) echo 'block'; else echo 'none';?>;">
		<div class="container my-5"" id="cont01">
			<h1 class="text-black mb-5 bluefont text-center errormessage">Dank voor het invullen en opsturen!</h1>
			<div class="text-center"><a href="home.php" class="btn btn-primary" role="button">Klaar</a></div>
		</div>
	</div> -->
	<div class="container my-5"" id="cont01">
		<h1 class="bluefont display-3 text-center">Pubquiz</h1>
		<h1 class="bluefont display-1 text-center">20 vragen, 20 minuten</h1>
		<p>Hier vind je 20 vragen, in allerlei soorten en maten. Sommige weet je meteen, over andere moet je misschien even nadenken. En weer andere weet je echt niet en moet je wellicht opzoeken.</p>			
		<p>Jij en je team hebben precies 20 minuten voor alle 20 vragen. Klik op de juiste keuze en klaar maar <span>vergeet niet onderaan de pagina op 'versturen' te klikken!</span> 
		Dat kun je doen zo vaak als je wilt totdat de tijd om is. Ieder maatje in je team kan op de verstuur-knop drukken. 
			Maar verlaat je de pagina zonder te bewaren dan is zijn de antwoorden volgens de stand dat je de knop voor het laatst gebruikte. Houd daar rekening mee!</p>
		<p>Alleen goede antwoorden worden geteld in de score. Het team met de meeste punten is (uiteraard) de winnaar. En voor de volledigheid: over de antwoorden en de uitslagen kan niet worden gecorrespondeerd.</p>
		<p>Let op: je bent met meerdere maatjes in een team. Dus bedenk een tactiek om de tijd zo goed mogelijk te gebruiken.</p>
		<h2 class="text-center text-primary">Je bent lid van team "<?= $teamrec['teamnaam'] ?>"</h2>
	</div>
	<!-- <div class="container">
		<h5 class="p-3 text-white bg-danger text-center" style="display: <?php // if ($error != 0x0000) echo 'block'; else echo 'none';?>">Het formulier bevat fouten. Kijk bij de vragen voor meer informatie.</h5>
	</div> -->
	<form method="POST" action="pubquiz.php" id="post" novalidate>
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 1</h1>
		<h5>Bestaat Nederland voor meer of minder dan een kwart uit water?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr01" value="A"  <?php if (isset($teamrec['vr01']) && $teamrec['vr01'] == 'A') echo 'checked';  ?>>A. Meer</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr01" value="B" <?php if (isset($teamrec['vr01']) && $teamrec['vr01'] == 'B') echo 'checked'; ?>>B. Minder</div>
		
		</div>
	</div>

	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 2</h1>
		<h5>Wat was het eerste voedsel dat met een magnetron is bereid?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr02" value="A"  <?php if (isset($teamrec['vr02']) && $teamrec['vr02'] == 'A') echo 'checked';  ?>>A. Een flesje babymelk</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr02" value="B" <?php if (isset($teamrec['vr02']) && $teamrec['vr02'] == 'B') echo 'checked'; ?>>B. Restje eten van de vorige dag</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr02" value="C"  <?php if (isset($teamrec['vr02']) && $teamrec['vr02'] == 'C') echo 'checked';  ?>>C. Popcorn</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr02" value="D" <?php if (isset($teamrec['vr02']) && $teamrec['vr02'] == 'D') echo 'checked'; ?>>D. Macaroni and cheese</div>
		
		</div>
	</div>
		
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 3</h1>
		<h5>Welk land heeft de grootste oppervlakte?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr03" value="A"<?php if (isset($teamrec['vr03']) && $teamrec['vr03'] == 'A') echo 'checked';  ?>>A. Afghanistan</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr03" value="B"<?php if (isset($teamrec['vr03']) && $teamrec['vr03'] == 'B') echo 'checked'; ?>>B. Kazachstan</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr03" value="C"<?php if (isset($teamrec['vr03']) && $teamrec['vr03'] == 'C') echo 'checked';  ?>>C. Iran</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr03" value="D"<?php if (isset($teamrec['vr03']) && $teamrec['vr03'] == 'D') echo 'checked'; ?>>D. Turkmenistan</div>
		
		</div>
	</div>
	
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 4</h1>
		<h5>Wat geeft de schaal van Scaville aan?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr04" value="A" <?php if (isset($teamrec['vr04']) && $teamrec['vr04'] == 'A') echo 'checked';  ?>>A. De heetheid van chilipepers</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr04" value="B" <?php if (isset($teamrec['vr04']) && $teamrec['vr04'] == 'B') echo 'checked'; ?>>B. De sterkte van de zonnestraling </div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr04" value="C" <?php if (isset($teamrec['vr04']) && $teamrec['vr04'] == 'C') echo 'checked';  ?>>C. De verhouding tussen de hoeveelheid insecten en het aantal bewoners van een stad of dorp</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr04" value="D" <?php if (isset($teamrec['vr04']) && $teamrec['vr04'] == 'D') echo 'checked'; ?>>D. Wie er kampioen is geworden op het onderdeel Sca van skaten</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 5</h1>
		<h5>Op hoeveel heuvels werd Rome gebouwd?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr05" value="A" <?php if (isset($teamrec['vr05']) && $teamrec['vr05'] == 'A') echo 'checked';  ?>>A. 3</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr05" value="B" <?php if (isset($teamrec['vr05']) && $teamrec['vr05'] == 'B') echo 'checked'; ?>>B. 7</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr05" value="C" <?php if (isset($teamrec['vr05']) && $teamrec['vr05'] == 'C') echo 'checked';  ?>>C. 11</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr05" value="D" <?php if (isset($teamrec['vr05']) && $teamrec['vr05'] == 'D') echo 'checked'; ?>>D. 13</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 6</h1>
		<h5>Wat is het geboortejaar van Johan Cruijff?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr06" value="A" <?php if (isset($teamrec['vr06']) && $teamrec['vr06'] == 'A') echo 'checked';  ?>>A. 1947</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr06" value="B" <?php if (isset($teamrec['vr06']) && $teamrec['vr06'] == 'B') echo 'checked'; ?>>B. 1948</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr06" value="C" <?php if (isset($teamrec['vr06']) && $teamrec['vr06'] == 'C') echo 'checked';  ?>>C. 1949</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr06" value="D" <?php if (isset($teamrec['vr06']) && $teamrec['vr06'] == 'D') echo 'checked'; ?>>D. 0</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 7</h1>
		<h5>Hoeveel bierbrouwerijen staan er in Duitsland?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr07" value="A" <?php if (isset($teamrec['vr07']) && $teamrec['vr07'] == 'A') echo 'checked';  ?>>A. 800</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr07" value="B" <?php if (isset($teamrec['vr07']) && $teamrec['vr07'] == 'B') echo 'checked'; ?>>B. 1400</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr07" value="C" <?php if (isset($teamrec['vr07']) && $teamrec['vr07'] == 'C') echo 'checked';  ?>>C. 2300</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr07" value="D" <?php if (isset($teamrec['vr07']) && $teamrec['vr07'] == 'D') echo 'checked'; ?>>D. 8700</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 8</h1>
		<h5>Werd Walt Disney meer of minder dan 40 keer genomineerd voor een Oscar?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr08" value="A"  <?php if (isset($teamrec['vr08']) && $teamrec['vr08'] == 'A') echo 'checked';  ?>>A. Meer</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr08" value="B" <?php if (isset($teamrec['vr08']) && $teamrec['vr08'] == 'B') echo 'checked'; ?>>B. Minder</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 9</h1>
		<h5>In welk jaar werd Facebook opgericht?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr09" value="A" <?php if (isset($teamrec['vr09']) && $teamrec['vr09'] == 'A') echo 'checked';  ?>>A. 1997</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr09" value="B" <?php if (isset($teamrec['vr09']) && $teamrec['vr09'] == 'B') echo 'checked'; ?>>B. 2001</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr09" value="C" <?php if (isset($teamrec['vr09']) && $teamrec['vr09'] == 'C') echo 'checked';  ?>>C. 2004</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr09" value="D" <?php if (isset($teamrec['vr09']) && $teamrec['vr09'] == 'D') echo 'checked'; ?>>D. 2008</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 10</h1>
		<h5>Op welk eiland werd Napoleon Bonaparte geboren?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr10" value="A" <?php if (isset($teamrec['vr10']) && $teamrec['vr10'] == 'A') echo 'checked';  ?>>A. St. Helena</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr10" value="B" <?php if (isset($teamrec['vr10']) && $teamrec['vr10'] == 'B') echo 'checked'; ?>>B. Sardinië</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr10" value="C" <?php if (isset($teamrec['vr10']) && $teamrec['vr10'] == 'C') echo 'checked';  ?>>C. Corsica</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr10" value="D" <?php if (isset($teamrec['vr10']) && $teamrec['vr10'] == 'D') echo 'checked'; ?>>D. Elba</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 11</h1>
		<h5>Wat schiep God op de vierde dag?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr11" value="A" <?php if (isset($teamrec['vr11']) && $teamrec['vr11'] == 'A') echo 'checked';  ?>>A. Hemel en aarde</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr11" value="B" <?php if (isset($teamrec['vr11']) && $teamrec['vr11'] == 'B') echo 'checked'; ?>>B. Zon en maan</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr11" value="C" <?php if (isset($teamrec['vr11']) && $teamrec['vr11'] == 'C') echo 'checked';  ?>>C. Licht en lucht</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr11" value="D" <?php if (isset($teamrec['vr11']) && $teamrec['vr11'] == 'D') echo 'checked'; ?>>D. Planten en dieren</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 12</h1>
		<h5>Hoe koud is gemiddeld de Noordzee tijdens de Unox nieuwjaarsduik?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr12" value="A" <?php if (isset($teamrec['vr12']) && $teamrec['vr12'] == 'A') echo 'checked';  ?>>A. 1 graad Celsius</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr12" value="B" <?php if (isset($teamrec['vr12']) && $teamrec['vr12'] == 'B') echo 'checked'; ?>>B. 3 graad Celsius </div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr12" value="C" <?php if (isset($teamrec['vr12']) && $teamrec['vr12'] == 'C') echo 'checked';  ?>>C. 6 graad Celsius</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr12" value="D" <?php if (isset($teamrec['vr12']) && $teamrec['vr12'] == 'D') echo 'checked'; ?>>D. 8 graad Celsius</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 13</h1>
		<h5>Wat is geen personage in de Harry Potter boekenreeks?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr13" value="A" <?php if (isset($teamrec['vr13']) && $teamrec['vr13'] == 'A') echo 'checked';  ?>>A. Vincent Vulcanus</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr13" value="B" <?php if (isset($teamrec['vr13']) && $teamrec['vr13'] == 'B') echo 'checked'; ?>>B. Hermelien Griffel</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr13" value="C" <?php if (isset($teamrec['vr13']) && $teamrec['vr13'] == 'C') echo 'checked';  ?>>C. Draco Malfidus</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr13" value="D" <?php if (isset($teamrec['vr13']) && $teamrec['vr13'] == 'D') echo 'checked'; ?>>D. Cho Chang</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 14</h1>
		<h5>Wie of wat zijn Calibri, Arial en Verdana?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr14" value="A" <?php if (isset($teamrec['vr14']) && $teamrec['vr14'] == 'A') echo 'checked';  ?>>A. Zuid-Amerikaanse vlindersoorten</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr14" value="B" <?php if (isset($teamrec['vr14']) && $teamrec['vr14'] == 'B') echo 'checked'; ?>>B. Pantone kleuren </div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr14" value="C" <?php if (isset($teamrec['vr14']) && $teamrec['vr14'] == 'C') echo 'checked';  ?>>C. Lettertypen</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr14" value="D" <?php if (isset($teamrec['vr14']) && $teamrec['vr14'] == 'D') echo 'checked'; ?>>D. Namen van Griekse halfgodinnen</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 15</h1>
		<h5>In welk jaar stierf Vincent van Gogh?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr15" value="A" <?php if (isset($teamrec['vr15']) && $teamrec['vr15'] == 'A') echo 'checked';  ?>>A. 1856</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr15" value="B" <?php if (isset($teamrec['vr15']) && $teamrec['vr15'] == 'B') echo 'checked'; ?>>B. 1890</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr15" value="C" <?php if (isset($teamrec['vr15']) && $teamrec['vr15'] == 'C') echo 'checked';  ?>>C. 1919</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr15" value="D" <?php if (isset($teamrec['vr15']) && $teamrec['vr15'] == 'D') echo 'checked'; ?>>D. 1931</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 16</h1>
		<h5>Kijken er meer of minder dan 3 miljoen mensen in Nederland naar Heel Holland Bakt?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr16" value="A"  <?php if (isset($teamrec['vr16']) && $teamrec['vr16'] == 'A') echo 'checked';  ?>>A. Meer</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr16" value="B" <?php if (isset($teamrec['vr16']) && $teamrec['vr16'] == 'B') echo 'checked'; ?>>B. Minder</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 17</h1>
		<h5>Zitten er meer of minder dan 1000 kCal in een gefrituurde Marsreep?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr17" value="A"  <?php if (isset($teamrec['vr17']) && $teamrec['vr17'] == 'A') echo 'checked';  ?>>A. Meer</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr17" value="B" <?php if (isset($teamrec['vr17']) && $teamrec['vr17'] == 'B') echo 'checked'; ?>>B. Minder</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 18</h1>
		<h5>In welke film speelde Tom Cruise niet?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr18" value="A" <?php if (isset($teamrec['vr18']) && $teamrec['vr18'] == 'A') echo 'checked';  ?>>A. Minority Report</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr18" value="B" <?php if (isset($teamrec['vr18']) && $teamrec['vr18'] == 'B') echo 'checked'; ?>>B. Legends of the Fall</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr18" value="C" <?php if (isset($teamrec['vr18']) && $teamrec['vr18'] == 'C') echo 'checked';  ?>>C. Eyes Wide Shut</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr18" value="D" <?php if (isset($teamrec['vr18']) && $teamrec['vr18'] == 'D') echo 'checked'; ?>>D. Jerry Maguire</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 19</h1>
		<h5>Hoeveel punten is de groene bal in snooker waard?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr19" value="A" <?php if (isset($teamrec['vr19']) && $teamrec['vr19'] == 'A') echo 'checked';  ?>>A. 0</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr19" value="B" <?php if (isset($teamrec['vr19']) && $teamrec['vr19'] == 'B') echo 'checked'; ?>>B. 1</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr19" value="C" <?php if (isset($teamrec['vr19']) && $teamrec['vr19'] == 'C') echo 'checked';  ?>>C. 2</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr19" value="D" <?php if (isset($teamrec['vr19']) && $teamrec['vr19'] == 'D') echo 'checked'; ?>>D. 3</div>
		
		</div>
	</div>
	
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 20</h1>
		<h5>Hoeveel locaties van JobHulpMaatje zijn er op 1 april 2021 in Nederland.?</h5>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr20" value="A" <?php if (isset($teamrec['vr20']) && $teamrec['vr20'] == 'A') echo 'checked';  ?>>A. 6</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr20" value="B" <?php if (isset($teamrec['vr20']) && $teamrec['vr20'] == 'B') echo 'checked'; ?>>B. 18</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr20" value="C" <?php if (isset($teamrec['vr20']) && $teamrec['vr20'] == 'C') echo 'checked';  ?>>C. 29</div>
		<div class="form-check"><input type="radio" class="form-check-input" name="vr20" value="D" <?php if (isset($teamrec['vr20']) && $teamrec['vr20'] == 'D') echo 'checked'; ?>>D. 86</div>
		
		</div>
	</div>
	

	<div class="container my-3 px-sm-5 py-2">	
		<button id="verstuurBut" name="verstuurBut" value="verstuur" type="submit" class="btn btn-primary">Verstuur je antwoorden</button>
	</div>
	</form>
	<?php include('includes/footer.inc'); ?>
</body>
</html>
