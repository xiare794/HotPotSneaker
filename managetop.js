var Items = [];
var currentIdx = 0;

function updateCurrentItem() {
	//更新表格部分
	currentIdx = $("#selectItem").val();
	console.log("selectItem  = "+currentIdx);
	$('#form_date').val(Items[currentIdx].date);
	$('#form_category').val(Items[currentIdx].category); 
	$('#form_color_logo').val(Items[currentIdx].color_logo); 
	$('#form_color_over').val(Items[currentIdx].color_over); 
	$('#form_image_main').val(Items[currentIdx].image_main); 
	$('#form_thumb').val(Items[currentIdx].image_thumb); 
	$('#form_image_title').val(Items[currentIdx].image_title); 
	$('#form_title').val(Items[currentIdx].title); 
	$('#form_link_target').val(Items[currentIdx].link_target);
	$('#itemIndex').html(parseInt(currentIdx)+1); 
	
	//更新预览部分
	$('#bg_image').attr('src',Items[currentIdx].image_main);
	$('#logo_image').attr('src',Items[currentIdx].image_title);
	$('#logo_image_hover').attr('src',Items[currentIdx].image_title.split('.')[0]+"_over.png");
	$('#normalReview').css('color','#'+$('#form_color_logo').val());
	$('#hoverReview').css('color','#'+$('#form_color_over').val());
	//设置刷新等待标示
}

//主图响应
$("#form_image_main_sel").on('change',function () {
	//update input by select
	console.log($('#form_image_main_sel').val());
	console.log($('#form_image_main').val());
	$('#form_image_main').val( $('#form_image_main_sel').val());
	//update image by input
	$('#bg_image').attr('src',$('#form_image_main').val());
});
$("#form_image_main").blur(function () {
	//update image by input
	console.log("blur");
	$('#bg_image').attr('src',$('#form_image_main').val());
})

//logo响应
$("#form_image_title_sel").on('change',function () {
	//update input by select
	console.log($('#form_image_title_sel').val());
	console.log($('#form_image_title').val());
	$('#form_image_title').val( $('#form_image_title_sel').val());
	//update image by input
	$('#logo_image').attr('src',$('#form_image_title').val());
});
$("#form_image_title").blur(function () {
	//update image by input
	console.log("blur");
	$('#logo_image').attr('src',$('#form_image_title').val());
})

//颜色文字响应
$('#refresh').click(function () {
	var color = '#'+$('#form_color_logo').val();
	var hover = '#'+$('#form_color_over').val();
	$('#normalReview').css('color',color);
	$('#hoverReview').css('color',hover);
	$('#titleL').html($('#form_title').val());
	$('#titleR').html($('#form_title').val());
	//console.log($('#normalReview'));
	
});
//after add/delete/save action
function reloadXMLFile() {
	$.ajax({
		        type: "GET",
			url: "top.xml",
			dataType: "xml",
			cache:false,
			success: function(xml) {
				var output = "";
				
				var idx = 0;
				
				if( $.isNumeric($('#itemIndex').html()) ){
					idx = parseInt($('#itemIndex').html());
				}
				console.log("itemIndex="+idx);
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
				});
				
				//update select component
				var selOpt = "";
				var selcount = 0;
				for(var i=0; i<Items.length; i++){
					selOpt += "<option value = '"+i+"'>"+i+Items[i].title+"</option>";
				}
				//$("#tbody").html ( output );
			$("#selectItem").html(selOpt);
			$("#selectItem").val(idx);
			console.log(Items);
			updateCurrentItem();
		}
		
	});


}

$(document).ready(function () {
	reloadXMLFile();
	console.log("reload xml once");
});


//$("#selectItem").blur(function () { alert("blur")});
$("#selectItem").on('change',function () {
	updateCurrentItem();
	
});

$('#idxUp').click(function () {
	//moveup function
	console.log("move up item");
	if($("#selectItem").val()>0)
		document.location.href= "?currentItem="+currentIdx+"&action=up";
	
});
$('#idxDown').click(function () {
	//movedown function
	console.log("move down item");
	if($("#selectItem").val()<$("#selectItem option").length-1)
		document.location.href= "?currentItem="+currentIdx+"&action=down";
});
//$("#selectItem").onchange(function () { alert("change")});
//$("#selectItem").mouseUp(function () { alert("mouseUp")});















