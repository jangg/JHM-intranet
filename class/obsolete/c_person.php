<?php
class Person 
{
	protected $id;
	protected $voornaam;
	protected $tussenvoegsels;
	protected $achternaam;
	protected $emailadres;
	protected $telefoonnr;
	protected $omschrijving;
	protected $functie;
	protected $deleted;
	protected $approved;
	protected $datumnw;
	protected $datummod;
	protected $picfile;
	protected $link_linkedin;
	
	public function __construct () {
			$this->voornaam       = '';
			$this->tussenvoegsels = '';
			$this->achternaam     = '';
			$this->emailadres     = '';
			$this->omschrijving	 = '';
			$this->functie	 = '';
			$this->telefoonnr		  = '';
			$this->datumnw		  = '';
			$this->datummod		  = '';
			$this->deleted 		  = 'n';
			$this->approved 	  = 'j';
			$this->picfile	   = '';
			$this->link_linkedin	   = '';
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
			$this->tussenvoegsels  = html_entity_decode($personrow['tussenvoegsels']);
			$this->achternaam     = html_entity_decode($personrow['achternaam']);
			$this->emailadres     = html_entity_decode($personrow['emailadres']);
			$this->omschrijving	 = html_entity_decode($personrow['omschrijving']);
			$this->functie	 = html_entity_decode($personrow['functie']);
			$this->telefoonnr		  = html_entity_decode($personrow['telefoonnr']);
			$this->deleted        = $personrow['deleted'];
			$this->approved       = $personrow['approved'];
			$this->datumnw		  = $personrow['datumnw'];
			$this->datummod		  = $personrow['datummod'];
			$this->picfile		  = $personrow['picfile'];
			$this->link_linkedin		  = $personrow['link_linkedin'];
		}
		else
		{
// 			error_log("Geen person gevonden, dan lege geven");
			$this->id 			  = NULL;
			$this->voornaam       = '';
			$this->tussenvoegsels  = '';
			$this->achternaam     = '';
			$this->emailadres     = '';
			$this->omschrijving	 = '';
			$this->functie	 = '';
			$this->telefoonnr		  = '';
			$this->datumnw		  = '';
			$this->deleted 		  = 'n';
			$this->approved  	  = 'j';
			$this->datummod		  = '';
			$this->picfile		  = '';
			$this->link_linkedin		  = '';
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
		// 
		// error_log('Person ' . $this->id . ' is vernietigd');
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
			'$tussenvoegsels	: ' . $this->tussenvoegsels .	'<br/>' .
			'$achternaam		: ' . $this->achternaam .		'<br/>' .
			'$emailadres		: ' . $this->emailadres .		'<br/>' .
			'$omschrijving		: ' . $this->omschrijving .		'<br/>' .
			'$functie		: ' . $this->functie .		'<br/>' .
			'$telefoonnr		: ' . $this->telefoonnr .	'<br/>' .
			'$deleted			: ' . $this->deleted .			'<br/>' .
			'$approved			: ' . $this->approved .			'<br/>' .
			'$datumnw		   	: ' . $this->datumnw		  . '<br/>' .
			'$datummod			   : ' . $this->datummod		  . '<br/>' .
			'$picfile			   : ' . $this->picfile		  . '<br/>' .
			'link_linkedin			   : ' . $this->link_linkedin		  . '<br/>';
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
											tussenvoegsels ,
											achternaam 	,
											emailadres 	,
											functie	 ,
											telefoonnr ,
											omschrijving	 ,
											picfile,									
											link_linkedin,
											datumnw,
											datummod,
											approved,	
											deleted
											)
									VALUES (
										 	:id,
											:voornaam		 ,
											:tussenvoegsels ,
											:achternaam	 ,
											:emailadres	 ,
											:functie	 ,
											:telefoonnr ,
											:omschrijving	 ,
											:picfile,									
											:link_linkedin,
											NOW(),
											:datummod,
											:approved,	
											:deleted
											)";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":voornaam"		, htmlentities($this->voornaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":tussenvoegsels"	, htmlentities($this->tussenvoegsel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":achternaam"		, htmlentities($this->achternaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres"		, htmlentities($this->emailadres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":omschrijving"		, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":functie"		, htmlentities($this->functie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":telefoonnr"		, htmlentities($this->telefoonnr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":approved"		, htmlentities($this->approved, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":deleted"		, htmlentities($this->deleted, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":datummod"		, htmlentities($this->datummod, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":picfile"		, htmlentities($this->picfile, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":link_linkedin"		, htmlentities($this->link_linkedin, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
// 			error_log('Een nieuwe c_person is toegevoegd');
			$this->id = $connection->lastInsertId();
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
			openDB();
			$sql = "UPDATE person SET
							voornaam         = :voornaam,
							tussenvoegsels   = :tussenvoegsels,
							achternaam       = :achternaam,
							emailadres       = :emailadres 	,
							omschrijving	 = :omschrijving,
							picfile 		 = :picfile,									
							link_linkedin    = :link_linkedin,
							functie	   		 = :functie	 ,
							telefoonnr		 = :telefoonnr,
							datumnw          = :datumnw,
							datummod		  = NOW(),
							approved		 = :approved,
							deleted			 = :deleted,
							WHERE id         = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":voornaam"		, htmlentities($this->voornaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":tussenvoegsels"	, htmlentities($this->tussenvoegsels, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":achternaam"		, htmlentities($this->achternaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres"		, htmlentities($this->emailadres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":omschrijving"	, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":functie"		, htmlentities($this->functie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":telefoonnr"		, htmlentities($this->telefoonnr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":deleted"		, htmlentities($this->deleted,  ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":approved"		, htmlentities($this->approved,  ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":datumnw"		, htmlentities($this->datumnw,  ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":picfile"		, htmlentities($this->picfile,  ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":link_linkedin"	, htmlentities($this->link_linkedin,  ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (person 5) met de database mislukt: ' . $e->getMessage());
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
			$stmt->bindValue( ":id", htmlentities($attr,  ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$personrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (person 2) met de database mislukt: ' . $e->getMessage());
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
			$stmt->bindValue( ":emailadres", htmlentities($attr,  ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$personrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (person 4) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	    return $personrow;	
	}
}
