<?php require_once dirname(__FILE__)."/class.single.php";class Mentions extends Single {	public function determinant($determinant) {		switch($determinant)		{			case 'la':				return 'de la';			case 'l\'':				return 'd\'';			case 'les':				return 'des';			default:			case 'le':				return 'du';		}	}	public function HTML(){		$html = '';		if($this->get('Raison Sociale'))		{		$html .= "		<h3>Edition</h3>		<p>MKB Prod<br />		8 rue clovis - 51100 REIMS<br />		RCS Reims : 528 475 254<br />		SIRET : 528 475 254 000 17<br />		contact : webmaster@mkbprod.com<br />		</p>		<h3>Hébérgement</h3>		<p>IKOULA<br />		32 rue du Pont Assy<br />		51100 REIMS<br />		Tél : 01 71 14 00 09<br />		URL : ".$_SERVER['HTTP_HOST']."<br />		<h2>Mentions légales</h2>		<p>".$this->get('Raison Sociale')."<br />		".$this->get('adresse1')."<br />		".$this->get('adresse2')."<br />		".$this->get('adresse3')."<br />		</p>";		$html .= "		<h3>Respect légal - Finalité des données</h3>		<p>Conformément à la Loi Informatique et Libertés du 6 janvier 1978, vous disposez d'un droit		d'accès et de rectification aux données personnelles vous concernant. Si vous souhaitez exercer		ce droit il vous suffit, dans les conditions légales définies ci après, de prendre contact avec notre		service ad hoc via ".$this->get('Mail').". Dans un souci de parfaite confidentialité, ".$this->get('determinant')." ".$this->get('Raison Sociale')." s'engage à ne divulguer aucune information qu'elle est		amenée à détenir sur ses visiteurs, auprès de qui que ce soit.</p>		";		$html .= "<h3>Droit et propriété</h3>		<p>Les photographies, textes, slogans, dessins, images, logos, cartographies, séquences animées		ou non ainsi que toutes oeuvres intégrés dans le site sont la propriété ";		$html .= $this->determinant($this->get('determinant'));		$html .= " ".$this->get('Raison Sociale')." ou de tiers ayant autorisé ".$this->get('determinant')." ".$this->get('Raison Sociale')." à		les utiliser. Les reproductions, sur un support papier ou informatique, dudit site et des documents		qui y sont reproduits sont autorisées dans le seul but de préparer son séjour à ".$this->get('determinant')." ".$this->get('Raison Sociale')." excluant tout usage à des fins publicitaires et/ou		commerciales et/ou d'information et/ou qu'elles soient conformes aux dispositions de l'article		L122-5 du Code de la Propriété Intellectuelle, sans autorisation préalable ";		$html .= $this->determinant($this->get('determinant'));		$html .= " ".$this->get('Raison Sociale').".</p>		";		$html .= "<h3>Liens hypertextes</h3>		<p>La mise en place d'un lien hypertexte ".$_SERVER['HTTP_HOST']." vers le site nécessite une		autorisation préalable écrite ";		$html .= $this->determinant($this->get('determinant'));		$html .=" ".$this->get('Raison Sociale').". Si vous souhaitez		mettre en place un lien hypertexte vers notre site, vous devez en conséquence prendre contact		avec le responsable du site.</p>		<p>".$this->get('determinant')." ".$this->get('Raison Sociale')." ne peut en aucun cas être tenue pour responsable		de la mise à disposition des sites qui font l'objet d'un lien hypertexte à partir du site		".$_SERVER['HTTP_HOST']." et ne peut supporter aucune responsabilité sur le contenu, les produits,		les services, etc. disponibles sur ces sites ou à partir de ces sites.</p>		";		$html .= "<h3>Limitation de responsabilité</h3>		<p>L'utilisateur utilise le site à ses seuls risques. En aucun cas, ni ".$this->get('determinant')." ".$this->get('Raison Sociale').", ni ses partenaires et sous-traitants ne pourront être tenus responsables		des dommages directs ou indirects, et notamment préjudice matériel, perte de données ou de		programme, préjudice financier, résultant de l'accès ou de l'utilisation de ce site ou de tous sites		qui lui sont liés. Le contenu du site est présenté sans aucune garantie de quelque nature que ce		soit. L'accès aux produits et services présentés sur le site peut faire l'objet de restrictions. Vous		devez donc vous assurer que la loi du pays à partir duquel la connexion est établie vous autorise		à accéder à notre site.</p>		";		}		return $html;	}}