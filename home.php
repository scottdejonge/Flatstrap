<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

<?php get_template_part('slides'); ?>	

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<div class="row">
		<h1 class="span12 page-title"><?php the_title(); ?></h1>
	</div>
	
	<div class="row">
		<article class="post span12" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<?php the_content(); ?>
				<?php the_edit_link(); ?>
			</div>
		</article>
	</div>

<?php endwhile; endif; ?>
	
<?php get_footer(); ?>