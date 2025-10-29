<?php
echo 'We gaan de database eens lekker schoonmaken ;-)';

/* 	1. Lees alle werkzoekenden met delind = j
	2. delete evt. intakeform
	3. delete werkzkd record
	4. delete person record
*/

$query = 'SELECT werkzkd.id, person.id, person.achternaam FROM werkzkd INNER JOIN person ON werkzkd.id_person = person.person_id WHERE person.type = "wkz" AND person.delind = "j" ORDER BY person.achternaam;';

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


?>
