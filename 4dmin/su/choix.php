<?php include_once "inc/header.php"; include_once "inc/nav.php";

	require_once('../../app/class.admin.php');

	$admin = new Admin();
	if(isset($_POST['file']))
	{
		$admin->adminFile($_GET['id'],$_GET['name'],$_GET['n'],$_POST['file']);
		$admin->save();
	}
	if(isset($_POST['options']))
	{
		$options = explode('%0D%0A',urlencode($_POST['options']));
		foreach ($options as $key => $value){
				$options[$key] = urldecode($value);
		}

		$admin->adminOptions($_GET['id'],$_GET['name'],$_GET['n'],$options);
		$admin->save();
	}
	if(isset($_POST['content']))
	{
		$admin->adminContent($_GET['id'],$_GET['name'],$_GET['n'],$_POST['content']);
		$admin->save();
	}

	if(isset($_GET))
		$admin->adminChoix($_GET['id'],$_GET['name'],$_GET['n']);

	include_once "inc/footer.php";

?>
