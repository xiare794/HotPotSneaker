//for(var i = 0; i<100; i++){
var req = new XMLHttpRequest();
//if(window.XMLHttpRequest){
//	req = new XMLHttpRequest();
//}
//else{
//	req = new ActiveXObject("Microsoft.XMLHTTP");
//}

req.open('GET','data.xml');

req.onreadystatechange = function (){
	if((req.readyState === 4) && (req.status === 200))
	{
		console.log(req.responseXML.getElementsByTagName('title'));
	
		var items = req.responseXML.getElementsByTagName('title');
		var output = '<ul>';
		for (var i = 0; i < items.length; i++) {
			output += '<li>' + items[i].firstChild.nodeValue + '</li>';
		}
		output += '</ul>';
		document.getElementById('update').innerHTML = output;
	}
	
}
req.send();
	//}
