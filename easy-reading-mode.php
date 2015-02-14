<?php
/**
 * Plugin Name: Easy Reading Mode
 * Plugin URI: http://igandhi.com
 * Description: This plugin allows users to read your blog/article in distraction free reading mode.
 * Version: 1.1.3
 * Author: Shreyans Gandhi
 * Author URI: http://igandhi.com
 * License: GPL2
 */

// ERM Prefix is used for all variables and function name. ERM stands for Easy Reading Mode

define( 'ERM__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'ERM__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once( ERM__PLUGIN_DIR . 'class.erm-admin.php' );
require_once( ERM__PLUGIN_DIR . 'class.erm-widget.php' );

// Initialising all hooks - actions and filters
add_action( 'init', 'erm_init_hooks' );



$activated = esc_attr( get_option('erm_is_activated') );

if( $activated == "yes" && !wp_is_mobile() ){
	
	// All frontend Actions and Filters
	add_action( 'wp_head' , array( 'ERM_Widget' , 'erm_add_scripts' ) );

	// Adding a div before the post content so it can extracted using JS.
	add_filter( 'the_content' , array( 'ERM_Widget' , 'erm_content_div') );

	// Adding a div before the post title so it can extracted using JS.
	add_filter( 'the_title' , array( 'ERM_Widget' , 'erm_title_div') );

	// Filter to add the button before the content
	add_filter( 'the_content' , array( 'ERM_Widget' , 'erm_add_button' ) );

	$use_custom_design = esc_attr( get_option('erm_use_custom_design') );
	
	if($use_custom_design == "yes"){
		add_action( 'wp_head', array( 'ERM_Widget', 'erm_add_custom_design_css' ));
	}

}


function erm_init_hooks(){
	add_action( 'admin_menu' , array( 'ERM_Admin' , 'erm_admin_menu_options' ));
}
