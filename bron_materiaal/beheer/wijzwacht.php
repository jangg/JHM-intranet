<?php
require_once ('../config.php');
include_once('../classes/c_user.php');
include_once('../classes/c_person.php');

function sendEmail ($volnaam, $email, $userid, $wachtwoord)
{
	$mail_body  = 
	'<html><head></head><body><p>
	Beste ' . $volnaam . ' (' . $email . '),<br/><br/>	
	
	Je gebruikersnaam is ' . $userid . '<br/>
	Je wachtwoord is ' . $wachtwoord .'<br/><br/>
	Log in op https://www.zoetermeerfonds.nl/beheer/
	
	</p></body></html>';

	$Name = "Zoetermeerfonds Beheer"; //senders name
	$subject = 'Gebruikersnaam en wachtwoord'; //subject
	$header = "From: ". $Name . " <" . 'info@benbbovenweg.nl' . ">\r\n";
	$header .= 'MIME-Version: 1.0' . "\r\n";
	$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$result = mail($email, $subject, $mail_body, $header);

}

if (!isset($_SESSION['username']))
	header('location:../index.php');

if (isset($_POST['terug']))
{
	header('location:index.php');
}


if (isset($_POST['reset']))
{
	unset($_SESSION['email']);
}

$error = 0;
if (isset($_POST['wijzigen']) && $_POST['wijzigen'] == 'wijzigen')
{
	if ($_SESSION['userid'] != NULL)
	{
		/* de gebruiker bestaat */
		if (isset($_POST['ww1'])) $ww1 = $_POST['ww1']; else $ww1 = '';
		if (isset($_POST['ww2'])) $ww2 = $_POST['ww2']; else $ww2 = '';
		if (isset($_POST['ww3'])) $ww3 = $_POST['ww3']; else $ww3 = '';
		$user = new User('id', $_SESSION['userid']);
		/* eerst testen of huidige ww correct is */
		if ($user->password != md5($ww1))
		{
			$error = 1;
		} else 
		{
			if (!ctype_alnum($ww2))
			{		
				$error = 2;
			} else 
			{
				if ($ww2 != $ww3)
				{
					$error = 3;
				} else
				{
					$user->password = md5($ww2);
					$user->password_mod = 'n';
					$user->updateToDB();
					header('location:index.php');
				}		
			}			
		}		
	}
}

	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Zoetermeerfonds | beheer</title>
		<meta name="viewport" content="width=device-width">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link href='http://fonts.googleapis.com/css?family=Cousine' rel='stylesheet' type='text/css'>		

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">	
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link href="css/beheer_style.css" rel="stylesheet" type="text/css" /> 
	</head>
	<body>
		<div class="container">
			<div class="row header">
				<div class="col-sm-3"></div>
				<div class="col-sm-6" style="margin: 20px auto; text-align: center;">
					<a href="../index.php"><img src="../img/logos/zflogo_50.png" alt="zflogo_50" width="223" height="80"></a>
					<h3>Zoetermeerfonds beheer</h3>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h4>Wachtwoord wijzigen</h4>
					<p>Geef hier uw nieuwe wachtwoord op. Het moet minimaal uit 5 en mag maximaal uit 8 tekens bestaan.
						Het mag alleen hoofdletters, kleine letters en cijfers bevatten.
					</p>
				<form role="form" method="POST" action="wijzwacht.php">
					<div class="form-groups">
						<label for="text">Huidig wachtwoord</label>
						<input name="ww1" type="password" class="form-control" id="ww1" size="15" <?php if ($error == 1) echo ' style="background-color: red;"'; else echo ' style="background-color: white;"'; ?>>
					</div><br/>
					<div class="form-groups">
						<label for="text">Nieuw wachtwoord</label>
						<input name="ww2" type="password" class="form-control" id="ww2" size="15" <?php if ($error == 2) echo ' style="background-color: red;"'; else echo ' style="background-color: white;"'; ?>>
					</div><br/>
					<div class="form-groups">
						<label for="text">Bevestig nieuw wachtwoord</label>
						<input name="ww3" type="password" class="form-control" id="ww3" size="15" <?php if ($error == 3) echo ' style="background-color: red;"'; else echo ' style="background-color: white;"'; ?>>
					</div><br/>
					<button name="wijzigen" value="wijzigen" type="submit" class="btn btn-primary">Wijzigen</button>
					<button name="reset" value="reset" type="submit" class="btn btn-default">Reset</button>
					<button name="terug" value="terug" type="submit" class="btn btn-default">Terug</button>
				</form>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="row footer">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
				&copy 2017 Zoetermeerfonds
				</div>
				<div class="col-sm-3"></div>
			</div>
		</div>
	</body>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</html>