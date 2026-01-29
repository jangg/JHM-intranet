<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_newsitem_coll.php');

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
newsitem verwijderen (delind wordt j)
********************************* */
if (isset($_GET['del']) && $_GET['del'] == 'j') 
{
	$item = new Newsitem ('id', $_GET['id']);
	// error_log($item);
	
	if ($item->delind != 'j') 
	{
		$item->delind = 'j';
		$item->updateToDB();
	}
		
}


$arr1 = array ();
$arr2 = array (array (0 => 'datetime_created', 1 => 'DESC'));

$newsitemColl = new Newsitem_coll($arr1, $arr2);

$html = '';
// error_log ('Gelukt!');

foreach($newsitemColl->newsitemColl as $newsitem)
{
	$user_created = new User ('id', $newsitem->id_user_created);
	$html .= '		
	<tr style="font-size: 0.9em;">
		<td style="text-align: center;" class="p-0"><a href="mut_newsitem.php?id=' . $newsitem->id . '"><i class="fas fa-newspaper"></i></i></a></td>
		<td class="p-0 text-center">' . $newsitem->datetime_created		. '</td>
		<td class="p-0 text-center">' . $newsitem->datetime_modified	. '</td>
		<td class="p-0 text-center">' . $user_created->username	. '</td>
		<td class="p-0 text-left">' . $newsitem->titel				. '</td>
		<td class="p-0 text-center">' . $newsitem->pubind_intern		. '</td>
		<td class="p-0 text-center">' . substr($newsitem->datetime_pub_intern, 0, 10) . '</td>
		<td class="p-0 text-center">' . $newsitem->pubind_extern		. '</td>
		<td class="p-0 text-center">' . substr($newsitem->datetime_pub_extern, 0, 10) . '</td>
		<td style="text-align: center;" class="p-0"><a href="overz_newsitems.php?id=' . $newsitem->id . '&del=j"' . ' onclick="return confirm(\'Weet je zeker dat je dit bericht wilt verwijderen?\');"><i class="fa-regular fa-trash-can"></i></a></td>
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
				<h1 class="mx-auto">Nieuwsberichten</h1>
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
					<th data-field="datetime_created" data-sortable="true" class="text-center">datum gemaakt</th>
					<th data-field="datetime_modified" data-sortable="true" class="text-center">datum gewijzigd</th>
					<th data-field="user_created" data-sortable="true" class="text-center">gewijzigd door</th>
					<th data-field="titel" data-sortable="true" data-filter-control="select">titel</th>
					<th data-field="pubind_intern" data-sortable="true"  class="text-center">intern (j/n)</th>
					<th data-field="datetime_pub_intern" data-sortable="true"  class="text-center">datum intern</th>
					<th data-field="pubind_extern" data-sortable="true" t class="text-center">extern (j/n)</th>
					<th data-field="datetime_pub_extern" data-sortable="true"  class="text-center">datum extern</th>
					<th></th>
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
