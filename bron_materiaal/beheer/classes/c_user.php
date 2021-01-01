<?php
class User 
{
	protected $id;
	protected $id_person;
	protected $delind;
	protected $username;
	protected $password;
	/* password_mod is een indicator. j = password moet gewijzigd worden, andere waarde = password is ok */
	protected $password_mod;
	protected $emailaddress;
	protected $salt;
	protected $activity;
	protected $created;
	protected $beheerind;
	protected $comm_mod;
	protected $comm_vis;

	public function __construct () {
		$delind = 'n';

        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }
     	
	public function __construct1 ($userrow) 
	{
/*
		if ($userrow)
		{
*/
			$this->id             = $userrow['id'];
			$this->id_person      = $userrow['id_person'];
			$this->delind  		  = $userrow['delind'];
			$this->username       = html_entity_decode($userrow['username']);
			$this->password 	  = html_entity_decode($userrow['password']);
			$this->password_mod	  = $userrow['password_mod'];
			$this->emailaddress   = html_entity_decode($userrow['emailaddress']);
			$this->salt       	  = html_entity_decode($userrow['salt']);
			$this->activity       = $userrow['activity'];
			$this->created        = $userrow['created'];
			$this->beheerind      = $userrow['beheerind'];
			$this->comm_mod       = $userrow['comm_mod'];
			$this->comm_vis       = $userrow['comm_vis'];
/*
		}
		else
			$this->id = NULL;
*/
	}
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readUserWithId($value));
				break;
				
			case 'username':
				$this->__construct1($this->readUserWithUsername($value));
				break;
				
			case 'emailaddress':
				$this->__construct1($this->readUserWithEmailaddress($value));
				break;
				
			default:
				return FALSE;
		}
		
	}
	public function __destruct ()
	{
//		echo 'User ' . $this->id . ' is vernietigd<br/>';
	}
	
	public function __get($attr)
	{
		return $this->$attr;
	}

	public function __set($attr, $value)
	{
		/* hier moet nog wel per attr de value worden gechecked */
		$this->$attr = $value;
	}
	
	public function __toString()
	{
		/* hier printen we het object mee uit, voor testdoeleinden */
		return 
			'$id            : ' . $this->id             . '<br/>' .
			'$id_person     : ' . $this->id_person      . '<br/>' .
			'$delind        : ' . $this->delind  		  . '<br/>' .
			'$username      : ' . $this->username       . '<br/>' .
			'$password      : ' . $this->password 	  . '<br/>' .
			'$password_mod      : ' . $this->password_mod 	  . '<br/>' .
			'$emailaddress  : ' . $this->emailaddress   . '<br/>' .
			'$salt          : ' . $this->salt       	  . '<br/>' .
			'$activity      : ' . $this->activity       . '<br/>' .
			'$created       : ' . $this->created        . '<br/>' .
			'beheerind      : ' . $this->beheerind       . '<br/>' .
			'$comm_mod      : ' . $this->comm_mod       . '<br/>' .
			'$comm_vis      : ' . $this->comm_vis       . '<br/>';
	}
	
	public function insertToDB () 
	{
		global $connection;
		try
		{
			openDB();
			$sql = "INSERT user VALUES (
									:id          , 
									:id_person   , 
									:delind  	 , 
									:username    , 
									:password 	 , 
									:password_mod 	 , 
									:emailaddress, 
									:salt        , 
									:activity    , 
									:created     , 
									:beheerind    , 
									:comm_mod    , 
									:comm_vis    )"; 
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"          , NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":id_person"   , $this->id_person, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"  	 , $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":username"    , htmlentities($this->username, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":password" 	 , htmlentities($this->password, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":password_mod" 	 , $this->password_mod, PDO::PARAM_STR);
			$stmt->bindValue( ":emailaddress", htmlentities($this->emailaddress, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":salt"        , htmlentities($this->salt, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":activity"    , $this->activity, PDO::PARAM_STR);
			$stmt->bindValue( ":created"     , $this->created, PDO::PARAM_STR);
			$stmt->bindValue( ":beheerind"   , $this->beheerind, PDO::PARAM_STR);
			$stmt->bindValue( ":comm_mod"    , $this->comm_mod, PDO::PARAM_STR);
			$stmt->bindValue( ":comm_vis"    , $this->comm_vis, PDO::PARAM_STR);
			$stmt->execute();
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (user 1) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}

	public function updateToDB () 
	{
		global $connection;
		try
		{
			openDB();
			$sql = "UPDATE user SET
								id_person =		:id_person   , 
								delind =		:delind  	 , 
								username =		:username    , 
								password = 		:password 	 , 
								password_mod = 		:password_mod 	 , 
								emailaddress =	:emailaddress, 
								salt =			:salt        , 
								activity =		:activity    , 
								created =		:created     , 
								beheerind =		:beheerind   , 
								comm_mod =		:comm_mod    , 
								comm_vis =		:comm_vis 
							WHERE id = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"          , $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":id_person"   , $this->id_person, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"  	 , $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":username"    , htmlentities($this->username, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":password" 	 , htmlentities($this->password, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":password_mod" 	 , $this->password_mod, PDO::PARAM_STR);
			$stmt->bindValue( ":emailaddress", htmlentities($this->emailaddress, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":salt"        , htmlentities($this->salt, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":activity"    , $this->activity, PDO::PARAM_STR);
			$stmt->bindValue( ":created"     , $this->created, PDO::PARAM_STR);
			$stmt->bindValue( ":beheerind"   , $this->beheerind, PDO::PARAM_STR);
			$stmt->bindValue( ":comm_mod"    , $this->comm_mod, PDO::PARAM_STR);
			$stmt->bindValue( ":comm_vis"    , $this->comm_vis, PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (user 5) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}
	protected function readUserWithId ($id)
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
			$sql = "SELECT * FROM user WHERE id = :id  AND delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $id, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$userrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (user 2) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $userrow;	
	}
	
	protected function readUserWithUsername ($attr)
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
			$sql = "SELECT * FROM user WHERE username = :username AND delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":username", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$userrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (user 3) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $userrow;	
	}
	
	protected function readUserWithEmailaddress ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM user WHERE emailaddress = :emailaddress  AND delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":emailaddress", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$userrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (user 4) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $userrow;	
	}
	
	public function isBeheerder ()
	{
		if ($this->beheerind == 'j')
		return TRUE;
		else
		return FALSE;
	}

	public function isIntern ()
	{
		if ($this->comm_vis == 'j')
		return TRUE;
		else
		return FALSE;
	}
	
	public function mustChangePassword()
	{
		if ($this->password_mod == 'j')
		return TRUE;
		else 
		return FALSE;
	}
}
