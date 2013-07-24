<?php
function setMainConfig(){
	define('SERVER_URI', 'http://yjq.com/yjq/index.php/');

	define('MYSQL_SERVER', 'localhost');
	define('MYSQL_DATABASE', 'yjq');
	define('MYSQL_SERVER_PORT', '3306');
	define('MYSQL_USERNAME', 'root');
	define('MYSQL_PASSWORD', 'yjq');

	define('MEMCACHE_SERVER', '192.168.3.33');
	define('MEMCACHE_PORT', '11211');
}

function getTime($refresh = false) {
	$add_time = 24*60*60*0 + 60*60*0 + 60*0;
	if ($refresh !== true && $refresh !== false) {
		return strtotime($refresh);
	}
	if (!defined('CUR_TIME') || $refresh) {
		$dba = YGetDbh();
		//sql 结果为字符串型，在js中做数学运算会出问题
		$t = (int)$dba->selectOne('select unix_timestamp()')+$add_time;
		if (!defined('CUR_TIME')) {
			define('CUR_TIME', $t);
		}
		return $t;
	}
	return CUR_TIME;
}

function loadByUrls($urls){
	if(is_string($urls)){
		$urls = array($urls);
	}
	foreach($urls as $url){
		if (is_dir($url)) {
		    if ($dh = opendir($url)) {
		        while (($file = readdir($dh)) !== false) {
		        	if(filetype($url.$file) !== 'dir'){
						require($url.$file);
		        	}
		        }
		        closedir($dh);
		    }
		}elseif(is_file($url)){
			require($url);
		}
	}
}


