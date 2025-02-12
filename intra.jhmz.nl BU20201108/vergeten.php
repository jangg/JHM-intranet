<?php
include_once ('config.php');
include_once('class/c_user.php');
include_once('class/c_person.php');

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

function sendEmail ($naam, $email, $userid, $wachtwoord)
{
	$mail_body  = 
	'<html><head></head><body><p>
	Beste ' . $naam . ' (' . $email . '),<br/><br/>	
	
	Je gebruikersnaam is ' . $userid . '<br/>
	Je tijdelijke wachtwoord is ' . $wachtwoord .'<br/><br/>
	Log in op https://intra.jhmz.nl/
	
	</p></body></html>';

	$Name = "JHM Zoetermeer intranet"; //senders name
	$subject = 'Gebruikersnaam en wachtwoord'; //subject
	$header = "From: info@jhmz.nl<" . 'info@jhmz.nl' . ">\r\n";
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
	exit();
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
		
		// $user->password = md5($nwpw);
		$user->password = $nwpw;
		error_log($nwpw);
		$user->password_mod = 'j';
/*
		error_log($nwpw);
		error_log($user->password);
*/
		
		$user->updateToDB();
		
		sendEmail($person->voornaam, $user->emailaddress, $user->username, $nwpw);
		header('location:index.php');
		exit();
	}
}

	
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('includes/head.inc'); ?>				
	</head>
	<body>
		<div class="container">
			<div class="row mt-5 text-center">
				<div class="col-lg-3"></div>
				<div class="col-lg-6"">
					<a href="#"><img src="img/LogoJobHulpMaatjeZoetermeer.jpg" alt="LogoJobHulpMaatjeZoetermeer.jpg" width="223"></a><br/><br/><br/><br/>
					<h3>JHM Zoetermeer Intranet</h3>
				</div>
				<div class="col-lg-3"></div>
			</div>
			<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<h2>Wachtwoord wijzigen</h2>
					<p>Als het emailadres bekend is bij JHMZ intranet, wordt een link met een tijdelijk nieuw wachtwoord gestuurd. Via de link kunt u uw wachtwoord wijzigen.</p>
				<form role="form" method="POST" action="vergeten.php">
					<div class="form-groups">
						<label for="email">Emailadres</label>
						<input name="email" type="email" class="form-control" id="email" size="35">
					</div><br/>
					<button name="wijzigen" value="true" type="submit" class="btn btn-primary">Stuur link</button>
					<button name="reset" type="submit" class="btn btn-secondary">Reset</button>
					<button name="terug" type="submit" class="btn btn-secondary">Terug</button>
				</form>
				</div>
				<div class="col-lg-3"></div>
			</div>
			<div class="row footer">
				<div class="col-lg-3"></div>
				<div class="col-lg-6 text-center my-5">
					&copy 2020 JobHulpMaatje Zoetermeer
				</div>
				<div class="col-lg-3"></div>
			</div>
		</div>
	</body>
</html>