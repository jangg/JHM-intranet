<?php
class Locatie
{
	protected $id;
	protected $titel;
	protected $straat;
	protected $huisnummer;
	protected $postcode;
	protected $plaats;
	protected $sublocatie;
	
	public function __construct() 
	{
		$this->id 			= NULL;
		$this->titel 		= '';
		$this->straat 		= '';
		$this->huisnummer 	= '';
		$this->postcode		= '';
		$this->plaats 		= '';
		$this->sublocatie 	= '';
		
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
			$this->id 				= $row['id'];
			$this->titel 			= html_entity_decode($row['titel']);
			$this->straat 			= html_entity_decode($row['straat']);
			$this->huisnummer 	= html_entity_decode($row['huisnummer']);
			$this->postcode		= html_entity_decode($row['postcode']);
			$this->plaats 			= html_entity_decode($row['plaats']);
			$this->sublocatie 	= html_entity_decode($row['sublocatie']);
		} else $this->id = NULL;
	}
	public function __construct2 ($attr, $value)
	{
		/* id of titel is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
			$this->__construct1($this->readLocatieWithId($value));
			break;
			case 'titel':
			$this->__construct1($this->readLocatieWithTitel($value));
			break;
			
			default:
			return FALSE;
		}
		
	}
	public function __destruct ()
	{
	}
	protected function readLocatieWithId ($id)
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
			$sql = "SELECT * FROM locatie WHERE id = :id LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $id, PDO::PARAM_STR);
			//			echo $sql . '<br/>';
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (locatie 1) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return $row;	
	}
	protected function readLocatieWithTitel ($titel)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM locatie WHERE titel = :titel LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":titel", $titel, PDO::PARAM_STR);
			//			echo $sql . '<br/>';
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (locatie 2) met de database mislukt: ' . $e->getMessage());
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
		'$this->id  = ' . $this->id 			.
		'$this->titel  = ' . $this->titel 		.
		'$this->straat  = ' . $this->straat 		.
		'$this->huisnummer  = ' . $this->huisnummer 	.
		'$this->postcode  = ' . $this->postcode		.
		'$this->plaats  = ' . $this->plaats 		.
		'$this->sublocatie = ' . $this->sublocatie;

		
	}

	public function saveToDB () 
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT locatie 
			(	id 			,
				titel 		,
				straat 		,
				huisnummer 	,
				postcode	,	
				plaats 		,
				sublocatie 
			)
			VALUES (
				:id 	,		
				:titel 	,	
				:straat ,		
				:huisnummer ,	
				:postcode,		
				:plaats ,		
				:sublocatie 	
			)";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"			, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":straat"			, htmlentities($this->straat, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":huisnummer"		, htmlentities($this->huisnummer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":postcode"		, htmlentities($this->postcode, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":plaats"			, htmlentities($this->plaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":sublocatie"		, htmlentities($this->sublocatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (locatie 3) met de database mislukt: ' . $e->getMessage());
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
			$sql = "UPDATE locatie SET
				titel				= :titel,		
				straat				= :straat,		
				huisnummer			= :huisnummer,	
				postcode			= :postcode,	
				plaats				= :plaats,		
				sublocatie			= :sublocatie						
			WHERE id		 = :id";
			
			// error_log($sql);
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"			, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":straat"			, htmlentities($this->straat, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":huisnummer"		, htmlentities($this->huisnummer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":postcode"		, htmlentities($this->postcode, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":plaats"			, htmlentities($this->plaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":sublocatie"		, htmlentities($this->sublocatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (locatie 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
}
?>
