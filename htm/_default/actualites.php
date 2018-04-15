<?php
	require_once(dirname(dirname(__FILE__)).'/app/class.actualites.php'); $actualites = new Actualites();
	$actualites = $actualites->getJSON();
?>

<div id="actus">
<?php
	$first = true;
	foreach($actualites as $actualite)
	{
?>
	<div class="actualite<?php if($first) {echo ' active';$first=false;}?>">
<?php 	if(!empty($actualite['photo'])) {
?>
	<div class="actualite-head" style="background-image:url(ups/actualites/<?php echo $actualite['photo']; ?>)"></div>
<?php	}
?>
	<article id="actus">
	<div class="date"><?php echo date("d-m-Y",strtotime($actualite['date'])); ?></div>
	<div><h4><?php echo $actualite['titre']; ?></h4>
	<?php echo encodeHTML($actualite['texte']); ?></div>

	<div class="pagination"><a href='#next' class="next">Article précédent</a> <a style="display: none;" href='#prev'class="prev">Article suivant</a></div>
	</div>
	</article>
<?php
	}
?>
</div>
