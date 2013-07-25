<?php
class YDatabase{
	private static $dbh;
	private static $dbah;
	public static function setDb(){
		if(!self::$dbh){
			$dbCfg = YConfig::get('main','db');
			$dbCfg['connectionString'] .= 'dbname='.$dbCfg['dbname'].';';
			self::$dbh=YDatabaseAccess::create($dbCfg,true);
			// self::$dbh->openCache(600);//开启memcache并设置缓存时间
		}
	}
	public static function YGetDbh(){
		return self::$dbh;
	}
	public static function YGetDbah(){
		if(!self::$dbah){
			self::$dbah=YDatabaseAccess::create(YConfig::get('main','db'),true);
		}
		return self::$dbah;
	}
}

final class YDatabaseAccess{
	private $connection;
	private $transaction;
	private function __construct($connection){
		$this->connection=$connection;
	}
	public static function create($param){
		$connection=new YDbConnection($param["connectionString"],$param["username"],$param["password"]);
		return new self($connection);
	}
	public function execute($sql,$params=array()){
		if(YDEBUG && !$this->transaction){
			YDie();
		}
		return 	$this->connection->createCommand($sql)->execute($params);
	}
	public function select($sql,$params=array()){
		return 	$this->connection->createCommand($sql)->queryAll(true,$params);
	}
	public function selectRow($sql,$params=array()){
		return 	$this->connection->createCommand($sql)->queryRow(true,$params);
	}
	public function selectCol($sql,$params=array()){
		return 	$this->connection->createCommand($sql)->queryColumn($params);
	}
	public function selectOne($sql,$params=array()){
		return 	$this->connection->createCommand($sql)->queryScalar($params);
	}
	public function lastInsertId(){
		return $this->connection->getLastInsertID();
	}	
	public function begin(){
		if($this->transaction){
			YDie();
		}
		$this->transaction=$this->connection->beginTransaction();
		return true;
	}
	public function commit(){
		if(!$this->transaction){
			YDie();
		}
		$this->transaction->commit();
		$this->transaction=null;
		return true;
	}
	public function rollback(){
		if(!$this->transaction){
			YDie();
		}
		$this->transaction->rollBack();
		$this->transaction=null;
		return true;
	}
	
	public function checkTransaction(){
		return $this->transaction?true:false;
	}

	public function openCache($duration){
		return $this->connection->cache($duration);
	}
}

final class YDbConnection
{
	public $connectionString;
	public $username='';
	public $password='';
	public $queryCachingDuration=0;
	public $queryCachingCompressed=false;
	public $queryCachingCount=0;
	public $autoConnect=true;
	public $charset;
	public $emulatePrepare=true;
	public $enableParamLogging=false;
	public $tablePrefix;
	public $initSQLs;
	public $driverMap=array(
		'pgsql'=>'CPgsqlSchema',    // PostgreSQL
		'mysqli'=>'CMysqlSchema',   // MySQL
		'mysql'=>'CMysqlSchema',    // MySQL
		'sqlite'=>'CSqliteSchema',  // sqlite 3
		'sqlite2'=>'CSqliteSchema', // sqlite 2
		'mssql'=>'CMssqlSchema',    // Mssql driver on windows hosts
		'dblib'=>'CMssqlSchema',    // dblib drivers on linux (and maybe others os) hosts
		'sqlsrv'=>'CMssqlSchema',   // Mssql
		'oci'=>'COciSchema',        // Oracle driver
	);
	public $pdoClass = 'PDO';
	private $_attributes=array();
	private $_active=false;
	private $_pdo;
	private $_transaction;
	public function __construct($dsn='',$username='',$password='')
	{
		$this->connectionString=$dsn;
		$this->username=$username;
		$this->password=$password;
	}
	public function __sleep()
	{
		$this->close();
		return array_keys(get_object_vars($this));
	}
	public static function getAvailableDrivers()
	{
		return PDO::getAvailableDrivers();
	}
	public function init()
	{
		if($this->autoConnect)
			$this->setActive(true);
	}
	public function cache($duration, $Compressed=false, $queryCount=1)
	{
		$this->queryCachingDuration=$duration;
		$this->queryCachingCompressed=$Compressed;
		$this->queryCachingCount=$queryCount;
		return $this;
	}
	public function getActive()
	{
		return $this->_active;
	}
	public function setActive($value)
	{
		if($value!=$this->_active)
		{
			if($value)
				$this->open();
			else
				$this->close();
		}
	}
	protected function open()
	{
		if($this->_pdo===null)
		{
			if(empty($this->connectionString))
				throw new YDbException('YDbConnection.connectionString cannot be empty.');
			try
			{
				$this->_pdo=$this->createPdoInstance();
				$this->initConnection($this->_pdo);
				$this->_active=true;
			}
			catch(PDOException $e)
			{
				if(YDEBUG)
				{
					throw new YDbException('YDbConnection failed to open the DB connection: '.
						$e->getMessage(),(int)$e->getCode(),$e->errorInfo);
				}
				else
				{
					throw new YDbException('YDbConnection failed to open the DB connection.',(int)$e->getCode(),$e->errorInfo);
				}
			}
		}
	}
	protected function close()
	{
		$this->_pdo=null;
		$this->_active=false;
	}
	protected function createPdoInstance()
	{
		$pdoClass=$this->pdoClass;
		if(($pos=strpos($this->connectionString,':'))!==false)
		{
			$driver=strtolower(substr($this->connectionString,0,$pos));
			if($driver==='mssql' || $driver==='dblib')
				$pdoClass='CMssqlPdoAdapter';
			elseif($driver==='sqlsrv')
				$pdoClass='CMssqlSqlsrvPdoAdapter';
		}
		return new $pdoClass($this->connectionString,$this->username,
									$this->password,$this->_attributes);
	}
	protected function initConnection($pdo)
	{
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		if($this->emulatePrepare!==null && constant('PDO::ATTR_EMULATE_PREPARES'))
			$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,$this->emulatePrepare);
		if($this->charset!==null)
		{
			$driver=strtolower($pdo->getAttribute(PDO::ATTR_DRIVER_NAME));
			if(in_array($driver,array('pgsql','mysql','mysqli')))
				$pdo->exec('SET NAMES '.$pdo->quote($this->charset));
		}
		if($this->initSQLs!==null)
		{
			foreach($this->initSQLs as $sql)
				$pdo->exec($sql);
		}
	}
	public function getPdoInstance()
	{
		return $this->_pdo;
	}
	public function createCommand($query=null)
	{
		$this->setActive(true);
		return new YDbCommand($this,$query);
	}
	public function getCurrentTransaction()
	{
		if($this->_transaction!==null)
		{
			if($this->_transaction->getActive())
				return $this->_transaction;
		}
		return null;
	}
	public function beginTransaction()
	{
		$this->setActive(true);
		return $this->_pdo->beginTransaction();
	}
	public function getLastInsertID($sequenceName='')
	{
		$this->setActive(true);
		return $this->_pdo->lastInsertId($sequenceName);
	}
	public function quoteValue($str)
	{
		if(is_int($str) || is_float($str))
			return $str;
		$this->setActive(true);
		if(($value=$this->_pdo->quote($str))!==false)
			return $value;
		else  // the driver doesn't support quote (e.g. oci)
			return "'" . addcslashes(str_replace("'", "''", $str), "\000\n\r\\\032") . "'";
	}
	public function getPdoType($type)
	{
		static $map=array
		(
			'boolean'=>PDO::PARAM_BOOL,
			'integer'=>PDO::PARAM_INT,
			'string'=>PDO::PARAM_STR,
			'resource'=>PDO::PARAM_LOB,
			'NULL'=>PDO::PARAM_NULL,
		);
		return isset($map[$type]) ? $map[$type] : PDO::PARAM_STR;
	}
	public function getDriverName()
	{
		if(($pos=strpos($this->connectionString, ':'))!==false)
			return strtolower(substr($this->connectionString, 0, $pos));
	}
	public function getAttribute($name)
	{
		$this->setActive(true);
		return $this->_pdo->getAttribute($name);
	}
	public function setAttribute($name,$value)
	{
		if($this->_pdo instanceof PDO)
			$this->_pdo->setAttribute($name,$value);
		else
			$this->_attributes[$name]=$value;
	}
	public function getAttributes()
	{
		return $this->_attributes;
	}
	public function setAttributes($values)
	{
		foreach($values as $name=>$value)
			$this->_attributes[$name]=$value;
	}
}
class YDbCommand
{
	public $params=array();
	private $_connection;
	private $_text;
	private $_statement;
	private $_paramLog=array();
	private $_fetchMode = array(PDO::FETCH_ASSOC);
	public function __construct(YDbConnection $connection,$query=null)
	{
		$this->_connection=$connection;
		if(is_array($query))
		{
			foreach($query as $name=>$value)
				$this->$name=$value;
		}
		else
			$this->setText($query);
	}
	public function __sleep()
	{
		$this->_statement=null;
		return array_keys(get_object_vars($this));
	}
	public function setFetchMode($mode)
	{
		$params=func_get_args();
		$this->_fetchMode = $params;
		return $this;
	}
	public function reset()
	{
		$this->_text=null;
		$this->_statement=null;
		$this->_paramLog=array();
		$this->params=array();
		return $this;
	}
	public function getText()
	{
		return $this->_text;
	}
	public function setText($value)
	{
		if($this->_connection->tablePrefix!==null && $value!='')
			$this->_text=preg_replace('/{{(.*?)}}/',$this->_connection->tablePrefix.'\1',$value);
		else
			$this->_text=$value;
		$this->cancel();
		return $this;
	}
	public function getConnection()
	{
		return $this->_connection;
	}
	public function getPdoStatement()
	{
		return $this->_statement;
	}
	public function prepare()
	{
		if($this->_statement==null)
		{
			try
			{
				$this->_statement=$this->getConnection()->getPdoInstance()->prepare($this->getText());
				$this->_paramLog=array();
			}
			catch(Exception $e)
			{
				$errorInfo=$e instanceof PDOException ? $e->errorInfo : null;
				throw new YDbException('YDbCommand failed to prepare the SQL statement: '.$e->getMessage(),(int)$e->getCode(),$errorInfo);
			}
		}
	}
	public function cancel()
	{
		$this->_statement=null;
	}
	public function bindParam($name, &$value, $dataType=null, $length=null, $driverOptions=null)
	{
		$this->prepare();
		if($dataType===null)
			$this->_statement->bindParam($name,$value,$this->_connection->getPdoType(gettype($value)));
		elseif($length===null)
			$this->_statement->bindParam($name,$value,$dataType);
		elseif($driverOptions===null)
			$this->_statement->bindParam($name,$value,$dataType,$length);
		else
			$this->_statement->bindParam($name,$value,$dataType,$length,$driverOptions);
		$this->_paramLog[$name]=&$value;
		return $this;
	}
	public function bindValue($name, $value, $dataType=null)
	{
		$this->prepare();
		if($dataType===null)
			$this->_statement->bindValue($name,$value,$this->_connection->getPdoType(gettype($value)));
		else
			$this->_statement->bindValue($name,$value,$dataType);
		$this->_paramLog[$name]=$value;
		return $this;
	}
	public function bindValues($values)
	{
		$this->prepare();
		foreach($values as $name=>$value)
		{
			$this->_statement->bindValue($name,$value,$this->_connection->getPdoType(gettype($value)));
			$this->_paramLog[$name]=$value;
		}
		return $this;
	}
	public function execute($params=array())
	{
		if($this->_connection->enableParamLogging && ($pars=array_merge($this->_paramLog,$params))!==array())
		{
			$p=array();
			foreach($pars as $name=>$value)
				$p[$name]=$name.'='.var_export($value,true);
			$par='. Bound with ' .implode(', ',$p);
		}
		else
			$par='';
		try
		{
			$this->prepare();
			if($params===array())
				$this->_statement->execute();
			else
				$this->_statement->execute($params);
			$n=$this->_statement->rowCount();
			return $n;
		}
		catch(Exception $e)
		{
			$errorInfo=$e instanceof PDOException ? $e->errorInfo : null;
			$message=$e->getMessage();
			if(YDEBUG)
				$message.='. The SQL statement executed was: '.$this->getText().$par;
			throw new YDbException('YDbCommand failed to execute the SQL statement:'.$message,(int)$e->getCode(),$errorInfo);
		}
	}
	public function query($params=array())
	{
		return $this->queryInternal('',0,$params);
	}
	public function queryAll($fetchAssociative=true,$params=array())
	{
		return $this->queryInternal('fetchAll',$fetchAssociative ? $this->_fetchMode : PDO::FETCH_NUM, $params);
	}
	public function queryRow($fetchAssociative=true,$params=array())
	{
		return $this->queryInternal('fetch',$fetchAssociative ? $this->_fetchMode : PDO::FETCH_NUM, $params);
	}
	public function queryScalar($params=array())
	{
		$result=$this->queryInternal('fetchColumn',0,$params);
		if(is_resource($result) && get_resource_type($result)==='stream')
			return stream_get_contents($result);
		else
			return $result;
	}
	public function queryColumn($params=array())
	{
		return $this->queryInternal('fetchAll',array(PDO::FETCH_COLUMN, 0),$params);
	}
	private function queryInternal($method,$mode,$params=array())
	{
		$params=array_merge($this->params,$params);
		if($this->_connection->enableParamLogging && ($pars=array_merge($this->_paramLog,$params))!==array())
		{
			$p=array();
			foreach($pars as $name=>$value)
				$p[$name]=$name.'='.var_export($value,true);
			$par='. Bound with '.implode(', ',$p);
		}
		else
			$par='';
		if($this->_connection->queryCachingCount>0 && $method!==''
				&& $this->_connection->queryCachingDuration>0
				&& $cache = YCache::getInstance($this->_connection->queryCachingDuration))
		{
			$this->_connection->queryCachingCount--;
			$cacheKey='yi:dbquery'.$this->_connection->connectionString.':'.$this->_connection->username;
			$cacheKey.=':'.$this->getText().':'.serialize(array_merge($this->_paramLog,$params));
			if(($result=$cache->get($cacheKey))!==false)
			{
				return $result[0];
			}
		}
		try
		{
			$this->prepare();
			if($params===array())
				$this->_statement->execute();
			else
				$this->_statement->execute($params);
			$mode=(array)$mode;
			call_user_func_array(array($this->_statement, 'setFetchMode'), $mode);
			$result=$this->_statement->$method();
			$this->_statement->closeCursor();
			if(isset($cache,$cacheKey))
				$cache->set($cacheKey, array($result), $this->_connection->queryCachingCompressed, $this->_connection->queryCachingDuration);
			return $result;
		}
		catch(Exception $e)
		{
			$errorInfo=$e instanceof PDOException ? $e->errorInfo : null;
			$message=$e->getMessage();
			if(YDEBUG)
				$message.='. The SQL statement executed was: '.$this->getText().$par;
			throw new YDbException('YDbCommand failed to execute the SQL statement:'.$message,(int)$e->getCode(),$errorInfo);
		}
	}
}

class YDbException extends Exception
{
	/**
	 * @var mixed the error info provided by a PDO exception. This is the same as returned
	 * by {@link http://www.php.net/manual/en/pdo.errorinfo.php PDO::errorInfo}.
	 * @since 1.1.4
	 */
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

class YCache
{
	static private $_single=null;
	private $_connection;
	public $_expire;
	private $_min_saving = 0.2;//自动压缩比率
	private $_threshold = 20000;//自动压缩上限

	public static function getInstance($expire=600){
		if(self::$_single instanceof self){
			return self::$_single;
		}
		return new self($expire);
	}

	private function __construct($expire){
		$cacheCfg = YConfig::get('main','cache');
		$this->_connection = new Memcache;
	    $this->_connection->connect($cacheCfg['server'], $cacheCfg['port']) or YDie("Could not connect");
	    $this->_connection->setCompressThreshold($this->threshold, $this->min_saving) or YDie("Could not setCompressThreshold");
		$this->_expire = $expire;

		self::$_single = $this;
	}

	public function close(){
	    $this->_connection->close() or YDie("Could not close");
	    self::$_single = null;
		return ture;
	}

	public function get($key){
		return $this->_connection->get($key);
	}

	public function add($key,$val,$compressed=false,$expire=null){
		$expire ==null and $expire = $this->_expire;
		return $this->_connection->add($key,$val,$compressed,$expire);
	}

	public function set($key,$val,$compressed=false,$expire=null){
		$expire ==null and $expire = $this->_expire;
		return $this->_connection->set($key,$val,$compressed,$expire);
	}

	public function replace($key,$val,$compressed=false,$expire=null){
		$expire ==null and $expire = $this->_expire;
		return $this->_connection->replace($key,$val,$compressed,$expire);
	}

	public function decrement($key,$val){
		return $this->_connection->decrement($key,$val);
	}

	public function increment($key,$val){
		return $this->_connection->increment($key,$val);
	}

	public function delete($key,$timeout=0){
		return $this->_connection->delete($key,$timeout);
	}

	public function flush(){
		return $this->_connection->flush();
	}

	public function getStats(){
		return $this->_connection->getStats();
	}
}