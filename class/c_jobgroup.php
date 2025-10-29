<?php
include_once('c_jgsessie.php');
class Jobgroup
{
	protected $id;
	protected $delind;
	protected $status;
	protected $titel;
	protected $omschrijving;
	protected $id_locatie;
	protected $startDate;
	protected $soort;
	protected $onlineInd;
	protected $nbrPlaatsen;
	protected $jgleider1;
	protected $jgleider2;
	protected $opmerkingen;
	
	public function __construct() 
	{
		$this->id 			= NULL;
		$this->delind 		= 'n';
		$this->status 		= '000';
		$this->titel 		= '';
		$this->omschrijving	= '';
		$this->id_locatie 	= '';
		$this->startDate 	= NULL;
		$this->soort	 	= '';
		$this->onlineInd	 = 'n';
		$this->nbrPlaatsen 	= 0;
		$this->jgleider1 	= '';
		$this->jgleider2 	= '';
		$this->opmerkingen 	= '';
		
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
			$this->delind 			= $row['delind'];
			$this->status 			= $row['status'];
			$this->titel 			= html_entity_decode($row['titel']);
			$this->omschrijving	= html_entity_decode($row['omschrijving']);
			$this->id_locatie 	= $row['id_locatie'];
			$this->startDate 		= $row['startdate'];
			$this->soort 			= $row['soort'];
			$this->onlineInd 		= $row['onlineind'];
			$this->nbrPlaatsen 	= $row['nbrplaatsen'];
			$this->jgleider1 		= $row['jgleider1'];
			$this->jgleider2 		= $row['jgleider2'];
			$this->opmerkingen 	= html_entity_decode($row['opmerkingen']);
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
			$sql = "SELECT * FROM jobgroup WHERE id = :id AND jobgroup.delind = 'n' LIMIT 1;";
			
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
			$sql = "SELECT * FROM jobgroup WHERE titel = :titel AND jobgroup.delind = 'n' LIMIT 1;";
			
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
		switch ($attr)
		{
			case "startDate":
				return $this->getStartdate();
				break;
			case 'nbrSessies':
				return $this->nbrSessies();
			default:
				return $this->$attr;
		}
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
		'$this->delind = ' . $this->delind 			.	
		'$this->status = ' . $this->status 		.
		'$this->titel = ' . $this->titel 		.
		'$this->omschrijving = ' . $this->omschrijving 		.
		'$this->id_locatie = ' . $this->id_locatie 	.
		'$this->startDate = ' . $this->startDate 	.
		'$this->soort = ' . $this->soort 	.
		'$this->onlineInd = ' . $this->onlineInd 	.
		'$this->nbrPlaatsen = ' . $this->nbrPlaatsen .
		'$this->jgleider1 	= ' . $this->jgleider1 .
		'$this->jgleider2 	= ' . $this->jgleider2 .
		'$this->opmerkingen 	= ' . $this->opmerkingen;
	}

	public function saveToDB () 
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT jobgroup 
			(	id,
				delind		 ,
				status		 ,
				titel		 ,
				id_locatie ,
				startdate ,
				soort ,
				onlineind ,
				nbrplaatsen ,
				omschrijving ,
				jgleider1 , 	
				jgleider2 ,	
				opmerkingen 
			)
			VALUES (
				:id,
				:delind,
				:status		 ,
				:titel		 ,
				:id_locatie ,
				:startdate,
				:soort ,
				:onlineind,
				:nbrplaatsen ,
				:omschrijving ,
				:jgleider1 	,
				:jgleider2 	,
				:opmerkingen 	 
			)";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"					, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"			, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":status"			, $this->status, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"				, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":omschrijving"	, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":id_locatie"		, $this->id_locatie, PDO::PARAM_STR);
			$stmt->bindValue( ":startdate"		, $this->startDate, PDO::PARAM_STR);
			$stmt->bindValue( ":soort"				, $this->soort, PDO::PARAM_STR);
			$stmt->bindValue( ":onlineind"		, $this->onlineInd, PDO::PARAM_STR);
			$stmt->bindValue( ":nbrplaatsen"		, $this->nbrPlaatsen, PDO::PARAM_STR);
			$stmt->bindValue( ":jgleider1"		, $this->jgleider1, PDO::PARAM_STR);
			$stmt->bindValue( ":jgleider2"		, $this->jgleider2, PDO::PARAM_STR);
			$stmt->bindValue( ":opmerkingen"		, htmlentities($this->opmerkingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
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
				delind		 = :delind,
				status		 = :status,
				titel		 = :titel,
				omschrijving = :omschrijving,
				id_locatie	 = :id_locatie,		
				startdate	 = :startdate,
				soort	 	 = :soort,
				onlineind	 = :onlineind, 		
				nbrplaatsen  = :nbrplaatsen,
				jgleider1 	 = :jgleider1 , 
				jgleider2 	 = :jgleider2,	
				opmerkingen  = :opmerkingen 
			WHERE id		 = :id";
			
			// error_log($sql);
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"			, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":status"			, $this->status, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"			, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":omschrijving"	, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":id_locatie"		, $this->id_locatie, PDO::PARAM_STR);
			$stmt->bindValue( ":startdate"		, $this->startDate, PDO::PARAM_STR);
			$stmt->bindValue( ":soort"			, $this->soort, PDO::PARAM_STR);
			$stmt->bindValue( ":onlineind"		, $this->onlineInd, PDO::PARAM_STR);
			$stmt->bindValue( ":nbrplaatsen"	, $this->nbrPlaatsen, PDO::PARAM_STR);
			$stmt->bindValue( ":jgleider1"		, $this->jgleider1, PDO::PARAM_STR);
			$stmt->bindValue( ":jgleider2"		, $this->jgleider2, PDO::PARAM_STR);
			$stmt->bindValue( ":opmerkingen"	, htmlentities($this->opmerkingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jobgroup 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
		
	public function nbrSessies()
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT COUNT(1) FROM jgsessie WHERE jgsessie.id_jobgroup = :jobgroupid;"; 		
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":jobgroupid"		, $this->id, PDO::PARAM_STR);
			$stmt->execute();
			$nbr = $stmt->fetchColumn();
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jgsessie in c_jobgroup 6) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return $nbr;
	}
	
	public function nbrDeelnemers()
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT COUNT(1) FROM werkzkd WHERE werkzkd.id_jobgroup = :jobgroupid;"; 		
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":jobgroupid"		, $this->id, PDO::PARAM_STR);
			$stmt->execute();
			$nbr = $stmt->fetchColumn();
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jgsessie in c_jobgroup 7) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return $nbr;
	}
	
	public function getStartdate ()
	{
		
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT jgsessie.datetime_start FROM jgsessie WHERE jgsessie.id_jobgroup = :jobgroupid ORDER BY jgsessie.datetime_start LIMIT 1;"; 		
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":jobgroupid"		, $this->id, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jgsessie in c_jobgroup 8) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		if (!empty($row))
			$retval = substr($row['datetime_start'], 0, 10);
			else
			$retval = '';
		return $retval;
	}
	
	public function alsPlaatsBeschikbaar()
	{
		if ($this->nbrPlaatsen > $this->nbrDeelnemers())
			return TRUE;
			else
			return FALSE;
	}

	public function delSubrecs()
	{
		/* verwijder relatie met deze JobGroup uit werkzoekenden en verwijder de sessies */
		global $connection;
		try
		{
			openDB();
			$sql = 'DELETE FROM jgsessie WHERE id_jobgroup = :jobgroupid;'; 		
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":jobgroupid"		, $this->id, PDO::PARAM_STR);
			$stmt->execute();			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (jgsessie in c_jobgroup 9) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		try
		{
			openDB();
			$sql = 'UPDATE werkzkd SET werkzkd.id_jobgroup = NULL WHERE werkzkd.id_jobgroup  = :jobgroupid;'; 		
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":jobgroupid"		, $this->id, PDO::PARAM_STR);
			$stmt->execute();			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (werkzkd in c_jobgroup 10) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
	}
}
?>
