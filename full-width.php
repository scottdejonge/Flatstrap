<?php
/*
Template Name: Full-Width
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
	
	<?php get_breadcrumbs(); ?>
	
	<div id="content" class="container">
		<div class="row">
			<article class="post col-lg-12" id="post-<?php the_ID(); ?>">
				<div class="entry">
					<?php if(!has_post_thumbnail()) { ?>
						<h1 class="page-title"><?php the_title(); ?></h1>
					<?php } ?>
					<?php the_content(); ?>
					<?php the_edit_link(); ?>
				</div>
			</article>
		</div>
	</div>	
<?php endwhile; endif; ?>
	
<?php get_footer(); ?>