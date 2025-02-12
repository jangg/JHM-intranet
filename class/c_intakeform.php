<?php
class Intakeform
{
	protected $id					;			
	protected $id_werkzkd			;	
	protected $roepnaam				;			
	protected $gebplaats			;			
	protected $gebland				;			
	protected $nationaliteit		;
	protected $legitimatieind		;
	protected $relatie				;	
	protected $volw_kind			;			
	protected $partner_beroep		;		
	protected $aanmelding			;
	protected $bron					;
	protected $regeling				;	
	protected $uitdagingen 			;			
	protected $beperking			;
	protected $finsituatie			;
	protected $redenen				;			
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
	protected $taalbeh_schr			;	
	protected $reistijd				;			
	protected $vervoer				;			
	protected $werkbijzh			;
	protected $id_intaker			;		
	protected $overige_opm			;
	protected $besprmis				;
	protected $besprtkn				;
	protected $besprvwk				;
	protected $besprprv				;
	protected $besprstatgeld		;
	protected $besprkopie_ao		;
	protected $besprvrijwbijd		;		
	protected $akkoord_datum		;
	protected $akkoord_plaats		;		
	protected $akkoord_naam			;	
	protected $akkoord_handtek		;
	protected $advjobgroup			;
	protected $advmaatje			;
	protected $advnietontv			;
	protected $advopmerkingen		;
	protected $advverwdatum			;
		
	public function __construct () 
	{
		$this->id					= NULL;
		$this->id_werkzkd			= NULL;
		$this->roepnaam				= '';
		$this->gebplaats			= '';
		$this->gebland				= '';
		$this->nationaliteit		= '';
		$this->legitimatieind		= '';
		$this->relatie				= '';
		$this->volw_kind			= '';
		$this->partner_beroep		= '';
		$this->aanmelding			= '';
		$this->bron					= '';
		$this->regeling				= '';
		$this->uitdagingen 			= '';
		$this->beperking			= '';
		$this->finsituatie			= '';
		$this->redenen				= '';
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
		$this->taalbeh_schr			= '';
		$this->reistijd				= '';
		$this->vervoer				= '';
		$this->werkbijzh			= '';
		$this->id_intaker			= NULL;
		$this->overige_opm			= '';
		$this->besprmis				= '';
		$this->besprtkn				= '';
		$this->besprvwk				= '';
		$this->besprprv				= '';
		$this->besprstatgeld		= '';
		$this->besprkopie_ao		= '';
		$this->besprvrijwbijd		= '';
		$this->akkoord_datum		= '';
		$this->akkoord_plaats		= '';
		$this->akkoord_naam			= '';
		$this->akkoord_handtek		= '';
		$this->advjobgroup			= '';
		$this->advmaatje			= '';
		$this->advnietontv			= '';
		$this->advopmerkingen			= '';
		$this->advverwdatum			= '';	
		
		$a = func_get_args(); 
		$i = func_num_args(); 
		if (method_exists($this,$f='__construct'.$i)) 
		{ 
			call_user_func_array(array($this,$f),$a); 
		}
	
    }
     	
	public function __construct1 ($intakeformrow) 
	{
		if ($intakeformrow)
		{
// 			error_log("Intakeform bestaat, invullen maar");
			$this->id					= $intakeformrow['id'];
			$this->id_werkzkd			= html_entity_decode($intakeformrow['id_werkzkd']);
			$this->roepnaam			= html_entity_decode($intakeformrow['roepnaam']);
			$this->gebplaats			= html_entity_decode($intakeformrow['gebplaats']);
			$this->gebland				= $intakeformrow['gebland'];
			$this->nationaliteit		= $intakeformrow['nationaliteit'];
			$this->legitimatieind	= $intakeformrow['legitimatieind'];
			$this->relatie				= html_entity_decode($intakeformrow['relatie']);
			$this->volw_kind			= html_entity_decode($intakeformrow['volw_kind']);
			$this->partner_beroep	= html_entity_decode($intakeformrow['partner_beroep']);
			$this->aanmelding			= $intakeformrow['aanmelding'];
			$this->bron					= html_entity_decode($intakeformrow['bron']);
			$this->regeling			= html_entity_decode($intakeformrow['regeling']);
			$this->uitdagingen 		= html_entity_decode($intakeformrow['uitdagingen']);
			$this->beperking			= html_entity_decode($intakeformrow['beperking']);
			$this->finsituatie		= $intakeformrow['finsituatie'];
			$this->redenen				= html_entity_decode($intakeformrow['redenen']);
			$this->motivatie			= html_entity_decode($intakeformrow['motivatie']);
			$this->eisen				= html_entity_decode($intakeformrow['eisen']);
			$this->netwerken			= html_entity_decode($intakeformrow['netwerken']);
			$this->andere_hulp		= html_entity_decode($intakeformrow['andere_hulp']);
			$this->CVind				= $intakeformrow['CVind'];
			$this->diploma				= html_entity_decode($intakeformrow['diploma']);
			$this->studie				= html_entity_decode($intakeformrow['studie']);
			$this->werkervaring		= html_entity_decode($intakeformrow['werkervaring']);
			$this->werk_gewenst		= html_entity_decode($intakeformrow['werk_gewenst']);
			$this->voorwaarden		= html_entity_decode($intakeformrow['voorwaarden']);
			$this->taalbeh				= $intakeformrow['taalbeh'];
			$this->taalbeh_schr		= $intakeformrow['taalbeh_schr'];
			$this->reistijd			= html_entity_decode($intakeformrow['reistijd']);
			$this->vervoer				= html_entity_decode($intakeformrow['vervoer']);
			$this->werkbijzh			= html_entity_decode($intakeformrow['werkbijzh']);
			$this->id_intaker			= $intakeformrow['id_intaker'];
			$this->overige_opm		= html_entity_decode($intakeformrow['overige_opm']);
			$this->besprmis			= $intakeformrow['besprmis'];
			$this->besprtkn			= $intakeformrow['besprtkn'];
			$this->besprvwk			= $intakeformrow['besprvwk'];
			$this->besprprv			= $intakeformrow['besprprv'];
			$this->besprstatgeld		= $intakeformrow['besprstatgeld'];
			$this->besprkopie_ao		= $intakeformrow['besprkopie_ao'];
			$this->besprvrijwbijd	= $intakeformrow['besprvrijwbijd'];
			$this->akkoord_datum		= html_entity_decode($intakeformrow['akkoord_datum']);
			$this->akkoord_plaats	= html_entity_decode($intakeformrow['akkoord_plaats']);
			$this->akkoord_naam		= html_entity_decode($intakeformrow['akkoord_naam']);
			$this->akkoord_handtek	= html_entity_decode($intakeformrow['akkoord_handtek']);
			$this->advjobgroup		= $intakeformrow['advjobgroup'];
			$this->advmaatje			= $intakeformrow['advmaatje'];
			$this->advnietontv		= html_entity_decode($intakeformrow['advnietontv']);
			$this->advopmerkingen	= html_entity_decode($intakeformrow['advopmerkingen']);
			$this->advverwdatum		= html_entity_decode($intakeformrow['advverwdatum']);
		}
	}

	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readIntakeformWithId($value));
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
							gebplaats		,
							gebland			,
							nationaliteit	,
							legitimatieind	,
							relatie			,
							volw_kind		,
							partner_beroep	,
							aanmelding		,
							bron			,	
							regeling		,	
							uitdagingen 	,	
							beperking		,
							finsituatie		,
							redenen			,
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
							taalbeh_schr	,	
							reistijd		,	
							vervoer			,
							werkbijzh		,
							id_intaker		,
							overige_opm		,
							besprmis		,	
							besprtkn		,	
							besprvwk		,	
							besprprv		,	
							besprstatgeld	,
							besprkopie_ao	,
							besprvrijwbijd	,
							akkoord_datum	,
							akkoord_plaats	,
							akkoord_naam	,	
							akkoord_handtek	,
							advjobgroup		,
							advmaatje		,
							advnietontv		,
							advopmerkingen		,
							advverwdatum
						)
					VALUES 
						(
							:id				,
							:id_werkzkd		,
							:roepnaam		,	
							:gebplaats		,
							:gebland			,
							:nationaliteit	,
							:legitimatieind	,
							:relatie			,
							:volw_kind		,
							:partner_beroep	,
							:aanmelding		,
							:bron			,	
							:regeling		,	
							:uitdagingen 	,	
							:beperking		,
							:finsituatie		,
							:redenen			,
							:motivatie		,
							:eisen			,
							:netwerken		,
							:andere_hulp		,
							:CVind			,
							:diploma			,
							:studie			,
							:werkervaring	,	
							:werk_gewenst	,	
							:voorwaarden		,
							:taalbeh			,
							:taalbeh_schr	,	
							:reistijd		,	
							:vervoer			,
							:werkbijzh		,
							:id_intaker		,
							:overige_opm		,
							:besprmis		,	
							:besprtkn		,	
							:besprvwk		,	
							:besprprv		,	
							:besprstatgeld	,
							:besprkopie_ao	,
							:besprvrijwbijd	,
							:akkoord_datum	,
							:akkoord_plaats	,
							:akkoord_naam	,	
							:akkoord_handtek	,
							:advjobgroup		,
							:advmaatje		,
							:advnietontv		,
							:advopmerkingen		,
							:advverwdatum							
						);";
		
			
			$stmt = $connection->prepare( $sql );
			
			$stmt->bindvalue(":id"					, NULL, PDO::PARAM_STR);
			$stmt->bindvalue(":id_werkzkd"		, $this->id_werkzkd, PDO::PARAM_STR);
			$stmt->bindvalue(":roepnaam"			, htmlentities($this->roepnaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":gebplaats"			, htmlentities($this->gebplaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":gebland"			, htmlentities($this->gebland, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":nationaliteit"	, $this->nationaliteit, PDO::PARAM_STR);
			$stmt->bindvalue(":legitimatieind"	, $this->legitimatieind, PDO::PARAM_STR);
			$stmt->bindvalue(":relatie"			, $this->relatie, PDO::PARAM_STR);
			$stmt->bindvalue(":volw_kind"			, htmlentities($this->volw_kind, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":partner_beroep"	, htmlentities($this->partner_beroep, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":aanmelding"		, $this->aanmelding, PDO::PARAM_STR);
			$stmt->bindvalue(":bron"				, htmlentities($this->bron, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":regeling"			, htmlentities($this->regeling, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":uitdagingen"		, htmlentities($this->uitdagingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":beperking"			, htmlentities($this->beperking, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":finsituatie"		, $this->finsituatie, PDO::PARAM_STR);
			$stmt->bindvalue(":redenen"			, htmlentities($this->redenen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":motivatie"			, htmlentities($this->motivatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":eisen"				, htmlentities($this->eisen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":netwerken"			, htmlentities($this->netwerken, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":andere_hulp"		, htmlentities($this->andere_hulp, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":CVind"				, $this->CVind, PDO::PARAM_STR);
			$stmt->bindvalue(":diploma"			, htmlentities($this->diploma, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":studie"				, htmlentities($this->studie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werkervaring"		, htmlentities($this->werkervaring, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werk_gewenst"		, htmlentities($this->werk_gewenst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":voorwaarden"		, htmlentities($this->voorwaarden, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":taalbeh"			, $this->taalbeh, PDO::PARAM_STR);
			$stmt->bindvalue(":taalbeh_schr"		, $this->taalbeh_schr, PDO::PARAM_STR);
			$stmt->bindvalue(":reistijd"			, htmlentities($this->reistijd, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":vervoer"			, htmlentities($this->vervoer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werkbijzh"			, htmlentities($this->werkbijzh, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":id_intaker"		, $this->id_intaker, PDO::PARAM_STR);
			$stmt->bindvalue(":overige_opm"		, htmlentities($this->overige_opm, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":besprmis"			, $this->besprmis, PDO::PARAM_STR);
			$stmt->bindvalue(":besprtkn"			, $this->besprtkn, PDO::PARAM_STR);
			$stmt->bindvalue(":besprvwk"			, $this->besprvwk, PDO::PARAM_STR);
			$stmt->bindvalue(":besprprv"			, $this->besprprv, PDO::PARAM_STR);
			$stmt->bindvalue(":besprstatgeld"	, $this->besprstatgeld, PDO::PARAM_STR);
			$stmt->bindvalue(":besprkopie_ao"	, $this->besprkopie_ao, PDO::PARAM_STR);
			$stmt->bindvalue(":besprvrijwbijd"	, $this->besprvrijwbijd, PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_datum"	, htmlentities($this->akkoord_datum, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_plaats"	, htmlentities($this->akkoord_plaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_naam"		, htmlentities($this->akkoord_naam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_handtek" , htmlentities($this->akkoord_handtek, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":advjobgroup"		, $this->advjobgroup, PDO::PARAM_STR);
			$stmt->bindvalue(":advmaatje"			, $this->advmaatje, PDO::PARAM_STR);
			$stmt->bindvalue(":advnietontv"		, htmlentities($this->advnietontv, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":advopmerkingen"	, htmlentities($this->advopmerkingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":advverwdatum"    , htmlentities($this->advverwdatum, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);

			
			$stmt->execute();
// 			error_log('Een nieuwe c_intakeform is toegevoegd');
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
					roepnaam		 =	:roepnaam		,
					gebplaats		 =	:gebplaats	,
					gebland			 =	:gebland		,
					nationaliteit	 =	:nationaliteit	,
					legitimatieind 	=	:legitimatieind,
					relatie		 	=	:relatie		,
					volw_kind		 =	:volw_kind	,
					partner_beroep	 =	:partner_beroep,
					aanmelding	 	=	:aanmelding	,
					bron			 =	:bron			,
					regeling		 =	:regeling		,
					uitdagingen	 	=	:uitdagingen	,
					beperking		 =	:beperking		,
					finsituatie		 =	:finsituatie		,
					redenen		 	=	:redenen		,
					motivatie		 =	:motivatie		,
					eisen			 =	:eisen			,
					netwerken		 =	:netwerken		,
					andere_hulp	 	=	:andere_hulp	,
					CVind			 =	:CVind			,
					diploma		 	=	:diploma		,
					studie		 	=	:studie		,
					werkervaring	 =	:werkervaring	,
					werk_gewenst	 =	:werk_gewenst	,
					voorwaarden	 	=	:voorwaarden	,
					taalbeh			=	:taalbeh		,
					taalbeh_schr	 =	:taalbeh_schr	,
					reistijd		 =	:reistijd		,
					vervoer		 	=	:vervoer		,
					werkbijzh	 	=	:werkbijzh	,
					id_intaker	 	=	:id_intaker	,
					overige_opm	 	=	:overige_opm	,
					besprmis		 =	:besprmis		,
					besprtkn		 =	:besprtkn		,
					besprvwk		 =	:besprvwk		,
					besprprv		 =	:besprprv		,
					besprstatgeld 	=	:besprstatgeld,
					besprkopie_ao	 =	:besprkopie_ao	,
					besprvrijwbijd 	=	:besprvrijwbijd,
					akkoord_datum	 =	:akkoord_datum	,
					akkoord_plaats 	=	:akkoord_plaats,
					akkoord_naam	 =	:akkoord_naam	,
					akkoord_handtek =	:akkoord_handtek,
					advjobgroup 	=	:advjobgroup,
					advmaatje		 =	:advmaatje		,
					advnietontv	 	=	:advnietontv	,
					advopmerkingen 	=	:advopmerkingen,
					advverwdatum   	=	:advverwdatum  
					WHERE id = :id;";
			// error_log($sql);
			$stmt = $connection->prepare( $sql );
			$stmt->bindvalue(":id"					, $this->id, PDO::PARAM_STR);
			// $stmt->bindvalue(":id_werkzkd"		, $this->id_werkzkd, PDO::PARAM_STR);
			$stmt->bindvalue(":roepnaam"			, htmlentities($this->roepnaam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":gebplaats"			, htmlentities($this->gebplaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
		$stmt->bindvalue(":gebland"				, htmlentities($this->gebland, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":nationaliteit"	, $this->nationaliteit, PDO::PARAM_STR);
			$stmt->bindvalue(":legitimatieind"	, $this->legitimatieind, PDO::PARAM_STR);
			$stmt->bindvalue(":relatie"			, $this->relatie, PDO::PARAM_STR);
			$stmt->bindvalue(":volw_kind"			, htmlentities($this->volw_kind, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":partner_beroep"	, htmlentities($this->partner_beroep, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":aanmelding"		, $this->aanmelding, PDO::PARAM_STR);
			$stmt->bindvalue(":bron"				, htmlentities($this->bron, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":regeling"			, htmlentities($this->regeling, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
		$stmt->bindvalue(":uitdagingen"			, htmlentities($this->uitdagingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":beperking"			, htmlentities($this->beperking, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":finsituatie"		, htmlentities($this->finsituatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":redenen"			, htmlentities($this->redenen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":motivatie"			, htmlentities($this->motivatie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":eisen"				, htmlentities($this->eisen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":netwerken"			, htmlentities($this->netwerken, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":andere_hulp"		, htmlentities($this->andere_hulp, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":CVind"				, $this->CVind, PDO::PARAM_STR);
			$stmt->bindvalue(":diploma"			, htmlentities($this->diploma, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":studie"				, htmlentities($this->studie, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werkervaring"		, htmlentities($this->werkervaring, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werk_gewenst"		, htmlentities($this->werk_gewenst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":voorwaarden"		, htmlentities($this->voorwaarden, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":taalbeh"			, $this->taalbeh, PDO::PARAM_STR);
			$stmt->bindvalue(":taalbeh_schr"		, $this->taalbeh_schr, PDO::PARAM_STR);
			$stmt->bindvalue(":reistijd"			, htmlentities($this->reistijd, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":vervoer"			, htmlentities($this->vervoer, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":werkbijzh"			, htmlentities($this->werkbijzh, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":id_intaker"		, $this->id_intaker, PDO::PARAM_STR);
			$stmt->bindvalue(":overige_opm"		, htmlentities($this->overige_opm, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":besprmis"			, $this->besprmis, PDO::PARAM_STR);
			$stmt->bindvalue(":besprtkn"			, $this->besprtkn, PDO::PARAM_STR);
			$stmt->bindvalue(":besprvwk"			, $this->besprvwk, PDO::PARAM_STR);
			$stmt->bindvalue(":besprprv"			, $this->besprprv, PDO::PARAM_STR);
			$stmt->bindvalue(":besprstatgeld"	, $this->besprstatgeld, PDO::PARAM_STR);
			$stmt->bindvalue(":besprkopie_ao"	, $this->besprkopie_ao, PDO::PARAM_STR);
			$stmt->bindvalue(":besprvrijwbijd"	, $this->besprvrijwbijd, PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_datum"	, htmlentities($this->akkoord_datum, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_plaats"	, htmlentities($this->akkoord_plaats, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_naam"		, htmlentities($this->akkoord_naam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":akkoord_handtek" , htmlentities($this->akkoord_handtek, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":advjobgroup"		, $this->advjobgroup, PDO::PARAM_STR);
			$stmt->bindvalue(":advmaatje"			, $this->advmaatje, PDO::PARAM_STR);
			$stmt->bindvalue(":advnietontv"		, htmlentities($this->advnietontv, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":advopmerkingen"	, htmlentities($this->advopmerkingen, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindvalue(":advverwdatum"    , htmlentities($this->advverwdatum, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);

			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (intakeform 5) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	    return TRUE;	
	}
	public function readIntakeformWithId ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT intakeform.* FROM intakeform WHERE intakeform.id = :id;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$intakeformrow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (intakeform 1) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return $intakeformrow;	
	}

}
