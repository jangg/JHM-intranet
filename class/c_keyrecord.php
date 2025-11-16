<?php
/* Namespace alias. */
class Keyrecord
{
	protected $id;
	protected $sleutel;
	protected $waarde;
	
	public function __construct() 
	{
		$this->id = NULL;
		$this->sleutel = '';
		$this->waarde = '';
		
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) 
        { 
            call_user_func_array(array($this,$f),$a); 
        }
	}
	public function __construct2 ($attr, $value)
	{
		/* sleutel is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'sleutel':
			$this->__construct1($this->readKeyrecordWithSleutel($value));
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
			$this->sleutel		= html_entity_decode($row['sleutel']);
			$this->waarde		= $row['waarde'];
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
			'$sleutel	: ' . html_entity_decode($this->sleutel) .	'<br/>' .
			'$waarde	: ' . html_entity_decode($this->waarde) .	'<br/>';
	}
	
	protected function readKeyrecordWithSleutel ($sleutel)
	{
		/* Haal de gegevens uit de database
		*/
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM keytabel WHERE sleutel = :sleutel;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":sleutel", $sleutel, PDO::PARAM_STR);
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
		try
		{			
			openDB();
			$sql = "INSERT keytabel 
			(	id,
				sleutel		 ,
				waarde
			)
			VALUES (
				:id,
				:sleutel,
				:waarde
			)";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
 			$stmt->bindValue( ":sleutel"		, htmlentities($this->sleutel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":waarde"			, htmlentities($this->waarde, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);

			$stmt->execute();
			$this->id = $connection->lastInsertId();
			// error_log($this->id);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (keytabel 1) met de database mislukt: ' . $e->getMessage());
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
			$sql = "UPDATE keytabel SET
			sleutel		 = :sleutel,
			waarde		 = :waarde,
			WHERE id	 = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":sleutel"		, htmlentities($this->sleutel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":waarde"			, htmlentities($this->waarde, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (keytabel 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
}
?>
