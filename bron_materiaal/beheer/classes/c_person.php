<?php
class Person 
{
	protected $id;
	protected $voornaam;
	protected $tussenvoegsel;
	protected $achternaam;
	protected $geslacht;
	protected $volnaam;
	protected $emailadres;
	protected $adres;
	protected $postcode;
	protected $woonplaats;
	protected $telnr;
	protected $reknr;
	protected $deleted;
	protected $approved;
	protected $aanvraag;
	protected $nieuwsbrief;
	protected $nieuwsbriefSent;
	protected $datumnw;

	public function __construct () {
			$this->voornaam       = '';
			$this->tussenvoegsel  = '';
			$this->achternaam     = '';
			$this->emailadres     = '';
			$this->geslacht		  = '';
			$this->volnaam		  = '';
			$this->adres		  = '';
			$this->postcode		  = '';
			$this->woonplaats	  = '';
			$this->telnr		  = '';
			$this->reknr		  = '';
			$this->aanvraag		  = 'n';
			$this->nieuwsbrief	  = 'n';
			$this->nieuwsbriefSent= 'n';
			$this->datumnw		  = '';
			$this->deleted 		  = 'n';
			$this->approved 	  = 'j';
//		echo $this;

        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }
     	
	public function __construct1 ($personrow) 
	{
		if ($personrow)
		{
// 			error_log("De person bestaat, invullen maar");
			$this->id             = $personrow['id'];
			$this->voornaam       = html_entity_decode($personrow['voornaam']);
			$this->tussenvoegsel  = html_entity_decode($personrow['tussenvoegsel']);
			$this->achternaam     = html_entity_decode($personrow['achternaam']);
			$this->geslacht       = $personrow['geslacht'];
			$this->emailadres     = html_entity_decode($personrow['emailadres']);
			$this->adres		  = html_entity_decode($personrow['adres']);
			$this->postcode		  = html_entity_decode($personrow['postcode']);
			$this->woonplaats	  = html_entity_decode($personrow['woonplaats']);
			$this->telnr		  = html_entity_decode($personrow['telnr']);
			$this->reknr		  = html_entity_decode($personrow['reknr']);
			$this->aanvraag		  = $personrow['aanvraag'];
			$this->deleted        = $personrow['deleted'];
			$this->approved       = $personrow['approved'];
			$this->volnaam		  = html_entity_decode($personrow['volnaam']);
			$this->nieuwsbrief	  = $personrow['nieuwsbrief'];
			$this->nieuwsbriefSent= $personrow['nieuwsbriefSent'];
			$this->datumnw		  = $personrow['datumnw'];
		}
		else
		{
// 			error_log("Geen person gevonden, dan lege geven");
			$this->id 			  = NULL;
			$this->voornaam       = '';
			$this->tussenvoegsel  = '';
			$this->achternaam     = '';
			$this->emailadres     = '';
			$this->geslacht     = '';
			$this->adres		  = '';
			$this->postcode		  = '';
			$this->woonplaats	  = '';
			$this->telnr		  = '';
			$this->reknr		  = '';
			$this->aanvraag		  = 'n';
			$this->volnaam		  = '';
			$this->nieuwsbrief	  = 'n';
			$this->nieuwsbriefSent= 'n';
			$this->datumnw		  = '';
			$this->deleted 		  = 'n';
			$this->approved  	  = 'j';
		}
	}

	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readPersonWithId($value));
				break;
				
/*
			case 'gebruikersnaam':
				$this->__construct1($this->readPersonWithGebruikersnaam($value));
				break;
				
*/
			case 'emailadres':
				$this->__construct1($this->readPersonWithEmailadres($value));
				break;
				
			default:
				return FALSE;
		}
		
	}

	public function __destruct ()
	{
//		echo 'Person ' . $this->id . ' is vernietigd<br/>';
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
			'$id				: ' . $this->id .				'<br/>' .
			'$voornaam			: ' . $this->voornaam .			'<br/>' .
			'$tussenvoegsel		: ' . $this->tussenvoegsel .	'<br/>' .
			'$achternaam		: ' . $this->achternaam .		'<br/>' .
			'$emailadres		: ' . $this->emailadres .		'<br/>' .
			'$geslacht  		: ' . $this->geslacht .	     	'<br/>' .
			'$adres				: ' . $this->adres .			'<br/>' .
			'$postcode			: ' . $this->postcode .			'<br/>' .
			'$woonplaats		: ' . $this->woonplaats .		'<br/>' .
			'$telnr				: ' . $this->telnr .			'<br/>' .
			'$reknr				: ' . $this->reknr .			'<br/>' .
			'$aanvraag			: ' . $this->aanvraag .			'<br/>' .
			'$deleted			: ' . $this->deleted .			'<br/>' .
			'$approved			: ' . $this->approved .			'<br/>' .
			'$volnaam   		: ' . $this->volnaam		  . '<br/>' .
			'$nieuwsbrief		: ' . $this->nieuwsbrief	  . '<br/>' .
			'$nieuwsbriefSent	: ' . $this->nieuwsbriefSent  . '<br/>' .
			'$datumnw		   	: ' . $this->datumnw		  . '<br/>';
	}
	
	public function saveToDB () 
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT person 
										(	id,
											voornaam 		,
											tussenvoegsel ,
											achternaam 	,
											geslacht 	,
											emailadres 	,
											adres ,
											postcode,
											woonplaats ,
											telnr ,
											reknr ,
											deleted,
											approved,	
											volnaam,
											aanvraag ,
											nieuwsbrief,
											nieuwsbriefSent,
											datumnw											
											)
									VALUES (
											:id,
											:voornaam 		,
											:tussenvoegsel ,
											:achternaam 	,
											:geslacht 	,
											:emailadres 	,
											:adres ,
											:postcode ,
											:woonplaats ,
											:telnr ,
											:reknr ,
											:deleted,
											:approved,	
											:volnaam,
											:aanvraag ,
											:nieuwsbrief,
											:nieuwsbriefSent,
											NOW()											
											)";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":voornaam"		, htmlentities($this->voornaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":tussenvoegsel"	, htmlentities($this->tussenvoegsel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":achternaam"		, htmlentities($this->achternaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":geslacht"		, $this->geslacht, PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres"		, htmlentities($this->emailadres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":adres"			, htmlentities($this->adres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":postcode"		, htmlentities($this->postcode, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":woonplaats"		, htmlentities($this->woonplaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":telnr"			, htmlentities($this->telnr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":reknr"			, htmlentities($this->reknr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":deleted"		, $this->deleted, PDO::PARAM_STR);
			$stmt->bindValue( ":approved"		, $this->approved, PDO::PARAM_STR);
			$stmt->bindValue( ":volnaam"		, htmlentities($this->volnaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":aanvraag"		, $this->aanvraag, PDO::PARAM_STR);
			$stmt->bindValue( ":nieuwsbrief"	, $this->nieuwsbrief, PDO::PARAM_STR);
			$stmt->bindValue( ":nieuwsbriefSent", $this->nieuwsbriefSent, PDO::PARAM_STR);
			$stmt->execute();
// 			error_log('Een nieuwe c_person is toegevoegd');
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (person 1) met de database mislukt: ' . $e->getMessage();
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
			$sql = "UPDATE person SET
							voornaam         = :voornaam,
							tussenvoegsel    = :tussenvoegsel,
							achternaam       = :achternaam,
							geslacht        = :geslacht 	,
							emailadres       = :emailadres 	,
							adres			 = :adres,
							postcode		 = :postcode,
							woonplaats		 = :woonplaats,
							telnr			 = :telnr,
							reknr			 = :reknr,
							deleted          = :deleted,
							approved         = :approved,
							volnaam          = :volnaam,
							aanvraag		 = :aanvraag,
							nieuwsbrief      = :nieuwsbrief,
							nieuwsbriefSent  = :nieuwsbriefSent,
							datumnw          = :datumnw
							WHERE id         = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":voornaam"		, htmlentities($this->voornaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":tussenvoegsel"	, htmlentities($this->tussenvoegsel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":achternaam"		, htmlentities($this->achternaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":geslacht"		, $this->geslacht, PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres"		, htmlentities($this->emailadres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":adres"			, htmlentities($this->adres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":postcode"		, htmlentities($this->postcode, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":woonplaats"		, htmlentities($this->woonplaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":telnr"			, htmlentities($this->telnr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":reknr"			, htmlentities($this->reknr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":deleted"		, $this->deleted, PDO::PARAM_STR);
			$stmt->bindValue( ":approved"		, $this->approved, PDO::PARAM_STR);
			$stmt->bindValue( ":volnaam"		, htmlentities($this->volnaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":aanvraag"		, $this->aanvraag, PDO::PARAM_STR);
			$stmt->bindValue( ":nieuwsbrief"	, $this->nieuwsbrief, PDO::PARAM_STR);
			$stmt->bindValue( ":nieuwsbriefSent", $this->nieuwsbriefSent, PDO::PARAM_STR);
			$stmt->bindValue( ":datumnw"		, $this->datumnw, PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (person 5) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return TRUE;	
	}
	protected function readPersonWithId ($attr)
	{
		/* Haal de gegevens uit de database
			$personid kan 2 soorten waarde hebben:
			NULL of 0 => het object bestaat niet in de database => zo laten
			integer => het object kan uit de DB gelezen worden => ophalen en attrs vullen
		*/
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM person WHERE id = :id  AND deleted = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$personrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (person 2) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $personrow;	
	}
	
	protected function readPersonWithEmailadres ($attr)
	{
		global $connection;
		try
		{
// 			error_log("We gaan de person ophalen met het emailadres");
			openDB();
			$sql = "SELECT * FROM person WHERE emailadres = :emailadres AND deleted = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":emailadres", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$personrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  echo 'Connectie (person 4) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	    return $personrow;	
	}
}
