<?php
/**
 * The template for displaying the search form
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php __('Search for:','intro') ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr__('Search ...','intro') ?>" value="" name="s" title="<?php esc_attr__('Search for:','intro') ?>" />
		<button class="reset-btn typcn typcn-times" type="reset"></button>
	</label>
	<button class="submit-btn typcn typcn-zoom" type="submit"></button>
</form>