<?php
include_once ('config.php');
/* include_once ('controle.php'); */
include_once ('fotocollm.php');
/*
if (!isset($_SESSION['username']))
		header("location: index.php");
*/

/*****************************
****
**** 
****
******************************/
$imagenr = rand(1,5);
$header_image = 'images/header_image' . $imagenr . '.jpg';
$fotocol = new fotoCollectionM();
$NbrOfTiles = 36;

$fotocol->getRandomPics($NbrOfTiles / 2);
$picArray;
for ($i = 0; $i < $NbrOfTiles / 2; $i++)
{
	$picArray[] = $fotocol->collArray[$i];
 	$picArray[] = $fotocol->collArray[$i];
}
$arr = json_encode($picArray);
if (isset($_SESSION["userID"]))
	$userID = $_SESSION["userID"];
	else
	$userID = '1';
?>
<!DOCTYPE HTML>

<html>
<head>
<title>Mijn kleinkinderen | Memory</title>
<?php include ('includes/head.inc'); ?>
<script>
var memory_array = <?php echo $arr; ?>;
var memory_values = [];
var memory_tile_ids = [];
var tiles_flipped = 0;
var tiles_used = 0;
var s;
var m;
var h;
var start;
var loop;
var flipback;
var myFound;
var myTurned;
var gameID = 1;
var userID = <?php echo $userID;?>;
</script>
</head>
<body>
<div class="hidden">
<?php
/******
** preload de fotootjes
******/
for ($i = 0; $i < $NbrOfTiles / 2; $i++)
{
	echo '<img src="' . $fotocol->collArray[$i]->fileNameTN . '"/>';
}
?>
</div>
<div id="viewport">
	<div id="header" style="background-image: url('<?php echo $header_image ?>'); height: 200px;">
		<div id="topheader" style="height: 200px;">
			<a href="index.php"><div id="titel">Mijn kleinkinderen</div></a>
			<?php
			if (!isset($_SESSION['username']))
			{
				echo '<a href="login.php"><div id="login">';
				echo 'Inloggen';
				echo '</div></a>';
			}
			else
			{
				echo '<a href="login.php?uitloggen=YES"><div id="login">';
				echo '<div class="loginbalk">';
				echo 'Uitloggen<br/>';
				echo '</div><div class="loginbalk" style="font-size: small;">';
				echo 'ingelogged: ' . $_SESSION['username'];
				echo '</div>';
				echo '</div></a>';
			}
			?>
		</div>	
		<?php include('includes/menu.inc'); ?>
	</div>
	<div id="container">
		<div id="memory_board">			
		</div>
		<div id="sideboard">
			<div id="timerboard" style="font-family: 'Irish Grover' sans-serif; font-size: 200%; text-align: center;">
			Classic MEMORY
			</div>
			<div id="timerboard" style="font-size: xx-large;">
				<div class="timerboard_row">
					<div class="timerboard_cell">
					Tijd
					</div>
					<div class="timerboard_cell" id="clockDisplay" style="float: right; text-align: right;">
					00:00:00
					</div>
				</div>
				<div class="timerboard_row">
					<div class="timerboard_cell">
					Gedraaid
					</div>
					<div class="timerboard_cell" id="cardsTurned" style="float: right; text-align: right;">
					0
					</div>
				</div>
				<div class="timerboard_row">
					<div class="timerboard_cell">
					Gevonden
					</div>
					<div class="timerboard_cell" id="pairFound" style="float: right; text-align: right;">
					0
					</div>
				</div>
			</div>
			<div id="timerboard" style="text-align: center;">
				<div style="width: inherit; font-size: 200%; font-family: 'Irish Grover';">Uw beste scores</div>
				<div id="bestuserscores">
				</div>
			</div>
			<div id="timerboard" style="text-align: center;">
				<div style="width: inherit; font-size: 200%; font-family: 'Irish Grover';">Hall Of Fame</div>
				<div id="bestglobalscores1">
				</div>
			</div>
			<div id="timerboard">
				<a href="memory.php" style="text-decoration: none;">
				<div class="button" style="font-size: xx-large;  font-family: 'Irish Grover';">
				Nieuw spel
				</div>
				</a>
			</div>
		</div>
		<script>newBoard();</script>
	</div>
	<?php include('includes/footer.inc'); ?>
</div>
    <script type="text/javascript">
	renderTime();
	</script>
</body>
</html>
