<?php
class Aantekening
{
	protected $id;
	protected $delind;
	protected $id_user;
	protected $id_werkzkd;
	protected $datetime_created;
	protected $tekst;
	
	public function __construct() 
	{
		$this->id 				= NULL;
		$this->delind 			= 'n';
		$this->id_user 			= NULL;
		$this->id_werkzkd 		= NULL;
		$this->datetime_created = NULL;
		$this->tekst 			= '';
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) 
        { 
            call_user_func_array(array($this,$f),$a); 
        }
	}

	public function __construct1 ($row) 
	{
		if ($row)
		{
			$this->id 					= $row['id'];			
			$this->delind 				= $row['delind']; 			
			$this->id_user 			= $row['id_user'];			
			$this->id_werkzkd 		= $row['id_werkzkd']; 			
			$this->datetime_created = $row['datetime_created'];
			$this->tekst 				= html_entity_decode($row['tekst']);
		} else $this->id = NULL;
	}
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
			$this->__construct1($this->readTopicWithId($value));
			break;
			
			default:
			return FALSE;
		}
		
	}
	public function __destruct ()
	{
	}
	protected function readAantekeningWithId ($id)
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
			$sql = "SELECT * FROM aantekening WHERE id = :id LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $id, PDO::PARAM_STR);
			//			echo $sql . '<br/>';
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (aantekening 1) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return $row;	
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
			'$id		: ' . $this->id 				.	'<br/>' .
			'$delind	: ' . $this->delind 			.	'<br/>' .
			'$id_user		: ' . $this->id_user 			.	'<br/>' .
			'$id_werkzkd	: ' . $this->id_werkzkd 			.	'<br/>' .
			'$datetime_created	: ' . $this->datetime_created .	'<br/>' .
			'$tekst	: ' . $this->tekst 			.	'<br/>';
	}
	
	public function saveToDB () 
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT aantekening 
			(	id,
				delind,
				id_user,
				id_werkzkd,
				datetime_created,
				tekst
			)
			VALUES (
				:id,
				:delind		 ,
				:id_user ,
				:id_werkzkd ,
				:datetime_created ,
				:tekst
			)";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"			, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":id_user"		, $this->id_user, PDO::PARAM_STR);
			$stmt->bindValue( ":id_werkzkd"		, $this->id_werkzkd, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_created", $this->datetime_created, PDO::PARAM_STR);
			$stmt->bindValue( ":tekst"			, htmlentities($this->tekst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			// error_log('Een nieuwe c_topic is toegevoegd');
			// error_log($sql);
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (aantekening 2) met de database mislukt: ' . $e->getMessage());
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
			$sql = "UPDATE aantekening SET
				id 					= :id,			
				delind		 		= :delind,			
				id_user 			= :id_user,	
				id_werkzkd 			= :id_werkzkd,		
				datetime_created 	= :datetime_created,
				tekst 				= :tekst";			
			
			// error_log($sql);
			
				$stmt = $connection->prepare( $sql );
				$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
				$stmt->bindValue( ":delind"			, $this->delind, PDO::PARAM_STR);
				$stmt->bindValue( ":id_user"		, $this->id_user, PDO::PARAM_STR);
				$stmt->bindValue( ":id_werkzkd"		, $this->id_werkzkd, PDO::PARAM_STR);
				$stmt->bindValue( ":datetime_created", $this->datetime_created, PDO::PARAM_STR);
				$stmt->bindValue( ":tekst"			, htmlentities($this->tekst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
				$stmt->execute();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (aantekening 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
	
}
?>
