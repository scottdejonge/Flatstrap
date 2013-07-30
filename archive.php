<?php get_header(); ?>

	<div class="container">
		<div class="content">
			<?php if (is_category()) { ?>
				<h1 class="page-title"><?php single_cat_title(); ?></h1>
			<?php } elseif (is_tag()) { ?>
				<h1 class="page-title">Tagged: <em><?php single_tag_title(); ?></em></h1>
			<?php } elseif (is_day()) { ?>
				<h1 class="page-title">Archive for <?php the_time('F jS, Y'); ?></h1>
			<?php } elseif (is_month()) { ?>
				<h1 class="page-title">Archive for <?php the_time('F, Y'); ?></h1>
			<?php } elseif (is_year()) { ?>
				<h1 class="page-title">Archive for <?php the_time('Y'); ?></h1>
			<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1 class="page-title">Blog Archives</h1>
			<?php } ?>
			
			<div class="row">
				 <div class="col-lg-8">
				 	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						<article class="post" id="post-<?php the_ID(); ?>">
							<div class="entry">
								<?php if(has_post_thumbnail()) { ?>
									<a href="<?php the_permalink(); ?>" class="featured-image"><?php the_post_thumbnail('medium'); ?></a>	
								<?php } ?>
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
							</div>
						</article>
						
					<?php endwhile; ?>
				 </div>
				 
				<div class="col-lg-4">
				 	<?php get_sidebar(); ?>
				</div>
				
				<?php else : ?>
					<h2>Not Found</h2>
				<?php endif; ?>		
			</div>
		
			<div class="row">
				<div class="col-lg-12">
					<?php the_pagination(); ?>
				</div>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>
