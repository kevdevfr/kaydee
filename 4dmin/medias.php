<?php include_once "inc/header.php"; include_once "inc/nav.php"; 
require_once('../app/class.galerie.php');

	$the_dir = 'www';
	if(isset($_GET['d']))
	{
		$the_dir = $_GET['d'];
	}

	if(isset($_GET['a']))
	{
		switch($_GET['a']){
			case 'delete':
				if(isset($_GET['file']))
					unlink("../ups/".$the_dir."/".$_GET['file']);
				header('Location: '.$_SERVER['PHP_SELF']);
			break;
		}

	}

	$directory = dirname(dirname(__FILE__)).'/ups/';
	$scanned_directory = array_diff(scandir($directory), array('..', '.'));

	echo '<select style="max-width: 10em;margin: 0 auto;display: block;margin: 1em auto;" onchange="window.location.href=\''.$_SERVER['PHP_SELF'].'?d=\' + this[this.selectedIndex].value">';
	foreach($scanned_directory  as $file)
	{
		if(is_dir($directory.$file) && $file!='img' && $file!='tmp')
		{
			echo '<option value="'.$file.'"';
			if($file==$the_dir) echo 'selected';
			echo '>'.$file.'</option>';
		}
	}
	echo '</select>';
?>
	<div class='popup-gallery medias'>
<?php
	$directory = dirname(dirname(__FILE__)).'/ups/'.$the_dir.'/';
	$scanned_directory = array_diff(scandir($directory), array('..', '.'));

	foreach($scanned_directory  as $file)
	{
		if(!is_dir($directory.$file))
		{
			echo '<div class="media" style="background-image: url(../ups/'.$the_dir.'/'.$file.')">';
			echo '<button onclick="javascript:deleteMedia(\''.$file.'\')"><i class="icon-cancel-1"></i></button>';
			echo '<a href="../ups/'.$the_dir.'/'.$file.'" title="'.$file.'">';
			echo '<img src="../img/vide.png">';
			echo '</a>';
			echo '</div>';
		}
	}

?>
	</div>
	<script type='text/javascript'>
		function deleteMedia(media) {
			if(confirm("Le media '" + media + "' va être supprimé."))
			{
				window.location.href = "<?php echo $_SERVER['PHP_SELF'] ?>?d=<?php echo $the_dir; ?>&a=delete&file=" + media;
			}
		}
	</script>
<?php include_once "inc/footer.php"; ?>
