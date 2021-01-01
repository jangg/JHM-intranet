<?php
include_once ('c_comment.php');

class Comment_coll {
	
	/* $nbrComms bevat het aantal comments in het collection object */
	protected $commentColl = array();
	protected $query;
	
	
	public function __construct () {
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }

    private function __construct2 ($selectArr, $orderArr) {
	    /*
	    	De constructor heeft 2 arrays als argument:
	    	1. Een array met selectiecriteria;
	    		elke row heeft een attribuut uit de DB en de waarde ervan waarop geslecteerd wordt.
	    		Als de array leeg is worden alle commenten geselecteerd.
	    	2. Een array met de volgorde waarin de collection wordt aangeboden
	    		attr 1: naam attribuut uit de DB
	    		attr 2: ASC of DESC
	    		De volgorde is op volgorde van de attributen. Dus sorteren op 1, daarbinnen op 2 enz.
	    */
	    
	    $this->buildQuery($selectArr, $orderArr, NULL);
	    $this->execQuery();
	    
    }
    
    private function __construct3 ($selectArr, $orderArr, $limit) {
	    /*
	    	De constructor heeft 3 attrs als argument:
	    	1. Een array met selectiecriteria;
	    		elke row heeft een attribuut uit de DB en de waarde ervan waarop geslecteerd wordt.
	    		Als de array leeg is worden alle commenten geselecteerd.
	    	2. Een array met de volgorde waarin de collection wordt aangeboden
	    		attr 1: naam attribuut uit de DB
	    		attr 2: ASC of DESC
	    		De volgorde si op volgorde van de attributen. Dus sorteren op 1, daarbinnen op 2 enz.
	    	3. het aantal te lezen commenten
	    		
	    */
	    
	    $this->buildQuery($selectArr, $orderArr, $limit);
	    $this->execQuery();
	    
    }
    public function getCommentColl () {
    
	    return $this->commentColl;
    }
    
    private function buildQuery ($selectArr, $orderArr, $limit) {
	    
	    $this->query = 'SELECT comment.* FROM comment WHERE comment.delind = "n"';
// 		$this->query .= ' WHERE comment.user_id = comm_user.id AND comm_comment.deleted = FALSE AND comm_comment.visible = TRUE AND comm_user.approved = TRUE ';
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
// 	    echo $this->query;
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
			$this->nbrComms = 0;
			foreach ($rows as $row)
			{
				$this->nbrComms++;
				$comment = new Comment ($row);
//				echo $comment;
				$this->commentColl[] = $comment;
			}
		} catch (PDOException $e) 
		{
			  echo 'Connectie (comment 1 in c_comment_coll.php) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}

	}
	
	static public function getNbrComms($aanvraagid)
	{
		global $connection;
		try
		{
			openDB();
			$query = 'SELECT COUNT(*) FROM comment WHERE comment.delind = "n" AND comment.id_aanvraag = ' . $aanvraagid . ';';
			$stmt = $connection->prepare( $query );
			$number = $stmt->execute();
			return $stmt->fetchColumn();
		} catch (PDOException $e) 
		{
			  echo 'Connectie (comment 2 in c_comment_coll.php) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	}
}
