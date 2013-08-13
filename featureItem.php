
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
	
<html lang="ch">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Honeyee SAMPLE</title>
		
		<!--<link rel="stylesheet" href="bootstrap.min.css" />-->
		<link rel="stylesheet" href="css/feature.css"/>
		<link rel="stylesheet" href="css/side.css"/>
		<?php include("db_connection.php") ?>
		<?php 
			$result;
			if(isset($_GET['uid'])){
				
				//insert items
				$query = "SELECT * FROM items";
				$query .= " WHERE uid = ".$_GET["uid"].";";
				//echo $query;
				$resultPage = mysql_query($query);
				if(!$resultPage)
					echo "failed";
				else {
					while($row=mysql_fetch_array($resultPage)){
						$result = $row;		
						//echo $result['title'];	
					}
				}
			}       
		?>	
		
	</head>
	<body id="body">
		<div id="header">
			<h1 id="headLogo"></h1>
			
			<ul class="breadcrumb" style="margin-bottom: 5px;">
			  <li><a href="index.php">Home</a>></li>
			  <li><a href="features.php">Featrue</a>></li>
			  <li><?php echo $result['title']; ?></li>
			</ul>
		</div>
		<?php include("side.php"); ?>
		<div id="content" style="float: left; width: 3000px;">
			<?php echo urldecode($result['content']); ?>
				
		</div>
		<div id="footLogo" class="svg" ></div>
		
		
		<script src="js/jquery.js" type="text/javascript"></script>
		<script type="text/javascript">
			//获取XML文件，此处主要获取SVG图像
			function fetchXML  (url, callback) {
			        var xhr = new XMLHttpRequest();
			        xhr.open('GET', url, true);
			        xhr.onreadystatechange = function (evt) {
			        //Do not explicitly handle errors, those should be
			        //visible via console output in the browser.
			        if (xhr.readyState === 4) {
			            callback(xhr.responseXML);
			        }
			        };
			        xhr.send(null);
			};
			//layout
			$(window).resize(function() {
				$("#content").css('width', $("body").width()-300);
			});
			$("#content").css('width', $("body").width()-300);
			
			//svg
			fetchXML("bg/mainNav_feature.svg",function (SVG){ document.getElementById("headLogo").appendChild(document.importNode(SVG.documentElement,true)); });
			fetchXML("bg/footLogo.svg",function (SVG){ document.getElementById('footLogo').appendChild(document.importNode(SVG.documentElement,true)); });
			
			console.log($(window).width());
			console.log($("#content").width());
			
			$(document).ready(function () {
				$.getJSON('dataItems.json', prepareFeatureListPage);
			});
			
			
		</script>
		<!--<script src="bootstrap.js" type="text/javascript"></script>-->
		<!--<script src="script.js" type="text/javascript"></script>-->

		
		
		
	</body>
</html>