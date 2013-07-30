<?php
/*
Template Name: Home
*/
?>

<?php get_header(); ?>

<?php get_template_part('slides'); ?>	

<div id="content" class="container">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="row">
			<article class="post col-lg-12" id="post-<?php the_ID(); ?>">
				<div class="entry">
					<h1 class="page-title"><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<?php the_edit_link(); ?>
				</div>
			</article>
		</div>
	
	<?php endwhile; endif; ?>
	
</div>
	
<?php get_footer(); ?>