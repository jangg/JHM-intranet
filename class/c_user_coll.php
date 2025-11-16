<?php
include_once('c_person_coll.php');
include_once ('c_user.php');

class User_coll extends Person_coll {
	
	protected $userColl = array();	
	    
    protected function buildQuery ($selectArr, $orderArr, $limit) {
	    
	    // $this->query = 'SELECT user.* FROM user';
		// $this->query .= ' WHERE user.delind = "n"';
		$this->query = 'SELECT user.*, person.* FROM user ';
		$this->query .= 'INNER JOIN person ';
		$this->query .= 'ON user.id_person = person.person_id ';
		$this->query .= 'WHERE person.delind = "n" ';

	    if (!empty($selectArr)) {
		    foreach ($selectArr as $selection) {
			    $this->query .= ' AND ' . $selection[0] . ' = "' . $selection[1] . '" ';
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
		// echo $this->query;
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
				$user = new User ($row);
// 				echo $user;
				$this->userColl[] = $user;
			}
		} catch (PDOException $e) 
		{
			  echo 'Connectie (user 1 in c_user_coll.php) met de database mislukt: ' . $e->getMessage();
			  return FALSE;
		}
	}
	
}
