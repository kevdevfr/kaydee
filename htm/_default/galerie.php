<?php
	include_once(dirname(dirname(dirname(__FILE__))).'/app/class.multi.php');
	$tag = 'galerie';
	$galerie = new Multi($tag);
	$galerie = $galerie->getJSON();
?>
<div><?php
	foreach($galerie['item'] as $image) {
		echo '<a class="gal" href="'.BASE_URL.'ups/'.$tag.'/'.$image['@attributes']['value'].'">';
		echo '<img src="'.BASE_URL.'ups/'.$tag.'/100/'.$image['@attributes']['value'].'" />';
		echo '</a>';
	}
?></div>
<script>
$('section').magnificPopup({
	delegate: 'a.gal',
	type: 'image',
	tLoading: 'Loading image #%curr%...',
	mainClass: 'mfp-img-mobile',
	gallery: {
		enabled: true,
		navigateByImgClick: true,
		preload: [0,1] // Will preload 0 - before current, and 1 after the current image
	},
	image: {
		tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
		titleSrc: function(item) {
			return '';
			// return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
		}
	}
});
</script>
