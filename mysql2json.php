<!--<pre>-->
<?php 
	include("db_connection.php");
	$jsonData = array();
	$query = "SELECT * ";
	$query .= "FROM items ";
	//$resultPages = mysqli_query($connection,$query);
	$resultPages = mysql_query($query);
	
	//while( $data = mysqli_fetch_assoc($resultPages))
	while( $data = mysql_fetch_assoc($resultPages))
	{
    	//var_dump( $data);
    	$row = array("uid"=>$data['uid'],
    			"title"=>$data['title'],
    			"description"=>$data['description'],
    			"list_thumb"=>$data['list_thumb'],
    			'date'=>$data['date'],
    			'arthur'=>$data['arthur'],
    			'category'=>$data['category']
    			);    	
    	array_push($jsonData, $row);
    }
    
    //print_r($jsonData);
    
    
    $fh = fopen("dataItems.json", 'w');
          //or die("Error opening output file");
    fwrite($fh, json_encode($jsonData));
    fclose($fh);
?>
<!--</pre>-->
