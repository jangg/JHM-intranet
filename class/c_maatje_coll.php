<?php
include_once('c_person_coll.php');
include_once ('c_maatje.php');

class Maatje_coll extends Person_coll {
	
	protected $maatjeColl = array();

    protected function buildQuery ($selectArr, $orderArr, $limit) 
	{	    
	    // $this->query = 'SELECT maatje.*, person.* FROM maatje, person';
		// $this->query .= ' WHERE maatje.id_person = person.id AND person.delind = "n" ';
		$this->query = 'SELECT maatje.*, person.* FROM maatje ';
		$this->query .= 'INNER JOIN person ';
		$this->query .= 'ON maatje.id_person = person.person_id ';
		$this->query .= 'WHERE person.delind = "n" ';

	    if (!empty($selectArr)) {
		    foreach ($selectArr as $selection) {
				$this->query .= ' AND ';
			    $this->query .= $selection[0] . ' = "' . $selection[1] . '" ';
		    }
	    }
	    if (!empty($orderArr)) {
	    	$this->query .= ' ORDER BY ';
		    foreach ($orderArr as $sort) {
			    $this->query .= $sort[0] . ' ' . $sort[1];
		    }
	    }
	    
	    if ($limit != NULL)
	    {
		    $this->query .= ' LIMIT ';
		    $this->query .= $limit;
	    }
	    $this->query .= ';';
    }
    
	protected function execQuery () 
	{
		global $connection;
		try
		{
			openDB();
			$stmt = $connection->prepare( $this->query );
			$stmt->execute();
			$rows = $stmt->fetchAll();
			foreach ($rows as $row)
			{
				$maatje = new Maatje ($row);
// 				echo $maatje;
				$this->maatjeColl[] = $maatje;
				// print_r ($maatje . '<br/>');
			}
		} catch (PDOException $e) 
		{
			  error_log('Connectie (person 1 in c_person_coll.php) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
	}
}
