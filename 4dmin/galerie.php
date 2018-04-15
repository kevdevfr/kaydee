<?php include_once "inc/header.php"; include_once "inc/nav.php";
require_once('../app/class.galerie.php');
?>
<div><input name="galerie-name" id="galerie-name" type="text" style="max-width: 14em;" /><button id="newgallery">Nouvelle Galerie</button><br><br><?php if(isset($_GET['path'])&&$_GET['path']!='.') { ?><button id="delgallery">Supprimer cette Galerie</button><?php } ?>OU sélectionnez une galerie<br /><br /></div>
<?php	$path = '';
	if(isset($_GET['path'])) $path=$_GET['path'];
	else if(isset($_SESSION['galerie'])) $path=$_SESSION['galerie'];
	$_SESSION['galerie'] = $path;

	$galerie = new Galerie($path);
	$galerie->thumbs(500);


	if(isset($_POST['edit']))
	{
		$galerie->editImg($_POST['src'],$_POST['alt'],$_POST['title'],$_POST['size']);
		header('Location: '.$_SERVER['PHP_SELF']);
	}

	if(isset($_GET['a']))
	{
		switch($_GET['a']){
			case 'down':
				$galerie->downElement($_GET['src']);
				$galerie->save();
				$galerie->adminHtml('',$path);
				header('Location: '.$_SERVER['PHP_SELF']);
			break;

			case 'edit':				$galerie->adminHtml($_GET['src'], $path);
			break;

			case 'delete':				$galerie->removeImg($_GET['src'],$path);
				$galerie->save();
				$galerie->adminHtml('',$path);
				// header('Location: '.$_SERVER['PHP_SELF']);
			break;
		}

	} else
		$galerie->adminHtml('',$path);
$galerie->save();
?><div style="clear: right;"></div>
<div class="bloc">
	<div id="html5_uploader" style="">Votre navigateur ne supporte pas le téléchargement natif d'images. Essayez Firefox 3+ or Safari 4+.</div>
</div>
<?php include_once "inc/footer.php"; ?>