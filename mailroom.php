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
include_once 'class/c_topic.php';
include_once 'class/c_post.php';

// var_dump ($argv);

function logEmail ($emailadres)
{
	$date = new DateTime();
	$timestamp = $date->format("Y-m-d H:i:s-u e");
	$logtxt = $timestamp . ' - email sent to ' . $emailadres . "\r\n";
//	file_put_contents ($_SERVER['DOCUMENT_ROOT'] . '/forum_emails.txt', $logtxt, FILE_APPEND);
	file_put_contents ('mail_apps/forum_emails.txt', $logtxt, FILE_APPEND);
//	error_log($logtxt);
}

function getMsgHtml ()
{
	$html =  file_get_contents('mail_apps/JHMZforummsg.html', TRUE);
//	error_log($html);
	return $html;
}

// error_log('De mailroom is gestart!');
if ($argc != 4)
{
//	error_log('De mailroom is gestopt! Niet genoeg params.!');
	exit();
}
else
{
	$topic_id = $argv[1];
	$post_id = $argv[2];
	$user_id = $argv[3];
}
// error_log($topic_id . '/' . $post_id . '/' . $user_id);

$userOfPost = new User('id', $user_id);
$userName = '';
if ($userOfPost)
{
	$userName = $userOfPost->voornaam . ' ' . $userOfPost->tussenvoegsels . ' ' . $userOfPost->achternaam;
}
$topic = new Topic('id', $topic_id);
$post= new Post('id', $post_id);

$mail = new PHPMailer(TRUE);	
$mail->setFrom(MAIL_SENDEREMAIL, 'JobHulpMaatje Zoetermeer intranet forum');
$mail->addReplyTo('no-reply@jhmz.nl', 'No Reply');
$mail->isHTML(TRUE);
// if (strlen($post->tekst) < 80)
// {
// 	$mail->Subject = strip_tags($post->tekst);
// } else 
// {
// 	$mail->Subject = substr(strip_tags($post->tekst), 0, 80) . ' ...';
// }
$mail->Subject = $topic->onderwerp;
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

$forumMessage = getMsgHtml ();

$forumMessage = str_replace('###message_topic###', $topic->onderwerp, $forumMessage);
$forumMessage = str_replace('###message_text###', $post->tekst, $forumMessage);
$forumMessage = str_replace('###topic_id###', $topic->id, $forumMessage);
$forumMessage = str_replace('###naam###', $userName, $forumMessage);
// error_log($forumMessage);
// Log in op <a href="https://intra.jhmz.nl/forum/overz_topic.php?topicid=' . $this->id_topic  . '">JHM Zoetermeer intranet</a> om te lezen en te reageren.<br/>
foreach ($users->userColl as $user) 
{
	
	try 
	{				
		$mail->addAddress($user->emailadres);
		// $mail->Body = $forumMessage;
		// $mail->AltBody = htmlentities($mail->Body)
		$mail->msgHTML($forumMessage);
	/*************************************/
	/*  HIER wordt de email verstuurd!   */				
	/*************************************/
		logEmail($user->emailadres);
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
	logEmail($user->emailadres);
//			$mail->clearAttachments();		
}
unset($mail);
?>