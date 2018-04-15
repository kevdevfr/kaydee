<?php require_once('./app/class.nav.php');
 /*echo '<div class="items">
        <div class="item">
          <button class="cmn-toggle-switch cmn-toggle-switch__rot">
            <span></span>
          </button>
        </div>
        <div class="item">
          <button class="cmn-toggle-switch cmn-toggle-switch__htx">
            <span></span>
          </button>
        </div>
        <div class="item">
          <button class="cmn-toggle-switch cmn-toggle-switch__htla">
            <span></span>
          </button>
        </div>
        <div class="item">
          <button class="cmn-toggle-switch cmn-toggle-switch__htra">
            <span></span>
          </button>
        </div>
      </div>';
*/
$nav = new Nav();
echo '<header>';
echo '<div class="item">
	<button class="cmn-toggle-switch cmn-toggle-switch__htx">
		<span></span>
	</button>
</div>';

$config = new Sing('cfg');
if($config->get('Picto'))
	echo '<h1><a href="'.BASE_URL.'" data-panel="index"><img src="'.$path.'/ups/'.$config->xmlTag().'/'.$config->get('Picto').'" /></a></h1>';
else
	echo '<h1><a href="'.BASE_URL.'" data-panel="index">'.$config->get('Nom').'</a></h1>';

echo '';
echo "<input type='checkbox' id='tap' name='tap' /><nav id='navigation'><div>";
echo "<menu>";
if($id=="booking-links")
	$id="home-link";
$this->standardHTMLRecursive($this -> xml,0,$id,$path);


if($config->get('facebook'))
	echo '<li class="right"><a href="'.$config->get('facebook').'" class="facebook"><img src="'.TEMPLATE_URL.'img/facebook.svg" alt="facebook" /></a></li>';
if($config->get('twitter'))
	echo '<li class="right"><a href="'.$config->get('twitter').'" class="twitter"></a></li>';
if($config->get('instagram'))
	echo '<li class="right"><a href="'.$config->get('instagram').'" class="instagram"></a></li>';
if($config->get('youtube'))
	echo '<li class="right"><a href="'.$config->get('youtube').'" class="youtube"></a></li>';

echo '</div><div>';
echo "</menu></div></nav></header>\n";
?>
