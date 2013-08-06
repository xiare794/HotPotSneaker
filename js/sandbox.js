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

var colors = ["#F33","#000","#FFF","#3EA","#A24"];
var step = 0;
function svgColorTransition() {
	//fade out
	//$("#svg").css("opacity","0").fadeOut(300);
	//slide
	$("#svg").slideUp(300);
	
	//color change
	setTimeout(changeColor, 400);
	//fade in 
	//$("#svg").css("opacity","1").fadeIn();
	//loop
	step++;
	step = step>=4? 0:step;	
	
}

function svgFadeIn() {
	//fade
	//$("#svg").css("opacity","1").fadeIn(1000);
	//slide
	$("#svg").slideDown(1000);
	
	setTimeout(svgColorTransition, 2000);
}

//change svg color
//function setSVGColor(SVG,color) {
//	/
//	var items = SVG.getElementsByTagName('path');
//
//	for(var i=0; i<items.length; i++)
//	{
//		//console.log(items[i].getAttribute("fill"));
//		items[i].setAttribute("fill",color);
//		//console.log(items[i].getAttribute("fill"));
//	}
//	var n = document.importNode(SVG.documentElement,true);
//	document.getElementById("svg").appendChild(n);
//}


function changeColor() {
	var items = $("path");
	for(var i=0; i<$("path").length; i++)
	{
		$("path")[i].setAttribute("fill", colors[step]);
	}
	setTimeout(svgFadeIn, 500);
}

$(document).ready(function () {
	fetchXML('img/Top-Logo.svg',function (SVG){
		var n = document.importNode(SVG.documentElement,true);
		document.getElementById("svg").appendChild(n);
		//setSVGColor(SVG,'lime')}
		});
	setTimeout(svgColorTransition, 1500);	
	//console.log("is setSVGColor function? ",$.isFunction(setSVGColor));
	
	
	console.log("bgImage width:",$("#bgImage").width(),"bgImage height:",$("#bgImage").height(),"ratio=",$("#bgImage").width()/$("#bgImage").height());
	console.log("window.width=",$(window).width(),"window.height=",$(window).height());
	console.log("div width:",$("#update").width(),"div height:",$("#update").height());
	//$("#update").css("width","800");
	//$("#update").css("height","600");
	$("#update").resize(function () {
		console.log("resize function");
	})
	$("#update").width(900);
	console.log("after set .width = 900",$("#update").width());
});



window.onclick = function () {
	console.log($("#svg"));
	console.log("bgImage width:",$("#bgImage").width(),"bgImage height:",$("#bgImage").height(),"ratio=",$("#bgImage").width()/$("#bgImage").height());
	console.log("window.width=",$(window).width(),"window.height=",$(window).height());
	console.log("div width:",$("#update").width(),"div height:",$("#update").height());
	
	
	
	//$("#update").css("max-width",$(window).width()-300);
	//$("#update").css("height",$(window).height());
	var res = [$(window).width(),$(window).height()-$("#content").height()];
	var restRatio = res[0]/res[1];
	//console.log($("#bgImage").attr("naturalHeight"));
	
	//natural size
	var theImage = new Image();
	theImage.src = $("#bgImage").attr("src");
	 console.log("original size:",theImage.width,theImage.height);
	$("#bgImage").css("max-width", $("#update").width());
	//$("#bgImage").css("width","100%");
	//$("#bgImage").css("max-width",$(window).width()-300);
	//$("#bgImage").css("height","100%");
};









