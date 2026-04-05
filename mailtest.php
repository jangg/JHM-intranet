<?php
include_once 'config.php';
try {
	echo __DIR__ . '<br/>';
	Tools::MailRoom('Klaas de Wilde', 'jangg@mac.com', 'Welkom!', '<b>De melding komt van <a href="https://jobhulpmaatjezoetermeer.nl">JobHulpMaatje Zoetermeer</a>!</b>');
	echo "✅ Mail verzonden!";
} catch (Exception $e) {
	echo "❌ Fout bij verzenden: " . $e->getMessage();
}
?>