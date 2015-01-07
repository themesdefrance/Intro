<?php
/**
 * The template for displaying the header bar (between the header and the main content)
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php do_action('intro_before_header_bar'); ?>

<section class="header-bar">
	
	<div class="wrapper">
		
		<?php do_action('intro_top_header_bar'); ?>
		
		<?php if(is_single()){ ?>
		
			<h2 class="header-bar-title"><?php echo apply_filters('intro_headerbar_single', __('Blog', 'intro')); ?></h2>
			
		<?php }else if(is_page()){ ?>
		
			<h1 class="header-bar-title" itemprop="headline"><?php echo get_the_title(); ?></h1>
			
		<?php }else if(is_category()){ ?>
		
			<h1 class="header-bar-title" itemprop="headline">
				<?php single_cat_title(_e('Posts from ', 'intro')); ?>
			</h1>
		
		<?php }else if(is_tag()){ ?>
		
			<h1 class="header-bar-title" itemprop="headline">
				<?php single_tag_title(_e('Posts tagged by ', 'intro')); ?>
			</h1>
			
		<?php }else if(is_search()){ ?>
		
			<h1 class="header-bar-title" itemprop="headline">
				<?php printf( __( 'Search results for : %s', 'intro' ), get_search_query() ); ?>
			</h1>
		
		<?php }else if(is_author()){ ?>
	
			<?php $author = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author)); ?>
			
			<h1 class="header-bar-title" itemprop="headline">
				<?php printf( __( 'About %s', 'intro' ), $author->display_name ); ?>
			</h1>
		
		<?php }else if(is_archive()){ ?>
			<h1 class="header-bar-title" itemprop="headline">
				<?php if (is_day()) { 
						_e('Archives from ', 'intro');
						the_time(get_option('date_format'));
					}
					elseif(is_month()){
						_e('Archives for ', 'intro');
						the_time('F Y');
					}
					elseif(is_year()){
						_e('Archives for ', 'intro');
						the_time('Y');
					}
					else{
						_e('Archives', 'intro');
					}
					?>
			
			</h1>
		
		<?php }else{ ?>
			
			<h1 class="header-bar-title" itemprop="headline"><?php echo apply_filters('intro_headerbar_single', __('Blog', 'intro')); ?></h1>
			
		<?php } ?>
		
		<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<div id="site-breadcrumbs">','</div>');
				} ?>
	
		<?php do_action('intro_bottom_header_bar'); ?>
	
	</div><!--END .wrapper-->

</section><!--END .header-bar-->

<?php do_action('intro_after_header_bar'); ?>