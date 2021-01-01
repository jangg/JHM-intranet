<?php

/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

/* Exception class. */
require 'PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(TRUE);

try {
   
   $mail->setFrom('intra@jhmz.nl', 'JobHulpMaatje Zoetermeer intranet');
   $mail->addAddress('jangg@mac.com', 'Jantje');
   $mail->Subject = 'Een nieuwe bericht op het JHMZ forum';
   $mail->Body = '<html><head></head><body><p>
   Beste Jan,<br/><br/>   
   
   Er is een nieuw bericht op het JobHulpMaatje forum geplaatst door <bold>' . $userOfPost->username . '</bold><br/>
   <br/><br/>
   Topic:<br/>' .
   $topic->onderwerp .
   '<br/><br/>Bericht: <br/>' .
   $this->tekst . '   ' . '<br/><br/>
   
   Log in op <a href="https://intra.jhmz.nl/forum/overz_cat.php?id=' . $this->id_topic  . '">JHM intranet</a> om te lezen en te reageren.<br/><br/>
   
   </p></body></html>';
   
   /* SMTP parameters. */
   
   /* Tells PHPMailer to use SMTP. */
   $mail->isSMTP();
   $mail->SMTPDebug = SMTP::DEBUG_SERVER;
   
   /* SMTP server address. */
   $mail->Host = 'smtp.ziggo.nl';

   /* Use SMTP authentication. */
   $mail->SMTPAuth = TRUE;
   
   /* Set the encryption system. */
   // $mail->SMTPSecure = 'tls';
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
   /* SMTP authentication username. */
   $mail->Username = 'j.geerdes@casema.nl';
   
   /* SMTP authentication password. */
   $mail->Password = 'Opgep1st!';
   
   /* Set the SMTP port. */
   $mail->Port = 587;    
   
   // $mail->SMTPOptions = array(
   //    'ssl' => array(
   //    'verify_peer' => false,
   //    'verify_peer_name' => false,
   //    'allow_self_signed' => true
   //    )
   // );
/* Finally send the mail. */
   $mail->send();
}
catch (Exception $e)
{
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   echo $e->getMessage();
}
?>