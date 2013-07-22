<?php
function yDie($m=''){
	if(YDEBUG){
		throw new Exception($m);
	}else{
		die($m);
	}
}

function get_dbah(){
	return YDatabase::get_dbah();
}

function get_dbh(){
	return YDatabase::get_dbh();
}

function getTime($refresh = false) {
	$add_time = 24*60*60*0 + 60*60*0 + 60*0;
	if ($refresh !== true && $refresh !== false) {
		return strtotime($refresh);
	}
	if (!defined("CUR_TIME") || $refresh) {
		$dba = get_dbh();
		//sql 结果为字符串型，在js中做数学运算会出问题
		$t = (int)$dba->select_one("select unix_timestamp()")+$add_time;
		if (!defined("CUR_TIME")) {
			define("CUR_TIME", $t);
		}
		return $t;
	}
	return CUR_TIME;
}