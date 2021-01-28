<?php
class Jobgroup
{
	protected $id;
	protected $titel;
	protected $id_locatie;
	protected $startDate;
	protected $soort;
	protected $onlineInd;
	protected $nbrSessies;
	protected $nbrPlaatsen;
	
	public function __construct() 
	{
		$this->id 			= NULL;
		$this->titel 		= '';
		$this->id_locatie 	= '';
		$this->startDate 	= NULL;
		$this->soort	 	= '';
		$this->onlineInd	 = 'n';
		$this->nbrSessies	= 0;
		$this->nbrPlaatsen 	= 0;
		
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
			$this->titel 		= $row['titel'];
			$this->id_locatie 	= $row['id_locatie'];
			$this->startDate 	= $row['startdate'];
			$this->soort 		= $row['soort'];
			$this->onlineInd 	= $row['onlineind'];
			$this->nbrSessies	= $row['nbrsessies'];
			$this->nbrPlaatsen 	= $row['nbrplaatsen'];
		} else $this->id = NULL;
	}
	public function __construct2 ($attr, $value)
	{
		/* id of titel is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
			$this->__construct1($this->readJobgroupWithId($value));
			break;
			case 'titel':
			$this->__construct1($this->readJobgroupWithTitel($value));
			break;
			
			default:
			return FALSE;
		}
		
	}
	public function __destruct ()
	{
	}
	protected function readJobgroupWithId ($id)
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
			$sql = "SELECT * FROM jobgroup WHERE id = :id LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $id, PDO::PARAM_STR);
			//			echo $sql . '<br/>';
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jobgroup 1) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return $row;	
	}
	protected function readJobgroupWithTitel ($titel)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM jobgroup WHERE titel = :titel LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":titel", $titel, PDO::PARAM_STR);
			//			echo $sql . '<br/>';
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jobgroup 2) met de database mislukt: ' . $e->getMessage());
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
		'$this->id_locatie = ' . $this->id_locatie 	.
		'$this->startDate = ' . $this->startDate 	.
		'$this->soort = ' . $this->soort 	.
		'$this->onlineInd = ' . $this->onlineInd 	.
		'$this->nbrSessies = ' . $this->nbrSessies	.
		'$this->nbrPlaatsen = ' . $this->nbrPlaatsen;

		
	}

	public function saveToDB () 
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT jobgroup 
			(	id,
				titel		 ,
				id_locatie ,
				startdate ,
				onlineind ,
				nbrsessies ,
				nbrplaatsen
			)
			VALUES (
				:id,
				:titel		 ,
				:id_locatie ,
				:startdate,
				:soort ,
				:onlineind,
				:nbrsessies ,
				:nbrplaatsen	 
			)";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"			, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":id_locatie"		, $this->id_locatie, PDO::PARAM_STR);
			$stmt->bindValue( ":startdate"		, $this->startDate, PDO::PARAM_STR);
			$stmt->bindValue( ":soort"			, $this->soort, PDO::PARAM_STR);
			$stmt->bindValue( ":onlineind"		, $this->onlineInd, PDO::PARAM_STR);
			$stmt->bindValue( ":nbrsessies"		, $this->nbrSessies, PDO::PARAM_STR);
			$stmt->bindValue( ":nbrplaatsen"	, $this->nbrPlaatsen, PDO::PARAM_STR);
			$stmt->execute();
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jobgroup 3) met de database mislukt: ' . $e->getMessage());
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
			$sql = "UPDATE jobgroup SET
				titel		 = :titel, 
				id_locatie	 = :id_locatie,		
				startdate	 = :startdate,
				soort	 	 = :soort,
				onlineind	 	= :onlineind, 		
				nbrsessies	 = :nbrsessies,		
				nbrplaatsen  = :nbrplaatsen		
			WHERE id		 = :id";
			
			// error_log($sql);
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"			, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":id_locatie"		, $this->id_locatie, PDO::PARAM_STR);
			$stmt->bindValue( ":startdate"		, $this->startDate, PDO::PARAM_STR);
			$stmt->bindValue( ":soort"			, $this->soort, PDO::PARAM_STR);
			$stmt->bindValue( ":onlineind"		, $this->onlineInd, PDO::PARAM_STR);
			$stmt->bindValue( ":nbrsessies"		, $this->nbrSessies, PDO::PARAM_STR);
			$stmt->bindValue( ":nbrplaatsen"	, $this->nbrPlaatsen, PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jobgroup 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
	
}
?>
