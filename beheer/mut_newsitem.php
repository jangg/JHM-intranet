<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_newsitem.php');

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
	$_SESSION['newsitem_id'] = $_GET['id'];
	/* Haal de newsitem op */
	$newsitem = new Newsitem ('id', $_SESSION['newsitem_id']);
	
}
else
{
	$_SESSION['newsitem_id'] = '0';
	$newsitem = new Newsitem ();
}
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

		$("#datetime_pub_intern" ).datepicker(
		{
			dateFormat: "yy-mm-dd",
		});
		$("#datetime_pub_extern" ).datepicker(
			{
				dateFormat: "yy-mm-dd",
			});
	
		$('div.ui-datepicker').css({ fontSize: '0.8em' });
	});
	/*  ==========================================
		SHOW UPLOADED IMAGE
		* ========================================== */
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
		
				reader.onload = function (e) {
					$('#imageResult')
						.attr('src', e.target.result);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
		
		$(function () {
			$('#upload').on('change', function () {
				readURL(input);
			});
		});
		
		/*  ==========================================
			SHOW UPLOADED IMAGE NAME
		* ========================================== */
		var input = document.getElementById( 'upload' );
		var infoArea = document.getElementById( 'upload-label' );
		
		input.addEventListener( 'change', showFileName );
		function showFileName( event ) {
		  var input = event.srcElement;
		  var fileName = input.files[0].name;
		  infoArea.textContent = 'File name: ' + fileName;
		}


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
				<h1 class="mx-auto">Nieuwsbericht</h1>
			</div>
		</div>
        <div class="container" style="padding-bottom: 10px;">
			<div class="row">
				<div class="col-12 bg-light mt-2 pt-2">
					<form method="POST" action="proces_newsitem.php" enctype="multipart/form-data" novalidate>
					<div class="row header rounded text-white p-1 m-1"  style="background-color: #304280;">
						<h4 class="mx-auto">nieuwsbericht gegevens</h1>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Datum gemaakt</span>
						</div>
						<input id="datetime_created" type="text" name="datetime_created" class="form-control" value="<?php echo $newsitem->datetime_created ?>" disabled>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Datum gewijzigd</span>
						</div>
						<input id="datetime_modified" type="text" name="datetime_modified" class="form-control" value="<?php echo $newsitem->datetime_modified ?>" disabled>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Titel</span>
						</div>
						<input id="jg-titel" type="text" name="titel" class="form-control" value="<?php echo $newsitem->titel ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Subtitel</span>
						</div>
						<textarea type="text" name="subtitel" class="form-control" rows="3"><?php echo $newsitem->subtitel; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 100%;">
							<span class=" input-group-text" style="width: 100%;">Tekst</span>
						</div>
						<textarea style="width: 100%;" type="text" name="tekst" class="form-control summernote" rows="8"><?php echo $newsitem->tekst; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 100%;">
							<span class=" input-group-text" style="width: 100%;">Korte tekst</span>
						</div>
						<textarea type="text" name="tekst_kort" class="form-control summernote" rows="5"><?php echo $newsitem->tekst_kort; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 100%;">
							<span class=" input-group-text" style="width: 100%;">Samenvatting</span>
						</div>
						<textarea type="text" name="tekst_samenvatting" class="form-control summernote" rows="5"><?php echo $newsitem->tekst_samenvatting; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Button tekst</span>
						</div>
						<input id="tekst_knop" type="text" name="tekst_knop" class="form-control" value="<?php echo $newsitem->tekst_knop ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Button link</span>
						</div>
						<input id="link_knop" type="text" name="link_knop" class="form-control" value="<?php echo $newsitem->link_knop ?>">
					</div>
					<div class="input-group input-group-sm mb-2">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text text-left text-wrap" style="width: 100%;">Intern publiceren</span>
						</div>
						<input type="checkbox" name="pubind_intern" class="form-control" value="j" style="margin-left: 15px;" <?php if($newsitem->pubind_intern == 'j') echo ' checked'; ?>>									
					</div>
					
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Datum interne publicatie</span>
						</div>
						<input id="datetime_pub_intern" type="text" name="datetime_pub_intern" class="form-control" value="<?php echo $newsitem->datetime_pub_intern ?>">
					</div>
					<div class="input-group input-group-sm mb-2">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text text-left text-wrap" style="width: 100%;">Extern publiceren</span>
						</div>
						<input type="checkbox" name="pubind_extern" class="form-control" value="j" style="margin-left: 15px;" <?php if($newsitem->pubind_extern == 'j') echo ' checked'; ?>>									
					</div>
					
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Datum externe publicatie</span>
						</div>
						<input id="datetime_pub_extern" type="text" name="datetime_pub_extern" class="form-control" value="<?php echo $newsitem->datetime_pub_extern ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Image filenaam 1</span>
						</div>
						<input id="picfile1" type="text" name="picfile1" class="form-control" value="<?php echo $newsitem->picfile1 ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Image filenaam 2</span>
						</div>
						<input id="picfile2" type="text" name="picfile2" class="form-control" value="<?php echo $newsitem->picfile2 ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Image filenaam 3</span>
						</div>
						<input id="picfile3" type="text" name="picfile3" class="form-control" value="<?php echo $newsitem->picfile3 ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Image filenaam 4</span>
						</div>
						<input id="picfile4" type="text" name="picfile4" class="form-control" value="<?php echo $newsitem->picfile4 ?>">
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
