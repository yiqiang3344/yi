<?php
return array(
	'errorView'=>'/main/main',
	'reloadDirs'=>array(
		Yi::app()->baseDir.'/components',
		Yi::app()->baseDir.'/model',
		Yi::app()->baseDir.'/components/mustache',
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