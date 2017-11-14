<?php

/**************************************
WIDGET: sport_contact_list
***************************************/

	add_action('widgets_init', 'register_widget_sport_contact_list' );
	function register_widget_sport_contact_list () {
		register_widget('sport_contact_list');	
	}

	class sport_contact_list extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'sport_contact_list', 								
					'description' => __('Display a list of contact links', "loc_sport_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'sport_contact_list' 														
				);

				parent::__construct('sport_contact_list', __('Sport: Contact list', "loc_sport_widgets_plugin"), $widget_ops, $control_ops );	
		}

		/**************************************
		2. UPDATE
		***************************************/
		function update($new_instance, $old_instance) {
			return $new_instance;	 
		}

		/**************************************
		3. FORM
		***************************************/
		function form($instance) {

			//default for checkboxes
			if (empty($instance)) {
				$defaults_checkboxes = array(
				);	
			}

			//defaults
			$defaults = array( 
				'title' 	=> __('Find us at', "loc_sport_widgets_plugin"),
				'content' 	=> '<ul>
    <li><a href="#">facebook.com/sport</a></li>
    <li><a href="#">dribbble.com/sport</a></li>
    <li><a href="#">Twitter.com/sport</a></li>
    <li>PO Box 4356, Melbourne 4000
    Victoria, Australia</li>
</ul> ',
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

				<p>
					<label for="<?php echo $this->get_field_id('title'); ?> "><?php _e("Title:", "loc_sport_widgets_plugin"); ?> </label><br>
					<input type='text' id='<?php echo $this->get_field_id('title'); ?>' name='<?php echo $this->get_field_name('title'); ?>' value="<?php if(isset($title)) echo htmlspecialchars($title); ?>">
				</p>

				<p>
					<label for='<?php echo $this->get_field_id('content'); ?>'><?php _e("List of contact links", "loc_sport_widgets_plugin"); ?></label><br>
					<textarea class='widefat' id='<?php echo $this->get_field_id('content'); ?>' name='<?php echo $this->get_field_name('content'); ?>' rows='15'><?php if (isset($content)) echo esc_attr($content); ?></textarea>
				</P>

			<?php
		}

		/**************************************
		4. DISPLAY
		***************************************/
		function widget($args, $instance) {
			extract($args);								
			extract($instance);							

 			// DEFAULTS
			if (empty($instance)) {
				$title		= __('Find us at', "loc_sport_widgets_plugin");
				$content	= '<ul>
				    <li><a href="#">facebook.com/sport</a></li>
				    <li><a href="#">dribbble.com/sport</a></li>
				    <li><a href="#">Twitter.com/sport</a></li>
				    <li>PO Box 4356, Melbourne 4000
				    Victoria, Australia</li>
				</ul> ';
			}

           	// WPML
			$title = apply_filters('widget_title', empty($instance['title']) ? $title : $instance['title'], $instance );
			if (function_exists('icl_translate') && function_exists('icl_register_string')) {

				// VERSION < 3.3
				icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[content]", $content);

				$content = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[content]", $content);
			
			} elseif (class_exists('SitePress')) {

				// VERSION > v3.3
				do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[content]", $content);
				
				$content = apply_filters('wpml_translate_single_string', $content, 'loc_sport_widgets_plugin', "$widget_id-widget[content]");
			
			}


			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $title . $after_title; ?>

			<?php echo $content; ?>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



