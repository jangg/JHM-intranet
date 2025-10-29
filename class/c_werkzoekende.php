<?php
include_once('c_person.php');
class Werkzoekende extends Person
{
	protected $id;
	protected $id_person;
	protected $id_intakeform;
	protected $id_maatje;
	protected $id_jobgroup;
	protected $situatie;
	protected $opmerkingen;
	protected $status;
	protected $opties;
	protected $nnind;
	protected $startsituatie;
	protected $GAKind;
	protected $DBBind;
	protected $opleiding;
	protected $instroomtrede;
	protected $instroomscore;
	protected $uitstroomscore;
	protected $soortwerk;
	protected $toelichting;
	protected $date_aanmelding;
	protected $date_uitstroom;
	
	public function __construct () 
	{
		$this->id				= NULL;
		$this->id_person		= NULL;
		$this->id_intakeform	= NULL;
		$this->id_maatje		= NULL;
		$this->id_jobgroup		= NULL;
		$this->situatie			= '';
		$this->opmerkingen		= '';
		$this->status			= '000';
		$this->opties			= 0;
		$this->nnind			= 'n';
		$this->startsituatie	= '';		
		$this->GAKind			= 'n';
		$this->DBBind			= 'n';
		$this->opleiding		= '';		
		$this->instroomtrede	= '0';		
		$this->instroomscore	= '0';		
		$this->uitstroomscore	= '0';		
		$this->soortwerk		= '';	
		$this->toelichting		= '';
		$this->date_aanmelding = NULL;
		$this->date_uitstroom = NULL;	
	
		parent::__construct ();	

		$a = func_get_args(); 
		$i = func_num_args(); 
		if (method_exists($this,$f='__construct'.$i)) { 
			call_user_func_array(array($this,$f),$a);
		}
	}

	public function __construct1 ($werkzoekenderow) 
	{
		//print_r ($werkzoekenderow);
		if ($werkzoekenderow)
		{
	// 			error_log("De person bestaat, invullen maar");
			$this->id					= $werkzoekenderow['id'];
			$this->id_person			= $werkzoekenderow['id_person'];
			$this->id_intakeform		= $werkzoekenderow['id_intakeform'];
			$this->id_maatje			= $werkzoekenderow['id_maatje'];
			$this->id_jobgroup		= $werkzoekenderow['id_jobgroup'];
			$this->situatie			= html_entity_decode($werkzoekenderow['situatie']);
			$this->opmerkingen		= html_entity_decode($werkzoekenderow['opmerkingen']);
			$this->status				= $werkzoekenderow['status'];
			$this->opties				= $werkzoekenderow['opties'];
			$this->nnind				= $werkzoekenderow['nnind'];
			$this->startsituatie		= $werkzoekenderow['startsituatie'];
			$this->GAKind				= $werkzoekenderow['GAKind'];
			$this->DBBind				= $werkzoekenderow['DBBind'];
			$this->opleiding			= $werkzoekenderow['opleiding'];
			$this->instroomtrede		= $werkzoekenderow['instroomtrede'];
			$this->instroomscore		= $werkzoekenderow['instroomscore'];
			$this->uitstroomscore	= $werkzoekenderow['uitstroomscore'];
			$this->soortwerk			= $werkzoekenderow['soortwerk'];
			$this->toelichting		= html_entity_decode($werkzoekenderow['toelichting']);
			$this->date_aanmelding 	= $werkzoekenderow['date_aanmelding'];
			$this->date_uitstroom 	= $werkzoekenderow['date_uitstroom'];
			parent::__construct1 ($werkzoekenderow);
		}
	}
			
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readWerkzoekendeWithId($value));
				break;
			case 'emailadres':
				$this->__construct1($this->readWerkzoekendeWithEmailadres($value));
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
			'$id_intakeform		: ' . $this->id_intakeform	. '<br/>' .
			'$id_maatje			: ' . $this->id_maatje		. '<br/>' .
			'$id_jobgroup		: ' . $this->id_jobgroup		. '<br/>' .
			'$situatie			: ' . $this->situatie		. '<br/>' .
			'$opmerkingen		: ' . $this->opmerkingen		. '<br/>' .
			'$status			: ' . $this->status		. '<br/>' .
			'$opties			: ' . $this->opties	. '<br/>' .
			'$nnind				: ' . $this->nnind			 . '<br/>' .	
			'$startsituatie		: ' . $this->startsituatie	 . '<br/>' .	
			'$GAKind			: ' . $this->GAKind	 . '<br/>' .
			'$DBBind			: ' . $this->DBBind	 . '<br/>' .
			'$opleiding			: ' . $this->opleiding	 . '<br/>' .
			'$instroomtrede		: ' . $this->instroomtrede	 . '<br/>' .	
			'$instroomscore		: ' . $this->instroomscore	 . '<br/>' .	
			'$uitstroomscore	: ' . $this->uitstroomscore . '<br/>' .			
			'$soortwerk			: ' . $this->soortwerk	 . '<br/>' .
			'$toelichting		: ' . $this->toelichting	 . '<br/>' .
			'$date_aanmelding	: ' . $this->date_aanmelding	 . '<br/>' .
			'$date_uitstroom	: ' . $this->date_uitstroom	 . '<br/>';
			
	
	}
	
	public function saveToDB () 
	{
		/* EERST de superclass saven, daarna de subclass ivm relatie id */
		openDB();
		if (!parent::saveToDB()) exit();
		global $connection;
		try
		{	
			$date = new DateTime();
			$this->date_aanmelding = $date->format('Y-m-d');
			$sql = "INSERT werkzkd 
						(	id			,
							id_person   ,
							id_intakeform,
							id_maatje ,
							id_jobgroup ,
							situatie	,							
							opmerkingen	,
							status		,
							opties		,
							nnind			,	
							startsituatie	,
							GAKind		,
							DBBind		,
							opleiding		,
							instroomtrede	,
							instroomscore	,
							uitstroomscore,
							soortwerk		,
							toelichting ,
							date_aanmelding ,
							date_uitstroom
						)
					VALUES (
							:id			,
							:id_person	,
							:id_intakeform ,
							:id_maatje ,
							:id_jobgroup ,
							:situatie	,		
							:opmerkingen	,
							:status		,
							:opties,
							:nnind			,
							:startsituatie	,
							:GAKind		,
							:DBBind		,
							:opleiding		,
							:instroomtrede	,
							:instroomscore	,
							:uitstroomscore,
							:soortwerk		,
							:toelichting ,
							:date_aanmelding ,
							:date_uitstroom
						);";
		
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				 			, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":id_person"				, $this->id_person, PDO::PARAM_STR);
			$stmt->bindValue( ":id_intakeform"			, $this->id_intakeform, PDO::PARAM_STR);
			$stmt->bindValue( ":id_maatje"				, $this->id_maatje, PDO::PARAM_STR);
			$stmt->bindValue( ":id_jobgroup"				, $this->id_jobgroup, PDO::PARAM_STR);
			$stmt->bindValue( ":situatie"					, htmlentities($this->situatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":opmerkingen"				, htmlentities($this->opmerkingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":status"					, $this->status, PDO::PARAM_STR);
			$stmt->bindValue( ":opties"					, $this->opties, PDO::PARAM_STR);
			$stmt->bindValue( ":nnind"						, $this->nnind, PDO::PARAM_STR);
			$stmt->bindValue( ":startsituatie"			, $this->startsituatie, PDO::PARAM_STR);
			$stmt->bindValue( ":GAKind"					, $this->GAKind, PDO::PARAM_STR);
			$stmt->bindValue( ":DBBind"					, $this->DBBind, PDO::PARAM_STR);
			$stmt->bindValue( ":opleiding"				, $this->opleiding, PDO::PARAM_STR);
			$stmt->bindValue( ":instroomtrede"			, $this->instroomtrede, PDO::PARAM_STR);
			$stmt->bindValue( ":instroomscore"			, $this->instroomscore, PDO::PARAM_STR);
			$stmt->bindValue( ":uitstroomscore"			, $this->uitstroomscore, PDO::PARAM_STR);
			$stmt->bindValue( ":soortwerk"				, $this->soortwerk, PDO::PARAM_STR);
			$stmt->bindValue( ":toelichting"				, htmlentities($this->toelichting, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":date_aanmelding"		, $this->date_aanmelding, PDO::PARAM_STR);
			$stmt->bindValue( ":date_uitstroom"			, $this->date_uitstroom, PDO::PARAM_STR);
			
			$stmt->execute();
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (werkzkd 1) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return TRUE;	
	}
	
		
	public function readWerkzoekendeWithId ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT werkzkd.*, person.* FROM werkzkd JOIN person ON werkzkd.id_person = person.person_id WHERE werkzkd.id = :id AND person.delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$Werkzoekenderow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (Werkzoekende 2) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return $Werkzoekenderow;	
	}
	
	public function readAllWerkzoekendeWithId ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT werkzkd.*, person.* FROM werkzkd JOIN person ON werkzkd.id_person = person.person_id WHERE werkzkd.id = :id LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$Werkzoekenderow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (Werkzoekende 2) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return $Werkzoekenderow;	
	}

		
	public function readWerkzoekendeWithEmailadres ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT werkzkd.*, person.* FROM werkzkd JOIN person ON werkzkd.id_person = person.person_id WHERE person.type = 'wkz' AND person.emailadres = :emailadres AND person.delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":emailadres", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$Werkzoekenderow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (Werkzoekende 3) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return $Werkzoekenderow;	
	}
	
	public function updateToDB () 
	{
		global $connection;
		try
		{
			openDB();
			$sql = "UPDATE werkzkd SET
				id_person       = :id_person	,
				id_intakeform   = :id_intakeform	,
				id_maatje   	= :id_maatje	,
				id_jobgroup   	= :id_jobgroup	,
				situatie		= :situatie	,
				opmerkingen		= :opmerkingen,
				status			= :status	,
				opties			= :opties		,
				nnind			= :nnind		,	
				startsituatie	= :startsituatie,	
				GAKind			= :GAKind		,
				DBBind			= :DBBind		,
				opleiding		= :opleiding	,
				instroomtrede	= :instroomtrede,	
				instroomscore	= :instroomscore,	
				uitstroomscore	= :uitstroomscore,	
				soortwerk		= :soortwerk	,	
				toelichting		= :toelichting ,
				date_aanmelding = :date_aanmelding ,
				date_uitstroom = :date_uitstroom
				WHERE id = :id;";
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"					, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":id_person"		, $this->id_person, PDO::PARAM_STR);
			$stmt->bindValue( ":id_intakeform"	, $this->id_intakeform, PDO::PARAM_STR);
			$stmt->bindValue( ":id_maatje"		, $this->id_maatje, PDO::PARAM_STR);
			$stmt->bindValue( ":id_jobgroup"		, $this->id_jobgroup, PDO::PARAM_STR);
			$stmt->bindValue( ":situatie"			, htmlentities($this->situatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":opmerkingen"		, htmlentities($this->opmerkingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":status"			, $this->status, PDO::PARAM_STR);
			$stmt->bindValue( ":opties"			, $this->opties, PDO::PARAM_STR);
			$stmt->bindValue( ":nnind"				, $this->nnind, PDO::PARAM_STR);
			$stmt->bindValue( ":startsituatie"	, $this->startsituatie, PDO::PARAM_STR);
			$stmt->bindValue( ":GAKind"			, $this->GAKind, PDO::PARAM_STR);
			$stmt->bindValue( ":DBBind"			, $this->DBBind, PDO::PARAM_STR);
			$stmt->bindValue( ":opleiding"		, $this->opleiding, PDO::PARAM_STR);
			$stmt->bindValue( ":instroomtrede"	, $this->instroomtrede, PDO::PARAM_STR);
			$stmt->bindValue( ":instroomscore"	, $this->instroomscore, PDO::PARAM_STR);
			$stmt->bindValue( ":uitstroomscore"	, $this->uitstroomscore, PDO::PARAM_STR);
			$stmt->bindValue( ":soortwerk"		, $this->soortwerk, PDO::PARAM_STR);
			$stmt->bindValue( ":toelichting"		, htmlentities($this->toelichting, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":date_aanmelding"		, $this->date_aanmelding, PDO::PARAM_STR);
			$stmt->bindValue( ":date_uitstroom"		, $this->date_uitstroom, PDO::PARAM_STR);
			// error_log($sql);
			// error_log(print_r($this));
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (werkzkd 4) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		parent::updateToDB ();
		return TRUE;	
	}
}
?>