<?php
include_once('config.php');

for ($team = 1; $team < 6; $team++) {
	try {
			openDB();
			$sql = "SELECT * FROM pubquizteams WHERE id = :id;";
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id", $team, PDO::PARAM_STR);
			$stmt->execute();
			$teamrec = $stmt->fetch(PDO::FETCH_ASSOC);
			
			
		} catch (PDOException $e) 
		{
			error_log('Connectie (score 1) met de database mislukt: ' . $e->getMessage());
			return FALSE;
		}
		
		$score = 0;
		if ($teamrec['vr01'] == 'B') $score++;
		if ($teamrec['vr02'] == 'C') $score++;
		if ($teamrec['vr03'] == 'B') $score++;
		if ($teamrec['vr04'] == 'A') $score++;
		if ($teamrec['vr05'] == 'B') $score++;
		if ($teamrec['vr06'] == 'A') $score++;
		if ($teamrec['vr07'] == 'B') $score++;
		if ($teamrec['vr08'] == 'A') $score++;
		if ($teamrec['vr09'] == 'C') $score++;
		if ($teamrec['vr10'] == 'C') $score++;
		if ($teamrec['vr11'] == 'B') $score++;
		if ($teamrec['vr12'] == 'C') $score++;
		if ($teamrec['vr13'] == 'A') $score++;
		if ($teamrec['vr14'] == 'C') $score++;
		if ($teamrec['vr15'] == 'B') $score++;
		if ($teamrec['vr16'] == 'A') $score++;
		if ($teamrec['vr17'] == 'B') $score++;
		if ($teamrec['vr18'] == 'B') $score++;
		if ($teamrec['vr19'] == 'D') $score++;
		if ($teamrec['vr20'] == 'B') $score++;
			
		echo '<p style="font-size: 2em;">De score van team "' . $teamrec['teamnaam'] .'" is ' . $score . ' goede antwoorden.<br/>';
}



?>