<?php
/*
Plugin Name: MP6 Extended
Plugin URI: http://yerem.in
Description: This plugin builds out the mp6 plugin further
Version: .1
Author: Gera Yeremin
Author URI: http://Yerem.in
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

add_action( 'init', 'mp6_extended_styles' );
function mp6_extended_styles() {
	wp_register_style(
		'mp6-extended',
		plugins_url( 'mp6-extended.css', __FILE__ ),
		false,
		filemtime( plugin_dir_path( __FILE__ ) . 'mp6-extended.css' )
	);
}

add_action( 'admin_enqueue_scripts', 'mp6_extended_enqueue_styles', 3000 );
function mp6_extended_enqueue_styles() {
	if ( 'mp6' == get_user_option('admin_color') )
		wp_enqueue_style( 'mp6-extended' );
}

//adding new lables to new post
function frl_enter_title_here_filter($label, $post){
 
    if($post->post_type == 'post')
        $label = __('Enter article\'s title here', 'frl');
 
    return $label;
}
add_filter('enter_title_here', 'frl_enter_title_here_filter', 2, 2);

//display dashboard in single pan only
function single_screen_columns( $columns ) {
    $columns['dashboard'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'single_screen_columns' );
function single_screen_dashboard(){return 1;}
add_filter( 'get_user_option_screen_layout_dashboard', 'single_screen_dashboard' );

//Force Single column on post
function so_screen_layout_columns( $columns ) {
    $columns['post'] = 1;
    return $columns;
}
add_filter( 'screen_layout_columns', 'so_screen_layout_columns' );

function so_screen_layout_post() {
    return 1;
}
add_filter( 'get_user_option_screen_layout_post', 'so_screen_layout_post' );

// Add new publish button
add_action( 'edit_form_after_title', 'custom_button' );

function custom_button(){
       // $html  = '<div id="major-publishing-actions" style="overflow:hidden">';
      //  $html .= '<div id="publishing-action">';
        $html .= '<input type="submit" accesskey="p" tabindex="5" value="Post To Web" class="button-primary secondpub" id="secondpub" name="publish">';
        //$html .= '</div>';
       // $html .= '</div>';
        echo $html;
}

// Add new publish button
add_action( 'edit_form_after_title', 'custom_button1' );

function custom_button1(){
       // $html  = '<div id="major-publishing-actions" style="overflow:hidden">';
      //  $html .= '<div id="publishing-action">';
        $html .= '<div class="secondpub"><a role="button" id="content_wp_fullscreen" href="javascript:;" class="mceButton mceButtonEnabled  button-primary" onmousedown="return false;" onclick="return false;" aria-labelledby="content_wp_fullscreen_voice" title="Distraction Free Writing mode (Alt + Shift + W)" tabindex="-1">Stat Writing In Fullscreen</a> or &nbsp; </div>';
        //$html .= '</div>';
       // $html .= '</div>';
        echo $html;
}

//add admin menu to the bottom of screen
function fb_move_admin_bar() {
    echo '
    <style type="text/css">
    body {
    margin-top: -28px;
    padding-bottom: 28px;
    }
    body.admin-bar #wphead {
       padding-top: 0;
    }
    body.admin-bar #footer {
       padding-bottom: 28px;
    }
    #wpadminbar {
        top: auto !important;
        bottom: 0;
    }
    #wpadminbar .quicklinks .menupop ul {
        bottom: 28px;
    }
    #moby6-toggle {bottom: 7px !important; top: inherit !important;}

    #wp-admin-bar ul li ul {
bottom:25px;
}
    </style>';
}
// on backend area
add_action( 'admin_head', 'fb_move_admin_bar' );
// on frontend area
add_action( 'wp_head', 'fb_move_admin_bar' );

// remove links/menus from the admin bar
function mytheme_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('my-account');  
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );



