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
	if ($werkzoekende->emailadres == '')
	{
		$emailtxt = '<td class="p-1"></td>';
	} else
	{
		$emailtxt = '<td class="p-1"><a href="mailto:' . $werkzoekende->emailadres . '"><i class="fa fa-envelope"></i></a> ' . $werkzoekende->emailadres . '</td>';
	}
	$html .= '
	<tr>
		<td style="text-align: center;" class="p-1"><a href="mut_persoon.php?id=' . $werkzoekende->id . '">' . sprintf('%04d', $werkzoekende->id) . '</td>
		<td class="p-1">' . $werkzoekende->status . '</td>
		<td class="p-1">' . $werkzoekende->voornaam . '</td>
		<td class="p-1">' . $werkzoekende->tussenvoegsels . '</td>
		<td class="p-1">' . $werkzoekende->achternaam . '</td>
		' . $emailtxt . '
		<td class="p-1">' . $werkzoekende->datetime_created . '</td>
		<td class="p-1">' . $werkzoekende->telefoonnr . '</td>
	</tr>';

	// $html .= '
	// <tr>
	// 	<td style="text-align: center;" class="p-1">' . $werkzoekende->id . '</td>
	// 	<td class="p-1">' . $werkzoekende->status . '</td>
	// 	<td class="p-1">' . $werkzoekende->voornaam . '</td>
	// 	<td class="p-1">' . $werkzoekende->tussenvoegsels . '</td>
	// 	<td class="p-1">' . $werkzoekende->achternaam . '</td>
	// 	<td class="p-1">' . $werkzoekende->emailadres . '</td>
	// 	<td class="p-1">' . $werkzoekende->datumnw . '</td>
	// 	<td class="p-1">' . $werkzoekende->straat . '</td>
	// 	<td class="p-1">' . $werkzoekende->huisnummer . '</td>
	// 	<td class="p-1">' . $werkzoekende->postcode . '</td>
	// 	<td class="p-1">' . $werkzoekende->woonplaats . '</td>
	// 	<td class="p-1">' . $werkzoekende->telefoonnr . '</td>
	// </tr>';
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
					<th data-field="telefoonnr" data-sortable="true">telefoonnr</th>
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
