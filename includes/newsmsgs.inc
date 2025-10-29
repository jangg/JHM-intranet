<?php

function getMsgs ($number, $naam)
{
	/****
	** haal de 10 meest recente artikelen op die intern moeten worden gepubliceerd
	*****/
	
	$arr1 = array (array (0 => 'pubind_intern', 1 => 'j'));
	$arr2 = array (array (0 => 'datetime_pub_intern', 1 => 'ASC'));
	
	$newsitemColl = new Newsitem_coll($arr1, $arr2, 10);
	
	$newsitemHTML = array();
	$n = 0;
	foreach ($newsitemColl->newsitemColl as $newsitem) 
	{
		$datum = new DateTimeImmutable($newsitem->datetime_pub_intern);
		
		$newsitemHTML[$n] = '
					<h3 class="bluefont">' . $newsitem->titel . '</h3>
					<h5 class="bluefont">' . strftime('%e %B %Y', $datum->getTimestamp()) . '</h5>'
					;
		
		if ($newsitem->picfile1 <> '' && file_exists('img/' . $newsitem->picfile1)) {			
			$newsitemHTML[$n] .= '				
						<figure class="figure float-left" style="width: 100%; margin-right: 0px;">
						<img src="img/' . $newsitem->picfile1 . '" class="figure-img img-fluid" alt="JobHulp Culemborg">
						</figure>';
		}
		
		$newsitemHTML[$n] .=
					$newsitem->tekst_kort;
					
		if ($newsitem->tekst_knop <> '' && $newsitem->link_knop <> '')
		{
			$newsitemHTML[$n] .= '
			<p><a class="btn btn-primary" href="' . $newsitem->link_knop . '" role="button">' . $newsitem->tekst_knop . ' &raquo;</a></p>';
		}
		
		$n++;
	}
	return $newsitemHTML;
}
?>