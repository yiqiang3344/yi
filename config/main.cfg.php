<?php
return array(
	'errorview'=>'/main/main',
	'reloadDirs'=>array(
		YROOT.'/components/',
		YROOT.'/model/',
	),
	'db'=>array(
		'connectionString' => 'mysql:host=' . MYSQL_SERVER . ';port=' . MYSQL_SERVER_PORT . ';charset=utf8;',
		'dbname' => MYSQL_DATABASE,
		'username' => MYSQL_USERNAME,
		'password' => MYSQL_PASSWORD,
	),
	'cache'=>array(
		'server' => MEMCACHE_SERVER,
		'port' => MEMCACHE_PORT,
	),
);