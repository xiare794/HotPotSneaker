<?php
	//1. create a db connection
	ini_set('display_errors','On');
	error_reporting(E_ALL);
	//local var
	$host = "localhost";
	$databaseName = "UrbanlifeDB";
	//fatcow var
//	$host = "xiare794.fatcowmysql.com";
//	$databaseName = "urbanlife_8629";
	
	$user = "xiare794";
	$pass = "123";
	$tableName = "items";
	
	$connection = mysql_connect($host,$user,$pass);
	$dbs = mysql_select_db($databaseName, $connection);
	
//	$dbhost = "xiare794.fatcowmysql.com";
//	$dbname = "urbanlife_8629";
//	$dbname = "UrbanlifeDB";
//	$dbhost = "localhost";
//	
//	$dbuser = "xiare794";
//	$dbpass = "123";
//	
//	$connection = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	//Test if succeed
	if(mysqli_connect_error()){
		die("Database connection failed:".
			mysql_connection_error() .
			"(" . mysqli_connection_errno().")"
			);
	}
	
?>