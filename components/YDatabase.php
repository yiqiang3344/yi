<?php
class YDatabase{
	private static $dba;
	private static $dba_all;
	public static function set_db(){
		if(!self::$dba){
			self::$dba=YDatabaseAccess::create(array(
				'connectionString' => 'mysql:host=' . MYSQL_SERVER . ';port=' . MYSQL_SERVER_PORT . ';dbname=' . MYSQL_DATABASE . ';charset=utf8',
				'username' => MYSQL_USERNAME,
				'password' => MYSQL_PASSWORD,
			),true);
		}else{//程序中不能设定两次
			app_die();
		}
	}
	public static function select_dba(){
		return self::$dba;
	}
	public static function select_dba_all(){
		if(!self::$dba_all){
			self::$dba_all=YDatabaseAccess::create(array(
				'connectionString' => 'mysql:host=' . MYSQL_SERVER . ';port=' . MYSQL_SERVER_PORT . ';charset=utf8',
				'username' => MYSQL_USERNAME,
				'password' => MYSQL_PASSWORD,
			),true);
		}
		return self::$dba_all;
	}
}

final class YDatabaseAccess{
	private $connection;
	private $transaction;
	private function __construct($connection){
		$this->connection=$connection;
	}
	public static function create($param){
		$connection=new CDbConnection($param["connectionString"],$param["username"],$param["password"]);
		$connection->schemaCachingDuration=0;
		$connection->emulatePrepare=true;
		$connection->active=true;
		return new YDatabaseAccess($connection);
	}
	public function execute($sql,$params=array()){
		if(YDEBUG && !$this->transaction){
			app_die();
		}
		return 	$this->connection->createCommand($sql)->execute($params);
	}
	public function select($sql,$params=array()){
		return 	$this->connection->createCommand($sql)->queryAll(true,$params);
	}
	public function select_row($sql,$params=array()){
		return 	$this->connection->createCommand($sql)->queryRow(true,$params);
	}
	public function select_col($sql,$params=array()){
		return 	$this->connection->createCommand($sql)->queryColumn($params);
	}
	public function select_one($sql,$params=array()){
		return 	$this->connection->createCommand($sql)->queryScalar($params);
	}
	public function last_insert_id(){
		return $this->connection->getLastInsertID ();
	}	
	public function begin(){
		if($this->transaction){
			app_die();
		}
		$this->transaction=$this->connection->beginTransaction();
		return true;
	}
	public function commit(){
		if(!$this->transaction){
			app_die();
		}
		$this->transaction->commit();
		$this->transaction=null;
		return true;
	}
	public function rollback(){
		if(!$this->transaction){
			app_die();
		}
		$this->transaction->rollBack();
		$this->transaction=null;
		return true;
	}
	
	public function checkTransaction(){
		return $this->transaction?true:false;
	}
}
