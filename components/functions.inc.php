<?php
function yDie($m=''){
	if(YDEBUG){
		errorlog($m,true,false);
	}else{
		errorlog($m);
		die($m);
	}
}

function getDbah(){
	return YDatabase::getDbah();
}

function getDbh(){
	return YDatabase::getDbh();
}

function getTime($refresh = false) {
	$add_time = 24*60*60*0 + 60*60*0 + 60*0;
	if ($refresh !== true && $refresh !== false) {
		return strtotime($refresh);
	}
	if (!defined('CUR_TIME') || $refresh) {
		$dba = getDbh();
		//sql 结果为字符串型，在js中做数学运算会出问题
		$t = (int)$dba->selectOne('select unix_timestamp()')+$add_time;
		if (!defined('CUR_TIME')) {
			define('CUR_TIME', $t);
		}
		return $t;
	}
	return CUR_TIME;
}

function errorlog($m,$print=false,$log=true) {
	$s = 'record_time:' . date('Y-m-d H:i:s', getTime()) . '\n';
	$s.='MESSAGE:' . $m . '\n';
	$s.='URL:' . $_SERVER['REQUEST_URI'] . '\n';
	$s.='GET:' . var_export($_GET, true) . '\n';
	$s.='POST:' . var_export($_POST, true) . '\n';
	$s.='COOKIE:' . var_export($_COOKIE, true) . '\n';
	$ss= '<div style="background:#ccc;font-size: 20px;margin:10px;">';
	$ss.= 'message:'.$m;
	foreach (debug_backtrace(false) as $k => $v) {
		$args = array();
		$d="#$k ".$v['function'] . '(' . implode(',', $args) . ') called at [' . $v['file'] . ':' . $v['line'] . ']';
		$ss .= '<div>'.$d.'</div>';
		$s .= $d.'\n';
	}
	$ss.='</div>';
	$s.='\n';

	if($log){
		$url = YROOT.'/data/';
		$filename = 'error_log.txt';
		if (!is_dir($url)) {
			@mkdir($url);
		}
		if ($filename) {
			@file_put_contents($url . $filename, $s, FILE_APPEND);
		}
	}

	if($print){
		echo $ss;
	}
}