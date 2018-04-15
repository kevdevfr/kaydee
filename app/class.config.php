<?php require_once dirname(__FILE__)."/class.single.php";class Config extends Single {	public function __construct($xmltag = "single", $elements =		Array(			Array('text', Array( 'id' => 'prefix', 'name' => 'Préfixe')),			Array('text', Array( 'id' => 'name', 'name' => 'Nom')),			Array('text', Array( 'id' => 'suffix', 'name' => 'Suffixe')),			Array('text', Array( 'id' => 'address1', 'name' => 'Adresse 1')),			Array('text', Array( 'id' => 'address2', 'name' => 'Adresse 2')),			Array('text', Array( 'id' => 'addressUrl', 'name' => 'Adresse URL')),			Array('text', Array( 'id' => 'phoneNumber', 'name' => 'Phone Number')),			Array('text', Array( 'id' => 'email', 'name' => 'Email')),			Array('text', Array( 'id' => 'subtitle', 'name' => 'Sous-Titre')),			Array('textarea', Array( 'id' => 'message', 'name' => 'Message')),			Array('text', Array( 'id' => 'fontColor', 'name' => 'Couleur police')),			Array('text', Array( 'id' => 'alternativeColor', 'name' => 'Couleur alt.')),			Array('text', Array( 'id' => 'backgroundColor', 'name' => 'Couleur fond')),			Array('file', Array( 'id' => 'background', 'name' => 'Background')),			Array('text', Array( 'id' => 'backgroundAlpha', 'name' => 'Background Alpha')),			Array('text', Array( 'id' => 'facebook', 'name' => 'Facebook')),			Array('text', Array( 'id' => 'twitter', 'name' => 'Twitter')),			Array('text', Array( 'id' => 'vk', 'name' => 'VK')),			Array('text', Array( 'id' => 'instagram', 'name' => 'Instagram')),			Array('text', Array( 'id' => 'pinterest', 'name' => 'Pinterest')),			Array('text', Array( 'id' => 'linkedin', 'name' => 'LinkedIn')),			Array('text', Array( 'id' => 'github', 'name' => 'GitHub')),			Array('text', Array( 'id' => 'behance', 'name' => 'Behance')),			Array('text', Array( 'id' => 'vimeo', 'name' => 'Vimeo')),			Array('text', Array( 'id' => 'youtube', 'name' => 'Youtube')),			Array('text', Array( 'id' => 'copyright', 'name' => 'Copyright')),			Array('text', Array( 'id' => 'languageCode', 'name' => 'Language Code')),			Array('text', Array( 'id' => 'metaTitle', 'name' => 'Meta-Title')),			Array('text', Array( 'id' => 'metaDescription', 'name' => 'Meta-Description')),			Array('text', Array( 'id' => 'analytics', 'name' => 'Google Analytics')),			Array('textarea', Array( 'id' => 'customCSS', 'name' => 'Custom CSS')),			Array('radio', Array( 'id' => 'maintenance', 'name' => 'Maintenance'), Array('yes' => 'Oui', 'no' => 'Non')),			Array('radio', Array( 'id' => 'legalage', 'name' => 'Legal Age'), Array('yes' => 'Oui', 'no' => 'Non')),			Array('file', Array( 'id' => 'favicon', 'name' => 'Favicon')),			Array('file', Array( 'id' => 'logo', 'name' => 'Logo')),			Array('file', Array( 'id' => 'picto', 'name' => 'Picto')),			Array('theme', Array( 'id' => 'theme', 'name' => 'Theme'))		)	) {    $this->setXMLTag($xmltag);    $this->setElements($elements);		$this->setUploadPath("../ups/cfg/");		$lang = 'fr'; if(isset($_SESSION['lang'])) $lang = $_SESSION['lang'];		$this->setPath(dirname(dirname(__FILE__)).'/xml/'.$lang.'/'.$this->xmltag().'.xml');		if(file_exists( $this -> getPath() ))		{			$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));			$xml = file_get_contents($this ->  getPath(), false, $context);			if ( substr_count ( $xml , '<' ) < 2 )				$this->setXML( new SimpleXMLElement('<'.$this->xmltag().'></'.$this->xmltag().'>') );			else				$this->setXML( simplexml_load_string($xml, NULL, LIBXML_NOCDATA) );		} else			$this->setXML( new SimpleXMLElement('<'.$this->xmltag().'></'.$this->xmltag().'>'));    $xml = $this->getXML();    $xmlChildren = $xml->children();		foreach($elements as $element)			if(!property_exists($xmlChildren,classify($element[1]['name'])))				$xml -> addChild(classify($element[1]['name']));	}}?>