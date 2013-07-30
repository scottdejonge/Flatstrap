<form id="search" action="<?php echo home_url( '/' ); ?>" method="get">
	<input type="search" class="form-control" name="s" placeholder="Search" value="<?php the_search_query(); ?>">
</form>