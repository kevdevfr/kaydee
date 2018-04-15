<?php
$path = "../ups/tmp/";
$valid_formats = array("jpg","jpeg","png","svg","pdf");
if(isset($_POST['src']) and $_SERVER['REQUEST_METHOD'] == "POST")
{
	$src = str_replace($path,'',$_POST['src']);
	if(file_exists($path.$src))
		copy($path.$src,"../ups/www/".$src);

	$files = glob($path.'*');
	foreach($files as $file){
		if(is_file($file))
			unlink($file);
	}

} else echo "Erreur";
?>
