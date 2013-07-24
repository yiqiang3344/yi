<?php
class YException extends Exception
{
	public $errorInfo;

	/**
	 * Constructor.
	 * @param string $message PDO error message
	 * @param integer $code PDO error code
	 * @param mixed $errorInfo PDO error info
	 */
	public function __construct($message,$code=0,$errorInfo=null)
	{
		$this->errorInfo=$errorInfo;
		parent::__construct($message,$code);
	}
}

final class AutoLoader
{
    private $baseDirs;
    public function __construct($baseDirs = array()){
        if (count($baseDirs)==0) {
            $baseDirs[] = getcwd().'/..';
        } else {
        	foreach($baseDirs as &$dir){
        		$dir = rtrim($dir, '/');
        	}
        	$this->baseDirs = $baseDirs;
        }
    }

    public static function register($baseDirs = array()){
        $loader = new self($baseDirs);
        spl_autoload_register(array($loader, 'autoload'));
    }

    public function autoload($class){
        if ($class[0] === '\\') {
            $class = substr($class, 1);
        }
        foreach ($this->baseDirs as $dir) {
        	$file = sprintf('%s/%s.php', $dir, $class);
	        if (is_file($file)) {
	            require $file;
	            return;
	        }
        }
    }
}

final class YConfig
{
	public static function get($config,$key=false){
		$cfg = include(YROOT.'/config/'.$config.'.cfg.php');
		return $key?$cfg[$key]:$cfg;
	}
}

function YDie($m=''){
	if(YDEBUG){
		YError::errorlog($m,true,false);
	}else{
		YError::errorlog($m);
		die($m);
	}
}

function YGetDbah(){
	return YDatabase::YGetDbah();
}

function YGetDbh(){
	return YDatabase::YGetDbh();
}

final class YError
{
	public static function errorview($url=null){
		$url===null and $url = YConfig::get('main','errorview');
		header('Location: //'.SERVER_URI.$url); //默认访问
	}

	public static function errorlog($m,$print=false,$log=true) {
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
}