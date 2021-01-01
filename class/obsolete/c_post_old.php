<?php
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';
include_once 'c_user_coll.php';
include_once 'c_user.php';

class Post
{
	protected $id;
	protected $tekst;
	protected $datum;
	protected $id_topic;
	protected $id_user;
	
	public function __construct() 
	{
		$this->id = NULL;
		$this->tekst = '';
		$this->datum = '';
		$this->id_topic = NULL;
		$this->id_user = NULL;
		
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) 
        { 
            call_user_func_array(array($this,$f),$a); 
        }
	}
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
			$this->__construct1($this->readPostWithId($value));
			break;
			
			default:
			return FALSE;
		}
		
	}
	
	public function __construct1 ($row) 
	{
		if ($row)
		{
			$this->id 			= $row['id'];
			$this->tekst		= $row['post_content'];
			$this->datum		= $row['post_date'];
			$this->id_topic		= $row['id_topic'];
			$this->id_user		= $row['id_user'];
		}
		else {
			$this->id = NULL;
		}
	}
	public function __destruct ()
	{
	}
	public function __get($attr)
	{
		return $this->$attr;
	}
	public function __set($attr, $value)
	{
		$this->$attr = $value;
	}
	public function __toString()
	{
		/* hier printen we het object mee uit, voor testdoeleinden */
		return 
			'$id		: ' . $this->id .			'<br/>' .
			'$tekst		: ' . $this->tekst .	'<br/>' .
			'$datum		: ' . $this->datum .		'<br/>' .
			'$id_topic	: ' . $this->id_topic .		'<br/>' .
			'$id_user	: ' . $this->id_user .		'<br/>';
	}
	protected function readPostWithId ($id)
	{
		/* Haal de gegevens uit de database
		$userid kan 2 soorten waarde hebben:
		NULL of 0 => het object bestaat niet in de database => zo laten
		integer => het object kan uit de DB gelezen worden => ophalen en attrs vullen
		*/
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM posts WHERE id = :id;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $id, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			return FALSE;
		}
		return $row;	
	}
	public function saveToDB () 
	{
		global $connection;
		/* zorg dat een foto goed wordt weergegeven */
		$this->tekst = preg_replace('/"width: .*"/', '"width: 100%;"', $this->tekst);
		try
		{			
			openDB();
			$sql = "INSERT posts 
			(	id,
				post_content		 ,
				post_date ,
				id_topic ,
				id_user
			)
			VALUES (
				:id,
				:tekst		 ,
				NOW() ,
				:id_topic ,
				:id_user
			)";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			// $stmt->bindValue( ":tekst"		, htmlentities($this->tekst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":tekst"			, $this->tekst, PDO::PARAM_STR);
			$stmt->bindValue( ":id_topic"		, htmlentities($this->id_topic, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":id_user"		, htmlentities($this->id_user, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			//			 error_log('Een nieuwe c_person is toegevoegd');
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (posts 1) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		/* Bij iedere post die wordt toegevoegd krijgen deelnemers een email */
		$arr1 = array (	array (0 => 'user.forumNoteInd', 1 => 'j'));
		$arr2 = '';
		
		$userColl = new User_coll ($arr1, $arr2);
		$this->sendEmail($userColl);
		return TRUE;	
	}

	public function updateToDB () 
	{
		global $connection;
		/* zorg dat een foto goed wordt weergegeven */
		$this->tekst = preg_replace('/"width: .*"/', '"width: 100%;"', $this->tekst);
		try
		{
			openDB();
			$sql = "UPDATE posts SET
			post_content		 = :tekst,
			post_date		  = :datumnw,
			id_topic	= :id_topic,
			id_user		= :id_user
			WHERE id		 = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":tekst"			, $this->tekst, PDO::PARAM_STR);
			$stmt->bindValue( ":datumnw"		, htmlentities($this->datum, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":id_topic"		, htmlentities($this->id_topic, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":id_user"		, htmlentities($this->id_user, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (posts 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
	public function getShortPost($wordsreturned)
	/*  Returns the first $wordsreturned out of $string.  If string
	contains more words than $wordsreturned, the entire string
	is returned.*/
	{
		$array = explode(" ", $this->tekst);
		/*  Already short enough, return the whole thing*/
		if (count($array) <= $wordsreturned)
		{
			$retval = $this->tekst;
		}
		/*  Need to chop of some words*/
		else
		{
			array_splice($array, $wordsreturned);
			$retval = implode(" ", $array) . " .....";
		}
		return $retval;
	}
	
	private function sendEmail ($emailTo)
	{
		$userOfPost = new User('id', $this->id_user);
		$topic = new Topic('id', $this->id_topic);
		
		if(isset($_SESSION['username']))
		{
			$username = $_SESSION['username'];
		}
		
		$mail = new PHPMailer(TRUE);	
		$mail->setFrom(MAIL_SENDEREMAIL, 'JobHulpMaatje Zoetermeer intranet forum');
		$mail->addReplyTo('no-reply@jhmz.nl', 'No Reply');
		$mail->isHTML(TRUE);
		$cleantxt = strip_tags($this->tekst);	
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
		
		// Log in op <a href="https://intra.jhmz.nl/forum/overz_topic.php?topicid=' . $this->id_topic  . '">JHM Zoetermeer intranet</a> om te lezen en te reageren.<br/>
		foreach ($emailTo->userColl as $user) 
		{
			
			try 
			{				
				$mail->addAddress($user->emailaddress);
				$mail->Body = '<html><head></head><body><p>
				Beste '. $user->username . ',<br/><br/>   
				
				Er is een nieuw bericht op het JobHulpMaatje forum geplaatst door <strong>' . $userOfPost->username . '</strong><br/>
				<br/><br/>
				<strong>Onderwerp</strong>:<br/><br/>' .
				$topic->onderwerp .
				'<br/><br/><strong>Bericht</strong>: <br/><br/>' .
				$this->tekst . '   ' . '<br/><br/>
				
				Log in op <a href="https://intra.jhmz.nl/forum/overz_topic.php?topicid=' . $this->id_topic  . '">JHM Zoetermeer intranet</a> om te lezen en te reageren.<br/>
				<u>Let op!: antwoord op deze email wordt niet gelezen en heeft daarom geen zin.</u><br/>
				
				</p></body></html>';
				$mail->AltBody = htmlentities($mail->Body);
			/*************************************/
			/*  HIER wordt de email verstuurd!   */				
			/*************************************/
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
//		    $mail->clearAttachments();		
		}
		unset($mail);
	}
	
	private function execInBackground($cmd) { 
		if (substr(php_uname(), 0, 7) == "Windows"){ 
			pclose(popen("start /B ". $cmd, "r"));  
		} 
		else { 
			exec($cmd . " > /dev/null &");   
		} 
	}
}
?>
