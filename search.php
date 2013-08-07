<?php get_header(); ?>

	<?php get_breadcrumbs(); ?>
	
	<div id="content" class="container">
	
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-title entry">Search Results for: "<?php the_search_query(); ?>"</h1>
			</div>
		</div>
		
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="row">
				<article class="post col-lg-8" id="post-<?php the_ID(); ?>">
					<div class="entry">
						<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>
					</div>
				</article>
			</div>	
		<?php endwhile; ?>
	
		<?php else : ?>
			<h2>No posts found.</h2>
		<?php endif; ?>
		
		
		<div class="row">
			<div class="col-lg-12">
				<?php the_pagination(); ?>
			</div>
		</div>
		
	</div>
		
<?php get_footer(); ?>