<section id="carousel" class="carousel slide">
	<ol class="carousel-indicators">
	<?php $number = 0; ?>
	<?php $loop = new WP_Query(array('post_type' => 'slides', 'order' => 'DESC')); ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<li data-target="#carousel" data-slide-to="<?php echo $number++; ?>"></li>
	<?php endwhile; ?>
	</ol>
	<div class="carousel-inner">
		<?php $loop = new WP_Query(array('post_type' => 'slides', 'order' => 'DESC')); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<div class="item">
				<?php the_post_thumbnail('slide'); ?>
				<div class="carousel-content">
					 <h1><?php the_title();?></h1>
					 <p><?php the_excerpt();?></p>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
	<a class="carousel-direction left" href="#carousel" data-slide="prev"><i class="icon-angle-left"></i></a>
	<a class="carousel-direction right" href="#carousel" data-slide="next"><i class="icon-angle-right"></i></a>
</section>
<!--
<section id="carousel" class="carousel slide">
	<ol class="carousel-indicators">
	<?php $loop = new WP_Query(array('post_type' => 'slides', 'posts_per_page' => 1, 'order' => 'DESC')); ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<li data-target="#carousel" data-slide-to="1" class="active"></li>
	<?php endwhile; wp_reset_postdata(); ?>
	<?php $loop = new WP_Query(array('post_type' => 'slides', 'posts_per_page' => 4, 'offset' => 1,  'order' => 'DESC')); ?>
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<li data-target="#carousel" data-slide-to="1"></li>
	<?php endwhile; wp_reset_postdata(); ?>
	</ol>
	<div class="carousel-inner">
		<?php $loop = new WP_Query(array('post_type' => 'slides', 'posts_per_page' => 1, 'order' => 'DESC')); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<div class="item active">
				<?php the_post_thumbnail('slide'); ?>
				<div class="carousel-content">
					 <h1><?php the_title();?></h1>
					 <p><?php the_excerpt();?></p>
				</div>
			</div>
		<?php endwhile; wp_reset_postdata(); ?>
		<?php $loop = new WP_Query(array('post_type' => 'slides', 'posts_per_page' => 4, 'offset' => 1,  'order' => 'DESC')); ?>
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<div class="item">
				<?php the_post_thumbnail('slide'); ?>
				<div class="carousel-content">
					 <h1><?php the_title();?></h1>
					 <p><?php the_excerpt();?></p>
				</div>
			</div>
		<?php endwhile; wp_reset_postdata(); ?>
	</div>
	<a class="carousel-direction left" href="#carousel" data-slide="prev"><i class="icon-angle-left"></i></a>
	<a class="carousel-direction right" href="#carousel" data-slide="next"><i class="icon-angle-right"></i></a>
</section>
-->