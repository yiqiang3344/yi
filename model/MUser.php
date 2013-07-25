<?php
class MUser
{
	public static function getBlog(){
		$db = getDbh();
		return $db->select('select * from blog');
	}

	public static function addBlog(){
		$db = getDbh();
		$db->begin();
		return $db->execute('insert into blog(title,record_time) values("test1",:record_time)',array(
			':record_time'=>getTime()
		));
		$db->rollback();
	}
}