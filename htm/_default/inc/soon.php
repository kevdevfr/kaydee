<?php $html = '<div id="comingsoon">';if($this->get('Logo'))	$html .= '<h1><a href="./"><img src="./ups/config/'.$this->get('Logo').'" /></a></h1>';else{	$html .= '<h1><a href="./">';	if($this->get('Préfixe'))		$html .= '<small>'.$this->get('Préfixe').'</small><br />';	$html .= '<span>'.$this->get('Nom').'</span></a></h1>';}if($this->get('Sous-Titre'))	$html .= '<p class="baseline">'.$this->get('Sous-Titre').'</p>';$html .= '<p>';if($this->get('Adresse 1'))	$html .= '<br />'.$this->get('Adresse 1').' '.$this->get('Adresse 2');if($this->get('Tel') && $this->get('Fax'))	$html .= '<br />Tél: '.$this->get('Tel').' Fax: '.$this->get('Fax');else {	if($this->get('Tel'))		$html .= '<br />'.$this->get('Tel');	if($this->get('Fax'))		$html .= '<br />Fax :'.$this->get('Fax');}if($this->get('Mail'))	$html .= '<br /><a href="mailto:'.$this->get('Mail').'">'.$this->get('Mail').'</a>';$html .='</p>';$html .='<p>';if($this->get('Nom')){$html .='Copyright &copy; '.date('Y');if($this->get('Préfixe'))	$html .=' '.$this->get('Préfixe');$html .=' '.$this->get('Nom').'<br />';}// $html .='<small><a href="http://www.mkbprod.com/" target="_new" >création <img src="./img/gestion/mkb_.svg" /> mkbprod</a></small></p>';$html .='</div>';echo $html;