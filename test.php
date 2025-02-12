<?php
$string='<a href="https://www.w3schools.com">Go to w3schools.com</a>';
echo $string . '<br/>';
echo htmlentities($string) . '<br/>';
echo htmlentities(htmlentities($string)) . '<br/>';
echo htmlentities(htmlentities(htmlentities($string))) . '<br/>';
echo htmlspecialchars($string) . '<br/>';
echo htmlspecialchars_decode($string) . '<br/>';
echo html_entity_decode($string) . '<br/>';

?>