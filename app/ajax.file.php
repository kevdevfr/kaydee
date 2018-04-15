<?php  require dirname(__FILE__).'/functions.php';
$path = "../ups/tmp/";
$valid_formats = array("pdf","mp4");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{
	if(isset($_POST['action']) && $_POST['action']=='del')
	{
		unlink("../ups/".$_POST['name']);
	} else {
	$name = NULL;
	if(isset($_FILES))
	{
		foreach($_FILES as $file)
		{
				$name = $file['name'];

			if(strlen($name))
			{
				list($txt, $ext) = explode(".", $name);
				if(in_array($ext,$valid_formats))
				{
						$actual_image_name = idfy($name);

						$tmp = $file['tmp_name'];

						if(move_uploaded_file($tmp, $path.$actual_image_name))
						{
							echo "$".$path.$actual_image_name;
						}
						else
							echo "error#Copie echouée";
				}
				else
					echo "error#Format de fichier invalide";
			}
			else
				echo "Error#envoyez un fichier";
		}

	}
	exit;
	}
}
?>
