<?php
/**
 * Intro functions and definitions
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
	
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Define theme constants (relative to licensing)
define('INTRO_STORE_URL', 'https://www.themesdefrance.fr');
define('INTRO_THEME_NAME', 'Intro');
define('INTRO_THEME_VERSION', '1.0.0');
define('INTRO_LICENSE_KEY', 'intro_license_edd');

//Set the content width (in pixels) based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 720; 
}

// Include theme updater (relative to licensing)
if(!class_exists('EDD_SL_Theme_Updater'))
	include(dirname( __FILE__ ).'/admin/EDD_SL_Theme_Updater.php');

// Define framework constant then load the Cocorico Framework
define('INTRO_COCORICO_PREFIX', 'intro_');
if(is_admin())
	require_once 'admin/Cocorico/Cocorico.php';

// Load the widgets
require 'admin/widgets/social.php';
require 'admin/widgets/calltoaction.php';
require 'admin/widgets/video.php';

// Load other theme functions
require 'admin/functions/intro-functions.php';

//Refresh the permalink structure
add_action('after_switch_theme', 'flush_rewrite_rules');

//Remove accents in uploaded files
add_filter( 'sanitize_file_name', 'remove_accents' );

//Remove extra stuff from header
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('intro_setup')){
	function intro_setup(){

		// Load translation
		load_theme_textdomain('intro', get_template_directory().'/languages');

		// Register menus
		register_nav_menus( array(
			'primary'   => __('Main menu', 'intro'),
			'footer' => __('Footer menu', 'intro'),
		) );

		// Register sidebars
		register_sidebar(array(
			'name'          => __('Sidebar', 'intro'),
			'id'            => 'blog',
			'description'   => __('Add widgets in the sidebar.', 'intro'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		));

		register_sidebar(array(
			'name'          => __('Footer', 'intro'),
			'id'            => 'footer',
			'description'   => __('Add widgets in the footer.', 'intro'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		));

		// Enable thumbnails
		add_theme_support('post-thumbnails');

		// Enable custom title tag for 4.1
		add_theme_support( 'title-tag' );
		
		// Enable Feed Links
		add_theme_support( 'automatic-feed-links' );
		
		// Enable HTML5 markup
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

		// Set images sizes
		set_post_thumbnail_size('intro-post-thumbnail', 720, 445, true);
		add_image_size('intro-post-thumbnail-full', 1140, 605, true);

		// Add Meta boxes for post formats
		require 'admin/metaboxes/post-formats.php';

	}
}
add_action('after_setup_theme', 'intro_setup');

/**
 * Add custom image sizes in the WordPress Media Library
 *
 * @since 1.0
 * @param array $sizes The current image sizes list
 * @return array
 */
if (!function_exists('intro_image_size_names_choose')){
	function intro_image_size_names_choose($sizes) {
		$added = array('intro-post-thumbnail'=>__('Post width', 'intro'));
		$added = array('intro-post-thumbnail-full'=>__('Fullpage width', 'intro'));
		$newsizes = array_merge($sizes, $added);
		return $newsizes;
	}
}
add_filter('image_size_names_choose', 'intro_image_size_names_choose');

/**
 * Register supported post formats
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('intro_custom_format')){
	function intro_custom_format() {
		$cpts = array('post' => array('video', 'link', 'quote'));
		$current_post_type = $GLOBALS['typenow'];
		if ($current_post_type == 'post') add_theme_support('post-formats', $cpts[$GLOBALS['typenow']]);
	}
}
add_action( 'load-post.php', 'intro_custom_format' );
add_action( 'load-post-new.php', 'intro_custom_format' );

/**
 * Enqueue styles & scripts
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('intro_enqueue')){
	function intro_enqueue(){

		$theme = wp_get_theme();

		wp_register_script('fitvids', get_template_directory_uri().'/js/min/jquery.fitvids.min.js', array('jquery'), false, true);

		wp_register_script('intro', get_template_directory_uri().'/js/min/intro.min.js', array('jquery'), false, true);

		wp_enqueue_style( 'intro-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,latin-ext');

		//main stylesheet
		wp_enqueue_style('stylesheet', get_stylesheet_directory_uri().'/style.css', array(), false);

		//icons
		wp_enqueue_style('icons', get_template_directory_uri().'/fonts/typicons.min.css', array(), false);

		wp_enqueue_script('fitvids');

		wp_enqueue_script('intro');
		
		if ( is_singular() ){
			wp_enqueue_script( "comment-reply" );
		}
	}
}
add_action('wp_enqueue_scripts', 'intro_enqueue');

/**
 * Register the theme options page in the administration
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('intro_admin_menu')){
	function intro_admin_menu(){
		add_theme_page(__('Intro Settings', 'intro'),__('Intro Settings', 'intro'), 'edit_theme_options', 'intro_options', 'intro_options');
	}
}
add_action('admin_menu', 'intro_admin_menu');

/**
 * Loads the theme options page
 *
 * @since 1.0
 * @return void
 */
if (!function_exists('intro_options')){
	function intro_options(){
		if (!current_user_can('edit_theme_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}

       	include 'admin/index.php';
    }
}

/**
 * Custom CSS loading
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('intro_custom_styles')){
	function intro_custom_styles(){
		if (get_option("intro_custom_css")){
			echo '<style type="text/css">';
			echo strip_tags(stripslashes(get_option("intro_custom_css")));
			echo '</style>';
		}
	}
}
add_action('wp_head', 'intro_custom_styles', 99);

/**
 * Applying the theme main color
 *
 * @since 1.0
 * @return void
 */
if(!function_exists('intro_user_styles')){
	function intro_user_styles(){
		
		// Get the main color defined by the user
		if (get_option('intro_color')){

			$color = apply_filters('intro_color', get_option('intro_color'));
			
			// Load color functions
			require_once 'admin/functions/color-functions.php';
			
			$hsl = intro_RGBToHSL(intro_HTMLToRGB($color));
			if ($hsl->lightness > 180){
				$contrast = apply_filters('intro_color_contrast', '#333');
			}
			else{
				$contrast = apply_filters('intro_color_contrast', '#fff');
			}

			$hsl->lightness -= 30;
			$complement = apply_filters('intro_color_complement', intro_HSLToHTML($hsl->hue, $hsl->saturation, $hsl->lightness));
		}
		else{
			// If not, use the default colors
			$color = '#ff625b';
			$complement = '#D14949';
			$contrast = '#fff';
		}
		?>
			<style type="text/css">
				
			.site-header .main-menu li:hover > a,
			.site-header .main-menu li.current-menu-item a,
			.site-header a.logo-text:hover,
			#site-breadcrumbs a,
			.entry-meta a,
			.entry-content a,
			.entry-navigation a,
			.footer a,
			.footer-wrapper .footer-bar a:hover,
			.widget_introsocial ul li a,
			.entry-title a:hover,
			.entry-meta a,
			.entry-content a,
			.entry-footer-meta a,
			.comment-navigation a,
			#respond a,
			.comment-author a,
			.comment-reply-link,
			.widget a,
			.comment-form .logged-in-as a,
			.post-header-title:before,
			.widget > h3:before{
				color: <?php echo $color; ?>;
			}	
			
			.content a:hover,
			.footer a:hover,
			.entry-meta a:hover,
			.entry-content a:hover,
			.entry-navigation a:hover,
			.entry-footer-meta a:hover,
			.comment-author a:hover,
			.comment-reply-link:hover,
			.widget a:hover,
			.widget_introsocial ul li a:hover,
			.comment-form .logged-in-as a:hover{
				color: <?php echo $complement; ?>;
			}

			.entry-thumbnail a.entry-permalink:hover,
			.entry-thumbnail a.entry-permalink:hover:before,
			.entry-quote,
			.entry-quote-author,
			.entry-quote a:hover,
			.entry-link,
			.entry-link a:hover,
			.pagination a:hover{
				color:<?php echo $contrast; ?>;
			}
			
			.button,
			.comment-form input[type="submit"],
			html a.button,
			input[type='submit'],
			input[type='button'],
			.widget_tag_cloud a:hover,
			.widget_calendar #next a,
			.widget_calendar #prev a,
			.widget_introcalltoaction a.button,
			.search-form .submit-btn,
			.entry-quote:hover,
			.entry-link:hover,
			.entry-thumbnail:hover,
			.entry-pagination,
			.pagination span,
			.pagination a.current,
			.pagination a:hover,
			.back-to-top{
				background: <?php echo $color; ?>;
				color: <?php echo $contrast; ?>;
			}
			.button:hover,
			.comment-form input[type="submit"]:hover,
			html a.button:hover,
			input[type='submit']:hover,
			input[type='button']:hover,
			.widget_calendar #next a:hover,
			.widget_calendar #prev a:hover,
			.widget_introcalltoaction a.button:hover,
			.search-form .submit-btn:hover,
			.entry-pagination:hover,
			.back-to-top:hover{
				background: <?php echo $complement; ?>;
				color: <?php echo $contrast; ?>;
			}			
			
			.widget_tag_cloud a:hover,
			input[type='text']:focus,
			input[type='email']:focus,
			input[type='url']:focus,
			input[type='tel']:focus,
			input[type='number']:focus,
			input[type='date']:focus,
			textarea:focus,
			select:focus{
				border-color:<?php echo $color; ?>;
				box-shadow: 0 0 5px <?php echo $color; ?>;
			}

			</style>
		<?php }
}
add_action('wp_head','intro_user_styles', 98);


/**
 * License activation stuff (from Easy Digital Downloads Software Licensing Addon)
 * This function will activate the theme licence on Themes de France
 * 
 * @since 1.0
 * @return void
 */
if(!function_exists('intro_edd')){
	function intro_edd(){
		$license = trim(get_option(INTRO_LICENSE_KEY));
		$status = get_option('intro_license_status');
		
		// No license is activated yet
		if (!$status){
			
			// Activate the license
			$api_params = array(
				'edd_action'=>'activate_license',
				'license'=>$license,
				'item_name'=>urlencode(INTRO_THEME_NAME)
			);

			$response = wp_remote_get(add_query_arg($api_params, INTRO_STORE_URL), array('timeout'=>15, 'sslverify'=>false));
			
			if (!is_wp_error($response)){
				$license_data = json_decode(wp_remote_retrieve_body($response));
				if ($license_data->license === 'valid') update_option('intro_license_status', true);
			}
		}

		$edd_updater = new EDD_SL_Theme_Updater(array(
				'remote_api_url'=> INTRO_STORE_URL,
				'version' 	=> INTRO_THEME_VERSION,
				'license' 	=> $license,
				'item_name' => INTRO_THEME_NAME,
				'author'	=> __('Themes de France','intro')
			)
		);
	}
}
add_action('admin_init', 'intro_edd');

/**
 * Display an admin notice if the licence isn't activated
 * 
 * @since 1.0
 * @return void
 */
if(!function_exists('intro_admin_notice')){
	function intro_admin_notice(){
		global $current_user;
        $user_id = $current_user->ID;
		
		if(current_user_can('edit_theme_options')){
		
			if(!get_option('intro_license_status')){
				
				if ( ! get_user_meta($user_id, 'ignore_purchaseintro_notice') ) {
					echo '<div class="error"><p>';
					
						printf(__("To get Intro support and automatic updates, <a href='%s' target='__blank'>purchase a licence key on Themes de France</a> | <a href='%s'>I'm not interested</a>", 'intro'), 'https://www.themesdefrance.fr/themes/intro/#acheter?utm_source=theme&utm_medium=noticelink&utm_campaign=intro', '?ignore_notice=purchaseintro');
					
					echo '</p></div>';
				}
			}
		}
	}
}
add_action('admin_notices', 'intro_admin_notice');