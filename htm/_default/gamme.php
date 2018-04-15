<?php include_once(dirname(dirname(__FILE__)).'/app/functions.php');
			include_once(dirname(dirname(__FILE__)).'/app/class.gamme.php');

			$gamme = new Gamme();
?>
<menu>
<?php
		$categs = $gamme->typeList();
		$first = true;
		// foreach($categs as $categ)
		// {
			// if($first) { echo "<li class='active'>"; $first = false; } else { echo "<li>"; }
			// echo '<a href="#'.idfy($categ).'">'.$categ.'</a>';
			// echo "</li>";
		// }
?>
</menu>
<?php		
		foreach($categs as $categ)
			$gamme->typeHTML((String) $categ);
?>
