<?php
/**
 * The template for displaying video post formats
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php $video_link = get_post_meta($post->ID, '_intro_video_meta', true); ?>

<?php do_action('intro_before_post'); ?>

<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">
	
	<?php do_action('intro_top_post'); ?>
	
	<header class="entry-header">
		
		<?php do_action('intro_top_header_post'); ?>
	
		<div class="entry-video">
									
			<?php echo wp_oembed_get(esc_url($video_link)); ?>
			
		</div><!--END .entry-video-->
		
		<?php if (is_single()): ?>
			
			<h1 class="entry-title"><?php the_title(); ?></h1>
			
		<?php else: ?>
		
			<h2 class="entry-title">
				
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" itemprop="url">
					
					<?php the_title(); ?>
					
				</a>
			
			</h2><!--END .entry-title-->
			
		<?php endif; ?>
		
		<?php get_template_part('content', 'header'); ?>
		
		<?php do_action('intro_bottom_header_post'); ?>
		
	</header><!-- END .entry-header -->
	
	<?php get_template_part('content', 'body'); ?>

	<?php get_template_part('content', 'footer'); ?>

	<?php do_action('intro_bottom_post'); ?>

</article><!-- END .post -->

<?php do_action('intro_after_post'); ?>