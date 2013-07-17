<?php get_header(); ?>

<?php if(has_post_thumbnail()) { ?>
	<section class="page-header" class="row">
		<?php the_post_thumbnail('header', array('class' => 'header-image')); ?>
		<h1 class="page-title"><?php the_title(); ?></h1>
	</section>
	<?php get_breadcrumbs(); ?>
<?php } else { ?>
	<?php get_breadcrumbs(); ?>
	<div class="row">
		<h1 class="span12 page-title"><?php the_title(); ?></h1>
	</div>
<?php } ?>

<div class="row">
	<div class="span8">
	 	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article class="post" id="post-<?php the_ID(); ?>">
				<div class="entry">
					<ul class="post-meta">
						<li class="meta">
							<i class="icon-user"></i> by <?php the_author_posts_link(); ?>
						</li>
						<li class="meta">
							<i class="icon-calendar"></i> <time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('j F Y') ?></time>
						</li>
						<li class="meta">
							<i class="icon-comment"></i> <?php comments_popup_link(__('0 comments','example'),__('1 comment','example'),__('% comments','example')); ?>
						</li>
						<li class="meta">
							<i class="icon-tag"></i> <?php the_category(' '); ?>
						</li>
						<?php if(has_tag()) { ?>
						<li class="meta">
							<i class="icon-tags"></i> <?php the_tags( '<span class="label label-info">', '</span><span class="label label-info">', '</span>' ); ?>
						</li>
						<?php } ?>
					</ul>
					<?php the_content(); ?>
				</div>
			</article>
			
			<?php comments_template(); ?>
			
	 </div>

	<div class="span4">
	 	<?php get_sidebar(); ?>
	</div>
	
	<?php endwhile; endif; ?>	
</div>
	
<?php get_footer(); ?>
