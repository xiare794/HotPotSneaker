<?php 

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
//  $host = "localhost";
//  $user = "xiare794";
//  $pass = "123";
//  $databaseName = "UrbanlifeDB";
//  $tableName = "items";
//
//  //--------------------------------------------------------------------------
//  // 1) Connect to mysql database
//  //--------------------------------------------------------------------------
//  //include 'DB.php';
//  $con = mysql_connect($host,$user,$pass);
//  $dbs = mysql_select_db($databaseName, $con);

  include("db_connection.php");
  $query = "SELECT * FROM items";
  if( isset($_GET))
  {
  	if( isset($_GET["uid"]))
  	{
	  	//var_dump( $_GET);
	  	$query .= " WHERE uid = '".$_GET["uid"]."'";
	  	//echo $query;
	 }
  }
  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $result = mysql_query($query);          //query
  $array = mysql_fetch_row($result);                          //fetch result    

  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  //var_dump($array);
  echo $array[4];
?>