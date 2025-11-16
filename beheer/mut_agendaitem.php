<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_agendaitem.php');

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
	$curr_user->id = '1';
}

if (isset($_GET['id']))
{
	$_SESSION['agendaitem_id'] = $_GET['id'];
	/* Haal de agendaitem op */
	$agendaitem = new Agendaitem ('id', $_SESSION['agendaitem_id']);
	
}
else
{
	$_SESSION['agendaitem_id'] = '0';
	$agendaitem = new Agendaitem ();
}

$user_created = new User ('id', $agendaitem->id_user_created);

?>

<!DOCTYPE html>
<html lang="nl-NL">
	<head>
	<?php include('../includes/head.inc'); ?>
	<link href="../css/style2.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>			
	<script>
		function jumpto(anchor){
			window.location.href = "#"+anchor;
		}
		$(document).ready(function() {
		  // $('.summernote').summernote(
			//   {
			// 	  height: 300,				 // set editor height
			// 	  minHeight: null,			 // set minimum height of editor
			// 	  maxHeight: null,			 // set maximum height of editor
			// 	  lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0'],
			// 	  focus: true,				  // set focus to editable area after initializing summernote
			// 	  disableDragAndDrop: true,
			// 	  shortcuts: true,
			// 	  tabDisable: true,
			// 	  toolbar: [
			// 		  // [groupName, [list of button]]
			// 		  ['style', ['bold', 'italic', 'underline', 'clear']],
			// 		  ['font', ['strikethrough', 'superscript', 'subscript']],
			// 		  ['fontsize', ['fontsize']],
			// 		  ['color', ['color']],
			// 		  ['para', ['ul', 'ol', 'paragraph']],
			// 		  ['height', ['height']],
			// 		  ['insert', ['link']],
			// 		  ['view', ['fullscreen', 'codeview', 'help']]
			// 		 
			// 		]
			//   });
		// $('.note-editable').css('font-size','14px');
		// $('.summernote').summernote('fontSize', 16);

		$("#datum").datepicker(
		{
			dateFormat: "yy-mm-dd",
		});
		$('#begintijd').timepicker(
		{
			timeFormat: 'HH:mm',
			interval: 30,
			minTime: '08:00',
			maxTime: '22:00',
			dynamic: false,
			dropdown: true,
			scrollbar: true
		});	
		$('#eindtijd').timepicker(
		{
			timeFormat: 'HH:mm',
			interval: 30,
			minTime: '08:00',
			maxTime: '22:00',
			dynamic: false,
			dropdown: true,
			scrollbar: true
		});	
		$('div.ui-datepicker').css({ fontSize: '0.8em' });
		$('div.ui-timepicker').css({ fontSize: '0.8em' });
	});
	/*  ==========================================
		SHOW UPLOADED IMAGE
		* ========================================== */
		// function readURL(input) {
		// 	if (input.files && input.files[0]) {
		// 		var reader = new FileReader();
		// 
		// 		reader.onload = function (e) {
		// 			$('#imageResult')
		// 				.attr('src', e.target.result);
		// 		};
		// 		reader.readAsDataURL(input.files[0]);
		// 	}
		// }
		// 
		// $(function () {
		// 	$('#upload').on('change', function () {
		// 		readURL(input);
		// 	});
		// });
		// 
		/*  ==========================================
			SHOW UPLOADED IMAGE NAME
		* ========================================== */
		// var input = document.getElementById( 'upload' );
		// var infoArea = document.getElementById( 'upload-label' );
		// 
		// input.addEventListener( 'change', showFileName );
		// function showFileName( event ) {
		//   var input = event.srcElement;
		//   var fileName = input.files[0].name;
		//   infoArea.textContent = 'File name: ' + fileName;
		// }


	</script>
	<style>
		thead {
			text-align: left;
		}
	</style>				
	</head>
	<body style="background-color: #dddddd;">
		
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container-fluid"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto">Agenda item</h1>
			</div>
		</div>
        <div class="container" style="padding-bottom: 10px;">
			<div class="row">
				<div class="col-12 bg-light mt-2 pt-2">
					<form method="POST" action="proces_agendaitem.php" enctype="multipart/form-data" novalidate>
					<div class="row header rounded text-white p-1 m-1"  style="background-color: #304280;">
						<h4 class="mx-auto">Agendaitem gegevens</h1>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Datum gemaakt</span>
						</div>
						<input id="datetime_created" type="text" name="datetime_created" class="form-control" value="<?php echo $agendaitem->datetime_created; ?>" disabled>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Datum gewijzigd</span>
						</div>
						<input id="datetime_modified" type="text" name="datetime_modified" class="form-control" value="<?php echo $agendaitem->datetime_modified; ?>" disabled>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Laatst gewijzigd door</span>
						</div>
						<input id="user_created" type="text" name="user_created" class="form-control" value="<?php echo $user_created->username; ?>" disabled>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Datum start</span>
						</div>
						<input id="datum" type="text" name="datum" class="form-control" value="<?php echo $agendaitem->datum; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Begin tijd</span>
						</div>
						<input id="begintijd" type="text" name="begintijd" class="form-control" value="<?php echo substr($agendaitem->begintijd, 0, 5); ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Eind tijd</span>
						</div>
						<input id="eindtijd" type="text" name="eindtijd" class="form-control" value="<?php echo substr($agendaitem->eindtijd, 0, 5); ?>">
					</div>

					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Titel</span>
						</div>
						<input id="titel" type="text" name="titel" class="form-control" value="<?php echo $agendaitem->titel; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 100%;">
							<span class=" input-group-text" style="width: 100%;">Omschrijving</span>
						</div>
						<textarea style="width: 100%;" type="text" name="omschrijving" class="form-control summernote" rows="8"><?php echo $agendaitem->omschrijving; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Locatie</span>
						</div>
						<input id="locatie" type="text" name="locatie" class="form-control" value="<?php echo $agendaitem->locatie; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Organisator</span>
						</div>
						<input id="organisator" type="text" name="organisator" class="form-control" value="<?php echo $agendaitem->organisator; ?>">
					</div>

					<div class="input-group input-group-sm mb-2">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text text-left text-wrap" style="width: 100%;">Intern publiceren</span>
						</div>
						<input type="checkbox" name="pubind_intern" class="form-control" value="j" style="margin-left: 15px;" <?php if($agendaitem->publmed == '2' || $agendaitem->publmed == '3') echo ' checked'; ?>>									
					</div>
					<div class="input-group input-group-sm mb-2">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text text-left text-wrap" style="width: 100%;">Publiek publiceren</span>
						</div>
						<input type="checkbox" name="pubind_extern" class="form-control" value="j" style="margin-left: 15px;" <?php if($agendaitem->publmed == '1' || $agendaitem->publmed == '3') echo ' checked'; ?>>									
					</div>
					
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Vrij veld 1</span>
						</div>
						<input id="freefld1" type="text" name="freefld1" class="form-control" value="<?php echo $agendaitem->freefld1; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Vrij veld  2</span>
						</div>
						<input id="freefld2" type="text" name="freefld2" class="form-control" value="<?php echo $agendaitem->freefld2; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Vrij veld  3</span>
						</div>
						<input id="freefld3" type="text" name="freefld3" class="form-control" value="<?php echo $agendaitem->freefld3; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Vrij veld  4</span>
						</div>
						<input id="freefld4" type="text" name="freefld4" class="form-control" value="<?php echo $agendaitem->freefld4; ?>">
					</div>
					<!-- <div class="input-group input-group-sm mb-2">
						<!-- <div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text text-left text-wrap" style="width: 100%;">Nieuwsplaatje</span>
						</div> -->
						<!-- <div class="input-group mb-3 px-2 py-2 bg-white shadow-sm"> --
							<input id="upload" type="file" onchange="readURL(this);" name="chooseimage" class="form-control border-0">
							<label id="upload-label" for="upload" class="font-weight-light text-muted">Kies een plaatje</label>
							<div class="input-group-append">
								<label for="upload" class="btn btn-light m-0 px-4"> <i class="fa fa-cloud-upload mr-2 text-muted text-dark"></i><small class="text-uppercase font-weight-bold text-muted">Kies een plaatje</small></label>
							</div>
							<!-- Uploaded image area-->
							
						<!-- </div> --
						<span class="font-italic text-white text-center">De foto wordt hier weergegeven.</span>
						<div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
					</div> -->
					
					<div class="forms-group my-3">
						  <button name="saveNiBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
						  <button name="backNiBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button>
					  </div>
					</form>
				</div>
			</div>
		</div>
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
