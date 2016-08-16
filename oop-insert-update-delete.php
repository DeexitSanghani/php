<?php 
// this is use for select 
$select_query = "SELECT * FROM tabel_name WHERE id='$id' ";
$result = $db->Query($select_query);
if(mysql_num_rows($result) > 0)
{
	while($rs = mysql_fetch_assoc($result)){
		
	}
}


// use for get form value
$name =	isset($_REQUEST["name"])?stripslashes($_REQUEST["name"]):"";
$data =array('name'=>$name,'email'=>$email);


// use for insert data in database
$db->Insert($data,"tabel_name");


// use for update data in database
$db->Update($data,"tabel_name"," id=".$id."");


// use for delet record
$where = " id = ".$id;
$db->Delete("tabel_name",$where);


// get last inserted id ni database
$lastid=$db->LastInsert('apartments');
?>
