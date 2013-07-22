<?php
class MUser
{
	public static function getBlog(){
		$db = get_dbh();
		return $db->select('select * from blog');
	}

	public static function addBlog(){
		$db = get_dbh();
		$db->begin();
		return $db->execute('insert into blog(title,record_time) values("test1",:record_time)',array(
			':record_time'=>getTime()
		));
		$db->rollback();
	}
}