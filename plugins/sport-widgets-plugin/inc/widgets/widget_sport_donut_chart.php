<?php

/**************************************
WIDGET: sport_donut_chart
***************************************/

	add_action('widgets_init', 'register_widget_sport_donut_chart' );
	function register_widget_sport_donut_chart () {
		register_widget('sport_donut_chart');	
	}

	class sport_donut_chart extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'sport_donut_chart', 								
					'description' => __('Display a donut chart', "loc_sport_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'sport_donut_chart' 														
				);

				parent::__construct('sport_donut_chart', __('Sport: Donut Chart', "loc_sport_widgets_plugin"), $widget_ops, $control_ops );	
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
				'title' 				=> "",
				'postfix' 				=> "",
				'text' 					=> "",
				'chart_data'			=> array(
					0						=> array(
						'label'					=> "1st Label",
						'value'					=> 20,
						'color'					=> "#3980b5",
					),
					1						=> array(
						'label'					=> "2nd Label",
						'value'					=> 80,
						'color'					=> "#0b62a4",
					),
				),
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			?>

			<!-- WIDGET TITLE -->
				<p>
					<label for="<?php echo $this->get_field_id('title'); ?> "><?php _e("Title <i>(optional)</i>", "loc_sport_widgets_plugin"); ?>: </label><br>
					<input type='text' id='<?php echo $this->get_field_id('title'); ?>' name='<?php echo $this->get_field_name('title'); ?>' value="<?php if(isset($title)) echo htmlspecialchars($title); ?>">
				</p>

			<!-- POSTFIX -->
				<p>
					<label for="<?php echo $this->get_field_id('postfix'); ?> "><?php _e("Data value postfix <i>(optional)</i>", "loc_sport_widgets_plugin"); ?> </label><br>
					<input type='text' id='<?php echo $this->get_field_id('postfix'); ?>' name='<?php echo $this->get_field_name('postfix'); ?>' value="<?php if(isset($postfix)) echo htmlspecialchars($postfix); ?>">
				</p>

			<!-- TEXT -->
				<p>
					<label for='<?php echo $this->get_field_id('text'); ?>'><?php _e("Text <i>(optional)</i>", "loc_sport_widgets_plugin"); ?></label><br>
					<textarea class='widefat' id='<?php echo $this->get_field_id('text'); ?>' name='<?php echo $this->get_field_name('text'); ?>' rows='5'><?php if (isset($text)) echo esc_attr($text); ?></textarea>
				</P>

			<!-- DATA -->
				<br>
				<?php _e("Chart data", "loc_sport_widgets_plugin"); ?>:
				<ul class="widget_sortable" data-split_index="3">
				<?php
					for ($i = 0; $i < count($chart_data); $i++) {  
					?>

						<li>
						<!-- LABEL -->
							<input class="widefat li_option" type='text' name='<?php echo $this->get_field_name('chart_data')."[".$i."][label]"; ?>' value="<?php if(isset($chart_data[$i]['label'])) echo htmlspecialchars($chart_data[$i]['label']); ?>">
						
						<!-- VALUE -->
							<input 
								class= "li_option"
								style='width: 80px;'
								type='number' 
								min='0'
								max='1000000'
								step='1'
								id='<?php echo $this->get_field_id('chart_data')."[".$i."][value]"; ?>' 
								name='<?php echo $this->get_field_name('chart_data')."[".$i."][value]"; ?>' 
								value='<?php if(isset($chart_data[$i]['value'])) echo $chart_data[$i]['value']; ?>'
							>

						<!-- COLORPICKER -->
							<p>
								<div class="colorSelectorBox widget_color_selector"><div style="background-color: <?php echo $chart_data[$i]['color']; ?>"></div></div>
								<input class='li_option color_input' type="text" name="<?php echo $this->get_field_name('chart_data')."[".$i."][color]"; ?>" value="<?php if(isset($chart_data[$i]['value'])) echo $chart_data[$i]['color']; ?>" />    
							</P>
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

 			// DEFAULTS
			if (empty($instance)) {
					$instance['title']			= "";
					$instance['postfix'] 		= "";
					$instance['text']			= "";
					$instance['chart_data']		= array(
						0							=> array(
							'label'						=> "1st Label",
							'value'						=> 20,
							'color'						=> "#3980b5",
						),
						1							=> array(
							'label'						=> "2nd Label",
							'value'						=> 80,
							'color'						=> "#0b62a4",
						),
					);
			}

			extract($instance);
            $modified_instance = $instance;	// create modified instance which contains data passed to donut chart script
            unset($modified_instance['title']);	// not needed in modified instance
            unset($modified_instance['text']); // not needed in modified instance
			ksort($modified_instance['chart_data']);

           // WPML
			$title = apply_filters('widget_title', empty($instance['title']) ? $title : $instance['title'], $instance );
			if (function_exists('icl_translate') && function_exists('icl_register_string')) {

				// VERSION < 3.3
				icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[postfix]", $modified_instance['postfix']);
				icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[text]", $text);

				$modified_instance['postfix'] = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[postfix]", $modified_instance['postfix']);
				$text = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[text]", $text);
			
			} elseif (class_exists('SitePress')) {

				// VERSION > v3.3
				do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[postfix]", $modified_instance['postfix']);
				do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[text]", $text);
				
				$modified_instance['postfix'] = apply_filters('wpml_translate_single_string', $modified_instance['postfix'], 'loc_sport_widgets_plugin', "$widget_id-widget[postfix]");
				$text = apply_filters('wpml_translate_single_string', $text, 'loc_sport_widgets_plugin', "$widget_id-widget[text]");
			
			}


            foreach ($modified_instance['chart_data'] as $key => $value) {

	            // WPML
				if (function_exists('icl_translate') && function_exists('icl_register_string')) {

		            // VERSION < 3.3
		            icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[$key][label]", $value['label']);
		            icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[$key][value]", $value['value']);

		            $value['label'] = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[$key][label]", $value['label']);
		            $value['value'] = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[$key][value]", $value['value']);
				
				} elseif (class_exists('SitePress')) {
		            
		            // VERSION > v3.3
		            do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[$key][label]", $value['label']);
		            do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[$key][value]", $value['value']);
		            
		            $value['label'] = apply_filters('wpml_translate_single_string', $value['label'], 'loc_sport_widgets_plugin', "$widget_id-widget[$key][label]");
		            $value['value'] = apply_filters('wpml_translate_single_string', $value['value'], 'loc_sport_widgets_plugin', "$widget_id-widget[$key][value]");
				
				}

            	$modified_instance['chart_data'][$key]['label'] = str_replace("'", "&#39;", $value['label']);
            	$modified_instance['chart_data'][$key]['value'] = $value['value'];
            }

			?>

			<?php echo $before_widget; ?>

			<?php if (!empty($title)) { echo $before_title . $title . $after_title; } ?>

				<div id="<?php echo $args['widget_id']; ?>_chart_container" class="donut_chart" data-instance='<?php echo json_encode($modified_instance); ?>'>
				</div>

			<?php if (!empty($text)) { printf('<p>%s</p>', esc_attr($text)); } ?>

			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



