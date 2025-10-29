<?php
// $cmd = 'php -f ../mailroom.php ' . $this->id_topic . ' ' . $connection->lastInsertId() . ' ' . $this->id_user . ' > /dev/null &';
// $cmd = 'php -f mailroom.php 19 136 1 > /dev/null &';
// exec($cmd);
$date = new DateTime();
echo $date->format('Y-m-d H:i:s');
?>