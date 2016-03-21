<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Honma
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<div class="header_container" <?php if ( of_get_option('header_image') && is_front_page() ) { ?> style="background-image: url('<?php echo esc_url(of_get_option('header_image')); ?>');" <?php } else { ?>style="background:#808080;"<?php } ?>>
			<div class="header_block">
				<header id="header" class="container clearfix">
					<nav class="menu_top_container">
						<a class="icon_menu" href="#"><?php _e( 'Menu', 'honma' ); ?></a>
						<?php if ( has_nav_menu( 'main' ) ) { ?>
							<?php wp_nav_menu( array('container'=> '', 'theme_location' => 'main', 'items_wrap'  => '<ul class="menu_top">%3$s</ul>'  ) ); ?>
						<?php } else { ?>
							<?php wp_nav_menu(  array( 'menu_class'  => 'menu_top') ); ?>	
						<?php } ?>
						<?php if ( has_nav_menu( 'main' ) ) { ?>
						   <?php wp_nav_menu( array('container'=> '', 'theme_location' => 'main', 'items_wrap'  => '<ul class="menu_top_mobile">%3$s</ul>'  ) ); ?>
						<?php } else { ?>
							<?php wp_nav_menu(  array( 'menu_class'  => 'menu_top_mobile' ) ); ?>	
						<?php } ?>						
					</nav>
				</header>
			</div>
			<?php if(is_front_page()) { ?>
			<div class="page_title">
				<div class="container">
					<div class="welcome_banner">
						<?php if ( of_get_option('header_text_image') ) { ?>
						<img src="<?php  echo esc_url(of_get_option('header_text_image')); ?>" />
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>