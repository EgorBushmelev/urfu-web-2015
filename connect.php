<?php

$db_host		= 'localhost';
$db_user		= 'admin_user';
$db_pass		= '7giPDle1FD';
$db_database		= 'admin_irbit_su'; 


$link = @mysql_connect($db_host,$db_user,$db_pass) or die('Упс что-то сломалось');

mysql_query("SET NAMES 'cp1251'");
mysql_select_db($db_database,$link);

?>