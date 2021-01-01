<?php
global $argc, $argv;
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
include_once('config.php');
include_once 'class/c_user_coll.php';
include_once 'class/c_user.php';
include_once 'class/c_topic.php';
include_once 'class/c_post.php';

// var_dump ($argv);

function logEmail ($emailaddress)
{
	$date = new DateTime();
	$timestamp = $date->format("Y-m-d H:i:s-u e");
	$logtxt = $timestamp . ' - email sent to ' . $emailaddress . "\r\n";
	file_put_contents ($_SERVER['DOCUMENT_ROOT'] . '/forum_emails.txt', $logtxt, FILE_APPEND);
	// error_log($logtxt);
}

if ($argc != 4)
	exit();
else
{
	$topic_id = $argv[1];
	$post_id = $argv[2];
	$user_id = $argv[3];
}

$userOfPost = new User('id', $user_id);
$topic = new Topic('id', $topic_id);
$post= new Post('id', $post_id);

$mail = new PHPMailer(TRUE);	
$mail->setFrom(MAIL_SENDEREMAIL, 'JobHulpMaatje Zoetermeer intranet forum');
$mail->addReplyTo('no-reply@jhmz.nl', 'No Reply');
$mail->isHTML(TRUE);
$cleantxt = strip_tags($post->tekst);	
// $cleantxt = htmlentities($post->tekst);	
if (strlen($cleantxt) < 50)
{
	$mail->Subject = $cleantxt;
} else 
{
	$mail->Subject = substr($cleantxt, 0, 50) . ' ...';
}
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

$arr1 = array (	array (0 => 'user.forumNoteInd', 1 => 'j'));
$arr2 = '';

$users = new User_coll ($arr1, $arr2);


// Log in op <a href="https://intra.jhmz.nl/forum/overz_topic.php?topicid=' . $this->id_topic  . '">JHM Zoetermeer intranet</a> om te lezen en te reageren.<br/>
foreach ($users->userColl as $user) 
{
	
	try 
	{				
		$mail->addAddress($user->emailaddress);
		$mail->Body = '<html><head></head><body>
		<p>Beste '. $user->username . ',<br/><br/>   
		
		Jazeker!
		Er is een nieuw bericht op het JobHulpMaatje forum geplaatst door <strong>' . $userOfPost->username . '</strong><br/>
		<br/><br/>
		<span>----------------------------------------------------------------------</span><br/><br/>
		<strong>Onderwerp</strong>:<br/><br/>' .
		$topic->onderwerp .
		'<br/><br/><strong>Bericht</strong>: <br/><br/>' .
		$post->tekst . '   ' . '<br/><br/>

		<span>----------------------------------------------------------------------</span><br/><br/>
		
		Log in op <a href="https://intra.jhmz.nl/forum/overz_topic.php?topicid=' . $post->id_topic  . '">JHM Zoetermeer intranet</a> om te lezen en te reageren.<br/>
		<u>Let op!: antwoord op deze email wordt niet gelezen en heeft daarom geen zin.</u><br/>
		
		</p>
		</body></html>';
		$mail->AltBody = htmlentities($mail->Body);
	/*************************************/
	/*  HIER wordt de email verstuurd!   */				
	/*************************************/
		// logEmail($user->emailaddress);
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
	$mail->clearAddresses();
	logEmail($user->emailaddress);
//			$mail->clearAttachments();		
}
unset($mail);
?>