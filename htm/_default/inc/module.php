<?php
if($element['href']!="container")
{
echo '<section class="module-'.$element['href'].' ';
echo implode(' ',$_PATH);
echo '" id="'.$currentPage.'"><div class="width">';
$page = new Pages($currentPage);

if(!empty($page->getBackground('background')))
{
  echo '<div class="background-container">';
  foreach($page->getBackground('background') as $background)
    echo '<div class="background" style="background-image:url('.$background.')"></div>';
  echo '</div>';
}

if(!empty($page->get('contenu')))
echo '<article><div>'.encodeHTML($page->get('contenu')).'</div></article>';

include(dirname(dirname(__FILE__)).'/'.$element['href'].'.php');
echo "</div></section>";
} else {
  $page = new Pages($currentPage);
  echo '<article>'.encodeHTML($page->get('contenu')).'</article>';
  include(dirname(dirname(__FILE__)).'/container.php');
}
