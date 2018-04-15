<?php
echo '<section class="';
echo implode(' ',$_PATH);
echo " ".$child['id'];
echo '" id="'.$child['id'].'"><div class="width">';
$page = new Pages($child['id']);

if(!empty($page->getBackground('background')))
{
  echo '<div class="background-container">';
  foreach($page->getBackground('background') as $background)
    echo '<div class="background" style="background-image:url('.BASE_URL.'ups/htm/1080/'.$background.')"></div>';
  echo '</div>';
}

echo '<article><div>'.encodeHTML($page->get('contenu')).'</div></article>';

echo "</div></section>\n";
