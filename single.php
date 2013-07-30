<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="content" class="container">
		<div class="row">
			<div class="entry">
				<h1 class="col-lg-12 page-title"><?php the_title(); ?></h1>
			</div>
		</div>
			
		<div class="row">
			<div class="col-lg-8">
		 	
				<article class="post" id="post-<?php the_ID(); ?>">
					<div class="entry">
						<?php the_post_thumbnail('large', array('class' => 'featured-image')); ?>
						<?php post_meta(); ?>
						<?php the_content(); ?>
					</div>
				</article>
				
				<?php comments_template(); ?>
				
			 </div>
		
			<div class="col-lg-4">
			 	<?php get_sidebar(); ?>
			</div>
		</div>	
	</div>
<?php endwhile; endif; ?>	

	
<?php get_footer(); ?>
