<?php
/* Namespace alias. */
include_once 'c_user.php';
class Post
{
	protected $id;
	protected $tekst;
	protected $datum;
	protected $id_topic;
	protected $id_user;
	
	public function __construct() 
	{
		$this->id = NULL;
		$this->tekst = '';
		$this->datum = '';
		$this->id_topic = NULL;
		$this->id_user = NULL;
		
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) 
        { 
            call_user_func_array(array($this,$f),$a); 
        }
	}
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
			$this->__construct1($this->readPostWithId($value));
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
			$this->tekst		= html_entity_decode($row['post_content']);
			$this->datum		= $row['post_date'];
			$this->id_topic		= $row['id_topic'];
			$this->id_user		= $row['id_user'];
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
			'$tekst		: ' . html_entity_decode($this->tekst) .	'<br/>' .
			'$datum		: ' . $this->datum .		'<br/>' .
			'$id_topic	: ' . $this->id_topic .		'<br/>' .
			'$id_user	: ' . $this->id_user .		'<br/>';
	}
	protected function readPostWithId ($id)
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
			$sql = "SELECT * FROM posts WHERE id = :id;";
			
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
			$sql = "INSERT posts 
			(	id,
				post_content		 ,
				post_date ,
				id_topic ,
				id_user
			)
			VALUES (
				:id,
				:tekst		 ,
				NOW() ,
				:id_topic ,
				:id_user
			)";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
 			$stmt->bindValue( ":tekst"			, htmlentities($this->tekst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			// $stmt->bindValue( ":tekst"			, 'php -f mailroom.php ' . $this->id_topic . ' ' . $connection->lastInsertId() . ' ' . $this->id_user . ' > /dev/null &', PDO::PARAM_STR);
			$stmt->bindValue( ":id_topic"		, $this->id_topic, PDO::PARAM_STR);
			$stmt->bindValue( ":id_user"		, $this->id_user, PDO::PARAM_STR);
			$stmt->execute();
			$this->id = $connection->lastInsertId();
			// error_log($this->id);
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (posts 1) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		/* Bij iedere post die wordt toegevoegd krijgen deelnemers een email 
		Om die reden wordt mailroom.php aangeroepen die parallel alle emails gaat versturen.
		Parameters zijn:
		1 = topic_id
		2 = post_id
		3 = user_id van de poster
		*/
		$cmd = 'php -f ../mailroom.php ' . $this->id_topic . ' ' . $connection->lastInsertId() . ' ' . $this->id_user . ' > /dev/null &';
		exec($cmd);
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
			$sql = "UPDATE posts SET
			post_content		 = :tekst,
			post_date		  = :datumnw,
			id_topic	= :id_topic,
			id_user		= :id_user
			WHERE id		 = :id";
			
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $this->id, PDO::PARAM_STR);
			$stmt->bindValue( ":tekst"			, htmlentities($this->tekst, ENT_QUOTES, 'UTF-8'), PDO::PARAM_STR);
			$stmt->bindValue( ":datumnw"		, $this->datum, PDO::PARAM_STR);
			$stmt->bindValue( ":id_topic"		, $this->id_topic, PDO::PARAM_STR);
			$stmt->bindValue( ":id_user"		, $this->id_user, PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (posts 5) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		return TRUE;	
	}

	public function getShortPost($wordsreturned)
	/*  Returns the first $wordsreturned out of $string.  If string
	contains more words than $wordsreturned, the entire string
	is returned.*/
	{
		$array = explode(" ", $this->tekst);
		/*  Already short enough, return the whole thing*/
		if (count($array) <= $wordsreturned)
		{
			$retval = $this->tekst;
		}
		/*  Need to chop of some words*/
		else
		{
			array_splice($array, $wordsreturned);
			$retval = implode(" ", $array) . " .....";
		}
		return $retval;
	}
	
	public static function getMostRecentPost()
	{
		/*
		Wat is nodig:
		1. Tekst van Post
		2. Titel van Topic
		3. Titel van Categorie
		4. ID van post.
		SELECT posts.id, posts.post_content, posts.post_date, topics.topic_subject, categories.cat_name FROM posts, topics, categories WHERE posts.id_topic = topics.id AND topics.id_cat = categories.id AND topics.id <> 19 ORDER BY posts.id DESC LIMIT 1;
		*/
		$sql = "SELECT 	posts.id,
						posts.id_user,
						posts.id_topic, 
						posts.post_content, 
						posts.post_date, 
						topics.topic_subject,
						categories.cat_name 
						FROM posts, topics, categories 
						WHERE posts.id_topic = topics.id AND topics.id_cat = categories.id AND topics.id <> 19 
						ORDER BY posts.id DESC 
						LIMIT 1;";
		global $connection;
		try
		{
			openDB();
			$stmt = $connection->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch();
		}
		catch (PDOException $e) 
		{
			error_log('Connectie (posts 6) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}

		return $result;
	}

}
?>
