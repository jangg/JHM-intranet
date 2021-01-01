<?php

include_once ('../config.php');
include_once ('../class/c_user.php');
/***************************************************************************/
function getBerichtHtml ()
{
	$html = file_get_contents('emails/bericht01.html', TRUE);
/* 	$html = str_replace ('###emailadres###', $e, $html); */
//  	echo $html;
	return $html;
}

function checkEmail ($a)
{
	$result = FALSE;
	if (filter_var($a, FILTER_VALIDATE_EMAIL))
	{
		$result = TRUE;
	}
	return $result;
}

function init ()
{
	global $con;
	global $prodswitch;
	$prodswitch = 'test';
	$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
	$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$sql = "SELECT * FROM keytabel WHERE sleutel = 'userBericht';";
	$stmt = $con->prepare( $sql );
	$stmt->execute();
	$rows = $stmt->fetchAll();
	if(!$rows) 
	{
		$prodswitch = 'test';
	}
	else
	{
		$prodswitch = $rows[0]['waarde'];
	}
	
	set_time_limit(900);
	
	echo '<br/>Start verzenden berichten<br/><br/>sleutel "Email bericht": waarde "' . $prodswitch . '"<br/><br/>';
}

function close ()
{
	echo '<br/>Einde verzenden berichten<br/><br/>';

}

function sendBerichten ()
{
	global $con;
	try
	{
		$sql = "SELECT user.id, user.emailaddress, user.berichtInd, user.berichtSentInd, person.voornaam FROM user, person WHERE user.id_person = person.id";
		$stmt = $con->prepare( $sql );
		$stmt->execute();
		$rows = $stmt->fetchAll();
		if(!$rows) 
		{
			error_log ('Hier gaat iets fout! Geen personen gevonden in de DB!');
			exit();
		}
		else
		{
			$bericht = getBerichtHtml();
			sendEmail('jangg@mac.com', $bericht, '0');
			foreach ($rows as $row)
			{
				// echo $row['emailaddress'] . ' - ' . $row['berichtInd'] . '<br/>';				
				if (checkEmail($row['emailaddress']))
				{
					if ($row['berichtInd'] == 'j')
					{
						if ($row['berichtSentInd'] == 'j')
						{
							echo $row['emailaddress'] . ' heeft bericht AL ONTVANGEN.!' . '<br/>';
						}
						else
						{
							$pers_bericht = str_replace('###voornaam###', $row['voornaam'], $bericht);
							sendEmail($row['emailaddress'], $pers_bericht, $row['id']);							
						}
					}
					else
					{
						echo $row['emailaddress'] . ' krijgt GEEN bericht.!' . '<br/>';	
					}
					
				}
				else 
				{
					echo $row['emailaddress'] . ' is een foutief emailadres!' . '<br/>';	
				}
			}
		}
	}
	catch (PDOException $e) 
	{
		echo 'Connectie met de database mislukt: ' . $e->getMessage();
	}
	$con = null;
}

function sendEmail ($email, $bericht, $userid)
{
	global $prodswitch;
	$Name = "JHM Zoetermeer intranet"; //senders name
	$subject = 'JHMZ intranet bericht'; //subject
	$headers = "From: ". $Name . " <" . 'info@jhmz.nl' . ">\r\n"; //optional headerfields
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$mail_body = $bericht;
	$result = FALSE;
//******************************************************************************************
//  
// Hieronder staat de beveiliging voor het testen. Wees voorzichtig met aanpassen.
// Voor je het weet verstuur je ongewild nieuwsbrieven naar de mensen uit de DB.
//  
//  
//******************************************************************************************

	if ($prodswitch == 'productie')
	{
	
//**********Regel hieronder is voor productie********************************************************************************
		$result = mail($email, $subject, $mail_body, $headers);
// 		$result = TRUE;	

		if($result) echo 'PRODUCTIE --- ' . $email . ' heeft een bericht ontvangen!' . '<br/>';
			else
			echo 'PRODUCTIE --- ' . $email . ' heeft GEEN bericht ontvangen! Fout bij verzenden.' . '<br/>';
//******************************************************************************************
		/* En nu persoon bijwerken: nieuwsbriefSent wordt 'j' */
		$user = new User ('id', $userid);
		if ($user->id != NULL)
		{
			$user->berichtSentInd = 'j';
			$user->updateToDB();			
		}
	}
	else
	{
		if ($email != 'jangg@mac.com')
		{
			echo 'TEST --- ' . $email . ' heeft een bericht ontvangen! (Maar niet echt!)' . '<br/>';
		}
		else 
		{
			$result = mail($email, $subject, $mail_body, $headers);
			$result = TRUE;	
			if($result) echo 'TEST --- ' . $email . ' heeft een bericht ontvangen!' . '<br/>';
			else
			echo 'TEST --- ' . $email . ' heeft GEEN bericht ontvangen! Fout bij verzenden.' . '<br/>';

		}
	}
//******************************************************************************************
	
}

//******************************************************************************************
// 1. Init
// 1.1 Haal emailtekst op
// 2. Lees tabel persoon, check of e-mail geldig is en nwbrf ind op 'j' staat.
// 3. Stuur nieuwsbrief naar email
// 4. Afsluiting
//******************************************************************************************

if (isset($_POST['switch']) && $_POST['switch'] == 'j')
{
	init ();
	
	sendBerichten ();
	
	close ();
	
	unset($_POST['switch']);
}

?>
<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bericht JHMZ versturen</title>
<meta name="description" content="" />
</head>
<body>
	
    <form  method="POST" action="sendEmail.php" novalidate>
	<p>Berichten worden verstuurd naar adressen uit tabel user in de database.</p>
    <button id="knop" type="submit" name="switch" value="j">
   Verstuur
    </button>						
</body>
</html>