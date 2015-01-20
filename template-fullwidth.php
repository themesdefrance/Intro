<?php
/**
 * The template for displaying pages without sidebar
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php 
/*
Template Name: Fullwidth
*/
__('Fullwidth','intro');
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php get_header(); ?>

<?php get_template_part('header', 'bar'); ?>

<?php do_action('intro_before_main'); ?>

<section class="content">
	
	<div class="wrapper">
		
		<?php do_action('intro_top_main'); ?>
				
		<main class="main-content col-1-1" role="main" itemprop="mainContentOfPage">
			
			<?php
				
				if(have_posts()) :
			
					while (have_posts()) : the_post();
	
						get_template_part('content','page');
				
						endwhile;
			
				else:
					
					get_template_part('content', 'none');
			
				endif;
			?>
			
		</main>
		
		<?php intro_posts_nav(false, '', '<div class="pagination">', '</div>'); ?>
		
		<?php do_action('intro_bottom_main'); ?>
		
	</div> <!-- END .wrapper -->

</section> <!-- END .content -->

<?php do_action('intro_after_main'); ?>

<?php get_footer(); ?>