//global variables
var Items = [];
var colorcase = ["#00a0b0","#edc951","#003b6f","#743466","#9bcd9b","#666","#666","#777",];
var baseColor = ["#FFF","#000","#FFF","#000","#FFF","#000","#FFF","#000","#FFF"]; 
var bgImgs = [];
var pngTitle =[];//"bg/bg1.jpg","bg/bg2.jpg","bg/bg3.jpg","bg/bg4.jpg","bg/bg5.jpg","bg/bg6.jpg"];
var index=0;
//加载存储top信息的XML
function loadTopXML() {
	$.ajax({
	    type: "GET",
		url: "top.xml",
		dataType: "xml",
		cache:false,
		success: function(xml) {
	 		$(xml).find('item').each(function(){
	 			
	 			var item = new Object();
 				
	 			item.date = $(this).attr('date');
				item.category = $(this).attr('category');
				item.color_logo = $(this).attr('color_logo');
				item.color_over = $(this).attr('color_over');
				item.image_main = $(this).attr('image_main');
				item.image_thumb = $(this).attr('image_thumb');
				item.image_title = $(this).attr('image_title');
				item.title = $(this).find('title').text();
				item.link_target = $(this).find('link').attr('target');
				Items.push(item);
				console.log(Items.length);
			});
			for(var i=0; i<Items.length; i++){
				 bgImgs.push(Items[i].image_main);
				 pngTitle.push(Items[i].image_title,Items[i].image_title.split('.')[0]+"_over.png");
				 console.log("here",Items[i].image_main);
			}
			console.log(pngTitle);
			
			//init
			$('#bgImg').attr('src',Items[0].image_main);
			$('#pngTitle').slideDown(1000,function () {$('#pngTitle').attr('src',pngTitle[0]); });
		
			$('#pngTitle').hover(
				function () {$('#pngTitle').attr('src',pngTitle[1]);},
				function () {$('#pngTitle').attr('src',pngTitle[0]);}
			);
			$('.svg').hover(
				function () {$(this).css('fill',"#"+Items[0].color_over);},
				function () {$(this).css('fill',"#"+Items[0].color_logo);}
			);	
		}
		
	});
	
}
function prepareItems() {
	
}
//$('#bgImg').load(function() 
function loadImage(){
	console.log("Image loaded: " + document.getElementById("bgImg").complete);
	//alert("Image loaded: " + document.getElementById("compman").complete);
	resizeHandler();
	maskSlideHidden();
};


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

//导入所有svg文件
function importAllSvgFile() {
	var urls = ["bg/Top_Logo.svg","bg/mainNav_feature.svg","bg/mainNav_local.svg","bg/mainNav_news.svg","bg/mainNav_store.svg","bg/mainNav_think.svg","bg/footLogo.svg"];
	var ids = ["headLogo","mainNavFeature",'mainNavLocal','mainNavStore','mainNavNews','mainNavThink'];
	fetchXML(urls[0],function (SVG){ document.getElementById("headLogo").appendChild(document.importNode(SVG.documentElement,true)); });
	fetchXML(urls[1],function (SVG){ document.getElementById("mainNavFeature").appendChild(document.importNode(SVG.documentElement,true)); });
	fetchXML(urls[2],function (SVG){ document.getElementById('mainNavLocal').appendChild(document.importNode(SVG.documentElement,true)); });
	fetchXML(urls[3],function (SVG){ document.getElementById('mainNavStore').appendChild(document.importNode(SVG.documentElement,true)); });
	fetchXML(urls[4],function (SVG){ document.getElementById('mainNavNews').appendChild(document.importNode(SVG.documentElement,true)); });
	fetchXML(urls[5],function (SVG){ document.getElementById('mainNavThink').appendChild(document.importNode(SVG.documentElement,true)); });
	fetchXML(urls[6],function (SVG){ document.getElementById('footLogo').appendChild(document.importNode(SVG.documentElement,true)); });
}
	

//$('#update').load('data.txt');
//
//$.get('data.xml',function(data,right,type){
//	console.log(right);
//	console.log(type);
//});

//基础点击反映
$('#content').click( function () {
	
//	$(this).css("border","5px solid").delay(1000).css("background-image","url('bg/bg2.jpg')");
	alert("abc");
});

function svgColorTransform(id,newcolor) {
	//console.log($(id));
	//console.log(newcolor);
	$(id).animate({
	    opacity: 0,
	  }, 500 ,function () {
	  	$(id).css("fill",newcolor);
	  	$(id).animate({ opacity: 1, }, 500 );
	  });

}

//color animation sample
//字体颜色动画
//$('#headLogoDiv').click(function () {
//	$('#headLogoDiv').animate({
//	    opacity: 0.25,
//	  }, 500 ,function () {
//	  	$('#headLogoDiv').css("fill","white");
//	  	$('#headLogoDiv').animate({ opacity: 1, }, 500 );
//	  });
//
//});

//set backgroundWarper size
function adjustSize() {
	var bg = $('#bgImg');
	$('#backgroundWarper').width($(window).width()-300);
	$('#backgroundWarper').height($(window).height());
	var docRatio = bg.width() /bg.height();
	var winRatio = ($(window).width()-300)/$(window).height();
	if(docRatio<winRatio)
	{
		bg.width($(window).width()-300);
		bg.height("auto");
	}
	else {
		bg.width("auto");
		bg.height($(window).height());
	}
}
//改变浏览器尺寸时的图片自适应
function resizeHandler() {
	var bg = $('#bgImg');
	var docRatio = bg.width() /bg.height();
	var winRatio = ($(window).width()-300)/$(window).height();
	if(docRatio<winRatio)
	{
		bg.width($(window).width()-300);
		bg.height("auto");
	}
	else {
		bg.width("auto");
		bg.height($(window).height());
	}	
	$('#backgroundWarper').width($(window).width()-300);
	$('#backgroundWarper').height($(window).height());
}
$(window).resize(resizeHandler); 


//文档完成时的操作，主要是改变背景图 
$(document).ready(function () {

	loadTopXML();
	
	
	//$('#bgImg').attr('src',Items[0].image_main);
	
	prepareItems();
	//setInterval(myTimer,3000);
	//setTimeout(showNextTop, 3000);
	importAllSvgFile();
	adjustSize();
	$('#mask').width = $(window).width;
	

});


//周期改变背景图 

var item_num = -1;

function maskSlideShow() {
	//console.log("item_num>7",item_num>7);
	item_num = item_num>7?0:item_num+1;
	//1.mask slide
	//2.change image
	//changeImage();
	$('#mask').css('left','0');
	$('#mask').animate({
	    width: $(document).width() - $('#side').width()
	  }, 'slow',changeImage);
	
	
}
function maskSlideHidden() {
	//3.mask slide
	$('#mask').animate({
	    width: 0,
	    left: $(document).width() - $('#side').width()
	  }, 'slow');
	  
	//4.svg gradient change
	console.log(Items[index].color_logo);
	var color = "#"+Items[index].color_logo;
	svgColorTransform("#headLogo",color);
	svgColorTransform("#mainNavFeature",color);
	svgColorTransform("#mainNavLocal",color);
	svgColorTransform("#mainNavStore",color);
	svgColorTransform("#mainNavNews",color);
	svgColorTransform("#mainNavThink",color);
	svgColorTransform("#footLogo",color);
	
	
	//$("#mainNav li").mouseover('fill',colorcase[item_num]);
	//$("#mainNav li :hover").css('fill',colorcase[item_num]);
	setTimeout(maskSlideShow, 5000);
}
function changeImage() {

	index =	bgImgs.indexOf($('#bgImg').attr('src'));
	if(index < bgImgs.length-1){
		index ++;
	}
	else{
		index = 0;
	}
	
	$('#bgImg').attr('src',bgImgs[index]);
	$('#mainTitle').slideUp(function () { 
		$('#pngTitle').attr('src',pngTitle[index*2]);
		$(this).slideDown(1000);
	});
	$('#pngTitle').hover(
		function () {$('#pngTitle').attr('src',pngTitle[index*2+1]);},
		function () {$('#pngTitle').attr('src',pngTitle[index*2]);}
	);
	$('.svg').hover(
		function () {$(this).css('fill',"#"+Items[index].color_over);},
		function () {$(this).css('fill',"#"+Items[index].color_logo);}
	);	
}


