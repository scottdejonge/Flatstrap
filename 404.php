<?php get_header(); ?>
<div id="content" class="container">
	<div class="row">
		<article class="post col-lg-12">
			<div class="entry">
				<h1 class="post-title"><?php _e('Error 404 - Page Not Found',''); ?></h1>
				<p>The page you are looking for cannot be found.</p>
				<p>Head back to the <a href="<?php bloginfo('url'); ?>">Homepage</a></p>
				<h4>Search</h4>
				<?php get_search_form(); ?>
			</div>
		</article>
	</div> 
</div>
<?php get_footer(); ?>
