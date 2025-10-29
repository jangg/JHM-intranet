<?php
include_once ('c_jobgroup.php');

class Jgsessie
{
	protected $id;
	protected $titel;
	protected $id_jobgroup;
	protected $sessienr;
	protected $id_locatie;
	protected $datetime_start;
	protected $datetime_end;
	
	public function __construct() 
	{
		$this->id 			= NULL;
		$this->titel 		= '';
		$this->id_jobgroup 	= '';
		$this->sessienr 	= 0;
		$this->id_locatie 	= '';
		$this->datetime_start = '';
		$this->datetime_end	= '';
		
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
			$this->id 			= $row['id'];
			$this->titel 		= html_entity_decode($row['titel']);
			$this->id_jobgroup 	= $row['id_jobgroup'];
			$this->sessienr 	= $row['sessienr'];;
			$this->id_locatie 	= $row['id_locatie'];
			$this->datetime_start 	= $row['datetime_start'];
			$this->datetime_end	= $row['datetime_end'];
		} else $this->id = NULL;
	}
	public function __construct2 ($attr, $value)
	{
		/* id of titel is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
			$this->__construct1($this->readJgsessieWithId($value));
			break;
						
			default:
			return FALSE;
		}
		
	}
	public function __destruct ()
	{
	}
	protected function readJgsessieWithId ($id)
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
			$sql = "SELECT * FROM jgsessie WHERE id = :id LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $id, PDO::PARAM_STR);
			//			echo $sql . '<br/>';
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jgsessie 1) met de database mislukt: ' . $e->getMessage());
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
		'$this->id = ' . $this->id 			.	
		'$this->titel = ' . $this->titel 		.
		'$this->id_jobgroup = ' . $this->id_jobgroup 	.
		'$this->sessienr = ' . $this->sessienr  	.
		'$this->id_locatie = ' . $this->id_locatie 	.
		'$this->datetime_start = ' . $this->datetime_start 	.
		'$this->datetime_end = ' . $this->datetime_end;

		
	}

	public function saveToDB () 
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT jgsessie 
			(	id,
				titel		 ,
				id_jobgroup ,
				sessienr ,
				id_locatie ,
				datetime_start ,
				datetime_end
			)
			VALUES (
				:id,
				:titel		 ,
				:id_jobgroup ,
				:sessienr ,
				:id_locatie ,
				:datetime_start ,
				:datetime_end
			)";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"			, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":id_jobgroup"	, $this->id_jobgroup, PDO::PARAM_STR);
			$stmt->bindValue( ":sessienr"		, $this->sessienr, PDO::PARAM_STR);
			$stmt->bindValue( ":id_locatie"		, $this->id_locatie, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_start"	, $this->datetime_start, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_end"	, $this->datetime_end, PDO::PARAM_STR);
			$stmt->execute();
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jgsessie 3) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		/* Check of de startdatum van de JobGroup aangepast moet worden en zo ja, uitvoeren */
		$jg = new Jobgroup ('id', $this->id_jobgroup);
		if ($jg->startDate == '' || substr($this->datetime_start, 0, 10) < $jg->startDate)
		{
			$jg->startDate = substr($this->datetime_start, 0, 10);
			$jg->updateToDB();
		}
		return TRUE;	
	}
	public function updateToDB () 
	{
		global $connection;
		try
		{
			openDB();
			$sql = "UPDATE jgsessie SET
				titel		 	= :titel, 
				id_jobgroup	 	= :id_jobgroup,
				sessienr	 	= :sessienr,
				id_locatie	 	= :id_locatie,		
				datetime_start	 = :datetime_start, 		
				datetime_end	 = :datetime_end
			WHERE id		 = :id";
			
			// error_log($sql);
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"			, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":id_jobgroup"	, $this->id_jobgroup, PDO::PARAM_STR);
			$stmt->bindValue( ":sessienr"		, $this->sessienr, PDO::PARAM_STR);
			$stmt->bindValue( ":id_locatie"		, $this->id_locatie, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_start"	, $this->datetime_start, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_end"	, $this->datetime_end, PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jgsessie 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		/* Check of de startdatum van de JobGroup aangepast moet worden en zo ja, uitvoeren */
		$jg = new Jobgroup ('id', $this->id_jobgroup);
		if ($jg->startDate == '' || substr($this->datetime_start, 0, 10) < $jg->startDate)
		{
			$jg->startDate = substr($this->datetime_start, 0, 10);
			$jg->updateToDB();
		}
		return TRUE;	
	}
	
	public function deleteFromDB () 
	{
		global $connection;
		try
		{
			openDB();
			$sql = "DELETE FROM jgsessie
				WHERE id		 = :id";
			
			// error_log($sql);
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jgsessie 6) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;
	}
	
	public function objectToJSON ()
	{
		$jsonstr = '{
		"id"			: "' . $this->id . '",	
		"titel"			: "' . $this->titel . '",
		"id_jobgroup"	: "' . $this->id_jobgroup . '",
		"sessienr"		: "' . $this->sessienr . '",
		"id_locatie"	: "' . $this->id_locatie. '",
		"datetime_start": "' . $this->datetime_start. '",
		"datetime_end"	: "' . $this->datetime_end. '"
		}';
		return $jsonstr;
	}
}
?>
