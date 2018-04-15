<?php
	require_once(dirname(dirname(__FILE__)).'/app/class.champagne.php'); $champagnes = new Champagne();
	
	$champagnes = array_reverse($champagnes->getJSON());
?>
<div class="slides">
<?php
	foreach($champagnes as $champagne)
	{
?>
	<div class="article <?php echo classify($champagne['nom']) ?>" style="background-image: url('ups/champagne/<?php echo $champagne['photo']; ?>');">

	<div class="cuvee"><div><h3><?php echo $champagne['nom']; ?></h3>
	<?php if(!empty($champagne['description']))echo encodeHTML($champagne['description']); ?>
	
	<?php if(!empty($champagne['suggestion'])) { echo "<h4>Suggestion du Chef</h4>"; echo encodeHTML($champagne['suggestion']); }?>
	
	<?php if(!empty($champagne['recompenses'])) {echo "<h4>Récompenses</h4>";  echo encodeHTML($champagne['recompenses']); } ?>
	</div>
	</div>
	<div><?php if(!empty($champagne['fiche-technique'])) {  echo "<a target='_blank' href='ups/champagne/".$champagne['fiche-technique']."'>Télécharger la fiche technique</a>"; } ?></div>
	</div>
<?php
	}
?>
	
</div>
