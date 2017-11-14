<?php

/**************************************
WIDGET: sport_opening_hours
***************************************/

	add_action('widgets_init', 'register_widget_sport_opening_hours' );
	function register_widget_sport_opening_hours () {
		register_widget('sport_opening_hours');	
	}

	class sport_opening_hours extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'sport_opening_hours', 								
					'description' => __('Display your opening hours.', "loc_sport_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'sport_opening_hours' 														
				);

				parent::__construct('sport_opening_hours', __('Sport: Opening Hours', "loc_sport_widgets_plugin"), $widget_ops, $control_ops );	
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
				'title' 		=> __('Opening Hours', "loc_sport_widgets_plugin"),
				'hours'			=> array(
					0				=> array (
						'when'			=> 'Mondays',
						'hours'			=> 'Closed',
					),
					1				=> array (
						'when'			=> 'Tue-Fri',
						'hours'			=> '10am - 12am',
					),
					2				=> array (
						'when'			=> 'Sat-Sun',
						'hours'			=> '7am - 1am',
					),
					3				=> array (
						'when'			=> 'Public Holidays',
						'hours'			=> '7am - 1am',
					),
				),
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<!-- TEXT -->	
				<p>
					<label for="<?php echo $this->get_field_id('title'); ?> "><?php _e("Title <i>(optional)</i>", "loc_sport_widgets_plugin"); ?>: </label><br>
					<input type='text' id='<?php echo $this->get_field_id('title'); ?>' name='<?php echo $this->get_field_name('title'); ?>' value="<?php if(isset($title)) echo htmlspecialchars($title); ?>">
				</p>

			<!-- SORTABLE UL -->	
 
 				<?php _e("Opening Hours", "loc_cph"); ?>:
				<ul class="widget_sortable opening_hours_ul" data-split_index="3">
				<?php
					for ($i = 0; $i < count($hours); $i++) {  
					?>

						<li>

						<!-- TEXT -->	
							<div class="opening_when">
								<label for="<?php echo $this->get_field_id('hours')."[".$i."][when]"; ?> "><?php _e("When", "loc_sport_widgets_plugin"); ?>: </label><br>
								<input class='li_option' type='text' id='<?php echo $this->get_field_id('hours')."[".$i."][when]"; ?>' name='<?php echo $this->get_field_name('hours')."[".$i."][when]"; ?>' value="<?php if(isset($hours[$i]['when'])) echo htmlspecialchars($hours[$i]['when']); ?>">
							</div>


						<!-- TEXT -->	
							<div class="opening_hours">
								<label for="<?php echo $this->get_field_id('hours')."[".$i."][hours]"; ?> "><?php _e("Hours", "loc_sport_widgets_plugin"); ?>: </label><br>
								<input class='li_option' type='text' id='<?php echo $this->get_field_id('hours')."[".$i."][hours]"; ?>' name='<?php echo $this->get_field_name('hours')."[".$i."][hours]"; ?>' value="<?php if(isset($hours[$i]['hours'])) echo htmlspecialchars($hours[$i]['hours']); ?>">
							</div>


						</li>
					<?php
					}
				?>

				</ul>

				<div class="ul_control" data-min="1" data-max="1000">
					<input type="button" class="button ul_add" value="<?php _e("Add", "loc_sport_widgets_plugin"); ?>" />
					<input type="button" class="button ul_del" value="<?php _e("Delete", "loc_sport_widgets_plugin"); ?>" />
				</div>

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
				$title 		= __('Opening Hours', "loc_sport_widgets_plugin");
			}

            // WPML
			$title = apply_filters('widget_title', empty($instance['title']) ? $title : $instance['title'], $instance );

			?>

			<?php echo $before_widget; ?>

			<?php if (!empty($title)) { echo $before_title . $title . $after_title; } ?>

			<ul class="ophours">

				<?php
					
					for ($i = 0; $i < count($hours); $i++) {  

			            // WPML
						if (function_exists('icl_translate') && function_exists('icl_register_string')) {

				            // VERSION < 3.3
				            icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[$i][when]", $hours[$i]['when']);
				            icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[$i][hours]", $hours[$i]['hours']);

				            $hours[$i]['when'] = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[$i][when]", $hours[$i]['when']);
				            $hours[$i]['hours'] = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[$i][hours]", $hours[$i]['hours']);
						
						} elseif (class_exists('SitePress')) {
				            
				            // VERSION > v3.3
				            do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[$i][when]", $hours[$i]['when']);
				            do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[$i][hours]", $hours[$i]['hours']);
				            
				            $hours[$i]['when'] = apply_filters('wpml_translate_single_string', $hours[$i]['when'], 'loc_sport_widgets_plugin', "$widget_id-widget[$i][when]");
				            $hours[$i]['hours'] = apply_filters('wpml_translate_single_string', $hours[$i]['hours'], 'loc_sport_widgets_plugin', "$widget_id-widget[$i][hours]");
						
						}

						printf('<li>%s	<span>%s</span></li>', esc_attr($hours[$i]['when']), esc_attr($hours[$i]['hours']));
					}
				
				?>

			</ul>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



