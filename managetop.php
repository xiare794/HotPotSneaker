<?php
	set_include_path('/');
	include('functions.php'); 
	//include(dirname(__FILE__ ).'/functions.php');  ?>
	
<?php 

	$jpgArray = array();
	$pngArray = array();
	if ($handle = opendir('upload/')) {
		while (false !== ($entry = readdir($handle))) {
			if ($entry != "." && $entry != "..") {
				//echo $entry;
				if(strpos($entry, ".jpg")) {
					array_push($jpgArray, "upload/".$entry);
				}
				if(strpos($entry, ".png")){
					array_push( $pngArray,"upload/".$entry);	
				}
    		}
		}
		closedir($handle);
	}
	//print_r($jpgArray);
	//print_r($pngArray);
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
	
<html lang="ch">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>管理首页动画</title>
        
		<link rel="stylesheet" href="css/bootstrap.css"/>
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<link rel="stylesheet" href="css/datepicker.css">
		<link rel="stylesheet" href="css/colorpicker.css">
		
	</head>
	<body id="body" >
		
		<div class="navbar navbar-inverse navbar-fixed-top">
	      <div class="navbar-inner">
	        <div class="container">
	          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="brand" href="./index.html">+8629 URBANLife</a>
	          <div class="nav-collapse collapse">
	            <ul class="nav">
	              <li class="active">
	                <a href="./index.html">公共首页</a>
	              </li>
	              <li class="">
	                <a href="./getting-started.html">页面管理</a>
	              </li>
	              <li class="">
	                <a href="./scaffolding.html">用户管理</a>
	              </li>
	              <li class="">
	                <a href="./javascript.html">首页特色动画管理</a>
	              </li>
	              <li class="">
	                <a href="./customize.html">文件管理</a>
	              </li>
	            </ul>
	          </div>
	        </div>
	      </div>
	    </div>
	    
		<header class="jumbotron subhead" style="background: #666; color: #FFF;  padding-top: 50px; padding-bottom: 50px;">
		  <div class="container" >
		    <h1><b>URBAN</b>life +8629</h1>
		    <p class="lead">现在支持在西安生活的小伙伴们应该写点什么,代码也成</p>
		</div>
		</header>  
		<div class="container">
			<div class="row" >
				<div class="span6">
					
					<div style="display: block; border: 1px solid #333; padding: 10px; padding-left: 20px; margin-top: 15px;">
					    <p style="float: left;padding:  5px;">序列</p>
					    
				    	<p class="control-label" style="float: left;padding:  5px;" id="itemIndex">
				    	<?php
				    		if($_GET){
				    			if($_GET['currentItem']>0 &&$_GET['action']=="up"){
				    		 		echo $_GET['currentItem']-1;
				    		 	}
				    		 	elseif($_GET['action']=="down"){
				    		 		echo $_GET['currentItem']+1;
				    		 	}
				    		 	else {
				    		 		echo $_GET['currentItem'];
				    		 	}
				    		}
				    		else {
				    		  echo "序号";
				    		}
				    	?>
				    	</p>
				    	<div style="padding: auto;text-align: right;">
				    	<button class="btn" id="idxUp" >up</button>
				    	<button class="btn" id="idxDown">down</button>
					    </div>
					</div>
					<p  id="hint">
						<?php
							if($_GET)
							{
								var_dump($_GET);
								if($_GET['action'] == "up"){
									moveUpItem($_GET['currentItem']);
								}
								if($_GET['action'] == "down"){
									moveDownItem($_GET['currentItem']);
								}
							}
						?>
						<?php
							if(isset($_POST) ){
								var_dump($_POST);
								if(isset($_POST['save'])){
									updateXMLChanges($_POST);
								}
								if(isset($_POST['delete'])){
									removeXMLChanges($_POST);
								}
								if(isset($_POST['new'])){
									newXMLChanges($_POST);
								}
							}
						?>
					</p>
					<form class="form-horizontal" method="post">
						
				      <fieldset>
				        <legend >修改动画<select style="float: right; margin-top: 5px;" id="selectItem" name="itemIdx"></select></legend>
				        
				        
				        <div class="control-group">
					        <label class="control-label" >发布日期</label>
					        <div class="controls">
					        	<input type="text" id="form_date" name="date" placeholder="null" >
					        	<span class="hidden">Example block-level help text here.</span>
					        </div>
				       	</div>
				       	<div class="control-group">
				       	    <label class="control-label" >类型</label>
				       	    <div class="controls">
				       	    	<input type="text" id="form_category" name="category" placeholder="null">
				       	    	<span class="hidden">Example block-level help text here.</span>
				       	    </div>
				       	</div>
				       	
				       	<div class="control-group">
				       	    <label class="control-label" >logo_颜色</label>
				       	    <div class="controls">
				       	    	<input type="text" id="form_color_logo" name="color_logo" placeholder="#FFFFFF">
				       	    	<span class="hidden">Example block-level help text here.</span>
				       	    </div>
				       	</div>
		
				        <div class="control-group">
				            <label class="control-label" >覆盖颜色</label>
				            <div class="controls">
				            	<input type="text" id="form_color_over" name="color_over" placeholder="#FFFFFF">
				            	<span class="hidden">Example block-level help text here.</span>
				            </div>
				        </div>
				        
				        <div class="control-group">
				            <label class="control-label" >主图</label>
				            <div class="controls">
				            	<input type="text" id="form_image_main" name="image_main" placeholder="jpg">
				            	
				            	<select id="form_image_main_sel">
				            	<?php print_option($jpgArray); ?>
				            	</select>
				            	
				            	<span class="hidden">Example block-level help text here.</span>
				            </div>
				        </div>
				        
				        <div class="control-group">
				            <label class="control-label" >标题图</label>
				            <div class="controls">
				            	
				            	
				            	<input type="text" id="form_image_title" name="image_title" placeholder="png">
				            
				            	<select id="form_image_title_sel">
				            	<?php print_option($pngArray); ?>
				            	</select>
				            	<span class="hidden">Example block-level help text here.</span>
				            </div>
				        </div>
					    
					    
				        <div class="control-group">
				            <label class="control-label" >标题</label>
				            <div class="controls">
				            	<input type="text" id="form_title" placeholder="" name="title">
				            	<span class="hidden">Example block-level help text here.</span>
				            </div>
				        </div>
				        
				        <div class="control-group">
				            <label class="control-label" >目标</label>
				            <div class="controls">
				            	<input type="text" id="form_link_target" name="_link_target" placeholder="_target">
				            	<span class="hidden">Example block-level help text here.</span>
				            </div>
				        </div>
				        
				        
				        <div class="control-group">
				        	
				        	<input type="submit"  class="btn controls" value="保存" name="save"></input>
				        	<input type="submit"  class="btn" value="删除" name="delete"></input>
				        	<input type="submit"  class="btn " value="新建" name="new"></input>
				        </div>
				      </fieldset>
				    </form>
				</div>
				<div class="span6 center" style="text-align: left;">
					<button id="refresh" class="btn">刷新</button>	
					<div id="normalReview" style="position:absolute;  padding:30px; min-height: 500px; max-width: 300px;">
						
						<h1>+8629 Urbanlife</h1>
						<img id="logo_image" src="upload/0712_saintlaurent.png" alt="" />
						<h1 id="titleL">サンローラン</h1>
						<p>FEATURE</p>
						<p>NEWS</p>
						<p>Think piece</p>
						<p>Store</p>
					</div>
					<div id="hoverReview" style="position:absolute; padding:30px; padding-left: 330px; min-height: 500px; max-width: 300px; ">
						<h1>+8629 Urbanlife</h1>
						<img id="logo_image_hover" src="upload/0712_saintlaurent.png" alt="" />
						<h1 id="titleR">サンローラン</h1>
						<p>FEATURE</p>
						<p>NEWS</p>
						<p>Think piece</p>
						<p>Store</p>
					</div>
					<div  style="padding: 20px; background-color: #000; width: 700px;">
						<!--<div id="background" style="background-color:#F4F4F4; width: 50px; height: 50px;"></div>
						<div id="cover" style="background-color:#FFF; width: 50px; height: 50px;"></div>-->
						<img id="bg_image" src="upload/0712_saintlaurent.jpg" alt="" />
					</div>
				</div>
				<!--<div class="span2 bs-docs-sidebar tabbable tabs-left" >
					<ul class="nav nav-tabs" style="float: right;">
					  <li class="active"><a href="#lA" data-toggle="tab">首页动画</a></li>
					  <li><a href="#lB" data-toggle="tab">Section 2</a></li>
					  <li><a href="#lC" data-toggle="tab">Section 3</a></li>
					</ul>
				</div>
				<div class="span10">
					<div class="tab-content">
					  <div class="tab-pane active" id="lA">
					    <p>动画管理，下面应该是个form,向本页通过POST方法传递确认信息，并更新服务器相应XML</p>
					    <table class="table">
					    	<thead><tr> <th>操作</th><th>时间</th> <th>类型</th> <th>logo颜色</th> <th>覆盖颜色</th> <th>背景图</th> <th>缩略图</th> <th>PNG标题图</th> <th>目标</th> </tr></thead>
					    	<tbody id="tbody"></tbody>
					
					    </table>
					    <button class="btn" id="abc">更新</button>
					    
					  </div>
					  <div class="tab-pane" id="lB">
					    
					  </div>
					  <div class="tab-pane" id="lC">
					    <p>What up girl, this is Section C.</p>
					  </div>
					</div>
				</div>-->
	        </div>
		</div>
		
		
		
			<script src="js/jquery.js" type="text/javascript"></script>
			<script src="js/bootstrap.min.js" type="text/javascript"></script>
		    <script src="managetop.js" type="text/javascript"></script>   				
	</body>
</html>