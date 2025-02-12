<?php
include_once ('c_post.php');
class Topic
{
	protected $id;
	protected $onderwerp;
	protected $datum;
	protected $id_cat;
	protected $id_user;
	protected $nbrPosts;
	
	public function __construct() 
	{
		$this->id = NULL;
		$this->onderwerp = '';
		$this->datum = '';
		$this->id_cat = NULL;
		$this->id_user = NULL;
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
			$this->id 				= $row['id'];
			$this->onderwerp		= html_entity_decode($row['topic_subject']);
			$this->datum			= $row['topic_date'];
			$this->id_cat			= $row['id_cat'];
			$this->id_user			= $row['id_user'];
			$this->nbrPosts			= $row['nbrPosts'];
		} else $this->id = NULL;
	}
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
			$this->__construct1($this->readTopicWithId($value));
			break;
			
			default:
			return FALSE;
		}
		
	}
	public function __destruct ()
	{
	}
	protected function readTopicWithId ($id)
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
			$sql = "SELECT * FROM topics WHERE id = :id LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $id, PDO::PARAM_STR);
			//			echo $sql . '<br/>';
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (topics 2) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return $row;	
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
			'$onderwerp	: ' . $this->onderwerp .	'<br/>' .
			'$datum		: ' . $this->datum .		'<br/>' .
			'$cat_id	: ' . $this->id_cat .		'<br/>' .
			'$user_id	: ' . $this->id_user .		'<br/>' .
			'$nbrPosts	: ' . $this->nbrPosts .		'<br/>';
	}
	public function getLastPost () 
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM posts WHERE id_topic = :id ORDER BY post_date DESC LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $this->id, PDO::PARAM_STR);
			//			echo $sql . '<br/>';
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (posts 2) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return (new Post($row));	
	}

	public function getAantalPosts () 
	{
		$this->__construct1($this->readTopicWithId($this->id));
		return $this->nbrPosts;
	}
	public function addOnePost ()
	{
		$this->nbrPosts++;
		$this->updateToDB();
	}
	
	public function saveToDB () 
	{
		global $connection;
		try
		{			
			openDB();
			$sql = "INSERT topics 
			(	id,
				topic_subject		 ,
				topic_date ,
				id_cat ,
				id_user ,
				nbrPosts
			)
			VALUES (
				:id,
				:onderwerp		 ,
				NOW() ,
				:id_cat ,
				:id_user ,
				:nbrPosts	 
			)";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":onderwerp"	, htmlentities($this->onderwerp, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":id_cat"		, $this->id_cat, PDO::PARAM_STR);
			$stmt->bindValue( ":id_user"		, $this->id_user, PDO::PARAM_STR);
			$stmt->bindValue( ":nbrPosts"		, $this->nbrPosts, PDO::PARAM_STR);
			$stmt->execute();
			// error_log('Een nieuwe c_topic is toegevoegd');
			// error_log($sql);
			$this->id = $connection->lastInsertId();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (topics 1) met de database mislukt: ' . $e->getMessage());
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
			$sql = "UPDATE topics SET
			topic_subject		 = :onderwerp ,
			topic_date	 = :datum,
			id_cat		  = :id_cat,
			id_user		  = :id_user,
			nbrPosts		  = :nbrPosts 
			WHERE id		 = :id";
			
			// error_log($sql);
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":onderwerp"	, htmlentities($this->onderwerp, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":datum"			, $this->datum,  PDO::PARAM_STR);
			$stmt->bindValue( ":id_cat"		, $this->id_cat,  PDO::PARAM_STR);
			$stmt->bindValue( ":id_user"		, $this->id_user,  PDO::PARAM_STR);
			$stmt->bindValue( ":nbrPosts"		, $this->nbrPosts,  PDO::PARAM_STR);
			$stmt->execute();
			
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (categories 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}
	
}
?>
