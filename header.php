<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/fonts/font-awesome/css/font-awesome.min.css">
    <?php
		if (is_page_template('profile-page.php')){
			echo '<script type="text/javascript" src="' . get_template_directory_uri() . '/js/profile.js"></script>';
			//echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/jquery-ui/jquery-ui.min.css">';
			echo '<link rel="stylesheet" href="' . get_template_directory_uri() . '/css/jquery-ui/jquery-ui-1.9.2.custom.min.css">';
		}
	?> 
    <script type="text/javascript" charset="utf-8">
		var j = jQuery.noConflict();
		j(document).ready(function(){
			j("a[data-rel^='prettyPhoto']").prettyPhoto();
		});
	</script>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</a>

			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<h3 class="menu-toggle"><?php _e( 'Menu', 'twentythirteen' ); ?></h3>
					<a class="screen-reader-text skip-link" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentythirteen' ); ?>"><?php _e( 'Skip to content', 'twentythirteen' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
					<?php get_search_form(); ?>
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
            
            <div id="crs-stats-container"></div>
		</header><!-- #masthead -->

        <?php
        if( is_home() ){
            $crs_loader_img = '<img src="' . get_template_directory_uri() . '/images/prettyPhoto/default/loader.gif" alt="" />';
        ?>
            <script>
                jQuery(document).ready(function(){
                    var crs_loader = '<div style="margin: 63px 0; font-size: 18px;"><?php echo $crs_loader_img; ?> Loading CRS statistics. Please, be patient...</div>';
                    
                    var request = jQuery.ajax({
                        type: 'GET',
                        url: '<?php echo esc_url( home_url('/') );?>crs_api_test.php',
                        beforeSend: function(){
                            jQuery('#crs-stats-container').html(crs_loader);
                        }
                    });
                    request.done(function( msg ) {
                        jQuery('#crs-stats-container').html(msg);
                    });
                });
            </script>
        <?php } ?>

		<div id="main" class="site-main">
