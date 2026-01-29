<?php
// config/config.php
return [
	'db' => [
		// Zet dit via env of vul hier in:
		// mysql:host=localhost;dbname=YOUR_DB;charset=utf8mb4
		'dsn'  => getenv('DB_DSN')  ?: 'mysql:host=localhost;port=8889;dbname=intraDB;charset=utf8mb4',
		'user' => getenv('DB_USER') ?: 'root',
		'pass' => getenv('DB_PASS') ?: 'root',
		'options' => [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		],
	],
	'log_file'  => 'cleanup_werkzkd.log',
	'lock_file' => sys_get_temp_dir() . '/cleanup_werkzkd.lock',

	// 'log_file'  => __DIR__ . '/../logs/cleanup_werkzkd.log',
	// 'lock_file' => sys_get_temp_dir() . '/cleanup_werkzkd.lock',
];
