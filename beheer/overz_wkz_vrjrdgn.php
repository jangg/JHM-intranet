<?php
include_once('../config.php');
include_once('../class/c_tools.php');
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

$arr1 = array (array (0 => 'werkzkd.date_uitstroom', 1 => 'NULL'));
// $arr1 = array ();
$arr2 = array (array (0 => 'person.achternaam', 1 => 'ASC'));

$wzColl = new Werkzoekende_coll($arr1, $arr2);

$html = '';
// error_log ('Gelukt!');

foreach($wzColl->werkzoekendeColl as $werkzoekende)
{	
	$html .= '
	<tr style="font-size: 0.9em;">
		<td class="p-0 px-2">' . $werkzoekende->achternaam . ', ' . $werkzoekende->voornaam . ' ' . $werkzoekende->tussenvoegsels . '</td>
		<td class="p-0 px-2">' . $werkzoekende->emailadres . '</td>
		<td class="p-0 px-2"><span style="display: none;">' . substr($werkzoekende->date_geboorte, 5) . '</span>' . Tools::convertTS2($werkzoekende->date_geboorte, 'verjaardag') . '</td>
	</tr>';
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>
		<link href="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.css" rel="stylesheet">		
		<script src="https://unpkg.com/bootstrap-table@1.18.2/dist/bootstrap-table.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.18.2/dist/extensions/cookie/bootstrap-table-cookie.min.js"></script>
		<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
		<script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
		<script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.18.2/dist/extensions/export/bootstrap-table-export.min.js"></script>
		<script type="text/javascript" src="libs/js-xlsx/xlsx.core.min.js"></script>
		<style>
		.bootstrap-table .fixed-table-container .fixed-table-body {
			height: auto;
		}
		.ifont {
			font-size: 1.5em;
		}
		#toolbar {
			  margin: 0;
			}
			
		</style>
	</head>
	<body style="background-color: #dddddd;">
		
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container-fluid"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto">Verjaardagen werkzoekenden</h1>
			</div>
		</div>
        <div class="container">
            <div class="row mt-4">
				<div class="col-md-12 p-0">
					<button type="button" class="btn btn-primary" style="width: 120px;"><a class="text-white" href="beheer.php">terug</a></button>
	            </div>
            </div>
        </div>
        <div class="container">
			<div class="row">
				<div class="col-12">
					<table 	id="Thistable"
							class="data-table table-striped" 
							data-toggle="table" 
							data-search="true" 
							data-pagination="false"  
							data-cookie="false"
							data-cookie-id-table="saveId"
							data-show-export="false"
							>
					<thead class="thead-dark">
					<tr>
					<th data-field="naam" data-sortable="true" data-visible="true">naam</th>
					<th data-field="emailadres" data-sortable="true" data-visible="true">emailadres</th>
					<th data-field="verjaardag" data-sortable="true" data-visible="true">verjaardag</th>
					</tr>
					</thead>
					<tbody>
					<?php echo $html; ?>
					</tbody>
					</table>
				</div>
			</div>
			<br/><br/>
		</div>
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
