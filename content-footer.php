<?php
/**
 * The template for displaying post footer meta content
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<footer class="entry-footer">
	
	<?php do_action('intro_top_footer_post'); ?>

	<?php if(apply_filters('intro_display_post_tags', true)){ ?>
	
		<?php if(has_tag() && is_single()){ ?>
		
			<span class="entry-footer-meta" itemscope="keywords">
			
				<?php echo get_the_tag_list(apply_filters('intro_before_post_tags', ''),' | ',apply_filters('intro_after_post_tags', '')); ?>
			
			</span>
			
		<?php } ?>
	
	<?php } ?>
	
	<?php if(intro_is_paginated_post()){ ?>
	
		<nav>
		
			<?php wp_link_pages(array(
				'before'=>'<div class="post-pagination"><span class="page-links-title">'.__('Pages:', 'intro').'</span>', 
				'after'=>'</div>'
			)); ?>
		
		</nav>
		
	<?php } ?>
	
	<?php do_action('intro_bottom_footer_post'); ?>
	
</footer><!--END .entry-footer-->