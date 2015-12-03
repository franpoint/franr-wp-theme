<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section, header and top navigation areas
 *
 * @package elmax
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
<div id="top-wrap">
<div id="top-inner">
	<header id="branding" class="site-header" role="banner">
			<h1 id="logo"><a href="<?php echo esc_url(home_url('')) ?>"><?php bloginfo( 'name' ); ?></a></h1>
	<nav id="site-navigation" class="main-navigation" role="navigation">
		<h1 class="menu-toggle"><?php _e( 'Menu', 'elmax' ); ?></h1>
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'elmax' ); ?></a>

		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 3 ) ); ?>
	</nav><!-- #site-navigation -->
		
	</header>
<div class="clear"></div>
</div>
</div>
<div id="wrap">	
