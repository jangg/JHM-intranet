<?php
include_once('c_person.php');
class User extends Person
{
	protected $id;
	protected $id_person;
	protected $username;
	protected $password;
	protected $password_mod;
	protected $activity;
	protected $beheerind;
	protected $berichtInd;
	protected $berichtSentInd;
	protected $forumNoteInd;
	protected $id_team;
	
	public function __construct () 
	{
		$this->id             = NULL;
		$this->id_person      = NULL;
		$this->username       = '';
		$this->password 	  = '';
		$this->password_mod	  = '';
		$this->activity       = '';
		$this->beheerind      = '';
		$this->berichtInd       = '';
		$this->berichtSentInd       = '';
		$this->forumNoteInd	   ='';
		$this->id_team = NULL;
		parent::__construct ();	
	
		$a = func_get_args(); 
		$i = func_num_args();
		if (method_exists($this,$f='__construct'.$i)) {
			call_user_func_array(array($this,$f),$a);
		}
	}

	public function __construct1 ($userrow) 
	{

		if ($userrow)
		{
			$this->id             = $userrow['id'];
			$this->id_person      = $userrow['id_person'];
			$this->username       = html_entity_decode($userrow['username']);
			$this->password 	  = html_entity_decode($userrow['password']);
			$this->password_mod	  = $userrow['password_mod'];
			$this->activity       = $userrow['activity'];
			$this->beheerind      = $userrow['beheerind'];
			$this->berichtInd       = $userrow['berichtInd'];
			$this->berichtSentInd       = $userrow['berichtSentInd'];
			$this->forumNoteInd	   = $userrow['forumNoteInd'];
			$this->id_team	   = $userrow['id_team'];
			parent::__construct1 ($userrow);		
		}
		else
			$this->id = NULL;

	}
	
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB 
			als HistId wordt gebruikt dan wordt ook een user gegeven die delind = n heeft. De user bestaat dus niet op het moment van ophalen maar staat wel in de database
		*/
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readUserWithId($value, NULL));
				break;				
			case 'username':
				$this->__construct1($this->readUserWithUsername($value));
				break;
			case 'id_person':
				$this->__construct1($this->readUserWithId_person($value));
				break;
			case 'emailadres':
				$this->__construct1($this->readUserWithEmailadres($value));
				break;
			case 'histid':
				$this->__construct1($this->readUserWithId($value, 'h'));
				break;
			default:
				return FALSE;
		}
	}
		
	public function readUserWithId ($attr, $h)
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
			$sql = "SELECT user.*, person.* FROM user JOIN person ON user.id_person = person.person_id WHERE user.id = :id ";
			if ($h != 'h')
				$sql .= "AND person.delind = 'n' ";
			$sql .= "LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$userrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (user 2) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return $userrow;	
	}

	public function readUserWithUsername ($attr)
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
			$sql = "SELECT user.*, person.* FROM user JOIN person ON user.id_person = person.person_id WHERE user.username = :username AND person.delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":username", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$userrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (user 3) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	    return $userrow;	
	}
	
	public function readUserWithId_person ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT user.*, person.* FROM user JOIN person ON user.id_person = person.person_id WHERE user.id_person = :id_person AND person.delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id_person", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$userrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (user 5) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return $userrow;	
	}

	public function readUserWithEmailadres ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT user.*, person.* FROM user INNER JOIN person ON user.id_person = person.person_id WHERE person.emailadres = :emailadres AND person.delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":emailadres", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$userrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (user 4) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return $userrow;	
	}

	public function isBeheerder ()
	{
		/*
		beheerind:
			empty    	= no authorization
			3			= read
			6			= read/write
			9			= all
		*/
		if ($this->beheerind == 'j' || $this->beheerind == '9')
		return TRUE;
		else
		return FALSE;
	}
	
	public function authLevel ()
	{
		/*
		beheerind:
			empty/0    	= no authorization
			3			= read
			6			= read/write
			9			= all
		*/
		if (is_numeric($this->beheerind))
			return $this->beheerind;
		else
		{
			if ($this->beheerind == 'j')
				 return '9';
			else return '0';
		}
	}
	
	public function mustChangePassword()
	{
		if ($this->password_mod == 'j')
		return TRUE;
		else 
		return FALSE;
	}
	
	public function updateToDB () 
	{
		global $connection;
		try
		{
			// openDB();
			$sql = "UPDATE user SET
								id_person =		:id_person   , 
								username =		:username    , 
								password = 		:password 	 , 
								password_mod = 		:password_mod 	 , 
								activity =		:activity    , 
								beheerind =		:beheerind   , 
								berichtInd =	:berichtInd    , 
								berichtSentInd = :berichtSentInd ,
								forumNoteInd = :forumNoteInd ,
								id_team = :id_team 
							WHERE id = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"          , $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":id_person"   , $this->id_person, PDO::PARAM_STR);
			$stmt->bindValue( ":username"    , htmlentities($this->username, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":password" 	 , htmlentities($this->password, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":password_mod" 	 , $this->password_mod, PDO::PARAM_STR);
			$stmt->bindValue( ":activity"    , $this->activity, PDO::PARAM_STR);
			$stmt->bindValue( ":beheerind"   , $this->beheerind, PDO::PARAM_STR);
			$stmt->bindValue( ":berichtInd"    , $this->berichtInd, PDO::PARAM_STR);
			$stmt->bindValue( ":berichtSentInd"	, $this->berichtSentInd, PDO::PARAM_STR);
			$stmt->bindValue( ":forumNoteInd"	, $this->forumNoteInd, PDO::PARAM_STR);
			$stmt->bindValue( ":id_team"	, $this->id_team, PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (user 5) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		parent::updateToDB ();
		return TRUE;	
	}

}
