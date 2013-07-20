<?php

/*
**yi框架
* @author sidneyYi
*/
define('YROOT',getcwd());
define('YDEBUG',true);

$preload_dirs = array(
	YROOT.'/config/',
	YROOT.'/components/',
	YROOT.'/model/',
);

//预加载文件
loadByUrls($preload_dirs);

//路由设置
/*
	规则
		控制器文件名必须小写+Controller结尾
		控制器类名对应其文件名，但首字母必须大写
		控制器方法名按驼峰式命名方法，可访问的方法加action前缀
*/
if(!isset($_SERVER['PATH_INFO'])){
	$_SERVER['PATH_INFO'] = '/main/main';//默认访问
}

$path = explode('/', strtolower($_SERVER['PATH_INFO']));//路径全小写处理

if(isset($path[1]) && !empty($path[1])){//防止多余/时报错
	require(YROOT.'/controller/'.$path[1].'Controller.php');
	$C_name = ucwords($path[1]).'Controller';
	$C = new $C_name;//首字母大写
}else{
	require(YROOT.'/controller/mainController.php');
	$C = new MainController;
}

if(isset($path[2]) && !empty($path[2])){
	$C->{'action'.ucwords($path[2])}();//方法首字母都要大写
}else{
	$C->actionIndex();
}



function loadByUrls($dirs){
	foreach($dirs as $dir){
		if (is_dir($dir)) {
		    if ($dh = opendir($dir)) {
		        while (($file = readdir($dh)) !== false) {
		        	if(filetype($dir.$file) !== 'dir'){
						require($dir.$file);
		        	}
		        }
		        closedir($dh);
		    }
		}
	}
}