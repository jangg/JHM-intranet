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
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>
		<link href="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.css" rel="stylesheet">
		
		<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/bootstrap-table-locale-all.min.js"></script>
		<script src="https://unpkg.com/bootstrap-table@1.18.1/dist/extensions/export/bootstrap-table-export.min.js"></script>
		
		<style>
		  .select,
		  #locale {
			width: 100%;
		  }
		  .like {
			margin-right: 10px;
		  }
		</style>
		
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
					<div id="toolbar">
						<button id="remove" class="btn btn-danger" disabled>
							<i class="fa fa-trash"></i> Delete
						</button>
					</div>
					<table
					  id="table"
					  data-toolbar="#toolbar"
					  data-search="true"
					  data-show-refresh="true"
					  data-show-toggle="true"
					  data-show-fullscreen="true"
					  data-show-columns="true"
					  data-show-columns-toggle-all="true"
					  data-detail-view="true"
					  data-show-export="true"
					  data-click-to-select="true"
					  data-detail-formatter="detailFormatter"
					  data-minimum-count-columns="2"
					  data-show-pagination-switch="true"
					  data-pagination="true"
					  data-id-field="id"
					  data-page-list="[10, 25, 50, 100, all]"
					  data-show-footer="true"
					  data-side-pagination="server"
					  data-url="https://examples.wenzhixin.net.cn/examples/bootstrap_table/data"
					  data-response-handler="responseHandler">
					</table>
				</div>
			</div>
		</div>
		<?php include('../includes/footer.inc'); ?>
		<script>
			  var $table = $('#table')
			  var $remove = $('#remove')
			  var selections = []
			
			  function getIdSelections() {
				return $.map($table.bootstrapTable('getSelections'), function (row) {
				  return row.id
				})
			  }
			
			  function responseHandler(res) {
				$.each(res.rows, function (i, row) {
				  row.state = $.inArray(row.id, selections) !== -1
				})
				return res
			  }
			
			  function detailFormatter(index, row) {
				var html = []
				$.each(row, function (key, value) {
				  html.push('<p><b>' + key + ':</b> ' + value + '</p>')
				})
				return html.join('')
			  }
			
			  function operateFormatter(value, row, index) {
				return [
				  '<a class="like" href="javascript:void(0)" title="Like">',
				  '<i class="fa fa-heart"></i>',
				  '</a>  ',
				  '<a class="remove" href="javascript:void(0)" title="Remove">',
				  '<i class="fa fa-trash"></i>',
				  '</a>'
				].join('')
			  }
			
			  window.operateEvents = {
				'click .like': function (e, value, row, index) {
				  alert('You click like action, row: ' + JSON.stringify(row))
				},
				'click .remove': function (e, value, row, index) {
				  $table.bootstrapTable('remove', {
					field: 'id',
					values: [row.id]
				  })
				}
			  }
			
			  function totalTextFormatter(data) {
				return 'Total'
			  }
			
			  function totalNameFormatter(data) {
				return data.length
			  }
			
			  function totalPriceFormatter(data) {
				var field = this.field
				return '$' + data.map(function (row) {
				  return +row[field].substring(1)
				}).reduce(function (sum, i) {
				  return sum + i
				}, 0)
			  }
			
			  function initTable() {
				$table.bootstrapTable('destroy').bootstrapTable({
				  height: 750,
				  // locale: $('#locale').val(),
				  locale: 'nl-NL',
				  columns: [
					[{
					  field: 'state',
					  checkbox: true,
					  rowspan: 2,
					  align: 'center',
					  valign: 'middle'
					}, {
					  field: 'id',
					  title: 'ID',
					  rowspan: 2,
					  align: 'center',
					  valign: 'middle',
					  sortable: true,
					  footerFormatter: totalTextFormatter
					}, {
					  field: 'name',
					  title: 'Item Name',
					  sortable: true,
					  footerFormatter: totalNameFormatter,
					  align: 'center'
					}, {
					  field: 'price',
					  title: 'Item Price',
					  sortable: true,
					  align: 'center',
					  footerFormatter: totalPriceFormatter
					}, {
					  field: 'operate',
					  title: 'Item Operate',
					  align: 'center',
					  clickToSelect: false,
					  events: window.operateEvents,
					  formatter: operateFormatter
					}]
				  ]
				})
				$table.on('check.bs.table uncheck.bs.table ' +
				  'check-all.bs.table uncheck-all.bs.table',
				function () {
				  $remove.prop('disabled', !$table.bootstrapTable('getSelections').length)
			
				  // save your data, here just save the current page
				  selections = getIdSelections()
				  // push or splice the selections if you want to save all data selections
				})
				$table.on('all.bs.table', function (e, name, args) {
				  console.log(name, args)
				})
				$remove.click(function () {
				  var ids = getIdSelections()
				  $table.bootstrapTable('remove', {
					field: 'id',
					values: ids
				  })
				  $remove.prop('disabled', true)
				})
			  }
			
			  $(function() {
				initTable()
			
				$('#locale').change(initTable)
			  })
			</script>
	</body>
</html>
