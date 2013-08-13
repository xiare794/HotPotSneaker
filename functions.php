<!--//manage xml function-->
<?php 

	function moveUpItem($index) {
		$file = 'top.xml';
		//$index = 1;
		$item = 'item';
		
		//echo "start test xml-php<br>";
		$dom = new DomDocument();
		$dom->load($file);
		//element
		$domEle = $dom->documentElement;
		$dom->getElementsByTagName($item)->length;
		if($index>0 && $dom->getElementsByTagName($item)->length>$index){
			//检查被移动节点是否可上移
			$upNodeClone = 	$dom->getElementsByTagName($item)->item($index)->cloneNode(true);
			$dwNodeClone = 	$dom->getElementsByTagName($item)->item($index-1)->cloneNode(true);
			
			$domEle->replaceChild ($upNodeClone,$dom->getElementsByTagName($item)->item($index-1));
			$domEle->replaceChild ($dwNodeClone,$dom->getElementsByTagName($item)->item($index));
			//echo '<pre>' . htmlspecialchars($dom->saveXML()) . '</pre>';
			$dom->save($file);
			return true;
		}
		return false;
		//保存
	}
	function moveDownItem($index) {
		$file = 'top.xml';
		$item = 'item';
		$dom = new DomDocument();
		$dom->load($file);
		$domEle = $dom->documentElement;
		//$dom->getElementsByTagName($item)->length;
		if($index>-1 && $dom->getElementsByTagName($item)->length>$index+1){
			//检查被移动节点是否可上移
			$upNodeClone = 	$dom->getElementsByTagName($item)->item($index+1)->cloneNode(true);
			$dwNodeClone = 	$dom->getElementsByTagName($item)->item($index)->cloneNode(true);
			
			$domEle->replaceChild ($upNodeClone,$dom->getElementsByTagName($item)->item($index));
			$domEle->replaceChild ($dwNodeClone,$dom->getElementsByTagName($item)->item($index+1));
			//echo '<pre>' . htmlspecialchars($dom->saveXML()) . '</pre>';
			$dom->save($file);
			return true;
		}
		return false;
		//保存
	}
	
	function print_option($array) {
		echo "<option>选图</option>";
		for($i = 0; $i<count($array); $i++){	
			echo "<option>";
			echo $array[$i];
			echo "</option>";
		}
	}
	//更新item
	function updateXMLChanges($data) {
		$dom = new DomDocument();
		$dom->load('top.xml');
		$domEle = $dom->documentElement;
		$xp = new DomXPath($dom);
		$query = "//item";
		//echo "<br>保存操作<br>";echo "<br>";
		$res = $xp->query($query);
		
		//print_r($data);
		if ($res->length > $data['itemIdx']){
			//did find query
			//echo"did find query";
			$res = $res->item($data['itemIdx']);
			
			$res->setAttribute('date',$data['date']);
			$res->setAttribute('category',$data['category']);
			$res->setAttribute('color_logo',$data['color_logo']);
			$res->setAttribute('color_over',$data['color_over']);
			$res->setAttribute('image_main',$data['image_main']);
			$res->setAttribute('image_title',$data['image_title']);
			$res->getElementsByTagName("title")->item(0)->nodeValue = $data['title'];
			$res->getElementsByTagName("link")->item(0)->setAttribute('target',$data['_link_target']);
			//echo '<pre>' . htmlspecialchars($dom->saveXML()) . '</pre>';
			$dom->save("top.xml");
		}
	}
	//删除item
	function removeXMLChanges($data) {
		$dom = new DomDocument();
		$dom->load('top.xml');
		$domEle = $dom->documentElement;
		$xp = new DomXPath($dom);
		$res = $xp->query("//item");
		//检查长度
		$len = $dom->getElementsByTagName('item')->length;
		if($len>$data['itemIdx']){
			//检查是否是同一元素，以title为例子
			//var_dump($res->item($data['itemIdx'])->getElementsByTagName('title'));
			$title = $res->item($data['itemIdx'])->getElementsByTagName("title")->item(0)->nodeValue;
			
			if($title === $data['title'])
			{
				$domEle->removeChild($dom->getElementsByTagName('item')->item($data['itemIdx']));	
				$dom->save("top.xml");
				echo "delete item@@@ save";
			}
			echo "delete item@@@";
		}
	}
	
	//新建item
	function newXMLChanges($data) {
		$dom = new DomDocument();
		$dom->load('top.xml');
		$domEle = $dom->documentElement;
		$xp = new DomXPath($dom);
		$res = $xp->query("//item");
		$len = $dom->getElementsByTagName('item')->length;
		//检查长度
		$newNode = 	$dom->getElementsByTagName('item')->item(0)->cloneNode(true);
		$domEle->appendChild($newNode);	
		
		$newNode->setAttribute('date',"");
		$newNode->setAttribute('category',"");
		$newNode->setAttribute('color_logo',"");
		$newNode->setAttribute('color_over',"");
		$newNode->setAttribute('image_main',"");
		$newNode->setAttribute('image_title',"");
		$newNode->getElementsByTagName("title")->item(0)->nodeValue = "";
		$newNode->getElementsByTagName("link")->item(0)->setAttribute('target'," ");
		$dom->save("top.xml");
	}	
 ?>
 
 
 
 
 
 
 
 
 
 