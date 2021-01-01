<?php
require_once ('../config.php');
include_once('../classes/c_user.php');
include_once('../classes/c_person.php');

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function sendEmail ($volnaam, $email, $userid, $wachtwoord)
{
	$mail_body  = 
	'<html><head></head><body><p>
	Beste ' . $volnaam . ' (' . $email . '),<br/><br/>	
	
	Je gebruikersnaam is ' . $userid . '<br/>
	Je tijdelijke wachtwoord is ' . $wachtwoord .'<br/><br/>
	Log in op https://www.zoetermeerfonds.nl/beheer/
	
	</p></body></html>';

	$Name = "Zoetermeerfonds Beheer"; //senders name
	$subject = 'Gebruikersnaam en wachtwoord'; //subject
	$header = "From: ". $Name . " <" . 'beheer@zoetermeerfonds.nl' . ">\r\n";
	$header .= 'MIME-Version: 1.0' . "\r\n";
	$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$result = mail($email, $subject, $mail_body, $header);

}

/*
if (!isset($_SESSION['username']))
	header('location:../index.php');
*/

if (isset($_POST['terug']))
{
	header('location:index.php');
}


if (isset($_POST['reset']))
{
	unset($_SESSION['email']);
}

if (isset($_POST['wijzigen']))
{
	$user = new User('emailaddress', $_POST['email']);
	
	if ($user->id != NULL)
	{
		$person = new Person('id', $user->id_person);
		
		$nwpw = randomPassword();
		
		$user->password = md5($nwpw);
		error_log($nwpw);
		$user->password_mod = 'j';
/*
		error_log($nwpw);
		error_log($user->password);
*/
		
		$user->updateToDB();
		
		sendEmail($person->voornaam, $user->emailaddress, $user->username, $nwpw);
		header('location:index.php');
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
					<h2>Zoetermeerfonds beheer</h2>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h2>Wachtwoord wijzigen</h2>
					<p>Als het emailadres bekend is bij het Zoetermeerfonds, wordt een link met een tijdelijk nieuw wachtwoord gestuurd. Via de link kunt u uw wachtwoord wijzigen.</p>
				<form role="form" method="POST" action="vergeten.php">
					<div class="form-groups">
						<label for="email">Emailadres</label>
						<input name="email" type="email" class="form-control" id="email" size="35">
					</div><br/>
					<button name="wijzigen" value="true" type="submit" class="btn btn-primary">Stuur link</button>
					<button name="reset" type="submit" class="btn btn-default">Reset</button>
					<button name="terug" type="submit" class="btn btn-default">Terug</button>
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