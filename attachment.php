<?php get_header(); ?>

<?php get_breadcrumbs(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="row">
	<article id="post-<?php the_ID(); ?>" class="col-lg-8">
		<h1><?php the_title(); ?></h1>
		<?php $attachment = wp_get_attachment_image_src($post->id, 'full'); ?> 
		<img src="<?php echo $attachment[0]; ?>" width="<?php echo $attachment[1]; ?>" height="<?php echo $attachment[2]; ?>">
		<caption><?php echo get_the_excerpt(); ?></caption>
		<?php the_content(); ?>
	</article>
</div>
<?php endwhile; endif; ?>
	
<?php get_footer(); ?>