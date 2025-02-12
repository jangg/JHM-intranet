<?php
class Opmerking
{
	protected $id;
	protected $id_werkzkd;
	protected $id_user;
	protected $dt_opmerking;
	protected $opmerking;
	
	public function __construct() 
	{
		$this->id = '';
		$this->id_werkzkd = '';
		$this->id_user = '';
		$this->dt_opmerking = '';
		$this->opmerking = '';
		
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) 
        { 
            call_user_func_array(array($this,$f),$a); 
        }
	}
	public function __construct2 ($attr, $value)
	{
		switch ($attr)
		{
			case 'id':
			$this->__construct1($this->readOpmerkingWithId($value));
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
			$this->id_werkzkd 	= $row['id_werkzkd'];
			$this->id_user 		= $row['id_user'];
			$this->dt_opmerking 		= $row['dt_opmerking'];
			$this->opmerking 	= html_entity_decode($row['opmerking']);
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
		'$this->id 			: ' . $this->id .
		'$this->id_werkzkd 	: ' . $this->id_werkzkd .
		'$this->id_user 	: ' . $this->id_user .
		'$this->dt_opmerking 	: ' . $this->dt_opmerking .
		'$this->opmerking : ' . $this->opmerking;
	}
	protected function readProcesstapWithId ($id)
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
			$sql = "SELECT * FROM opmerking WHERE id = :id;";
			
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
		try
		{			
			openDB();
			$date = new DateTime();
			$this->dt_opmerking = $date->format('Y-m-d H:i:s');
			$sql = "INSERT processtap 
			(	id 			,
				id_werkzkd 	,
				id_user 	,
				dt_opmerking 	,
				opmerking )
			VALUES (
				:id 		,
				:id_werkzkd ,
				:id_user 	,
				:dt_opmerking 	,
				:opmerking
			);";
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":id_werkzkd"		, $this->id_werkzkd, PDO::PARAM_STR);
			$stmt->bindValue( ":id_user"		, $this->id_user, PDO::PARAM_STR);
			$stmt->bindValue( ":dt_opmerking"		, $this->dt_opmerking, PDO::PARAM_STR);
			$stmt->bindValue( ":opmerking"	, htmlentities($this->opmerking, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (opmerking 1) met de database mislukt: ' . $e->getMessage());
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
			$sql = "UPDATE processtap SET
				id_werkzkd 	= :id_werkzkd,
				id_user 	= :id_user,
				dt_opmerking 	= :dt_opmerking,
				opmerking = :opmerking
			WHERE id		 = :id;";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":id_werkzkd"		, $this->id_werkzkd, PDO::PARAM_STR);
			$stmt->bindValue( ":id_user"		, $this->id_user, PDO::PARAM_STR);
			$stmt->bindValue( ":dt_opmerking"		, $this->dt_opmerking, PDO::PARAM_STR);
			$stmt->bindValue( ":opmerking"	, htmlentities($this->opmerking, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (opmerking 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
}
?>
