<?php
include_once('config.php');
include_once('class/c_user.php');
include_once('class/c_agendaitem_coll.php');

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
$today = new DateTimeImmutable();
$arr1 = array (	array (0 => 'agendaitem.datum', 1 => $today->format('Y' . 'm' . 'd')));
$arr2 = array (	array (0 => 'agendaitem.datum', 1 => 'ASC'), array (0 => 'agendaitem.begintijd', 1 => 'ASC'));

$agendaColl = new Agendaitem_coll ($arr1, $arr2);
$agenda_html = '';
$maand = '';

foreach ($agendaColl->agendaitemColl as $agendaitem)
{
	$datum = new DateTimeImmutable($agendaitem->datum);
	$begintijd = new DateTimeImmutable($agendaitem->begintijd);
	$eindtijd = new DateTimeImmutable($agendaitem->eindtijd);
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
		<h2 class="mb-4">' . strftime('%B', $datum->getTimestamp()) . '</h2>';
	}
	$agenda_html .=
	'<div class="row py-3" style="border-top: 1px solid #304280;"><div class="col-2"><div>'
	. strftime('%A', $datum->getTimestamp()) . 
	'</div><div><h1 class="pl-1">'
	. $datum->format("j") .
	'</h1></div></div><div class="col-6">'
	. $agendaitem->titel . '<br/>' 
	. nl2br($agendaitem->omschrijving)
	. '</div><div class="col-4 ">'
	. $begintijd->format("G") . ':' . $begintijd->format("i") . ' - ' . $eindtijd->format("G") . ':' . $eindtijd->format("i") . '<br/>'
	. $agendaitem->locatie . '<br/>
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
			<?php echo $agenda_html; ?>
		    <?php include('includes/footer.inc'); ?>
	</body>
</html>
