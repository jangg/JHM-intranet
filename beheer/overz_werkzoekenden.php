<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende_coll.php');

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
	
	
	$html .= '
	<tr>
		<td style="text-align: center;" class="p-1">' . sprintf('%04d', $werkzoekende->id) . '</td>
		<td class="p-1">' . $werkzoekende->status . '</td>
		<td class="p-1">' . $werkzoekende->voornaam . '</td>
		<td class="p-1">' . $werkzoekende->tussenvoegsels . '</td>
		<td class="p-1">' . $werkzoekende->achternaam . '</td>
		<td class="p-1">' . $werkzoekende->emailadres . '</td>
		<td class="p-1">' . $werkzoekende->datetime_created . '</td>
		<td class="p-1">' . $werkzoekende->telefoonnr . '</td>
		<td class="p-1">' . $acties . '</td>
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
					<table class="table table-striped table-bordered table-hover" data-toggle="table" data-search="true" data-pagination="true"  data-page-size="20" data-page-list="20, 40, 60, 80" data-show-columns="true">
					<!-- <table class="table-striped table-bordered table-hover" data-toggle="table" data-search="true" data-pagination="true" data-show-columns="true" data-page-size="15" data-page-list="15, 30, 60, 90"> -->
					<thead class="thead-dark">
					<tr>
					<th data-sortable="true" data-field="id">id</th>
					<th data-field="status" data-sortable="true">status</th>
					<th data-field="voornaam" data-sortable="true">voornaam</th>
					<th>tussenvoegsels</th>
					<th data-field="achternaam" data-sortable="true">achternaam</th>
					<th data-field="emailadres" data-sortable="true">emailadres</th>
					<th data-field="datetime_created" data-sortable="true">datum</th>
					<!-- <th data-field="straat" data-sortable="true">straat</th>
					<th data-field="huisnummer" data-sortable="true">huisnr</th>
					<th data-field="postcode" data-sortable="true">postcode</th>
					<th data-field="woonplaats" data-sortable="true">woonplaats</th> -->
					<th>telefoonnr</th>
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
