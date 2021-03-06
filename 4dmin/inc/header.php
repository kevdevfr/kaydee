<?php session_start();

	if(basename(dirname(dirname(dirname(__FILE__))))!=basename($_SERVER['DOCUMENT_ROOT']))
		define('BASE_URL', "/".basename(dirname(dirname(dirname(__FILE__))))."/");
	else
		define('BASE_URL', "/");

	include_once('../app/functions.php');

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="fr-FR" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="fr-FR" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="fr-FR" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="fr-FR" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="<?php echo BASE_URL; ?>htm/_default/css/normalize.css">
        <link rel="stylesheet" href="./css/admin.css">
        <link rel="stylesheet" href="./css/fontello.css">
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>htm/_default/css/vendor/magnific-popup.css">
				<!--link rel="stylesheet" href="<?php echo BASE_URL; ?>htm/_default/jsc/plupload/jquery.plupload.queue/css/jquery.plupload.queue.css" type="text/css" media="screen" /-->

				<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
				<script>window.jQuery || document.write('<script type="text/javascript" src="./jsc/vendor/jquery-2.1.0.min.js"><\/script>')</script>
				<script type="text/javascript" src="./jsc/vendor/jquery.magnific-popup.min.js"></script>
				<script type="text/javascript" src="./jsc/vendor/jquery-ui/jquery-ui.min.js"></script>
				<script type="text/javascript" src="./jsc/admin.js"></script>

    </head>
    <body class="showmsg">
<?php
	if(isset($_POST['utilisateur']) && isset($_POST['motdepasse']))
	{
		require_once "../app/class.login.php";
		$class = '';
		$login = new Login($_POST['utilisateur']);
		if($login->confirmer($_POST['motdepasse']))
		{
			$_SESSION['connexion'] = "administrateur";
			$_SESSION['utilisateur'] = $_POST['utilisateur'];
			$_SESSION['privilege'] = $login->getPrivilege();
		} else { $class="error"; }

	}
	if(isset($_POST['administrator']) && isset($_POST['password']))
	{
		require_once "../app/class.login.php";
		$login = new Login();
		$login->createAdmin($_POST['administrator'],$_POST['password']);
	}
	if(!isset($_SESSION['connexion']))
	{
		$class = '';
		require_once "../app/class.login.php";
		$login = new Login();
		echo $login->loginForm($_SERVER['PHP_SELF'],$class);
		exit();
	}

	$msg = '';
?>
		<div class="wrap">
			<header>
				<ul class="links">
						<li><a href="./deconnexion.php">Se déconnecter<i class="icon-logout"></i></a> </li>
						<li><a href="./su/">Gestion Admin<i class="icon-cog"></i></a></li>
						<li><a href="../">Voir le Site<i class="icon-bookmark"></i></a></li>
				</ul>
				<h1><?php echo $_SERVER['SERVER_NAME'];?></h1><h2>Gestion</h2>
			</header>
