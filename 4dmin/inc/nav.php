<?php require_once(dirname(dirname(dirname(__FILE__)))."/app/class.multi.php");
	$xml_path = dirname(dirname(dirname(__FILE__)))."/xml";
	$langs = scandir($xml_path);
	foreach($langs as $key => $lang)
		if($lang == '.' || $lang == '..' || !is_dir($xml_path."/".$lang))
			unset($langs[$key]);
	$html = '';
	if(count($langs)>1)
	{
		$html .= '<div id="lang"><ul>';
		$html_temp ='';
		$first ='';
		if(!isset($_SESSION['lang']))
		{
			$_SESSION['lang']='fr';
			$first = '<li data-lang="fr"><img src="./img/flags/fr.png" /></li>';
			foreach($langs as $lang)
				if($lang!='fr')
					$html_temp .= '<li data-lang="'.$lang.'"><img src="./img/flags/'.$lang.'.png" /></li>';

			$html.=$first.$html_temp;
			$html.="</ul></div>";
		} else {
			foreach($langs as $lang)
				if(isset($_SESSION['lang']) && $lang == $_SESSION['lang'])
					$first = '<li data-lang="'.$lang.'"><img src="./img/flags/'.$lang.'.png" /></li>';
				else
					$html_temp .= '<li data-lang="'.$lang.'"><img src="./img/flags/'.$lang.'.png" /></li>';

			$html.=$first.$html_temp;
			$html.="</ul></div>";
		}
	}
?>

<nav>
	<!--hr /-->
	<ul>
		<?php $page_active = basename($_SERVER['PHP_SELF']); ?>
		<?php
		if(empty($_SESSION['privilege'])!=NULL)
			if($_SESSION['privilege']==0)
			{
		?>
		<li <?php if($page_active == 'index.php')echo 'class="active"'; ?>><a href="./index.php"><i class="icon-th-list"></i>Arborescence</a></li>
		<?php
				}

		$path = dirname(dirname(dirname(__FILE__))).'/xml/admin.xml';
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
				if(isset($multis["multi"]['@attributes']) && $multis["multi"]['@attributes']['lvl'] > 1)
						echo 	'<li><a href="./'.$multis["multi"]['@attributes']['id'].'">'.$multis["multi"]['@attributes']['name'].'</a></li>';
			} else
			foreach($multis["multi"] as $multi)
				if(isset($multi['@attributes']) && $multi['@attributes']['lvl'] > 1)
					echo 	'<li><a href="./'.$multi['@attributes']['id'].'">'.$multi['@attributes']['name'].'</a></li>';
		}
		if(isset($multis["single"])) {
			$i=0;	foreach($multis["single"] as $multi) { if(isset($multi['@attributes']['lvl'])) $i++; }
			if($i==0){
				if(isset($multis["single"]['@attributes']) && $multis["single"]['@attributes']['lvl'] > 1)
						echo 	'<li><a href="./'.$multis["single"]['@attributes']['id'].'">'.$multis["single"]['@attributes']['name'].'</a></li>';
			}else
			foreach($multis["single"] as $multi) {
				if(isset($multi['@attributes'])&& $multi['@attributes']['lvl'] > 1)
					echo 	'<li><a href="./'.$multi['@attributes']['id'].'">'.$multi['@attributes']['name'].'</a></li>';
			}

		}
	?>
	</ul>
	<!--hr /-->
</nav>
