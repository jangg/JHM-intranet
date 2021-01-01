<?php
class client 
{
	protected $id;
	protected $delind;
	protected $datumnw;
	protected $voornaam;
	protected $tussenvoegsels;
	protected $achternaam;
	protected $straat;
	protected $huisnummer;
	protected $postcode;
	protected $woonplaats;
	protected $emailadres;
	protected $telefoonnr;
	protected $situatie;
	protected $opmerkingen;
	protected $status;
	protected $type;
	protected $opties;
	protected $picfile;
	protected $link_linkedin;
	
	public function __construct () {
			$this->delind  = 'n';
			$this->datummod		  = '';
			$this->voornaam       = '';
			$this->tussenvoegsels = '';
			$this->achternaam     = '';
			$this->straat		  = '';
			$this->huisnummer	  = '';
			$this->postcode		  = '';
			$this->woonplaats	  = '';
			$this->emailadres     = '';
			$this->telefoonnr	  = '';
			$this->situatie	 	  = '';
			$this->opmerkingen	  = '';
			$this->status		  = '000';
			$this->type		      = '00';
			$this->opties 		  = '0';
			$this->picfile	      = '';
			$this->link_linkedin  = '';
//		echo $this;

        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }
     	
	public function __construct1 ($clientrow) 
	{
		if ($clientrow)
		{
// 			error_log("De client bestaat, invullen maar");
			$this->id				= $clientrow['id'];
			$this->delind			= $clientrow['delind'];
			$this->datumnw			= $clientrow['datetime_created'];
			$this->datummod			= $clientrow['datetime_modified'];
			$this->voornaam			= $clientrow['voornaam'];
			$this->tussenvoegsels	= $clientrow['tussenvoegsels'];
			$this->achternaam		= $clientrow['achternaam'];
			$this->straat		    = $clientrow['straat'];
			$this->huisnummer	    = $clientrow['huisnummer'];
			$this->postcode		    = $clientrow['postcode'];
			$this->woonplaats	    = $clientrow['woonplaats'];
			$this->emailadres		= $clientrow['emailadres'];
			$this->telefoonnr		= $clientrow['telefoonnr'];
			$this->situatie			= $clientrow['situatie'];
			$this->opmerkingen		= $clientrow['opmerkingen'];
			$this->status			= $clientrow['status'];
			$this->type				= $clientrow['type'];
			$this->opties			= $clientrow['opties'];
			$this->picfile			= $clientrow['picfile'];
			$this->link_linkedin	= $clientrow['link_linkedin'];	
		}
		else
		{
// 			error_log("Geen client gevonden, dan lege geven");
			$this->id				= '';
			$this->delind			= 'n';
			$this->datumnw			= '';
			$this->datummod			= '';
			$this->voornaam			= '';
			$this->tussenvoegsels	= '';
			$this->achternaam		= '';
			$this->straat		    = '';
			$this->huisnummer	    = '';
			$this->postcode		    = '';
			$this->woonplaats	    = '';
			$this->emailadres		= '';
			$this->telefoonnr		= '';
			$this->situatie			= '';
			$this->opmerkingen		= '';
			$this->status			= '000';
			$this->type				= '00';
			$this->opties			= '0';
			$this->picfile			= '';
			$this->link_linkedin	= '';

		}
	}

	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readclientWithId($value));
				break;
				
/*
			case 'gebruikersnaam':
				$this->__construct1($this->readclientWithGebruikersnaam($value));
				break;
				
*/
			case 'emailadres':
				$this->__construct1($this->readclientWithEmailadres($value));
				break;
				
			default:
				return FALSE;
		}
		
	}

	public function __destruct ()
	{
		// 
		// error_log('client ' . $this->id . ' is vernietigd');
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
			'$id				: ' . $this->id			. '<br/>' .
			'$delind			: ' . $this->delind		. '<br/>' .
			'$datumnw			: ' . $this->datumnw		. '<br/>' .
			'$datummod			: ' . $this->datummod		. '<br/>' .
			'$voornaam			: ' . $this->voornaam		. '<br/>' .
			'$tussenvoegsels	: ' . $this->tussenvoegsels	. '<br/>' .
			'$achternaam		: ' . $this->achternaam	. '<br/>' .
			'$straat            : ' . $this->straat . '<br/>' .
			'$huisnummer        : ' . $this->huisnummer . '<br/>' .
			'$postcode          : ' . $this->postcode . '<br/>' .
			'$woonplaats        : ' . $this->woonplaats . '<br/>' .
			'$emailadres        : ' . $this->emailadres	. '<br/>' .
			'$telefoonnr		: ' . $this->telefoonnr	. '<br/>' .
			'$situatie			: ' . $this->situatie		. '<br/>' .
			'$opmerkingen		: ' . $this->opmerkingen	. '<br/>' .
			'$status			: ' . $this->status		. '<br/>' .
			'$type				: ' . $this->type			. '<br/>' .
			'$opties			: ' . $this->opties		. '<br/>' .
			'$picfile			: ' . $this->picfile		. '<br/>' .
			'$link_linkedin		: ' . $this->link_linkedin	. '<br/>';

	}
	
	public function saveToDB () 
	{
		global $connection;
		try
		{			
			// openDB();
			$sql = "INSERT client 
						(	id			,
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
							situatie	,							
							opmerkingen	,
							status		,
							type		,	
							opties		,
							picfile		,
							link_linkedin
						)
					VALUES (
						 	:id			,
							:delind		,
							NOW(),
							'1901-01-01 00:00:00', 
							:voornaam	,	
							:tussenvoegsels,
							:achternaam	,
							:straat      ,
							:huisnummer  ,
							:postcode    ,
							:woonplaats  ,
							:emailadres	,
							:telefoonnr	,
							:situatie	,		
							:opmerkingen	,
							:status		,
							:type		,	
							:opties		,
							:picfile		,
							:link_linkedin
						);";
		
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"			, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":voornaam"		, htmlentities($this->voornaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":tussenvoegsels"	, htmlentities($this->tussenvoegsels, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":achternaam"		, htmlentities($this->achternaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":straat"     	, htmlentities($this->straat, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":huisnummer"     , htmlentities($this->huisnummer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":postcode"     	, htmlentities($this->postcode, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":woonplaats"     , htmlentities($this->woonplaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres"		, htmlentities($this->emailadres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":telefoonnr"		, htmlentities($this->telefoonnr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":situatie"		, htmlentities($this->situatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":opmerkingen"	, htmlentities($this->opmerkingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":status"			, $this->status, PDO::PARAM_STR);
			$stmt->bindValue( ":type"			, $this->type, PDO::PARAM_STR);
			$stmt->bindValue( ":opties"			, $this->opties, PDO::PARAM_STR);
			$stmt->bindValue( ":picfile"		, $this->picfile, PDO::PARAM_STR);
			$stmt->bindValue( ":link_linkedin"	, htmlentities($this->link_linkedin, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
// 			error_log('Een nieuwe c_client is toegevoegd');
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (client 1) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	    return TRUE;	
	}

	public function updateToDB () 
	{
		global $connection;
		try
		{
			// openDB();
			$sql = "UPDATE client SET		
						delind				= :delind		,
						datetime_created	= :datetime_created,
						datetime_modified	= NOW(),
						voornaam			= :voornaam	,	
						tussenvoegsels		= :tussenvoegsels,
						achternaam			= :achternaam	,
						straat      		= :straat ,
						huisnummer  		= :huisnummer,
						postcode    		= :postcode,
						woonplaats  		= :woonplaats,
						emailadres			= :emailadres	,
						telefoonnr			= :telefoonnr	,
						situatie			= :situatie	,							
						opmerkingen			= :opmerkingen	,
						status				= :status		,
						type				= :type		,	
						opties				= :opties		,
						picfile				= :picfile		,
						link_linkedin		= :link_linkedin
					WHERE id = :id;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"			, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_created", $this->datumnw, PDO::PARAM_STR);
			$stmt->bindValue( ":voornaam"		, htmlentities($this->voornaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":tussenvoegsels"	, htmlentities($this->tussenvoegsels, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":achternaam"		, htmlentities($this->achternaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":straat"     	, htmlentities($this->straat, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":huisnummer"     , htmlentities($this->huisnummer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":postcode"     	, htmlentities($this->postcode, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":woonplaats"     , htmlentities($this->woonplaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":emailadres"		, htmlentities($this->emailadres, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":telefoonnr"		, htmlentities($this->telefoonnr, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":situatie"		, htmlentities($this->situatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":opmerkingen"	, htmlentities($this->opmerkingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":status"			, $this->status, PDO::PARAM_STR);
			$stmt->bindValue( ":type"			, $this->type, PDO::PARAM_STR);
			$stmt->bindValue( ":opties"			, $this->opties, PDO::PARAM_STR);
			$stmt->bindValue( ":picfile"		, $this->picfile, PDO::PARAM_STR);
			$stmt->bindValue( ":link_linkedin"	, htmlentities($this->link_linkedin, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (client 5) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	    return TRUE;	
	}
	protected function readclientWithId ($attr)
	{
		/* Haal de gegevens uit de database
			$clientid kan 2 soorten waarde hebben:
			NULL of 0 => het object bestaat niet in de database => zo laten
			integer => het object kan uit de DB gelezen worden => ophalen en attrs vullen
		*/
		global $connection;
		try
		{
			// openDB();
			$sql = "SELECT * FROM client WHERE id = :id  AND delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", htmlentities($attr,  ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$clientrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (client 2) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	    return $clientrow;	
	}
	
	protected function readclientWithEmailadres ($attr)
	{
		global $connection;
		try
		{
// 			error_log("We gaan de client ophalen met het emailadres");
			// openDB();
			$sql = "SELECT * FROM client WHERE emailadres = :emailadres AND deleted = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":emailadres", htmlentities($attr,  ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$clientrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (client 4) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	    return $clientrow;	
	}
}
