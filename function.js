function urldecode (str) {
  // http://kevin.vanzonneveld.net
  // +   original by: Philip Peterson
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: AJ
  // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // +      input by: travc
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Lars Fischer
  // +      input by: Ratheous
  // +   improved by: Orlando
  // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
  // +      bugfixed by: Rob
  // +      input by: e-mike
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // %        note 1: info on what encoding functions to use from: http://xkr.us/articles/javascript/encode-compare/
  // %        note 2: Please be aware that this function expects to decode from UTF-8 encoded strings, as found on
  // %        note 2: pages served as UTF-8
  // *     example 1: urldecode('Kevin+van+Zonneveld%21');
  // *     returns 1: 'Kevin van Zonneveld!'
  // *     example 2: urldecode('http%3A%2F%2Fkevin.vanzonneveld.net%2F');
  // *     returns 2: 'http://kevin.vanzonneveld.net/'
  // *     example 3: urldecode('http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a');
  // *     returns 3: 'http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a'
  return decodeURIComponent((str + '').replace(/\+/g, '%20'));
}
//load json data
function prepareSideData() {
	//加载news Tab，分别是博客,新鲜货，专题，专访（考虑换为公告板）
	//每个加载10条，图片为40*40的图，文字为两行overflow的部分隐藏，更新日期
	/*加载专题*/
//	var items = [];
//	var count = 9;
//	$.getJSON('dataItems.json', function (data) {
//		items.push("<ul>");
//		
//		$.each(data, function(key, val) {
//			//如果是专题
//			if(val['category']=='专题')
//			{
//				count--;
//				console.log("捕捉到一个专题");
//				items.push("<li><a href=\"featureItem.php?uid="+val['uid']+"\" >"
//						  +"<img src=\"\" width=\"40\" height=\"40\" >"
//						  +"<span><strong>"+val['title']+":</strong>"+val['description']+"</span>"
//						  +"<span class=\"list_pubdate\">"+val['date']+"</span></a></li>");
//			}
//			if(count == 0)
//				return false;
//		});
//		items.push("</ul>");
//		$('#sc3').append(items);
//	}); 
}

function prepareFeatureListPage(data) {
	var items = [];
	var count = 0;
	var pagNum = 0;
	var str="";
	$.each(data, function(key, val) {
		if( val['category'] == '专题'){
			count++;
			if( count%10 == 1){
				if(Math.ceil(count/10) == 1)
				str += "<div class=\"_current\" id=\"page"+Math.ceil(count/10)+"\">";
				else {
					str += "<div id=\"page"+Math.ceil(count/10)+"\" style=\"display:none;\">";
				}
				pagNum ++;
				//console.log( "count%10 == 0");
			}
			//console.log("+");
			str += "<div class=\"newsList boxAnchor\" title=\""+val['title']+"\">"
					  +"<p class=\"thumb\"><img src=\""+val['list_thumb']+"\">"
					  +"<h3><a href=\"featureItem.php?uid="+val['uid']+"\">"
					  +"<p>"+val['description']+"</p>"
					  +"<p class=\"data\">"+val['date']+" UP </p></div>";
			if( count%10 == 0){
				str +="</div >";
				//console.log( "count%10 == 9");
			}
			
		}
	});
	
	items.push(str);
	$('#listContent').append(items);
	
	
	//每10个item一个div id为page*
	$('#pagination').paginate({
					count 		: pagNum,
					start 		: 1,
					display     : 10,
					border					: true,
					border_color			: '#fff',
					text_color  			: '#fff',
					background_color    	: 'black',	
					border_hover_color		: '#ccc',
					text_hover_color  		: '#000',
					background_hover_color	: '#fff', 
					images					: false,
					mouse					: 'press',
					onChange     			: function(page){
																$('._current','#listContent').removeClass('_current').hide();
																$('#page'+page).addClass('_current').show();
															  }
	});
}
 

function loadJson(data) {

  var items = [];
  var row;
  $.each(data, function(key, val) {
  	//items.push("");
  	items.push("<tr class=\"item\"><td>"+val['uid']+"</td>"
  				  +"<td>"+val['title']+"</td>"
  				  +"<td>"+val['description']+"</td>"
  				  +"<td>"+val['list_thumb']+"</td>"
  				  +"<td>"+val['date']+"</td>"
  				  +"<td>"+val['arthur']+"</td>"
  				  +"<td>"+val['category']+"</td>"
  				  +"<td><button id=\""+val['uid']+"\" class=\"btn btn-xs\">ed</button></td>");
    items.push("</tr>");
  });
  $('#tbody').append(items);
  
  //打印返回按钮 console.log($(".btn-xs"));
  
  $('.btn-xs').click(function () {
  	$("div.nicEdit-main").html("载入中");
  	console.log( $('.item'));
  	//console.log( $(this).attr('id'));
  	//console.log( $('tr')[3] );
  	var uid = $(this).attr('id');
  	var itemAttr;
  	var selUid;
  	$('.item').each(function (index,domEle) {
  		//console.log(domEle);
  		//console.log("click td=" + domEle.getElementsByTagName('td')[0].innerHTML);
		//console.log("uid = "+uid);
  		if( domEle.getElementsByTagName('td')[0].innerHTML == uid ){
  			console.log(domEle);
  			var itemAttr = domEle.getElementsByTagName('td');
  			console.log("find");
  			
  			$('#formuid').val(itemAttr[0].innerHTML);
  			$('#formTitle').val(itemAttr[1].innerHTML);
  			$('#formDescription').val(itemAttr[2].innerHTML);
  			$('#formList_Thumb').val(itemAttr[3].innerHTML);
  			$('#formDate').val(itemAttr[4].innerHTML);
  			$('#formarthur').val(itemAttr[5].innerHTML);
  			$('#formCategory').val(itemAttr[6].innerHTML);
  			
  			selUid = itemAttr[0].innerHTML;
  			//console.log($("div.nicEdit-main").html());
  		}
  		
  		
  		
  	});
  	//跳转到form
  	var pos = $('#pageForm').offset().top;
  	jQuery("html,body").animate({scrollTop:pos},300);//
  	
  	//var selItem = $('tr')[$(this).attr('id')-1];
  	//var itemAttr = selItem.getElementsByTagName('td');
  	//console.log(itemAttr);
  	//赋值

  	//-----------------------------------------------------------------------
	    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
	    //-----------------------------------------------------------------------
	    $.ajax({                                      
	      url: 'jsonApi.php?',                  //the script to call to get data          
	      data: 'uid='+selUid,                        //you can insert url argumnets here to pass to api.php
	                                       //for example "id=5&parent=6"
	      dataType: 'html',                //data format      
	      success: function(data)          //on recieve of reply
	      {
	        //var id = data[0];              //get id
	        //var vname = data[1];           //get name
	       console.log(urldecode(data));
	        $("div.nicEdit-main").html(urldecode(data));
	        //console.log(data);
	        //--------------------------------------------------------------------
	        // 3) Update html content
	        //--------------------------------------------------------------------
	        //$('#output').html("<b>id: </b>"+id+"<b> name: </b>"+vname); //Set output element html
	        //recommend reading up on jquery selectors they are awesome 
	        // http://api.jquery.com/category/selectors/
	      },
	      error: function(jqXHR,textStatus,errorThrown){
	      	console.log("error");
	      	console.log(jqXHR);
	      	console.log(textStatus);
	      	console.log(errorThrown);
	      } 
	    });
  	
  	
  });
  
}