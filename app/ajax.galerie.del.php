<?php session_start();
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
		$_SESSION['galerie'] = '';
		if($_POST['action']=='rmdir')
		{
			if($_POST['name']!='')
			{
				$structure = '../ups/img/'.$_POST['name'];
				if (!rmdir($structure)) {
					die('Echec lors de la suppression des répertoires...');
				}
			}
		}
}
?>
