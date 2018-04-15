<?php
echo "<div class='".$currentPage."-container' id='".$currentPage."-container'>";
foreach($element as $child)
	if($child['hidden']!=1)
		switch ($child['type'])
		{
			case 'module':
				include(dirname(__FILE__).'/container.module.php');
			break;
			default:
				include(dirname(__FILE__).'/container.page.php');
			break;
		}
echo "</div>";
