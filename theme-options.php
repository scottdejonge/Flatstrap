<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Theme Options
 *
 *
 * @file           theme-options.php
 * @package        dism 
 * @author         Emil Uzelac 
 * @copyright      2003 - 2011 ThemeID
 * @license        license.txt
 * @version        Release: 1.1
 * @filesource     wp-content/themes/dism/includes/theme-options.php
 * @since          available since Release 1.0
 */
?>

<?php

add_action('admin_init', 'dism_theme_options_init');
add_action('admin_menu', 'dism_theme_options_add_page');

// A safe way of adding javascripts to a WordPress generated page.
function dism_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'dism-theme-options', get_template_directory_uri() . '/css/theme-options.css', false, '1.0' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'dism_admin_enqueue_scripts' );

// Init plugin options to white list our options
function dism_theme_options_init() {
    register_setting('dism_options', 'dism_theme_options', 'dism_theme_options_validate');
}

// Load up the menu page
function dism_theme_options_add_page() {
    add_theme_page(__('Theme Options', 'dism'), __('Theme Options', 'dism'), 'edit_theme_options', 'theme_options', 'dism_theme_options_do_page');
}

// Redirect users to Theme Options after activation
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" )
	wp_redirect( 'themes.php?page=theme_options' );

/**
 * Site Verification and Webmaster Tools
 * If user sets the code we're going to display meta verification
 * And if left blank let's not display anything at all in case there is a plugin that does this
 */
 
function dism_google_verification() {
    $options = get_option('dism_theme_options');
    if ($options['google_site_verification']) {
		echo '<meta name="google-site-verification" content="' . $options['google_site_verification'] . '" />' . "\n";
	}
}

add_action('wp_head', 'dism_google_verification');

function dism_site_statistics_tracker() {
    $options = get_option('dism_theme_options');
    if ($options['site_statistics_tracker']) {
        echo $options['site_statistics_tracker'];
	}
}

add_action('wp_head', 'dism_site_statistics_tracker');

function dism_inline_css() {
    $options = get_option('dism_theme_options');
    if ($options['dism_inline_css']) {
		echo '<!-- Custom CSS Styles -->' . "\n";
        echo '<style type="text/css" media="screen">' . "\n";
		echo $options['dism_inline_css'] . "\n";
		echo '</style>' . "\n";
	}
}

add_action('wp_head', 'dism_inline_css');
	
/**
 * Create the options page
 */
function dism_theme_options_do_page() {

	if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;
	?>
    
    <div class="wrap">
        <?php screen_icon(); echo "<h2>" . get_current_theme() ." ". __('Theme Options', 'dism') . "</h2>"; ?>

		<?php if (false !== $_REQUEST['settings-updated']) : ?>
			<div class="updated fade"><p><strong><?php _e('Options Saved', 'dism'); ?></strong></p></div>
		<?php endif; ?>

        <form method="post" action="options.php">
            <?php settings_fields('dism_options'); ?>
            <?php $options = get_option('dism_theme_options'); ?>

            <h3 class="options-heading"><?php _e('Theme Elements', 'dism'); ?></h3>
            <div class="container">
                <div class="block"> 
                	<?php _e('Disable Breadcrumb Lists?', 'dism'); ?>
                	<input id="dism_theme_options[breadcrumb]" name="dism_theme_options[breadcrumb]" type="checkbox" value="1" <?php isset($options['breadcrumb']) ? checked( '1', $options['breadcrumb'] ) : checked('0', '1'); ?> />
                	<label class="description" for="dism_theme_options[breadcrumb]"><?php _e('Check to disable', 'dism'); ?></label>       
                </div>
            </div>

            <h3 class="options-heading"><?php _e('Webmaster Tools', 'dism'); ?></h3>
            <div class="container">
                <div class="block">        
                <!-- Site Verification -->
                	<div class="row">	
                		<p><?php _e('Google Site Verification', 'dism'); ?></p>
	                   <input id="dism_theme_options[google_site_verification]" class="regular-text" type="text" name="dism_theme_options[google_site_verification]" value="<?php if (!empty($options['google_site_verification'])) esc_attr_e($options['google_site_verification']); ?>" />
	                    <label class="description" for="dism_theme_options[google_site_verification]"><?php _e('Enter your Google ID number only', 'dism'); ?></label>
                	</div>
                	<div class="row">	
					    <p><?php _e('Site Statistics Tracker', 'dism'); ?></p>
	                    <span class="help-links"><?php _e('Leave blank if plugin handles your webmaster tools', 'dism'); ?></span>
	                    <textarea id="dism_theme_options[site_statistics_tracker]" class="large-text" cols="50" rows="10" name="dism_theme_options[site_statistics_tracker]"><?php if (!empty($options['site_statistics_tracker'])) esc_attr_e($options['site_statistics_tracker']); ?></textarea>
	                    <label class="description" for="dism_theme_options[site_statistics_tracker]"><?php _e('Google Analytics Code', 'dism'); ?></label>
                	</div>
                    <div class="row">	
                    	<?php submit_button(); ?>
                    </div>
                </div>
            </div>

            <h3 class="options-heading"><?php _e('Social Icons', 'dism'); ?></h3>
            <div class="container">
                <div class="block"> 
                 <!-- Social -->
	                <div class="row">
	                	<p><?php _e('Twitter', 'dism'); ?></p>
	                	<input id="dism_theme_options[twitter_uid]" class="regular-text" type="text" name="dism_theme_options[twitter_uid]" value="<?php if (!empty($options['twitter_uid'])) esc_attr_e($options['twitter_uid']); ?>" />
	                	<label class="description" for="dism_theme_options[twitter_uid]"><?php _e('Enter your Twitter URL', 'dism'); ?></label>
	                </div> 
	                <div class="row">
	                	<p><?php _e('Facebook', 'dism'); ?></p>
	                        <input id="dism_theme_options[facebook_uid]" class="regular-text" type="text" name="dism_theme_options[facebook_uid]" value="<?php if (!empty($options['facebook_uid'])) esc_attr_e($options['facebook_uid']); ?>" />
	                        <label class="description" for="dism_theme_options[facebook_uid]"><?php _e('Enter your Facebook URL', 'dism'); ?></label>
	                </div>
	                <div class="row">	
						<p><?php _e('Google+', 'dism'); ?></p>
						<input id="dism_theme_options[google_plus_uid]" class="regular-text" type="text" name="dism_theme_options[google_plus_uid]" value="<?php if (!empty($options['google_plus_uid'])) esc_attr_e($options['google_plus_uid']); ?>" />  
						<label class="description" for="dism_theme_options[google_plus_uid]"><?php _e('Enter your Google+ URL', 'dism'); ?></label>
					</div>
	                <div class="row">
						<p><?php _e('LinkedIn', 'dism'); ?></p>
						<input id="dism_theme_options[linkedin_uid]" class="regular-text" type="text" name="dism_theme_options[linkedin_uid]" value="<?php if (!empty($options['linkedin_uid'])) esc_attr_e($options['linkedin_uid']); ?>" /> 
						<label class="description" for="dism_theme_options[linkedin_uid]"><?php _e('Enter your LinkedIn URL', 'dism'); ?></label>
					</div>
	                <div class="row">   
						<p><?php _e('YouTube', 'dism'); ?></p>
						<input id="dism_theme_options[youtube_uid]" class="regular-text" type="text" name="dism_theme_options[youtube_uid]" value="<?php if (!empty($options['youtube_uid'])) esc_attr_e($options['youtube_uid']); ?>" /> 
						<label class="description" for="dism_theme_options[youtube_uid]"><?php _e('Enter your YouTube URL', 'dism'); ?></label>
					</div>
	                <div class="row">	
						<p><?php _e('StumbleUpon', 'dism'); ?></p>
						<input id="dism_theme_options[stumble_uid]" class="regular-text" type="text" name="dism_theme_options[stumble_uid]" value="<?php if (!empty($options['stumble_uid'])) esc_attr_e($options['stumble_uid']); ?>" /> 
						<label class="description" for="dism_theme_options[youtube_uid]"><?php _e('Enter your StumbleUpon URL', 'dism'); ?></label>
					</div>
	                <div class="row">
						<p><?php _e('RSS Feed', 'dism'); ?></p>
						<input id="dism_theme_options[rss_uid]" class="regular-text" type="text" name="dism_theme_options[rss_uid]" value="<?php if (!empty($options['rss_uid'])) esc_attr_e($options['rss_uid']); ?>" /> 
						<label class="description" for="dism_theme_options[rss_uid]"><?php _e('Enter your RSS Feed URL', 'dism'); ?></label>
					</div>
	                <div class="row">	
						<p><?php _e('Instagram', 'dism'); ?></p>
						<input id="dism_theme_options[instagram_uid]" class="regular-text" type="text" name="dism_theme_options[instagram_uid]" value="<?php if (!empty($options['instagram_uid'])) esc_attr_e($options['instagram_uid']); ?>" />  
						<label class="description" for="dism_theme_options[instagram_uid]"><?php _e('Enter your Instagram URL', 'dism'); ?></label>
					</div>
	                <div class="row">	
						<p><?php _e('Pinterest', 'dism'); ?></p>
						<input id="dism_theme_options[pinterest_uid]" class="regular-text" type="text" name="dism_theme_options[pinterest_uid]" value="<?php if (!empty($options['pinterest_uid'])) esc_attr_e($options['pinterest_uid']); ?>" />  
						<label class="description" for="dism_theme_options[pinterest_uid]"><?php _e('Enter your Pinterest URL', 'dism'); ?></label>
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
function dism_theme_options_validate($input) {

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
	$input['twitter_uid'] = esc_url_raw($input['twitter_uid']);
	$input['facebook_uid'] = esc_url_raw($input['facebook_uid']);
    $input['linkedin_uid'] = esc_url_raw($input['linkedin_uid']);
	$input['youtube_uid'] = esc_url_raw($input['youtube_uid']);
	$input['stumble_uid'] = esc_url_raw($input['stumble_uid']);
	$input['rss_uid'] = esc_url_raw($input['rss_uid']);
	$input['google_plus_uid'] = esc_url_raw($input['google_plus_uid']);
	$input['instagram_uid'] = esc_url_raw($input['instagram_uid']);
	$input['pinterest_uid'] = esc_url_raw($input['pinterest_uid']);
	$input['dism_inline_css'] = wp_kses_stripslashes($input['dism_inline_css']);
	
    return $input;
}
?>