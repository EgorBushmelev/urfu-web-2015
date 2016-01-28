<?php

error_reporting(E_ALL^E_NOTICE);

include "connect.php";
include "comment.class.php";

$arr = array();
$validates = Comment::validate($arr);

if($validates)
{
	
	mysql_query("	INSERT INTO comments(name,url,captcha,body)
					VALUES (
						'".$arr['name']."',
						'".$arr['url']."',
						'".$arr['captcha']."',
						'".$arr['body']."'
					)");
	
	$arr['dt'] = date('r',time());
	$arr['id'] = mysql_insert_id();
	
	$arr = array_map('stripslashes',$arr);
	
	$insertedComment = new Comment($arr);

	echo json_encode(array('status'=>1,'html'=>$insertedComment->markup()));

}
else
{
	echo '{"status":0,"errors":'.json_encode($arr).'}';
}

?>