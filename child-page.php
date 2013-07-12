<?php
/*
Template Name: Child Page
*/
?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php if(has_post_thumbnail()) { ?>
		<section class="page-header" class="row">
			<?php the_post_thumbnail('header', array('class' => 'header-image')); ?>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</section>			
	<?php } else { ?>
		<div class="row">
			<h1 class="span12 page-title"><?php the_title(); ?></h1>
		</div>
	<?php } ?>
	
	<div class="row">
		<article class="post span8" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<?php the_content(); ?>
				<?php the_edit_link(); ?>
			</div>
		</article>
		
		<aside class="span4">
			<?php sub_navigation(); ?>
		</aside>
	</div>	
<?php endwhile; endif; ?>
	
<?php get_footer(); ?>