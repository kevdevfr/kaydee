<?php include_once "inc/header.php"; include_once "inc/nav.php";

	require_once('../../app/class.admin.php');

	$admin = new Admin();

	if(isset($_POST['id'])&&isset($_POST['nom'])&&isset($_POST['action']))
	{
		switch($_POST['action']) {
			case 'new':
				$admin->newElement($_POST['type'],$_POST['id'],$_POST['nom'],$_POST['adminid']);
				$admin->save();
				$admin->adminHTML($_GET['id'],$_GET['name']);
			break;
			case 'edit':
				$admin->editElement($_POST['type'],$_POST['id'],$_POST['nom'],$_POST['adminid'],$_GET['n']);
				$admin->save();
				$admin->adminHTML($_GET['id'],$_GET['name']);
			break;
			default:
			$admin->adminHTML($_GET['id'],$_GET['name']);

		}
	} else
	if(isset($_GET['id'])&&isset($_GET['name']))
	{
		if(isset($_GET['a']))
		{
			switch($_GET['a']) {
				case 'delete':
					$admin->removeElement($_GET['n'],$_GET['id']);
					$admin->save();
					$admin->adminHTML($_GET['id'],$_GET['name']);
				break;
				case 'edit':
					$admin->adminHTML($_GET['id'],$_GET['name'],$_GET['n']);
				break;
				default:
					$admin->adminHTML($_GET['id'],$_GET['name']);
				break;
			}

		} else
					$admin->adminHTML($_GET['id'],$_GET['name']);

	}
	include_once "inc/footer.php";

?>
