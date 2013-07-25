<?php
/*
**yi框架
* @author sidneyYi
*/
define('YROOT',dirname(__FILE__));
defined('YDEBUG') or define('YDEBUG',true);


require_once(YROOT.'/yibase.php');
Yi::app()->baseDir = getcwd();
Yi::app()->serverUri = $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];

//自定义错误处理
set_error_handler('YError::errorHandle');
set_exception_handler('YError::exceptionHandle');

//预加载文件
Yi::app()->config = YConfig::get('main','reloadDirs');
Yi::app()->config[] = YROOT; 
AutoLoader::register(Yi::app()->config);

//路由设置
/*
	规则
		控制器文件名必须小写+Controller结尾
		控制器类名对应其文件名，但首字母必须大写
		控制器方法名按驼峰式命名方法，可访问的方法加action前缀
*/

//路由

if(!isset($_SERVER['PATH_INFO'])){
	YError::gotoView();
}

$path = explode('/', strtolower($_SERVER['PATH_INFO']));//路径全小写处理

if(isset($path[1]) && !empty($path[1])){//防止多余/时报错
	require(Yi::app()->baseDir.'/controller/'.$path[1].'Controller.php');
	$C_name = ucwords($path[1]).'Controller';
	$C = new $C_name;//首字母大写
}else{
	YError::gotoView();
}

if(isset($path[2]) && !empty($path[2])){
	$C->{'action'.ucwords($path[2])}();//方法首字母都要大写
}else{
	YError::gotoView('/main/index');
}