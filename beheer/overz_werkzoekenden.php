<?php
include_once "../config.php";
include_once "../class/c_user.php";
include_once "../class/c_werkzoekende_coll.php";
include_once "../class/c_maatje.php";
include_once "../class/c_jobgroup.php";

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION["username"])) {
  header("location:../index.php");
  exit();
}

if (isset($_SESSION["userid"])) {
  $curr_user = new User("id", $_SESSION["userid"]);
} else {
  $curr_user = new User();
}
/********************************
werkzoekende verwijderen (delind wordt j)
********************************* */
if (isset($_GET['del']) && $_GET['del'] == 'j') 
{
  $item = new Werkzoekende ('id', $_GET['id']);
  // error_log($item);
  if ($item->delind != 'j') 
  {
    $item->delind = 'j';
    $item->updateToDB();
  }
}


if (isset($_POST["selection"])) {
  $_SESSION["selection"] = $_POST["selection"];
} else {
  if (!isset($_SESSION["selection"])) {
    $_SESSION["selection"] = "act";
  }
}
$selection = $_SESSION["selection"];

$arr1 = [];
$arr2 = [[0 => "werkzkd.status", 1 => "ASC"]];

$wzColl = new Werkzoekende_coll($arr1, $arr2);

$html = "";
$nbr = 0;
// error_log ('Gelukt!');

foreach ($wzColl->werkzoekendeColl as $werkzoekende) {
  /* hier selectie op welke wkz worden getoond */
  $ok = true;
  if ($selection == "new") {
    if ($werkzoekende->status != "000") {
      $ok = false;
    }
  }
  if ($selection == "act") {
    // if ($werkzoekende->status == '000' || $werkzoekende->status > '599') $ok = FALSE;
    if ($werkzoekende->status > "599") {
      $ok = false;
    }
  }
  if ($selection == "non") {
    if ($werkzoekende->status < "600") {
      $ok = false;
    }
  }
  /******************/

  if ($ok) {
    $nbr++;
    $acties = "";
    if ($werkzoekende->id_user_modified != "") {
      $user_modified = new User("id", $werkzoekende->id_user_modified);
    } else {
      $user_modified = new User();
    }

    if ($werkzoekende->status != 0) {
      $acties .=
        '<a href="mut_persoon.php?id=' .
        $werkzoekende->id .
        '"><i class="fa-solid fa-user"></i></a>&nbsp&nbsp&nbsp';
    } else {
      $acties .=
        '<a href="mut_persoon.php?id=' .
        $werkzoekende->id .
        '"><i class="fa-regular fa-user"></i></a>&nbsp&nbsp&nbsp';
    }
    if ($werkzoekende->id_intakeform != "") {
      $acties .=
        '<a href="intake.php?id=' .
        $werkzoekende->id .
        '"><i class="fa-solid fa-file-lines"></i></a>&nbsp&nbsp&nbsp';
    } else {
      $acties .=
        '<a href="intake.php?id=' .
        $werkzoekende->id .
        '"><i class="fa-regular fa-file-lines"></i></a>&nbsp&nbsp&nbsp';
    }
    if ($werkzoekende->emailadres != "") {
      $acties .=
        '<a href="mailto:' .
        $werkzoekende->emailadres .
        '"><i class="fa-regular fa-envelope"></i></a>&nbsp&nbsp&nbsp';
    } else {
      $acties .=
        '<i class="fa-regular fa-envelope" style="opacity: 0;"></i>&nbsp&nbsp&nbsp';
    }
    $acties .= '<a href="overz_werkzoekenden.php?id=' . $werkzoekende->id . '&del=j"' . ' onclick="return confirm(\'Weet je zeker dat je deze werkzoekende wilt verwijderen?\');"><i class="fa-regular fa-trash-can"></i></a>&nbsp&nbsp&nbsp';

    if ($werkzoekende->id_maatje != "") {
      $mtj = new Maatje("id", $werkzoekende->id_maatje);
      $maatje =
        $mtj->voornaam . " " . $mtj->tussenvoegsels . " " . $mtj->achternaam;
    } else {
      $maatje = "";
    }
    if ($werkzoekende->id_jobgroup != "") {
      $jgp = new Jobgroup("id", $werkzoekende->id_jobgroup);
      $jobgroup = $jgp->titel;
    } else {
      $jobgroup = "";
    }
    if ($werkzoekende->status == "000") {
      $trstyle = 'style="background-color: #ffbbb9;";';
    } else {
      $trstyle = '';
    }

    // <td class="p-0">' . '<span style="display: none;">' . $werkzoekende->date_aanmelding . '</span>' . $werkzoekende->date_aanmelding . '</td>
    // <td class="p-0">' . '<span style="display: none;">' . $werkzoekende->datetime_created . '</span>' . substr($werkzoekende->datetime_created, 0, 10) . '</td>
    // <td class="p-0">' . '<span style="display: none;">' . $werkzoekende->datetime_modified . '</span>' . substr($werkzoekende->datetime_modified, 0, 10) . '</td> -->

    $html .=
      '
		<tr ' . $trstyle . '>
			<td class="text-center p-0">' . sprintf("%04d", $werkzoekende->id) . '</td>		
			<td class="text-center p-0">' . $werkzoekende->status . '</td>
			<td class="text-left p-0">' . Tools::getStatusOms($werkzoekende->status) . '</td>
			<td class="text-left p-0">' . $werkzoekende->achternaam . ', ' . $werkzoekende->voornaam . ' ' . $werkzoekende->tussenvoegsels . '</td>
			<td class="text-left p-0">' . $werkzoekende->emailadres . '</td>
			<td class="text-left p-0">' . $werkzoekende->straat . ' ' . $werkzoekende->huisnummer . '</td>
			<td class="text-left p-0">' . $werkzoekende->postcode . ' ' . $werkzoekende->woonplaats . '</td>		
			<td class="text-left p-0">' . $werkzoekende->date_geboorte . '</td>
			<td class="text-left p-0">' . $werkzoekende->link_linkedin . '</td>
			<td class="text-center p-0">' . $werkzoekende->date_aanmelding . '</td>
			<td class="text-center p-0">' . $werkzoekende->date_uitstroom . '</td>
			<td class="text-center p-0">' . substr($werkzoekende->datetime_created, 0, 10) . '</td>
			<td class="text-center p-0">' . substr($werkzoekende->datetime_modified, 0, 10) . '</td>
		    <td class="text-center p-0">' . substr($user_modified->username, 0, 20) . '</td>
			<td class="text-left p-0">' . $werkzoekende->telefoonnr . '</td>
		    <td class="text-left p-0">' . $maatje . '</td>
			<td class="text-left p-0">' . $jobgroup . '</td>
			<td class="text-center p-0 ifont">' . $acties . '</td>
      </tr>';
  }
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include "../includes/head.inc"; ?>
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
			<?php include "../includes/navbar.inc"; ?>
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
						<option value="act" <?php if ($selection == "act") { echo "selected"; } ?>>actieve werkzoekenden</option>
						<option value="non" <?php if ($selection == "non") { echo "selected"; } ?>>niet actieve werkzoekenden</option>
						<option value="all" <?php if ($selection == "all") { echo "selected"; } ?>>alle werkzoekenden</option>
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
							class="data-table table-sm table-striped table-hover"
  							data-toggle="table"
 							data-search="true" 
							data-pagination="true"  
							data-page-size="30" 
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
					<th data-field="id" 		data-sortable="true" 		data-visible="false" class="text-center">id</th>
					<th data-field="statuscode" data-sortable="true" 		data-visible="true" class="text-center">statuscode</th>
					<th data-field="status" 	data-sortable="false"		data-visible="false">status</th>
					<th data-field="naam" 		data-sortable="true" 		data-visible="true">naam</th>
					<th data-field="emailadres" data-sortable="true" 		data-visible="false">emailadres</th>
					<th data-field="straat" 	data-sortable="false" 		data-visible="false">adres</th>
					<th data-field="plaats" 	data-sortable="true" 		data-visible="false">plaats</th>
					<th data-field="gebdatum" 	data-sortable="true" 		data-visible="false">geb.datum</th>
					<th data-field="linkedin" 	data-sortable="true" 		data-visible="false">LinkedIn</th>
					<th data-field="date_aanmelding" data-sortable="true" 	data-visible="true">datum aanmelding</th>
					<th data-field="date_uitstroom" data-sortable="true" 	data-visible="false">datum uitstroom</th>				
					<th data-field="datetime_created" data-sortable="true" 	data-visible="false">datum gemaakt</th>
					<th data-field="datetime_modified" data-sortable="true" data-visible="true">datum gewijzigd</th>				
					<th data-field="user_modified" data-sortable="true" data-visible="true">gewijzigd door</th>				
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
		<?php include "../includes/footer.inc"; ?>
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
