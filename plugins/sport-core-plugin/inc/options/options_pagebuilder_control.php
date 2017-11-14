<?php

/****************************************************
DESCRIPTION: 	Canon Page Builder
OPTION HANDLE: 	canon_options_pagebuilder
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options_pagebuilder');

	function register_canon_options_pagebuilder () {
		global $screen_handle_canon_options_pagebuilder;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		$screen_handle_canon_options = add_menu_page(
			'Pagebuilder', 										//page title (appears in the browser title area / on the tab)
			'Pagebuilder', 										//on screen name of options page (appears in left-hand menu)
			'manage_options', 									//capability (user-level) minimum level for access to this page.
			'handle_canon_options_pagebuilder',					//handle of this options page
			'display_canon_options_pagebuilder', 				//the function / callback that runs the whole admin page
			'',													//optional icon url 16x16px
			400													//optional position in the menu. The higher the number the lower down on the menu list it appears.
		);

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options_pagebuilder');	
	
	function init_canon_options_pagebuilder () {
		register_setting(
			'group_canon_options_pagebuilder',				//group name. The group for the fields custom_options_group
			'canon_options_pagebuilder',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options_pagebuilder'				//optional 3rd param. Callback /function to sanitize and validate
		);

		//if this is first runthrough set default values
		if (get_option('canon_options_pagebuilder') == FALSE) {		//trying to get options 'canon_options_pagebuilder' which doesn't yet exist results in FALSE
		 	$options = array (

		 			//'header_banner_code' 		=> '',
		 			//'show_header_banner' 		=> 'checked'
			);

			update_option('canon_options_pagebuilder', $options);
		}
	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	function validate_canon_options_pagebuilder ($new_instance) {

		//remove backslashes
		// if (isset($new_instance['blocks'])) {
		// 	for ($i = 0; $i < count($new_instance['blocks']); $i++) {  
		// 		foreach ($new_instance['blocks'][$i] as $key => $value) {
		// 			$new_instance['blocks'][$i][$key] = preg_replace("{\\\}", "", $new_instance['blocks'][$i][$key]);   // &#92; backslash
		// 		}
		// 	}
		// }

		return $new_instance;
	}

	//display the menus
	function display_canon_options_pagebuilder () {
		require "options_pagebuilder.php";
	}