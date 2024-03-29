
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
		<link rel="stylesheet" href="css/paginatestyle.css" />
		<?php include("db_connection.php"); ?>
	</head>
	<body id="body">
		<?php include("side.php") ?>
		<div id="header">
			<h1 id="headLogo"></h1>
			<h2>Now, analyze the honeycomb basis worried about "people," "thing" and "thing".</h2>
			<div style="float: left;">
				<a href="#">HOME</a>><a href="#">FEATURE</a>
			</div>
		</div>
		<div id="content">
			<div id="listContent">

			
			</div>
			<br class="clearfix" />
			<div class="pagination">
				   <div id="pagination"></div>
			      <br class="fl-clear">
			      <p><a href="http://archive.honeyee.com/feature/index.html" onclick="return false"><img class="rollover" src="http://www.honeyee.com/images/feature/archive.gif" alt="以往精选专题"></a></p>
			      <!-- /pagination -->
			    </div>
			<div id="footLogo"></div>
				
		</div>
		
		
		
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
		<script src="function.js" type="text/javascript"></script>
		<script src="js/jquery.paginate.js" type="text/javascript"></script>
		
		
	</body>
</html>