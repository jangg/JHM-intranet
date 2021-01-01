<?php
class Categorie
{
	protected $id;
	protected $naam;
	protected $omschrijving;
	protected $nbrTopics;
	protected $nbrPosts;
	
	public function __construct() 
	{
		$this->id = NULL;
		$this->naam = '';
		$this->omschrijving = '';
		$this->nbrTopcs = 0;
		$this->nbrPosts = 0;
		
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) 
        { 
            call_user_func_array(array($this,$f),$a); 
        }
	}

	public function __construct1 ($row) 
	{
		if ($row)
		{
			$this->id 			= $row['id'];
			$this->naam			= $row['cat_name'];
			$this->omschrijving	= $row['cat_description'];
			if (array_key_exists('nbrTopics', $row))
			{
				$this->nbrTopics	= $row['nbrTopics'];				
				$this->nbrPosts		= $row['nbrPosts'];
			}	
			else		
			{
				$this->nbrTopics	= 0;				
				$this->nbrPosts		= 0;
			}	
		}
		else $this->id = NULL;
	}
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
			$this->__construct1($this->readCategorieWithId($value));
			break;
			
			default:
			return FALSE;
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
			'$id				: ' . $this->id .				'<br/>' .
			'$naam				: ' . $this->naam .			'<br/>' .
			'$omschrijving		: ' . $this->omschrijving .			'<br/>' .
			'$nbrTopics		: ' . $this->nbrTopics .			'<br/>' .
			'$nbrPosts		: ' . $this->nbrPosts .			'<br/>';
	}
	protected function readCategorieWithId ($id)
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
			$sql = "SELECT * FROM categories WHERE id = :id;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $id, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (categories 2) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return $row;	
	}
	
	public function getAantalTopics () {
		$this->__construct1($this->readCategorieWithId($this->id));
		return $this->nbrTopics;
	}
	
	public function getAantalPosts () {
		$this->__construct1($this->readCategorieWithId($this->id));
		return $this->nbrPosts;
	}
	public function saveToDB () 
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT categories 
			(	id,
				cat_name		 ,
				cat_description ,
				nbrTopics ,
				nbrPosts
				)
				VALUES (
				:id,
				:naam		 ,
				:omschrijving ,
				0 ,
				0	 
				)";
			
			
				$stmt = $connection->prepare( $sql );
				$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
				$stmt->bindValue( ":naam"		, htmlentities($this->naam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
				$stmt->bindValue( ":omschrijving"		, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
				$stmt->execute();
				//			 error_log('Een nieuwe c_person is toegevoegd');
				$this->id = $connection->lastInsertId();
			}
			catch (PDOException $e) 
			{
				error_log('Connectie (categories 1) met de database mislukt: ' . $e->getMessage());
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
			$sql = "UPDATE categories SET
			cat_name		 = :naam,
			cat_description	 = :omschrijving,
			nbrTopics		  = :nbrTopics,
			nbrPosts		  = :nbrPosts
			WHERE id		 = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":naam"		, htmlentities($this->naam, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":omschrijving"		, htmlentities($this->omschrijving, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":nbrTopics"		, $this->nbrTopics, PDO::PARAM_STR);
			$stmt->bindValue( ":nbrPosts"		, $this->nbrPosts, PDO::PARAM_STR);
			$stmt->execute();
			// error_log('Categorie is bijgewerkt');
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (categories 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
	
	public function addOneTopic ()
	{
		$this->nbrTopics++;
		// error_log($this->nbrTopics);
		$this->updateToDB();
	}
	public function addOnePost ()
	{
		$this->nbrPosts++;
		$this->updateToDB();
	}
	public function getLastPost () 
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT posts.* FROM posts, topics WHERE topics.id_cat = :id AND posts.id_topic = topics.id ORDER BY posts.post_date DESC LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $this->id, PDO::PARAM_STR);
			//			echo $sql . '<br/>';
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (posts & topics) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return (new Post($row));	
	}
	
}
?>
