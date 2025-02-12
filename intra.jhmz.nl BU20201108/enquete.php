<?php
include_once('config.php');
include_once('class/c_user.php');

/************************
Dit stukje is nodig om misbruik van de website voorkomen
*************************/
if (!isset($_SESSION['username'])) {
	header('location:index.php');
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


include_once('includes/chk_enquete.inc');

?>
<!DOCTYPE HTML>
<html lang="nl-NL">
	<head>
		<?php include('includes/head.inc'); ?>			
		<style>
			.bluefont {
				color: #304280;
				font-weight: 300;
			}
			.bg-jhmz {
				background-color: #eeeeee;
			}
			.errormessage {
				color: red;
			}
		</style>
	<!-- Custom styles for this template -->
		<link href="css/jumbotron.css" rel="stylesheet">
		<script>
		$(document).ready(function(){
		});		
		</script>
	</head>
 
<body style="background-color: #dddddd; font-size: 16px;">
<?php include('includes/navbar.inc'); ?>
	<div id="alert" style="display: <?php if ($enquete_ready) echo 'block'; else echo 'none';?>;">
		<div class="container my-5"" id="cont01">
			<h1 class="text-black mb-5 bluefont text-center errormessage">Dank voor het invullen en opsturen!</h1>
			<div class="text-center"><a href="home.php" class="btn btn-primary" role="button">Klaar</a></div>
		</div>
	</div>
	<div id="main" style="margin-bottom: 100px; opacity: <?php if ($enquete_ready) echo '.2'; else echo '1';?>;">
	<div class="container my-5"" id="cont01">
		<h3 class="bluefont">Enquête</h3>
		<h1 class="text-black mb-5 bluefont">JobHulpMaatje Zoetermeer ICT</h1>
		<p>JHM Zoetermeer heeft op dit moment 23 vrijwilligers beschikbaar die zich inzetten om werkzoekenden te ondersteunen bij het zoeken naar nieuw werk of studie.
			Bij hun werkzaamheden wordt vrijwel altijd gebruik gemaakt van computers, smartphones, tablets en de bijbehorende programma's (apps). 
			Omdat JHMZ een vrijwilligersorganisatie is, zijn alle gebruikte middelen in eigendom van de gebruiker zelf, de vrijwilliger dus.
			Met deze vragen wil ik graag weten in hoeverre behoefte is aan meer en/of specifiekere ondersteuning op het gebied van IT.</p>			
		<p>Ik hoop dat je even de tijd wilt nemen de vragen te beantwoorden. Zodra ik genoeg informatie heb, zal ik de uitkomsten aan de medewerkers van JHMZ terugkoppelen. Alvast bedankt voor de moeite!</p>
		<p>Jan Geerdes<br/>
		ICT coördinator JobHulpMaatje Zoetermeer</p>
	</div>
	<div class="container">
		<h5 class="p-3 text-white bg-danger text-center" style="display: <?php if ($error != 0x0000) echo 'block'; else echo 'none';?>">Het formulier bevat fouten. Kijk bij de vragen voor meer informatie.</h5>
	</div>
	<form method="POST" action="enquete.php" id="post" novalidate>
	<div class="container my-3 px-sm-5 py-2 bg-jhmz rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 1</h1>
		<h5>Wat is je functie als JobHulpMaatjevrijwilliger?</h5>
		<p>(meerdere antwoorden mogelijk)</p>
		<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr01a" <?php if (isset($_POST['vr01a'])) echo 'checked'; ?>>Ik ben maatje</label></div>
		<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr01b" <?php if (isset($_POST['vr01b'])) echo 'checked'; ?>>Ik ben jobgroupleider</label></div>
		<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr01c" <?php if (isset($_POST['vr01c'])) echo 'checked'; ?>>Ik ben coördinator</label></div>
		<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr01d" <?php if (isset($_POST['vr01d'])) echo 'checked'; ?>>Ik ben bestuurslid</label></div>
		<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr01e" <?php if (isset($_POST['vr01e'])) echo 'checked'; ?>>Ik ben ondersteuner</label></div>
		<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr01f" <?php if (isset($_POST['vr01f'])) echo 'checked'; ?>>Ik weet het niet</label></div>
		</div>
		<div class="errormessage form-check"><?php if (($error & 0x0001) == 0x0001) echo 'Minimaal 1 optie kiezen graag.'; ?></div>
	</div>
	<div class="container my-3 px-sm-5 py-2 bg-jhmz text-white rounded">	
		<div class="form-group form-check text-dark">
			<h1>Vraag 2</h1>
			<h5>Voor mijn werkzaamheden bij JobHulpMaatje maak ik gebruik van:</h5>
			<p>(meerdere antwoorden mogelijk)</p>			
			<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr02a" <?php if (isset($_POST['vr02a'])) echo 'checked'; ?>>Windows PC of laptop</label></div>
			<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr02b" <?php if (isset($_POST['vr02b'])) echo 'checked'; ?>>Apple iMac of MacBook</label></div>
			<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr02c" <?php if (isset($_POST['vr02c'])) echo 'checked'; ?>>Tablet (iPad of Samsung bv)</label></div>
			<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr02d" <?php if (isset($_POST['vr02d'])) echo 'checked'; ?>>Smartphone</label></div>
			<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr02e" <?php if (isset($_POST['vr02e'])) echo 'checked'; ?>>Andere IT-hulpmiddelen</label></div>
			<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="vr02f" <?php if (isset($_POST['vr02f'])) echo 'checked'; ?>>Geen IT-hulpmiddelen</label></div>
		</div>
		<div class="errormessage  form-check"><?php if (($error & 0x0002) == 0x0002) echo 'Minimaal 1 optie kiezen graag.'; ?></div>
	</div>
	<div class="container my-3 px-sm-5 py-2 bg-jhmz text-white rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 3</h1>
		<h5>Welke programma's of apps gebruik je voor JobHulpMaatje?</h5>
		<table id="radio_table" class="table table-striped table-sm">
			<colgroup>
			   <col span="1" style="width: 80%;">
			   <col span="1" style="width: 10%; text-align: right;">
			   <col span="1" style="width: 10%; text-align: right;">
			</colgroup>
			<tbody>
			<tr>
				<td>Windows</td>
				<td><input type="radio" class="form-check-input" name="vr03a" value="ja"  <?php if (isset($_POST['vr03a']) && $_POST['vr03a'] == 'ja') echo 'checked';  ?>>Ja</td>
				<td><input type="radio" class="form-check-input" name="vr03a" value="nee" <?php if (isset($_POST['vr03a']) && $_POST['vr03a'] == 'nee') echo 'checked'; ?>>Nee</td>
			</tr>
			<tr>
				<td>Apple OSX</td>
				<td><input type="radio" class="form-check-input" name="vr03b" value="ja"  <?php if (isset($_POST['vr03b']) && $_POST['vr03b'] == 'ja') echo 'checked';  ?>>Ja</td>
				<td><input type="radio" class="form-check-input" name="vr03b" value="nee" <?php if (isset($_POST['vr03b']) && $_POST['vr03b'] == 'nee') echo 'checked'; ?>>Nee</td>
			</tr>
			<tr>
				<td>Microsoft Word</td>
				<td><input type="radio" class="form-check-input" name="vr03c" value="ja"  <?php if (isset($_POST['vr03c']) && $_POST['vr03c'] == 'ja') echo 'checked';  ?>>Ja</td>
				<td><input type="radio" class="form-check-input" name="vr03c" value="nee" <?php if (isset($_POST['vr03c']) && $_POST['vr03c'] == 'nee') echo 'checked'; ?>>Nee</td>
			</tr>
			<tr>
				<td>Microsoft Excel</td>
				<td><input type="radio" class="form-check-input" name="vr03d" value="ja"  <?php if (isset($_POST['vr03d']) && $_POST['vr03d'] == 'ja') echo 'checked';  ?>>Ja</td>
				<td><input type="radio" class="form-check-input" name="vr03d" value="nee" <?php if (isset($_POST['vr03d']) && $_POST['vr03d'] == 'nee') echo 'checked'; ?>>Nee</td>
			</tr>
			<tr>
				<td>Microsoft Powerpoint</td>
				<td><input type="radio" class="form-check-input" name="vr03e" value="ja"  <?php if (isset($_POST['vr03e']) && $_POST['vr03e'] == 'ja') echo 'checked';  ?>>Ja</td>
				<td><input type="radio" class="form-check-input" name="vr03e" value="nee" <?php if (isset($_POST['vr03e']) && $_POST['vr03e'] == 'nee') echo 'checked'; ?>>Nee</td>
			</tr>
			<tr>
				<td>Microsoft Teams</td>
				<td><input type="radio" class="form-check-input" name="vr03f" value="ja"  <?php if (isset($_POST['vr03f']) && $_POST['vr03f'] == 'ja') echo 'checked';  ?>>Ja</td>
				<td><input type="radio" class="form-check-input" name="vr03f" value="nee" <?php if (isset($_POST['vr03f']) && $_POST['vr03f'] == 'nee') echo 'checked'; ?>>Nee</td>
			</tr>
			<tr>
				<td>Opslag van documenten in de Cloud (Dropbox, OneDrive o.i.d.)</td>
				<td><input type="radio" class="form-check-input" name="vr03g" value="ja"  <?php if (isset($_POST['vr03g']) && $_POST['vr03g'] == 'ja') echo 'checked';  ?>>Ja</td>
				<td><input type="radio" class="form-check-input" name="vr03g" value="nee" <?php if (isset($_POST['vr03g']) && $_POST['vr03g'] == 'nee') echo 'checked'; ?>>Nee</td>
			</tr>
			<tr>
				<td>Tekst messaging (SMS)</td>
				<td><input type="radio" class="form-check-input" name="vr03h" value="ja"  <?php if (isset($_POST['vr03h']) && $_POST['vr03h'] == 'ja') echo 'checked';  ?>>Ja</td>
				<td><input type="radio" class="form-check-input" name="vr03h" value="nee" <?php if (isset($_POST['vr03h']) && $_POST['vr03h'] == 'nee') echo 'checked'; ?>>Nee</td>
			</tr>
			<tr>
				<td>WhatsApp</td>
				<td><input type="radio" class="form-check-input" name="vr03i" value="ja"  <?php if (isset($_POST['vr03i']) && $_POST['vr03i'] == 'ja') echo 'checked';  ?>>Ja</td>
				<td><input type="radio" class="form-check-input" name="vr03i" value="nee" <?php if (isset($_POST['vr03i']) && $_POST['vr03i'] == 'nee') echo 'checked'; ?>>Nee</td>
			</tr>
			<tr>
				<td>Andere programma's of apps</td>
				<td><input type="radio" class="form-check-input" name="vr03j" value="ja"  <?php if (isset($_POST['vr03j']) && $_POST['vr03j'] == 'ja') echo 'checked';  ?>>Ja</td>
				<td><input type="radio" class="form-check-input" name="vr03j" value="nee" <?php if (isset($_POST['vr03j']) && $_POST['vr03j'] == 'nee') echo 'checked'; ?>>Nee</td>
			</tr>

			</tbody>
		</table>
		</div>
		<div class="errormessage  form-check"><?php if (($error & 0x0004) == 0x0004) echo 'Bij iedere optie graag "ja" of "nee" aangeven.'; ?></div>
	</div>

	<div class="container my-3 px-sm-5 py-2 bg-jhmz text-white rounded">	
		<div class="form-group form-check text-dark">		
		<h1>Vraag 4</h1>
		<h5>Als je bij vraag 2 of 3 "andere ...." hebt gekozen, wil je dan hier aangeven welke dat zijn?</h5>
		<textarea rows="5" class="form-control" name="vr04"><?php if (isset($_POST['vr04'])) echo $_POST['vr04']; ?></textarea>
		</div>
	</div>
	<div class="container my-3 px-sm-5 py-2 bg-jhmz text-white rounded">	
		<div class="form-group form-check text-dark">
		<h1>Vraag 5</h1>
		<h5>Als je nog suggesties hebt voor verbetering op het gebied van IT ondersteuning bij JobHulpMaatje, laat het hier dan weten.</h5>
		<textarea rows="8" class="form-control" name="vr05"><?php if (isset($_POST['vr05'])) echo $_POST['vr05']; ?></textarea>
		</div>
	</div>
	<div class="container my-3 px-sm-5 py-2">	
		<button id="verstuurBut" name="verstuurBut" value="verstuur" type="submit" class="btn btn-primary">Verstuur je antwoorden</button>
	</div>
	</form>
	</div>
	<?php include('includes/footer.inc'); ?>
</body>
</html>
