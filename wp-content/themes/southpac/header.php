<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
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
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
<link href="<?php echo get_template_directory_uri(); ?>/css/form.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css" type="text/css">
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
    <header><!--==============================header=================================-->


		<?php if ( get_header_image() ) : ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>


        <div class="container_12">
            <div class="grid_12">
                <h1><a href="../home">
                        <img alt="Southpac Services 南太平洋事务所" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" />
                    </a></h1>
                <div class="slogan">专业注册移民中介</div>

                <div class="h_search">
                    <?php if (is_user_logged_in()) : ?>
                        <a href="<?php echo wp_logout_url(get_permalink()); ?>"><?php _e('Log out') ?></a>
                    <?php else : ?>
                        <a href="<?php echo wp_login_url(get_permalink()); ?>"><?php _e('Log in') ?></a>
                    <?php endif;?>

                    <?php if (get_option('users_can_register')) : ?>
                       <a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=register"><?php _e('Register') ?></a>
                    <?php endif; ?>

                    <form id="search"  action="<?php echo esc_url( home_url( '/' ) ); ?>"  method="GET">
                        <input type="text" name="s" value="<?php _e('Search')?>" onfocus="if (this.value == '<?php _e('Search')?>') {this.value=''}" onblur="if (this.value == ''){this.value='<?php _e('Search')?>'}" />
                        <a onclick="document.getElementById('search').submit()">
                        </a>
                        <div class="clear"></div>
                    </form>
                </div> <!-- h_search -->

                <!-- top-widget -->
                <div id="top-widget-area">
                    <?php  {dynamic_sidebar( 'Top Widget Area' );}  ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>


        <div class="menu_block ">
            <div class="container_12">
                <div class="grid_12">

                         <?php wp_nav_menu(
                             array(
                                 'theme_location' => 'primary',
                                 'container'       => 'nav',
                                 'container_id' =>  '',
                                 'container_class' => 'horizontal-nav full-width horizontalNav-notprocessed',
                                 'fallback_cb'     => '',
                                 'items_wrap'      => '<ul class="sf-menu">%3$s</ul>',
                                 'walker'          => ''
                             ) ); ?>
                    <!-- #site-navigation -->
                    </div>
                </div>
        </div>
</header>
</div>

<div id="main" class="wrapper">
