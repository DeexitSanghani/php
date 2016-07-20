<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';

$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(!$conn)
{
    die('Could not connect: ' . mysql_error());
}else{
	
    $db_selected = mysql_select_db($dbname,$conn);
    if (!$db_selected) {
		die ('Can\'t use  : ' . mysql_error());
	}
}
?>
