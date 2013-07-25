<?php
function setMainConfig(){
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
	return YTime($add_time, $refresh = false);
}

function getDbh(){
	return YDatabase::YGetDbh();
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


function xcurl($url,$ref=null,$post=array(),$ua="Mozilla/5.0 (X11; Linux x86_64; rv:2.2a1pre) Gecko/20110324 Firefox/4.2a1pre") {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    if(!empty($ref)) {
        curl_setopt($ch, CURLOPT_REFERER, $ref);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    if(!empty($ua)) {
        curl_setopt($ch, CURLOPT_USERAGENT, $ua);
    }
    if(count($post) > 0){
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);   
    }
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function cleanInput($input) {
	$search = array(
		'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
		'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
		'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
		'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
	);
	$output = preg_replace($search, '', $input);
	return $output;
}

function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_escape_string($input);
    }
    return $output;
}

function detectCity($ip) {
	$location = 'unavailable ip.';
    if (!is_string($ip) || strlen($ip) < 8 || $ip == '127.0.0.1' || $ip == 'localhost'){
        $ip = '8.8.8.8';
    }
    $ua = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';
    $url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($ip);
    $content = xcurl($url,$ref=null,$post=array(),$ua);
    if ( preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs) )  {
        $city = $regs[1];
    }
    if ( preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs) )  {
        $state = $regs[1];
    }
    if( $city!='-' && $state!='-' ){
      $location = $city . ', ' . $state;
    }
	return $location;
}

function pwdStrength($string){ 
    $h = 0; 
    $size = strlen($string); 
    foreach(count_chars($string, 1) as $v){ 
        $p = $v / $size; 
        $h -= $p * log($p) / log(2); 
    } 
    $strength = ($h / 4) * 100; 
    if($strength > 100){ 
        $strength = 100; 
    } 
    return $strength; 
}

function xexplode($delimiter, $string){
	if(!$string){
		return array();
	}
	return explode($delimiter, $string);
}


function FUE($hash,$times) {
	for($i=$times;$i>0;$i--) {
		// Encode with base64...
		$hash=base64_encode($hash);
		// and md5...
		$hash=md5($hash);
		// sha1...
		$hash=sha1($hash);
		// sha256... (one more)
		$hash=hash("sha256", $hash);
		// sha512
		$hash=hash("sha512", $hash);
	}
	return $hash;
}