<?php
include_once ('c_jobgroup.php');
include_once ('c_agendaitem_coll.php');
include_once ('c_jgsessie_coll.php');

class Jobgroup_coll {
	
	protected $jobgroupColl = array();
	protected $query;
	
	
	public function __construct () {
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }

    private function __construct1 ($orderArr) {
	    /*
	    	De constructor heeft 1 array als argument:
	    	1. Een array met de volgorde waarin de collection wordt aangeboden
	    		attr 1: naam attribuut uit de DB
	    		attr 2: ASC of DESC
	    		De volgorde si op volgorde van de attributen. Dus sorteren op 1, daarbinnen op 2 enz.
	    */
	    
	    $this->buildQuery(NULL, $orderArr, NULL);
	    $this->execQuery();
	    
    }
    
    private function __construct2 ($selectArr, $orderArr) {
	    /*
	    	De constructor heeft 2 array als argument:
	    	1. Een array met selectiecriteria;
	    		elke row heeft een attribuut uit de DB en de waarde ervan waarop geslecteerd wordt.
	    		Als de array leeg is worden alle topicen geselecteerd.
	    	2. Een array met de volgorde waarin de collection wordt aangeboden
	    		attr 1: naam attribuut uit de DB
	    		attr 2: ASC of DESC
	    		De volgorde si op volgorde van de attributen. Dus sorteren op 1, daarbinnen op 2 enz.
	    */
	    
	    $this->buildQuery($selectArr, $orderArr, NULL);
	    $this->execQuery();
	    
    }
    
    private function __construct3 ($selectArr, $orderArr, $limit) {
	    /*
	    	De constructor heeft 3 attrs als argument:
	    	1. Een array met selectiecriteria;
	    		elke row heeft een attribuut uit de DB en de waarde ervan waarop geslecteerd wordt.
	    		Als de array leeg is worden alle topicen geselecteerd.
	    	2. Een array met de volgorde waarin de collection wordt aangeboden
	    		attr 1: naam attribuut uit de DB
	    		attr 2: ASC of DESC
	    		De volgorde si op volgorde van de attributen. Dus sorteren op 1, daarbinnen op 2 enz.
	    	3. het aantal te lezen topicen
	    		
	    */
	    
	    $this->buildQuery($selectArr, $orderArr, $limit);
	    $this->execQuery();
	    
    }
    public function getjobgroupColl () {
    
	    return $this->jobgroupColl;
    }
    
    private function buildQuery ($selectArr, $orderArr, $limit) {
	    
	    $this->query = 'SELECT jobgroup.* FROM jobgroup WHERE jobgroup.delind = "n"';
	    if (!empty($selectArr)) {
			$this->query .= ' AND ';
		    foreach ($selectArr as $selection) {
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
	   // error_log ( $this->query );
    }
    
	public function __get($attr)
	{
		switch ($attr) {
			
			case "query":
				if (!empty($this->query))
					return $this->$attr;
				else
					return 'Er is geen query aangemaakt. ';
				break;
			break;
			default:
				return $this->$attr;
		}
	}
	
	private function execQuery () {
		global $connection;
		try
		{
			openDB();
			$stmt = $connection->prepare( $this->query );
			$stmt->execute();
			$rows = $stmt->fetchAll();
			foreach ($rows as $row)
			{
				$jobgroup = new Jobgroup ($row);
				$this->jobgroupColl[] = $jobgroup;
			}
		} catch (PDOException $e) 
		{
			  echo 'Connectie (jobgroup 1 in c_jobgroup_coll.php) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}

	}
	
	public function jobgroupsAgenda()
	{
		/* Deze methode maakt een array met agendaItems die gebruikt wordt
			voor de agenda op de publieke website.
			input: geen 
			output: array met alle jobgroups  met status >= 200 en =< dan 699 in een agendaItem		
		*/
		$agendaitemColl = array ();
		
		$this->query = "SELECT jg.* FROM jobgroup jg
				WHERE (jg.status >= '200' AND jg.status < '500')
				AND jg.delind = 'n'
				ORDER BY jg.startdate;";
		$this->execQuery();
		foreach ($this->jobgroupColl as $jobgroup)
		{
			$item = new Agendaitem ();
			/* haal de eerste sessie van de JobGroup op (met de vroegste datum, dit is de startdatum van de jobgroup
				als er geen sessie is, blijft de strtdatum leeg */
			
			// $item->datum = substr($jobgroup['startdate'], 0, 10);
			
			$jgs = new Jgsessie_coll ();
			$jgsessie = $jgs->getFirstSession($jobgroup->id);
			
			if ($jgsessie)
			{
				$item->type = 'jbgp';
				$item->datum = $jgsessie->datetime_start;
				$item->begintijd = $jgsessie->datetime_start;
				$item->eindtijd = $jgsessie->datetime_end;
				$item->titel = $jobgroup->titel;
				$item->omschrijving = $jobgroup->omschrijving;
				if ($jobgroup->id_locatie == '---')
				{
					if ($jobgroup->onlineInd == 'n')
						$item->locatie = 'Nog niet bekend';
						else
						$item->locatie = 'online';
				}
				else
					$item->locatie = $jobgroup->id_locatie;
				
				$item->freefld1 = $jobgroup->nbrSessies();
				$item->freefld2 = $jobgroup->jgleider1;
				$item->freefld3 = 'Vragen? Email ze naar de coördinator JobGroups op <a href="mailto: coordinator@jhm-zoetermeer.nl">coordinator@jhm-zoetermeer.nl</a>.';
				$agendaitemColl[] = $item;
			} 
		}
		return $agendaitemColl;
	}
	
	
	public function sessiesAgenda()
	{
		/* Deze methode maakt een array met agendaItems die gebruikt wordt
		voor de agenda op het intranet.
		input: geen 
		output: array met alle jobgroupsessies waar de jobgroups status >= 200 en =< dan 699 hebben, in een agendaItem		
		*/

		$agendaitemColl = array ();
		
		$this->query = "SELECT jg.*, js.*, jg.titel as jgtitel, js.titel as jstitel, jg.id_locatie as jglocatie, js.id_locatie as jslocatie 
					FROM jobgroup jg INNER JOIN jgsessie js
					ON js.id_jobgroup = jg.id 
					WHERE (jg.status >= '200' AND jg.status < '500')
						AND jg.delind = 'n'
					ORDER BY js.datetime_start;";
		global $connection;
		try
		{
			openDB();
			$stmt = $connection->prepare( $this->query );
			$stmt->execute();
			$rows = $stmt->fetchAll();
			foreach ($rows as $row)
			{
				$item = new Agendaitem ();
				$item->type = 'jgse';
				$item->datum = substr($row['datetime_start'], 0, 10);
				$item->begintijd = $row['datetime_start'];
				$item->eindtijd = $row['datetime_end'];
				$item->titel = $row['jgtitel'];
				$item->omschrijving = $row['jstitel'];
				$item->omschrijving .= '<br/>Jobgroupleiders: ' . $row['jgleider1'];
				if  ($row['jgleider2'] != '')
					$item->omschrijving .= ' en ' . $row['jgleider2'];
				if ($row['jslocatie'] == '')
				{
					if ($row['onlineind'] == 'n')
						$item->locatie = $row['jglocatie'];
						else
						$item->locatie = 'online';
				}
				else
					$item->locatie = $row['jslocatie'];
				$agendaitemColl[] = $item;
			}
		} catch (PDOException $e) 
		{
			  echo 'Connectie (jobgroup 3 in c_jobgroup_coll.php) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
		return $agendaitemColl;
	}
	

}
