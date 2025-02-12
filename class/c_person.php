<?php
abstract class person 
{
	protected $person_id;
	protected $delind;
	protected $datetime_created;
	protected $datetime_modified;
	protected $voornaam;
	protected $tussenvoegsels;
	protected $achternaam;
	protected $straat;
	protected $huisnummer;
	protected $postcode;
	protected $woonplaats;
	protected $emailadres;
	protected $telefoonnr;
	protected $type;
	protected $picfile;
	protected $link_linkedin;
	protected $presentInd;
	protected $date_geboorte;
	protected $geslacht;
	
	public function __construct () 
	{
		$this->person_id		= NULL;
		$this->delind			= 'n';
		$this->datetime_created	= '';
		$this->datetime_modified = '';
		$this->voornaam			= '';
		$this->tussenvoegsels	= '';
		$this->achternaam		= '';
		$this->straat		    = '';
		$this->huisnummer	    = '';
		$this->postcode		    = '';
		$this->woonplaats	    = '';
		$this->emailadres		= '';
		$this->telefoonnr		= '';
		$this->type				= 'wkz';
		$this->picfile			= '';
		$this->link_linkedin	= '';
		$this->presentInd		= '';
		$this->date_geboorte 	= NULL;
		$this->geslacht		 	= '';

    }
     	
	public function __construct1 ($personrow) 
	{
		if ($personrow)
		{
// 			error_log("De person bestaat, invullen maar");
			$this->person_id				= $personrow['person_id'];
			$this->delind					= $personrow['delind'];
			$this->datetime_created		= $personrow['datetime_created'];
			$this->datetime_modified	= $personrow['datetime_modified'];
			$this->voornaam				= html_entity_decode($personrow['voornaam']);
			$this->tussenvoegsels		= html_entity_decode($personrow['tussenvoegsels']);
			$this->achternaam				= html_entity_decode($personrow['achternaam']);
			$this->straat		    		= html_entity_decode($personrow['straat']);
			$this->huisnummer	    		= html_entity_decode($personrow['huisnummer']);
			$this->postcode		    	= html_entity_decode($personrow['postcode']);
			$this->woonplaats	    		= html_entity_decode($personrow['woonplaats']);
			$this->emailadres				= html_entity_decode($personrow['emailadres']);
			$this->telefoonnr				= html_entity_decode($personrow['telefoonnr']);
			$this->type						= $personrow['type'];
			$this->picfile					= $personrow['picfile'];
			$this->link_linkedin			= html_entity_decode($personrow['link_linkedin']);
			$this->presentInd				= $personrow['presentInd'];
			$this->date_geboorte			= $personrow['date_geboorte'];
			$this->geslacht				= $personrow['geslacht'];
		}
	}

	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'person_id':
				$this->__construct1($this->readpersonWithPerson_id($value));
				break;
			case 'emailadres':
				$this->__construct1($this->readpersonWithEmailadres($value));
				break;				
			default:
				return FALSE;
		}
		
	}

	public function __destruct ()
	{
		// 
		// error_log('person ' . $this->id . ' is vernietigd');
	}
	
	public function __get($attr)
	{
		return $this->$attr;
	}

	public function __set($attr, $value)
	{
		/* hier moet nog wel per attr de value worden gechecked */
		$this->$attr = $value;
	}
	
	public function __toString()
	{
		/* hier printen we het object mee uit, voor testdoeleinden */
		return 
			'$person_id			: ' . $this->person_id	. '<br/>' .
			'$delind			: ' . $this->delind		. '<br/>' .
			'datetime_created	: ' . $this->datetime_created		. '<br/>' .
			'$datetime_modified	: ' . $this->datetime_modified		. '<br/>' .
			'$voornaam			: ' . $this->voornaam		. '<br/>' .
			'$tussenvoegsels	: ' . $this->tussenvoegsels	. '<br/>' .
			'$achternaam		: ' . $this->achternaam	. '<br/>' .
			'$straat            : ' . $this->straat . '<br/>' .
			'$huisnummer        : ' . $this->huisnummer . '<br/>' .
			'$postcode          : ' . $this->postcode . '<br/>' .
			'$woonplaats        : ' . $this->woonplaats . '<br/>' .
			'$emailadres        : ' . $this->emailadres	. '<br/>' .
			'$telefoonnr		: ' . $this->telefoonnr	. '<br/>' .
			'$type				: ' . $this->type			. '<br/>' .
			'$picfile			: ' . $this->picfile		. '<br/>' .
			'$link_linkedin		: ' . $this->link_linkedin	. '<br/>' .
			'$presentInd		: ' . $this->presentInd	. '<br/>' .
			'$date_geboorte		: ' . $this->date_geboorte	. '<br/>' .
			'$geslacht			: ' . $this->geslacht	. '<br/>';

	}
	
	public function saveToDB () 
	{
		global $connection;
		try
		{	
			$date = new DateTime();
			$this->datetime_created = $date->format('Y-m-d H:i:s');
			$this->datetime_modified = $date->format('Y-m-d H:i:s');
			if ($this->date_geboorte == '') $this->date_geboorte = NULL; 
		
			$sql = "INSERT person 
						(	person_id	,
							delind		,
							datetime_created,
							datetime_modified,
							voornaam	,	
							tussenvoegsels,
							achternaam	,
							straat      ,
							huisnummer  ,
							postcode    ,
							woonplaats  ,
							emailadres	,
							telefoonnr	,
							type		,	
							picfile		,
							link_linkedin ,
							presentInd,
							date_geboorte,
							geslacht
						)
					VALUES (
						 	:person_id	,
							:delind		,
							:datetime_created,
							:datetime_modified, 
							:voornaam	,	
							:tussenvoegsels,
							:achternaam	,
							:straat      ,
							:huisnummer  ,
							:postcode    ,
							:woonplaats  ,
							:emailadres	,
							:telefoonnr	,
							:type		,	
							:picfile		,
							:link_linkedin ,
							:presentInd ,
							:date_geboorte,
							:geslacht
						);";
		
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":person_id"			, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"				, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_created" 	, $this->datetime_created, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_modified"	, $this->datetime_modified, PDO::PARAM_STR);
			$stmt->bindValue( ":voornaam"				, htmlentities($this->voornaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":tussenvoegsels"		, htmlentities($this->tussenvoegsels, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":achternaam"			, htmlentities($this->achternaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":straat"     			, htmlentities($this->straat, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":huisnummer"     	, htmlentities($this->huisnummer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":postcode"     		, htmlentities($this->postcode, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":woonplaats"     	, htmlentities($this->woonplaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres"			, htmlentities($this->emailadres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":telefoonnr"			, htmlentities($this->telefoonnr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":type"					, $this->type, PDO::PARAM_STR);
			$stmt->bindValue( ":picfile"				, $this->picfile, PDO::PARAM_STR);
			$stmt->bindValue( ":link_linkedin"		, htmlentities($this->link_linkedin, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":presentInd"			, $this->presentInd, PDO::PARAM_STR);
			$stmt->bindValue( ":date_geboorte"		, $this->date_geboorte, PDO::PARAM_STR);
			$stmt->bindValue( ":geslacht"				, $this->geslacht, PDO::PARAM_STR);
			// if ($this->date_geboorte != '')
			// 	$stmt->bindValue( ":date_geboorte"	, date('Y-m-d', strtotime($this->date_geboorte)), PDO::PARAM_STR);
			// 	else
			// 	$stmt->bindValue( ":date_geboorte"	, NULL, PDO::PARAM_STR);
			$stmt->execute();
// 			error_log('Een nieuwe c_person is toegevoegd');
			$this->person_id = $connection->lastInsertId();
			$this->id_person = $this->person_id;
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (person 1) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	    return TRUE;	
	}

	public function updateToDB () 
	{
		global $connection;
		try
		{
			$date = new DateTime();
			$this->datetime_modified = $date->format('Y-m-d H:i:s');
			if ($this->date_geboorte == '') $this->date_geboorte = NULL;

			$sql = "UPDATE person SET		
						delind				= :delind		,
						datetime_created	= :datetime_created,
						datetime_modified	= :datetime_modified,
						voornaam			= :voornaam	,	
						tussenvoegsels		= :tussenvoegsels,
						achternaam			= :achternaam	,
						straat      		= :straat ,
						huisnummer  		= :huisnummer,
						postcode    		= :postcode,
						woonplaats  		= :woonplaats,
						emailadres			= :emailadres	,
						telefoonnr			= :telefoonnr	,
						type				= :type		,	
						picfile				= :picfile		,
						link_linkedin		= :link_linkedin ,
						presentInd			= :presentInd ,
						date_geboorte   	= :date_geboorte ,
						geslacht			= :geslacht
					WHERE person_id = :person_id;";
			// error_log($sql);
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":person_id"		, $this->person_id, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"			, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_created", $this->datetime_created, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_modified", $this->datetime_modified, PDO::PARAM_STR);
			$stmt->bindValue( ":voornaam"		, htmlentities($this->voornaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":tussenvoegsels"	, htmlentities($this->tussenvoegsels, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":achternaam"		, htmlentities($this->achternaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":straat"     	, htmlentities($this->straat, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":huisnummer"     , htmlentities($this->huisnummer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":postcode"     	, htmlentities($this->postcode, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":woonplaats"     , htmlentities($this->woonplaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres"		, htmlentities($this->emailadres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":telefoonnr"		, htmlentities($this->telefoonnr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":type"			, $this->type, PDO::PARAM_STR);
			$stmt->bindValue( ":picfile"		, $this->picfile, PDO::PARAM_STR);
			$stmt->bindValue( ":link_linkedin"	, htmlentities($this->link_linkedin, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":presentInd"		, $this->presentInd, PDO::PARAM_STR);
			$stmt->bindValue( ":date_geboorte"	, $this->date_geboorte, PDO::PARAM_STR);
			$stmt->bindValue( ":geslacht"		, $this->geslacht, PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (person 5) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	    return TRUE;	
	}
}
