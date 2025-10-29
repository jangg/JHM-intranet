<?php
class Newsitem
{
	protected $id;
	protected $delind;
	protected $id_user_created;
	protected $datetime_created;
	protected $datetime_modified;
	protected $titel;
	protected $subtitel;
	protected $tekst;
	protected $tekst_kort;
	protected $tekst_samenvatting;
	protected $tekst_knop;
	protected $link_knop;
	protected $pubind_intern;
	protected $datetime_pub_intern;
	protected $pubind_extern;
	protected $datetime_pub_extern;
	protected $picfile1;
	protected $picfile2;
	protected $picfile3;
	protected $picfile4;
	
	public function __construct() 
	{
		$this->id					= NULL;
		$this->delind				= 'n';	
		$this->id_user_created		= '';
		$this->datetime_created		= '';
		$this->datetime_modified	= '';
		$this->titel				= '';
		$this->subtitel				= '';
		$this->tekst				= '';
		$this->tekst_kort			= '';
		$this->tekst_samenvatting	= '';
		$this->tekst_knop			= '';
		$this->link_knop			= '';
		$this->pubind_intern		= 'n';
		$this->datetime_pub_intern	= '';
		$this->pubind_extern		= 'n';
		$this->datetime_pub_extern	= '';
		$this->picfile1			= '';
		$this->picfile2			= '';
		$this->picfile3			= '';
		$this->picfile4			= '';
		
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
			$this->__construct1($this->readNewsitemWithId($value));
			break;
			
			default:
			return FALSE;
		}
		
	}
	
	public function __construct1 ($row) 
	{
		if ($row)
		{
			$this->id					= $row['id'];
			$this->delind				= $row['delind'];	
			$this->id_user_created		= $row['id_user_created'];	
			$this->datetime_created		= $row['datetime_created'];	
			$this->datetime_modified	= $row['datetime_modified'];	
			$this->titel				= html_entity_decode($row['titel']);
			$this->subtitel				= html_entity_decode($row['subtitel']);			
			$this->tekst				= html_entity_decode($row['tekst']);			
			$this->tekst_kort			= html_entity_decode($row['tekst_kort']);
			$this->tekst_samenvatting	= html_entity_decode($row['tekst_samenvatting']);
			$this->tekst_knop			= html_entity_decode($row['tekst_knop']);
			$this->link_knop			= html_entity_decode($row['link_knop']);		
			$this->pubind_intern		= $row['pubind_intern'];
			$this->datetime_pub_intern	= $row['datetime_pub_intern'];
			$this->pubind_extern		= $row['pubind_extern'];	
			$this->datetime_pub_extern	= $row['datetime_pub_extern'];
			$this->picfile1				= html_entity_decode($row['picfile1']);
			$this->picfile2				= html_entity_decode($row['picfile2']);
			$this->picfile3				= html_entity_decode($row['picfile3']);
			$this->picfile4				= html_entity_decode($row['picfile4']);
		} else {
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
		'$this->id					' . $this->id				.
		'$this->delind				' . $this->delind			.
		'$this->id_user_created		' . $this->id_user_created	.
		'$this->datetime_created	' . $this->datetime_created	.
		'$this->datetime_modified	' . $this->datetime_modified	.
		'$this->titel				' . $this->titel			.
		'$this->subtitel			' . $this->subtitel			.
		'$this->tekst				' . $this->tekst			.
		'$this->datetime_created	' . $this->datetime_created	.
		'$this->datetime_pub_intern	' . $this->datetime_pub_intern.
		'$this->datetime_pub_extern	' . $this->datetime_pub_extern.
		'$this->tekst_kort			' . $this->tekst_kort		.
		'$this->tekst_samenvatting	' . $this->tekst_samenvatting.
		'$this->tekst_knop			' . $this->tekst_knop		.
		'$this->link_knop			' . $this->link_knop		.
		'$this->pubind_intern		' . $this->pubind_intern	.
		'$this->pubind_extern		' . $this->pubind_extern	.
		'$this->picfile1				' . $this->picfile1 .
		'$this->picfile2				' . $this->picfile2 .
		'$this->picfile3				' . $this->picfile3 .
		'$this->picfile4				' . $this->picfile4;
	}
	
	protected function readNewsitemWithId ($id)
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
			$sql = "SELECT * FROM newsitem WHERE id = :id;";
			
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
			$sql = "INSERT newsitem 
			(	id					,
				delind				,
				id_user_created		,
				datetime_created	,
				datetime_modified	,
				titel				,
				subtitel			,
				tekst				,
				tekst_kort			,
				tekst_samenvatting	,
				tekst_knop			,
				link_knop			,
				pubind_intern		,
				datetime_pub_intern	,
				pubind_extern		,
				datetime_pub_extern	,
				picfile1	,
				picfile2	,
				picfile3	,
				picfile4	
				)			
			VALUES (
				:id					,
				:delind				,
				:id_user_created	,
				:datetime_created	,
				:datetime_modified	,
				:titel				,
				:subtitel			,
				:tekst				,
				:tekst_kort			,
				:tekst_samenvatting	,
				:tekst_knop			,
				:link_knop			,
				:pubind_intern		,
				:datetime_pub_intern,
				:pubind_extern		,
				:datetime_pub_extern,
				:picfile1 ,
				:picfile2 ,
				:picfile3,
				:picfile4				
			)";
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"						, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"					, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":id_user_created"		, $this->id_user_created, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_created"		, $this->datetime_created, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_modified"		, $this->datetime_modified, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"					, htmlentities($this->titel, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":subtitel"				, htmlentities($this->subtitel, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":tekst"					, htmlentities($this->tekst, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":tekst_kort"				, htmlentities($this->tekst_kort, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":tekst_samenvatting"		, htmlentities($this->tekst_samenvatting, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":tekst_knop"				, htmlentities($this->tekst_knop, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":link_knop"				, htmlentities($this->link_knop, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":pubind_intern"			, $this->pubind_intern, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_pub_intern"	, $this->datetime_pub_intern, PDO::PARAM_STR);
			$stmt->bindValue( ":pubind_extern"			, $this->pubind_extern, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_pub_extern"	, $this->datetime_pub_extern, PDO::PARAM_STR);
			$stmt->bindValue( ":picfile1"				, htmlentities($this->picfile1, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":picfile2"				, htmlentities($this->picfile2, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":picfile3"				, htmlentities($this->picfile3, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":picfile4"				, htmlentities($this->picfile4, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
				
			// error_log($this->datetime_created);
			$stmt->execute();
			// error_log('Een nieuwe c_newsitem is toegevoegd');
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (newsitem 1) met de database mislukt: ' . $e->getMessage());
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
			$sql = "UPDATE newsitem SET
				delind				= :delind,
				id_user_created		= :id_user_created,
				titel				= :titel,
				datetime_created	= :datetime_created,
				datetime_modified	= :datetime_modified,
				subtitel			= :subtitel,
				tekst				= :tekst,
				tekst_kort			= :tekst_kort,
				tekst_samenvatting  = :tekst_samenvatting,
				tekst_knop			= :tekst_knop,
				link_knop			= :link_knop,
				pubind_intern		= :pubind_intern,
				datetime_pub_intern = :datetime_pub_intern,
				pubind_extern		= :pubind_extern,
				datetime_pub_extern = :datetime_pub_extern,
				picfile1				= :picfile1,
				picfile2				= :picfile2,
				picfile3				= :picfile3,
				picfile4				= :picfile4
				WHERE 
				id					= :id;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"							, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":delind"					, $this->delind, PDO::PARAM_STR);
			$stmt->bindValue( ":id_user_created"		, $this->id_user_created, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_created"		, $this->datetime_created, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_modified"		, $this->datetime_modified, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"						, htmlentities($this->titel, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":subtitel"					, htmlentities($this->subtitel, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":tekst"						, htmlentities($this->tekst, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":tekst_kort"				, htmlentities($this->tekst_kort, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":tekst_samenvatting"	, htmlentities($this->tekst_samenvatting, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":tekst_knop"				, htmlentities($this->tekst_knop, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":link_knop"				, htmlentities($this->link_knop, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":pubind_intern"			, $this->pubind_intern, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_pub_intern"	, $this->datetime_pub_intern, PDO::PARAM_STR);
			$stmt->bindValue( ":pubind_extern"			, $this->pubind_extern, PDO::PARAM_STR);
			$stmt->bindValue( ":datetime_pub_extern"	, $this->datetime_pub_extern, PDO::PARAM_STR);
			$stmt->bindValue( ":picfile1"					, htmlentities($this->picfile1, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":picfile2"					, htmlentities($this->picfile2, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":picfile3"					, htmlentities($this->picfile3, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->bindValue( ":picfile4"					, htmlentities($this->picfile4, ENT_QUOTES, "UTF-8"), PDO::PARAM_STR);
			$stmt->execute();

		}
		catch (PDOException $e) 
		{
			error_log('Connectie (newsitem 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
}
?>
