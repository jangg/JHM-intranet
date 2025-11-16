<?php
function MailRoom ($username, $emailadres, $onderwerp, $tekst)
{
	$mail_body = 'Gebruiker ' . $username . ' heeft een  nieuw topic aangemaakt in het Forum.' . "\r\n\r\n";
	$mail_body .= 'Onderwerp: '. $onderwerp 	. "\r\n\r\n";
	$mail_body .= 'Bericht: ' . 	$tekst;
	
	$email = $emailadres;
	$subject = 'Nieuw topic in JHMZ forum';
	$mail_body = $tekst;
	$Sendernaam = "JHM Zoetermeer intranet"; //senders name
	$header = "From: " . $Sendernaam . " (" . 'info@machunter.nl' . ")\r\n";
	$header .= 'MIME-Version: 1.0' . "\r\n";
	$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	return mail($email, $subject, $mail_body, $header);
}
?>
