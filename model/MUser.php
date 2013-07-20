<?php
class MUser extends YDatabase
{
	public static function getBlog(){
		$db = self::get_dbh();
		return $db->select('select * from blog');
	}

	public static function addBlog(){
		$db = self::get_dbh();
		$db->begin();
		return $db->execute('insert into blog(title) values("test1")');
		$db->rollback();
	}

}