<?php get_header(); ?>
	<div class="row">
		<article class="post span12">
			<div class="entry">
				<h1 class="post-title"><?php _e('Error 404 - Page Not Found',''); ?></h1>
				<p>The page you are looking for cannot be found.</p>
				<p>Head back to the <a href="<?php bloginfo('url'); ?>">Homepage</a></p>
				<?php get_search_form(); ?>
			</div>
		</article>
	</div> 
<?php get_footer(); ?>
