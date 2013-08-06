<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
	
<html lang="ch">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>上传内容管理页</title>
        
		<link rel="stylesheet" href="css/bootstrap.css"/>
		<link rel="stylesheet" href="css/bootstrap-fileupload.min.css" />
	</head>
	<body id="body">
		<div id="header">
			<h1 id="headLogo"></h1>
			<h2>上传图片管理页</h2>
			<ul>
				<li>上传图片先选择上传图片，点击上传，如果成功，列表中应存在上传文件</li>
				<li>删除图片，选择文件后点击删除</li>
            </ul>
			<div style="float: left;">
				<a href="index.php">HOME</a>><a href="imagemanage.php">上传文件管理页面</a>
			</div>
		</div>
		<div style="clear: both;"></div>
		<div style="margin: 5px; padding-left: 15px; background: #333; color: #FEFEFE;">
		<?php
//		echo "[file]:";
//		var_dump($_FILES);
//		echo "<br>[post]";
//		var_dump($_POST);
		if($_FILES && $_POST)
		{
			//添加文件
			if(count($_FILES["file"]["name"]) && $_POST["submit"] == "上传")
			{
				if ($_FILES["file"]["error"] > 0){
//			    echo "Error: " . $_FILES["file"]["error"] . "<br>";
				echo "上传失败";
			    }
				else {
//			    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
//			    echo "Type: " . $_FILES["file"]["type"] . "<br>";
//			    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//			    echo "Stored in: " . $_FILES["file"]["tmp_name"];
			    }
			    
			   if (file_exists("upload/" . $_FILES["file"]["name"])){
//		       echo $_FILES["file"]["name"] . " already exists. ";
				echo "文件已存在";
		       }
		       else {
		       move_uploaded_file($_FILES["file"]["tmp_name"],
		       "upload/" . $_FILES["file"]["name"]);
//		       echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
			   echo "成功添加图像";
		   	   }
		    }
		    //删除文件
		    if($_POST["submit"] == "删除")
		    {
//		    	echo "delete file";
//		    	//check select
//		    	echo "-upload/".$_POST["fileName"]."-";				    	
		    	if (!unlink("upload/".$_POST["fileName"]))
		    	  {
		    	  echo "删除文件失败";
		    	  //echo "Error deleting".$_POST["fileName"];
		    	  }
		    	else
		    	  {
		    	  echo "文件已删除";
		    	  //echo "Deleted ".$_POST["fileName"];
		    	  }
		    }
		 }
		?>
		</div>
		<div id="box" style="display: block; padding: 15px; padding-left: 40px; border: 1px solid #333;">
			<!--<div style="float: left;">-->
			<form action="manageimage.php" method="post" enctype="multipart/form-data">
				<div class="fileupload fileupload-new" data-provides="fileupload">
				  <div class="fileupload-preview thumbnail" style="width: 200px; height: 150px;"></div>
				  <div>
				    <span class="btn btn-file">
				    	<span class="fileupload-new">选择上传图像</span>
				    	<span class="fileupload-exists">重新选择</span>
				    	<input type="file" name="file" id="file"/></span>
				    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">取消</a>
				    <input class="btn btn-primary" type="submit" name="submit" value="上传">
				  </div>
				</div>
			<!--</div>-->
			<div id="info" style="background: #f5f5f5 ;">
				<div>
					<input class="btn btn-danger" type="submit" name="submit" value="删除" style="float: right;" />
				</div>
				<table class="table table-hover">
					<tr><th>select</th><th>file Name</th><th>Size</th><th>url</th>
					<?php 
						if ($handle = opendir('upload/')) {
			    			while (false !== ($entry = readdir($handle))) {
			        			if ($entry != "." && $entry != "..") {
			        				echo "<tr>";
			        				echo "<td><input class=\"checkbox\" type=\"radio\" name=\"fileName\" value=\"".$entry."\"></input></td>";
			        				echo "<td>";
			            			echo $entry."</td>";
			            			echo "<td>";
									
									$fullpath = "upload/".$entry;
			            			$fileInfo = stat($fullpath);
									//var_dump($fileInfo);
			            			$imgsize = $fileInfo['size'];
									//echo "<h3>".$imgsize."</h3>";
			            			if($imgsize<1024)
			            				echo floor($imgsize)."byte";
			            			else if($imgsize>1024*1024){
			            				echo floor($imgsize/(1024*1024))."MB";
			            			}
			            			else {
			            				echo floor($imgsize/1024)."kb";
			            			}
			            			
			            			//echo stat("upload/".$entry)['size'];
			            			echo "</td>";
			            			echo "<td>upload/".$entry."</td></tr>";
			        			}
			    			}
			    			closedir($handle);
			    		}
			    	?>
				</table>
				
				</p>
			</div>
			</form>
		</div>
		
		<script src="http://code.jquery.com/jquery-1.10.1.min.js" type="text/javascript"></script>
		<script src="js/bootstrap-fileupload.min.js" type="text/javascript"></script>
		<script >
			console.log( $(".fileupload-exists"));
			console.log($('.fileupload'));
		</script>
		<!--<script src="bootstrap.js" type="text/javascript"></script>-->
		<!--<script src="script.js" type="text/javascript"></script>-->
				
	</body>
</html>