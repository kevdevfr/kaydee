<?php  require dirname(__FILE__).'/functions.php';
$path = "../ups/tmp/";
$valid_formats = array("jpg","jpeg","png","svg","JPG","JPEG","gif","GIF");

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
{

	if(isset($_POST['action']) && $_POST['action']=='del')
	{
		unlink("../ups/".$_POST['name']);
	} else {
	$name = NULL;
	if(isset($_FILES) && isset(array_values($_FILES)[0]))
	{
		$files = array_values($_FILES)[0];
		if(count($files['name']) > 1)
			for($i = 0;$i < count($files['name']);$i++)
			{
				$name = $files['name'][$i];
				if(strlen($name))
				{
					list($txt, $ext) = explode(".", $name);
					if(in_array($ext,$valid_formats))
					{
							//$actual_image_name = date('Ymdhs').'-'.idfy($name);
							$actual_image_name = idfy($name);

							$tmp = $files['tmp_name'][$i];
							if(move_uploaded_file($tmp, $path.$actual_image_name))
							{
								echo "$".$path.'thumb/'.$actual_image_name."\n";
								// createThumbs($path,$path ,1920);

								//mysql_query("UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
								// echo "<img src='".$path.$actual_image_name."' class='preview'>";
							}
							// else
								// echo "failed";
						// else
							// echo "Image file size max 1 MB";
					}
					// else
						// echo "Invalid file format..";
				}
				// else
				// echo "Please select image..!";
			}
			else {

					$name = $files['name'];
					if(strlen($name))
					{
						list($txt, $ext) = explode(".", $name);
						if(in_array($ext,$valid_formats))
						{
								//$actual_image_name = date('Ymdhs').'-'.idfy($name);
								$actual_image_name = idfy($name);

								$tmp = $files['tmp_name'];
								if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
									echo "$".$path.$actual_image_name."\n";
									// createThumbs($path,$path ,1920);

									//mysql_query("UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
									// echo "<img src='".$path.$actual_image_name."' class='preview'>";
								}
								// else
									// echo "failed";
							// else
								// echo "Image file size max 1 MB";
						}
						// else
							// echo "Invalid file format..";
					}

			}

	}
	exit;
	}
}
?>
