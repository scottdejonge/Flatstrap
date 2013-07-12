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
				 <div class="span8">
				 	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						<article class="post" id="post-<?php the_ID(); ?>">
							<div class="entry">
								<?php if(has_post_thumbnail()) { ?>
									<a href="<?php the_permalink(); ?>" class="featured-image"><?php the_post_thumbnail('medium'); ?></a>	
								<?php } ?>
								<h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
								<div class="post-meta">
									<time datetime="<?php echo date(DATE_W3C); ?>" pubdate class="updated"><?php the_time('j F Y') ?></time>
									<?php the_category(' '); ?>
									<?php if( has_tag() ) { ?><?php the_tags('',''); ?><?php } ?>
								</div>
								<p class="post-excerpt"><?php echo get_the_excerpt(); ?></p>
								<?php //social_buttons() ?>
							</div>
						</article>
						
					<?php endwhile; ?>
				 </div>
				 
				<div class="span4">
				 	<?php get_sidebar(); ?>
				</div>
				
				<?php else : ?>
					<h2>Not Found</h2>
				<?php endif; ?>		
			</div>
		
			<div class="row">
				<div class="span12">
					<?php the_pagination(); ?>
				</div>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>
