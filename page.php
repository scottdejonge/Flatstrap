<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<?php if(has_post_thumbnail()) { ?>
		<section class="page-header">
			<?php the_post_thumbnail('header', array('class' => 'header-image')); ?>
			<div class="container">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
		</section>
	<?php } ?>
	
	<?php get_breadcrumbs(); ?>
	
	<div id="content" class="container">
		<?php if(!has_post_thumbnail()) { ?>
			<div class="row">
				<div class="entry">
					<h1 class="page-title col-lg-12"><?php the_title(); ?></h1>
				</div>
			</div>
		<?php } ?>
		<div class="row">
			<article class="post col-lg-8" id="post-<?php the_ID(); ?>">
				<div class="entry">
					<?php the_content(); ?>
					<?php the_edit_link(); ?>
				</div>
			</article>
			
			<aside class="col-lg-4">
				<?php get_sidebar(); ?>
				</aside>
		</div>
	</div>	
<?php endwhile; endif; ?>
	
<?php get_footer(); ?>