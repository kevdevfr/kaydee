<?php include_once "inc/header.php"; include_once "inc/nav.php";

	require_once('../app/class.nav.php');

	$nav = new Nav();


	if(isset($_POST['name']) && !empty($_POST['name']))
	{
		if(!isset($_POST['parent']))
			$_POST['parent'] = '';

		if(isset($_POST['edit']))
			$nav->editLink($_POST['edit'],$_POST['type'],$_POST['href'],$_POST['name'],$_POST['parent']);
		else
			$nav->newLink(idfy($_POST['name']),$_POST['type'],$_POST['href'],$_POST['name'],$_POST['parent']);
		$nav->save();
		//header('Location: '.$_SERVER['PHP_SELF']);
	} else {
			if(isset($_POST['order'])) {
					$nav->sortOrder($_POST['order'],$_POST['parents']);

			}
	}
	$nav = new Nav();
	if(isset($_GET['a']))
	{
		switch ($_GET['a'])
		{
			case 'down':
				$nav->downElement($_GET['id']);
				$nav->save();
				$nav->adminHtml();
				//header('Location: '.$_SERVER['PHP_SELF']);
			break;
			case 'delete':
				$nav->removeElement($_GET['id']);
				$nav->save();
				$nav->adminHtml();
				//header('Location: '.$_SERVER['PHP_SELF']);
			break;
			case 'hide':
				$nav->hideElement($_GET['id'],1);
				$nav->save();
				$nav->adminHtml();
				//header('Location: '.$_SERVER['PHP_SELF']);
			break;
			case 'show':
				$nav->hideElement($_GET['id'],0);
				$nav->save();
				$nav->adminHtml();
				//header('Location: '.$_SERVER['PHP_SELF']);
			break;
			case 'unlist':
				$nav->hideElementFromList($_GET['id'],1);
				$nav->save();
				$nav->adminHtml();
				//header('Location: '.$_SERVER['PHP_SELF']);
			break;
			case 'list':
				$nav->hideElementFromList($_GET['id'],0);
				$nav->save();
				$nav->adminHtml();
				//header('Location: '.$_SERVER['PHP_SELF']);
			break;
			case 'edit':
				$nav->adminHtml($_GET['id']);
			break;
		}
	}
	else
		$nav->adminHtml();

	include_once "inc/footer.php";

?>
