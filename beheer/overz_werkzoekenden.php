<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende_coll.php');
include_once('../class/c_maatje.php');

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

$arr1 = array ();
$arr2 = array (array (0 => 'person.datetime_created', 1 => 'DESC'));

$wzColl = new Werkzoekende_coll($arr1, $arr2);

$html = '';
// error_log ('Gelukt!');

foreach($wzColl->werkzoekendeColl as $werkzoekende)
{
	$acties = '';

	if ($werkzoekende->status != 0)
	{
		$acties .= '<a href="mut_persoon.php?id=' . $werkzoekende->id . '"><i class="fas fa-user ifont"></i></a>&nbsp&nbsp&nbsp';
	} else
	{
		$acties .= '<a href="mut_persoon.php?id=' . $werkzoekende->id . '"><i class="far fa-user ifont"></i></a>&nbsp&nbsp&nbsp';
	}
	if ($werkzoekende->id_intakeform != '')
	{
		$acties .= '<a href="intake.php?id=' . $werkzoekende->id . '"><i class="fas fa-file-alt ifont"></i></a>&nbsp&nbsp&nbsp';
	} else
	{
		$acties .= '<a href="intake.php?id=' . $werkzoekende->id . '"><i class="far fa-file-alt ifont"></i></a>&nbsp&nbsp&nbsp';
	}
	if ($werkzoekende->emailadres != '')
	{
		$acties .= '<a href="mailto:' . $werkzoekende->emailadres . '"><i class="far fa-envelope ifont"></i></a>&nbsp&nbsp&nbsp';
	} else
	{
		$acties .= '<i class="far fa-envelope ifont" style="opacity: 0;"></i>&nbsp&nbsp&nbsp';
	}
	// $acties .= '<i class="far fa-trash-alt ifont"></i>';
	
	if ($werkzoekende->id_maatje != '')
	{
		$mtj = new Maatje('id', $werkzoekende->id_maatje);
		$maatje = $mtj->voornaam . ' ' . $mtj->tussenvoegsels . ' ' . $mtj->achternaam;
	} else $maatje = '';
	
	$html .= '
	<tr style="font-size: 0.9em;">
		<td style="text-align: center;" class="p-0">' . sprintf('%04d', $werkzoekende->id) . '</td>
		
		<td class="text-center p-0">' . $werkzoekende->status . '</td>
		<td class="p-0">' . $werkzoekende->achternaam . ', ' . $werkzoekende->voornaam . ' ' . $werkzoekende->tussenvoegsels . '</td>
		<td class="p-0">' . $werkzoekende->emailadres . '</td>
		<td class="p-0">' . $werkzoekende->datetime_created . '</td>
		<td class="p-0">' . $werkzoekende->datetime_modified . '</td>
		<td class="p-0">' . $werkzoekende->telefoonnr . '</td>
		<td class="p-0">' . $maatje . '</td>
		<td class="p-0">' . $acties . '</td>
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
		.ifont {
			font-size: 1.5em;
		}
		</style>
	</head>
	<body style="background-color: #dddddd;">
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container-fluid"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto text-capitalize">Werkzoekenden</h1>
			</div>
		</div>
        <div class="container">
            <div class="row mt-4">
				<div class="col-md-12 p-0">
					<button type="button" class="btn btn-primary" style="width: 120px;"><a class="text-white" href="beheer.php">terug</a></button>
	            </div>
            </div>
        </div>
        <div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<table class="data-table table-striped" data-toggle="table" data-search="true" data-pagination="true"  data-page-size="20" data-page-list="20, 40, 60, 80" data-show-columns="true">
					<!-- <table class="table-striped table-bordered table-hover" data-toggle="table" data-search="true" data-pagination="true" data-show-columns="true" data-page-size="15" data-page-list="15, 30, 60, 90"> -->
					<thead class="thead-dark">
					<tr>
					<th data-sortable="true" data-field="id" data-visible="false">id</th>
					<th class="text-center" data-field="status" data-sortable="true">status</th>
					<th data-field="achternaam" data-sortable="true">naam</th>
					<th data-field="emailadres" data-sortable="true" data-visible="false">emailadres</th>
					<th data-field="datetime_created" data-sortable="true">datum gemaakt</th>
					<th data-field="datetime_modified" data-sortable="true" data-visible="true">datum gewijzigd</th>				
					<th data-visible="false">telefoonnr</th>
					<th data-field="maatje" data-sortable="true" data-visible="true">maatje</th>
					<th>acties</th>
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
