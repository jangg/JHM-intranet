<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_agendaitem_coll.php');

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:../index.php');
	exit();
}
/**********************/

if (isset($_SESSION['userid']))
{
	$curr_user = new User ('id', $_SESSION['userid']);
} else
{
	$curr_user = new User ();
}

/********************************
agendaitem verwijderen (delind wordt j)
********************************* */
if (isset($_GET['del']) && $_GET['del'] == 'j') 
{
	$item = new Agendaitem ('id', $_GET['id']);
	// error_log($item);
	
	if ($item->delind != 'j') 
	{
		$item->delind = 'j';
		$item->updateToDB();
	}
		
}

$arr1 = array ();
$arr2 = array (array (0 => 'datum', 1 => 'DESC'));

$agendaitemColl = new Agendaitem_coll($arr1, $arr2);

$today = date("Y-m-d");

$html = '';
// error_log ('Gelukt!');

foreach($agendaitemColl->agendaitemColl as $agendaitem)
{
	$user_created = new User ('id', $agendaitem->id_user_created);
	$publind_int = 'n';
	$publind_ext = 'n'; 
	if ($agendaitem->publmed ==  2 || $agendaitem->publmed ==  3) $publind_int = 'j';
	if ($agendaitem->publmed ==  1 || $agendaitem->publmed ==  3) $publind_ext = 'j';
	if ($today <= $agendaitem->datum)
	{
		$trstyle = ' background-color: lightgreen;';
	} else $trstyle = '';
	$html .= '		
	<tr style="font-size: 0.9em;' . $trstyle . '">
		<td style="text-align: center;" class="p-0"><a href="mut_agendaitem.php?id=' . $agendaitem->id . '"><i class="fas fa-newspaper"></i></i></a></td>
		<td class="p-0">' . $agendaitem->datetime_created		. '</td>
		<td class="p-0">' . $agendaitem->datetime_modified	. '</td>
		<td class="p-0 text-center">' . $user_created->username	. '</td>
		<td class="p-0 text-left">' . strip_tags($agendaitem->titel)		. '</td>
		<td class="p-0">' . $agendaitem->datum	. '</td>
		<td class="p-0">' . $publind_int 		. '</td>
		<td class="p-0">' . $publind_ext		. '</td>
		<td style="text-align: center;" class="p-0"><a href="overz_agendaitems.php?id=' . $agendaitem->id . '&del=j"' . ' onclick="return confirm(\'Weet je zeker dat je dit agenda item wilt verwijderen?\');"><i class="fa-regular fa-trash-can"></i></a></td>
		
		</tr>';
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.26.0/dist/bootstrap-table.min.css">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.26.0/dist/bootstrap-table.min.js"></script>				
		<!-- <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css">
		<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script> -->
		<style>
			.bootstrap-table .fixed-table-container .fixed-table-body {
				height: auto;
				}
			i {
				font-size: 1.3em;
			}
		</style>
	</head>
	<body style="background-color: #dddddd;">
		
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container-fluid"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto">Agenda items</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
        <div class="container">
            <div class="row mt-4">
				<div class="col-md-1 p-0">
					<button type="button" class="btn btn-primary mx-3" style="width: 120px;"><a class="text-white" href="beheer.php">Menu</a></button>
				</div>
            </div>
        </div>
        <div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<table class="table table-striped table-bordered table-hover" 
						data-toggle="table" 
						data-search="true" 
						data-pagination="true"  
						data-page-size="20" 
						data-page-list="20, 40, 60, 80" 
						data-show-columns="true"
						data-sort-name="startdate" 
						data-sort-order="asc"
						>
					<thead class="thead-dark">
					<tr>
					<th></th>
					<th data-field="datetime_created" data-sortable="true">datum gemaakt</th>
					<th data-field="datetime_modified" data-sortable="true">datum gewijzigd</th>
					<th data-field="user_created" data-sortable="true" class="text-center">gewijzigd door</th>
					<th data-field="titel" data-sortable="true" data-filter-control="select">titel</th>
					<th data-field="datum" data-sortable="true">datum</th>
					<th data-field="pubind_intern" data-sortable="true">intern (j/n)</th>
					<th data-field="pubind_extern" data-sortable="true">extern (j/n)</th>
					<th data-field=""></th>
					</tr>
					</thead>
					<tbody>
					<?php echo $html; ?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
