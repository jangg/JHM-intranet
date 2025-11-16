<?php
include_once('c_person_coll.php');
include_once ('c_werkzoekende.php');

class Werkzoekende_coll extends Person_coll {
	
	protected $werkzoekendeColl = array();
 
    protected function buildQuery ($selectArr, $orderArr, $limit) 
	{
	    // $this->query = 'SELECT werkzkd.*, person.* FROM werkzkd, person';
		// $this->query .= ' WHERE werkzkd.id_person = person.id AND person.delind = "n" ';
		$this->query = 'SELECT werkzkd.*, person.* FROM werkzkd ';
		$this->query .= 'INNER JOIN person ';
		$this->query .= 'ON werkzkd.id_person = person.person_id ';
		$this->query .= 'WHERE person.type = "wkz" AND person.delind = "n" ';

	    if (!empty($selectArr)) {
		    foreach ($selectArr as $selection) {
				$this->query .= ' AND ';
			   $this->query .= $selection[0];
				if ($selection[1] == 'NULL')
					$this->query .= ' IS NULL';
					else
					$this->query .= ' = "' . $selection[1] . '"';
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
 	    // error_log ($this->query);
    }
	
	protected function buildQueryAll () 
	{
		$this->query = 'SELECT werkzkd.*, person.* FROM werkzkd ';
		$this->query .= 'INNER JOIN person ';
		$this->query .= 'ON werkzkd.id_person = person.person_id ';
		$this->query .= 'WHERE person.type = "wkz" ORDER BY werkzkd.id;';
	}
    
	protected function execQuery () {
		global $connection;
		try
		{
			openDB();
			$stmt = $connection->prepare( $this->query );
			$stmt->execute();
			$rows = $stmt->fetchAll();
			foreach ($rows as $row)
			{
				$werkzoekende = new Werkzoekende ($row);
 			    // print_r ($row);
				// print_r ($werkzoekende . '<br/>');
				$this->werkzoekendeColl[] = $werkzoekende;
			}
		} catch (PDOException $e) 
		{
			  error_log('Connectie (person 1 in c_werkzoekende_coll.php) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}

	}
	
	public function getAllWerkzoekenden()
	{
		$this->buildQueryAll();
		$this->execQuery();
		return TRUE;
	}
	
		
	public function wkzList ($mtj)
	{
		/* 
		geeft lijst met wkz behorend bij maatje
		*/
		$wkzList = array ();
		foreach ($this->werkzoekendeColl as $wkz)
		{
			/* zoek iedereen die maatje is */
			if ($wkz->id_maatje == $mtj)
			{
				$wkzList[] = $wkz;
			}
		}
		return $wkzList;
	}
	
	public function jarigeWkzs ()
	{
		$wkzColl = array ();
		$date = new DateTime();
		$todate = $date->format('-m-d');
		foreach ($this->werkzoekendeColl as $werkzoekende)
		{
			if ($werkzoekende->date_uitstroom == '')
			{
				if ($werkzoekende->date_geboorte != '')
				{
					if (substr($werkzoekende->date_geboorte, 4,6) == $todate)
						$wkzColl[] = $werkzoekende;
				}
			}
		}
		return $wkzColl;
	}
}
