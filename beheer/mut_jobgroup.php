<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_jobgroup.php');
include_once('../class/c_maatje.php');
include_once('../class/c_werkzoekende_coll.php');
include_once('../class/c_jgsessie_coll.php');

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
	$_SESSION['jobgroup_id'] = $_GET['id'];
	/* Haal de jobgroup op */
	$jgp = new Jobgroup ('id', $_SESSION['jobgroup_id']);
	/* En haal de bijbehorende jobgroupsessies op */
	$arr1 = array (array (0 => 'jgsessie.id_jobgroup', 1 => $jgp->id));
	$arr2 = array (array (0 => 'jgsessie.datetime_start', 1 => 'ASC'));
	$jgsessieColl = new Jgsessie_coll ($arr1, $arr2);
	$jgsessie = new Jgsessie ();
}
else
{
	$_SESSION['jobgroup_id'] = '0';
	$jgp = new Jobgroup ();
	$jgsessieColl = new Jgsessie_coll ();
	$jgsessie = new Jgsessie ();
}

/* maak de HTML voor de sessies op */
$i = 0;
$sessieHTML = '';
foreach ($jgsessieColl->jgsessieColl as $jgsessie)
{
	if ($jgsessie->id_locatie != '')
	{
		$locatie = $jgsessie->id_locatie;
	} else
	{
		if ($jgp->onlineInd == 'j')
			$locatie = 'online';
			else
			$locatie = $jgp->id_locatie;
	}
	$i++;
	$sessieHTML .= '
	<tr>
		<td>' . $i . '</td>
		<td>' . Tools::ConvertTS2($jgsessie->datetime_start, 'weekdag') . ' ' . Tools::ConvertTS2($jgsessie->datetime_start, 'datum') . '</td>
		<td>' . Tools::ConvertTS2($jgsessie->datetime_start, 'tijd') . ' - ' . Tools::ConvertTS2($jgsessie->datetime_end, 'tijd') . '</td>
		<td>' . $jgsessie->titel . '</td>
		<td>' . $locatie . '</td>
		<td>
			<button class="mod" data-idjs='. $jgsessie->id . '><i class="fas fa-edit ifont" /></i></button>
			<button class="del" data-idjs='. $jgsessie->id . '><i class="fa fa-trash-alt ifont"></i></button>
		</td>
	</tr>';
}
if ($sessieHTML == '')
	$sessieHTML = '<tr><td>Geen sessies bekend</td></tr>';
$sessieHTML .= '
<tr><td></td><td></td><td></td><td></td><td></td>
	<td><button id="addJs" name="addJs" value="voegtoe" type="submit" disabled><i id="mod" class="fas fa-plus ifont" /></i></button></td>
</tr>';

/*Haal alle deelnemers op */
$arr1 = array (array (0 => 'werkzkd.id_jobgroup', 1 => $jgp->id));
$arr2 = array (array (0 => 'person.achternaam', 1 => 'ASC'));
$wkzColl = new Werkzoekende_coll ($arr1, $arr2);
$i = 0;
$wkzHTML = '';
foreach ($wkzColl->werkzoekendeColl as $wkz)
{
	$i++;
	$wkzHTML .= '
	<tr>
		<td>' . $i . '</td>
		<td>' . $wkz->achternaam . '</td>
		<td>' . $wkz->voornaam . ' ' . $wkz->tussenvoegsels . '</td>
		<td>' . $wkz->emailadres . '</td>
		<td>' . $wkz->telefoonnr . '</td>
		<td>' . $wkz->status . '</td>
		<td>
			<button class="wkzmut" data-idwkz=' . $wkz->id . ' data-idjg=' . $jgp->id . '><i class="fas fa-edit ifont" /></i></button>
			<button class="wkzdel" data-idwkz=' . $wkz->id . '><i class="fa fa-trash-alt ifont"></i></button>
		</td>
	</tr> ';
}
if ($wkzHTML == '')
	$wkzHTML = '<tr><td>Geen deelnemers bekend</td></tr>';
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>
	<script>
	
	$(document).ready(function() {
		$('#onlineIndJa').on('click', function()
		{
			//alert ('value = ja');
			$('#locatie').val('---');
		});
		
		if($('#jg-titel').length > 0 && $('#jg-titel').val() != '')
		{
			$('#addJs').prop('disabled', function(i, v) { return !v; });
		}

		$('.del').on('click', function() 
		{
			const el = this;
			const deleteid = $(this).data('idjs');
			if (confirm('Weet u het zeker?')) 
			{
				$.ajax(
				{
					url: 'proces_jg.php',
					type: 'POST',
					data:	{ idjs: deleteid,
							  delJs: 'delete'
					 	   	},
					success: function(response)
					{
						$(el).closest('tr').css('background','tomato');
						$(el).closest('tr').fadeOut(800,function()
						{
				   	 		$(this).remove();
						});
						// alert('Het is gelukt!');
					}
				});
			}
		});
	
		$('#addJs').on('click', function() {
			$("#sessieData").css("display", "block");
		});
		
		$('.mod').on('click', function() 
		{
			const el = this;
			const modid = $(this).data('idjs');
			$.ajax(
			{
				url: 'proces_jg.php',
				type: 'POST',
				data:	{ idjs: modid,
					  modJs: 'modify'
						},
				datatype: 'json',
				success: function(response)
				{
					const r = JSON.parse(response);
					// alert(response);
					$("#sessieData").css("display", "block");
					// $('#js-titel').val(r.titel);
					$('#js-startdate').val(r.datetime_start.substring(0,10));
					$('#js-starttime').val(r.datetime_start.substring(11,16));
					$('#js-endtime').val(r.datetime_end.substring(11,16));
					$('#js-locatie').val(r.id_locatie);
					//$('#js-titel').val(r.titel);
					const s = $('#formjs').attr('action');
					const ns = s.replace ('##idjs##', r.id);
					$('#formjs').attr('action', ns);
					$('#js-titel').val(r.titel);
				},
				error: function (request, status, error) 
				{
					console.log(request.responseText);
				}
			});
		});
		
		$('.wkzdel').on('click', function() 
		{
			const el = this;
			const deleteid = $(this).data('idwkz');
			if (confirm('Weet u het zeker?')) 
			{
				$.ajax(
				{
					url: 'proces_jg.php',
					type: 'POST',
					data:	{ idwkz: deleteid,
							  delWkz: 'delete'
								},
					success: function(response)
					{
						$(el).closest('tr').css('background','tomato');
						$(el).closest('tr').fadeOut(800,function()
						{
								$(this).remove();
						});
						// alert('Het is gelukt!');
					}
				});
			}
		});
		
		$('.wkzmut').on('click', function() 
		{
			const mutid = $(this).data('idwkz');
			window.location.replace ("mut_persoon.php?id=" + mutid);
		});
		
		$("#js-startdate" ).datepicker(
		{
			dateFormat: "yy-mm-dd",
			minDate: "2020-01-01",
			maxDate: "2025-01-01",
			// changeMonth: true,
			// changeYear: true,
		});
		$('div.ui-datepicker').css({ fontSize: '0.9em' });
	});
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
				<h1 class="mx-auto">Jobgroup</h1>
			</div>
		</div>
        <div class="container" style="padding-bottom: 10px;">
			<div class="row">
				<div class="col-12 bg-light mt-2 pt-2">
					<form method="POST" action="proces_jg.php" id="postmt" novalidate>
					<div class="row header rounded text-white p-1 m-1"  style="background-color: #304280;">
						<h4 class="mx-auto">jobgroup gegevens</h1>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Titel</span>
						</div>
						<input id="jg-titel" type="text" name="titel" class="form-control" value="<?php echo $jgp->titel ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Omschrijving</span>
						</div>
						<textarea type="text" name="omschrijving" class="form-control" rows="6"><?php echo $jgp->omschrijving; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Status</span>
						</div>
						<select class="form-control"  name="status" id="status">
							<option value="000" <?php if($jgp->status == '000') echo 'selected'; ?>>---</option>
							<option value="100" <?php if($jgp->status == '100') echo 'selected'; ?>>100 In voorbereiding</option>
							<option value="200" <?php if($jgp->status == '200') echo 'selected'; ?>>200 Geplanned</option>
							<option value="500" <?php if($jgp->status == '500') echo 'selected'; ?>>500 Aan de gang</option>
							<option value="700" <?php if($jgp->status == '700') echo 'selected'; ?>>700 Afgesloten</option>
							<option value="710" <?php if($jgp->status == '710') echo 'selected'; ?>>710 Uitgesteld</option>
							<option value="720" <?php if($jgp->status == '720') echo 'selected'; ?>>720 Afgelast</option>
						</select>
					</div>

					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Soort training</span>
						</div>
						<select class="form-control"  name="soort" id="soort">
							<option value="" <?php if($jgp->soort == '') echo 'selected'; ?>>---</option>
							<option value="Algm" <?php if($jgp->soort == 'Algm') echo 'selected'; ?>>Algemeen</option>
							<option value="iWIN" <?php if($jgp->soort == 'iWIN') echo 'selected'; ?>>Ik Werk In Nederland</option>
							<option value="ZZP" <?php if($jgp->soort == 'ZZP') echo 'selected'; ?>>ZZP'ers</option>
							<option value="BBN" <?php if($jgp->soort == 'BBN') echo 'selected'; ?>>ism de Binnenbaan</option>
						</select>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text text-left text-wrap" style="width: 100%;">Online training</span>
						</div>
						<div class="pl-3 pt-1" style="font-size: .9em;">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="onlineInd" id="onlineIndJa" value="j" <?php if($jgp->onlineInd == 'j') echo ' checked'; ?>>
								<label class="form-check-label" for="onlineInd">&nbsp;Ja</label>
							</div>
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="onlineInd" id="onlineIndNee" value="n"<?php if($jgp->onlineInd == 'n') echo ' checked'; ?>>
								<label class="form-check-label" for="onlineInd">&nbsp;Nee</label>
							</div>
						</div>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Locatie</span>
						</div>
						<select class="form-control"  name="locatie" id="locatie">
							<option value="---" <?php if($jgp->id_locatie == '---') echo 'selected'; ?>>---</option>
							<option value="Forum/bibliotheek ruimte 1" <?php if($jgp->id_locatie == 'Forum/bibliotheek ruimte 1') echo 'selected'; ?>>Forum trainingsruimte 1</option>
							<option value="Forum/bibliotheek ruimte 2" <?php if($jgp->id_locatie == 'Forum/bibliotheek ruimte 2') echo 'selected'; ?>>Forum trainingsruimte 2</option>
							<option value="De Kapelaan foyer" <?php if($jgp->id_locatie == 'De Kapelaan foyer') echo 'selected'; ?>>De Kapelaan foyer</option>
							<option value="ShareBiz" <?php if($jgp->id_locatie == 'ShareBiz') echo 'selected'; ?>>ShareBiz</option>
							<option value="Buurthuis Buytenwegh" <?php if($jgp->id_locatie == 'Buurthuis Buytenwegh') echo 'selected'; ?>>Buurthuis Buytenwegh</option>
						</select>

					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Startdatum</span>
						</div>
						<input type="text" name="startdate" class="form-control" value="<?php							 
								echo count($jgsessieColl->jgsessieColl) != 0 ? Tools::ConvertTS2($jgsessieColl->jgsessieColl[0]->datetime_start, 'datum') : 'nnb'; 
							?>
							" disabled>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Aantal sessies</span>
						</div>
						<input type="text" name="nbrSessies" class="form-control" value="<?php echo $jgp->nbrSessies(); ?>" disabled>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Aantal plaatsen</span>
						</div>
						<input type="text" name="nbrPlaatsen" class="form-control" value="<?php echo $jgp->nbrPlaatsen; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Jobgroupleider 1</span>
						</div>
						<input type="text" name="jgleider1" class="form-control" value="<?php echo $jgp->jgleider1; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Jobgroupleider 2</span>
						</div>
						<input type="text" name="jgleider2" class="form-control" value="<?php echo $jgp->jgleider2; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Opmerkingen</span>
						</div>
						<textarea type="text" name="opmerkingen" class="form-control" rows="6"><?php echo $jgp->opmerkingen; ?></textarea>
					</div>
					<div class="forms-group mb-1">
						<button name="updateJgBut" value="wijzig" type="submit" class="btn btn-primary btn-width btn-sm">Wijzig</button>
						<button name="backJgBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button>
						<button <button name="deleteJgBut" value="delete" type="submit" class="btn btn-danger btn-width btn-sm" style="float: right;" data-id="<?= $jgp->id ?>">Delete</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<div class="container" style="padding-bottom: 10px;">
			<div class="row">
				<div class="col-12 bg-light mt-2 pt-2">
					<div class="row header rounded text-white p-1 m-1"  style="background-color: #304280;">
						<h4 class="mx-auto">sessies</h1>
					</div>
					<table class="table table-sm" style="font-size: 0.9em;">
						<thead>
						<tr>
						<th>#</th>
						<th>Datum</th>
						<th>Tijd</th>
						<th>Omschrijving</th>
						<th>Locatie</th>
						<th></th>
						</tr>
						</thead>
						<tbody>
						<?php
							echo $sessieHTML;
						?>
						</tbody>
					</table>
					<div>
						<?php if ($sessieHTML == '') echo 'geen sessies bekend'; ?>
					</div>

					<!-- Hieronder de code voor de jgsessie mutaties -->
					<div id="sessieData" style="display: none;">
						<form method="POST" action="proces_jg.php?id=<?= $_SESSION['jobgroup_id'] ?>&idjs=##idjs##" id="formjs" novalidate>
						<div class="header rounded text-white p-1 m-1 text-center"  style="background-color: #304280;">
							<h4 class="mx-auto">sessie gegevens</h1>
						</div>
						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class=" input-group-text" style="width: 100%;">Datum</span>
							</div>
							<input type="text" id="js-startdate" name="js-startdate" class="form-control" value="">
							<!-- <input id="js-startdate" type="text" name="js-startdate" class="form-control" value="<?php // echo substr($jgsessie->datetime_start, 0, 10); ?>" placeholder="jjjj-mm-dd"> -->
						</div>
						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class=" input-group-text" style="width: 100%;">Starttijd</span>
							</div>
							<select class="form-control"  name="js-starttime" id="js-starttime">
								<?= Tools::timeSelection() ?>
							</select>
						</div>
						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class=" input-group-text" style="width: 100%;">Eindtijd</span>
							</div>
							<select class="form-control"  name="js-endtime" id="js-endtime">
								<?= Tools::timeSelection() ?>
							</select>
						</div>
						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
							  <span class="input-group-text" style="width: 100%;">Omschrijving</span>
							</div>
							<input id="js-titel" type="text" name="js-titel" class="form-control" value="<?php // echo $jgsessie->titel; ?>">
						</div>

						<div class="input-group input-group-sm mb-1">
							<div class="input-group-prepend" style="width: 30%;">
								<span class="input-group-text" style="width: 100%;">Locatie</span>
							</div>
							<input id="js-locatie" type="text" name="js-locatie" class="form-control" value="<?php // echo $jgsessie->id_locatie; ?>" required>
						</div>
						<div class="forms-group mb-1">
							<button name="updateJsBut" value="wijzig" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
							<button name="backJsBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button>
						</div>
						</form>
					</div>
					
				</div>
			</div>
		</div>
		<div class="container" style="padding-bottom: 10px;">
			<div class="row">
				<div class="col-12 bg-light mt-2 pt-2">
					<div class="row header rounded text-white p-1 m-1"  style="background-color: #304280;">
						<h4 class="mx-auto">deelnemers</h1>
					</div>
					<table class="table table-sm" style="font-size: 0.9em;">
						<thead>
						<tr>
						<th>#</th>
						<th>Achternaam</th>
						<th>Voornaam</th>
						<th>Emailadres</th>
						<th>Telefoonnr</th>
						<th>Status</th>
						<th></th>
						</tr>
						</thead>
						<tbody>
						<?php
							echo $wkzHTML;
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
