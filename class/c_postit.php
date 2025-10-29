<?php
/* Namespace alias. */
class Postit
{
	protected $id;
	protected $publInd;
	protected $publDatum;
	protected $titel;
	protected $tekst;
	protected $linkTekst;
	protected $link;
	protected $kleur;
	
	public function __construct() 
	{
		$this->id = NULL;
		$this->publInd = 'n';
		$this->publDatum = '';
		$this->titel = '';
		$this->tekst = '';
		$this->linkTekst = '';
		$this->link = '';
		$this->kleur = '';

		
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) 
        { 
            call_user_func_array(array($this,$f),$a); 
        }
	}
	public function __construct2 ($attr, $value)
	{
		/* id is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
			$this->__construct1($this->readPostitWithId($value));
			break;
			
			default:
			return FALSE;
		}
		
	}
	
	public function __construct1 ($row) 
	{
		if ($row)
		{
			$this->id 			= $row['id'];
			$this->publInd		= $row['publInd'];
			$this->publDatum	= $row['publDatum'];
			$this->titel		= html_entity_decode($row['titel']);
			$this->tekst		= html_entity_decode($row['tekst']);
			$this->linkTekst	= html_entity_decode($row['linkTekst']);
			$this->link			= html_entity_decode($row['link']);
			$this->kleur		= html_entity_decode($row['kleur']);
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
			'$id		: ' . $this->id .			'<br/>' .
			'$publInd: ' . $this->publInd .	'<br/>' .
			'$publDatum: ' . $this->publDatum .	'<br/>' .
			'$titel		: ' . html_entity_decode($this->titel) .	'<br/>' .
			'$tekst		: ' . html_entity_decode($this->tekst) .	'<br/>' .
			'$linkTekst: ' . html_entity_decode($this->linkTekst) .	'<br/>' .
			'$link		: ' . html_entity_decode($this->link) .	'<br/>' .
			'$kleur		: ' . html_entity_decode($this->kleur) .	'<br/>';
	}
	protected function readPostitWithId ($id)
	{
		/* Haal de gegevens uit de database
		*/
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM postit WHERE id = :id;";
			
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
		/* zorg dat een foto goed wordt weergegeven */
		$this->tekst = preg_replace('/"width: .*"/', '"width: 100%;"', $this->tekst);

		try
		{			
			openDB();
			$sql = "INSERT postit 
			(	id,
				publInd		 ,
				publDatum		 ,
				titel ,
				tekst ,
				linkTekst ,
				link ,
				kleur
			)
			VALUES (
				:id,
				:publInd		 ,
				:publDatum		 ,
				:titel ,
				:tekst ,
				:linkTekst ,
				:link ,
				:kleur
			)";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
 		   	$stmt->bindValue( ":publInd"		, htmlentities($this->publInd, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":publDatum"		, htmlentities($this->publDatum, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":titel"			, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":tekst"			, htmlentities($this->tekst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":linkTekst"		, htmlentities($this->linkTekst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":link"			, htmlentities($this->link, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":kleur"			, htmlentities($this->kleur, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);

			$stmt->execute();
			$this->id = $connection->lastInsertId();
			// error_log($this->id);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (postit 1) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}

	public function updateToDB () 
	{
		global $connection;
		/* zorg dat een foto goed wordt weergegeven */
		$this->tekst = preg_replace('/"width: .*"/', '"width: 100%;"', $this->tekst);
		try
		{
			openDB();
			$sql = "UPDATE postit SET
			publInd		  	= :publInd,
			publDatum		= :publDatum,
			titel		  	= :titel,
			tekst			= :tekst,
			linkTekst		= :linkTekst,
			link			= :link,
			kleur			= :kleur
			WHERE id		= :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":publInd"		, $this->publInd, PDO::PARAM_STR);
			$stmt->bindValue( ":publDatum"		, $this->publDatum, PDO::PARAM_STR);
			$stmt->bindValue( ":titel"			, htmlentities($this->titel, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":tekst"			, htmlentities($this->tekst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":linkTekst"		, htmlentities($this->linkTekst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":link"			, htmlentities($this->link, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":kleur"			, htmlentities($this->kleur, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (postit 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	

	}

}
/***********
  dit is een korte testcode
  ************/
// include('../config.php');
// $test = new Postit('id', '1');
// echo $test;
?>
