<?php
/**
 * The template used for displaying page content
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php do_action('intro_before_page'); ?>

<article id="page-<?php the_ID(); ?>" <?php post_class('page'); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
	
	<?php do_action('intro_top_page'); ?>
	
	<header class="entry-header" >
		
		<?php do_action('intro_top_header_page'); ?>
					
		<?php if (has_post_thumbnail() && !post_password_required()): ?>
		
			<div class="entry-thumbnail">

				<?php intro_post_thumbnail(); ?>
					
			</div><!--END .entry-thumbnail-->
			
		<?php endif; ?>
			
			<?php // The page title is displayed in header-bar.php ?>
			
		<?php do_action('intro_bottom_header_page'); ?>
		
	</header><!--END .entry-header-->
	
	<?php do_action('intro_before_content'); ?>
	
	<div class="entry-content" itemprop="articleBody">
		
		<?php do_action('intro_top_content'); ?>
		
		<?php the_content(); ?>
		
		<?php do_action('intro_bottom_content'); ?>

	</div><!--END .entry-content-->
	
	<?php do_action('intro_after_content'); ?>
	
	<?php do_action('intro_bottom_page'); ?>
	
</article><!--END .page -->

<?php do_action('intro_after_post'); ?>