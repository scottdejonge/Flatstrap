<?php get_header(); ?>

<div class="row">
	<div class="span8">
	 	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<article class="post" id="post-<?php the_ID(); ?>">
				<div class="entry">
					<?php if(has_post_thumbnail()) { ?>
						<?php the_post_thumbnail('large', array('class' => 'featured-image')); ?>
					<?php } ?>
					<h1><?php the_title(); ?></h1>
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
