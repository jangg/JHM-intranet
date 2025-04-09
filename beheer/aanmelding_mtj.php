<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_maatje.php');

function calculateAge($date)
{
	// $birthDate = "12/17/1983";
	  //explode the date to get month, day and year
	  $birthDate = explode("-", $date);
	  //get age from date or birthdate
	  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
		? ((date("Y") - $birthDate[0]) - 1)
		: (date("Y") - $birthDate[0]));
	  return $age;
}
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

if (isset($_POST['backMtBut']) && $_POST['backMtBut'] == 'back')
{
	header("location: beheer.php");
	exit();	
}

$mtj = new Maatje ();

if (isset($_POST['saveMtBut']) && $_POST['saveMtBut'] == 'bewaar')
{
	// $mtj_nw = clone $mtj;
	$mtj->voornaam				= $_POST['voornaam'];
	$mtj->achternaam			= $_POST['achternaam'];
	$mtj->tussenvoegsels		= $_POST['tussenvoegsels'];
	$mtj->straat				= $_POST['straat'];
	$mtj->huisnummer			= $_POST['huisnummer'];
	$mtj->postcode				= $_POST['postcode'];
	$mtj->woonplaats			= $_POST['woonplaats'];
	$mtj->emailadres			= $_POST['emailadres'];
	$mtj->telefoonnr			= $_POST['telefoonnr'];
	$mtj->link_linkedin			= $_POST['link_linkedin'];
	if (Tools::checkDate($_POST['date_geboorte'], 'jjjj-mm-dd'))
		$mtj->date_geboorte		= $_POST['date_geboorte'];
	$mtj->omschrijving			= $_POST['omschrijving'];
	$mtj->functie				= $_POST['functie'];
	$mtj->type					= 'mtj';
		
	if (isset($_POST['mtjcrt_ind'])) $mtj->mtjcrt_ind = $_POST['mtjcrt_ind']; else $mtj->mtjcrt_ind = 'n';
	if (isset($_POST['actiefmtj']))
	{
		if ($mtj->actief_als == 'B' || $mtj->actief_als == 'K') $mtj->actief_als = 'K';
		else
			$mtj->actief_als = 'A';
	} else
	{
		if ($mtj->actief_als == 'K') $mtj->actief_als = 'B';
		else
			{if ($mtj->actief_als == 'A')  $mtj->actief_als = '';}
	}
	
	if (isset($_POST['jglcrt_ind'])) $mtj->jglcrt_ind = $_POST['jglcrt_ind']; else $mtj->jglcrt_ind = 'n';
	if (isset($_POST['actiefjgl']))
	{
		if ($mtj->actief_als == 'A' || $mtj->actief_als == 'K') $mtj->actief_als = 'K';
		else
			$mtj->actief_als = 'B';

	} else
	{
		if ($mtj->actief_als == 'K') $mtj->actief_als = 'A';
		else
			{if ($mtj->actief_als == 'B')  $mtj->actief_als = '';}
	}

	if ($mtj->achternaam != '' && $mtj->emailadres != '')
	{
		$mtj->saveToDB();
	}
	/* start de page opnieuw om een tweede update te voorkomen */
	header("location: aanmelding_mtj.php");
	exit();	
}

?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>
	<script>
		$(document).ready(function() {
			$("#date_geboorte" ).datepicker(
				{
					dateFormat: "yy-mm-dd",
					minDate: "1950-01-01",
					maxDate: "2004-12-31",
					changeMonth: true,
					changeYear: true,
				});
			$('div.ui-datepicker').css({ fontSize: '0.9em' });
			
			if($("#mtjcrt_ind").prop("checked")) {
				$("#actiefmtj").attr("disabled", false);
			} else {
				$("#actiefmtj").prop("checked"), false;
				$("#actiefmtj").attr("disabled", true);
			}
			$("#mtjcrt_ind").click(function() {
				if($("#mtjcrt_ind").prop("checked") === false) {
					$("#actiefmtj").prop("checked", false);
					$("#actiefmtj").attr("disabled", true);
				} else {
					$("#actiefmtj").attr("disabled", false);
				}
			});
			if($("#jglcrt_ind").prop("checked")) {
				$("#actiefjgl").attr("disabled", false);
			} else {
				$("#actiefjgl").prop("checked"), false;
				$("#actiefjgl").attr("disabled", true);
			}
			$("#jglcrt_ind").click(function() {
				if($("#jglcrt_ind").prop("checked") === false) {
					$("#actiefjgl").prop("checked", false);
					$("#actiefjgl").attr("disabled", true);
				} else {
					$("#actiefjgl").attr("disabled", false);
				}
			});
			$("#saveMtBut").click(function (event){
				if ($("#achternaam").val() === '') {
					event.preventDefault();
					alert("Achternaam is verplicht");
					$("#achternaam").focus();
				} else {
				if ($("#emailadres").val() === '') {
						event.preventDefault();
						alert("Emailadres is verplicht");
						$("#emailadres").focus();
					}}
			});				
		});
		</script>		
	</head>
	<body style="background-color: #dddddd;">
		
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto">Aanmelding nieuw maatje</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
        <div class="container" style="padding-bottom: 80px;">	
			<form method="POST" action="aanmelding_mtj.php" novalidate>
			<div class="row">
				<div class="col-12 bg-light mt-2 pt-2">
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Voornaam</span>
						</div>
						<input type="text" name="voornaam" class="form-control" value="<?php echo $mtj->voornaam; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Tussenvoegsels</span>
						</div>
						<input type="text" name="tussenvoegsels" class="form-control" value="<?php echo $mtj->tussenvoegsels; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Achternaam</span>
						</div>
						<input type="text" id="achternaam" name="achternaam" class="form-control" value="<?php echo $mtj->achternaam; ?>" required>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Emailadres</span>
						</div>
						<input type="email" id="emailadres" name="emailadres" class="form-control" value="<?php echo $mtj->emailadres; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Telefoonnummer</span>
						</div>
						<input type="text" id="telefoonnr" name="telefoonnr" class="form-control" value="<?php echo $mtj->telefoonnr; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">URL LinkedIn</span>
						</div>
						<input type="text" name="link_linkedin" class="form-control" value="<?php echo $mtj->link_linkedin; ?>">
					</div>					
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Straat</span>
						</div>
						<input type="text" name="straat" class="form-control" value="<?php echo $mtj->straat; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Huisnummer</span>
						</div>
						<input type="text" name="huisnummer" class="form-control" value="<?php echo $mtj->huisnummer; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Postcode</span>
						</div>
						<input type="text" name="postcode" class="form-control" value="<?php echo $mtj->postcode; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Woonplaats</span>
						</div>
						<input type="text" name="woonplaats" class="form-control" value="<?php echo $mtj->woonplaats; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Geboortedatum</span>
						</div>
						<input type="text" name="date_geboorte" id="date_geboorte" class="form-control" value="<?= $mtj->date_geboorte; ?>" placeholder="jjjj-mm-dd"></p>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Leeftijd</span>
						</div>
						<input type="text" class="form-control" value="<?php if ($mtj->date_geboorte != '') echo calculateAge($mtj->date_geboorte); else echo ''; ?>" disabled>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Functie</span>
						</div>
						<textarea type="textarea" name="functie" rows="5" class="form-control" value=""><?php echo $mtj->functie; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Maatje certificaat behaald</span>
						</div>
						<input type="checkbox" name="mtjcrt_ind" id="mtjcrt_ind" class="form-control" value="j" style="margin-left: 15px;" <?php if($mtj->mtjcrt_ind == 'j') echo ' checked'; ?>>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Actief als maatje</span>
						</div>
						<input type="checkbox" name="actiefmtj" id="actiefmtj" class="form-control" value="j" style="margin-left: 15px;" <?php if($mtj->actief_als == 'A' || $mtj->actief_als == 'K') echo ' checked'; ?>>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Jobgroupleider certificaat behaald</span>
						</div>
						<input type="checkbox" name="jglcrt_ind" id="jglcrt_ind" class="form-control" value="j" style="margin-left: 15px;" <?php if($mtj->jglcrt_ind == 'j') echo ' checked'; ?>>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text text-left text-wrap" style="width: 100%;">Actief als jobgroupleider</span>
						</div>
						<input type="checkbox" name="actiefjgl" id="actiefjgl" class="form-control" value="j" style="margin-left: 15px;" <?php if($mtj->actief_als == 'B' || $mtj->actief_als == 'K') echo ' checked'; ?>>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Notities</span>
						</div>
						<textarea type="textarea" name="omschrijving" rows="5" class="form-control" value=""><?php echo $mtj->omschrijving; ?></textarea>
					</div>
					<?php
					/* Oplossing om ervoor te zorgen dat alleen Joke (en ik) met beheerind > 6 maatjes kunnen wijzigen of toevoegen */
					if ($curr_user->beheerind > 6) {
					echo '<div class="forms-group mb-1">
						<button name="saveMtBut" id="saveMtBut" value="bewaar" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
						<button name="backMtBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Menu</button>
					</div>';
					} else {
					echo '<div class="forms-group mb-1">
						<button id="saveMtBut" value="bewaar" class="btn btn-primary btn-width btn-sm" disabled>Bewaar</button>
						<button name="backMtBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Menu</button>
					</div>';
					}
					?>
				</div>
				</form>
			</div>
		<!-- </form> -->
		</div>
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
