<?php get_header(); ?>
	<div class="container">
		<div class="content">
			<h1 class="span12">Search Results for: "<?php the_search_query(); ?>"</h1>
			
			<div class="row">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
					<article class="post span8" id="post-<?php the_ID(); ?>">
						<div class="entry">
							<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<?php the_excerpt(); ?>
						</div>
					</article>
			
				<?php endwhile; ?>
			
				<?php else : ?>
					<h2>No posts found.</h2>
				<?php endif; ?>
			</div>	
			
			<div class="row">
				<div class="span12">
					<?php the_pagination(); ?>
				</div>
			</div>
		</div>
	</div>
		
<?php get_footer(); ?>