<?php
include_once('c_person_coll.php');
include_once ('c_maatje.php');
include_once ('c_agendaitem_coll.php');
include_once ('c_werkzoekende_coll.php');

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
	
	public function verjaardagenAgenda ()
	{
		$agendaitemColl = array ();
		$date = new DateTime();
		$todate = $date->format('-m-d');
		$todate = $date->format('-m-d');
		foreach ($this->maatjeColl as $maatje)
		{
			// error_log(substr($maatje->date_geboorte, 4,6) . "\n");
			$item = new Agendaitem ();
			if ($maatje->date_geboorte != '')
			{
				if (substr($maatje->date_geboorte, 4,6) < $todate)
					$item->datum = '2026' . substr($maatje->date_geboorte, 4,6);
					// $item->datum = strval($date->format('-m-d') + 1) . substr($maatje->date_geboorte, 4,6);
				else
					$item->datum = '2025' . substr($maatje->date_geboorte, 4,6);
				$item->titel = '<p style="color: #8d2e34"><img src="img_fixed/party-popper_1f389.png" width="10%"/>' . $maatje->voornaam . ' ' . $maatje->tussenvoegsels . ' ' . $maatje->achternaam . ' is jarig vandaag. Hoera!';
				$item->titel .= '<img src="img_fixed/fireworks_1f386.png" width="10%"/></p>';
				$item->begintijd = '';
				$item->eindtijd = '';
				$agendaitemColl[] = $item;
			}
		}
		return $agendaitemColl;
	}
	
	public function maatjesList ()
	{
		/* 
		actief_als:
			A = Als maatjes
			B = als jobgroupleider
			K = als zowel A als B
		*/
		$mtjList = array ();
		$mtj = array();
		foreach ($this->maatjeColl as $maatje)
		{
			/* zoek iedereen die maatje is */
			if ($maatje->mtjcrt_ind == 'j')
			{
				if ($maatje->actief_als == 'A' || $maatje->actief_als == 'K')
				{
					$mtj[0] = $maatje->id;
					$mtj[1] = $maatje->voornaam . ' ' . $maatje->tussenvoegsels . ' ' . $maatje->achternaam;
					$mtjList[] = $mtj;
				}
			}
		}
		return $mtjList;
	}
	
	public function jarigeMaatjes ()
	{
		$maatjesColl = array ();
		$date = new DateTime();
		$todate = $date->format('-m-d');
		foreach ($this->maatjeColl as $maatje)
		{
			// error_log(substr($maatje->date_geboorte, 4,6) . "\n");
			if ($maatje->date_geboorte != '')
			{
				if (substr($maatje->date_geboorte, 4,6) == $todate)
					$maatjesColl[] = $maatje;
			}
		}
		return $maatjesColl;
	}
}
