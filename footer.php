	</div>
	
	<footer>
		<div class="container">
			<p class="pull-left">&copy;<?php echo date("Y"); echo " "; bloginfo('name'); ?>.</p>
			<?php wp_nav_menu( array('theme_location' => 'footer-menu', 'container_class' => 'nav', 'menu_class' => 'pull-right hidden-phone', 'menu_id' => 'menu')); ?>
		</div>
	</footer>
	
	<?php wp_footer(); ?>

</body>

</html>
