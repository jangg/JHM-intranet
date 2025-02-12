<?php
class Agendaitem
{
	protected $id;
	protected $datum;
	protected $begintijd;
	protected $eindtijd;
	protected $titel;
	protected $omschrijving;
	protected $locatie;
	protected $organisator;
	protected $picfile;
	
	public function __construct() 
	{
		$this->id = NULL;
		$this->datum = '';
		$this->begintijd= '';
		$this->eindtijd = '';
		$this->titel = '';
		$this->omschrijving = '';
		$this->locatie = '';
		$this->organisator = '';
		$this->picfile = '';
		
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
			$this->__construct1($this->readAgendaitemWithId($value));
			break;
			
			default:
			return FALSE;
		}
		
	}
	
	public function __construct1 ($row) 
	{
		if ($row)
		{
			$this->id 				= $row['id'];
			$this->datum			= $row['datum'];
			$this->begintijd		= $row['begintijd'];
			$this->eindtijd 		= $row['eindtijd'];
			$this->omschrijving 	= $row['omschrijving'];
			$this->titel	 		= $row['titel'];
			$this->locatie			= $row['locatie'];
			$this->organisator 		= $row['organisator'];
			$this->picfile 			= $row['picfile'];
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
		'$this->id			 : ' . $this->id			.
		'$this->datum		 : ' . $this->datum			.
		'$this->begintijd	 : ' . $this->begintijd		.
		'$this->eindtijd	 : ' . $this->eindtijd		.
		'$this->titel 		 : ' . $this->titel	.
		'$this->omschrijving : ' . $this->omschrijving	.
		'$this->locatie		 : ' . $this->locatie		.
		'$this->organisator	 : ' . $this->organisator	.
		'$this->picfile		 : ' . $this->picfile		;
	}
	protected function readAgendaitemWithId ($id)
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
			$sql = "SELECT * FROM agendaitem WHERE id = :id;";
			
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
			$sql = "INSERT agendaitem 
			(	id			 ,
				datum		,
				begintijd	,
				eindtijd	 ,
				titel ,
				omschrijving ,
				locatie		,
				organisator	 ,
				picfile	)
			VALUES (
				;id			 ,
				:datum		,
				:begintijd	,
				:eindtijd	 ,
				:titel ,
				:omschrijving ,
				:locatie		,
				:organisator	 ,
				:picfile				
			)";
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":datum"			, $this->datum, PDO::PARAM_STR);
			$stmt->bindValue( ":begintijd"		, $this->begintijd, PDO::PARAM_STR);
			$stmt->bindValue( ":eindtijd"		, $this->eindtijd, PDO::PARAM_STR);
			// $stmt->bindValue( ":titel"			, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			// $stmt->bindValue( ":omschrijving"	, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			// $stmt->bindValue( ":locatie"		, htmlentities($this->locatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			// $stmt->bindValue( ":organisator"	, htmlentities($this->organisator, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			// $stmt->bindValue( ":picfile"		, htmlentities($this->picfile, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":titel"			, $this->titel, PDO::PARAM_STR);
			$stmt->bindValue( ":omschrijving"	, $this->omschrijving, PDO::PARAM_STR);
			$stmt->bindValue( ":locatie"		, $this->locatie, PDO::PARAM_STR);
			$stmt->bindValue( ":organisator"	, $this->organisator, PDO::PARAM_STR);
			$stmt->bindValue( ":picfile"		, $this->picfile, PDO::PARAM_STR);
			$stmt->execute();
			//			 error_log('Een nieuwe c_person is toegevoegd');
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (agendaitem 1) met de database mislukt: ' . $e->getMessage());
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
			$sql = "UPDATE agendaitem SET
			datum		 = :datum,
			begintijd		  = :begintijd,
			eindtijd	= :eindtijd,
			titel		= :titel,
			omschrijving		= :omschrijving,
			locatie		= :locatie,
			organisator		= :organisator,
			picfile		= :picfile
			WHERE id		 = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":datum"			, $this->datum, PDO::PARAM_STR);
			$stmt->bindValue( ":begintijd"		, $this->begintijd, PDO::PARAM_STR);
			$stmt->bindValue( ":eindtijd"		, $this->eindtijd, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"	, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":omschrijving"	, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":locatie"		, htmlentities($this->locatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":organisator"	, htmlentities($this->organisator, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":picfile"		, htmlentities($this->picfile, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (agendaitem 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
}
?>
