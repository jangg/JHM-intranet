<?php
function getMsgHtml ()
{
	$html = file_get_contents('mail_apps/JHMZforummsg.html', TRUE);
//	error_log($html);
	return $html;
}

$forumMessage = getMsgHtml ();

$forumMessage = str_replace('###message_topic###', '$topic->onderwerp', $forumMessage);
$forumMessage = str_replace('###message_text###', '$post->tekst', $forumMessage);
echo $forumMessage;
?>