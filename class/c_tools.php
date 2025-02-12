<?php
class Tools
{	
	public static $statusArray = array (
		'---' => '',
		'000' => 'Nieuw',
		'020' => 'Aanmelding bevestigd, wacht op reactie',
		'030' => 'Contact gehad',
		'100' => 'Intake gepland',
		'101' => 'Intake afspraak niet nagekomen',
		'110' => 'Intake afgenomen',
		'120' => 'Intake gegevens bijgewerkt',
		'150' => 'No show, na 1ste gesprek',
		'200' => 'Intake akkoord en gearchiveerd',
		'250' => 'Aangemeld voor Workshop NetWerken',
		'260' => 'Uitgenodigd voor deelname JobGroup',
		'300' => 'JobGroup geplaatst',
		'301' => 'JobGroup plaatsing ingetrokken',
		'310' => 'JobGroup iWIN geplaatst',
		'311' => 'JobGroup iWIN plaatsing ingetrokken',
		'320' => 'JobGroup ZZP geplaatst',
		'321' => 'JobGroup ZZP plaatsing ingetrokken',
		'400' => 'Jobgroup afgerond',
		'401' => 'Jobgroup afgebroken',
		'410' => 'Jobgroup iWIN afgerond',
		'411' => 'Jobgroup iWIN afgebroken',
		'420' => 'Jobgroup ZZP afgerond',
		'421' => 'Jobgroup ZZP afgebroken',
		'500' => 'Maatje aangemeld en gekoppeld',
		'510' => 'Match-afspraak gemaakt',
		'511' => 'Match-afspraak ingetrokken',
		'520' => 'Begeleidingsovereenkomst getekend en gearchiveerd',
		// '550' => 'Groepsmaatje',
		'590' => 'Maatje afgemeld en ontkoppeld',
		// '750' => 'Dolaard',
		'800' => 'Uitstroom',
		'810' => 'Uitstroom naar Werk/Opleiding',
		'820' => 'Kopie contract aangeleverd',
		'900' => 'Afronding',
		'910' => 'Evaluatie-formulier verzonden',
		'920' => 'Afzwaaibrief verzonden',
		'940' => 'Doorverwezen naar andere instantie',
		'950' => 'Uitgeschreven'
	);
	
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
	
	public static function MailRoom ($nameTo, $emailTo, $onderwerp, $tekst)
	{   
		$subject = $onderwerp;
		$mail_body = $tekst;
		
		$header = "From: " . 'no-reply@jhm-zoetermeer.nl' . " (" . 'no-reply@jhm-zoetermeer.nl' . ")\r\n";
		$header .= 'MIME-Version: 1.0' . "\r\n";
		$header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		return mail($emailTo, $subject, $mail_body, $header);
	}
	

	
		
}
?>