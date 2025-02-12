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

if (!isset($_POST['selection']))
{
	// $arr1 = array (array (0 => 'person.type', 1 => 'all'));
		$arr1 = '';	
		$selection = 'all';
}
else
{
	switch ($_POST['selection'])
	{
		case 'all':
			$arr1 = '';
			$selection = 'all';
			break;
		case 'mtj':
			$arr1 = array (array (0 => 'person.type', 1 => 'mtj'));
			$selection = 'mtj';
			break;
		case 'ext':
			$arr1 = array (array (0 => 'person.type', 1 => 'ext'));
			$selection = 'ext';
			break;
		default:
	}
}

$arr2 = array (array (0 => 'person.datetime_modified', 1 => 'DESC'));

$maatjeColl = new Maatje_coll($arr1, $arr2);

$arr1 = [];
$arr2 = array (array (0 => 'person.achternaam', 1 => 'ASC'));
$wkzColl = new Werkzoekende_coll($arr1, $arr2);

$html = '';
// error_log ('Gelukt!');

foreach($maatjeColl->maatjeColl as $maatje)
{
	if ($maatje->emailadres == '')
	{
		$emailtxt = '<td class="p-0"></td>';
	} else
	{
		$emailtxt = '<td class="p-0"><a href="mailto:' . $maatje->emailadres . '"><i class="fa fa-envelope"></i></a> ' . $maatje->emailadres . '</td>';
	}

	$user = new User ('id_person', $maatje->id_person);
	
	/* Als actief_als = A dan is maatje alleen actief als maatje
		Als actief_als = K dan is maatje actief als jobgroupleider en als maatje
	*/
	if ($maatje->actief_als == 'A' || $maatje->actief_als == 'K')
	{
		$nbrClients = count($wkzColl->wkzList($maatje->id));
		if($nbrClients == 1) 
			$nbrClients .= ' cliënt';
			else
			$nbrClients .= ' cliënten';
	} else
		$nbrClients = '';
		
	$html .= '	
	
	<tr style="font-size: 0.9em;">
		<td style="text-align: center;" class="p-0"><a href="mut_maatje.php?id=' . $maatje->id . '"><i class="fas fa-user ifont"></i></a></td>
		<td class="p-0">' . $maatje->id . '</td>
		<td class="p-0">' . $maatje->achternaam . ', ' . $maatje->voornaam . ' ' . $maatje->tussenvoegsels . '</td>
		<td class="p-0">' . '<span style="display: none;">' .$user->activity . '</span>' . Tools::ConvertTS($user->activity) . '</td>
		<td class="p-0">' . $nbrClients . '</td>'
		.  $emailtxt .
		'<td class="p-0">' . $maatje->straat . ' ' . $maatje->huisnummer . '</td>
		<td class="p-0">' . $maatje->postcode . '</td>
		<td class="p-0">' . $maatje->woonplaats . '</td>
		<td class="p-0">' . $maatje->telefoonnr . '</td>
	</tr>';
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>				
		<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
		<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/cookie/bootstrap-table-cookie.min.js"></script>
		<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
		<script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
		<script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js"></script>
		<script type="text/javascript" src="libs/js-xlsx/xlsx.core.min.js"></script>

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
				<h1 class="mx-auto text-capitalize">Maatjes</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
        <div class="container-fluid">
            <div class="d-flex flex-row header rounded pt-2 mb-0 mx-0 px-0">
				<div class="col-md-2 p-0">
					<button type="button" class="btn btn-primary mx-3" style="width: 120px;"><a class="text-white" href="beheer.php">Menu</a></button>
				</div>
				<!-- <div class="col-md-1 p-0 form-group text-right">
					<label for="sel1" class="col-form-label">Toon&nbsp&nbsp</label>
				</div> -->
				<div class="col-md-1 p-0">
					<label for="sel1" class="col-form-label d-inline-flex" style="float: right;">Toon&nbsp&nbsp</label>
				</div>
				<div class="col-md-2 p-0">
					<form method="POST" action="overz_maatjes.php" novalidate>
					<select name="selection" class="form-control" id="sel1" onchange="this.form.submit()">
						<option value="mtj" <?php if($selection == 'mtj') echo 'selected'; ?>>maatjes</option>
						<option value="ext" <?php if($selection == 'ext') echo 'selected'; ?>>externen</option>
						<option value="all" <?php if($selection == 'all') echo 'selected'; ?>>iedereen</option>
					</select>
					</form>
				</div>
			</div>
        </div>
        <div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div id="toolbar" class="select">
						<select class="form-control">
							<option value="">Exporteer pagina</option>
							<option value="all">Exporteer alles</option>
							<!-- <option value="selected">Export Selected</option> -->
						</select>
					</div>
					<table 
						id="Thistable"
						class="table table-striped table-bordered table-hover" 
						data-toggle="table" 
						data-search="true" 
						data-pagination="true"  
						data-page-size="30" 
						data-page-list="20, 40, 60, 80" 
						data-show-columns="true"
						data-cookie="true"
						data-cookie-id-table="saveId2"
						data-show-export="true"
						data-toolbar="#toolbar"
						data-filter-control="true">
					<thead class="thead-dark">
					<tr>
					<th></th>
					<th data-field="id" data-sortable="true" data-visible="false">id</th>
					<th data-field="achternaam" data-sortable="true">naam</th>
					<th data-field="activity" data-sortable="true">laatst actief</th>
					<th data-sortable="true">maatje voor</th>
					<th data-field="emailadres" data-sortable="true">emailadres</th>
					<th data-field="straat" data-sortable="true">adres</th>
					<th data-field="postcode" data-sortable="true">postcode</th>
					<th data-field="woonplaats" data-sortable="true">woonplaats</th>
					<th data-field="telefoonnr" data-sortable="false">telefoonnr</th>
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
	<script>
		// The calling method syntax: $('#table').bootstrapTable('method', parameter).
		$(document).ready(function(){
			$(function() {
				$('#Thistable').bootstrapTable('deleteCookie', 'saveId2')
			})
			
			var $table = $('#Thistable')
			$(function() {
				$('#toolbar').find('select').change(function () {
					$table.bootstrapTable('destroy').bootstrapTable({
						exportDataType: $(this).val(),
						exportTypes: ['csv', 'txt', 'excel', 'pdf']
					})
				}).trigger('change')
			})		
		});		
			</script>
</html>
