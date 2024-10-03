<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


?><!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <!-- Required meta tags -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- wp_head begin -->
    <?php wp_head(); ?>
    <!-- wp_head end -->
  </head>
  <body <?php body_class(); ?> >
    <?php wp_body_open(); ?>   <!-- (Arley's contribution to Picostrap) -->
    
    <?php if(function_exists('lc_custom_header')) lc_custom_header(); else {
      
      //STANDARD NAV
      
      if (get_theme_mod("enable_topbar") ) : ?>
        <!-- ******************* The Topbar Area ******************* -->
        <div id="wrapper-topbar" class="py-2 <?php echo get_theme_mod('topbar_bg_color_choice','bg-light') ?> <?php echo get_theme_mod('topbar_text_color_choice','text-dark') ?>">
          <div class="container">
            <div class="row">
              <div id="topbar-content" class="col-md-12 text-center small"> <?php echo do_shortcode(get_theme_mod('topbar_content')) ?>	</div>
            </div>
          </div>
        </div>
        <?php endif; ?>
        

        <main id='theme-main'>
        <!-- ******************* The Navbar Area ******************* -->
        <!-- <div class="" id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite"> -->

          <a class="skip-link visually-hidden-focusable" href="#theme-main"><?php esc_html_e( 'Skip to content', 'picostrap5' ); ?></a>

          <?php do_shortcode('[event_banner]'); ?>

          <div class="border-top border-5 border-primary contact-bar">
            <div class="border-bottom border-1 border-gray w-100">
              <div class="container d-flex justify-content-between my-2">
                <div class="d-flex align-items-center">
                  <a class="bg-light p-2 px-3 p-xl-0 bg-lg-inherit text-decoration-none text-dark d-flex align-items-center rounded" target="_BLANK" href="https://www.google.com/maps/dir//<?php echo get_option('site_option_name')['address_0'] ?>">
                    <svg class="me-2" width="16" height="18" viewBox="0 0 20 27" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 27C10 27 20 17.4049 20 10.125C20 7.43968 18.9464 4.86435 17.0711 2.96554C15.1957 1.06674 12.6522 0 10 0C7.34784 0 4.8043 1.06674 2.92893 2.96554C1.05357 4.86435 3.95203e-08 7.43968 0 10.125C0 17.4049 10 27 10 27ZM10 15.1875C8.67392 15.1875 7.40215 14.6541 6.46447 13.7047C5.52678 12.7553 5 11.4677 5 10.125C5 8.78234 5.52678 7.49468 6.46447 6.54527C7.40215 5.59587 8.67392 5.0625 10 5.0625C11.3261 5.0625 12.5979 5.59587 13.5355 6.54527C14.4732 7.49468 15 8.78234 15 10.125C15 11.4677 14.4732 12.7553 13.5355 13.7047C12.5979 14.6541 11.3261 15.1875 10 15.1875Z" fill="currentcolor"/></svg>
                    <span class="d-none d-md-inline" ><?php echo do_shortcode('[address_link link="false" count="2"]') ?></span>
                    <small class="d-md-none">Map</small>
                  </a>
                </div>
                <div class="d-flex align-items-center">
                  <a class="bg-light p-2 px-3 p-xl-0 bg-lg-inherit text-decoration-none text-dark d-flex align-items-center rounded" href="tel:<?php echo get_option('site_option_name')['phone_1'] ?>">
                    <svg class="me-2" width="16" height="18" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M25.0555 1.24974L19.7743 0.0310172C19.2005 -0.101011 18.6115 0.198592 18.3779 0.736862L15.9404 6.42424C15.7272 6.92189 15.8693 7.50586 16.2908 7.84609L19.3681 10.3648C17.54 14.2596 14.3459 17.4994 10.3698 19.363L7.85115 16.2858C7.50585 15.8643 6.92695 15.7221 6.4293 15.9354L0.74192 18.3728C0.198572 18.6115 -0.101032 19.2005 0.030997 19.7743L1.24972 25.0555C1.37667 25.6039 1.86416 26 2.43798 26C15.4428 26 26 15.4631 26 2.438C26 1.86926 25.609 1.37669 25.0555 1.24974Z" fill="currentcolor"/></svg>
                    <span class="d-none d-md-inline"><?php echo get_option('site_option_name')['phone_1'] ?></span>
                    <small class="d-md-none">Call</small>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Removed the below code from navbar classes, since Picostrap doesn't have a bg-white setting. This breaks the theme's custom navbar colour settings. Also added `bg-white` manually -->
          <!-- `get_theme_mod('picostrap_header_navbar_color_choice','bg-dark')` -->
          <nav class="navbar border-bottom border-1 border-gray <?php echo get_theme_mod('picostrap_header_navbar_expand','navbar-expand-xl'); ?> <?php echo get_theme_mod('picostrap_header_navbar_position')." ". get_theme_mod('picostrap_header_navbar_color_scheme','navbar-dark'); ?> bg-white" aria-label="Main Navigation" >
            <div class="container">
              <div id="logo-tagline-wrap">
                  <!-- Your site title as branding in the menu -->
                  <?php if ( ! has_custom_logo() ) { ?>

                    <?php if ( is_front_page() && is_home() ) : ?>

                      <div class="navbar-brand mb-0 h3"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a></div>

                    <?php else : ?>

                      <a class="navbar-brand mb-0 h3" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>

                    <?php endif; ?>


                  <?php } else {
                    the_custom_logo();
                  } ?><!-- end custom logo -->              
              
                  </div> <!-- /logo-tagline-wrap -->



                <div>
                  <span class="navbar-toggler text-decoration-none text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-label="Toggle navigation">
                  <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="41" height="20" viewBox="0 0 41 20">
                    <path d="M0 0H41V4H0V0Z" fill="currentcolor"/>
                    <path d="M0 16H41V20H0L0 16Z" fill="currentcolor"/>
                  </svg>
                    <small>Menu</small>
                </span>
                </div>

              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <?php 
                  wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => '',
                    'fallback_cb' => '__return_false',
                    'items_wrap' => '<ul id="%1$s" class="navbar-nav ms-auto me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                ));
                ?>
                
                <?php if (get_theme_mod('enable_search_form')): ?>
                  <?php if ( in_array( 'ajax-search-lite/ajax-search-lite.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ): ?>
                    <!-- Check if Search plugin is active -->
                    <div class="ajax-search">
                      <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
                    </div>
                  <?php else: ?>
                    <form action="<?php echo bloginfo('url') ?>" method="get" id="header-search-form">
                      <input class="form-control" type="text" placeholder="Search" aria-label="Search" name="s" value="<?php the_search_query(); ?>">
                    </form>
                  <?php endif ?>
                <?php else: ?>
                  <a class="btn btn-primary btn-sm-full d-flex justify-content-center py-3 py-md-2" href="<?php echo (!empty(get_option('site_option_name')['cta_link_4'])) ? (get_option('site_option_name')['cta_link_4']) : ('/contact'); ?>"><?php echo (!empty(get_option('site_option_name')['cta_text_3'])) ? (get_option('site_option_name')['cta_text_3']) : ('Contact Us'); ?></a>
                <?php endif ?>

              </div> <!-- .collapse -->
            </div> <!-- .container -->
          </nav> <!-- .site-navigation -->
        <!-- </div> #wrapper-navbar end -->

      
    <?php 
    } // END ELSE CASE 
    ?>