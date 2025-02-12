<?php
include_once('config.php');
include_once('class/c_user.php');
include_once('includes/newsmsgs.inc');

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
// if (!isset($_SESSION['username'])) {
// 	header('location:index.php');
// 	exit();
// }
// if (isset($_SESSION['userid']))
// {
// 	$curr_user = new User ('id', $_SESSION['userid']);
// } else
// {
// 	$curr_user = new User ();
// }
/**********************/

/* haal de filenames van de fotootjes op */

$list = scandir('fotoos_person', SCANDIR_SORT_NONE);
unset($list[0]);
unset($list[1]);

shuffle($list);

// print_r($list);
$newsMsgs = getMsgs (10, $curr_user->voornaam);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<?php include('includes/head.inc'); ?>			
		<style>
			.bluefont {
				color: #304280;
			}			
			.bluefont h1, h2, h3, h4, h5 {
				font-weight: 300;
			}

			.pinkfont {
				color: #be5a9d;
			}
			.pinkfont h1, h2, h3, h4, h5 {
				font-weight: 300;
			}
			.redfont {
				color: #bd0011;
			}
			.stripedthrough {
				text-decoration: line-through;
			}
			th, td {
				text-align: center;
			}
			th:nth-child(1), td:nth-child(1) {
				text-align: left;
			}
			
		</style>
	<!-- Custom styles for this page -->
		<link href="css/jumbotron.css" rel="stylesheet" type="text/css" >
		<link href="css/sticky_notes.css" rel="stylesheet" type="text/css" >
		<link href="css/mystyle.css" rel="stylesheet" type="text/css" >
		<link href="https://fonts.googleapis.com/css2?family=Gloria+Hallelujah&display=swap" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600' rel='stylesheet' type='text/css'>

	</head>
 
<body style="background-color: #81a3bf; font-size: 16px;">
	
	<?php include('includes/navbar.inc'); ?>
	<main role="main">
<!-- ------>
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
		  50% {background-position: 500px 500px, 100px 200px, -100px 150px;}
		  100% {background-position: 500px 1000px, 200px 400px, -100px 300px;} */
		}
		@-moz-keyframes snow {
		  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
		  50% {background-position: 500px 500px, 100px 200px, -100px 150px;}
		  100% {background-position: 400px 1000px, 200px 400px, 100px 300px;}
		}
		@-webkit-keyframes snow {
		  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
		  50% {background-position: 500px 500px, 100px 200px, -100px 150px;}
		  100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
		}
		@-ms-keyframes snow {
		  0% {background-position: 0px 0px, 0px 0px, 0px 0px;}
		  50% {background-position: 500px 500px, 100px 200px, -100px 150px;}
		  100% {background-position: 500px 1000px, 200px 400px, -100px 300px;}
		}
		</style>
<!---------->		
	<div class="container mb-4">
		<div class="row">
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[0]; ?>" alt="<?php  echo $list[0]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[1]; ?>" alt="<?php  echo $list[1]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[2]; ?>" alt="<?php  echo $list[2]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[3]; ?>" alt="<?php  echo $list[3]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[4]; ?>" alt="<?php  echo $list[4]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[5]; ?>" alt="<?php  echo $list[5]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[6]; ?>" alt="<?php  echo $list[6]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[7]; ?>" alt="<?php  echo $list[7]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[8]; ?>" alt="<?php  echo $list[8]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[9]; ?>" alt="<?php  echo $list[9]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[10]; ?>" alt="<?php  echo $list[10]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[11]; ?>" alt="<?php  echo $list[11]; ?>" width="100%"></div>
		</div>
		<div class="row">
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[12]; ?>" alt="<?php  echo $list[12]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[13]; ?>" alt="<?php  echo $list[13]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[14]; ?>" alt="<?php  echo $list[14]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[15]; ?>" alt="<?php  echo $list[15]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[16]; ?>" alt="<?php  echo $list[16]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[17]; ?>" alt="<?php  echo $list[17]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[18]; ?>" alt="<?php  echo $list[18]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[19]; ?>" alt="<?php  echo $list[19]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[20]; ?>" alt="<?php  echo $list[20]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[21]; ?>" alt="<?php  echo $list[21]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[22]; ?>" alt="<?php  echo $list[22]; ?>" width="100%"></div>
			<div class="col p-0 m-0"><img src="fotoos_person/<?php  echo $list[3]; ?>" alt="<?php  echo $list[3]; ?>" width="100%"></div>
		</div>
	</div>	
		<!-- Main jumbotron for a primary marketing message or call to action -->
		<!-- <div class="jumbotron"> -->
		<div class="container mb-3" id="sticky">
			<div class="row">
				<div class="col-sm-4 d-none d-sm-block" id="sticky-left" style="position: relative;">
					<ul>
						<li>
						  <a href="nieuwsbrief.php">
							<p>December-nieuwsbrieven van JobHulpMaatje.</p>
							<p>Van JHM landelijk en van JHM Zoetermeer.</p>
							<p>Klik hier om ze te lezen.</p>
						  </a>
						</li>
					</ul>
				</div>
				<!-- <div class="col-sm-4 d-none d-sm-block" id="sticky-left" style="position: absolute; z-index: 3;">
					<ul>
						<li>
							<h1 class="display-4 mt-5 text-center redfont">AFGELAST</h1>
						</li>
					</ul>
				</div> -->
				<div class="col-sm-4 d-none d-sm-block">
					<img src="img/Logo_JobHulpMaatje_Zoetermeer.svg" class="mx-auto d-block mb-5" style="width: 350px;">
				</div>
				<div class="col-sm-4" id="sticky-right">
					<ul>
						<li class="text-center">
						  <a href="https://www.giekwerf.nl?nm=<?php echo $curr_user->voornaam; ?>" style="color: white; background-color: #223; background-image: url('img/fireworks-1993221_960_720.png'); background-size: cover;">
							<p style="font-size: 2em;">Toch even knallen voor 2021?</p>
							<p style="font-size: 2em;">Klik hier</p>
						  </a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<?php
		for ($i = count($newsMsgs) - 1; ($i > count($newsMsgs) - 10); $i = $i - 2) {
			$naam = $curr_user->voornaam;
			echo '
			<div class="container">
			<div class="row py-4 border-top border-primary">
				<div class="col-md">
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
		<div class="container">
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
						<p>Het forum is de besloten online plaats waar je de andere vrijwilligers vragen kunt stellen en discussies met anderen kunt voeren. Het intranet is nadrukkelijk  niet toegangkelijk voor Werkzoekenden, wel voor Maatjes, zodat enige vrijheid mogelijk is. Maar houd je uiteraard wel aan de fatsoensnormen.</p>
						<p><a class="btn btn-secondary" href="forum/overz_forum.php" role="button">Laat maar zien &raquo;</a></p>
					</div>
					<div class="col-md-4">
						<h2 class="bluefont">Agenda</h2>
						<p>Wanneer zijn er bijeenkomsten, wanneer en waar worden jobgroup-meetingen gehouden, etc.</p>
						<p>Het is altijd handig om te weten wanneer er bepaalde zaken plaatsvinden in de toekomst. Een agenda-overzicht helpt daarbij. 
						<p><a class="btn btn-secondary" href="agenda.php" role="button">Laat maar zien &raquo;</a></p>
					</div>
				</div>
				
				<hr>
				
		</div> <!-- /container -->
					
	</main>
	<?php include('includes/footer.inc'); ?>
	<div class="snow" />

</body>
</html>
