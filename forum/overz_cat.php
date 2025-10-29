<?php
include_once('../config.php');
include_once('../class/c_cat_coll.php');
include_once('../class/c_topic_coll.php');
include_once('../class/c_post.php');
include_once('../class/c_user.php');

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
	$_SESSION['id_cat'] = $_GET['id'];
}
else
{
	if (!isset($_SESSION['id_cat']))
	{
		header('location:overz_forum.php');
		exit();		
	} 
}

$categorie = new Categorie('id', $_SESSION['id_cat']);
if ($categorie->id == NULL)
{
	header('location:overz_forum.php');
	exit();		
} 

if (isset($_POST['resetBut']) && $_POST['resetBut'] == 'reset')
{
	header("location: overz_cat.php");
	exit();
}
	
if (isset($_POST['verstuurBut']) && $_POST['verstuurBut'] == 'verstuur')
{
	if (isset($_POST['onderwerp']) && $_POST['onderwerp'] != '' && $_POST['tekst'] != '')
	{
		$newTopic = new Topic();
		$newTopic->onderwerp = $_POST['onderwerp'];
		// $newTopic->datum = $date->format('Y-m-d H:i:s');	
		$newTopic->id_cat = $categorie->id;	
		$newTopic->id_user = $curr_user->id;	
		$newTopic->nbrPosts = 1;	
		$newTopic->saveToDB();
		$categorie->addOneTopic();		
		$newPost= new Post();
		$newPost->tekst = $_POST['tekst'];
		// $newTopic->datum = $date->format('Y-m-d H:i:s');	
		$newPost->id_topic = $newTopic->id;	
		$newPost->id_user = $curr_user->id;	
		$newPost->nbrPosts = 1;	
		$newPost->saveToDB();
		$categorie->addOnePost();
		unset($_POST['onderwerp']);		
	}
	unset($_POST['verstuurBut']);
	/* start de page opnieuw om een tweede update te voorkomen */
	header("location: overz_cat.php");
	exit();
}
// error_log($categorie->naam);
// Nu moeten alle topics behorende bij de opgegeven categorie worden opgehaald
// Dus elke topic waarvan id_cat gelijk is aan de id van de categorie.

// $arr1 = array (	array (0 => 'categories.id', 1 => $_GET['id']));

$arr1 = array (	array (0 => 'id_cat', 1 => $categorie->id));
$arr2 = array (	array (0 => 'id', 1 => 'ASC'));

$topicsColl = new Topic_coll($arr1, $arr2);

$html = '';
// error_log ('Gelukt!');

foreach($topicsColl->topicColl as $topic){

	$aantal = $topic->getAantalPosts ();
	$datum_tp2 = Tools::ConvertTS($topic->datum);

	$laatste_post = $topic->getLastPost();	
	if ($laatste_post->id != NULL)
	{
		$user_lp = new User ('id', $laatste_post->id_user);
		$user_lp_name = $user_lp->voornaam . ' ' . $user_lp->tussenvoegsels . ' ' . $user_lp->achternaam;
		$datum_lp2 = Tools::ConvertTS($laatste_post->datum);
		$laatste_post_tekst = $laatste_post->getShortPost(20);	
	} else
	{
		$user_lp_name = '--';
		$datum_lp2 = '--';
		$laatste_post_tekst = '--';	
	}

	$html .= '	
	<tr class="d-flex mx-0">
		 <td class="col-4 mx-0 d-none d-md-block"><a href="overz_topic.php?id=' . $topic->id . '">' . $topic->onderwerp . '</a></span></td>
		 <td class="col-5 mx-0 d-md-none"><a href="overz_topic.php?id=' . $topic->id . '">' . $topic->onderwerp . '</a></span></td>
		 <td class="col-1 text-center mx-0">' . $aantal . '</td>
		 <td class="col-2 text-center mx-0 overflow-hidden d-none d-md-block">' . $datum_lp2 . '</td>
		 <td class="col-4 mx-0">' . $laatste_post_tekst . '</td>
		 <td class="col-1 text-center mx-0">' .	 $user_lp_name . '</td>
	</tr>';
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
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
			$("#nw_subject").fadeToggle();
			jumpto('nw_subject');
			});
		});
	</script>
		<style>
			.btn-width {
				width:	120px;
			}
		</style>
	</head>
	<body class="bodystyle">
		
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto text-capitalize">forum</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
        <div class="container">
            <div class="row mt-4">
					<div class="col-md-11 px-0"><h2 class="bluefont">Categorie:&nbsp<?php echo $categorie->naam; ?></h2></div>
				<div class="col-md-1">
					<button type="button" class="btn btn-primary" ><a class="text-white" href="overz_forum.php">terug</a></button>
	            </div>
            </div>
        </div>
        <div class="container">
			<div class="row">
				<table class="table bg-light table-bordered" style="font-size: 13px; overflow: hidden;">
				<thead class="bg-primary text-white">
				  <tr class="d-flex">
					<th scope="col" class="col-4 d-none d-md-block">onderwerp</th>
					<th scope="col" class="col-5 d-md-none">onderwerp</th>
					<th scope="col" class="col-1 text-center overflow-hidden">aantal<br/>berichten</th>
					<th scope="col" class="col-2 text-center m-0 px-0  d-none d-md-block">laatste<br/>bericht</th>
					<th scope="col" class="col-4">bericht</th>
					<th scope="col" class="col-1 text-center m-0 px-0">door</th>
				  </tr>
				</thead>
				<tbody>
					<?php echo $html; ?>
				</tbody>
				</table>
				<button id="button" type="button" class="btn btn-primary" style="margin-bottom: 80px;">Nieuw onderwerp maken</button>
			</div>
		</div>
		<div>
		</div>
		<div id="nw_subject" name="nw_subject" class="container py-3 rounded" style="margin-bottom: 160px; border-style: solid; border-color: #304280; border-width: 2px; display: none;">
			<div class="text-center text-dark"><h3>Nieuw onderwerp maken</h3></div> 
			<form method="POST" action="overz_cat.php" id="topic" novalidate>
			<div class="form-group">
				<label for="subject" class="text-dark">Onderwerp:</label>
				<input type="text" class="form-control" id="topic" name="onderwerp">
			</div>
			<div class="form-group">
				<label for="comment" class="text-dark">Bericht:</label>
				<textarea  id="summernote" type="text" class="form-control" rows="7" name="tekst"></textarea>
			</div>
			<div class="form-group ">
				<button name="verstuurBut" value="verstuur" type="submit" class="btn btn-primary btn-width">Verstuur</button>
				<button name="resetBut" value="reset" type="submit" class="btn btn-secondary btn-width">Reset</button>
			</div>
			</form>
		</div>
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
