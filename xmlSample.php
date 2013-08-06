
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
	
<html lang="ch">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
	<?php 
		//加载或创建
		echo "start test xml-php<br>";
		$dom = new DomDocument();
		$dom->load('sample.xml');
		//element
		$domEle = $dom->documentElement;
		//DomXPath
		$xp = new DomXPath($dom);
		
		// "//item[@color_logo = 'D2EFDF']" 寻找item的属性color_logo为D2EFDF的Node集合 用->item(index)再调用对应位置
		
		$nodeName = "item"; //could be items/item/title/link 
		$key = "@color_logo";
		$value = "FFFFFF";
		$query = "//".$nodeName."[".$key." = '".$value."']";
		$query = "//item";
		echo $query;
		$res = $xp->query($query);
		if ($res->length > 0){
			//did find query
			echo"did find query";
			$res = $res->item(0);
			//属性操作
			
			
			
			
			//子节点操作
			echo "<br>子节点操作<br>";echo "<br>";
			//1.访问修改item的对应属性
			echo "item: ".$res->getAttribute('image_main');
			echo "<br>";echo "<br>";
			$res->setAttribute('category','3q');
			//2.访问修改item子节点的文字
			var_dump($res->getElementsByTagName("title")->item(0)->textContent);
			echo "<br>";
			var_dump( $res->getElementsByTagName("title")->item(0)->nodeValue );echo "<br>";
			//修改使用nodeValue = 
			$res->getElementsByTagName("title")->item(0)->nodeValue = "not sacai";
			
			
			
			//echo( $res->childNodes->length);
			//var_dump( $res->childNodes->item(0)->nodeValue );echo "<br>";echo "<br>";
			//var_dump( $res->childNodes->item(1)->textContent );echo "<br>";echo "<br>";
			//var_dump( $res->childNodes->item(2) );echo "<br>";echo "<br>";
			//var_dump( $res->childNodes->item(3) );echo "<br>";echo "<br>";
			//var_dump( $res->childNodes->item(4) );echo "<br>";echo "<br>";
			//var_dump( $res->childNodes->item(5) );echo "<br>";echo "<br>";
			echo "<br>";echo "<br>";echo "<br>";echo "<br>";
			//echo var_dump($res->fisrtChild);
			echo "<br>";
			//echo var_dump( $res);//.hasChildNodes();
			//echo $res->setAttributes("image_title","http");
			
		}
		//最下面添加一节点
		/*if(1){
			//检查节点是否在第一个位置
			$nodeA = $dom->getElementsByTagName("item")->item(1);
			//$nodeB = $nodeA->cloneNode(true);
			$dom->documentElement->appendChild($nodeA);
		}*/
		//将位置2的节点移到位置1，位置一下调到位置2
		if(1){
			//检查被移动节点是否可上移
			$upNodeClone = 	$dom->getElementsByTagName("item")->item(1)->cloneNode(true);
			$dwNodeClone = 	$dom->getElementsByTagName("item")->item(1-1)->cloneNode(true);
			
			$domEle->replaceChild ($upNodeClone,$dom->getElementsByTagName("item")->item(0));
			$domEle->replaceChild ($dwNodeClone,$dom->getElementsByTagName("item")->item(1));
		}
		echo  $dom->getElementsByTagName("item")->length;
		//删除节点
		//$domEle->removeChild ($dom->getElementsByTagName("item")->item(1));
		
		echo '<pre>' . htmlspecialchars($dom->saveXML()) . '</pre>';
//		$newNode = $dom->createElement("item");
//		$newNode->nodeValue = "new Node text";
//		$newNode->setAttribute('category','FEATURE');
//		
//		$items = $dom->documentElement;
//		$items->appendChild($newNode);
		//$res->appendChild($newNode);
		
		$dom->save("234.xml");
	
	
	 ?>
	 </body>
</html>