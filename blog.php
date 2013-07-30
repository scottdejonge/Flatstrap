<?php
/*
Template Name: Blog
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php if(has_post_thumbnail()) { ?>
		<section class="page-header" class="row">
			<?php the_post_thumbnail('header', array('class' => 'header-image')); ?>
			<div class="container">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
		</section>
	<?php } ?>
	
<?php endwhile; endif; ?>
	
<div id="content" class="container">
	<?php get_breadcrumbs(); ?>
	<?php if(!has_post_thumbnail()) { ?>
		<div class="row">
			<div class="entry">
				<h1 class="page-title col-lg-12"><?php the_title(); ?></h1>
			</div>
		</div>
	<?php } ?>
	<div class="row">
		 <div class="col-lg-8">
		 	<?php $loop = new WP_Query(array( 'post_type' => 'post', 'post_status'=> 'publish', 'posts_per_page' => 10, 'paged' => get_query_var('paged'))); ?>
		 	<?php if (have_posts()) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
			
				<article class="post" id="post-<?php the_ID(); ?>">
					<div class="entry">
						<?php if(has_post_thumbnail()) { ?>
							<div class="row">
								<div class="col-lg-4">
									<?php the_post_thumbnail('large', array('class' => 'featured-image')); ?>
								</div>
								<div class="col-lg-8">
									<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<?php post_meta(); ?>
									<?php the_excerpt(); ?>
								</div>
							</div>
						<?php } else { ?>
							<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<?php post_meta(); ?>
							<?php the_excerpt(); ?>
						<?php } ?>
					</div>
				</article>
				
			<?php endwhile; endif; ?>
		 </div>
		 
		 
		<aside class="col-lg-4">
			<?php get_sidebar(); ?>
		</aside>	
	</div>
	
	<div class="col-lg-12">
		<div class="span12">
			<?php the_pagination(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
