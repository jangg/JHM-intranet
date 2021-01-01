<?php
class Intakeform
{
	protected $id					;			
	protected $id_werkzkd			;	
	protected $roepnaam				;			
	protected $gebdatum				;
	protected $gebplaats			;			
	protected $gebland				;			
	protected $nationaliteit		;
	protected $legitimatieind		;
	protected $relatie				;	
	protected $volw_kind			;			
	protected $partner_beroep		;		
	protected $aanmelding			;
	protected $regeling				;	
	protected $uitdagingen 			;			
	protected $beperking			;			
	protected $motivatie			;			
	protected $eisen				;			
	protected $netwerken			;		
	protected $andere_hulp			;		
	protected $CVind				;	
	protected $diploma				;			
	protected $studie				;			
	protected $werkervaring			;
	protected $werk_gewenst			;		
	protected $voorwaarden			;	
	protected $taalbeh				;	
	protected $reistijd				;			
	protected $vervoer				;			
	protected $werkbijzh			;		
	protected $overige_opm			;		
	protected $akkoord_datum		;
	protected $akkoord_plaats		;		
	protected $akkoord_naam			;	
	protected $akkoord_handtek		;
		
	public function __construct () 
	{
		$this->id					= NULL;	
		$this->id_werkzkd			= NULL;	
		$this->roepnaam				= ''; 		
		$this->gebdatum				= '';		
		$this->gebplaats			= '';		
		$this->gebland				= '';		
		$this->nationaliteit		= '';		
		$this->legitimatieind		= '';		
		$this->relatie				= '';		
		$this->volw_kind			= '';		
		$this->partner_beroep		= '';		
		$this->aanmelding			= '';		
		$this->regeling				= '';		
		$this->uitdagingen			= '';		
		$this->beperking			= '';		
		$this->motivatie			= '';		
		$this->eisen				= '';		
		$this->netwerken			= '';		
		$this->andere_hulp			= '';		
		$this->CVind				= '';		
		$this->diploma				= '';		
		$this->studie				= '';		
		$this->werkervaring			= '';		
		$this->werk_gewenst			= '';		
		$this->voorwaarden			= '';		
		$this->taalbeh				= '';		
		$this->reistijd				= '';		
		$this->vervoer				= '';		
		$this->werkbijzh			= '';		
		$this->overige_opm			= '';		
		$this->akkoord_datum		= '';		
		$this->akkoord_plaats		= '';		
		$this->akkoord_naam			= '';		
		$this->akkoord_handtek		= '';		
    }
     	
	public function __construct1 ($intakeformrow) 
	{
		if ($intakeformrow)
		{
// 			error_log("Intakeform bestaat, invullen maar");
			$this->id					= $intakeformrow['id'];
			$this->id_werkzkd			= $intakeformrow['id_werkzkd'];
			$this->roepnaam				= $intakeformrow['roepnaam'];
			$this->gebdatum				= $intakeformrow['gebdatum'];
			$this->gebplaats			= $intakeformrow['gebplaats'];
			$this->gebland				= $intakeformrow['gebland'];
			$this->nationaliteit		= $intakeformrow['nationaliteit'];
			$this->legitimatieind		= $intakeformrow['legitimatieind'];
			$this->relatie				= $intakeformrow['relatie'];
			$this->volw_kind			= $intakeformrow['volw_kind'];
			$this->partner_beroep		= $intakeformrow['partner_beroep'];
			$this->aanmelding			= $intakeformrow['aanmelding'];
			$this->regeling				= $intakeformrow['regeling'];
			$this->uitdagingen 			= $intakeformrow['uitdagingen'];
			$this->beperking			= $intakeformrow['beperking'];
			$this->motivatie			= $intakeformrow['motivatie'];
			$this->eisen				= $intakeformrow['eisen'];
			$this->netwerken			= $intakeformrow['netwerken'];
			$this->andere_hulp			= $intakeformrow['andere_hulp'];
			$this->CVind				= $intakeformrow['CVind'];
			$this->diploma				= $intakeformrow['diploma'];
			$this->studie				= $intakeformrow['studie'];
			$this->werkervaring			= $intakeformrow['werkervaring'];
			$this->werk_gewenst			= $intakeformrow['werk_gewenst'];
			$this->voorwaarden			= $intakeformrow['voorwaarden'];
			$this->taalbeh				= $intakeformrow['taalbeh'];
			$this->reistijd				= $intakeformrow['reistijd'];
			$this->vervoer				= $intakeformrow['vervoer'];
			$this->werkbijzh			= $intakeformrow['werkbijzh'];
			$this->overige_opm			= $intakeformrow['overige_opm'];
			$this->akkoord_datum		= $intakeformrow['akkoord_datum'];
			$this->akkoord_plaats		= $intakeformrow['akkoord_plaats'];
			$this->akkoord_naam			= $intakeformrow['akkoord_naam'];
			$this->akkoord_handtek		= $intakeformrow['akkoord_handtek'];
		}
	}

	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'intakeform_id':
				$this->__construct1($this->readintakeformnWithIntakeform_id($value));
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
		return '';
			// '$person_id			: ' . $this->person_id	. '<br/>' .
			// '$delind			: ' . $this->delind		. '<br/>' .
			// 'datetime_created	: ' . $this->datetime_created		. '<br/>' .
			// '$datetime_modified	: ' . $this->datetime_modified		. '<br/>' .
			// '$voornaam			: ' . $this->voornaam		. '<br/>' .
			// '$tussenvoegsels	: ' . $this->tussenvoegsels	. '<br/>' .
			// '$achternaam		: ' . $this->achternaam	. '<br/>' .
			// '$straat            : ' . $this->straat . '<br/>' .
			// '$huisnummer        : ' . $this->huisnummer . '<br/>' .
			// '$postcode          : ' . $this->postcode . '<br/>' .
			// '$woonplaats        : ' . $this->woonplaats . '<br/>' .
			// '$emailadres        : ' . $this->emailadres	. '<br/>' .
			// '$telefoonnr		: ' . $this->telefoonnr	. '<br/>' .
			// '$type				: ' . $this->type			. '<br/>' .
			// '$picfile			: ' . $this->picfile		. '<br/>' .
			// '$link_linkedin		: ' . $this->link_linkedin	. '<br/>' .
			// '$presentInd		: ' . $this->presentInd	. '<br/>';

	}
	
	public function saveToDB ($id_werkzkd) 
	{
		if (empty($id_werkzkd))
			return FALSE;
		$this->id_werkzkd = $id_werkzkd;
		global $connection;
		try
		{	
			// $date = new DateTime();
			// $this->datetime_created = $date->format('Y-m-d H:i:s');
			// $this->datetime_modified = $date->format('Y-m-d H:i:s');
		
			$sql = "INSERT intakeform 
						(	
							id				,
							id_werkzkd		,
							roepnaam		,	
							gebdatum		,	
							gebplaats		,
							gebland			,
							nationaliteit	,
							legitimatieind	,
							relatie			,
							volw_kind		,
							partner_beroep	,
							aanmelding		,
							regeling		,	
							uitdagingen		,
							beperking		,
							motivatie		,
							eisen			,
							netwerken		,
							andere_hulp		,
							CVind			,
							diploma			,
							studie			,
							werkervaring	,	
							werk_gewenst	,	
							voorwaarden		,
							taalbeh			,
							reistijd		,	
							vervoer			,
							werkbijzh		,
							overige_opm	,	
							akkoord_datum	,
							akkoord_plaats	,
							akkoord_naam	,	
							akkoord_handtek
						)
					VALUES 
						(
							:id				,
							:id_werkzkd		,
							:roepnaam		,
							:gebdatum		,
							:gebplaats		,
							:gebland		,
							:nationaliteit	,
							:legitimatieind	,
							:relatie		,
							:volw_kind		,
							:partner_beroep	,
							:aanmelding		,
							:regeling		,
							:uitdagingen	,
							:beperking		,
							:motivatie		,
							:eisen			,
							:netwerken		,
							:andere_hulp	,
							:CVind			,
							:diploma		,
							:studie			,
							:werkervaring	,
							:werk_gewenst	,
							:voorwaarden	,
							:taalbeh		,
							:reistijd		,
							:vervoer		,
							:werkbijzh		,
							:overige_opm	,
							:akkoord_datum	,
							:akkoord_plaats	,
							:akkoord_naam	,
							:akkoord_handtek
						);";
		
			
			$stmt = $connection->prepare( $sql );
			
			$stmt->bindvalue(":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindvalue(":id_werkzkd"		, $this->id_werkzkd, PDO::PARAM_STR);
			$stmt->bindvalue(":roepnaam"		, htmlentities($this->roepnaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":gebdatum"		, htmlentities($this->gebdatum, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":gebplaats"		, htmlentities($this->gebplaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":gebland"			, htmlentities($this->gebland, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":nationaliteit"	, $this->nationaliteit, PDO::PARAM_STR);
			$stmt->bindvalue(":legitimatieind"	, $this->legitimatieind, PDO::PARAM_STR);
			$stmt->bindvalue(":relatie"			, $this->relatie, PDO::PARAM_STR);
			$stmt->bindvalue(":volw_kind"		, htmlentities($this->volw_kind, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":partner_beroep"	, htmlentities($this->partner_beroep, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":aanmelding"		, $this->aanmelding, PDO::PARAM_STR);
			$stmt->bindvalue(":regeling"		, htmlentities($this->regeling, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":uitdagingen"		, htmlentities($this->uitdagingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":beperking"		, htmlentities($this->beperking, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":motivatie"		, htmlentities($this->motivatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":eisen"			, htmlentities($this->eisen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":netwerken"		, htmlentities($this->netwerken, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":andere_hulp"		, htmlentities($this->andere_hulp, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":CVind"			, $this->CVind, PDO::PARAM_STR);
			$stmt->bindvalue(":diploma"			, htmlentities($this->diploma, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":studie"			, htmlentities($this->studie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werkervaring"	, htmlentities($this->werkervaring, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werk_gewenst"	, htmlentities($this->werk_gewenst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":voorwaarden"		, htmlentities($this->voorwaarden, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":taalbeh"			, $this->taalbeh, PDO::PARAM_STR);
			$stmt->bindvalue(":reistijd"		, htmlentities($this->reistijd, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":vervoer"			, htmlentities($this->vervoer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werkbijzh"		, htmlentities($this->werkbijzh, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":overige_opm"		, htmlentities($this->overige_opm, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_datum"	, htmlentities($this->akkoord_datum, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_plaats"	, htmlentities($this->akkoord_plaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_naam"	, htmlentities($this->akkoord_naam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_handtek" , htmlentities($this->akkoord_handtek, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			
			$stmt->execute();
// 			error_log('Een nieuwe c_person is toegevoegd');
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (intakeform 1) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	    return TRUE;	
	}

	public function updateToDB () 
	{
		global $connection;
		try
		{
			// $date = new DateTime();
			// $this->datetime_modified = $date->format('Y-m-d H:i:s');

			$sql = "UPDATE intakeform SET
						roepnaam			= :roepnaam			,
						gebdatum			= :gebdatum			,
						gebplaats			= :gebplaats		,
						gebland				= :gebland			,
						nationaliteit		= :nationaliteit	,
						legitimatieind		= :legitimatieind	,
						relatie				= :relatie			,
						volw_kind			= :volw_kind		,
						partner_beroep		= :partner_beroep	,
						aanmelding			= :aanmelding		,
						regeling			= :regeling			,
						uitdagingen 		= :uitdagingen 		,
						beperking			= :beperking		,
						motivatie			= :motivatie		,
						eisen				= :eisen			,
						netwerken			= :netwerken		,
						andere_hulp			= :andere_hulp		,
						CVind				= :CVind			,
						diploma				= :diploma			,
						studie				= :studie			,
						werkervaring		= :werkervaring		,
						werk_gewenst		= :werk_gewenst		,
						voorwaarden			= :voorwaarden		,
						taalbeh				= :taalbeh			,
						reistijd			= :reistijd			,
						vervoer				= :vervoer			,
						werkbijzh			= :werkbijzh		,
						overige_opm			= :overige_opm		,
						akkoord_datum		= :akkoord_datum	,
						akkoord_plaats		= :akkoord_plaats	,
						akkoord_naam		= :akkoord_naam		,
						akkoord_handtek		= :akkoord_handtek		
					WHERE id = :id;";
			// error_log($sql);
			$stmt = $connection->prepare( $sql );
			$stmt->bindvalue(":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindvalue(":roepnaam"		, htmlentities($this->roepnaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":gebdatum"		, htmlentities($this->gebdatum, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":gebplaats"		, htmlentities($this->gebplaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":gebland"			, htmlentities($this->gebland, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":nationaliteit"	, $this->nationaliteit, PDO::PARAM_STR);
			$stmt->bindvalue(":legitimatieind"	, $this->legitimatieind, PDO::PARAM_STR);
			$stmt->bindvalue(":relatie"			, $this->relatie, PDO::PARAM_STR);
			$stmt->bindvalue(":volw_kind"		, htmlentities($this->volw_kind, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":partner_beroep"	, htmlentities($this->partner_beroep, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":aanmelding"		, $this->aanmelding, PDO::PARAM_STR);
			$stmt->bindvalue(":regeling"		, htmlentities($this->regeling, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":uitdagingen" 	, htmlentities($this->uitdagingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":beperking"		, htmlentities($this->beperking, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":motivatie"		, htmlentities($this->motivatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":eisen"			, htmlentities($this->eisen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":netwerken"		, htmlentities($this->netwerken, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":andere_hulp"		, htmlentities($this->andere_hulp, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":CVind"			, $this->CVind, PDO::PARAM_STR);
			$stmt->bindvalue(":diploma"			, htmlentities($this->diploma, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":studie"			, htmlentities($this->studie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werkervaring"	, htmlentities($this->werkervaring, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werk_gewenst"	, htmlentities($this->werk_gewenst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":voorwaarden"		, htmlentities($this->voorwaarden, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":taalbeh"			, $this->taalbeh, PDO::PARAM_STR);
			$stmt->bindvalue(":reistijd"		, htmlentities($this->reistijd, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":vervoer"			, htmlentities($this->vovervoerornaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werkbijzh"		, htmlentities($this->werkbijzh, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":overige_opm"		, htmlentities($this->overige_opm, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_datum"	, htmlentities($this->akkoord_datum, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_plaats"	, htmlentities($this->akkoord_plaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_naam"	, htmlentities($this->akkoord_naam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_handtek" , htmlentities($this->akkoord_handtek, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);

			// error_log($sql);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (intakeform 5) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	    return TRUE;	
	}
}
