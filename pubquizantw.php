<?php
include_once('config.php');
include_once('class/c_user.php');

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
// if (!isset($_SESSION['username'])) {
// 	header('location:index.php');
// 	exit();
// }
// 
// 
// if (isset($_SESSION['userid']))
// {
// 	$curr_user = new User ('id', $_SESSION['userid']);
// } else
// {
// 	$curr_user = new User ();
// }
/**********************/

$datetime = new DateTime();
$timestamp = $datetime->format('Y\-m\-d\ H:i:s');

// error_log($timestamp . ' -- ' . $_SESSION['username']);

// if ($timestamp < '2021-04-19 19:00:00' && $_SESSION['username'] != 'jangg')
// {
// 	header('location:home.php');
// 	exit();	
// }
// $id_team = $curr_user->id_team;

// try {
// 	openDB();
// 	$sql = "SELECT * FROM pubquizteams WHERE id = :id;";
// 	$stmt = $connection->prepare( $sql );
// 	$stmt->bindValue( ":id", $id_team, PDO::PARAM_STR);
// 	$stmt->execute();
// 	$teamrec = $stmt->fetch(PDO::FETCH_ASSOC);
// 	
// 	
// } catch (PDOException $e) 
// {
// 	error_log('Connectie (pubquizvragen 1) met de database mislukt: ' . $e->getMessage());
// 	return FALSE;
// }

if (isset($_POST['start']) && $_POST['start'] == 'start')
{
	$_SESSION['vrnr'] = 0;
	$score = [];
}

if (isset($_POST['verstuurBut']) && $_POST['volgende'] == 'volgende')
{
	
}

$_SESSION['vrnr']++;

// for ($i = 1; $i < 6; $i++)
// {
// 	try {
// 		openDB();
// 		$sql = "SELECT * FROM pubquizteams WHERE id = :id;";
// 		$stmt = $connection->prepare( $sql );
// 		$stmt->bindValue( ":id", $i, PDO::PARAM_STR);
// 		$stmt->execute();
// 		$teamrec = $stmt->fetch(PDO::FETCH_ASSOC);
// 		
// 		
// 	} catch (PDOException $e) 
// 	{
// 		error_log('Connectie (pubquizantw 1) met de database mislukt: ' . $e->getMessage());
// 		return FALSE;
// 	}
// 	if ($i == 0) {}
// }

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
		<h1 class="bluefont display-3 text-center">20 vragen, 20 antwoorden</h1>
		
		<!-- <table class="table h4">
			<thead>
				<tr>
					<th>Team</th>
					<th># punten</th>
					<th>score</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>De Gorilla's</td>
					<td><?= $score[0] ?></td>
					<td><?php for ($j=0;$j<$score1;$j++) {echo '&';}?></td>
				</tr>
				<tr>
					<td>De Chimpansees</td>
					<td><?= $score[1] ?></td>
					<td><?php for ($j=0;$j<$score1;$j++) {echo '&';}?></td>
				</tr>

				<tr>
					<td>De Bavianen</td>
					<td><?= $score[2] ?></td>
					<td><?php for ($j=0;$j<$score1;$j++) {echo '&';}?></td>
				</tr>
				<tr>
					<td>De Bonobo's</td>
					<td><?= $score[3] ?></td>
					<td><?php for ($j=0;$j<$score1;$j++) {echo '&';}?></td>
				</tr>
				<tr>
					<td>De  Oerang-Oetans</td>
					<td><?= $score[4] ?></td>
					<td><?php for ($j=0;$j<$score1;$j++) {echo '&';}?></td>
				</tr>
			</tbody>
		</table> -->		
					


	</div>
	<!-- <div class="container">
		<h4 class="p-3 text-white bg-danger text-center" style="display: <?php // if ($error != 0x0000) echo 'block'; else echo 'none';?>">Het formulier bevat fouten. Kijk bij de vragen voor meer informatie.</h4>
	</div> -->
	<form method="POST" action="pubquizantw.php" id="post" novalidate>
	<?php switch ($_SESSION['vrnr']) {
		case 1: 
		echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
				<h1>Vraag 1</h1>
				<h4>Bestaat Nederland voor meer of minder dan een kwart uit water?</h4>
				<h4>Het juiste antwoord = B. Minder (18%)</h4>
			 </div>';
			 // tellPunten($_SESSION['vrnr']);
			 break;
		case 2:
		echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 2</h1>
		<h4>Wat was het eerste voedsel dat met een magnetron is bereid?</h4>
		<h4>Het juiste antwoord = C. Popcorn</h4>
		</div>
	</div>';
		break;
		
		case 3:
		echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 3</h1>
		<h4>Welk land heeft de grootste oppervlakte?</h4>
		<h4>Het juiste antwoord = B. Kazachstan</h4>
		
		</div>
	</div>';
		break;
		
		case 4:
		echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 4</h1>
		<h4>Wat geeft de schaal van Scaville aan?</h4>
		<h4>Het juiste antwoord = A. De heetheid van chilipepers</h4>
		
		</div>
	</div>';
		break;
	
	case 5:
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 5</h1>
		<h4>Op hoeveel heuvels werd Rome gebouwd?</h4>
		<h4>Het juiste antwoord = B. 7 heuvels</h4>
		
		</div>
	</div>';
	break;
	
	case 6:
	
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 6</h1>
		<h4>Wat is het geboortejaar van Johan Cruijff?</h4>
		<h4>Het juiste antwoord = A. 1947</h4>
		
		</div>
	</div>';
	break;
	
	case 7:
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 7</h1>
		<h4>Hoeveel bierbrouwerijen staan er in Duitsland?</h4>
		<h4>Het juiste antwoord = B. 1400</h4>
		
		</div>
	</div>';
	break;
	
	case 8:
	
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 8</h1>
		<h4>Werd Walt Disney meer of minder dan 40 keer genomineerd voor een Oscar?</h4>
		<h4>Het juiste antwoord = A. meer (59)</h4>
		
		</div>
	</div>';
		break;
		
	case 9:
	
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 9</h1>
		<h4>In welk jaar werd Facebook opgericht?</h4>
		<h4>Het juiste antwoord = A. 2004</h4>
		
		</div>
	</div>';
	break;
	
	case 10:
	
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 10</h1>
		<h4>Op welk eiland werd Napoleon Bonaparte geboren?</h4>
		<h4>Het juiste antwoord = C. Corsica</h4>
		
		</div>
	</div>';
	break;
	
	case 11:
	
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 11</h1>
		<h4>Wat schiep God op de vierde dag?</h4>
		<h4>Het juiste antwoord = B. Zon en maan</h4>
		
		</div>
	</div>';
	break;
	
	case 12:
	
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 12</h1>
		<h4>Hoe koud is gemiddeld de Noordzee tijdens de Unox nieuwjaarsduik?</h4>
		<h4>Het juiste antwoord = B. 6 graden Celsius</h4>
		
		</div>
	</div>';
		break;
		
	case 13:
	
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 13</h1>
		<h4>Wat is geen personage in de Harry Potter boekenreeks?</h4>
		<h4>Het juiste antwoord = A. Vincent Vulcanus</h4>
		
		</div>
	</div>';
		break;
	
	case 14:
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 14</h1>
		<h4>Wie of wat zijn Calibri, Arial en Verdana?</h4>
		<h4>Het juiste antwoord = A. Lettertypen</h4>
		
		</div>
	</div>';
		break;
	
	case 15:
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 15</h1>
		<h4>In welk jaar stierf Vincent van Gogh?</h4>
		<h4>Het juiste antwoord = B. In 1890</h4>
		
		</div>
	</div>';
		break;
		
	case 16:
	
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 16</h1>
		<h4>Kijken er meer of minder dan 3 miljoen mensen in Nederland naar Heel Holland Bakt?</h4>
		<h4>Het juiste antwoord = A. Meer (4,35 miljoen)</h4>
		
		</div>
	</div>';
		break;
		
		case 17:
	
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 17</h1>
		<h4>Zitten er meer of minder dan 1000 kCal in een gefrituurde Marsreep?</h4>
		<h4>Het juiste antwoord = B. Minder (900 kCal)</h4>
		
		</div>
	</div>';
		break;
		
		case 18:
		
	
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 18</h1>
		<h4>In welke film speelde Tom Cruise niet?</h4>
		<h4>Het juiste antwoord = B. Legends of the Fall</h4>
		
		</div>
	</div>';
		break;
		
		case 19:
	
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 19</h1>
		<h4>Hoeveel punten is de groene bal in snooker waard?</h4>
		<h4>Het juiste antwoord = D. 3 punten</h4>
		
		</div>
	</div>';
		break;
	
	case 20:
	echo '<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 20</h1>
		<h4>Hoeveel locaties van JobHulpMaatje zijn er op 1 april 2021 in Nederland.?</h4>
		<h4>Het juiste antwoord = B. 18 plaatsen (volgens de website)</h4>
		
		</div>
	</div>';
		break;
		default:			
	}
	?>
	<div class="container my-3 px-sm-5 py-2">
		<button id="verstuurBut" name="start" value="start" type="submit" class="btn btn-primary">Start</button>
		<button id="verstuurBut" name="volgende" value="volgende" type="submit" class="btn btn-primary">Volgende vraag</button>
	</div>
	</form>>
	<?php include('includes/footer.inc'); ?>
</body>
</html>
