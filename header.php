<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MadeInShoreditch
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>


<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/icon-style.css" type="text/css"/>
<script type='text/javascript' src='<?php bloginfo('template_directory'); ?>/js/stickyfill.js'></script>

</head>

<body <?php body_class(); ?>>
<?php if( function_exists('the_ad') ) the_ad_placement('verytop'); ?>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header sticky" role="banner">
	
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="logo attached-to-menu">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="made in shoreditch"/>
				</a>
			</div>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			<div class="menu-social attached-to-menu hide-mobile">
				<div class="menu-social-item menu-search">
					<span class="icon-search"></span>
					<div id="menu-searchform">						
						<?php include (TEMPLATEPATH . '/searchform.php'); ?>
					</div>
				</div>
				<div class="menu-social-item menu-twitter">
					<a class="icon-twitter" href="https://twitter.com/MadeiShoreditch"></a>
				</div>
				<div class="menu-social-item menu-facebook">
					<a class="icon-facebook2" href="https://www.facebook.com/MadeinShoreditch"></a>
				</div>
			</div>

						
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<?php if( function_exists('the_ad') )the_ad_placement('aftermegamenu'); ?>

