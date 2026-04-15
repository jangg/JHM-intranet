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

/********************************
maatje verwijderen (delind wordt j)
********************************* */
if (isset($_GET['del']) && $_GET['del'] == 'j') 
{
	$item = new Maatje ('id', $_GET['id']);
	// error_log($item);
	if ($item->delind != 'j') 
	{
		$item->delind = 'j';
		$item->updateToDB();
	}
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
		$emailtxt = '';
	} else
	{
		$emailtxt = '<a href="mailto:' . $maatje->emailadres . '"><i class="fa-regular fa-envelope"></i></a> ' . $maatje->emailadres;
	}

	$user = new User ('id_person', $maatje->id_person);
	
	/* Als actief_als = A dan is maatje alleen actief als maatje
		Als actief_als = K dan is maatje actief als jobgroupleider en als maatje
	*/
	if ($maatje->actief_als == 'A' || $maatje->actief_als == 'K')
	{
		$nbrClientsTxt = '';
		$nbrClients = count($wkzColl->wkzList($maatje->id));
		if($nbrClients == 1)
		{
			$nbrClientsTxt .= ' 1 cliënt';
		}
		else
		{
			if($nbrClients == 0)
				$nbrClientsTxt .= ' geen cliënten';
				else
				$nbrClientsTxt .= $nbrClients . ' cliënten';
		}
	} else 	$nbrClientsTxt = '';
	
	$html .= '	
	
	<tr id="tafel">
		<td class="text-center p-0"><a href="mut_maatje.php?id=' . $maatje->id . '"><i class="fa-solid fa-user"></i></a></td>
		<td class="text-center p-0">' . $maatje->id . '</td>
		<td class="text-left p-0">' . $maatje->achternaam . ', ' . $maatje->voornaam . ' ' . $maatje->tussenvoegsels . '</td>
		<td class="text-left p-0">' . '<span style="display: none;">' .$user->activity . '</span>' . Tools::ConvertTS($user->activity) . '</td>
		<td class="text-left p-0">' . $nbrClientsTxt . '</td>
		<td class="text-left p-0">' .  $emailtxt . '</td>
		<td class="text-left p-0"">' . $maatje->straat . ' ' . $maatje->huisnummer . '</td>
		<td class="text-left p-0">' . $maatje->postcode . '</td>
		<td class="text-left p-0">' . $maatje->woonplaats . '</td>
		<td class="text-left p-0">' . $maatje->telefoonnr . '</td>
		<td';
		if ($curr_user->beheerind > 6)
			$html .= ' class="text-center p-0"><a href="overz_maatjes.php?id=' . $maatje->id . '&del=j"' . ' onclick="return confirm(\'Weet je zeker dat je dit maatje wilt verwijderen?\');"><i class="fa-regular fa-trash-can" style="font-size: 14px;"></i></a>';
		$html .= '</td>
		</tr>
	</tr>';
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.php'); ?>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-table@1.26.0/dist/bootstrap-table.min.css">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.26.0/dist/bootstrap-table.min.js"></script>	
		<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js"></script>

		<style>
		/* Buttons in cellen compacter */
		.fixed-table-container .table.table-sm td .btn {
		  padding: .1rem .25rem;
		  line-height: 1;
		}
		/* Jouw icon class: 1.5em maakt rijen hoger */
		td {
			padding: .15rem .35rem;
			line-height: 1.3rem;        /* 0.7 geeft vaak 'afgeknepen' tekst */
			font-size: .875rem;
			vertical-align: middle;
		}		
		#toolbar {
			margin: 0;
		}
			
		</style>
	</head>
	<body style="background-color: #dddddd;">
		
		<div class="container">
			<?php include('../includes/navbar.php'); ?>
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
		  <div class="row mt-4">
			<div class="col-12">
			  <div class="d-flex flex-wrap align-items-center gap-2">		
				<!-- Links -->
				<div class="d-flex flex-wrap align-items-center gap-2">
				  <a class="btn btn-primary mr-2" style="min-width:140px" href="beheer.php">Menu</a>
				  <a class="btn btn-primary mr-2" style="min-width:140px" href="aanmelding_mtj.php">Nieuw maatje</a>
				  <a class="btn btn-primary mr-2" style="min-width:140px" href="photolib.php?q=mtj">Foto's</a>
				</div>
		
				<!-- Spacer -->
				<div class="flex-grow-1"></div>
		
				<!-- Rechts -->
				<div class="d-flex align-items-center gap-2">
				  <label for="sel1" class="mb-0">Toon</label>
		
				  <form method="POST" action="overz_maatjes.php" class="mb-0">
					<select name="selection" class="form-control" id="sel1"
							style="min-width:170px"
							onchange="this.form.submit()">
					  <option value="mtj" <?php if($selection == 'mtj') echo 'selected'; ?>>maatjes</option>
					  <option value="ext" <?php if($selection == 'ext') echo 'selected'; ?>>externen</option>
					  <option value="all" <?php if($selection == 'all') echo 'selected'; ?>>iedereen</option>
					</select>
				  </form>
				</div>		
			  </div>
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
						data-show-columns-search="true"
						data-cookie-id-table="saveId2"
						data-show-export="true"
						data-toolbar="#toolbar"
						data-filter-control="true">
					<thead class="thead-dark">
					<tr>
					<th></th>
					<th data-field="id" data-sortable="true" data-visible="false">id</th>
					<th data-field="achternaam"  data-visible="true" data-sortable="true">naam</th>
					<th data-field="activity" data-sortable="true">laatst actief</th>
					<th data-sortable="true">maatje voor</th>
					<th data-field="emailadres" data-sortable="true">emailadres</th>
					<th data-field="straat" data-sortable="true">adres</th>
					<th data-field="postcode" data-sortable="true">postcode</th>
					<th data-field="woonplaats" data-sortable="true">woonplaats</th>
					<th data-field="telefoonnr" data-sortable="false">telefoonnr</th>
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
		<?php include('../includes/footer.php'); ?>
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
