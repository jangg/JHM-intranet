<?php
include_once('c_person.php');
class Maatje extends Person 
{
	protected $id;
	protected $id_person;
	protected $omschrijving;
	protected $functie;
	
	public function __construct () 
	{
		$this->id				= NULL;
		$this->id_person		= NULL;
		$this->omschrijving		= '';
		$this->functie		= '';
		parent::__construct ();	
	
		$a = func_get_args(); 
		$i = func_num_args(); 
		if (method_exists($this,$f='__construct'.$i)) { 
			call_user_func_array(array($this,$f),$a);
		}
	}
	
	public function __construct1 ($maatjerow) 
	{
		if ($maatjerow)
		{
			$this->id			  = $maatjerow['id'];
			$this->id_person	  = $maatjerow['id_person'];
			$this->omschrijving	  = $maatjerow['omschrijving'];
			$this->functie		  = $maatjerow['functie'];
			parent::__construct1 ($maatjerow);
		}
		else
		{
			$this->id			  = '';
			$this->id_person	  = '';
			$this->omschrijving	  = '';
			$this->functie		  = '';
			parent::__construct1 ($maatjerow);			
		}
	}
	
	public function __construct2 ($attr, $value)
	{
		/* id, gebruikersnaam of emailadres is bekend, haal op uit DB */
		switch ($attr)
		{
			case 'id':
				$this->__construct1($this->readMaatjeWithId($value));
				break;
			case 'emailadres':
				$this->__construct1($this->readMaatjeWithEmailadres($value));
				break;				
			default:
				return FALSE;
		}
		
	}	
		
	public function __toString()
	{
		/* hier printen we het object mee uit, voor testdoeleinden */
		print_r (parent::__toString());
		return 
			'$id				: ' . $this->id	. '<br/>' .
			'$id_person			: ' . $this->id_person		. '<br/>' .
			'$omschrijving		: ' . $this->omschrijving		. '<br/>' .
			'$functie			: ' . $this->functie		. '<br/>';
	}
	
	public function readMaatjeWithId ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT maatje.*, person.* FROM maatje JOIN person ON maatje.id_person = person.person_id WHERE maatje.id = :id AND person.delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$maatjerow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (maatje 2) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return $maatjerow;	
	}
	
		
	public function readMaatjeWithEmailadres ($attr)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT maatje.*, person.* FROM maatje JOIN person ON maatje.id_person = person.person_id WHERE person.emailadres = :emailadres AND person.delind = 'n' LIMIT 1;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":emailadres", $attr, PDO::PARAM_STR);
	//			echo $sql . '<br/>';
			$stmt->execute();
			$maatjerow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (maatje 3) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return $maatjerow;	
	}
	

}

?>