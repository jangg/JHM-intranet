<?php
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../PHPMailer/src/Exception.php';
	
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include_once ('c_keyrecord.php');

class Tools
{	
	private static ?PHPMailer $mailer = null;  // PHP 7.4+: typed property
	public static array $statusArray = [];
			
	public static function ConvertTS ($date)
	{
		$months = [
			'January'		=> 'januari',
			'February'	 	=> 'februari',
			'March' 		=> 'maart',
			'April'			=> 'april',
			'May' 			=> 'mei',
			'June' 			=> 'juni',
			'July' 			=> 'juli',
			'August' 		=> 'augustus',
			'September' 	=> 'september',
			'October' 		=> 'oktober',
			'November' 		=> 'november',
			'December' 		=> 'december'
		];
		
		$monthsshort = [
			'Jan' => 'jan',
			'Feb' => 'feb',
			'Mar' => 'maa',
			'Apr' => 'apr',
			'May' => 'mei',
			'Jun' => 'jun',
			'Jul' => 'jul',
			'Aug' => 'aug',
			'Sep' => 'sept',
			'Oct' => 'okt',
			'Nov' => 'nov',
			'Dec' => 'dec'
		];
		
		$weekdays = [
			'Monday' 	=> 'maandag',
			'Tuesday' 	=> 'dinsdag',
			'Wednesday' => 'woensdag',
			'Thursday' 	=> 'donderdag',
			'Friday' 	=> 'vrijdag',
			'Saturday' 	=> 'zaterdag',
			'Sunday' 	=> 'zondag'
		];

		$tmpdate2 = '';
		if ($date != '')
		{
			/* als yyyy-mm-dd hh:mm:ss ==> dd mmm yyyy hh:mm */
			if (preg_match("/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2} [0-9]{1,2}:[0-9]{1,2}:[0-9]{1,2}$/", $date) !== 0)
			{
				$tmpdate = DateTime::createFromFormat('Y-m-d H:i:s', $date);
				$tmpdate2 = $tmpdate->format("j M Y H:i");
				$tmpdate2 = str_replace(array_keys($monthsshort), array_values($monthsshort), $tmpdate2);
			} else {
			/* als dd mmm yyyy hh:mm ==> yyyy-mm-dd hh:mm:ss*/
			if (preg_match("/^[0-9]{1,2} [a-z,A-Z]{3} [0-9]{4} [0-9]{1,2}:[0-9]{1,2}$/", $date) !== 0)
			{
				$tmpdate = str_replace(array_values($monthsshort), array_keys($monthsshort), $date);
				$tmpdate = DateTime::createFromFormat('d M Y H:i', $tmpdate);
				$tmpdate2 = $tmpdate->format("Y-m-d H:i:00");
			} else {
			/* als yyyy-mm-dd ==> dd mmm yyyy s*/
			if (preg_match("/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/", $date) !== 0)
			{
				$tmpdate = DateTime::createFromFormat('Y-m-d', $date);
				$tmpdate2 = $tmpdate->format("j M Y");
				$tmpdate2 = str_replace(array_keys($monthsshort), array_values($monthsshort), $tmpdate2);
			} else {
			/* als dd mmm yyyy ==> yyyy-mm-dd */
			if (preg_match("/^[0-9]{1,2} [a-z,A-Z]{3} [0-9]{4}$/", $date) !== 0)
			{
				$tmpdate = str_replace(array_values($monthsshort), array_keys($monthsshort), $date);
				$tmpdate = DateTime::createFromFormat('d M Y', $tmpdate);
				$tmpdate2 = $tmpdate->format("Y-m-d");
			}}}}
		} 		
		return $tmpdate2;
	}
	
	public static function ConvertTS2 ($date, $par)
	{
		$months = [
			'January'		=> 'januari',
			'February'	 	=> 'februari',
			'March' 		=> 'maart',
			'April'			=> 'april',
			'May' 			=> 'mei',
			'June' 			=> 'juni',
			'July' 			=> 'juli',
			'August' 		=> 'augustus',
			'September' 	=> 'september',
			'October' 		=> 'oktober',
			'November' 		=> 'november',
			'December' 		=> 'december'
		];
		
		$monthsshort = [
			'Jan' => 'jan',
			'Feb' => 'feb',
			'Mar' => 'maa',
			'Apr' => 'apr',
			'May' => 'mei',
			'Jun' => 'jun',
			'Jul' => 'jul',
			'Aug' => 'aug',
			'Sep' => 'sept',
			'Oct' => 'okt',
			'Nov' => 'nov',
			'Dec' => 'dec'
		];
		
		$weekdays = [
			'Monday' 	=> 'maandag',
			'Tuesday' 	=> 'dinsdag',
			'Wednesday' => 'woensdag',
			'Thursday' 	=> 'donderdag',
			'Friday' 	=> 'vrijdag',
			'Saturday' 	=> 'zaterdag',
			'Sunday' 	=> 'zondag'
		];

		$tmpdate2 = '';
		if ($date != '')
		{
			/* als yyyy-mm-dd hh:mm:ss ==> dd mmm yyyy hh:mm */
			if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$/", $date) !== 0)
			{
				$tmpdate = DateTime::createFromFormat('Y-m-d H:i:s', $date);
			}	
			else
			{
				if (preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $date) !== 0)
				{
					$tmpdate = DateTime::createFromFormat('Y-m-d', $date);
				}
			}
			
			switch ($par)
			{
				case 'datum':
					$tmpdate2 = $tmpdate->format("j M Y");
					$tmpdate2 = str_replace(array_keys($monthsshort), array_values($monthsshort), $tmpdate2);
					break;
				case 'tijd':
					$tmpdate2 = $tmpdate->format("H:i");
					break;
				case 'weekdag':
					$tmpdate2 = $tmpdate->format("l");
					$tmpdate2 = str_replace(array_keys($weekdays), array_values($weekdays), $tmpdate2);
					break;
				case 'verjaardag':
					$tmpdate2 = $tmpdate->format("j F");
					$tmpdate2 = str_replace(array_keys($months), array_values($months), $tmpdate2);
				break;

				default:				
			}
		}
		return $tmpdate2;
	}
	
	public static function getShortPost($text, $wordsreturned)
	/*  Returns the first $wordsreturned out of $string.  If string
	contains more words than $wordsreturned, the entire string
	is returned.*/
	{
		$array = explode(" ", $text);
		/*  Already short enough, return the whole thing*/
		if (count($array) <= $wordsreturned)
		{
			$textShort = $text;
		}
		/*  Need to chop of some words*/
		else
		{
			array_splice($array, $wordsreturned);
			$textShort = implode(" ", $array) . " .....<br/>";
		}
		return $textShort;
	}

	public static function checkDate($date, $format)
	{		
		switch ($format)
		{
			case 'jjjj-mm-dd':
				$noError = TRUE;
				if (!(substr($date, 0, 4) > 1900 && substr($date, 0, 4) < 2030)) $noError = FALSE;
				if (!(substr($date, 5, 2) > 0 && substr($date, 5, 2) < 13)) $noError = FALSE;
				if (!(substr($date, 8, 2) > 0 && substr($date, 8, 2) < 32)) $noError = FALSE;
				break;
			default:
				$noError = FALSE;
		}
		return $noError;
	}
	
	public static function timeSelection ()
	{
		return '
		<option value="07:00">07:00</option>
		<option value="07:30">07:30</option>
		<option value="08:00">08:00</option>
		<option value="08:30">08:30</option>
		<option value="09:00">09:00</option>
		<option value="09:30">09:30</option>
		<option value="10:00">10:00</option>
		<option value="10:30">10:30</option>
		<option value="11:00">11:00</option>
		<option value="11:30">11:30</option>
		<option value="12:00">12:00</option>
		<option value="12:30">12:30</option>
		<option value="13:00">13:00</option>
		<option value="13:30">13:30</option>
		<option value="14:00">14:00</option>
		<option value="14:30">14:30</option>
		<option value="15:00">15:00</option>
		<option value="15:30">15:30</option>
		<option value="16:00">16:00</option>
		<option value="16:30">16:30</option>
		<option value="17:00">17:00</option>
		<option value="17:30">17:30</option>
		<option value="18:00">18:00</option>
		<option value="18:30">18:30</option>
		<option value="19:00">19:00</option>
		<option value="19:30">19:30</option>
		<option value="20:00">20:00</option>
		<option value="20:30">20:30</option>
		<option value="21:00">21:00</option>
		<option value="21:30">21:30</option>
		<option value="22:00">22:00</option>
		<option value="22:30">22:30</option>
		<option value="23:00">23:00</option>
		';
	}
	
	public static function getStatusOms($code) 
	{
		return (isset(self::$statusArray[$code]) ? self::$statusArray[$code] : 'onbekend');
	}
	
	public static function getStatusArray()
	{
		return self::$statusArray;
	}
	
	public static function sectOne ()
	{
		global $sectionNumber;
		global $sectionSwitch;
		
		if (isset($sectionSwitch) && $sectionSwitch == 'same')
		{
			if ($sectionNumber == 'two')
				$result = FALSE; else $result = TRUE;
		} else
		{
			if ($sectionNumber == 'two')
			{
				$sectionNumber = 'one';
				$result = TRUE;
			} else 
			{
				$sectionNumber = 'two';
				$result = FALSE;
			}
		}	
		$sectionSwitch = '';
		return $result;			
	}
	
	public static function calculateAge($date)
	{
		  //explode the date to get month, day and year
		  $birthDate = explode("-", $date);
		  //get age from date or birthdate
		  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[2], $birthDate[0]))) > date("md")
			? ((date("Y") - $birthDate[0]) - 1)
			: (date("Y") - $birthDate[0]));
		  return $age;
	}
	
	private static function getMailer(): PHPMailer
	{
		if (self::$mailer === null)
		{
			$mail = new PHPMailer(true);
			$mail->isSMTP();
			$mail->Host       = MAIL_SMTP_SERVER;
			$mail->SMTPAuth   = true;
			$mail->Username   = MAIL_USERID;
			$mail->Password   = MAIL_PASSWORD;
			$mail->SMTPSecure = MAIL_SMTPSECURE === 'tls'
				? PHPMailer::ENCRYPTION_STARTTLS
				: PHPMailer::ENCRYPTION_SMTPS;
			$mail->Port       = MAIL_SMTPSECURE === 'tls' ? 587 : 465;
			$mail->CharSet    = 'UTF-8';
			$mail->isHTML(true);
			$mail->SMTPDebug  = MAIL_DEBUG_IND ?? 0;
	
			// SMTP-verbinding open houden tussen verzendingen
			$mail->SMTPKeepAlive = true;
	
			self::$mailer = $mail;
		}
		return self::$mailer;
	}
	
	public static function closeMailer(): void
	{
		if (self::$mailer !== null)
		{
			self::$mailer->smtpClose();
			self::$mailer = null;
		}
	}

	public static function MailRoom($nameTo, $emailTo, $onderwerp, $tekst)
	{
		// Maak een nieuw PHPMailer-object
		$mail = self::getMailer();
		// echo 'MailRoom is gestart.<br/>';
		try {
			// Ontvanger & inhoud instellen (per aanroep anders)
			$mail->clearAddresses();
			$mail->clearReplyTos();
	
			// Afzender & ontvanger
			$mail->setFrom(MAIL_SENDEREMAIL, LOC_NAME);
			$mail->addReplyTo(MAIL_NOREPLYEMAIL, 'No Reply');
			$mail->addAddress($emailTo, $nameTo);
	
			// E-mailinhoud
			$mail->Subject = $onderwerp;
			$mail->Body    = $tekst;
			$mail->AltBody = strip_tags($tekst);        // Tekstversie (fallback)
			// Versturen
			$result = $mail->send();
			// echo 'Mail is verzonden.<br/>';
			// ===  Logging toevoegen  ===
			self::logMailAction($emailTo, $onderwerp, $result, $mail->ErrorInfo ?? '');
			// echo 'Regel is gelogd.<br/>';
			return $result;
		} catch (Exception $e) {
			// Eventuele fouten loggen
			error_log("Mail kon niet worden verzonden. Fout: {$mail->ErrorInfo}");
			// echo "Mail kon niet worden verzonden. Fout: {$mail->ErrorInfo}<br/>";
			// echo MAIL_SMTP_SERVER . '/' . MAIL_USERID . '/' . MAIL_PASSWORD;
			return false;
		}
	}
	
	/**
	 * Interne helperfunctie voor e-maillogging
	 */
	private static function logMailAction($emailTo, $subject, $success, $errorMessage = '')
	{
		// echo 'Start logging.<br/>';
		$tijdstip = (new DateTime())->format('Y-m-d H:i:s');
		$status   = $success ? 'OK' : 'FAILED';
		$logregel = sprintf(
			"%s | %s | %s | %s | %s\r\n",
			$tijdstip,
			$status,
			$emailTo,
			$subject,
			$errorMessage
		);
		// Logmap (pas eventueel pad aan)
		$logMap = MAIL_LOGDIR;
		if (!is_dir($logMap)) {
			mkdir($logMap, 0775, true);
		}
		$logBestand = $logMap . MAIL_LOGFILE;
		file_put_contents($logBestand, $logregel, FILE_APPEND);
		// echo $logregel . '<br/>';
	}

	public static function getKey($key)
	{
		$keyrecord = new Keyrecord('sleutel', $key);
		return $keyrecord->waarde;
	}
}

Tools::$statusArray = require __DIR__ . '/../includes/statuslijst.php';

?>