<?php
/*
        _               _                  _____        _     _ _     _   _   _                         
       (_)             | |                | ____|      | |   (_) |   | | | | | |                        
  _ __  _  ___ ___  ___| |_ _ __ __ _ _ __| |__     ___| |__  _| | __| | | |_| |__   ___ _ __ ___   ___ 
 | '_ \| |/ __/ _ \/ __| __| '__/ _` | '_ \___ \   / __| '_ \| | |/ _` | | __| '_ \ / _ \ '_ ` _ \ / _ \
 | |_) | | (_| (_) \__ \ |_| | | (_| | |_) |__) | | (__| | | | | | (_| | | |_| | | |  __/ | | | | |  __/
 | .__/|_|\___\___/|___/\__|_|  \__,_| .__/____/   \___|_| |_|_|_|\__,_|  \__|_| |_|\___|_| |_| |_|\___|
 | |                                 | |                                                                
 |_|                                 |_|                                                                

                                                       
*************************************** WELCOME TO PICOSTRAP ***************************************

********************* THE BEST WAY TO EXPERIENCE SASS, BOOTSTRAP AND WORDPRESS *********************

    PLEASE WATCH THE VIDEOS FOR BEST RESULTS:
    https://www.youtube.com/playlist?list=PLtyHhWhkgYU8i11wu-5KJDBfA9C-D4Bfl

*/

// DE-ENQUEUE PARENT THEME BOOTSTRAP JS BUNDLE
add_action( 'wp_print_scripts', function(){
    wp_dequeue_script( 'bootstrap5' );
}, 100 );

// ENQUEUE THE BOOTSTRAP JS BUNDLE (AND EVENTUALLY MORE LIBS) FROM THE CHILD THEME DIRECTORY
add_action( 'wp_enqueue_scripts', function() {
    //enqueue js in footer, defer
    wp_enqueue_script( 'bootstrap5-childtheme', get_stylesheet_directory_uri() . "/js/bootstrap.bundle.min.js", array(), null, array('strategy' => 'defer', 'in_footer' => true)  );
    
    //optional: lottie (maybe...)
    //wp_enqueue_script( 'lottie-player', 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js#deferload', array(), null, true );

    //optional: rellax 
    //wp_enqueue_script( 'rellax', 'https://cdnjs.cloudflare.com/ajax/libs/rellax/1.12.1/rellax.min.js#deferload', array(), null, true );

}, 101);

    
    
// ENQUEUE YOUR CUSTOM JS FILES, IF NEEDED 
add_action( 'wp_enqueue_scripts', function() {	   
    
    //UNCOMMENT next row to include the js/custom.js file globally
    //wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js#deferload', array(/* 'jquery' */), null, true); 

    //UNCOMMENT next 3 rows to load the js file only on one page
    //if (is_page('mypageslug')) {
    //    wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js#deferload', array(/* 'jquery' */), null, true); 
    //}  

}, 102);

// OPTIONAL: ADD MORE NAV MENUS
//register_nav_menus( array( 'third' => __( 'Third Menu', 'picostrap' ), 'fourth' => __( 'Fourth Menu', 'picostrap' ), 'fifth' => __( 'Fifth Menu', 'picostrap' ), ) );
// THEN USE SHORTCODE:  [lc_nav_menu theme_location="third" container_class="" container_id="" menu_class="navbar-nav"]


// CHECK PARENT THEME VERSION as Bootstrap 5.2 requires an updated SCSSphp, so picostrap5 v2 is required
add_action( 'admin_notices', function  () {
    if( (pico_get_parent_theme_version())>=2.1) return; 
	$message = __( 'This Child Theme requires at least Picostrap Version 2.1.0  in order to work properly. Please update the parent theme.', 'picostrap' );
	printf( '<div class="%1$s"><h1>%2$s</h1></div>', esc_attr( 'notice notice-error' ), esc_html( $message ) );
} );

// FOR SECURITY: DISABLE APPLICATION PASSWORDS. Remove if needed (unlikely!)
add_filter( 'wp_is_application_passwords_available', '__return_false' );

// CUSTOM PHP CODE /////////////////////////

// Site options page
include 'site-options.php';

// Site options shortcode

add_shortcode( 'address_link', 'address_shortcode' );

function address_shortcode( $atts ) {
    $address = "";
    $i = 0;
    $address_array = explode( ", ", get_option('site_option_name')['address_0'] );
    foreach ($address_array as $item) {
        $i++;
        if ( isset( $atts['count'] ) ) {
            if ( $i <= $atts['count'] ) {
                if ( $i == 1 ) {
                    $address .= $item;
                }else{
                    $address .= ", " . $item;
                }
            }
        }else{
            if ( $i == 1 ) {
                $address .= $item;
            }else{
                $address .= ", " . $item;
            }
        }
    }
    if ( isset( $atts['link'] ) ) {
        return $address;
    }else{
        return '<a target="_BLANK" style="color:inherit" class="text-decoration-none" href="https://www.google.com/maps/place/'. implode(" ", $address_array ) .'">'. $address .'</a>';
    }
}

add_shortcode( 'phone_link', 'phone_shortcode' );
function phone_shortcode() {
	return '<a style="color:inherit" class="text-decoration-none" href="tel:'. get_option('site_option_name')['phone_1'] .'">'. get_option('site_option_name')['phone_1'] .'</a>';
}

add_shortcode( 'service_time', 'time_shortcode' );
function time_shortcode() {
	return get_option('site_option_name')['service_time_2'];
}

add_shortcode( 'file_link', 'file_shortcode' );
function file_shortcode( $atts ) {
    isset($atts['classes'])?:$atts['classes'] = "";
    isset($atts['text'])?:$atts['text'] = "View File";

	return '<a class="'. $atts['classes'] . '" target="_BLANK" href="'. get_option('site_option_name')['file_url_5'] .'">'. $atts['text'] .'</a>';
}

add_shortcode( 'hours_table', 'hours_shortcode' );
function hours_shortcode() {
    // This should all be an array and then a for loop but wp settings are annoying and I have no time :)
    $monday_open = get_option('site_option_name')['monday_hours_open'];
    $monday_close = get_option('site_option_name')['monday_hours_close'];
    $tuesday_open = get_option('site_option_name')['tuesday_hours_open'];
    $tuesday_close = get_option('site_option_name')['tuesday_hours_close'];
    $wednesday_open = get_option('site_option_name')['wednesday_hours_open'];
    $wednesday_close = get_option('site_option_name')['wednesday_hours_close'];
    $thursday_open = get_option('site_option_name')['thursday_hours_open'];
    $thursday_close = get_option('site_option_name')['thursday_hours_close'];
    $friday_open = get_option('site_option_name')['friday_hours_open'];
    $friday_close = get_option('site_option_name')['friday_hours_close'];
    $saturday_open = get_option('site_option_name')['saturday_hours_open'];
    $saturday_close = get_option('site_option_name')['saturday_hours_close'];
    $sunday_open = get_option('site_option_name')['sunday_hours_open'];
    $sunday_close = get_option('site_option_name')['sunday_hours_close'];
    
    $hours_table = '<div class="hours-table mt-3">';

    if ( !empty($monday_open) ){
        $hours_table .='
        <div class="hours-row mb-2">';
        if (strtotime($monday_open)) { $hours_table .='<meta itemprop="openingHours" content="Mo '.date ('H:i',strtotime($monday_open)).'-'.date ('H:i',strtotime($monday_close)).'">'; }
        $hours_table .='
            <div class="hours-day">Monday</div>';
        if (strtotime($monday_open)) {
            $hours_table .='<div class="hours-range">'.date ('g:i A',strtotime($monday_open)).' - '.date ('g:i A',strtotime($monday_close)).'</div>';
        }else{
            $hours_table .='<div class="hours-range">'.$monday_open.'</div>';
        }
        $hours_table .='</div>';
    }

    if ( !empty($tuesday_open) ){
        $hours_table .='
        <div class="hours-row mb-2">';
        if (strtotime($tuesday_open)) { $hours_table .='<meta itemprop="openingHours" content="Tu '.date ('H:i',strtotime($tuesday_open)).'-'.date ('H:i',strtotime($tuesday_close)).'">'; }
        $hours_table .='
            <div class="hours-day">Tuesday</div>';
        if (strtotime($tuesday_open)) {
            $hours_table .='<div class="hours-range">'.date ('g:i A',strtotime($tuesday_open)).' - '.date ('g:i A',strtotime($tuesday_close)).'</div>';
        }else{
            $hours_table .='<div class="hours-range">'.$tuesday_open.'</div>';
        }
        $hours_table .='</div>';
    }

    if ( !empty($wednesday_open) ){
        $hours_table .='
        <div class="hours-row mb-2">';
        if (strtotime($wednesday_open)) { $hours_table .='<meta itemprop="openingHours" content="We '.date ('H:i',strtotime($wednesday_open)).'-'.date ('H:i',strtotime($wednesday_close)).'">'; }
        $hours_table .='
            <div class="hours-day">Wednesday</div>';
        if (strtotime($wednesday_open)) {
            $hours_table .='<div class="hours-range">'.date ('g:i A',strtotime($wednesday_open)).' - '.date ('g:i A',strtotime($wednesday_close)).'</div>';
        }else{
            $hours_table .='<div class="hours-range">'.$wednesday_open.'</div>';
        }
        $hours_table .='</div>';
    }

    if ( !empty($thursday_open) ){
        $hours_table .='
        <div class="hours-row mb-2">';
        if (strtotime($thursday_open)) { $hours_table .='<meta itemprop="openingHours" content="Th '.date ('H:i',strtotime($thursday_open)).'-'.date ('H:i',strtotime($thursday_close)).'">'; }
        $hours_table .='
            <div class="hours-day">Thursday</div>';
        if (strtotime($thursday_open)) {
            $hours_table .='<div class="hours-range">'.date ('g:i A',strtotime($thursday_open)).' - '.date ('g:i A',strtotime($thursday_close)).'</div>';
        }else{
            $hours_table .='<div class="hours-range">'.$thursday_open.'</div>';
        }
        $hours_table .='</div>';
    }

    if ( !empty($friday_open) ){
        $hours_table .='
        <div class="hours-row mb-2">';
        if (strtotime($friday_open)) { $hours_table .='<meta itemprop="openingHours" content="Fr '.date ('H:i',strtotime($friday_open)).'-'.date ('H:i',strtotime($friday_close)).'">'; }
        $hours_table .='
            <div class="hours-day">Friday</div>';
        if (strtotime($friday_open)) {
            $hours_table .='<div class="hours-range">'.date ('g:i A',strtotime($friday_open)).' - '.date ('g:i A',strtotime($friday_close)).'</div>';
        }else{
            $hours_table .='<div class="hours-range">'.$friday_open.'</div>';
        }
        $hours_table .='</div>';
    }

    if ( !empty($saturday_open) ){
        $hours_table .='
        <div class="hours-row mb-2">';
        if (strtotime($saturday_open)) { $hours_table .='<meta itemprop="openingHours" content="Sa '.date ('H:i',strtotime($saturday_open)).'-'.date ('H:i',strtotime($saturday_close)).'">'; }
        $hours_table .='
            <div class="hours-day">Saturday</div>';
        if (strtotime($saturday_open)) {
            $hours_table .='<div class="hours-range">'.date ('g:i A',strtotime($saturday_open)).' - '.date ('g:i A',strtotime($saturday_close)).'</div>';
        }else{
            $hours_table .='<div class="hours-range">'.$saturday_open.'</div>';
        }
        $hours_table .='</div>';
    }

    if ( !empty($sunday_open) ){
        $hours_table .='
        <div class="hours-row mb-2">';
        if (strtotime($sunday_open)) { $hours_table .='<meta itemprop="openingHours" content="Su '.date ('H:i',strtotime($sunday_open)).'-'.date ('H:i',strtotime($sunday_close)).'">'; }
        $hours_table .='
            <div class="hours-day">Sunday</div>';
        if (strtotime($sunday_open)) {
            $hours_table .='<div class="hours-range">'.date ('g:i A',strtotime($sunday_open)).' - '.date ('g:i A',strtotime($sunday_close)).'</div>';
        }else{
            $hours_table .='<div class="hours-range">'.$sunday_open.'</div>';
        }
        $hours_table .='</div>';
    }

    $hours_table .='</div>';

    return $hours_table;
}

add_shortcode( 'site_name', 'site_name_shortcode' );
function site_name_shortcode() {
	return get_option( 'blogname' );
}

add_action( 'acf/init', 'set_acf_settings' );
function set_acf_settings() {
    acf_update_setting( 'enable_shortcode', true );
}