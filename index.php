<?php  session_start();

date_default_timezone_set('Europe/Paris');
require_once('./app/class.sing.php'); 
require_once('./app/class.pages.php'); 
require_once('./app/class.nav.php'); 
$config = new Sing('cfg');
$param = new Sing('prmtrs');

/** glob var BASE_URL & TEMPLATE_URL **/
define('BASE_URL',str_replace($_SERVER['DOCUMENT_ROOT'],'',str_replace(basename($_SERVER['SCRIPT_FILENAME']),'',$_SERVER['SCRIPT_FILENAME'])));
$theme = '_default'; if($param->get('theme')) $theme = $param->get('theme'); define('TEMPLATE_URL',BASE_URL.'htm/'.$theme.'/');

/** Check if maintenance is on **/
if( !$config->get('Maintenance') )
{
	if( is_dir( 'admin' ) )
		header( 'Location: ./admin/' );
	exit;
} else
if ( $config->get('Maintenance')=='Oui' )
{
	include('./htm/'.$theme.'/inc/maintenance.php'); exit();
}
/** Control the location, setting up location var **/

$_PATH=array('');
$currentPage = '';
if(isset($_GET['path'])) {

		$_PATH = explode('/',$_GET['path'] );

		if(strlen($_PATH[0])==2 && isset($_PATH[1])) {
			$_SESSION['lang'] = $_PATH[0];
			array_shift($_PATH);
		} else
			if(isset($_SESSION['lang'])) unset($_SESSION['lang']);

		if(!empty(end($_PATH)))
			$currentPage = str_replace('/','',end($_PATH));

}

/** HEADER **/
$nav = new Nav();
if($currentPage=='') $currentPage ='index';

$element = $nav->getElement($currentPage);
if(!$element || ( isset($_PATH[0]) && $_PATH[0]=='index') || empty($_PATH) ) {
	$element = $nav->getElement('404');
	$_PATH[0]= '404';
	$currentPage = '404';
}


$page = new Pages($currentPage);
include(dirname(__FILE__).'/htm/'.$theme.'/inc/header.php');

/** CURRENT PAGE **/
switch ($element['type'])
{
	case 'module':
		include(dirname(__FILE__).'/htm/'.$theme.'/inc/module.php');
	break;

	case 'container':
		include(dirname(__FILE__).'/htm/'.$theme.'/inc/container.php');
	break;

	default:
		include(dirname(__FILE__).'/htm/'.$theme.'/inc/page.php');
	break;
}
echo '<input name="next" type="hidden" value="'.$nav->navNext($currentPage).'" />';

/** FOOTER **/
include(dirname(__FILE__).'/htm/'.$theme.'/inc/footer.php');
?>
