<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_jobgroup_coll.php');
include_once('../class/c_locatie.php');

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

$arr1 = array ();
$arr2 = array ();

$jobgroupColl = new jobgroup_coll($arr1, $arr2);

$html = '';
// error_log ('Gelukt!');

foreach($jobgroupColl->jobgroupColl as $jobgroup)
{
	if ($jobgroup->onlineInd == 'j') 
	{
		$online = 'Ja';
		$locatie = '---';
	}
	else 
	{
		$online = 'Nee';
		// $locatie = new Locatie ('id', $jobgroup->id_locatie);
		// if ($locatie)
		// {
		// 	$locatie = $locatie->titel;
		// }
		// else
		// {
		// 	$locatie = 'nog niet bekend';
		// }
		$locatie = $jobgroup->id_locatie;
	}
	$html .= '		
	<tr style="font-size: 0.9em;">
		<td style="text-align: center;" class="p-0"><a href="mut_jobgroup.php?id=' . $jobgroup->id . '"><i class="fas fa-user-friends ifont"></i></a></td>
		<td class="p-0">' . $jobgroup->titel . '</td>
		<td class="p-0">' . $jobgroup->status . '</td>
		<td class="p-0">' . $online . '</td>
		<td class="p-0">' . $locatie . '</td>
		<td class="p-0">' . $jobgroup->startDate . '</td>
		<td class="p-0">' . $jobgroup->soort . '</td>
		<td class="p-0">' . $jobgroup->nbrSessies() . '</td>
		<td class="p-0">' . $jobgroup->nbrPlaatsen . '</td>
		<td class="p-0">' . ($jobgroup->nbrPlaatsen - $jobgroup->nbrDeelnemers()) . '</td>
	</tr>';
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>				
		<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.css">
		<script src="https://unpkg.com/bootstrap-table@1.18.0/dist/bootstrap-table.min.js"></script>
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
				<h1 class="mx-auto">Jobgroups</h1>
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
					<th data-field="titel" data-sortable="true">titel</th>
					<th data-field="status" data-sortable="true" data-filter-control="select">status</th>
					<th data-field="online" data-sortable="true">online</th>
					<th data-field="id_locatie" data-sortable="true">locatie</th>
					<th data-field="startdate" data-sortable="true">startdatum</th>
					<th data-field="soort" data-sortable="true">soort jobgroup</th>
					<th data-field="nbrsessies" data-sortable="true"># sessies</th>
					<th data-field="nbrplaatsen" data-sortable="false"># plaatsen</th>
					<th data-field="nbrbeschikbaar" data-sortable="false"># beschikbaar</th>
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
