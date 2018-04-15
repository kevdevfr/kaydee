<?php if(!isset($_GET['id'])) exit(); include_once('../../app/functions.php');  include_once "inc/header.php"; if(!isset($_GET['rel'])) include_once "inc/nav.php";

		$path = dirname(dirname(dirname(__FILE__))).'/xml/admin.xml';
		$xml ='';
		if(file_exists( $path))
		{
			$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
			$xmlFile = file_get_contents($path, false, $context);

			$xml = simplexml_load_string($xmlFile, NULL, LIBXML_NOCDATA);
		} else $xml = new SimpleXMLElement('<admin></admin>');

		$multis = json_decode(json_encode($xml), TRUE);
		$multis = xml2array($xml);


		$id = $_GET['id'];
		$objet = Array();
		$objetType = 'multi';

		if(isset($multis["multi"]))
		{
			foreach ($multis["multi"] as $sxe) {
				if(isset($sxe['id']) && $sxe['id'] == $id){
					$objet = $sxe;
					$objetType = "multi";
				}
			}
		}
		if(isset($multis["single"]))
		{
			foreach ($multis["single"] as $sxe) {
				if(isset($sxe['id']) && $sxe['id'] == $id){
					$objet = $sxe;
					$objetType = "single";
				}
			}
		}
		if(empty($objet)) exit();

		$objetId = $id;
		unset($objet['@attributes']);

		$arrayOfArrays = Array();
		foreach($objet->children() as $key=>$element) {
			$options = Array();
			if(isset($element->option))
				$options = $element->option;
			if(!empty($options))
				$arrayOfArrays[]= Array($key,Array('id' => $element['id'], 'name' => $element['name']),$options);
			else
				$arrayOfArrays[]= Array($key,Array('id' => $element['id'], 'name' => $element['name']));
		}

		if($objetType=="multi")
		{

			require_once('../../app/class.multi.php');

			$donnees = new Multi($objetId,	$arrayOfArrays);

			if(!empty($_POST))
			{
				$donnees->newElement($_POST);
				$donnees->save();
				header('Location: '.$_SERVER['REQUEST_URI']);
			}
			unset($_GET['id']);
			if(!empty($_GET))
			{
				if(!isset($_GET['rel']))
					$donnees->adminHtml($_GET);
				else
					$donnees->adminRel($_GET);

			}
			else
				$donnees->adminHtml();
		}

		if($objetType=="single")
		{
			require_once('../../app/class.sing.php');
			$donnees = new Sing($objetId,	$arrayOfArrays);

			if(!empty($_POST))
			{
				$donnees->update($_POST);
				$donnees->save();
				header('Location: '.$_SERVER['REQUEST_URI']);
			}
			$donnees->adminHtml();
		}
?>
<?php if(!isset($_GET['rel'])) include_once "inc/footer.php"; ?>
