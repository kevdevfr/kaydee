<?php
require_once('../app/functions.php');

if(!isset($_GET['id'])) exit();

header("Content-type: text/csv; charset=utf-8");
header("Content-Disposition: attachment; filename=".$_GET['id'].time().".csv");
header("Pragma: no-cache");
header("Expires: 0");


		$path = dirname(dirname(__FILE__)).'/xml/admin.xml';
		$xml ='';
		if(file_exists( $path))
		{
			$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
			$xmlFile = file_get_contents($path, false, $context);

			$xml = simplexml_load_string($xmlFile, NULL, LIBXML_NOCDATA);
			if(count($xml->children())==1) /**/;

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
					if(isset($sxe['sql'])&&$sxe['sql']==1)
						$sql = true;
					else
						$sql = false;
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
			require_once('../app/class.multi.php');
			$donnees = new Multi($objetId,	$arrayOfArrays);
		}

		if($objetType=="single")
		{
			require_once('../app/class.sing.php');
			$donnees = new Sing($objetId,	$arrayOfArrays);
		}

		$donnees = $donnees->getJSON();

		$row = Array();
    foreach($arrayOfArrays as $donnee)
			$row[] = (String)$donnee[1]['id'];
		echo implode(',',$row)."\r\n";


    foreach($donnees as $donnee)
    {
			$row = Array();
			foreach($donnee as $value) {
				if(!is_array($value))
					$row[] = $value;
			}
			echo implode(',',$row)."\r\n";
		}
