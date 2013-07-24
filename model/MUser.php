<?php
class MUser
{
	public static function getBlog(){
		$db = YGetDbh();
		return $db->select('select * from blog');
	}

	public static function addBlog(){
		$db = YGetDbh();
		$db->begin();
		return $db->execute('insert into blog(title,record_time) values("test1",:record_time)',array(
			':record_time'=>getTime()
		));
		$db->rollback();
	}
}