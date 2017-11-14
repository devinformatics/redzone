<?php

/*
Plugin Name: Sport Core Plugin
Plugin URI: http://www.themecanon.com
Description: Core functionality plugin for Sport theme by Theme Canon.
Version: 1.5
Author: ThemeCanon
Auhtor URI: http://www.themecanon.com
*/



/**************************************
INDEX

PHP INCLUDES
WP ENQUEUE
PLUGIN LOCALIZATION INIT

***************************************/



/**************************************
PHP INCLUDES
***************************************/

	// custom post types and custom meta boxes
	include 'inc/functions/functions_register_cpt_people.php';
	include 'inc/functions/functions_register_cpt_project.php';
	include 'inc/functions/functions_cmb_pages.php';
	include 'inc/functions/functions_cmb_posts.php';
	include 'inc/functions/functions_cmb_cpt_people.php';
	include 'inc/functions/functions_cmb_cpt_project.php';

	include 'canon_pagebuilder_index.php';



/**************************************
WP ENQUEUE
***************************************/

	//front end includes
	add_action('wp_enqueue_scripts','sport_core_plugin_load_to_front');
	function sport_core_plugin_load_to_front() {
	}

	//back end includes
	add_action('admin_enqueue_scripts', 'sport_core_plugin_load_to_back');  //this was changed to admin_enqueue_scripts from action hook admin_footer. Let's see if it makes a difference
	function sport_core_plugin_load_to_back() {

		//scripts (js)
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui', false, array(), false, false);
		wp_enqueue_script('jquery-ui-sortable', false, array(), false, true);
		wp_enqueue_script('thickbox', false, array(), false, true);					
		wp_enqueue_script('media-upload', false, array(), false, true);
		// wp_enqueue_script('canon_colorpicker', get_template_directory_uri() . '/js/colorpicker.js', array(), false, true);
		wp_enqueue_script('sport_core_plugin_backend_scripts', plugins_url('', __FILE__ ) . '/js/backend_scripts.js', array(), false, true);

		//style (css)	
		wp_enqueue_style('sport_core_plugin_style', plugins_url('', __FILE__ ) . '/css/style.css');

	}


/**************************************
PLUGIN LOCALIZATION INIT
***************************************/

	add_action('after_setup_theme', 'sport_core_plugin_localization_setup');
	function sport_core_plugin_localization_setup() {
	    load_plugin_textdomain('loc_sport_core_plugin', false,  dirname( plugin_basename( __FILE__ ) ) . '/lang/');
	}

 