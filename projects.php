<?php
/*
Template Name: Projects
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
		<article class="post span12" id="post-<?php the_ID(); ?>">
			<div class="entry">
				<?php the_content(); ?>
				<?php the_edit_link(); ?>
			</div>
		</article>
	</div>
	
<?php endwhile; endif; ?>

<div class="well">
	<div class="row">
	<?php $loop = new WP_Query(array('post_type' => 'projects', 'order' => 'DESC')); ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
	
		<article class="span3">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('project-thumb'); ?></a>
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
		</article>
	
	<?php endwhile; ?>
	</div>
</div>

<?php get_footer(); ?>