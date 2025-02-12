<?php
include_once('config.php');
include_once('class/c_user.php');
setlocale (LC_ALL, "nl-NL");
define("DEFAULT_LANG", 'nl-NL');
$_SERVER['HTTP_ACCEPT_LANGUAGE'] = "nl-NL";
echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
// if (!isset($_SESSION['username'])) {
// 	header('location:../index.php');
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
$agenda_array = array(
	array ("datum" => "20200806", "begintijd" => "10:00", "eindtijd" => "11:00", "omschrijving" => "Een eerste ontmoeting", "plaats" => "Het Forum", "organisator" => "JHMZ", "pic" => ""),
	array ("datum" => "20200810", "begintijd" => "11:00", "eindtijd" => "12:00", "omschrijving" => "Een tweede ontmoeting", "plaats" => "Het Forum", "organisator" => "JHMZ", "pic" => ""),
	array ("datum" => "20200816", "begintijd" => "13:00", "eindtijd" => "16:00", "omschrijving" => "Een derde ontmoeting", "plaats" => "Het Forum", "organisator" => "JHMZ", "pic" => ""),
	array ("datum" => "20200816", "begintijd" => "09:00", "eindtijd" => "12:00", "omschrijving" => "Een vierde ontmoeting", "plaats" => "Het Forum", "organisator" => "JHMZ", "pic" => ""),
	array ("datum" => "20200826", "begintijd" => "10:00", "eindtijd" => "12:00", "omschrijving" => "Een vijfde ontmoeting", "plaats" => "Het Forum", "organisator" => "JHMZ", "pic" => ""),
	array ("datum" => "20200906", "begintijd" => "10:00", "eindtijd" => "11:00", "omschrijving" => "Een eerste ontmoeting", "plaats" => "Het Forum", "organisator" => "JHMZ", "pic" => ""),
	array ("datum" => "20200910", "begintijd" => "11:00", "eindtijd" => "12:00", "omschrijving" => "Een tweede ontmoeting", "plaats" => "Het Forum", "organisator" => "JHMZ", "pic" => ""),
	array ("datum" => "20200916", "begintijd" => "13:00", "eindtijd" => "16:00", "omschrijving" => "Een derde ontmoeting", "plaats" => "Het Forum", "organisator" => "JHMZ", "pic" => ""),
	array ("datum" => "20201016", "begintijd" => "09:00", "eindtijd" => "12:00", "omschrijving" => "Een vierde ontmoeting", "plaats" => "Het Forum", "organisator" => "JHMZ", "pic" => ""),
	array ("datum" => "20201126", "begintijd" => "10:00", "eindtijd" => "12:00", "omschrijving" => "Een vijfde ontmoeting", "plaats" => "Het Forum", "organisator" => "JHMZ", "pic" => "")
);
// print_r ($agenda_array);

/* maak nu de html voor de agenda op basis van de agenda-tabel */


// echo $datum->format("Y-m-d");
// echo $datum->format("l");
// echo $begintijd->format("G");
// echo $begintijd->format("i");

$agenda_html = '';
$maand = '';

for ($i = 0; $i < count($agenda_array); $i++)
{ 
	
	$datum = new DateTime($agenda_array[$i]["datum"]);
	$begintijd = new DateTime($agenda_array[$i]["begintijd"]);
	$eindtijd = new DateTime($agenda_array[$i]["eindtijd"]);
	if ($maand != $datum->format("m"))
	{
		if ($maand != '')
		{
			$agenda_html .=
			'</div></div>';
		}
		$maand = $datum->format("m");
		$agenda_html .=
		'<div class="row py-4" style="border-bottom: 6px solid #304280;">
		<div class="col">
		<h2 class="mb-4">' . $datum->format("F") . '</h2>';
	}
	$agenda_html .=
	'<div class="row py-3" style="border-top: 1px solid #304280;"><div class="col-2"><div>'
	. $datum->format("l") . 
	'</div><div><h1 class="pl-1">'
	. $datum->format("j") .
	'</h1></div></div><div class="col-6">'
	. $agenda_array[$i]["omschrijving"] .
	'</div><div class="col-4 ">'
	. $begintijd->format("G") . ':' . $begintijd->format("i") . ' - ' . $eindtijd->format("G") . ':' . $eindtijd->format("i") . '<br/>'
	. $agenda_array[$i]["plaats"] . '<br/>
	<br/>
	</div></div>';	
}


?>
<!DOCTYPE html>
<html lang="nl">
	<head>
		<?php include('includes/head.inc'); ?>				
</head>
	<body style="background-color: #dddddd;">
		<!-- <?php include('includes/navbar.inc'); ?> -->		
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
			<?php echo $agenda_html; ?>
		    <?php include('includes/footer.inc'); ?>
	</body>
</html>
