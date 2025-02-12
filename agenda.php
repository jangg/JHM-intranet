<?php
include_once('config.php');
include_once('class/c_user.php');
include_once('class/c_agendaitem_coll.php');
include_once('class/c_maatje_coll.php');
include_once('class/c_jobgroup_coll.php');

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
/**********************

Haal de agendaitems op.
publmed waarden:
	0 = niet publiceren
	1 = publiceren op agenda website
	2 = publiceren op agenda intranet
	3 = publiceren op agenda's website en intranet

************************/
$today = new DateTimeImmutable();
$ptoday = $today->format("Y-m-d");
$arr1 = array (	array (0 => 'agendaitem.publmed', 1 => '2'), array (0 => 'agendaitem.publmed', 1 => '3'));
$arr2 = array (	array (0 => 'agendaitem.datum', 1 => 'ASC'), array (0 => 'agendaitem.begintijd', 1 => 'ASC'));
$agendaColl = new Agendaitem_coll ($arr1, $arr2);
$maatjes = new Maatje_coll (NULL, NULL);
// print_r ($maatjes);
$verjaardagen = $maatjes->verjaardagenAgenda ();
// print_r ($verjaardagen);
$agenda = array_merge($agendaColl->agendaitemColl, $verjaardagen);

$jobgroups = new Jobgroup_coll ();
$sessies = $jobgroups->sessiesAgenda();

$agenda = array_merge($agenda, $sessies);

usort($agenda, function($a, $b)
 {
	 if ($a->datum == $b->datum)
		 return (0);
	 return (($a->datum < $b->datum) ? -1 : 1);
 });


$agenda_html = '';
$maand = '';

foreach ($agenda as $agendaitem)
{
	
	$datum = new DateTimeImmutable($agendaitem->datum);
	$pdatum = $datum->format("Y-m-d");
	// error_log ($datum->format("Y-m-d\TH:i:sP") . ' = ' . $today->format("Y-m-d\TH:i:sP") . ' -- ');

	if ($pdatum >= $ptoday)
	{
		/* test of het campagne item is
			zo ja, dan de achtergrondkleur zetten
		*/
		$backgrcolor =	'';
		if (strpos($agendaitem->titel, 'FAIRE KANS')) 
		{
			$backgrcolor =	'#eebec0';
		}
		if ($agendaitem->begintijd != '')
		{
			$begin = new DateTimeImmutable($agendaitem->begintijd);
			$begintijd = $begin->format("G") . ':' . $begin->format("i");
		}
		else
			$begintijd = '';
		if ($agendaitem->eindtijd != '')
		{
			$eind = new DateTimeImmutable($agendaitem->eindtijd);
			$eindtijd = $eind->format("G") . ':' . $eind->format("i");
		}
		else
			$eindtijd = '';
		if ($maand != $datum->format("m"))
		{
			if ($maand != '')
			{
				$agenda_html .=
				'</div></div>';
			}
			$maand = $datum->format('m');
			$agenda_html .=
			'<div class="row py-4" style="border-bottom: 6px solid #304280;">
			<div class="col">
			<h2 class="mb-4">' . strftime('%B', $datum->getTimestamp()) . ' ' . strftime('%Y', $datum->getTimestamp()) .'</h2>';
		}
		$agenda_html .=
		'<div class="row py-3" style="border-top: 1px solid #304280; background-color: ' . $backgrcolor . ';"><div class="col-2"><div>'
		. strftime('%A', $datum->getTimestamp()) . 
		'</div><div><h1 class="pl-1">'
		. $datum->format("j") . ' <span style="font-size: .4em;">' . strftime('%B', $datum->getTimestamp()) . '</span>' .
		'</h1></div></div><div class="col-6">'
		. $agendaitem->titel . '<br/>' 
		. nl2br($agendaitem->omschrijving);
		
		if ($agendaitem->freefld3 != '') {
			$agenda_html .= '<br/><strong>' . nl2br($agendaitem->freefld3) . '</strong>';
		}
		
		$agenda_html .=
		'</div><div class="col-4 ">'
		. '<i class="far fa-clock" aria-hidden="true"></i> ' . $begintijd . ' - ' . $eindtijd . '<br/>'
		. '<i class="fa fa-map-marker-alt" aria-hidden="true"></i> ' . $agendaitem->locatie . '<br/>
		<br/>
		</div></div>';
	}
	
}


?>
<!DOCTYPE html>
<html lang="nl">
	<head>
		<?php include('includes/head.inc'); ?>
	</head>
	<body class="bodystyle">
		<?php include('includes/navbar.inc'); ?>		
		<div class="container" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto text-uppercase">agenda</h1>
			</div>
		</div>
 	   <div class="container text-dark">
			<!-- <div class="row mt-4" style="border-bottom: 10px solid #304280;">
				<div class="col">
				<h1>Agenda 2020</h1>
				</div>
			</div> -->
			<?php echo $agenda_html; ?>
		    <?php include('includes/footer.inc'); ?>
	</body>
</html>
