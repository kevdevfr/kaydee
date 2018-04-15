<?php
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
		if($_POST['action']=='mkdir')
		{
			if($_POST['name']!='')
			{
				$structure = '../ups/img/'.$_POST['name'];

				if (!mkdir($structure, 0777, true)) {
					die('Echec lors de la création des répertoires...');
				}
			}
		}
}
?>
