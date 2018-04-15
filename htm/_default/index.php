<?php  require_once(dirname(dirname(__FILE__)).'/app/class.config.php');
		$config = new Config();
?>
<div id='head'><?php
if($config->get('Logo'))
	echo '<img src="'.BASE_URL.'ups/'.$config->xmlTag().'/'.$config->get('Logo').'" />'; 
?></div>
