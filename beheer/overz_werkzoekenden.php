<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_werkzoekende_coll.php');
include_once('../class/c_maatje.php');
include_once('../class/c_jobgroup.php');

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

if (isset($_POST['selection']))
{
	$_SESSION['selection'] = $_POST['selection'];
}
else
{
	if (!isset($_SESSION['selection']))
		$_SESSION['selection'] = 'act';
}
$selection = $_SESSION['selection'];
	
$arr1 = array ();
$arr2 = array (array (0 => 'werkzkd.status', 1 => 'ASC'));

$wzColl = new Werkzoekende_coll($arr1, $arr2);

$html = '';
$nbr = 0;
// error_log ('Gelukt!');

foreach($wzColl->werkzoekendeColl as $werkzoekende)
{
	
	/* hier selectie op welke wkz worden getoond */
	$ok = TRUE;
	if ($selection == 'new')
	{
		if ($werkzoekende->status != '000') $ok = FALSE;
	}
	if ($selection == 'act')
	{
		// if ($werkzoekende->status == '000' || $werkzoekende->status > '599') $ok = FALSE;
		if ($werkzoekende->status > '599') $ok = FALSE;

	}
	if ($selection == 'non')
	{
		if ($werkzoekende->status < '600') $ok = FALSE;
	}	
	/******************/

	if ($ok)
	{	
		$nbr++;
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
		if ($werkzoekende->id_jobgroup != '')
		{
			$jgp = new Jobgroup('id', $werkzoekende->id_jobgroup);
			$jobgroup = $jgp->titel;
		} else $jobgroup= '';
		if ($werkzoekende->status == '000')
			$trstyle = ' background-color: #ffbbb9;';
			else
			$trstyle = '';
		
		// <td class="p-0">' . '<span style="display: none;">' . $werkzoekende->date_aanmelding . '</span>' . $werkzoekende->date_aanmelding . '</td>
		// <td class="p-0">' . '<span style="display: none;">' . $werkzoekende->datetime_created . '</span>' . substr($werkzoekende->datetime_created, 0, 10) . '</td>
		// <td class="p-0">' . '<span style="display: none;">' . $werkzoekende->datetime_modified . '</span>' . substr($werkzoekende->datetime_modified, 0, 10) . '</td> -->
		
		$html .= '
		<tr style="font-size: 0.9em;' . $trstyle . '">
			<td class="text-center p-0">' . sprintf('%04d', $werkzoekende->id) . '</td>		
			<td class="text-center p-0">' . $werkzoekende->status . '</td>
			<td class="p-0">' . Tools::getStatusOms($werkzoekende->status) . '</td>
			<td class="p-0">' . $werkzoekende->achternaam . ', ' . $werkzoekende->voornaam . ' ' . $werkzoekende->tussenvoegsels . '</td>
			<td class="p-0">' . $werkzoekende->emailadres . '</td>
	
			<td class="p-0">' . $werkzoekende->straat . ' ' . $werkzoekende->huisnummer . '</td>
			<td class="p-0">' . $werkzoekende->postcode .  ' ' . $werkzoekende->woonplaats . '</td>		
			<td class="p-0">' . $werkzoekende->date_geboorte . '</td>
			<td class="p-0">' . $werkzoekende->link_linkedin . '</td>
			
			<td class="p-0">' . $werkzoekende->date_aanmelding . '</td>
			<td class="p-0">' . $werkzoekende->date_uitstroom . '</td>
			<td class="p-0">' . substr($werkzoekende->datetime_created, 0, 10) . '</td>
			<td class="p-0">' . substr($werkzoekende->datetime_modified, 0, 10) . '</td>
			<td class="p-0">' . $werkzoekende->telefoonnr . '</td>
			<td class="p-0">' . $maatje . '</td>
			<td class="p-0">' . $jobgroup . '</td>
			<td class="p-0">' . $acties . '</td>
		</tr>';
	}
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>
		<link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">		
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
				<h1 class="mx-auto text-capitalize">Werkzoekenden</h1>
			</div>
		</div>
        <div class="container-fluid">
            <div class="row mt-4">
				<div class="col-md-1 p-0">
					<button type="button" class="btn btn-primary mx-3" style="width: 120px;"><a class="text-white" href="beheer.php">Menu</a></button>
				</div>
				<div class="col-md-1 p-0">
					<div class="form-group text-right">
						<label for="sel1" class="col-form-label">Toon&nbsp</label>
					</div>
				</div>
				<div class="col-md-2 p-0">
					<form method="POST" action="overz_werkzoekenden.php" id="postwz" novalidate>
					<select name="selection" class="form-control" id="sel1" onchange="this.form.submit()">
						<!-- <option value="new" <?php if($selection == 'new') echo 'selected'; ?>>nieuwe aanmeldingen</option> -->
						<option value="act" <?php if($selection == 'act') echo 'selected'; ?>>actieve werkzoekenden</option>
						<option value="non" <?php if($selection == 'non') echo 'selected'; ?>>niet actieve werkzoekenden</option>
						<option value="all" <?php if($selection == 'all') echo 'selected'; ?>>alle werkzoekenden</option>
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
					<table 	id="Thistable"
							class="data-table table-striped" 
							data-toggle="table" 
							data-search="true" 
							data-pagination="true"  
							data-page-size="20" 
							data-page-list="20, 40, 60, 80, all" 
							data-show-columns="true"
							data-show-columns-search="true"
							data-cookie="true"
							data-cookie-id-table="saveId"
							data-show-export="true"
							data-toolbar="#toolbar"
							data-filter-control="true"
							>
					<thead class="thead-dark">
					<tr>
					<th data-field="id" 		data-sortable="true" 		data-visible="false">id</th>
					<th data-field="statuscode" data-sortable="true" 		data-visible="true">statuscode</th>
					<th data-field="status" 	data-sortable="false"		data-visible="false">status</th>
					<th data-field="naam" 		data-sortable="true" 		data-visible="true">naam</th>
					<th data-field="emailadres" data-sortable="true" 		data-visible="false">emailadres</th>
					<th data-field="straat" 	data-sortable="true" 		data-visible="false">adres</th>
					<th data-field="plaats" 	data-sortable="true" 		data-visible="false">plaats</th>
					<th data-field="gebdatum" 	data-sortable="true" 		data-visible="false">geb.datum</th>
					<th data-field="linkedin" 	data-sortable="true" 		data-visible="false">LinkedIn</th>
					<th data-field="date_aanmelding" data-sortable="true" 	data-visible="true">datum aanmelding</th>
					<th data-field="date_uitstroom" data-sortable="true" 	data-visible="false">datum uitstroom</th>				
					<th data-field="datetime_created" data-sortable="true" 	data-visible="false">datum gemaakt</th>
					<th data-field="datetime_modified" data-sortable="true" data-visible="true">datum gewijzigd</th>				
					<th data-field="telefoonnr" data-sortable="false" 		data-visible="false">telefoonnr</th>
					<th data-field="maatje" 	data-sortable="true" 		data-visible="true">maatje</th>
					<th data-field="jobgroup" 	data-sortable="true" 		data-visible="true">jobgroup</th>
					<th data-field="acties" 	data-sortable="false" 		data-visible="true">acties</th>
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
			$('#Thistable').bootstrapTable('deleteCookie', 'saveId')
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
