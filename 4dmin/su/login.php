<?php include_once "inc/header.php"; include_once "inc/nav.php";

	require_once('../../php/class.login.php');

	$login = new Login();
	$logins = $login->getJSON();

	print_r($logins);

	include_once "inc/footer.php";

?>
