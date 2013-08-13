
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
	
<html lang="ch">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Urbanlife Manage Item</title>
		
		<!--<link rel="stylesheet" href="bootstrap.min.css" />-->
		<link rel="stylesheet" href="css/feature.css"/>
		<link rel="stylesheet" href="css/side.css"/>
		 <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/css/bootstrap.min.css">
				
		
	</head>
	<body id="body">
		<?php include("db_connection.php"); ?>
		<div id="header">
			<h2>管理文章<span style="font-size: 15px;">Magazine Items</span></h2>
			  <ul class="breadcrumb" style="margin-bottom: 5px;">
		        <li><a href="#">Home</a></li>
		        <li><a href="#">Manage</a></li>
		        <li class="active">Items</li>
		      </ul>
		</div>
		<!--<div id="content" style="float: left; min-width: 900px;">
			<div id="sideControl" style="background: #f5f5f5; width: 30%; min-height: 600px;">
			</div>
		</div>-->
		<div class="container-fluid">
	      <div class="row">
	        <div class="col-lg-2 col-lg-offset-1">
	          <div class="well sidebar-nav">
	            <ul class="nav nav-list">
	              <li class="nav-header">用户:XXX</li>
	              <li><a href="#" id="createNewItem">新建</a></li>
	              <li><a href="#" id="filterNo">查看所有</a></li>
	              <li class="nav-header">管理</li>
	              <li><a href="#" id="filterNews">新闻类</a></li>
	              <li><a href="#" id="filterFeature">专题类</a></li>
	              <li><a href="#">Test</a></li>
	              <li><a href="#">Test</a></li>
	            </ul>
	          </div><!--/.well -->
	        </div>
	        
	         <div class="col-lg-8">
	         	<div class="" id="table">
	         		<div class="panel">
	         			<div class="panel-heading">服务器信息</div>
		         		<p class="text-info">Debug Info
		         		<?php
		         			echo("<br>GET:");
		         			if(isset($_GET))
		         				var_dump($_GET);
		         			
		         			echo("<br>POST:");
	         				if(isset($_POST))
	         				{
	         					//var_dump($_POST);
	         					if(isset($_POST['createNew'])){	
	         				    	//insert items
			         				$query = "INSERT INTO items";
			                        $query .= " (title,description,list_thumb, date, arthur, category, content) ";
			                        $query .= "VALUES ('";
			                        $query .= $_POST["title"]."', '";
			                        $query .= $_POST["description"]."', '";
			                        $query .= $_POST["list_thumb"]."', '";
			                        $query .= $_POST["date"]."', '";
			                        $query .= $_POST["arthur"]."', '";
			                        $query .= $_POST["category"]."', '";
			                        $query .= rawurlencode($_POST["content"])."'); ";
			                        $resultPage = mysql_query($query);
			                            if(!$resultPage)
			                            echo "failed";
			                            else {
			                            	echo "新建成功";
			                            }
		                        }
		                        if(isset($_POST['update'])){	
		                         	//insert items
		                        	$query = "UPDATE items ";
		                        	$query .= "SET title = '".$_POST["title"]."' ";
		                        	$query .= " ,description = '".$_POST["description"]."' ";
		                        	$query .= " ,list_thumb = '".$_POST["list_thumb"]."' ";
		                        	$query .= " ,date = '".$_POST["date"]."' ";
		                        	$query .= " ,arthur = '".$_POST["arthur"]."' ";
		                        	$query .= " ,category = '".$_POST["category"]."' ";
		                        	$query .= " ,content = '".rawurlencode($_POST["content"])."'";
		                        	$query .= " WHERE uid = ".$_POST["uid"].";";
		                        	
		                            $resultPage = mysql_query($query);
		                                if(!$resultPage)
		                                echo "failed";
		                                else {
		                                	echo "保存成功";
		                                }
		                        }
		                        if(isset($_POST['delete'])){	
		                         	//insert items
		                        	$query = "DELETE FROM items ";
		                        	$query .= " WHERE uid = ".$_POST["uid"].";";
		                        	
		                            $resultPage = mysql_query($query);
		                                if(!$resultPage)
		                                echo "failed";
		                                else {
		                                	echo "删除成功";
		                                }
		                        }
		                        
		                    }
		                    //预备json数据，可能会影响效率
		                    include("mysql2json.php");
		         		?>
		         		</p>
		         	</div>
	         	</div>
	         	<div class="panel" id="pageTable">
	         	  <div class="panel-heading">文章缩略列表</div>
         	      <table class="table table-hover table-condensed table-striped">
         	        <thead>
         	          <tr>
         	            <th>Uid</th>
         	            <th>标题title</th>
         	            <th>描述description</th>
         	            <th>列表小图list_thumb</th>
         	            <th>时间date</th>
         	            <th>作者arthur</th>
         	            <th>类别category</th>
         	            <th>操作content</th>
         	          </tr>
         	        </thead>
         	        <tbody id="tbody"></tbody>
         	      </table>
         	    </div>
	           <div class="panel">
	           	   <div class="panel-heading">编辑框</div> 
		           <form action="manageItem.php" method="post" id="pageForm">
		             <fieldset>
		               <legend>UID:<span ><input id="formuid" name="uid"></input></span></legend>
		               <div class="form-group">
		                 <label for="formTitle">标题</label>
		                 
		                 <input type="text" class="form-control" name="title" id="formTitle" placeholder="输入标题">
		               </div>
		               <div class="form-group">
		                 <label for="formDescription">描述</label>
		                 <input type="text" class="form-control" name="description" id="formDescription" placeholder="输入描述">
		               </div>
		               
		               <div class="form-group ">
		                 <label for="formList_Thumb">列表小图</label>
		                 <input type="text" class="form-control " name="list_thumb" id="formList_Thumb" placeholder="输入列表小图的地址">
		                 <img id="thumb_preview" src="" alt="" style="width: 150px; padding: 5px;"/>
		               </div>
		               
		               <div class="form-group">
		                 <label for="formDate">时间</label>
		                 <input type="datetime" id="formDate"  class="form-control" name="date" value="<?php echo date("Y/m/d"); ?>" />
		               </div>
		               
		               <div class="form-group">
		                 <label for="formarthur">作者</label>
		                 <input type="text" id="formarthur"  class="form-control" name="arthur" placeholder="php输入作者" />
		               </div>
		               
		               <div class="form-group">
		                 <label for="formCategory">类别</label>
		                 <select id="formCategory"  class="form-control" name="category" value="php" >
		                 	<option>新闻</option>
		                 	<option>专题</option>
		                 </select>
		               </div>
		               
		               <div class="form-group">
		                 <label for="formContent">文章内容</label>
		                 <textarea rows="10" id="formContent"  class="form-control" name="content" >
		                 </textarea>
		               </div>
		               <button id="SubmitNew" type="submit" class="btn btn-default" name="createNew">增加</button>
		               <button id="SubmitUpdate" type="submit" class="btn btn-default" name="update">保存</button>
		               <button id="SubmitDelete" type="submit" class="btn btn-default" name="delete">删除</button>
		             </fieldset>
		           </form>
		           
		           <div style="padding-top: 10px;">
			           <div class="btn-group">
			             <button type="button" class="btn btn-primary" id="loadNewsTemp">加载新闻模版</button>
			          	 <button type="button" class="btn btn-primary" id="loadFeatureTemp">加载专题模版</button>
			           </div>
		           </div>
	           </div>  
	         </div><!--col-lg-10-->

		  </div><!--row-->
		  
	  </div>
		
		
		<script src="js/jquery.js" type="text/javascript"></script>
		<!--<script src="js/bootstrap.js" type="text/javascript"></script>-->
		<!-- Latest compiled and minified JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc1/js/bootstrap.min.js"></script>
		
		<script type="text/javascript" src="js/nicEdit.js"></script> <script type="text/javascript">
		                    //<![CDATA[
		                    bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
		                    //]]>
		                </script>
		<script>
			$(document).ready(function () {
				
				//event
				$('#loadNewsTemp').click(function () {
					$("div.nicEdit-main").load('itemTempletes.html #newsTemplete');
				});
				$('#loadFeatureTemp').click(function () {
					$("div.nicEdit-main").load('itemTempletes.html #featureTemplete');
				});
				$('#formList_Thumb').blur(function () {
					$('#thumb_preview').attr('src',$('#formList_Thumb').val());
				});
				
				$('#filterNo').click(function () {
					$('tr').each(function (index,domEle) {
						$(this).css('display','');
					});
				});
				
				$('#filterNews').click(function () {
					$('tr').each(function (index,domEle) {
						var uidBox = domEle.getElementsByTagName('td')[0];
						if( uidBox ){
							if( $.isNumeric(uidBox.innerHTML) && domEle.getElementsByTagName('td')[6].innerHTML != '新闻')
							{
								console.log(domEle.getElementsByTagName('td')[6].innerHTML);
								$(this).css('display','none');
							}
							else {
								$(this).css('display','');
							}
						}
					});
				});
				$('#filterFeature').click(function () {
					$('tr').each(function (index,domEle) {
						var uidBox = domEle.getElementsByTagName('td')[0];
						if( uidBox ){
							if( $.isNumeric(uidBox.innerHTML) && domEle.getElementsByTagName('td')[6].innerHTML != '专题')
							{
								console.log(domEle.getElementsByTagName('td')[6].innerHTML);
								$(this).css('display','none');
							}
							else {
								$(this).css('display','');
							}
						}
					});
				});
				$('#createNewItem').click(function () {
					var pos = $('#pageForm').offset().top;
					jQuery("html,body").animate({scrollTop:pos},300);//
				});
				
				$.getJSON('dataItems.json', loadJson);
				
				
			});//end dom ready
			
		</script>
		<script src="function.js" type="text/javascript"></script>
	</body>
</html>