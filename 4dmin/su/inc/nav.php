
<nav>
	<ul>
		<li><a href="./index.php">Modules</a></li>
		<?php

		$path = dirname(dirname(dirname(dirname(__FILE__)))).'/xml/admin.xml';
		$xml ='';
		if(file_exists( $path))
		{
			$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
			$xmlFile = file_get_contents($path, false, $context);
			$xml = simplexml_load_string($xmlFile, NULL, LIBXML_NOCDATA);
		} else $xml = new SimpleXMLElement('<admin></admin>');
		$multis = json_decode(json_encode($xml), TRUE);
		if(isset($multis["multi"]))
		{
			$i=0;	foreach($multis["multi"] as $multi)	if(isset($multi['@attributes'])) $i++;

			if(count($multis["multi"]) && $i<2)
			{
				if(isset($multis["multi"]['@attributes']) )
					if(!isset($multis["multi"]['@attributes']['lvl']) || (isset($multis["multi"]['@attributes']['lvl']) && $multis["multi"]['@attributes']['lvl']==1 ))
						echo 	'<li><a href="./'.$multis["multi"]['@attributes']['id'].'">'.$multis["multi"]['@attributes']['name'].'</a></li>';
			} else
			foreach($multis["multi"] as $multi)
				if(isset($multi['@attributes']))
					if(!isset($multi['@attributes']['lvl']) || (isset($multi['@attributes']['lvl']) && $multi['@attributes']['lvl']==1 ))
						echo 	'<li><a href="./'.$multi['@attributes']['id'].'">'.$multi['@attributes']['name'].'</a></li>';
		}
		$i=0;	if(isset($multis["single"])) foreach($multis["single"] as $multi)	if(isset($multi['@attributes'])) $i++;

		if($i==1){
			if(isset($multis["single"]['@attributes']) && $multi['@attributes']['id']!='single')
				if(!isset($multis["single"]['@attributes']['lvl']) || (isset($multis["single"]['@attributes']['lvl']) && $multis["single"]['@attributes']['lvl']==1) )
					echo 	'<li><a href="./'.$multis["single"]['@attributes']['id'].'">'.$multis["single"]['@attributes']['name'].'</a></li>';
		}else
			if(isset($multis["single"])) foreach($multis["single"] as $multi)
				if(isset($multi['@attributes']) && $multi['@attributes']['id']!='single')
				if(!isset($multi['@attributes']['lvl']) || (isset($multi['@attributes']['lvl']) && $multi['@attributes']['lvl']==1) )
					echo 	'<li><a href="./'.$multi['@attributes']['id'].'">'.$multi['@attributes']['name'].'</a></li>';


		?>
	</ul>
</nav>
