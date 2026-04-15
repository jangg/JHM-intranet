<?php
include_once "../config.php";
include_once "../class/c_user.php";
include_once "../class/c_werkzoekende.php";
include_once "../class/c_processtap.php";

// Sessiecheck: niet ingelogd → terug naar login
if (!isset($_SESSION["username"])) {
	header("location:../index.php");
	exit();
}

// Huidige gebruiker ophalen
if (isset($_SESSION["userid"])) {
	$curr_user = new User("id", $_SESSION["userid"]);
} else {
	$curr_user = new User();
	$curr_user->id = "1";
}

// CSRF-token aanmaken als dat nog niet bestaat
if (empty($_SESSION["csrf_token"])) {
	$_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}

/**
 * Geeft true als bit op positie $p gezet is in bitmasker $pos.
 * p=1 → bit 0 (waarde 1), p=2 → bit 1 (waarde 2), ... p=7 → bit 6 (waarde 64)
 */
function chkchkbx(int $p, int $pos): bool
{
	$bit = 1 << ($p - 1);
	return ($pos & $bit) === $bit;
}

/** Veilige output: voorkomt XSS */
function h(?string $value): string
{
	return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}


if (isset($_POST["backWzBut"]) && $_POST["backWzBut"] == "back") {
  header("location: overz_werkzoekenden.php");
  exit();
}

$wkz = new Werkzoekende();

if (isset($_SESSION["getemailadres"])) 
{
	$wkz = new Werkzoekende("emailadres", $_SESSION["getemailadres"]);
	$_SESSION["wkz_id"] = $wkz->id;
	unset($_SESSION["getemailadres"]);
}

if (isset($_POST["getWkzBut"]) && $_POST["getWkzBut"] == "get1" && $_POST["getemailadres"] != "") 
{
	$_SESSION["getemailadres"] = $_POST["getemailadres"];
	header("location: aanmelding_wkz.php");
	exit();
}

if (isset($_POST["saveWzBut"]) && $_POST["saveWzBut"] == "bewaar1") 
{
  // CSRF-validatie
  if (
	  empty($_POST["csrf_token"]) ||
	  !hash_equals($_SESSION["csrf_token"], $_POST["csrf_token"])
  ) {
	  http_response_code(403);
	  die("Ongeldige formulieraanvraag.");
  }

  $wkz_nw = new Werkzoekende();

	$wkz_nw->voornaam       = trim($_POST["voornaam"]       ?? "");
  $wkz_nw->achternaam     = trim($_POST["achternaam"]     ?? "");
  $wkz_nw->tussenvoegsels = trim($_POST["tussenvoegsels"] ?? "");
  $wkz_nw->straat         = trim($_POST["straat"]         ?? "");
  $wkz_nw->huisnummer     = substr(trim($_POST["huisnummer"] ?? ""), 0, 5);
  $wkz_nw->postcode       = substr(trim($_POST["postcode"]   ?? ""), 0, 7);
  $wkz_nw->woonplaats     = trim($_POST["woonplaats"]     ?? "");
  $wkz_nw->emailadres     = trim($_POST["emailadres"]     ?? "");
  $wkz_nw->telefoonnr     = substr(trim($_POST["telefoonnr"] ?? ""), 0, 11);
  $wkz_nw->situatie       = trim($_POST["situatie"]       ?? "");
  $wkz_nw->opmerkingen    = trim($_POST["opmerkingen"]    ?? "");
  $wkz_nw->nnind          = isset($_POST["nnind"])  ? "j" : "n";
  $wkz_nw->GAKind         = isset($_POST["GAKind"]) ? "j" : "n";
  $wkz_nw->DBBind         = isset($_POST["DBBind"]) ? "j" : "n";
  $wkz_nw->status         = "000";
	// Hulpvormen: bitmasker opbouwen (7 opties, bits 0–6)
  $opties = 0;
  for ($i = 1; $i <= 7; $i++) {
	  if (isset($_POST["hulpvorm" . $i])) {
		  $opties += (1 << ($i - 1));
	  }
  }
  $wkz_nw->opties = $opties;

  if (
    $wkz_nw->voornaam == "" ||
    $wkz_nw->achternaam == "" ||
    $wkz_nw->emailadres == "" ||
    $wkz_nw->telefoonnr == ""
  ) {
    echo '<script>alert("Niet alle verplichte velden zijn ingevuld. Probeer het opnieuw."); window.location.href = "https://' . LOC_DOMAIN . '/beheerwas/aanmelding_wkz.php";</script>';
  } else {
    $wkz_nw->id_user_modified = $curr_user->id;
    $wkz_nw->saveToDB();
    $ps = new Processtap();
    $ps->delind = "n";
    $ps->id_werkzkd = $wkz_nw->id;
    $ps->id_user = $curr_user->id;
    $ps->dt_stap = new DateTime();
    $ps->wzstatus = "000";
    $ps->drstrnaar = "";
    $ps->toelichting = "Nieuw";
    $ps->saveToDB();
	
	/********
	*** Nu mailen aan de coordinatoren
	*** function Tools::MailRoom($nameTo, $emailTo, $onderwerp, $tekst)
	***************** */
    Tools::MailRoom(
		"Coordinator Werkzoekenden",
		LOC_COORD_EMAIL,
		"Nieuwe werkzoekende toegevoegd in de WAS" . " door " . $curr_user->username,
		$wkz_nw->voornaam . " " . $wkz_nw->tussenvoegsels . " " . $wkz_nw->achternaam
    );
	Tools::closeMailer();
	echo '<script>alert("De gegevens zijn in de database opgenomen."); window.location.href = "https://' . LOC_DOMAIN . '/beheerwas/overz_werkzoekenden.php";</script>';
  }
  exit();
}
?>

<!DOCTYPE html>
<html lang="nl-NL">
	<?php include "../includes/head.php"; ?>
	<style>
	.bg-tab {
		background-color: #ccd9d9;
		border: 1px #000000 solid;
	}
	.error-border {
		border:	2px solid red;
	}
	.uitlegtekst {
		font-size:	.9em;
	}
	</style>
	</head>
	<body style="background-color: #dddddd;">
		
		<div class="container">
			<?php include "../includes/navbar.php"; ?>
		</div>
		<div class="container" style="margin-top: 80px; background-color: #304280;">
			<div class="row header rounded text-white py-2 mb-3">
				<h1 class="mx-auto">Aanmelding werkzoekende</h1>
			</div>
		</div>
		<div id="personalia" class="container tab-pane active bg-tab pb-2" style="margin: 10px auto;"><br>
			<p class="uitlegtekst mx-1">Gebruik dit formulier voor inschrijvingen van werkzoekenden die zelf geen online aanmeldformulier hebben ingevuld. B.v. bij aanmeldingen aan de balie of via de telefoon of via JobHulpMaatje landelijk. Ook aanmeldingen die via email worden gedaan, dienen m.b.v. dit formulier in de administratie te worden opgenomen.</p>
			<p class="uitlegtekst mx-1">Een werkzoekende kan meerdere keren worden geregistreerd. Het emailadres is meestal identificerend voor de persoon. Met dit emailadres kan worden gechecked of het al in de database voorkomt. De bijbehorende gegevens worden dan getoond in het formulier. Opslaan betekent wel dat de persoon <strong>nogmaals</strong> onder dit emailadres wordt opgeslagen. Bij opnieuw opvragen kan slechts het meest recent opgeslagen persoon worden getoond.</p>
			<form method="POST" action="aanmelding_wkz.php" id="aanmwz" novalidate>
				<div class="input-group input-group-sm pb-3 border-bottom border-primary">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Emailadres
						</span>
					</div>
					<input id="emailadres" type="email" name="getemailadres" class="form-control" value="" required>
					<span id="availability"></span>
					<button name="getWkzBut" value="get1" class="btn btn-primary btn-width btn-sm">
						  <i class="fas fa-arrow-down" aria-hidden="true" style="font-size: 1.3em;"></i>
					</button>
				</div>
			</form>
			<form method="POST" action="aanmelding_wkz.php" id="aanmwz" novalidate>
				<p class="mb-1 pt-2">Velden met een <sup>*</sup> zijn verplicht</p>
				<div class="input-group input-group-sm mb-2 pt-0">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Voornaam<sup>*</sup></span>
					</div>
					<input type="text" name="voornaam" class="form-control" value="<?php echo $wkz->voornaam; ?>" require>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Tussenvoegsels</span>
					</div>
					<input type="text" name="tussenvoegsels" class="form-control" value="<?php echo $wkz->tussenvoegsels; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Achternaam<sup>*</sup></span>
					</div>
					<input type="text" name="achternaam" class="form-control" value="<?php echo $wkz->achternaam; ?>" required>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Postcode<sup>*</sup></span>
					</div>
					<input type="text" id="postcode" name="postcode" class="form-control" value="<?php echo $wkz->postcode; ?>" require>
				</div>
				<div class="input-group input-group-sm mb-2">
				  <div class="input-group-prepend" style="width: 30%;">
					  <span class=" input-group-text" style="width: 100%;">Huisnummer<sup>*</sup></span>
				  </div>
				  <input type="text" id="huisnummer" name="huisnummer" class="form-control" value="<?php echo $wkz->huisnummer; ?>" require>
				</div>

				<div class="input-group input-group-sm mb-2">
			    	<div class="input-group-prepend" style="width: 30%;">
				    	<span class=" input-group-text" style="width: 100%;">Straat</span>
			  		</div>
			  		<input type="text" id="straat" name="straat" class="form-control" value="<?php echo $wkz->straat; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Woonplaats</span>
					</div>
					<input type="text" id="woonplaats" name="woonplaats" class="form-control" value="<?php echo $wkz->woonplaats; ?>">
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						  <span class=" input-group-text" style="width: 100%;">Emailadres<sup>*</sup></span>
					</div>
					<input id="emailadres" type="email" name="emailadres" class="form-control" value="<?php echo $wkz->emailadres; ?>" required>
					<span id="availability"></span>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Telefoonnummer<sup>*</sup></span>
					</div>
					<input type="text" name="telefoonnr" class="form-control" value="<?php echo $wkz->telefoonnr; ?>" required>
				  </div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text" style="width: 100%;">Opties</span>
					</div>
					<div class="pl-3" style="font-size: .9em;">
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if (chkchkbx(1, $wkz->opties)) {echo " checked";} ?>>
							<label class="form-check-label" for="taalbeh1">&nbsp;Individueel traject</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if (chkchkbx(2, $wkz->opties)) {echo " checked";} ?>>
							<label class="form-check-label" for="taalbeh2">&nbsp;Jobgroup</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if (chkchkbx(3, $wkz->opties)) {echo " checked";} ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Jobgroup "Ik Werk In Nederland"</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if (chkchkbx(4, $wkz->opties)) {echo " checked";} ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Jobgroup voor ZZP'ers</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if (chkchkbx(5, $wkz->opties)) {echo " checked";} ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Workshop</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="checkbox"<?php if (chkchkbx(7, $wkz->opties)) {echo " checked";} ?>>
							<label class="form-check-label" for="taalbeh3">&nbsp;Weet ik nog niet</label>
						</div>
					</div>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class=" input-group-text" style="width: 100%;">Situatie</span>
					</div>
					<textarea type="text" name="situatie" class="form-control" rows="8"><?php echo $wkz->situatie; ?></textarea>
				</div>
				
				<div class="input-group input-group-sm mb-1">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">Nieuwe Nederlander</span>
					</div>
					<input type="checkbox" name="nnind" class="form-control" value="j" <?php if ($wkz->nnind == "j") {echo " checked";} ?>>
				</div>
				<div class="input-group input-group-sm mb-1">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">GAK</span>
					</div>
					<input type="checkbox" name="GAKind" class="form-control" value="j" <?php if ($wkz->GAKind == "j") {echo " checked";} ?>>
				</div>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend" style="width: 30%;">
						<span class="input-group-text text-left text-wrap" style="width: 100%;">De Binnenbaan</span>
					</div>
					<input type="checkbox" name="DBBind" class="form-control" value="j" <?php if ($wkz->DBBind == "j") {echo " checked";} ?>>
				</div>

				<div class="input-group input-group-sm mb-2">
				  <div class="input-group-prepend" style="width: 30%;">
					  <span class="input-group-text" style="width: 100%;">Opmerkingen</span>
				  </div>
				  <textarea type="text" name="opmerkingen" class="form-control" rows="8"><?php echo $wkz->opmerkingen; ?></textarea>				
				</div>
				
				<div class="forms-group mb-1">
				  <button name="saveWzBut" value="bewaar1" type="submit" class="btn btn-primary btn-width btn-sm">Bewaar</button>
				  <button name="backWzBut" value="back" type="submit" class="btn btn-secondary btn-width btn-sm">Terug</button>
				</div>				
				</form>
			</div>		 		
		<?php include "../includes/footer.php"; ?>
<script>
			const postcode    = document.getElementById("postcode");
			const huisnummer  = document.getElementById("huisnummer");
			const straatnaam  = document.getElementById("straat");
			const woonplaats  = document.getElementById("woonplaats");
			const rege        = /^[1-9][0-9]{3}\s*(?!sa|sd|ss)[a-z]{2}$/i;
		
			huisnummer.addEventListener('blur', haalDataOp);
		
			function haalDataOp() {
				if (!rege.test(postcode.value)) {
					straatnaam.value = 'ongeldig';
					woonplaats.value = '';
					return;
				}
		
				const pc = postcode.value.replace(/\s+/g, '').toUpperCase();
				postcode.value   = pc;
		
				fetch('https://geodata.nationaalgeoregister.nl/locatieserver/free?fq=postcode:' + pc + '&fq=huisnummer:' + huisnummer.value)
					.then(result => result.json())
					.then(output => {
						const doc = output.response.docs[0];
						straatnaam.value = doc ? doc['straatnaam']     : 'onbekend';
						woonplaats.value = doc ? doc['woonplaatsnaam'] : '';
					})
					.catch(() => {
						straatnaam.value = 'onbekend';
						woonplaats.value = '';
					});
			}
		</script>
	</body>
</html>
