<?php
echo '<section class="';
if (end($_PATH)!="")
echo implode(' ',$_PATH);
else echo "index";
echo '" id="'.end($_PATH).'"><div class="width">';
if(end($_PATH)=="") $page = new Pages("index");
else
$page = new Pages(end($_PATH));


if(!empty($page->getBackground('background')))
{
  echo '<div class="background-container">';
  foreach($page->getBackground('background') as $background)
    echo '<div class="background" style="background-image:url('.BASE_URL.'ups/htm/'.$background.')"></div>';
  echo '</div>';
}

if(!empty($page->get('contenu')))
echo '<article><div>'.encodeHTML($page->get('contenu')).'</div></article>';

echo "</div></section>\n";
