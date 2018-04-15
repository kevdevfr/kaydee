<?php include_once "inc/header.php"; include_once "inc/nav.php";
require_once('../app/class.sing.php');
require_once('../app/class.config.php');

$cfg = new Config('cfg');

if(!empty($_POST))
{
	$cfg->update($_POST);
	$cfg->save();
	header('Location: '.$_SERVER['REQUEST_URI']);
}
$cfg->adminHtml();

include_once "inc/footer.php";
/*
require_once('../app/class.page.php');
require_once('../app/class.nav.php');

if(isset($_GET['path']))
$currentPage = $_GET['path'];
else
$currentPage = 'index';

$page = new Page($currentPage);

if(isset($_POST['savePage']))
{
	foreach($_POST['article'] as $article)
	$article=addslashes($article);
	foreach($_POST['anchor'] as $anchor)
	$article=addslashes($anchor);
	$page->updateArticles($_POST['article'],$_POST['anchor']);
	$page->updateSEO($_POST['meta-title'],$_POST['meta-description']);
	$page->save();
	header('Location: '.$_SERVER['REQUEST_URI']);
}
if(isset($_POST['bg']))
{
	$compress = false; if(isset($_POST['compress'])) $compress = $_POST['compress'];
	$page->updateBackground(idfy($_POST['bg']),$compress,$currentPage);
	$page->save();
	// header('Location: '.$_SERVER['PHP_SELF']);
}
$nav = new Nav();
$nPages = $nav->allList();
if(count($nPages)>0)
{
	echo '<select name="cms" class="sub">';
	foreach	( $nPages as $nPage)
	{

		if($currentPage == $nPage[0])
		echo '<option selected';
		else
		echo '<option';
		echo ' value="'.$nPage[0].'" >'.$nPage[1]." --- ".$nPage[0].'</option>';
	}
	echo '</select>';
}
?><form name='bgs' action='<?php echo $_SERVER['PHP_SELF']; if($currentPage!='index')echo '?path='.$currentPage; ?>' method='POST'>
	<div style="display: inline-block;">
		<?php echo $page->bgInput(); ?>
	</div><div style="display: inline-block;">
		<input type='submit' value='Ajouter' style="display: inline-block;"/>
		<span style="line-height: 2em;"><input type='checkbox' name='compress' style="vertical-align: middle;" checked />1080p</span>
	</div>
</form><form name='page' enctype='multipart/form-data' action='<?php echo $_SERVER['PHP_SELF']; if($currentPage!='index')echo '?path='.$currentPage; ?>' method='POST'>
	<?php echo $page->seoForm($currentPage,$_SERVER['PHP_SELF']); ?>
	<hr>
	<div style="max-width: 50%;display:inline-block;vertical-align:top;">
		<?php echo $page->form(); ?>
		<input type='hidden' name='savePage' value='true'>
		<div>
			<div style='display:inline-block;vertical-align:top;text-align:left; width: 70%;'>
				<button type='button' onclick='addTextarea();'>+ article</button>
				<button type='button' onclick='editorHelp();'>Aide</button>
				<a class='popup-with-form' href='#media'>Ajout Média</a>
			</div>
			<div style='display:inline-block;vertical-align:top;text-align:right; width: 29%;'>
				<input type='submit' value='Enregistrer'/>
			</div>
		</div>
		<div id='editorhelp' style='display:none;'>
			<table>
				<tr>
					<td>*italique*</td><td><em>italique</em></td>
				</tr><tr>
					<td>**gras**</td><td><strong>gras</strong></td>
				</tr><tr>
					<td>[mkbprod](http://mkbprod.com)</td><td><a href='mkbprod.com'>mkbprod</a></td>
				</tr><tr>
					<td>* élément 1<br />* élément 2<br />* élément 3</td><td><li>élément 1</li><li>élément 2</li><li>élément 3</li></td>
				</tr><tr>
					<td>> citation</td><td><blockquote>citation</blockquote></td>
				</tr><tr>
					<td>--barré--</td><td><strike>barré</strike></td>
				</tr><tr>
					<td>en^indice</td><td>en<sup>indice</sup></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="articleRender" style="width: 49%;display:inline-block;vertical-align:top">
		<?php $page->allArticles(); ?>

	</div>
</form>
<form id='media' name='media' class='white-popup-block mfp-hide'>
	<h3>Ajout de Média</h3>
	<p>
		<input type='file' name='media' />
		<span class='thumb'></span>
	</p>
	<button>Insérer dans l'article</button>
</form>


<script type='text/javascript'>
	function addTextarea() {
		var form = document.forms['page'];

		var textareas = Array.prototype.slice.call(document.getElementsByTagName('textarea'));
		var anchors = Array.prototype.slice.call(document.getElementsByName('anchor[]'));

		var textarea = textareas[textareas.length-1].cloneNode(true);
		var anchor = anchors[anchors.length-1].cloneNode(true);

		textarea.value = '';
		anchor.value = '';

		form.appendChild(anchor);
		form.appendChild(textarea);

	}
	function editorHelp() {
		var help = document.getElementById('editorhelp');

		if(help.style.display == 'none')
		help.style.display = 'block';
		else
		help.style.display = 'none';
	}
</script>
<?php
include_once "inc/footer.php"; */ ?>
