<?php include_once "inc/header.php"; include_once "inc/nav.php";

	require_once('../../app/class.admin.php');

	$admin = new Admin();

	if(isset($_POST['id']))
	{
		if(isset($_POST['edit']))
			$admin->editAdmin($_POST['n'],$_POST['nom'],$_POST['id'],$_POST['lvl']);
		else
			$admin->newAdmin($_POST['nom'],$_POST['id'],$_POST['type'],$_POST['lvl']);
		$admin->save();
		header('Location: '.$_SERVER['PHP_SELF']);
	}

	if(isset($_GET['a']))
	{
		switch ($_GET['a'])
		{
			case 'delete':
				$admin->removeAdmin($_GET['n']);
				$admin->save();
				$admin->adminList();
				header('Location: '.$_SERVER['PHP_SELF']);
			break;
			case 'edit':
				$admin->adminList($_GET['n']);
			break;
		}
	}
	else
		$admin->adminList();


	include_once "inc/footer.php";

?>
