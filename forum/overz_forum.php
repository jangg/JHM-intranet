<?php
include_once('../config.php');
include_once('../class/c_cat_coll.php');
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

$arr1 = '';
$arr2 = array (	array (0 => 'categories.id', 1 => 'ASC'));

$categorieColl = new Categorie_coll ($arr1, $arr2);

$html = '';

foreach($categorieColl->categorieColl as $categorie) 
{
	$aantalTopics = $categorie->getAantalTopics ();
	$aantalPosts = $categorie->getAantalPosts ();
	$laatste_post = $categorie->getLastPost ();
	$user_laatste_post = new User ('id', $laatste_post->id_user);
	$datum_lp2 = Tools::ConvertTS($laatste_post->datum);
	
	$html .= '	
	<tr class="d-flex mx-0">
	<td class="col-7 mx-0">
	<span class="lead"><a href="overz_cat.php?id=' . $categorie->id . '">' . $categorie->naam . '</a></span><br/>' . $categorie->omschrijving . 
	'</td>
	<td class="col-1 text-center mx-0">' . $aantalTopics . '</td>
	<td class="col-1 text-center mx-0">' . $aantalPosts . '</td>
	<td class="col-2 text-center mx-0">' . $datum_lp2 . '</td>
    <td class="col-1 text-center mx-0">' . $user_laatste_post->voornaam . ' ' . $user_laatste_post->tussenvoegsels . ' ' . $user_laatste_post->achternaam . '</td>
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
		
		</script>			
	</head>
	<body class="bodystyle">
		
		<?php include('../includes/navbar.inc'); ?>
		<div class="container" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto text-capitalize">forum</h1>
			</div>
		</div>
 	   <div class="container">
	   <div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8 bg-light rounded p-2 m-3">
				<h3>Hoe gebruik je het forum?</h3>
				<p>Dit forum, of bulletin board, werkt zoals elk ander online forum. De mogelijkheden zijn echter wel beperkt. Alleen het plaatsen van tekst is toegestaan, dus 
					geen plaatjes of documenten.</p>
				<p>Als een vraag hebt, of je wilt andere mensen die toegang hebben tot het Intranet iets zeggen, zoek dan de juiste categorie op het forum op. Kijk vervolgens of het onderwerp (of topic) waarop je wilt 
					reageren, al bestaat. Dan kun je tekst daar toevoegen. Maak anders een nieuw onderwerp aan, geef een omschrijving en tegelijk het eerste bericht. Dan 'Verstuur' en je bent klaar.</p>
			</div>
			<div class="col-md-2"></div>
		</div>
		</div>
       <div class="container">
            <div class="row">
	            <div class="col-md-12 mt-0 px-0"><h2 class="bluefont">Categoriën</h2>
	            </div>
            </div>
        </div>
        <div class="container">
			<div class="row" style="margin-bottom: 80px;">
				<table class="table bg-light" style="font-size: 13px;">
				<thead class="bg-primary text-white">
				  <tr class="d-flex">
				    <th scope="col" class="col-7">Categorie</th>
				    <th scope="col" class="col-1 text-center">aantal onderwerpen</th>
					<th scope="col" class="col-1 text-center">aantal berichten</th>
					<th scope="col" class="col-2 text-center">laatste bericht</th>
					<th scope="col" class="col-1 text-center">door</th>
				  </tr>
				</thead>
				<tbody>
					<?php echo $html; ?>
				</tbody>
				</table>

			</div>
		</div>
		<!-- Footer -->
			<?php include('../includes/footer.inc'); ?>
	</body>
</html>
