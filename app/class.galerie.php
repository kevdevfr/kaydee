<?php require_once('class.multi.php');class Galerie {	private $xml;	private $path;	private $dir;	public function __construct( $path = '' ) {		$lang = 'fr'; if(isset($_SESSION['lang'])) $lang = $_SESSION['lang'];		if ($path != '.')			$this -> path = dirname(dirname(__FILE__)).'/xml/'.$lang.'/img/'.$path.'.xml';		else			$this -> path = dirname(dirname(__FILE__)).'/xml/'.$lang.'/img/img.xml';		$this -> dir = $path;		if(file_exists( $this -> path))		{			$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));			$xml = file_get_contents($this -> path, false, $context);			if ( substr_count ( $xml , '<' ) < 2 )				$this -> xml = new SimpleXMLElement('<galerie></galerie>');			else				$this -> xml = simplexml_load_string($xml);		} else			$this -> xml = new SimpleXMLElement('<galerie></galerie>');			if($path!='')		$directory = dirname(dirname(__FILE__)).'/ups/img/'.$path.'/';		else		$directory = dirname(dirname(__FILE__)).'/ups/img/';		$scanned_directory = array_diff(scandir($directory), array('..', '.'));		foreach($scanned_directory  as $file)		{			if(!is_dir($directory.$file))			{				$element = $this->xml->xpath('//img[@src=\''.$file.'\']');				if( empty ( $element ) )				{					$img = $this->xml->addChild('img');					$img->addAttribute('src', $file);					$img->addAttribute('alt', preg_replace("/\\.[^.\\s]{3,4}$/", "", $file));					$img->addAttribute('title', preg_replace("/\\.[^.\\s]{3,4}$/", "", $file));				}			}		}	}	public function editImg($src,$alt,$title) {		foreach( $this -> xml -> children() as $element)			if( $element['src'] == $src )			{				$element['alt'] = $alt;				$element['title'] = $title;				return true;			}		return false;	}	public function removeElement($src) {		foreach( $this -> xml -> children() as $element)			if( $element['src'] == $src )			{				$dom=dom_import_simplexml($element);				$dom->parentNode->removeChild($dom);				return true;			}		return false;	}	public function removeImg($src) {		foreach( $this -> xml -> children() as $element)			if( $element['src'] == $src )			{				$dom=dom_import_simplexml($element);				$dom->parentNode->removeChild($dom);				if(isset($_SESSION['galerie']))				unlink("../ups/img/".$_SESSION['galerie'].'/'.$element['src']);				return true;			}		return false;	}	public function adminHtml($src='',$path){		$img_path = dirname(dirname(__FILE__))."/ups/img";		$galleries = scandir($img_path);		foreach($galleries as $key => $gallery)			if($gallery == '..' || !is_dir($img_path."/".$gallery))				unset($galleries[$key]);		$html = '<select name="galerie">';		foreach($galleries as $gallery)		{			$html .= '<option value="'.$gallery.'"';			if($path == $gallery) $html .= ' selected';			$html .= '>'.$gallery.'</option>';		}		$html.="</select>";		$html.="<form name='galerie' action='".$_SERVER['REQUEST_URI']."' data-galerie='".$path."' method='POST'><table>";		$el = array('src'=>-1);		$count=0;		foreach( $this -> xml -> children() as $element)		{				$html.="<div class='img'>";			if($src==$element['src'])			{				$html.="<div><img src='../ups/img/".$path."/".$element['src']."' /></div>";				$html.="<div class='text'><input type='text' name='alt' value=\"".htmlentities($element['alt'])."\" /></div>";				$html.="<div><input type='hidden' name='edit' value='".$element['id']."' />";				$html.="<input type='hidden' name='src' value='".$element['src']."' />";				$html.="<input type='submit' value='Enregistrer' /></div>";				$html.="</div>";			} else {				$html.="<div><img src='../ups/img/".$path.'/'.$element['src']."' /></div>";				$html.="<div><a href='".$_SERVER['PHP_SELF']."?a=edit&src=".$element['src']."&path=".$path."'><i class='icon-pencil'></i></a> <a href='".$_SERVER['PHP_SELF']."?a=delete&src=".$element['src']."'><i class='icon-block'></i></a>";				if($el['src']!=-1)					$html.=" <a href='".$_SERVER['PHP_SELF']."?a=down&src=".$el['src']."'><i class='icon-up-open'></i></a>";				else					$html.=" <i class='icon-up-open'></i>";				$html.=" <a href='".$_SERVER['PHP_SELF']."?a=down&src=".$element['src']."'><i class='icon-down-open'></i></a></div>";			}			$html.="</div>";			$el = $element;		}		$html.="</table></form>";		echo $html;	}	public function HTML($path) {		$imgs = $this -> xml -> children();		if(count($imgs)){			$html ='';			$largeur = 100/round(.25+sqrt(count($imgs)));			$hauteur = 100/round(sqrt(count($imgs)));			echo '<!-- '.round(sqrt(count($imgs)))." ".sqrt(count($imgs))." ".count($imgs).'-->';			// $largeur = 0;			// $hauteur = 0;			foreach( $this -> xml -> children() as $element)			{				//$html .= "<div class='img' style='width: ".$largeur."%; height: ".$hauteur."%;background-image: url(".$path.'ups/img/'.$this->dir.'/'.$element['src'].")'>";				$html .= "<div class='img' style='background-image: url(".$path.'ups/img/'.$this->dir.'/'.$element['src'].")'>";				$html .= "<span>".$element['title']."</span>";				//$html .= "<a href='".$path.'ups/img/'.$this->dir.'/'.$element['src']."' title=\"".htmlentities($element['alt'])."\">";				$html .= "<img src='".TEMPLATE_URL."img/vide.png' alt=\"".htmlentities($element['alt'])."\"/>";				//$html .= "</a>";				$html .= "</div>";				// var_dump( $element );			}		} else			$html = 'Pensez à ajouter des photos dans la galerie !';		echo $html;	}	public function thumbs() {	}	public function masonry($path) {		$imgs = $this -> xml -> children();		if(count($imgs)){			$html ='<div class="grid-sizer"></div>';			foreach( $this -> xml -> children() as $element)				$html .= "<div class='grid-item'><div><a class='pop' href='".$path.'ups/img/'.$this->dir.'/'.$element['src']."' title='".$element['alt']."'><img class='img' src='".$path.'ups/img/'.$this->dir.'/'.$element['src']."' alt=\"".htmlentities($element['alt'])."\" width='432'/></a>				<div class='alt'>".$element['alt']."</div></div></div>";		} else			$html = 'Pensez à ajouter des photos dans la galerie !';		echo $html;	}	public function first($path, $galPath) {		$galeries = new Multi('galerie');		$galeries = $galeries->getJSON();		$noms = Array();		foreach($galeries as $gal) {			$noms[$gal['gallery']] = $gal['nom'];		}		$imgs = $this -> xml -> children();		$first = true;		if(count($imgs)){			$html ='';			foreach( $this -> xml -> children() as $element)			{				if($first)				{						$nom = $this -> dir;						if(isset($noms[$nom])) $nom = $noms[$nom];						$html .= "<div class='grid-item'>						<div class='cover'>						<a href='".$galPath."/".$this -> dir."'>							<div class='img' style='background-image: url(".$path.'ups/img/'.$this->dir.'/'.$element['src'].")'></div>						</a>						<div class='alt gall'>".ucfirst($nom)."</div>						</div>						</div>";				/*				<img class='img' src='".$path.'ups/img/'.$this->dir.'/'.$element['src']."' alt=\"".htmlentities($element['alt'])."\" width='432'/>					$html .= "<div class='item'>";					$html .= '<a href="feel-the-atmosphere/'.$this -> dir.'">';					$galeries = new Multi('gallery');					$galeries = $galeries->getJSON();					foreach($galeries as $galerie)						if($galerie['id']==	$this -> dir)						{							if(isset($galerie['nom']) && !empty($galerie['nom']))								$html .=  '<span>'.$galerie['nom'].'</span>';							if(isset($galerie['date']) && !empty($galerie['date']))								$html .=  '<span>'.date("m/d/y", strtotime($galerie['date'])).'</span>';						}					$html .= "<div class='img' style='background-image: url(".$path.'ups/img/'.$this->dir					.'/'.$element['src'].")' alt=\"".htmlentities($element['alt'])."\"/></div></a></div>";*/					$first = false;				}			}		} else			$html = 'Pensez à ajouter des photos dans la galerie !';		echo $html;	}	public function downElement($src) {		$next = false;		foreach( $this -> xml -> children() as $element)		{			if($next)			{				$next = false;				$this->removeElement($el['src']);				$this->simplexml_insert_after($el,$element);				return true;			}			if( $element['src'] == $src )			{				$el = $element;				$next = true;			}		}		return false;	}	public function save() {		$dom = new DOMDocument('1.0', 'utf-8');		$dom->preserveWhiteSpace = false;		$dom->formatOutput = true;		$dom->loadXML($this -> xml -> asXML());		$dom->save( $this -> path );	}	public function listing( $path ) {		$array = Array();		$directory = dirname(dirname(__FILE__)).'/ups/img/';		$scanned_directory = array_diff(scandir($directory), array('..', '.'));		foreach($scanned_directory  as $file)			$array[] = $file;		foreach($array as $link)		{			echo '<a href="'.$path.'/'.$link.'">';				$tmpGalerie = new Galerie($link);				$tmpGalerie->first('');			echo '</a>';		}		return $array;	}	public function homeListing( $path ) {		$array = Array();		$imgs = new Multi('gallery');		$imgs = $imgs->getJSON();		$directory = dirname(dirname(__FILE__)).'/ups/img/';		$scanned_directory = array_diff(scandir($directory), array('..', '.'));		$count = 0;		foreach($imgs  as $file)			$array[] = $file['id'];		foreach($array as $link)		{			if($count<6)			{					$tmpGalerie = new Galerie($link);					$tmpGalerie->first('');				$count++;			}		}		for($i=$count;$i<8;$i++) {			echo "<div class='item'></div>";		}		return $array;	}	function simplexml_insert_after(SimpleXMLElement $insert, SimpleXMLElement $target)	{		$target_dom = dom_import_simplexml($target);		$insert_dom = $target_dom->ownerDocument->importNode(dom_import_simplexml($insert), true);		if ($target_dom->nextSibling) {			return $target_dom->parentNode->insertBefore($insert_dom, $target_dom->nextSibling);		} else {			return $target_dom->parentNode->appendChild($insert_dom);		}	}}?>