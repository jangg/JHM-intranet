<!DOCTYPE HTML>
<html lang="nl-NL">
<head>
<?php include('includes/head.inc'); ?>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<script>
$(document).ready(function(){
	$('#p').change, function(){
		$(this).bootstrapToggle('Uit'),
		$(this).bootstrapToggle('Aan'),
		$('#test').html('Toggle: ' + $(this).prop('checked'))
		// $(this).bootstrapToggle({
		// 	data-on: 'Yes',
		// 	data-off: 'No'
		// 	});
		});
	});

</script>
	<body>
		<label>meldt zich online bij de meeting&nbsp;&nbsp;</label>
		<input type="checkbox" id="p" name="userid" data-toggle="toggle" data-size="sm" data-onstyle="success" data-offstyle="secondary" checked data-width="80px">
		<div id="test">Nu volgt ....</div>
		
		<input type="checkbox" data-toggle="toggle" data-on="Enabled" data-off="Disabled">
		<input type="checkbox" id="toggle-two">
		<script>
		  $(function() {
			$('#toggle-two').bootstrapToggle({
			  on: 'Jawel',
			  off: 'Nietes'
			});
		  })
		</script>
	</body>
</html>
