<?php

require_once('wp_bootstrap_navwalker.php');

/*--------------------------------------------------------------------------*/
/*                               RSS FEED                                   */
/*--------------------------------------------------------------------------*/

automatic_feed_links();


function the_parent_title() {
	if($post->post_parent) {
		$parent_title = get_the_title($post->post_parent);
		echo $parent_title;
	}
}


/*--------------------------------------------------------------------------*/
/*                                GALLERY                                   */
/*--------------------------------------------------------------------------*/

add_filter( 'use_default_gallery_style', '__return_false' );



/*--------------------------------------------------------------------------*/
/*                                LOGIN                                     */
/*--------------------------------------------------------------------------*/

function custom_login_logo() {
  echo 
  	'<style type="text/css">
    	h1 a { 
    		background-image:url('.get_bloginfo('template_directory').'/images/login-logo.png) !important; 
    	}
     </style>';
}

add_action('login_head', 'custom_login_logo');



/*--------------------------------------------------------------------------*/
/*                                ADMIN                                     */
/*--------------------------------------------------------------------------*/


//Footer
function modify_footer_admin () {
  echo 'Created by <a href="http://scottdejonge.com">Scott de Jonge</a>. ';
  echo 'Powered by <a href="http://WordPress.org">WordPress</a>.';
}
add_filter('admin_footer_text', 'modify_footer_admin');

//Dashboard 1 Column
function single_screen_columns( $columns ) {
    $columns['dashboard'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'single_screen_columns' );
function single_screen_dashboard(){return 1;}
add_filter( 'get_user_option_screen_layout_dashboard', 'single_screen_dashboard' );

//Dashboard Widgets
function remove_dashboard_widgets() { 
global $wp_meta_boxes; 
	//Right Now widget 
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); 
	//Recent Comments listing widget 
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	//Quickpress widget 
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); 
	//Recent Drafts widget 
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); 
	//Plugin Information widget 
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); 
	//Incoming Links  widget 
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); 
	//WordPress Blog  widget 
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); 
	//WordPress News widget 
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); 
} 
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');


//Remove Menu Items
/*
function remove_menu_items() {
  global $menu;
  $restricted = array( __('Links'), __('Tools'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }
add_action('admin_menu', 'remove_menu_items');
*/

//Hide Update Notifications
if ( !current_user_can('administrator') ) {
	add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

        
/*--------------------------------------------------------------------------*/
/*                              THUMBNAILS                                  */
/*--------------------------------------------------------------------------*/



add_theme_support( 'post-thumbnails' );
add_image_size( 'slide', 1200, 450, true );
add_image_size( 'header', 1200, 300, true );
add_image_size( 'project', 800, 600, true );
add_image_size( 'project-thumb', 250, 250, true );


/*--------------------------------------------------------------------------*/
/*                            EDIT POST LINK                                */
/*--------------------------------------------------------------------------*/


function the_edit_link() {
	if (is_user_logged_in()) {
		echo '<a href="'.get_edit_post_link().'" class="edit btn btn-mini pull-right" id="non-printable" type="button"><i class="icon-edit"></i> Edit</a>';
		echo '<div class="clearfix"></div>';
	}
}



/*--------------------------------------------------------------------------*/
/*                             CONTACT FORM                                 */
/*--------------------------------------------------------------------------*/





/*--------------------------------------------------------------------------*/
/*                                EXCERPT                                   */
/*--------------------------------------------------------------------------*/


function new_excerpt_length($length) {
	return 35;
}
add_filter('excerpt_length', 'new_excerpt_length');

function new_excerpt_more($more) {
    global $post;
	return '... <a class="read-more" id="non-printable" href="'. get_permalink($post->ID) . '">(Read More)</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


// Custom Excerpt

function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	} 
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	return $excerpt;
}
	
function content($limit) {
	$content = explode(' ', get_the_content(), $limit);
	if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
	} else {
		$content = implode(" ",$content);
	} 
	$content = preg_replace('/\[.+\]/','', $content);
	$content = apply_filters('the_content', $content); 
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}


/*--------------------------------------------------------------------------*/
/*                           REMOVE ADMIN BAR                               */
/*------------------------------------------------------ f--------------------*/

add_filter( 'show_admin_bar', '__return_false' );



/*--------------------------------------------------------------------------*/
/*                           REGISTER SIDEBAR                               */
/*--------------------------------------------------------------------------*/



if(function_exists('register_sidebar'))
	register_sidebar(array(
		'name' => 'Sidebar',
		'before_widget' => '<div id="non-printable" class="sidebar-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
));



	
/*--------------------------------------------------------------------------*/
/*                             LOAD JQUERY                                  */
/*--------------------------------------------------------------------------*/

function load_jquery() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2');
		wp_enqueue_script('jquery');
	}
}

add_action('init', 'load_jquery');


/*--------------------------------------------------------------------------*/
/*                             LOAD CUSTOM JS LIBRARIES                     */
/*--------------------------------------------------------------------------*/



// Footer Libraries
add_action('wp_footer', 'load__footer_libraries');
function load__footer_libraries() {
	$jslibraries = array(
		"bootstrap.min.js",
		"modernizr.min.js",
		"functions.js"
	);
	foreach($jslibraries as $jslibrary) {
		echo '<script language="JavaScript" type="text/javascript" src="'.get_bloginfo('template_directory').'/js/'.$jslibrary.'"></script>';
	}
}
	


	
/*--------------------------------------------------------------------------*/
/*                              CLEAN HEAD                                  */
/*--------------------------------------------------------------------------*/


function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

    
    
/*--------------------------------------------------------------------------*/
/*                            CUSTOM MENUS                                  */
/*--------------------------------------------------------------------------*/

add_action( 'init', 'register_my_menus' );

function register_my_menus() {
		register_nav_menus(
    	array( 
    		   'main-menu' => __( 'Main Menu' ),
    		   'footer-menu' => __( 'Footer Menu' )
    		  )
  		);
}

function sub_navigation() {
	global $post;
	
	if($post->post_parent) {
		$parent_id = get_post_ancestors($post->ID);
		$id = end($parent_id);
	} else {
		$id = $post->ID;
	}
	echo '<ul class="sub-navigation nav nav-tabs nav-stacked">';
	wp_list_pages('title_li=&child_of=' . $id );
	echo '</ul>';
}




/*--------------------------------------------------------------------------*/
/*                               PAGINATION                                 */
/*--------------------------------------------------------------------------*/



//Pagination
function the_pagination($pages = '', $range = 2) {  

     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '') {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages) {
             $pages = 1;
         }
     }   

	if(1 != $pages) {
		echo '<div class="btn-toolbar span12 pagination-centered">';
			echo '<div class="btn-group">';
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) {
					echo '<a class="btn unavailable" href='.get_pagenum_link(1).'>&larr;|</a>';
				}
				if($paged > 1 && $showitems < $pages) {
					echo '<a class="btn" href="'.get_pagenum_link($paged - 1).'">&larr;</a>';
				}
				for ($i=1; $i <= $pages; $i++) {
					if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
						echo ($paged == $i)? '<button class="btn disabled current">'.$i.'</button>':'<a class="btn" href='.get_pagenum_link($i).' class="inactive" >'.$i.'</a></button>';
					}
				}
	
				if ($paged < $pages && $showitems < $pages) {
					echo '<a class="btn" href="'.get_pagenum_link($paged + 1).'">&rarr;|</a>';  
				}
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) {
					echo '<a class="btn" href="'.get_pagenum_link($pages).'">&rarr;</a>';
				}
			echo '</div>';
		echo "</div>\n";
	}
}
    


/*--------------------------------------------------------------------------*/
/*                               BREADCRUMBS                                */
/*--------------------------------------------------------------------------*/



//Breadcrumb List
function breadcrumb_lists() {
  
  $chevron = '<span class="divider">/</span>';
  $home = __('Home','responsive'); 
  $before = '<li class="active">';
  $after = '</li>';
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<ul class="breadcrumb">';
 
    global $post;
    $homeLink = home_url();
    echo '<li><a href="' . $homeLink . '">' . $home . '</a></li> ' . $chevron . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $chevron . ' '));
      echo $before . __('Archive for ','responsive') . single_cat_title('', false) . $after;
 
    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $chevron . ' ';
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $chevron . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li> ' . $chevron . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $chevron . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $chevron . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $chevron . ' ');
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li> ' . $chevron . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $chevron . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . __('Search results for ','responsive') . get_search_query() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . __('Posts tagged ','responsive') . single_tag_title('', false) . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . __('All posts by ','responsive') . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . __('Error 404 ','responsive') . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','responsive') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</ul>';
 
  }
} 

function get_breadcrumbs() { 
	$options = get_option('flatstrap_theme_options');
	if ($options['breadcrumb'] == 0) {
		echo breadcrumb_lists();
    }
}



/*--------------------------------------------------------------------------*/
/*                                 SLIDES                                   */
/*--------------------------------------------------------------------------*/


//Create Slide Custom Post Type
add_action('init', 'create_slides_post_type');
function create_slides_post_type() {
	$labels = array(
		'name' => _x('Slides', 'post type general name'),
		'singular_name' => _x('Slide', 'post type singular name'),
		'add_new' => _x('Add New', 'Slide'),
		'add_new_item' => __('Add New Slide'),
		'edit_item' => __('Edit Slide'),
		'new_item' => __('New Slide'),
		'view_item' => __('View Slide'),
		'search_items' => __('Search Slides'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_bloginfo('template_url').'/ico/slides_icon.png',
		'rewrite' => array("slug" => "slides"),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail')
	  ); 
	register_post_type( 'slides' , $args );
}

add_action( 'add_meta_boxes', 'slides_meta_box_add' );

function slides_meta_box_add() {
	add_meta_box( 'my-meta-box-id', 'Slide Meta Information', 'slides_meta_box', 'slides', 'normal', 'high' );
}

function slides_meta_box( $post ) {
	$values = get_post_custom( $post->ID );
	$url = isset( $values['url'] ) ? esc_attr( $values['url'][0] ) : '';
	$linkname = isset( $values['linkname'] ) ? esc_attr( $values['linkname'][0] ) : '';
	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
	?>
	<div style="overflow: hidden; width: 100%;">
		<label for="linkname">Link Name</label>
		<input type="text" class="widefat" name="linkname" id="linkname" size="50" value="<?php echo $linkname; ?>" />
		<label for="url">URL</label>
		<input type="text" class="widefat" name="url" id="url" size="50" value="<?php echo $url; ?>" />
		<p></p>
		<?php submit_button(); ?>
	</div>
	<?php	
}


add_action( 'save_post', 'slides_meta_box_save' );

function slides_meta_box_save( $post_id ) {
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
	if( !current_user_can( 'edit_post' ) ) return;

	$allowed = array( 
		'a' => array(
			'href' => array()
		)
	);
	
	if( isset( $_POST['linkname'] ) )
		update_post_meta( $post_id, 'linkname', wp_kses( $_POST['linkname'], $allowed ) );
	if( isset( $_POST['url'] ) )
		update_post_meta( $post_id, 'url', wp_kses( $_POST['url'], $allowed ) );
}



/*--------------------------------------------------------------------------*/
/*                               PROJECTS                                   */
/*--------------------------------------------------------------------------*/


//Create Projects Custom Post Type
/*
add_action('init', 'create_projects_post_type');
function create_projects_post_type() {
	$labels = array(
		'name' => _x('Projects', 'post type general name'),
		'singular_name' => _x('Project', 'post type singular name'),
		'add_new' => _x('Add New', 'Project'),
		'add_new_item' => __('Add New Project'),
		'edit_item' => __('Edit Project'),
		'new_item' => __('New Project'),
		'view_item' => __('View Project'),
		'search_items' => __('Search Projects'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => get_bloginfo('template_url').'/ico/projects_icon.png',
		'rewrite' => array("slug" => "projects"),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail')
	  ); 
	register_post_type( 'projects' , $args );
}
*/



/*--------------------------------------------------------------------------*/
/*                                WIDGETS                                   */
/*--------------------------------------------------------------------------*/	






/*--------------------------------------------------------------------------*/
/*                                COMMENTS                                  */
/*--------------------------------------------------------------------------*/	



function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	
		<div class="comment-author vcard">
			<!-- <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?> -->
			<div class="comment-meta">
				<?php printf(__('<cite class="fn">%s</cite> said on '), get_comment_author_link()) ?>
				<?php printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
			</div>
		</div>
		
	<?php if ($comment->comment_approved == '0') : ?>
		<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
		<br />
	<?php endif; ?>
	
		
	
		<?php comment_text() ?>
	
		<button class="btn btn-mini reply">
			<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</button>
	<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
	
<?php
}


/*--------------------------------------------------------------------------*/
/*                             THEME OPTIONS                                */
/*--------------------------------------------------------------------------*/	



add_action('admin_init', 'flatstrap_theme_options_init');
add_action('admin_menu', 'flatstrap_theme_options_add_page');

// A safe way of adding javascripts to a WordPress generated page.
function flatstrap_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'flatstrap-theme-options', get_template_directory_uri() . '/css/theme-options.css', false, '1.0' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'flatstrap_admin_enqueue_scripts' );

// Init plugin options to white list our options
function flatstrap_theme_options_init() {
    register_setting('flatstrap_options', 'flatstrap_theme_options', 'flatstrap_theme_options_validate');
}

// Load up the menu page
function flatstrap_theme_options_add_page() {
    add_theme_page(__('Theme Options', 'flatstrap'), __('Theme Options', 'flatstrap'), 'edit_theme_options', 'theme_options', 'flatstrap_theme_options_do_page');
}

// Redirect users to Theme Options after activation
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" )
	wp_redirect( 'themes.php?page=theme_options' );

/**
 * Site Verification and Webmaster Tools
 * If user sets the code we're going to display meta verification
 * And if left blank let's not display anything at all in case there is a plugin that does this
 */
 
function flatstrap_google_verification() {
    $options = get_option('flatstrap_theme_options');
    if ($options['google_site_verification']) {
		echo '<meta name="google-site-verification" content="' . $options['google_site_verification'] . '" />' . "\n";
	}
}

add_action('wp_head', 'flatstrap_google_verification');

function flatstrap_site_statistics_tracker() {
    $options = get_option('flatstrap_theme_options');
    if ($options['site_statistics_tracker']) {
        echo $options['site_statistics_tracker'];
	}
}

add_action('wp_head', 'flatstrap_site_statistics_tracker');

function flatstrap_contact_information_validation() {
    $options = get_option('flatstrap_theme_options');
    if ($options['contact_information']) {
        echo $options['contact_information'];
	}
}

add_action('wp_head', 'flatstrap_contact_information_validation');

function flatstrap_inline_css() {
    $options = get_option('flatstrap_theme_options');
    if ($options['flatstrap_inline_css']) {
		echo '<!-- Custom CSS Styles -->' . "\n";
        echo '<style type="text/css" media="screen">' . "\n";
		echo $options['flatstrap_inline_css'] . "\n";
		echo '</style>' . "\n";
	}
}

add_action('wp_head', 'flatstrap_inline_css');
	
/**
 * Create the options page
 */
function flatstrap_theme_options_do_page() {

	if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;
	?>
    
    <div class="wrap">
        <?php screen_icon(); echo "<h2>" . get_current_theme() ." ". __('Theme Options', 'flatstrap') . "</h2>"; ?>

		<?php if (false !== $_REQUEST['settings-updated']) : ?>
			<div class="updated fade"><p><strong><?php _e('Options Saved', 'flatstrap'); ?></strong></p></div>
		<?php endif; ?>

        <form method="post" action="options.php">
            <?php settings_fields('flatstrap_options'); ?>
            <?php $options = get_option('flatstrap_theme_options'); ?>

            <h3 class="options-heading"><?php _e('Theme Elements', 'flatstrap'); ?></h3>
            <div class="container">
                <div class="block"> 
                	<?php _e('Disable Breadcrumb Lists?', 'flatstrap'); ?>
                	<input id="flatstrap_theme_options[breadcrumb]" name="flatstrap_theme_options[breadcrumb]" type="checkbox" value="1" <?php isset($options['breadcrumb']) ? checked( '1', $options['breadcrumb'] ) : checked('0', '1'); ?> />
                	<label class="description" for="flatstrap_theme_options[breadcrumb]"><?php _e('Check to disable', 'flatstrap'); ?></label>       
                </div>
            </div>
            
            <h3 class="options-heading"><?php _e('Contact Information', 'flatstrap'); ?></h3>
            <div class="container">
                <div class="block"> 
                	<div class="row">
	                	<p><?php _e('Contact Name', 'flatstrap'); ?></p>
	                	<input id="flatstrap_theme_options[contact_name]" class="regular-text" type="text" name="flatstrap_theme_options[contact_name]" value="<?php if (!empty($options['contact_name'])) esc_attr_e($options['contact_name']); ?>" />
		                <label class="description" for="flatstrap_theme_options[contact_name]"><?php _e('Enter a contact name', 'flatstrap'); ?></label>
                	</div>
                	<div class="row">
	                	<p><?php _e('Address', 'flatstrap'); ?></p>
	                	<input id="flatstrap_theme_options[address]" class="regular-text" type="text" name="flatstrap_theme_options[address]" value="<?php if (!empty($options['address'])) esc_attr_e($options['address']); ?>" />
		                <label class="description" for="flatstrap_theme_options[address]"><?php _e('Enter your address', 'flatstrap'); ?></label>
                	</div>
                	<div class="row">
	                	<p><?php _e('Mailing Address', 'flatstrap'); ?></p>
	                	<input id="flatstrap_theme_options[mailing_address]" class="regular-text" type="text" name="flatstrap_theme_options[mailing_address]" value="<?php if (!empty($options['mailing_address'])) esc_attr_e($options['mailing_address']); ?>" />
		                <label class="description" for="flatstrap_theme_options[mailing_address]"><?php _e('Enter your mailing address', 'flatstrap'); ?></label>
                	</div>
                	<div class="row">
	                	<p><?php _e('Phone Number', 'flatstrap'); ?></p>
	                	<input id="flatstrap_theme_options[phone_number]" class="regular-text" type="text" name="flatstrap_theme_options[phone_number]" value="<?php if (!empty($options['phone_number'])) esc_attr_e($options['phone_number']); ?>" />
		                <label class="description" for="flatstrap_theme_options[phone_number]"><?php _e('Enter your phone number', 'flatstrap'); ?></label>
                	</div>
                	<div class="row">
	                	<p><?php _e('Mobile Number', 'flatstrap'); ?></p>
	                	<input id="flatstrap_theme_options[mobile_number]" class="regular-text" type="text" name="flatstrap_theme_options[mobile_number]" value="<?php if (!empty($options['mobile_number'])) esc_attr_e($options['mobile_number']); ?>" />
		                <label class="description" for="flatstrap_theme_options[mobile_number]"><?php _e('Enter your mobile number', 'flatstrap'); ?></label>
                	</div>   
                	<div class="row">
	                	<p><?php _e('Fax Number', 'flatstrap'); ?></p>
	                	<input id="flatstrap_theme_options[fax_number]" class="regular-text" type="text" name="flatstrap_theme_options[fax_number]" value="<?php if (!empty($options['fax_number'])) esc_attr_e($options['fax_number']); ?>" />
		                <label class="description" for="flatstrap_theme_options[fax_number]"><?php _e('Enter your fax number', 'flatstrap'); ?></label>
                	</div>   
                	<div class="row">
	                	<p><?php _e('Email Address', 'flatstrap'); ?></p>
	                	<input id="flatstrap_theme_options[email_address]" class="regular-text" type="text" name="flatstrap_theme_options[email_address]" value="<?php if (!empty($options['email_address'])) esc_attr_e($options['email_address']); ?>" />
		                <label class="description" for="flatstrap_theme_options[email_address]"><?php _e('Enter your email address', 'flatstrap'); ?></label>
                	</div> 
                	<div class="row">
	                	<p><?php _e('Website', 'flatstrap'); ?></p>
	                	<input id="flatstrap_theme_options[website_address]" class="regular-text" type="text" name="flatstrap_theme_options[website_address]" value="<?php if (!empty($options['website_address'])) esc_attr_e($options['website_address']); ?>" />
		                <label class="description" for="flatstrap_theme_options[website_address]"><?php _e('Enter your website address', 'flatstrap'); ?></label>
                	</div>        
	                <div class="row">	
                    	<?php submit_button(); ?>
                    </div>
                </div>
            </div>

            <h3 class="options-heading"><?php _e('Webmaster Tools', 'flatstrap'); ?></h3>
            <div class="container">
                <div class="block">        
                <!-- Site Verification -->
                	<div class="row">	
                		<p><?php _e('Google Site Verification', 'flatstrap'); ?></p>
	                   <input id="flatstrap_theme_options[google_site_verification]" class="regular-text" type="text" name="flatstrap_theme_options[google_site_verification]" value="<?php if (!empty($options['google_site_verification'])) esc_attr_e($options['google_site_verification']); ?>" />
	                    <label class="description" for="flatstrap_theme_options[google_site_verification]"><?php _e('Enter your Google ID number only', 'flatstrap'); ?></label>
                	</div>
                	<div class="row">	
					    <p><?php _e('Site Statistics Tracker', 'flatstrap'); ?></p>
	                    <span class="help-links"><?php _e('Leave blank if plugin handles your webmaster tools', 'flatstrap'); ?></span>
	                    <textarea id="flatstrap_theme_options[site_statistics_tracker]" class="large-text" cols="50" rows="10" name="flatstrap_theme_options[site_statistics_tracker]"><?php if (!empty($options['site_statistics_tracker'])) esc_attr_e($options['site_statistics_tracker']); ?></textarea>
	                    <label class="description" for="flatstrap_theme_options[site_statistics_tracker]"><?php _e('Google Analytics Code', 'flatstrap'); ?></label>
                	</div>
                    <div class="row">	
                    	<?php submit_button(); ?>
                    </div>
                </div>
            </div>

            <h3 class="options-heading"><?php _e('Social Icons', 'flatstrap'); ?></h3>
            <div class="container">
                <div class="block"> 
                 <!-- Social -->
                 
                 	<!-- Twitter -->
	                <div class="row">
	                	<p><?php _e('Twitter', 'flatstrap'); ?></p>
	                	<input id="flatstrap_theme_options[twitter]" class="regular-text" type="text" name="flatstrap_theme_options[twitter]" value="<?php if (!empty($options['twitter'])) esc_attr_e($options['twitter']); ?>" />
	                	<label class="description" for="flatstrap_theme_options[twitter]"><?php _e('Enter your Twitter URL', 'flatstrap'); ?></label>
	                </div> 
	                
	                <!-- Facebook -->
	                <div class="row">
	                	<p><?php _e('Facebook', 'flatstrap'); ?></p>
	                        <input id="flatstrap_theme_options[facebook]" class="regular-text" type="text" name="flatstrap_theme_options[facebook]" value="<?php if (!empty($options['facebook'])) esc_attr_e($options['facebook']); ?>" />
	                        <label class="description" for="flatstrap_theme_options[facebook]"><?php _e('Enter your Facebook URL', 'flatstrap'); ?></label>
	                </div>
	                
	                <!-- Google+ -->
	                <div class="row">	
						<p><?php _e('Google+', 'flatstrap'); ?></p>
						<input id="flatstrap_theme_options[google-plus]" class="regular-text" type="text" name="flatstrap_theme_options[google-plus]" value="<?php if (!empty($options['google-plus'])) esc_attr_e($options['google-plus']); ?>" />  
						<label class="description" for="flatstrap_theme_options[google-plus]"><?php _e('Enter your Google+ URL', 'flatstrap'); ?></label>
					</div>
					
					<!-- LinkedIn -->
	                <div class="row">
						<p><?php _e('LinkedIn', 'flatstrap'); ?></p>
						<input id="flatstrap_theme_options[linkedin]" class="regular-text" type="text" name="flatstrap_theme_options[linkedin]" value="<?php if (!empty($options['linkedin'])) esc_attr_e($options['linkedin']); ?>" /> 
						<label class="description" for="flatstrap_theme_options[linkedin]"><?php _e('Enter your LinkedIn URL', 'flatstrap'); ?></label>
					</div>
					
					<!-- Instagram -->
	                <div class="row">	
						<p><?php _e('Instagram', 'flatstrap'); ?></p>
						<input id="flatstrap_theme_options[instagram]" class="regular-text" type="text" name="flatstrap_theme_options[instagram]" value="<?php if (!empty($options['instagram'])) esc_attr_e($options['instagram']); ?>" />  
						<label class="description" for="flatstrap_theme_options[instagram]"><?php _e('Enter your Instagram URL', 'flatstrap'); ?></label>
					</div>
					
					<!-- RSS Feed -->
	                <div class="row">
						<p><?php _e('RSS Feed', 'flatstrap'); ?></p>
						<input id="flatstrap_theme_options[rss]" class="regular-text" type="text" name="flatstrap_theme_options[rss]" value="<?php if (!empty($options['rss'])) esc_attr_e($options['rss']); ?>" /> 
						<label class="description" for="flatstrap_theme_options[rss]"><?php _e('Enter your RSS Feed URL', 'flatstrap'); ?></label>
					</div>
					
					<div class="row">
		                <?php submit_button(); ?>	
		            </div> 

	            </div>
	        </div>
	    </form>
	</div>
	<?php
	}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function flatstrap_theme_options_validate($input) {

	// checkbox value is either 0 or 1
	foreach (array(
		'breadcrumb',
		'cta_button'
		) as $checkbox) {
		if (!isset( $input[$checkbox]))
			$input[$checkbox] = null;
		$input[$checkbox] = ( $input[$checkbox] == 1 ? 1 : 0 );
	}
	
    $input['home_headline'] = wp_kses_stripslashes($input['home_headline']);
	$input['home_subheadline'] = wp_kses_stripslashes($input['home_subheadline']);
    $input['home_content_area'] = wp_kses_stripslashes($input['home_content_area']);
    $input['cta_text'] = wp_kses_stripslashes($input['cta_text']);
    $input['cta_url'] = esc_url_raw($input['cta_url']);
    $input['featured_content'] = wp_kses_stripslashes($input['featured_content']);
    $input['google_site_verification'] = wp_filter_post_kses($input['google_site_verification']);
    $input['site_statistics_tracker'] = wp_kses_stripslashes($input['site_statistics_tracker']);
    $input['website_address'] = esc_url_raw($input['website_address']);
	$input['twitter'] = esc_url_raw($input['twitter']);
	$input['facebook'] = esc_url_raw($input['facebook']);
	$input['google-plus'] = esc_url_raw($input['google-plus']);
    $input['linkedin'] = esc_url_raw($input['linkedin']);
    $input['instagram'] = esc_url_raw($input['instagram']);
	$input['rss'] = esc_url_raw($input['rss']);
	$input['flatstrap_inline_css'] = wp_kses_stripslashes($input['flatstrap_inline_css']);
	
    return $input;
}


function social_links() {
	$options = get_option('flatstrap_theme_options');
	$sociallinks = array(
		'twitter',
		'facebook',
		'google-plus',
		'linkedin',
		'instagram',
		'rss'
	);
	
	echo '<ul id="menu" class="nav social pull-right">';
		foreach($sociallinks as $sociallink) {
			if ($options[$sociallink]) {
				echo '<li class="menu-item"><a href="'. $options[$sociallink] .'" class="'. $sociallink .'"><i class="icon-'. $sociallink .'"></i></a></li>';
			}
		}
	echo '</ul>';
}

?>