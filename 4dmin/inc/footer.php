				<div id="margin"></div>
			</div>
			<footer>
				<p><?php echo getcwd(); ?> - Kaydee Version BETA - &copy; 2014 Kevin Mouchené - kmouchene@gmail.com</p>
			</footer>
<?php
			if( is_dir( '../admin' ) ) /* if not installed, */
				$msg = '<p>Change the name of the admin/ folder after saving.</p>'."\n";

			if(!empty($msg))
				echo '<div class="msg">'.$msg.'</div>';
?>


    </body>
</html>
