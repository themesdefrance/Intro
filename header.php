<?php
/**
 * The template for displaying the header
 *
 * @package Intro
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since 1.0
 */
?>

<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<!doctype html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<link rel="shortcut icon" href="/favicon.ico?v=0">
	
	<meta name="viewport" content="width=device-width">
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	
	<!-- Scripts that need to be loaded first -->
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
	
	<?php do_action('intro_body_top'); ?>
	
	<div class="page-wrapper">
			
			<header class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
				
				<div class="wrapper">
				
					<div class="intro-logo">
						
						<?php if(get_option('intro_logo')) : ?>
						
							<a href="<?php echo home_url(); ?>" class="logo-img">	
								<img src="<?php echo esc_url(get_option('intro_logo')); ?>" alt="<?php echo esc_attr(bloginfo('name')); ?>">
							</a>
						
						<?php else: ?>
						
							<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr(bloginfo('name')); ?>" class="logo-text">
								<?php echo esc_attr(bloginfo('name')); ?>
							</a>
						
						<?php endif; ?>
						
						<a id="toggle-menu-icon" class="typcn typcn-th-menu"></a>
						
					</div><!--END .intro-logo-->
					
					<nav class="main-menu" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
						
						<?php
						wp_nav_menu(array(
							'theme_location' => 'primary',
							'menu_class'     => 'top-level-menu',
							'container'      => false,
							'depth'          => 2,
							'fallback_cb'    => 'intro_nomenu'
						));
						?>
					</nav><!--END .main-menu-->
				
				</div><!--END .wrapper-->
				
			</header><!--END .site-header-->			