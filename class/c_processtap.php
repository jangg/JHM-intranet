<?php
class Processtap
{
	protected $id;
	protected $delind;
	protected $id_werkzkd;
	protected $id_user;
	protected $dt_stap;
	protected $wzstatus;
	protected $drstrnaar;
	protected $toelichting;
	
	public function __construct() 
	{
		$this->id = '';
		$this->delind = 'n';
		$this->id_werkzkd = '';
		$this->id_user = '';
		$this->dt_stap = '';
		$this->wzstatus = '';
		$this->drstrnaar = '';
		$this->toelichting = '';
		
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
			$this->__construct1($this->readProcesstapWithId($value));
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
			$this->delind 			= $row['delind'];
			$this->id_werkzkd 	= $row['id_werkzkd'];
			$this->id_user 		= $row['id_user'];
			$this->dt_stap 		= $row['dt_stap'];
			$this->wzstatus 		= $row['wzstatus'];
			$this->drstrnaar 		= $row['drstrnaar'];
			$this->toelichting 	= html_entity_decode($row['toelichting']);
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
		'$this->delind 	: ' . $this->delind .
		'$this->id_werkzkd 	: ' . $this->id_werkzkd .
		'$this->id_user 	: ' . $this->id_user .
		'$this->dt_stap 	: ' . $this->dt_stap .
		'$this->wzstatus 	: ' . $this->wzstatus .
		'$this->drstrnaar 	: ' . $this->drstrnaar .
		'$this->toelichting : ' . $this->toelichting;
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
			$sql = "SELECT * FROM processtap WHERE id = :id;";
			
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
			$this->dt_stap = $date->format('Y-m-d H:i:s');
			$sql = "INSERT processtap 
			(	id 			,
				delind		,
				id_werkzkd 	,
				id_user 	,
				dt_stap 	,
				wzstatus 	,
				drstrnaar 	,
				toelichting )
			VALUES (
				:id 		,
				:delind	,
				:id_werkzkd ,
				:id_user 	,
				:dt_stap 	,
				:wzstatus 	,
				:drstrnaar 	,
				:toelichting
			);";
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"		, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":id_werkzkd"	, $this->id_werkzkd, PDO::PARAM_STR);
			$stmt->bindValue( ":id_user"		, $this->id_user, PDO::PARAM_STR);
			$stmt->bindValue( ":dt_stap"		, $this->dt_stap, PDO::PARAM_STR);
			$stmt->bindValue( ":wzstatus"		, $this->wzstatus, PDO::PARAM_STR);
			$stmt->bindValue( ":drstrnaar"	, $this->drstrnaar, PDO::PARAM_STR);
			$stmt->bindValue( ":toelichting"	, htmlentities($this->toelichting, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (processtap 1) met de database mislukt: ' . $e->getMessage());
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
				delind		= :delind,
				id_werkzkd 	= :id_werkzkd,
				id_user 	= :id_user,
				dt_stap 	= :dt_stap,
				wzstatus 	= :wzstatus,
				drstrnaar 	= :drstrnaar,
				toelichting = :toelichting
			WHERE id		 = :id;";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"		, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":id_werkzkd"	, $this->id_werkzkd, PDO::PARAM_STR);
			$stmt->bindValue( ":id_user"		, $this->id_user, PDO::PARAM_STR);
			$stmt->bindValue( ":dt_stap"		, $this->dt_stap, PDO::PARAM_STR);
			$stmt->bindValue( ":wzstatus"		, $this->wzstatus, PDO::PARAM_STR);
			$stmt->bindValue( ":drstrnaar"	, $this->drstrnaar, PDO::PARAM_STR);
			$stmt->bindValue( ":toelichting"	, htmlentities($this->toelichting, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (processtap 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
}
?>
