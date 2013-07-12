<form id="search" action="<?php echo home_url( '/' ); ?>" method="get" class="form-horizontal">
    <div class="input-append">
        <input type="search" name="s" placeholder="Search" value="<?php the_search_query(); ?>">
        <button type="submit" class="btn"><i class="icon-search"></i></button>
    </div>
</form>