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
register_activation_hook( __FILE__, 'erm_activation_hook' ); 

if( $activated == "yes" && !wp_is_mobile() ){
	
	// All frontend Actions and Filters
	add_action( 'wp_head' , array( 'ERM_Widget' , 'erm_add_scripts' ) );

	// Adding a div before the post content so it can extracted using JS.
	add_filter( 'the_content' , array( 'ERM_Widget' , 'erm_content_div') );

	// Adding a div before the post title so it can extracted using JS.
	add_filter( 'the_title' , array( 'ERM_Widget' , 'erm_title_div') );

	// Filter to add the button before the content
	add_filter( 'the_content' , array( 'ERM_Widget' , 'erm_add_button' ) );

	// Action to add admin notice
	// add_action( 'admin_notices', array('ERM_Admin', 'erm_admin_notice' ));

	$use_custom_design = esc_attr( get_option('erm_custom_design') );
	
	// Activation Hook
	// add_action('register_activation_hook','erm_activation_hook');

}


function erm_init_hooks(){
	add_action( 'admin_menu' , 'erm_options_page' );
	
}

function erm_options_page(){
	add_action( 'admin_init', array('ERM_Admin', 'erm_register_settings') );
	add_options_page( 'Easy Reading Mode | Options Page' , 'Easy Reading Mode' , 'manage_options' , 'erm-options-page' , array( 'ERM_Admin' , 'erm_options_page' ) );
}

function erm_activation_hook(){
	$is_first_time = get_option('erm_is_first_time');
	// echo $is_first_time;
	if($is_first_time != 'no'){
		update_option('erm_is_activated','yes');
	}else{
		$obj = new ERM_Admin();
		$obj->erm_register_settings();
		update_option('erm_is_first_time','no');
	}
}