<?php
include_once "config.php";
include_once "class/c_user.php";
include_once "class/c_newsitem_coll.php";
include_once "class/c_postit.php";

function getPostits ()
{
	$postits = array();
	$postits[0] = '';
	$postits[1] = '';
	$postit = new Postit ('id', 1);
	if ($postit->publInd == 'j')
	{
		$postits[0] = '
		<ul>
			<li>
				<a href="' . $postit->link . '" style="color: dark; background-color: #da8ff8;">
					<div style="position: absolute; top: 10px;">
						<p style="font-size: 1.0em;">' . Tools::ConvertTS($postit->publDatum) . '</p>
						<p style="font-size: 1.2em; color: rgb(42, 52, 112); text-align: center;">' . $postit->titel . '</p>
						<p style="font-size: 1.0em;">' . $postit->tekst . '</p>
						<p style="font-size: 1.0em; text-align: center;">' . $postit->linkTekst . '</p>
					</div>
				</a>
			</li>
		</ul>
		';
	}
	$postit = new Postit ('id', 2);
	if ($postit->publInd == 'j')
	{
		$postits[1] = '
		<ul>
			<li>
				<a href="' . $postit->link . '">
						<p style="font-size: 1.0em;">' . Tools::ConvertTS($postit->publDatum) . '</p>
						<p style="font-size: 1.2em; color: rgb(42, 52, 112); text-align: center;">' . $postit->titel . '</p>
						<p style="font-size: 1.0em;">' . $postit->tekst . '</p>
						<p style="font-size: 1.0em; text-align: center;">' . $postit->linkTekst . '</p>
				</a>
			</li>
		</ul>
		';
	}

	return $postits;
}

/******************************************************/
/****   functie die HTML voor de berichten maakt
/******************************************************/

function getMsgs ($number, $naam)
{
	/****
	** haal de 10 meest recente artikelen op die intern moeten worden gepubliceerd
	*****/
	
	$arr1 = array (array (0 => 'pubind_intern', 1 => 'j'));
	$arr2 = array (array (0 => 'datetime_pub_intern', 1 => 'ASC'));
	
	$newsitemColl = new Newsitem_coll($arr1, $arr2, 10);
	
	$newsitemHTML = array();
	$n = 0;
	foreach ($newsitemColl->newsitemColl as $newsitem) 
	{
		$datum = new DateTimeImmutable($newsitem->datetime_pub_intern);
		$width = 100;
		$place = 'left';
		
		$marginpl = 'left';		
		if ($width != 100)
		{
			$margin = 15;
			if ($place == 'left')
				$marginpl = 'right';
		} else
			$margin = 0;
		$newsitemHTML[$n] = '
					<h3 class="bluefont">' . $newsitem->titel . '</h3>
					<h5 class="bluefont">' . strftime('%e %B %Y', $datum->getTimestamp()) . '</h5>'
					;
		
		if ($newsitem->picfile1 <> '') {			
			$newsitemHTML[$n] .= '				
						<figure class="figure float-' . $place . '" style="width: ' . $width . '%; margin-' . $marginpl . ': ' . $margin . 'px;">
						<img src="https://' . LOC_DOMAIN . '/img/' . $newsitem->picfile1 . '" class="figure-img img-fluid" alt="' . LOC_NAME .  '">
						</figure>';
		}
		
		$newsitemHTML[$n] .=
					$newsitem->tekst_kort;
					
		if ($newsitem->tekst_knop <> '' && $newsitem->link_knop <> '')
		{
			$newsitemHTML[$n] .= '
			<p><a class="btn btn-primary" href="' . $newsitem->link_knop . '" role="button">' . $newsitem->tekst_knop . ' &raquo;</a></p>';
		}
		
		$n++;
	}
	return $newsitemHTML;
}

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION["username"])) {
  header("location:index.php");
  exit();
}
if (isset($_SESSION["userid"])) {
  $curr_user = new User("id", $_SESSION["userid"]);
} else {
  $curr_user = new User();
}
/**********************/

/* haal de filenames van de fotootjes op */

$list = scandir("fotoos_person", SCANDIR_SORT_NONE);
$i = 0;
foreach ($list as $naam)
{ 
	if (substr($naam, 0, 1) == '.' || $naam == 'thumbs')
	{
		unset($list[$i]);
	}
	$i++;
}

shuffle($list);

//print_r($list);
$newsMsgs = getMsgs(10, $curr_user->voornaam);
$postits = getPostits ();

// $recentpost = Post::getMostRecentPost();
// $poster = new User("id", $recentpost["id_user"]);
// $posternaam =
// $poster->voornaam . " " . $poster->tussenvoegsels . " " . $poster->achternaam;
// $postdatum = Tools::ConvertTS($recentpost["post_date"]);
?>
<!DOCTYPE HTML>
<html lang="nl-NL">

<head>
	<?php include "includes/head.inc"; ?>
	<!-- Custom styles for this page -->
	<link href="css/jumbotron.css" rel="stylesheet" type="text/css">
	<link href="css/sticky_notes.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css2?family=Gloria+Hallelujah&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Parisienne' rel='stylesheet' type='text/css'>

</head>
	<!-- <body class="bodystyle" style="background-color: #81a3bf; font-size: 16px;"> -->
	<body class="bodystyle">	
	<main style="position: relative;">
		<div class="scroll-down"></div>
		
		<?php include "includes/navbar.inc"; ?>
 		<style>
// 		.editor-stage .snow {
// 		  height: 50px;
// 		  background: #fff;
// 		}
// 		.snow{
// 		  position:fixed;
// 		  pointer-events:none;
// 		  top:0;
// 		  left:0;
// 		  right:0;
// 		  bottom:0;
// 		  height:100vh;
// 		  background: none;
// 		  background-image: url('https://s3-eu-west-1.amazonaws.com/static-ressources/s1.png'), url('https://s3-eu-west-1.amazonaws.com/static-ressources/s2.png'), url('https://s3-eu-west-1.amazonaws.com/static-ressources/s3.png');
// 		  z-index: 100;
// 		  -webkit-animation: snow 10s linear infinite;
// 		  -moz-animation: snow 10s linear infinite;
// 		  -ms-animation: snow 10s linear infinite;
// 		  animation: snow 10s linear infinite;
// 		}
// 		@keyframes snow {
// 			  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
// 			  100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
// 			}
// /* 					@keyframes snow {
// 		  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
// 		  50% {background-position: 500px 500px, 100px 200px, -100px 150px;}
// 		  100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
// 		} */
// 		@-moz-keyframes snow {
// 		  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
// 		  100% {background-position: 400px 1000px, 200px 400px, 100px 300px;}
// 		}
// 		@-webkit-keyframes snow {
// 		  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
// 		  100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
// 		}
// 		@-ms-keyframes snow {
// 		  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
// 		  100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
// 		}
 		</style>
			
		<div class="container mb-4">
			<div class="row">
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[0]; ?>" alt="<?php echo $list[0]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[1]; ?>" alt="<?php echo $list[1]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[2]; ?>" alt="<?php echo $list[2]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[3]; ?>" alt="<?php echo $list[3]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[4]; ?>" alt="<?php echo $list[4]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[5]; ?>" alt="<?php echo $list[5]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[6]; ?>" alt="<?php echo $list[6]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[7]; ?>" alt="<?php echo $list[7]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[8]; ?>" alt="<?php echo $list[8]; ?>" width="100%"></div>
			</div>
			<div class="row">
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[9]; ?>" alt="<?php echo $list[9]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[10]; ?>" alt="<?php echo $list[10]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[11]; ?>" alt="<?php echo $list[11]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[12]; ?>" alt="<?php echo $list[12]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[13]; ?>" alt="<?php echo $list[13]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[14]; ?>" alt="<?php echo $list[14]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[15]; ?>" alt="<?php echo $list[15]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[16]; ?>" alt="<?php echo $list[16]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[17]; ?>" alt="<?php echo $list[17]; ?>" width="100%"></div>
				<!-- <div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[18]; ?>" alt="<?php echo $list[18]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[19]; ?>" alt="<?php echo $list[19]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[20]; ?>" alt="<?php echo $list[20]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[21]; ?>" alt="<?php echo $list[21]; ?>" width="100%"></div> -->
			</div>
		</div>
		<div class="container my-4" id="sticky">
			<div class="row">
				<div class="col-md-4 d-md-block" id="sticky-right">
					<?php echo $postits[0]; ?>
				</div>
				<div class="col-md-4 d-none d-md-block">
					<img src="logos/<?php echo LOC_LOGO; ?>" class="mx-auto d-block mb-5" style="width: 350px;">
				</div>
				<div class="col-md-4 d-md-block" id="sticky-left">
					<?php echo $postits[1]; ?>
				</div>

<!-- 			<div class="row">
				<h1 class="text-center" style="font-family: Parisienne; font-size: 4em; color:#2a3470; text-shadow: 2px 2px 8px #ffffff;">Een gelukkig en vooral gezond 2022!</h1>
			</div> -->
		</div>
		</div>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<!-- <div class="jumbotron"> -->

		<?php 
	for ($i = count($newsMsgs) - 1; $i > count($newsMsgs) - 10 && $i >= 0; $i = $i - 2) {
	$naam = $curr_user->voornaam;
    echo '
		<div class="articles container">
		<div class="row py-4 border-top border-primary">
			<div class="col-md-6">
			';
	echo $newsMsgs[$i];
	echo '				
		</div>
		<div class="col-md">
			';
	if ($i > 0)
	{
		echo $newsMsgs[$i - 1];		
	}
	echo '
				</div>
			</div>
		</div>				
		';
 	} 
 	?>
		<!-- einde jumbotron -->
		
		<div class="container border-top border-primary">
			<hr>
			<!-- Example row of columns -->
			<div class="row">
				<div class="col-md-4">
					<h2 class="bluefont">Wie is wie?</h2>
					<p>Hier vind je foto's en wat informatie over de mensen die zich belangeloos inzetten voor <?php echo LOC_NAME ?>.</p>
					<p>Sta je er niet bij of wil je iets wijzigen aan je eigen kaartje? Laat het dan weten aan de ICT-coördinator, b.v. per <a href="mailto:jang@jhm-zoetermeer.nl">email.</a>.</p>
					<p><a class="btn btn-secondary" href="faces.php" role="button">Laat maar zien &raquo;</a></p>
				</div>
				<div class="col-md-4">
					<h2 class="bluefont">Forum</h2>
					<p>Het forum is de besloten online plaats waar je de andere vrijwilligers vragen kunt stellen en discussies met anderen kunt voeren. Het intranet is nadrukkelijk niet toegangkelijk voor Werkzoekenden, wel voor Maatjes, zodat enige vrijheid mogelijk is. Maar houd je uiteraard wel aan de fatsoensnormen.</p>
					<p><a class="btn btn-secondary" href="forum/overz_forum.php" role="button">Laat maar zien &raquo;</a></p>
				</div>
				<div class="col-md-4">
					<h2 class="bluefont">Agenda</h2>
					<p>Wanneer zijn er bijeenkomsten, wanneer en waar worden jobgroup-meetingen gehouden, etc.</p>
					<p>Het is altijd handig om te weten wanneer er bepaalde zaken plaatsvinden in de toekomst. Een agenda-overzicht helpt daarbij.
					<p><a class="btn btn-secondary" href="agenda.php" role="button">Laat maar zien &raquo;</a></p>
				</div>
			</div>
		</div> <!-- /container -->
	</main>

	<?php include "includes/footer.inc"; ?>
	<div class="snow" />
</body>

</html>