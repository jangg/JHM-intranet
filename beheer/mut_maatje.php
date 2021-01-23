<?php
include_once('../config.php');
include_once('../class/c_user.php');
include_once('../class/c_maatje.php');
include_once('../class/c_processtap.php');
include_once('../class/c_werkzoekende_coll.php');

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

if (isset($_GET['id']))
	$_SESSION['maatje_id'] = $_GET['id'];
	else
	{
		if(!isset($_SESSION['maatje_id'])) $_SESSION['maatje_id'] = '15';
	}

if (isset($_POST['backMtBut']) && $_POST['backMtBut'] == 'back')
{
	header("location: overz_maatjes.php");
	exit();	
}

$mtj = new Maatje ('id', $_SESSION['maatje_id']);

$arr1 = array (array (0 => 'werkzkd.id_maatje', 1 => $mtj->id));
$arr2 = array (array (0 => 'person.achternaam', 1 => 'ASC'));
$wkzList = new Werkzoekende_coll($arr1, $arr2);


if (isset($_POST['updateMtBut']) && $_POST['updateMtBut'] == 'wijzig')
{
	$mtj_nw = clone $mtj;
	$mtj_nw->voornaam				= $_POST['voornaam'];
	$mtj_nw->achternaam				= $_POST['achternaam'];
	$mtj_nw->tussenvoegsels			= $_POST['tussenvoegsels'];
	$mtj_nw->straat					= $_POST['straat'];
	$mtj_nw->huisnummer				= $_POST['huisnummer'];
	$mtj_nw->postcode				= $_POST['postcode'];
	$mtj_nw->woonplaats				= $_POST['woonplaats'];
	$mtj_nw->emailadres				= $_POST['emailadres'];
	$mtj_nw->telefoonnr				= $_POST['telefoonnr'];
	$mtj_nw->link_linkedin			= $_POST['link_linkedin'];
	if ($_POST['date_geboorte'] != '')
	{
		if (preg_match("/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/", $_POST['date_geboorte']) === 0)
		{
			$mtj_nw->date_geboorte		= '';
		} else
		{
			$date = DateTime::createFromFormat('d-m-Y', $_POST['date_geboorte']);
			$mtj_nw->date_geboorte		= $date->format('Y-m-d');
		} 
	} else
	{
		$mtj_nw->date_geboorte		= '';
	}
	$mtj_nw->omschrijving			= $_POST['omschrijving'];
	$mtj_nw->functie				= $_POST['functie'];
	$mtj_nw->actief_als				= $_POST['actief_als'];
	
	if ($mtj_nw != $mtj)
	{
		$mtj_nw->updateToDB();
	} 
	/* start de page opnieuw om een tweede update te voorkomen */
	header("location: mut_maatje.php");
	exit();	
}

?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include('../includes/head.inc'); ?>				
	</head>
	<body style="background-color: #dddddd;">
		<div class="container">
			<?php include('../includes/navbar.inc'); ?>
		</div>
		<div class="container-fluid"  style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-3">
				<h1 class="mx-auto">Maatje gegevens</h1>
			</div>
			<div class="row">
				<div class="col-sm-12">
				</div>
			</div>
		</div>
        <!-- <div class="container">
            <div class="row mt-4">
				<div class="col-md-12 p-0">
					<button type="button" class="btn btn-primary" style="width: 120px;"><a class="text-white" href="beheer.php">terug</a></button>
	            </div>
            </div>
        </div> -->
        <div class="container-fluid" style="padding-bottom: 80px;">	
			<form method="POST" action="mut_maatje.php" id="postmt" novalidate>
			<div class="row">
				<div class="col-md-6 bg-light mt-2 pt-2">
					<img class="card-img-top mb-2" src="../fotoos_person/<?php echo $mtj->picfile; ?>" style="max-width: 160px;" alt="">

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
						<input type="text" name="achternaam" class="form-control" value="<?php echo $mtj->achternaam; ?>" required>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Id person</span>
						</div>
						<input type="text" name="id_person" class="form-control" disabled value="<?php echo $mtj->id_person; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Datum/tijd nieuw</span>
						</div>
						<input type="text" name="datetime_created" class="form-control" disabled value="<?php echo $mtj->datetime_created; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Datum/tijd gewijzigd</span>
						</div>
						<input type="text" name="datetime_modified" class="form-control" disabled value="<?php echo $mtj->datetime_modified; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Emailadres</span>
						</div>
						<input type="email" name="emailadres" class="form-control" value="<?php echo $mtj->emailadres; ?>">
						<?php if ($mtj->emailadres != ''): ?>
							<a href="mailto: <?php echo $mtj->emailadres; ?>" target="_blank"><i class="fas fa-envelope" style="font-size: 2em;"></i></a>
						<?php endif; ?>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Telefoonnummers</span>
						</div>
						<input type="telnr" name="telefoonnr" class="form-control" value="<?php echo $mtj->telefoonnr; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">URL LinkedIn</span>
						</div>
						<input type="text" name="link_linkedin" class="form-control" value="<?php echo $mtj->link_linkedin; ?>">
						<?php if ($mtj->link_linkedin != ''): ?>
							<a href="<?php echo $mtj->link_linkedin; ?>" target="_blank"><i class="fab fa-linkedin" style="font-size: 2em;"></i></a>
						<?php endif; ?>
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
						<input type="text" name="date_geboorte" class="form-control" value="<?php 
						// error_log ($mtj->date_geboorte);
						if ($mtj->date_geboorte == '') echo ''; else echo (DateTime::createFromFormat('Y-m-d', $mtj->date_geboorte))->format('d-m-Y'); ?>" maxlength="10" placeholder="dd-mm-jjjj">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Leeftijd</span>
						</div>
						<input type="text" class="form-control" value="<?php if ($mtj->date_geboorte != '') echo calculateAge($mtj->date_geboorte); else echo ''; ?>" disabled>
					</div>
				</div>


				<div class="col-md-6 mt-2 pt-2">
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
						  <span class="input-group-text" style="width: 100%;">Id maatje</span>
						</div>
						<input type="text" name="id" class="form-control" disabled value="<?php echo $mtj->id; ?>">
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Functie</span>
						</div>
						<textarea type="textarea" name="functie" rows="5" class="form-control" value=""><?php echo $mtj->functie; ?></textarea>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class=" input-group-text" style="width: 100%;">Actief als</span>
						</div>
						<select class="form-control"  name="actief_als" id="actief_als">
							<option value="" <?php if($mtj->actief_als == '') echo 'selected'; ?>>Niet actief</option>
							<option value="A" <?php if($mtj->actief_als == 'A') echo 'selected'; ?>>Maatje</option>
							<option value="B" <?php if($mtj->actief_als == 'B') echo 'selected'; ?>>Jobgroupleider</option>
							<option value="K" <?php if($mtj->actief_als == 'K') echo 'selected'; ?>>Maatje en jobgroupleider</option>
						</select>
					</div>
					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Maatje voor</span>
						</div>
						<?php
						$wkzs = "";
							foreach($wkzList->werkzoekendeColl as $wkz)
							{
								$wkzs .= $wkz->voornaam . ' ' . $wkz->tussenvoegsels . ' ' . $wkz->achternaam . "\n";
							}
						?>
						<textarea type="textarea" rows="5" class="form-control" disabled><?php echo $wkzs; ?></textarea>
					</div>

					<div class="input-group input-group-sm mb-1">
						<div class="input-group-prepend" style="width: 30%;">
							<span class="input-group-text" style="width: 100%;">Omschrijving</span>
						</div>
						<textarea type="textarea" name="omschrijving" rows="5" class="form-control" value=""><?php echo $mtj->omschrijving; ?></textarea>
					</div>
					<div class="forms-group mb-1">
						<button name="updateMtBut" value="wijzig" type="submit" class="btn btn-primary btn-width btn-sm">Wijzig</button>
						<button name="backMtBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button>
					</div>
				</div>
				</form>
			</div>
		<!-- </form> -->
		</div>
		<?php include('../includes/footer.inc'); ?>
	</body>
</html>
