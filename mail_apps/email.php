<?php

// $email and $message are the data that is being
// posted to this page from our html contact form
$email = $_REQUEST['email'] ;
$message = $_REQUEST['message'] ;

// When we unzipped PHPMailer, it unzipped to
// public_html/PHPMailer_5.2.0
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();
$mail->SMTPDebug = 0;
// $mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
// As this email.php script lives on the same server as our email server
// we are setting the HOST to localhost
$mail->Host = "localhost"; // specify main and backup server

$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Port = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
// When sending email using PHPMailer, you need to send from a valid email address
// In this case, we setup a test email account with the following credentials:
$mail->Username = "info@machunter.nl"; // SMTP username
$mail->Password = "Opgep1st&123"; // SMTP password

// $email is the user's email address the specified
// on our contact us page. We set this variable at
// the top of this page with:
// $email = $_REQUEST['email'] ;
$mail->From = 'info@machunter.nl';

// below we want to set the email address we will be sending our email to.
$mail->AddAddress($email, "Jan Geerdes");

// set word wrap to 50 characters
$mail->WordWrap = 50;
// set email format to HTML
$mail->IsHTML(true);

$mail->Subject = "You have received feedback from your website! Yes!";

// $message is the user's message they typed in
// on our contact us page. We set this variable at
// the top of this page with:
// $message = $_REQUEST['message'] ;
$mail->Body = $message;
$mail->AltBody = $message;

if(!$mail->Send())
{
echo "Message could not be sent. <p>";
echo "Mailer Error: " . $mail->ErrorInfo;
exit;
}
else {
	echo "Message was successfully sent. <p>";
	exit();
}

echo "Message has been sent";
?>