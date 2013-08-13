<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
	
<html lang="ch">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Honeyee SAMPLE</title>
		<script  type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		<!--<script src="bootstrap.js" type="text/javascript"></script>-->
		<script type="text/javascript" src="js/script.js"></script>
		<!--<link rel="stylesheet" href="bootstrap.min.css" />-->
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="stylesheet" href="css/side.css"/>
			
	</head>
	<body id="body">
		<div id="backgroundWarper">
			<div id="imgWrapper" > 
				<img id="bgImg" class="src-image" onload="loadImage()" />
			</div>
			<div id="mask"></div>
			<div id="loader"></div>
		</div>
		<?php include("side.php"); ?>
		<div id="content">
			<div id="topflash">
				<div id="headLogoDiv"> <a class="svg" href="#" id = "headLogo"> </a>
					<!--<object id="topLogo" data="bg/Top-logo.svg" type="image/svg+xml"></object>-->
				</div>
				
				<div id="topFlash">
					<div id="mainTitle">
						<img id="pngTitle" src="bg/title1.png" alt="title" />
					</div>
					<div id="loader"></div>
					<div id="mainimage"></div>
				</div>
				
				<ul id="mainNav">
					<li><a class="svg" href="feature.php" id="mainNavFeature"></a></li>
					<li><a class="svg" href="#" id="mainNavLocal"></a></li>
					<li><a class="svg" href="#" id="mainNavStore"></a></li>
					<li><a class="svg" href="#" id="mainNavNews"></a></li>
					<li><a class="svg" href="#" id="mainNavThink"></a></li>
				</ul>
			</div>
			<div id="topBanner">
				<img src="bg/top_banner_sample.png" alt="" />
				
			</div>
			<div id="footLogo" class="svg" ></div>
				
		</div>
		
		
		
		
		
		
		
		
	</body>
</html>