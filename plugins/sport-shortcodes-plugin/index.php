<?php

/*
Plugin Name: Sport Shortcodes Plugin
Plugin URI: http://www.themecanon.com
Description: Shortcodes plugin for Sport theme by Theme Canon.
Version: 1.2
Author: ThemeCanon
Auhtor URI: http://www.themecanon.com
*/



/**************************************
INDEX

INFO
PHP INCLUDES
WP ENQUEUE
PLUGIN LOCALIZATION INIT

***************************************/

/**************************************
INFO

Lightbox shortcodes are dependent upon fancybox which is not included in plugin.

***************************************/


/**************************************
PHP INCLUDES
***************************************/

	include 'inc/functions/shortcodes.php';



/**************************************
WP ENQUEUE
***************************************/

	//front end includes
	add_action('wp_enqueue_scripts','sport_shortcodes_plugin_load_to_front');
	function sport_shortcodes_plugin_load_to_front() {

		// scripts (js)
		wp_enqueue_script('sport_shortcodes_plugin_scripts', plugins_url('', __FILE__ ) . '/js/scripts.js', array(), false, true);
		wp_enqueue_script('sport_shortcodes_plugin_flexslider', plugins_url('', __FILE__ ) . '/js/jquery.flexslider-min.js', array(), false, true);
		
		//style (css)	
		wp_enqueue_style('sport_shortcodes_plugin_style', plugins_url('', __FILE__ ) . '/css/tc_shortCodes.css');
		wp_enqueue_style('sport_shortcodes_plugin_flexslider_style', plugins_url('', __FILE__ ) . '/css/flexslider.css');
		
	}

	//back end includes
	add_action('admin_enqueue_scripts', 'sport_shortcodes_plugin_load_to_back');
	function sport_shortcodes_plugin_load_to_back() {

	}


/**************************************
PLUGIN LOCALIZATION INIT
***************************************/

	add_action('after_setup_theme', 'sport_shortcodes_plugin_localization_setup');
	function sport_shortcodes_plugin_localization_setup() {
        load_plugin_textdomain('loc_sport_shortcodes_plugin', false,  dirname( plugin_basename( __FILE__ ) ) . '/lang/');
	}