<?php
/*  Verjaardagskaarten versturen.
    Deze app leest dagelijks de personentabel uit de database
	Als de geboorte dag-maand gelijk is aan de vandaag dag-maand dan wordt een verjaarskaart verstuur
	met daarop:
		de naam van de jarige
		de felicitaties van bestuur en de rest van jobhulpmaatje zoetermeer
		de kaart staat in een HTML bestand 
	----------
	1. Haal jarigen op
	2. Als er geen jarigen zijn dan eindig job
	3. Heel kaart op, random
	4. Stuur voor iedere jarige een kaart met email.
	5. Stuur email naar beheerder met resultaten.
*/

// global $argc, $argv;
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
include_once('../config.php');
include_once ('../class/c_maatje_coll.php');

function getMsgHtml ()
{
	$html =  file_get_contents('../kaarten/felicitatiekaart.html', TRUE);
//	error_log($html);
	return $html;
}

function logEmail ($emailadres)
{
	$date = new DateTime();
	$timestamp = $date->format("Y-m-d H:i:s-u e");
	$logtxt = $timestamp . ' - kaart verstuurd naar ' . $emailadres . "\r\n";
//	file_put_contents ($_SERVER['DOCUMENT_ROOT'] . '/forum_emails.txt', $logtxt, FILE_APPEND);
	file_put_contents ('verjaardagkaarten.txt', $logtxt, FILE_APPEND);
//	error_log($logtxt);
}



$arr1 = array (array (0 => 'person.type', 1 => 'mtj'));
$arr2 = array (array (0 => 'person.achternaam', 1 => 'ASC'));

$maatjesColl = new Maatje_coll ($arr1, $arr2);
$jarigeMaatjes = $maatjesColl->jarigeMaatjes();

$mail = new PHPMailer(TRUE);	
$mail->setFrom(MAIL_SENDEREMAIL, 'JobHulpMaatje Zoetermeer');
$mail->addReplyTo('no-reply@jhmz.nl', 'No Reply');
$mail->isHTML(TRUE);
// if (strlen($post->tekst) < 80)
// {
// 	$mail->Subject = strip_tags($post->tekst);
// } else 
// {
// 	$mail->Subject = substr(strip_tags($post->tekst), 0, 80) . ' ...';
// }
$mail->Subject = 'Een felicitatiekaart voor jou!';
$mail->isSMTP();
$mail->Host = MAIL_SMTP_SERVER;
$mail->SMTPAuth = TRUE;
if (MAIL_SMTPSECURE == 'tls')
{
	$mail->SMTPSecure = 'tls';
	/* Set the SMTP port. */
	$mail->Port = 587;				
} else 
{
	$mail->SMTPSecure = 'ssl';
	/* Set the SMTP port. */
	$mail->Port = 465;					
}
$mail->Username = MAIL_USERID;
$mail->Password = MAIL_PASSWORD;		
$mail->SMTPDebug = MAIL_DEBUG_IND;

$kaart = getMsgHtml ();

foreach ($jarigeMaatjes as $jarige)
{
try 
	{	
		$kaart = str_replace('###naam###', $jarige->voornaam, $kaart);
		$mail->addAddress($jarige->emailadres);
		// $mail->Body = $forumMessage;
		// $mail->AltBody = htmlentities($mail->Body)
		$mail->msgHTML($kaart);
	/*************************************/
	/*  HIER wordt de email verstuurd!   */				
	/*************************************/
		logEmail($jarige->emailadres);
		if ($jarige->emailadres != '' && $jarige->emailadres == 'jang@jhm-zoetermeer.nl')
			$mail->send();
	}
	catch (Exception $e)
	{
		echo $e->errorMessage();
	}
	$mail->clearAddresses();
	logEmail($jarige->emailadres);
//			$mail->clearAttachments();		
}
unset($mail);
?>
