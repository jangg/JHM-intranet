<?php
include_once('../config.php');
include_once('../class/c_cat.php');
include_once('../class/c_topic.php');
include_once('../class/c_post_coll.php');
include_once('../class/c_user.php');

if (isset($_GET['topicid']))
{
	$_SESSION['topicid'] = $_GET['topicid'];
}

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
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

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
	$_SESSION['id_topic'] = $_GET['id'];
}
else
{
	if (isset($_SESSION['topicid']))
	{
		$_SESSION['id_topic'] = $_SESSION['topicid'];		
	}
}

$topic = new Topic('id', $_SESSION['id_topic']);
if ($topic->id == NULL)
{
	header('location:overz_cat.php');
	exit();		
} 

if (isset($_POST['resetBut']) && $_POST['resetBut'] == 'reset')
{
	header("location: overz_topic.php");
	exit();	
}

if (isset($_POST['verstuurBut']) && $_POST['verstuurBut'] == 'verstuur')
{
	if (isset($_POST['tekst']) && $_POST['tekst'] != '')
	{
		$newPost= new Post();
		$newPost->tekst = $_POST['tekst'];
		// $newTopic->datum = $date->format('Y-m-d H:i:s');	
		$newPost->id_topic = $topic->id;	
		$newPost->id_user = $curr_user->id;	
		$newPost->saveToDB();
		$topic->addOnePost();
		$categorie = new categorie('id', $topic->id_cat);
		$categorie->addOnePost();
		unset($_POST['tekst']);
	}
	unset($_POST['verstuurBut']);
	/* start de page opnieuw om een tweede update te voorkomen */
	header("location: overz_topic.php");
	exit();	
}
// error_log($categorie->naam);
// Nu moeten alle topics behorende bij de opgegeven categorie worden opgehaald
// Dus elke topic waarvan id_cat gelijk is aan de id van de categorie.

// $arr1 = array (	array (0 => 'categories.id', 1 => $_GET['id']));

$arr1 = array (	array (0 => 'id_topic', 1 => $topic->id));
$arr2 = array (	array (0 => 'post_date', 1 => 'ASC'));

$postsColl = new Post_coll($arr1, $arr2);

$html = '';
// error_log ('Gelukt!');

foreach ($postsColl->postColl as $post) {
	$user = new User ('id', $post->id_user);
	$datum_lp2 = Tools::ConvertTS($post->datum);
	$html .= '	
	<tr class="d-flex mx-0">
	<td scope="col" class="col-2 text-center mx-0 overflow-hidden">' . $datum_lp2 . '</td>
	<td scope="col" class="col-1 text-center mx-0 overflow-hidden">' . $user->voornaam . ' ' . $user->tussenvoegsels . ' ' . $user->achternaam . '</td>
	<td scope="col" class="col-9 mx-0">' . $post->tekst . '</td>
	</tr>';
}
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include('../includes/head.inc'); ?>
		<link href="../css/mystyle.css" rel="stylesheet" type="text/css" />		
		<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  	  	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>			
		  <script>
			function jumpto(anchor){
				window.location.href = "#"+anchor;
			}
			$(document).ready(function() {
			  $('#summernote').summernote(
				  {
					  height: 300,				 // set editor height
					  minHeight: null,			 // set minimum height of editor
					  maxHeight: null,			 // set maximum height of editor
					  focus: true,				  // set focus to editable area after initializing summernote
					  disableDragAndDrop: true,
					  shortcuts: true,
					  tabDisable: true,
					  toolbar: [
						  // [groupName, [list of button]]
						  ['style', ['bold', 'italic', 'underline', 'clear']],
						  ['fontsize', ['fontsize']],
						  ['color', ['color']],
						  ['para', ['ul', 'ol', 'paragraph']],
						  ['insert', ['link']]
						]
				  });
				  $('.note-editable').css('font-size','14px');
			$("#button").click(function(){
				$("#nw_bericht").fadeToggle();
				jumpto('nw_bericht');
				});
			  });
		  </script>
	</head>
	<body class="bodystyle">
		
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto text-capitalize">forum</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
        <div class="container">
 		   <div class="container">
				<div class="row mt-4">
					<div class="col-md-11 px-0"><h2 class="bluefont">Onderwerp:&nbsp<?php echo $topic->onderwerp; ?></h2></div>
					<div class="col-md-1">
						<button type="button" class="btn btn-primary" ><a class="text-white" href="overz_cat.php">terug</a></button>
					</div>
				</div>
			</div>
        </div>
        <div class="container">
			<div class="row">
				<table class="table bg-light table-bordered" style="font-size: 13px;">
				<thead class="bg-primary text-white">
				  <tr class="d-flex">
					<th scope="col" class="col-2 text-center m-0 px-0 overflow-hidden">datum<br/>tijd</th>
					<th scope="col" class="col-1 text-center m-0 px-0 overflow-hidden">door</th>
				    <th scope="col" class="col-9 m-0">bericht</th>
				  </tr>
				</thead>
				<tbody>
				<?php echo $html; ?>
				</tbody>
				</table>
					<button id="button" type="button" class="btn btn-primary" style="margin-bottom: 80px;">Nieuw bericht maken</button>
			</div>
		</div>
		<div id="nw_bericht" name="nw_bericht" class="container py-3 rounded" style="margin-bottom: 160px; border-style: solid; border-color: #304280; border-width: 2px; display: none;">
			<div class="text-center text-dark"><h3>Nieuw bericht maken</h3></div> 
			<form method="POST" action="overz_topic.php" id="post" novalidate>
			<div class="form-group">
				<label for="comment" class="text-dark">Bericht:</label>
				<textarea id="summernote" name="tekst" type="text" class="form-control"></textarea>
			</div>
			<div class="forms-group ">
				<button name="verstuurBut" value="verstuur" type="submit" class="btn btn-primary btn-width">Verstuur</button>
				<button name="resetBut" value="reset" type="submit" class="btn btn-secondary btn-width">Reset</button>
			</div>
		</form>
		</div>
		<!-- Footer -->
			<?php include('../includes/footer.inc'); ?>
	</body>
</html>
