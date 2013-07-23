<?php

/*
**yi框架
* @author sidneyYi
*/
define('YROOT',getcwd());
define('YDEBUG',true);

$preload_list = array(
	YROOT.'/config/',
	YROOT.'/components/',
	YROOT.'/model/',
	YROOT.'/widget/mustache/Autoloader.php'
);

//预加载文件
loadByUrls($preload_list);

//路由设置
/*
	规则
		控制器文件名必须小写+Controller结尾
		控制器类名对应其文件名，但首字母必须大写
		控制器方法名按驼峰式命名方法，可访问的方法加action前缀
*/
if(!isset($_SERVER['PATH_INFO'])){
	errorView();
}

$path = explode('/', strtolower($_SERVER['PATH_INFO']));//路径全小写处理

if(isset($path[1]) && !empty($path[1])){//防止多余/时报错
	require(YROOT.'/controller/'.$path[1].'Controller.php');
	$C_name = ucwords($path[1]).'Controller';
	$C = new $C_name;//首字母大写
}else{
	errorView();
}

if(isset($path[2]) && !empty($path[2])){
	$C->{'action'.ucwords($path[2])}();//方法首字母都要大写
}else{
	errorView('main/index');
}

function errorView($url='main/main'){
	header('Location: '.SERVER_URI.$url); //默认访问
}


function loadByUrls($urls){
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