<?php

/**************************************
WIDGET: sport_fact
***************************************/

	add_action('widgets_init', 'register_widget_sport_fact' );
	function register_widget_sport_fact () {
		register_widget('sport_fact');	
	}

	class sport_fact extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'sport_fact', 								
					'description' => __('Displays a fact box', "loc_sport_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'sport_fact' 														
				);

				parent::__construct('sport_fact', __('Sport: Fact Box', "loc_sport_widgets_plugin"), $widget_ops, $control_ops );	
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
					// 'fb_faces' => 'checked'
				);	
			}

			//defaults
			$defaults = array( 
				'title' 		=> __('Did You Know', "loc_sport_widgets_plugin"),
				'fact1' 		=> "153,000",
				'fact1_ratio' 	=> 0.34,
				'fact2' 		=> "People are following this blog",
				'fact2_ratio' 	=> 1.4,
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('title')); ?> "><?php _e("Title", "loc_sport_widgets_plugin"); ?>: </label><br>
					<input class="widefat" type='text' id='<?php echo esc_attr($this->get_field_id('title')); ?>' name='<?php echo esc_attr($this->get_field_name('title')); ?>' value="<?php if(isset($title)) echo htmlspecialchars($title); ?>">
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('fact1')); ?> "><?php _e("Fact 1st line", "loc_sport_widgets_plugin"); ?>: </label><br>
					<input class="widefat" type='text' id='<?php echo esc_attr($this->get_field_id('fact1')); ?>' name='<?php echo esc_attr($this->get_field_name('fact1')); ?>' value="<?php if(isset($fact1)) echo htmlspecialchars($fact1); ?>">
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('fact1_ratio')); ?> "><?php _e("Fittext ratio", "loc_sport_widgets_plugin"); ?>: <i>(<?php _e("higher numbers = smaller text", "loc_sport_widgets_plugin"); ?>)</i></label><br>
					<input type='text' id='<?php echo esc_attr($this->get_field_id('fact1_ratio')); ?>' name='<?php echo esc_attr($this->get_field_name('fact1_ratio')); ?>' value="<?php if(isset($fact1_ratio)) echo htmlspecialchars($fact1_ratio); ?>">
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('fact2')); ?> "><?php _e("Fact 2nd line", "loc_sport_widgets_plugin"); ?>: </label><br> 
					<input class='widefat' type='text' id='<?php echo esc_attr($this->get_field_id('fact2')); ?>' name='<?php echo esc_attr($this->get_field_name('fact2')); ?>' value="<?php if(isset($fact2)) echo htmlspecialchars($fact2); ?>">
				</p>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('fact2_ratio')); ?> "><?php _e("Fittext ratio", "loc_sport_widgets_plugin"); ?>: <i>(higher numbers = smaller text)</i></label><br>
					<input type='text' id='<?php echo esc_attr($this->get_field_id('fact2_ratio')); ?>' name='<?php echo esc_attr($this->get_field_name('fact2_ratio')); ?>' value="<?php if(isset($fact2_ratio)) echo htmlspecialchars($fact2_ratio); ?>">
				</p>

				<p>
					<label for='<?php echo esc_attr($this->get_field_id('fact_text')); ?>'><?php _e("Fact text", "loc_sport_widgets_plugin"); ?></label><br>
					<textarea class='widefat' id='<?php echo esc_attr($this->get_field_id('fact_text')); ?>' name='<?php echo esc_attr($this->get_field_name('fact_text')); ?>' rows='6'><?php if (isset($fact_text)) echo esc_attr($fact_text); ?></textarea>
				</P>

				<p>
					<label for="<?php echo esc_attr($this->get_field_id('read_more_link')); ?> "><?php _e("Read More Link <i>(optional)</i>", "loc_sport_widgets_plugin"); ?>:</label><br> 
					<input class='widefat' type='text' id='<?php echo esc_attr($this->get_field_id('read_more_link')); ?>' name='<?php echo esc_attr($this->get_field_name('read_more_link')); ?>' value="<?php if(isset($read_more_link)) echo htmlspecialchars($read_more_link); ?>">
				</p>

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
				$title 					= __('Did You Know', "loc_sport_widgets_plugin");
				$fact1 					= "153,000";
				$fact1_ratio 			= 0.34;
				$fact2 					= __('People are following this blog', "loc_sport_widgets_plugin");
				$fact2_ratio 			= 1.4;
			}

			// WPML
			$title = apply_filters('widget_title', empty($instance['title']) ? $title : $instance['title'], $instance );
			if (function_exists('icl_translate') && function_exists('icl_register_string')) {

				// VERSION < 3.3
				icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[fact1]", $fact1);
				icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[fact2]", $fact2);
				icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[fact1_ratio]", $fact1_ratio);
				icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[fact2_ratio]", $fact2_ratio);
				icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[fact_text]", $fact_text);

				$fact1 = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[fact1]", $fact1);
				$fact2 = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[fact2]", $fact2);
				$fact1_ratio = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[fact1_ratio]", $fact1_ratio);
				$fact2_ratio = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[fact2_ratio]", $fact2_ratio);
				$fact_text = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[fact_text]", $fact_text);
			
			} elseif (class_exists('SitePress')) {

				// VERSION > v3.3
				do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[fact1]", $fact1);
				do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[fact2]", $fact2);
				do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[content]", $fact1_ratio);
				do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[content]", $fact2_ratio);
				do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[content]", $fact_text);
				
				$fact1 = apply_filters('wpml_translate_single_string', $fact1, 'loc_sport_widgets_plugin', "$widget_id-widget[fact1]");
				$fact2 = apply_filters('wpml_translate_single_string', $fact2, 'loc_sport_widgets_plugin', "$widget_id-widget[fact2]");
				$fact1_ratio = apply_filters('wpml_translate_single_string', $fact1_ratio, 'loc_sport_widgets_plugin', "$widget_id-widget[fact1_ratio]");
				$fact2_ratio = apply_filters('wpml_translate_single_string', $fact2_ratio, 'loc_sport_widgets_plugin', "$widget_id-widget[fact2_ratio]");
				$fact_text = apply_filters('wpml_translate_single_string', $fact_text, 'loc_sport_widgets_plugin', "$widget_id-widget[fact_text]");
			
			}

			?>

			<?php echo wp_kses_post($before_widget); ?>

			<?php echo wp_kses_post($before_title . $title . $after_title); ?>

			<h4 class="fittext" data-ratio="<?php echo esc_attr($fact1_ratio); ?>"><?php echo esc_attr($fact1); ?></h4>
			<h3 class="fittext" data-ratio="<?php echo esc_attr($fact2_ratio); ?>"><?php echo esc_attr($fact2); ?></h3>

			<?php 

				if (!empty($fact_text) || !empty($read_more_link)) {
					echo "<p>";
					if (!empty($fact_text)) { echo do_shortcode(wp_kses_post($fact_text)); }
					if (!empty($read_more_link)) { printf('&#8230;<a class="read-more" href="%s">%s</a>', esc_url($read_more_link), __("Read More", "loc_sport_widgets_plugin")); }
					echo "</p>";
				}

			?>	

			<?php echo wp_kses_post($after_widget); ?>


			<?php
		}

	} //END CLASS



