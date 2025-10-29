<?php
include_once('c_person.php');
class Maatje extends Person 
{
	protected $id;
	protected $id_person;
	protected $omschrijving;
	protected $functie;
	protected $actief_als;
	protected $mtjcrt_ind;
	protected $jglcrt_ind;
	/* 	A = als maatje
		B = als jobgroupleider
		K = als beide
		blanco = als niets
	*/
	
	public function __construct () 
	{
		$this->id				= NULL;
		$this->id_person		= NULL;
		$this->omschrijving	= '';
		$this->functie			= '';
		$this->actief_als		= '';
		$this->mtjcrt_ind		= 'n';
		$this->jglcrt_ind		= 'n';
		parent::__construct ();	
	
		$a = func_get_args(); 
		$i = func_num_args(); 
		if (method_exists($this,$f='__construct'.$i)) { 
			call_user_func_array(array($this,$f),$a);
		}
	}
	
	public function __construct1 ($maatjerow) 
	{
		if ($maatjerow)
		{
			$this->id			  	= $maatjerow['id'];
			$this->id_person	  	= $maatjerow['id_person'];
			$this->omschrijving	= html_entity_decode($maatjerow['omschrijving']);
			$this->functie		  	= html_entity_decode($maatjerow['functie']);
			$this->actief_als	  	= $maatjerow['actief_als'];
			$this->mtjcrt_ind	  	= $maatjerow['mtjcrt_ind'];
			$this->jglcrt_ind	  	= $maatjerow['jglcrt_ind'];
			parent::__construct1 ($maatjerow);
		}
		else
		{
			$this->id			  = '';
			$this->id_person	  = '';
			$this->omschrijving	  = '';
			$this->functie		  = '';
			$this->actief_als	  = '';
			$this->mtjcrt_ind		= 'n';
			$this->jglcrt_ind		= 'n';
			parent::__construct1 ($maatjerow);			
		}
	}
	
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readMaatjeWithId($value));
				break;
			case 'emailadres':
				$this->__construct1($this->readMaatjeWithEmailadres($value));
				break;				
			default:
				return FALSE;
		}
		
	}	
		
	public function __toString()
	{
		/* hier printen we het object mee uit, voor testdoeleinden */
		print_r (parent::__toString());
		return 
			'$id				: ' . $this->id	. '<br/>' .
			'$id_person			: ' . $this->id_person		. '<br/>' .
			'$omschrijving		: ' . $this->omschrijving		. '<br/>' .
			'$functie			: ' . $this->functie		. '<br/>' .
			'$actief_als		: ' . $this->actief_als	. '<br/>' .
			'$mtjcrt_ind		: ' . $this->mtjcrt_ind	. '<br/>' .
			'$jglcrt_ind			: ' . $this->jglcrt_ind	. '<br/>';
	}
	
	public function readMaatjeWithId ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT maatje.*, person.* FROM maatje JOIN person ON maatje.id_person = person.person_id WHERE maatje.id = :id AND person.delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$maatjerow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (maatje 2) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return $maatjerow;	
	}
	
		
	public function readMaatjeWithEmailadres ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT maatje.*, person.* FROM maatje JOIN person ON maatje.id_person = person.person_id WHERE person.emailadres = :emailadres AND person.delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":emailadres", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$maatjerow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (maatje 3) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return $maatjerow;	
	}
	
	public function saveToDB () 
	{
		openDB();
		if (!parent::saveToDB()) exit();
		global $connection;
		try
		{			
			$sql = "INSERT maatje 
			(	id 			,
				id_person 	,
				omschrijving 	,
				functie 	,
				actief_als , 
				mtjcrt_ind , 
				jglcrt_ind
			)
			VALUES (
				:id 			,
				:id_person 	,
				:omschrijving 	,
				:functie 	,
				:actief_als ,
				:mtjcrt_ind ,
				:jglcrt_ind
			);";
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"					, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":id_person"		, $this->id_person, PDO::PARAM_STR);
			$stmt->bindValue( ":omschrijving"	, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":functie"			, htmlentities($this->functie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":actief_als"		, $this->actief_als, PDO::PARAM_STR);
			$stmt->bindValue( ":mtjcrt_ind"		, $this->mtjcrt_ind, PDO::PARAM_STR);
			$stmt->bindValue( ":jglcrt_ind"		, $this->jglcrt_ind, PDO::PARAM_STR);
			$stmt->execute();
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (maatje 1) met de database mislukt: ' . $e->getMessage());
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
			$sql = "UPDATE maatje SET
				id_person       = :id_person	,
				omschrijving	= :omschrijving	,
				functie			= :functie,
				actief_als		= :actief_als ,
				mtjcrt_ind		= :mtjcrt_ind , 
				jglcrt_ind		= :jglcrt_ind
				WHERE id = :id;";
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"					, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":id_person"		, $this->id_person, PDO::PARAM_STR);
			$stmt->bindValue( ":omschrijving"	, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":functie"			, htmlentities($this->functie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":actief_als"		, $this->actief_als, PDO::PARAM_STR);
			$stmt->bindValue( ":mtjcrt_ind"		, $this->mtjcrt_ind, PDO::PARAM_STR);
			$stmt->bindValue( ":jglcrt_ind"		, $this->jglcrt_ind, PDO::PARAM_STR);
			// error_log($sql);
			// error_log(print_r($this));
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (maatje 4) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		parent::updateToDB ();
		return TRUE;	
	}
	
	public function isMaatje()
	{
		if ($this->actief_als == 'A' || $this->actief_als == 'K')
		{
			if($this->mtjcrt_ind = 'j')
				return TRUE;
		}
		return FALSE;
	}
	
	public function isJobgroupleider()
	{
		if ($this->actief_als == 'B' || $this->actief_als == 'K')
		{
			if($this->jglcrt_ind = 'j')
				return TRUE;
		}
		return FALSE;
	}
}

?>