
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
	
<html xmlns:wb="http://open.weibo.com/wb">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>weibo</title>
		
		<!--<link rel="stylesheet" href="bootstrap.min.css" />-->
		<link rel="stylesheet" href="css/feature.css"/>
		<link rel="stylesheet" href="css/side.css"/>
		
		<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js?appkey=262394212" type="text/javascript" charset="utf-8"></script>
	</head>
	<body id="body">
		<?php include("side.php") ?>
		
		
		
		<wb:livestream skin="silver" appkey="262394212" talk="n" width="auto" listid="3608850915277764" uid="1790579504" height="500" ></wb:livestream>
		<script src="js/jquery.js" type="text/javascript"></script>
		<!--<script src="bootstrap.js" type="text/javascript"></script>-->
		<!--<script src="script.js" type="text/javascript"></script>-->
	
		<script>
			var $api_url = "http://api.t.sina.com.cn/",
				$app_key = '262394212';
			//载入JS-SDK
			WB.core.load(['connect', 'client'], function() {
			    var cfg = {
			        key: $app_key,
			        xdpath: 'http://'+location.host+'/xd.html'
			    };
			    WB.connect.init(cfg);	
			    WB.client.init(cfg);
			});
			/**
			 * 根据uid获取用户的关注列表包括最新的微博
			 * @param {Object} uid 用户uid
			 * @param {Object} count 条数
			 * @param {Object} back callback函数
			 */
			 var uid = 1790579504;
			 var count = 20;
			 
			var getFriends = function(uid,count,back){
				back = back||function(){ console.log( "get here");};
				count = count || 20;
				$.getJSON($api_url+"statuses/friends.json?callback=?", {source:$app_key,user_id:uid,count:count}, function(json){
					back.call({},json);
				});
			};
		</script>
		
		
	</body>
</html>