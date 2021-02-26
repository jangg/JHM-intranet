<?php
class Tools
{	
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
			'Jun' => 'jui',
			'Jul' => 'jul',
			'Aug' => 'aug',
			'Sep' => 'sepr',
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
				$tmpdate2 = $tmpdate->format("d M Y H:i");
				$tmpdate2 = str_replace(array_keys($monthsshort), array_values($monthsshort), $tmpdate2);
			} else {
			if (preg_match("/^[0-9]{2} [a-z,A-Z]{3} [0-9]{4} [0-9]{1,2}:[0-9]{1,2}$/", $date) !== 0)
			{
				$tmpdate = str_replace(array_values($monthsshort), array_keys($monthsshort), $date);
				$tmpdate = DateTime::createFromFormat('d M Y H:i', $tmpdate);
				$tmpdate2 = $tmpdate->format("Y-m-d H:i:00");
			} else { 
			if (preg_match("/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/", $date) !== 0)
			{
				$tmpdate = DateTime::createFromFormat('Y-m-d', $date);
				$tmpdate2 = $tmpdate->format("d M Y");
				$tmpdate2 = str_replace(array_keys($monthsshort), array_values($monthsshort), $tmpdate2);
			} else {
			if (preg_match("/^[0-9]{2} [a-z,A-Z]{3} [0-9]{4}$/", $date) !== 0)
			{
				$tmpdate = str_replace(array_values($monthsshort), array_keys($monthsshort), $date);
				$tmpdate = DateTime::createFromFormat('d M Y', $tmpdate);
				$tmpdate2 = $tmpdate->format("Y-m-d");
			}}}}
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
			$textShort = implode(" ", $array) . " ..... <button class='btn btn-primary btn-sm m-0 p-0 px-1'>Lees meer</button>";
		}
		return $textShort;
	}

}
?>