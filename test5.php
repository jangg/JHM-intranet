<?php
/* Dit is een test */
require_once __DIR__ . '/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/Exception.php';
include_once(__DIR__ . '/config.php');
include_once __DIR__ . '/class/c_maatje_coll.php';

echo Tools::getShortPost('Dit is een test', 2);
?>