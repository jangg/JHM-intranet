<?php
include_once ('c_jgsessie.php');

class Jgsessie_coll {
	
	protected $jgsessieColl = array();
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
    public function getjgsessieColl () {
    
	    return $this->jgsessieColl;
    }
    
    private function buildQuery ($selectArr, $orderArr, $limit) {
	    
	    $this->query = 'SELECT jgsessie.* FROM jgsessie';
	    if (!empty($selectArr)) {
			$this->query .= ' WHERE ';
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
//	    error_log ( $this->query );
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
				$jgsessie = new Jgsessie ($row);
				$this->jgsessieColl[] = $jgsessie;
			}
		} catch (PDOException $e) 
		{
			  echo 'Connectie (jgsessie 1 in c_jgsessie_coll.php) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}

	}
	
	public function getFirstSession ($id_jobgroup)
	{
		$arr1 = array (	array (0 => 'id_jobgroup', 1 => $id_jobgroup));
		$arr2 = array (	array (0 => 'datetime_start', 1 => 'ASC'));
		
		$this->buildQuery ($arr1, $arr2, 1);
		$this->execQuery ();
		if ($this->jgsessieColl)
			return $this->jgsessieColl[0];
			else
			return FALSE;
	}
}
