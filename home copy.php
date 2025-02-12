<?php
include_once "config.php";
include_once "class/c_user.php";
include_once "includes/newsmsgs.inc";
include_once "class/c_cat.php";
include_once "class/c_topic.php";
include_once "class/c_post.php";

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
unset($list[0]);
unset($list[1]);

shuffle($list);

//print_r($list);
$newsMsgs = getMsgs(10, $curr_user->voornaam);

$recentpost = Post::getMostRecentPost();
$poster = new User("id", $recentpost["id_user"]);
$posternaam =
$poster->voornaam . " " . $poster->tussenvoegsels . " " . $poster->achternaam;
$postdatum = Tools::ConvertTS($recentpost["post_date"]);
?>
<!DOCTYPE HTML>
<html>

<head>
	<?php include "includes/head.inc"; ?>
	<!-- Custom styles for this page -->
	<link href="css/jumbotron.css" rel="stylesheet" type="text/css">
	<link href="css/sticky_notes.css" rel="stylesheet" type="text/css">
	<link href="css/mystyle.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css2?family=Gloria+Hallelujah&display=swap" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Parisienne' rel='stylesheet' type='text/css'>

</head>

	<body style="background-color: #dddddd; font-size: 16px;">
<!-- 	<body style="background-color: #81a3bf; font-size: 16px;"> -->
	
	<main style="position: relative;">
		<div class="scroll-down"></div>
		
		<?php include "includes/navbar.inc"; ?>
		<!-- ------
					<style>
					.editor-stage .snow {
					  height: 50px;
					  background: #fff;
					}
					.snow{
					  position:fixed;
					  pointer-events:none;
					  top:0;
					  left:0;
					  right:0;
					  bottom:0;
					  height:100vh;
					  background: none;
					  background-image: url('https://s3-eu-west-1.amazonaws.com/static-ressources/s1.png'), url('https://s3-eu-west-1.amazonaws.com/static-ressources/s2.png'), url('https://s3-eu-west-1.amazonaws.com/static-ressources/s3.png');
					  z-index: 100;
					  -webkit-animation: snow 10s linear infinite;
					  -moz-animation: snow 10s linear infinite;
					  -ms-animation: snow 10s linear infinite;
					  animation: snow 10s linear infinite;
					}
					@keyframes snow {
						  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
						  100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
						}
/* 					@keyframes snow {
					  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
					  50% {background-position: 500px 500px, 100px 200px, -100px 150px;}
					  100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
					} */
					@-moz-keyframes snow {
					  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
					  100% {background-position: 400px 1000px, 200px 400px, 100px 300px;}
					}
					@-webkit-keyframes snow {
					  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
					  100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
					}
					@-ms-keyframes snow {
					  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
					  100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
					}
					</style>
			<!---------->		
			
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
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[9]; ?>" alt="<?php echo $list[9]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[10]; ?>" alt="<?php echo $list[10]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[11]; ?>" alt="<?php echo $list[11]; ?>" width="100%"></div>
			</div>
			<div class="row">
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[12]; ?>" alt="<?php echo $list[12]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[13]; ?>" alt="<?php echo $list[13]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[14]; ?>" alt="<?php echo $list[14]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[15]; ?>" alt="<?php echo $list[15]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[16]; ?>" alt="<?php echo $list[16]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[17]; ?>" alt="<?php echo $list[17]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[18]; ?>" alt="<?php echo $list[18]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[19]; ?>" alt="<?php echo $list[19]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[20]; ?>" alt="<?php echo $list[20]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[21]; ?>" alt="<?php echo $list[21]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[22]; ?>" alt="<?php echo $list[22]; ?>" width="100%"></div>
				<div class="col p-0 m-0"><img src="fotoos_person/<?php echo $list[23]; ?>" alt="<?php echo $list[23]; ?>" width="100%"></div>
			</div>
		</div>
		<div class="container my-4" id="sticky">
			<div class="row">
				<div class="col-md-4 d-md-block" id="sticky-right">
					<!-- <ul>
						<li>
							<a href="pages/bericht20220630_1.php">
								<p style="font-size: 1.0em;">30 juni 2022</p>
								<p style="font-size: 1.2em;">Verslag van de laatste bestuursvergadering</p>
								<!-- <p style="font-size: 1.2em; color: red;">Lezen?</p> --
								<p style="font-size: 1.1em;">Lees meer....</p>
							</a>
						</li>
					</ul> -->

					
				</div>

				<!-- <div class="col-sm-4 d-none d-sm-block" id="sticky-left" style="position: absolute; z-index: 3;">
				<ul>
					<li>
						<h1 class="display-4 mt-5 text-center redfont">AFGELAST</h1>
					</li>
				</ul>
			</div> -->
				<div class="col-md-4 d-none d-md-block">
					<img src="img/Logo_JobHulpMaatje_Zoetermeer.svg" class="mx-auto d-block mb-5" style="width: 350px;">
				</div>
				<div class="col-md-4 d-md-block" id="sticky-left">
					<!-- <ul>
						<li>
							<a href="nieuwsbrief.php" style="color: dark; background-color: #da8ff8;">
								<!-- <div style="position: relative;"><img src='img/agenda-490x297.jpg' width='100%'/></div> --
								<div style="position: absolute; top: 10px;">
									<p style="font-size: 1.0em;">30 juni 2022</p>
									<p style="font-size: 1.4em; color: rgb(42, 52, 112); text-align: center;"><br/>Nieuwe nieuwsbrief, juli 2022</p>
									<!-- <p style="font-size: 1.0em;">Kom op 11 april horen wat we gaan doen om bekender te worden.</p> --
									<p style="font-size: 1.0em; text-align: center;">Klik op mij.</p>
								</div>
							</a>
						</li>
					</ul> -->
			</div>
<!-- 			<div class="row">
				<h1 class="text-center" style="font-family: Parisienne; font-size: 4em; color:#2a3470; text-shadow: 2px 2px 8px #ffffff;">Een gelukkig en vooral gezond 2022!</h1>
			</div> -->
		</div>
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<!-- <div class="jumbotron"> -->

		<?php 
	for ($i = count($newsMsgs) - 1; $i > count($newsMsgs) - 10; $i = $i - 2) {
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
	echo $newsMsgs[$i - 1];
	echo '
				</div>
			</div>
		</div>				
		';
 	} 
 	?>
		<!-- einde jumbotron -->

		<!-- <div class="container mt-2 mb-2">
			<div class="row">
				<div class="col-md-4 jumbotron p-0 m-1" style="border: 2px solid #027afe;">
					<div style="background-color: #027afe; padding: 0px 5px 5px 5px;">
						<span style="font-size: 1.1em; color: white;">Laatste nieuwsbericht op JHM-Zoetermeer.nl</span>
					</div>
					<a href="https://jhm-zoetermeer.nl/nieuws/persbericht-nieuwe-jobgroup-voor-zzpers/" style="color: inherit; text-decoration: inherit;">
						<div class="m-0 p-0">
							<div><img src="https://jhm-zoetermeer.nl/wp-content/uploads/2021/08/JHMZwerk.png" alt="" class="omslagfoto" width="100%" /></div>
							<div class="m-2 p-1" style="font-size: .9em;"><span style="font-size: .9em;">28 augustus 2021</span><br />Training voor ZZP'ers start binnenkort</div>
							<div class="m-2 p-1" style="font-size: .9em;">
								JobHulpMaatje Zoetermeer start 24 september een JobGroup speciaal voor zzp’ers.
								Veel zelfstandigen zonder personeel zijn getroffen door corona en vragen zich af hoe het nu verder moet met hun bedrijf.
								JobHulpMaatje geeft in vijf bijeenkomsten gratis training aan freelancers en kleine ondernemers.
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-4 jumbotron p-0 m-1" style="border: 2px solid #027afe;">
					<div style="background-color: #027afe; padding: 0px 5px 5px 5px;">
						<span style="font-size: 1.1em; padding: 0px; color: white;">Meest recente forumbericht</span>
					</div>
					<a href="forum/overz_topic.php?id=<?php //echo $recentpost["id_topic"]; ?>" style="color: inherit; text-decoration: inherit;">
						<div class="m-0 p-0">
							<div class="m-1 mb-0 p-1 pb-0" style="font-size: .9em;">
								<h5><?php //echo $recentpost["cat_name"]; ?><br /><?php //echo $recentpost["topic_subject"]; ?></h5>
							</div>
							<div class="m-1 p-1 pb-4" style="font-size: .9em;"><?php //echo Tools::getShortPost($recentpost["post_content"], 200); ?>
							</div>
							<div style="position: absolute; bottom: 0px; width: 100%; font-size: .8em; line-height: 100%; color: #2a346f; background-color: rgba(2, 122, 254, 0.2);" class="m-0 p-2">
								<?php //echo $postdatum; ?> <?php //echo $posternaam; ?> <br />
							</div>
						</div>
					</a>
				</div>
				<div class="col-md jumbotron p-0 m-1 text-center" style="border: 2px solid #027afe;">
					<a class="twitter-timeline" data-lang="nl" data-height="400" data-theme="light" href="https://twitter.com/JobHMaatje079?ref_src=twsrc%5Etfw">Tweets by JobHaMaatje</a>
					<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
					<a href="https://twitter.com/JobHMaatje079?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-count="false">Follow @JobHaMaatje</a>
					<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>
			</div>
		</div> -->
		
		<div class="container border-top border-primary">
			<hr>
			<!-- Example row of columns -->
			<div class="row">
				<div class="col-md-4">
					<h2 class="bluefont">Wie is wie?</h2>
					<p>Hier vind je foto's en wat informatie over de mensen die zich belangeloos inzetten voor JobHulpMaatje.</p>
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
<!-- 	<div class="snow" /> -->
</body>

</html>