<?php
//	mysql_connect("localhost","xiare794","123");
//	mysql_select_db("cms_db");
//	$sql=mysql_query("select * from subjects");
//	while($row=mysql_fetch_assoc($sql)){
//	$output[]=$row;
//	}
//	print(json_encode($output));
//	mysql_close();

	//load 
	mysql_connect("localhost","xiare794","123");
	mysql_select_db("UrbanlifeDB");
	
	$sql=mysql_query("select * from items");
	while($row=mysql_fetch_assoc($sql)){
	$output[]=$row;
	}
	console.log(json_encode($output));
	mysql_close();
?>