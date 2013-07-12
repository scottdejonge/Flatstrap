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
	<div id="carousel" class="carousel slide">
		<ol class="carousel-indicators">
		    <li data-target="#carousel" data-slide-to="0" class="active"></li>
		    <li data-target="#carousel" data-slide-to="1"></li>
		    <li data-target="#carousel" data-slide-to="2"></li>
		</ol>
		<div class="carousel-inner">
			<div class="item active">
				<div class="row-fluid">
					<?php $loop = new WP_Query(array('post_type' => 'projects', 'posts_per_page' => 1, 'order' => 'DESC')); ?>
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="span3">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('project-thumb'); ?></a>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
					<?php $loop = new WP_Query(array('post_type' => 'projects', 'posts_per_page' => 3, 'offset' => 1,  'order' => 'DESC')); ?>
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="span3">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('project-thumb'); ?></a>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<div class="item">
				<div class="row-fluid">
					<?php $loop = new WP_Query(array('post_type' => 'projects', 'posts_per_page' => 4, 'offset' => 4,  'order' => 'DESC')); ?>
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<div class="span3">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('project-thumb'); ?></a>
						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
			<!--
<div class="item active">
				<div class="row-fluid">
					<div class="span3"><a href="#"><img src="http://placehold.it/250x250" alt="Image" /></a></div>
					<div class="span3"><a href="#"><img src="http://placehold.it/250x250" alt="Image" /></a></div>
					<div class="span3"><a href="#"><img src="http://placehold.it/250x250" alt="Image" /></a></div>
					<div class="span3"><a href="#"><img src="http://placehold.it/250x250" alt="Image" /></a></div>
				</div>
			</div>
			<div class="item">
				<div class="row-fluid">
					<div class="span3"><a href="#"><img src="http://placehold.it/250x250" alt="Image" /></a></div>
					<div class="span3"><a href="#"><img src="http://placehold.it/250x250" alt="Image" /></a></div>
					<div class="span3"><a href="#"><img src="http://placehold.it/250x250" alt="Image" /></a></div>
					<div class="span3"><a href="#"><img src="http://placehold.it/250x250" alt="Image" /></a></div>
				</div>
			</div>
-->
			
		</div>
		<a class="carousel-direction left" href="#carousel" data-slide="prev"><i class="icon-angle-left"></i></a>
		<a class="carousel-direction right" href="#carousel" data-slide="next"><i class="icon-angle-right"></i></a>
	</div>
</div>	

<?php get_footer(); ?>