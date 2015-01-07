<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php do_action('intro_before_post'); ?>

<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">
	
	<?php do_action('intro_top_post'); ?>

	<header class="entry-header" >
		
		<?php do_action('intro_top_header_post'); ?>
			
		<h1 class="entry-title" itemprop="headline">
			
			<?php the_title(); ?>
				
		</h1><!--END .entry-title-->
		
		<?php do_action('intro_bottom_header_post'); ?>
		
	</header><!--END .entry-header-->
	
	<?php do_action('intro_before_content'); ?>
	
	<div class="entry-content" itemprop="articleBody">
		
		<?php do_action('intro_top_content'); ?>
		
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'intro' ), admin_url( 'post-new.php' ) ); ?></p>
		
		<?php elseif ( is_search() ) : ?>
			
			<p><?php _e('Sorry but no post match what you are looking for. Try some new keywords below :','intro'); ?></p>
			<?php get_search_form(); ?>
		
		<?php else: ?>
		
			<p><?php printf( __('Sorry but no post match what you are looking for. You should <a href="%1$s">go back to the homepage</a> and start again.','intro'), home_url()); ?></p>
			
		<?php endif; ?>
		
		<?php do_action('intro_bottom_content'); ?>

	</div><!--END .entry-content-->
	
	<?php do_action('intro_after_content'); ?>
	
	<?php do_action('intro_bottom_post'); ?>

</article><!-- END .post -->

<?php do_action('intro_after_post'); ?>