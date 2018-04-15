<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="fr-FR" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="fr-FR" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="fr-FR" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="fr-FR" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php if($config->get('prefixe')) echo $config->get('prefixe').' '; echo $config->get('nom'); ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/normalize.css">
        <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/maintenance.css">
    </head>
    <body>
				<div class='wrap'><?php

        $html = '<div id="comingsoon">';

if($config->get('Logo'))
	$html .= '<h1><a href="./"><img src="'.BASE_URL.'ups/cfg/'.$config->get('Logo').'" /></a></h1>';
else
{
	$html .= '<h1><a href="./">';
	if($config->get('Préfixe'))
		$html .= '<small>'.$config->get('Préfixe').'</small><br />';
	$html .= '<span>'.$config->get('Nom').'</span></a></h1>';
}
if($config->get('Sous-Titre'))
	$html .= '<p class="baseline">'.$config->get('Sous-Titre').'</p>';
$html .= '<p>';
if($config->get('Adresse 1'))
	$html .= '<br />'.$config->get('Adresse 1').' '.$config->get('Adresse 2');
if($config->get('Tel') && $config->get('Fax'))
	$html .= '<br />Tél: '.$config->get('Tel').' Fax: '.$config->get('Fax');
else
{
	if($config->get('Tel'))
		$html .= '<br />'.$config->get('Tel');
	if($config->get('Fax'))
		$html .= '<br />Fax :'.$config->get('Fax');
}
if($config->get('Mail'))
	$html .= '<br /><a href="mailto:'.$config->get('Mail').'">'.$config->get('Mail').'</a>';
$html .='</p>';
$html .='<p>';
if($config->get('Nom'))
{
$html .='Copyright &copy; '.date('Y');
if($config->get('Préfixe'))
	$html .=' '.$config->get('Préfixe');
$html .=' '.$config->get('Nom').'<br />';
}
// $html .='<small><a href="http://www.mkbprod.com/" target="_new" >création <img src="./img/gestion/mkb_.svg" /> mkbprod</a></small></p>';
$html .='</div>';

echo $html;

         ?></div>
    </body>
</html>
