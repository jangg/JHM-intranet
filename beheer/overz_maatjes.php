<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_maatje_coll.php');

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
$arr2 = array (	array (0 => 'person.achternaam', 1 => 'ASC'));

$maatjeColl = new Maatje_coll($arr1, $arr2);

$html = '';
// error_log ('Gelukt!');

foreach($maatjeColl->maatjeColl as $maatje)
{
	if ($maatje->emailadres == '')
	{
		$emailtxt = '<td class="p-1"></td>';
	} else
	{
		$emailtxt = '<td class="p-1"><a href="mailto:' . $maatje->emailadres . '"><i class="fa fa-envelope"></i></a> ' . $maatje->emailadres . '</td>';
	}

	$user = new User ('id_person', $maatje->id_person);
	$html .= '	
	
	<tr>
		<td style="text-align: center;" class="p-1"><a href="mut_maatje.php?id=' . $maatje->id . '">' . $maatje->id . '</a></td>
		<td class="p-1">' . $maatje->voornaam . '</td>
		<td class="p-1">' . $maatje->tussenvoegsels . '</td>
		<td class="p-1">' . $maatje->achternaam . '</td>
		<td class="p-1">' . $user->activity . '</td>'
		.  $emailtxt .
		'<td class="p-1">' . $maatje->straat . '</td>
		<td class="p-1">' . $maatje->huisnummer . '</td>
		<td class="p-1">' . $maatje->postcode . '</td>
		<td class="p-1">' . $maatje->woonplaats . '</td>
		<td class="p-1">' . $maatje->telefoonnr . '</td>
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
		</style>
	</head>
	<body style="background-color: #dddddd;">
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container-fluid"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto text-capitalize">Maatjes</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
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
					<thead class="thead-dark">
					<tr>
					<th data-sortable="true" data-field="id">id</th>
					<th data-field="voornaam" data-sortable="true">voornaam</th>
					<th>tussenvoegsels</th>
					<th data-field="achternaam" data-sortable="true">achternaam</th>
					<th data-field="activity" data-sortable="true">laatst actief</th>
					<th data-field="emailadres" data-sortable="true">emailadres</th>
					<th data-field="straat" data-sortable="true">straat</th>
					<th data-field="huisnummer" data-sortable="true">huisnr</th>
					<th data-field="postcode" data-sortable="true">postcode</th>
					<th data-field="woonplaats" data-sortable="true">woonplaats</th>
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
