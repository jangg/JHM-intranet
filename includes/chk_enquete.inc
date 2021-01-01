<?php
function updateEnqueteForm ($id, $person, $antwoorden)
{
	global $connection;
		try
		{			
			openDB();
			$sql = "UPDATE enquete SET
						id_enquete = :id_enquete 		,
						id_person = :id_person ,
						timestamp  = NOW() ,
						vrg01 = :vraag01 	,
						vrg02 = :vraag02 	,
						vrg03 = :vraag03	 ,
						vrg04 = :vraag04 ,
						vrg05 = :vraag05 

						WHERE id = :id";
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, $id, PDO::PARAM_STR);
			$stmt->bindValue( ":id_enquete"		, '1', PDO::PARAM_STR);
			$stmt->bindValue( ":id_person"		, $person, PDO::PARAM_STR);
			$stmt->bindValue( ":vraag01"		, $antwoorden[0], PDO::PARAM_STR);
			$stmt->bindValue( ":vraag02"		, $antwoorden[1], PDO::PARAM_STR);
			$stmt->bindValue( ":vraag03"		, $antwoorden[2], PDO::PARAM_STR);
			$stmt->bindValue( ":vraag04"		, $antwoorden[3], PDO::PARAM_STR);
			$stmt->bindValue( ":vraag05"		, $antwoorden[4], PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (enquete 2) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return TRUE;		
}

function saveEnqueteForm ($person, $antwoorden)
{
	global $connection;
		try
		{			
			openDB();
			$sql = "INSERT enquete 
					(	id,
						id_enquete 		,
						id_person ,
						timestamp ,
						vrg01 	,
						vrg02 	,
						vrg03	 ,
						vrg04 ,
						vrg05
					)
					VALUES (
						:id,
						:id_enquete 		,
						:id_person ,
						NOW() ,
						:vraag01 	,
						:vraag02 	,
						:vraag03	 ,
						:vraag04 ,
						:vraag05
					)";
						
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id"				, NULL, PDO::PARAM_STR);
			$stmt->bindValue( ":id_enquete"		, '1', PDO::PARAM_STR);
			$stmt->bindValue( ":id_person"		, $person, PDO::PARAM_STR);
			$stmt->bindValue( ":vraag01"		, $antwoorden[0], PDO::PARAM_STR);
			$stmt->bindValue( ":vraag02"		, $antwoorden[1], PDO::PARAM_STR);
			$stmt->bindValue( ":vraag03"		, $antwoorden[2], PDO::PARAM_STR);
			$stmt->bindValue( ":vraag04"		, $antwoorden[3], PDO::PARAM_STR);
			$stmt->bindValue( ":vraag05"		, $antwoorden[4], PDO::PARAM_STR);
			$stmt->execute();
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (enquete 1) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		return TRUE;	
	
}

/* Nog geen check gedaan, ga ervan uit dat alles fout is */
$error = 0x0000;
$enquete_ready = FALSE;

if (isset($_POST['verstuurBut']) && $_POST['verstuurBut'] == 'verstuur')
{
	$_POST['verstuurBut'] = 'verstuurniet';
	$antwoorden = array();
	$sumVr01 = 0;
	if (isset($_POST['vr01a'])) $sumVr01 = $sumVr01 + 1;
	if (isset($_POST['vr01b'])) $sumVr01 = $sumVr01 + 2;
	if (isset($_POST['vr01c'])) $sumVr01 = $sumVr01 + 4;
	if (isset($_POST['vr01d'])) $sumVr01 = $sumVr01 + 8;
	if (isset($_POST['vr01e'])) $sumVr01 = $sumVr01 + 16;
	if (isset($_POST['vr01f'])) $sumVr01 = $sumVr01 + 32;
	// echo 'Sum 1 = ' . $sumVr01 . '<br/>';
	if ($sumVr01 == 0)
		$error = $error | 0x0001;
	$antwoorden[0] = $sumVr01;

	$sumVr02 = 0;
	if (isset($_POST['vr02a'])) $sumVr02 = $sumVr02 + 1;
	if (isset($_POST['vr02b'])) $sumVr02 = $sumVr02 + 2;
	if (isset($_POST['vr02c'])) $sumVr02 = $sumVr02 + 4;
	if (isset($_POST['vr02d'])) $sumVr02 = $sumVr02 + 8;
	if (isset($_POST['vr02e'])) $sumVr02 = $sumVr02 + 16;
	if (isset($_POST['vr02f'])) $sumVr02 = $sumVr02 + 32;
	// echo 'Sum 2 = ' . $sumVr02 . '<br/>';
	if ($sumVr02 == 0)
		$error = $error | 0x0002;
	$antwoorden[1] = $sumVr02;

	$sumVr03 = 0;
	
	// echo $_POST['vr03a'];
	if (isset($_POST['vr03a'])) $sumVr03 = $sumVr03 + 1;
	if (isset($_POST['vr03b'])) $sumVr03 = $sumVr03 + 2;
	if (isset($_POST['vr03c'])) $sumVr03 = $sumVr03 + 4;
	if (isset($_POST['vr03d'])) $sumVr03 = $sumVr03 + 8;
	if (isset($_POST['vr03e'])) $sumVr03 = $sumVr03 + 16;
	if (isset($_POST['vr03f'])) $sumVr03 = $sumVr03 + 32;
	if (isset($_POST['vr03g'])) $sumVr03 = $sumVr03 + 64;
	if (isset($_POST['vr03h'])) $sumVr03 = $sumVr03 + 128;
	if (isset($_POST['vr03i'])) $sumVr03 = $sumVr03 + 256;
	if (isset($_POST['vr03j'])) $sumVr03 = $sumVr03 + 512;

	// echo 'Sum 3 = ' . $sumVr03;
	if ($sumVr03 != 1023)
		$error = $error | 0x0004;
	$sumVr03  = 0;
	if (isset($_POST['vr03a']) && $_POST['vr03a'] == 'ja') $sumVr03 = $sumVr03 + 1;
	if (isset($_POST['vr03b']) && $_POST['vr03b'] == 'ja') $sumVr03 = $sumVr03 + 2;
	if (isset($_POST['vr03c']) && $_POST['vr03c'] == 'ja') $sumVr03 = $sumVr03 + 4;
	if (isset($_POST['vr03d']) && $_POST['vr03d'] == 'ja') $sumVr03 = $sumVr03 + 8;
	if (isset($_POST['vr03e']) && $_POST['vr03e'] == 'ja') $sumVr03 = $sumVr03 + 16;
	if (isset($_POST['vr03f']) && $_POST['vr03f'] == 'ja') $sumVr03 = $sumVr03 + 32;
	if (isset($_POST['vr03g']) && $_POST['vr03g'] == 'ja') $sumVr03 = $sumVr03 + 64;
	if (isset($_POST['vr03h']) && $_POST['vr03h'] == 'ja') $sumVr03 = $sumVr03 + 128;
	if (isset($_POST['vr03i']) && $_POST['vr03i'] == 'ja') $sumVr03 = $sumVr03 + 256;
	if (isset($_POST['vr03j']) && $_POST['vr03j'] == 'ja') $sumVr03 = $sumVr03 + 512;

							
	$antwoorden[2] = $sumVr03;
	$antwoorden[3] = $_POST['vr04'];
	$antwoorden[4] = $_POST['vr05'];
	
	if ($error == 0x0000)
	{
		global $connection;
		try
		{
			openDB();
			$sql = "SELECT * FROM enquete WHERE id_person = :id_person;";
			
			$stmt = $connection->prepare( $sql );
			$stmt->bindValue( ":id_person", $curr_user->id_person, PDO::PARAM_STR);
			$stmt->execute();
			$enqueterow = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e) 
		{
			  error_log('Connectie (enquete 2) met de database mislukt: ' . $e->getMessage());
			  return FALSE;
		}
		if (!$enqueterow)
			saveEnqueteForm($curr_user->id_person, $antwoorden);
			else
			updateEnqueteForm($enqueterow['id'], $curr_user->id_person, $antwoorden);
		$enquete_ready = TRUE;	
	}
}