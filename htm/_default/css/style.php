<?php require_once('../app/class.theme.php'); $theme = new Theme();
header("Content-type: text/css"); 
?>
body {
<?php $value = $theme->get('Fond'); if($value)echo "background-color: ".$value.";"; ?> 
<?php $value = $theme->get('Texte'); if($value)echo "color: ".$value.";"; ?> 
<?php $value = $theme->get('Image Fond'); if($value)echo "background-image:url(../ups/".$value.")"; ?> 
}