<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php $sidebar = apply_filters('intro_show_sidebar', get_option('intro_show_sidebar')); ?>

<?php get_header(); ?>

<?php do_action('intro_before_main'); ?>

<section class="content">

	<div class="wrapper">
		
		<?php do_action('intro_top_main'); ?>	
		
		<main class="main-content<?php if ($sidebar) echo ' col-2-3'; ?>" role="main" itemprop="mainContentOfPage">
		
			<?php
				
				while (have_posts()) : the_post();
				
					get_template_part('content', get_post_format());
				
					comments_template();
					
					intro_posts_nav(false, '','<div class="pagination">','</div>');
				
				endwhile;
			?>

		</main><!-- END .main-content -->
		
		<?php if ($sidebar): ?>
		
			<aside class="sidebar col-1-3" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			
				<?php dynamic_sidebar('blog'); ?>
				
			</aside><!-- END .sidebar col-1-3 -->
		
		<?php endif; ?>
		
		<?php do_action('intro_bottom_main'); ?>
			
	</div><!-- END .wrapper -->

</section><!-- END .content -->

<?php do_action('intro_after_main'); ?>

<?php get_footer(); ?>