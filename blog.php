<?php
/*
Template Name: Blog
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
<?php endwhile; endif; ?>

<div class="row">
	 <div class="span8">
	 	<?php $loop = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => 10)); ?>
	 	<?php if (have_posts()) : while ( $loop->have_posts() ) : $loop->the_post(); ?>
		
			<article class="post" id="post-<?php the_ID(); ?>">
				<div class="entry">
					<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
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
					<?php the_excerpt(); ?>
					<!--
<div class="row">
						<?php if(has_post_thumbnail()) { ?>
							<div class="span2">
								<?php the_post_thumbnail('medium', array('class' => 'featured-image')); ?>
							</div>
							<div class="span6">
								<?php the_excerpt(); ?>
							</div>
						<?php } else { ?>
							<div class="span8">
								<?php the_excerpt(); ?>
							</div>
						<?php } ?>
					</div>
-->
				</div>
			</article>
			
		<?php endwhile; endif; ?>
	 </div>
	 
	 
	<aside class="span4">
		<?php get_sidebar(); ?>
	</aside>	
</div>

<div class="row">
	<div class="span12">
		<?php the_pagination(); ?>
	</div>
</div>

<?php get_footer(); ?>
