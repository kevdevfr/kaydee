<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="fr-FR" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="fr-FR" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="fr-FR" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="fr-FR" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php if($page->get('meta-title')) echo $page->get('meta-title'); ?></title>
<?php if(is_null($element)){ ?>
	<meta http-equiv="refresh" content="0; URL=<?php echo BASE_URL; ?>">
<?php } ?>
	<meta name="description" content="<?php if($page->get('meta-description')) echo $page->get('meta-description'); ?>">
	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/vendor/magnific-popup.css">
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/vendor/slick/slick.css">
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/normalize.css">
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/fnt.css">
	<link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/style.css">

	<script src="<?php echo TEMPLATE_URL ?>jsc/vendor/modernizr-2.8.3.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>jsc/vendor/jquery-2.1.0.min.js"><\/script>')</script>
	<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>jsc/vendor/slick.js"></script>
	<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>jsc/vendor/jquery.magnific-popup.min.js"></script>
</head>
<body>
	<div class="wrap">
<?php
	require_once('./app/class.nav.php');
	$nav = new Nav();
	echo $nav->standardHTML(BASE_URL, end($_PATH));
?>
