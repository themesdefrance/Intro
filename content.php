<?php
/**
 * The default template for displaying content
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<?php do_action('intro_before_post'); ?>

<article <?php post_class('post'); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
	
	<?php do_action('intro_top_post'); ?>
	
	<header class="entry-header" >
		
		<?php do_action('intro_top_header_post'); ?>

		<?php if (has_post_thumbnail() && !post_password_required()): ?>

			<div class="entry-thumbnail">

				<?php if (is_single()): ?>

					<?php intro_post_thumbnail(); ?>

				<?php else: ?>

					<a class="entry-permalink" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

						<?php intro_post_thumbnail(); ?>

					</a>

				<?php endif; ?>

			</div><!--END .entry-thumbnail-->

		<?php endif; ?>


		<?php if (is_single()): ?>

			<h1 class="entry-title" itemprop="headline">

				<?php the_title(); ?>


			</h1><!--END .entry-title-->

		<?php else: ?>

			<h2 class="entry-title" itemprop="headline">

				<a class="entry-permalink" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark">

					<?php the_title(); ?>

				</a>

			</h2><!--END .entry-title-->

		<?php endif; ?>

		<?php get_template_part('content', 'header'); ?>
		
		<?php do_action('intro_bottom_header_post'); ?>

	</header><!--END .entry-header-->

	<?php get_template_part('content', 'body'); ?>

	<?php get_template_part('content', 'footer'); ?>

	<?php do_action('intro_bottom_post'); ?>

</article><!-- END .post -->

<?php do_action('intro_after_post'); ?>