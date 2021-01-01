<?php
include_once('config.php');
include_once('class/c_user.php');

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

?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('includes/head.inc'); ?>				
</head>
	<body style="background-color: #dddddd;">
		<?php include('includes/navbar.inc'); ?>		
		<div class="container" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto text-uppercase">agenda</h1>
			</div>
		</div>
 	   <div class="container text-dark">
			<div class="row mt-4" style="border-bottom: 10px solid #304280;">
				<div class="col">
				<h1>Agenda 2020</h1>
				</div>
			</div>
		   <!-- <div class="row py-4" style="border-bottom: 6px solid #304280;">
		   		<div class="col">
				<h2 class="mb-4">Juli</h2>
				   <div class="row py-3" style="border-top: 1px solid #304280;">
					   <div class="col-2"><div>dinsdag</div><div><h1 class="pl-1">28</h1></div></div>
					   <div class="col-6">Walk & Talk netwerkbijeenkomst weer ouderwets in het Forum (trainingsruimte 2). Ingang via de Frankrijklaan.  Thema: “Hoe verbeter je je uitstraling”</div>
					   <div class="col-4 ">9:30 - 11:30<br/>Forum<br/>trainingsruimte 2<br/>Ingang Frankrijklaan</div>
				   </div>
				   <div class="row py-3" style="border-top: 1px solid #304280;">
					   <div class="col-2"><div>donderdag</div><div><h1 class="pl-1">30</h1></div></div>
					   <div class="col-6">Overleg coördinatoren</div>
					   <div class="col-4 ">13:00 - 15:00<br/>Forum<br/>Café<br/></div>
				   </div>
				</div>
			</div> -->
			<div class="row py-3" style="border-bottom: 6px solid #304280;">
				<div class="col">
					<h2 class="mb-4">Augustus</h2>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">6</h1></div></div>
						<div class="col-6">Overleg coördinatoren</div>
						<div class="col-4 ">13:00 - 15:00<br/>Forum<br/>Café<br/></div>
					</div>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">6</h1></div></div>
						<div class="col-6">Forum baliebezetting</div>
						<div class="col-4 ">14:00 - 16:00 Johan<br/>16:00 - 18:00 Peter G.<br/>Forum<br/>JobHulpMaatje Balie<br/></div>
					</div>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">13</h1></div></div>
						<div class="col-6">Forum baliebezetting</div>
						<div class="col-4 ">14:00 - 16:00 Joke<br/>16:00 - 18:00 Flip<br/>Forum<br/>JobHulpMaatje Balie<br/></div>
					</div>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">20</h1></div></div>
						<div class="col-6">Forum baliebezetting</div>
						<div class="col-4 ">14:00 - 16:00 Peter G.<br/>16:00 - 18:00 Joke<br/>Forum<br/>JobHulpMaatje Balie<br/></div>
					</div>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">27</h1></div></div>
						<div class="col-6">Forum baliebezetting</div>
						<div class="col-4 ">14:00 - 16:00 Flip<br/>16:00 - 18:00 Johan<br/>Forum<br/>JobHulpMaatje Balie<br/></div>
					</div>
				</div>
			</div>
			<div class="row py-3" style="border-bottom: 6px solid #304280;">
				<div class="col">
					<h2 class="mb-4">September</h2>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">3</h1></div></div>
						<div class="col-6">Forum baliebezetting</div>
						<div class="col-4 ">14:00 - 16:00 Peter G.<br/>16:00 - 18:00 Johan<br/>Forum<br/>JobHulpMaatje Balie<br/></div>
					</div>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">10</h1></div></div>
						<div class="col-6">Forum baliebezetting</div>
						<div class="col-4 ">14:00 - 16:00 Joke<br/>16:00 - 18:00 Flip<br/>Forum<br/>JobHulpMaatje Balie<br/></div>
					</div>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>dinsdag</div><div><h1 class="pl-1">11</h1></div></div>
						<div class="col-6">Start JobGroupMeeting 2020-3<br/>De JobGroupMeeting start vandaag en wordt 7 keer op iedere vrijdagochtend gehouden.<br/>
						Data: 11-9, 18-9, 25-9, 2-10, 9-10, 16-10, en 23-10</div>
						<div class="col-4 ">9:30 - 12:00<br/>Forum<br/>trainingsruimte 1<br/></div>
					</div>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">17</h1></div></div>
						<div class="col-6">Training nieuwe maatjes</div>
						<div class="col-4 ">13:00 - 20:00<br/>Plaats nnb</div>
					</div>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">17</h1></div></div>
						<div class="col-6">Forum baliebezetting</div>
						<div class="col-4 ">14:00 - 16:00 Peter G.<br/>16:00 - 18:00 Johan<br/>Forum<br/>JobHulpMaatje Balie<br/></div>
					</div>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">24</h1></div></div>
						<div class="col-6">Training voor Maatjes t.b.v. begeleiding Nieuwe Nederlanders</div>
						<div class="col-4 ">9:30 - 16:30<br/>Plaats nnb</div>
					</div>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">24</h1></div></div>
						<div class="col-6">Forum baliebezetting</div>
						<div class="col-4 ">14:00 - 16:00 Joke<br/>16:00 - 18:00 Flip<br/>Forum<br/>JobHulpMaatje Balie<br/></div>
					</div>
				</div>
			</div>
			<div class="row  py-3" style="border-bottom: 6px solid #304280;">
				<div class="col">
					<h2 class="mb-4">Oktober</h2>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>donderdag</div><div><h1 class="pl-1">1</h1></div></div>
						<div class="col-6">Hercertificering voor bestaande Maatjes<br/>
						Data: 1-10 (Rhenen), 12-11 (Zoetermeer), 28-11 (Zwolle)</div>
						<div class="col-4 ">Meer info volgt</div>
					</div>
				</div>
			</div>
			<div class="row py-3" style="border-bottom: 6px solid #304280;">
				<div class="col">
					<h2 class="mb-4">November</h2>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>vrijdag</div><div><h1 class="pl-1">3</h1></div></div>
						<div class="col-6">Start JobGroupMeeting 2020-4<br/>De JobGroupMeeting start vandaag en wordt 7 keer op iedere dinsdagochtend gehouden.<br/>
						Data: 3-11, 17-11, 1-12, 8-12, 15-12, 5-1, 12-1 en 19-1</div>
						<div class="col-4 ">9:30 - 12:00<br/>Forum<br/>trainingsruimte 2<br/></div>
					</div>
					<div class="row py-3" style="border-top: 1px solid #304280;">
						<div class="col-2"><div>vrijdag</div><div><h1 class="pl-1">7</h1></div></div>
						<div class="col-6">Landelijke JobHulpMaatjesdag</div>
						<div class="col-4">Tijd nnb<br/>De Basiliek<br/>Veenendaal</div>
					</div>
				</div>
		   </div>
		   <?php include('includes/footer.inc'); ?>
	</body>
</html>
