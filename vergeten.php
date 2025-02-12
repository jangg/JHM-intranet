<?php
include_once ('config.php');
include_once('class/c_user.php');

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
	$header = "From: intra@jhmz.nl <" . 'intra@jhmz.nl' . ">\r\n";
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

$emailadres = '';
$emailOK = TRUE;

if (isset($_POST['reset']))
{
	unset($_SESSION['email']);
	$emailadres = '';
}
else
{
	if (isset($_POST['email']))
		$emailadres = $_POST['email'];
}
if (isset($_POST['wijzigen']))
{
	$emailOK = FALSE;
	$user = new User('emailadres', $emailadres);	
	if ($user->id != NULL)
	{	
		$nwpw = randomPassword();
		$user->password = $nwpw;
		$user->password_mod = 'j';
		$user->updateToDB();		
		sendEmail($user->voornaam, $user->emailadres, $user->username, $nwpw);
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
	<body class="bodystyle">
		
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
					<p>Als het emailadres bekend is bij JHMZ intranet, wordt een email met een link met een tijdelijk nieuw wachtwoord gestuurd. Via de link kunt je je wachtwoord wijzigen.</p>
					<p>Als je de email niet ziet in je Inbox, check dan ook of de email misschien in je spam-email terecht is gekomen. 
						</p>
						<p>In de email staat je toegangs-id en een tijdelijk wachtwoord. Gebruik deze om in te loggen. Je krijgt dan direct de vraag om een nieuwe, eigen wachtwoord op te geven. Met je id en dit nieuwe wachtwoord kun je weer op de normale manier terecht op het intranet.</p>
				<form role="form" method="POST" action="vergeten.php">
					<div class="form-groups">
						<label for="email">Emailadres</label>
						<div style="color: red; display: <?php if ($emailOK) echo 'none'; else echo 'block'; ?>">dit emailadres is onbekend</div>
						<input name="email" type="email" class="form-control" id="email" size="35" value="<?= $emailadres ?>">
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
					&copy 2021 JobHulpMaatje Zoetermeer
				</div>
				<div class="col-lg-3"></div>
			</div>
		</div>
	</body>
</html>