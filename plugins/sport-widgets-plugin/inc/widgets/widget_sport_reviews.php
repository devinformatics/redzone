<?php

/**************************************
WIDGET: sport_reviews
***************************************/

	add_action('widgets_init', 'register_widget_sport_reviews' );
	function register_widget_sport_reviews () {
		register_widget('sport_reviews');	
	}

	class sport_reviews extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'sport_reviews', 								
					'description' => __('Display reviews.', "loc_sport_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'sport_reviews' 														
				);

				parent::__construct('sport_reviews', __('Sport: Reviews', "loc_sport_widgets_plugin"), $widget_ops, $control_ops );	
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
				'title' 	=> __('Game Reviews', "loc_sport_widgets_plugin"),
				'reviews' 		=> array(
					0 				=> array(
						'customer_name'	=> 'Matt Jonas',
						'rating'		=> 3,
						'review'		=> 'Maecenas sed diam eget risus varius blandit sit amet non mag. Donec sed odio du dapibus.',
					),
					1 				=> array(
						'customer_name'	=> 'Jack Bauer',
						'rating'		=> 2,
						'review'		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
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

				<?php _e("Review", "loc_cph"); ?>:
				<ul class="widget_sortable" data-split_index="3">
				<?php
					for ($i = 0; $i < count($reviews); $i++) {  
					?>

						<li>

						<!-- TEXT -->	
							<p>
								<label for="<?php echo $this->get_field_id('reviews')."[".$i."][customer_name]"; ?> "><?php _e("Name", "loc_sport_widgets_plugin"); ?>: </label><br>
								<input class="li_option" type='text' id='<?php echo $this->get_field_id('reviews')."[".$i."][customer_name]"; ?>' name='<?php echo $this->get_field_name('reviews')."[".$i."][customer_name]"; ?>' value="<?php if(isset($reviews[$i]['customer_name'])) echo htmlspecialchars($reviews[$i]['customer_name']); ?>">
							</p>

						<!-- NUMBER -->	
							<p>
								<label for='<?php echo $this->get_field_id('reviews')."[".$i."][rating]"; ?>'><?php _e("Rating", "loc_sport_widgets_plugin"); ?>	: </label><br>
								<input 
									style='width: 50px;'
									type='number' 
									min='1'
									max='5'
									step='1'
									id='<?php echo $this->get_field_id('reviews')."[".$i."][rating]"; ?>' 
									name='<?php echo $this->get_field_name('reviews')."[".$i."][rating]"; ?>' 
									value='<?php if (isset($reviews[$i]['rating'])) echo esc_attr($reviews[$i]['rating']); ?>'
									class='li_option'
								>
							</p>


						<!-- TEXTAREA -->	
							<p>
								<textarea class='widefat li_option' name='<?php echo $this->get_field_name('reviews')."[".$i."][review]"; ?>' rows='5'><?php if (isset($reviews[$i]['review'])) echo $reviews[$i]['review']; ?></textarea>
							</p>


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
				$title 	= __('Customer Reviews', "loc_sport_widgets_plugin");
			}

            // WPML
			$title = apply_filters('widget_title', empty($instance['title']) ? $title : $instance['title'], $instance );

			?>

			<?php echo $before_widget; ?>

			<?php if (!empty($title)) { echo $before_title . $title . $after_title; } ?>

			<div class="flexslider flexslider-menu raveReviews">
				<ul class="slides">
					

				<?php 

					for ($i = 0; $i < count($reviews); $i++) { 

			            // WPML
						if (function_exists('icl_translate') && function_exists('icl_register_string')) {

				            // VERSION < 3.3
				            icl_register_string ('loc_sport_widgets_plugin', "$widget_id-widget[$i][review]", $reviews[$i]['review']);

				            $reviews[$i]['review'] = icl_translate('loc_sport_widgets_plugin', "$widget_id-widget[$i][review]", $reviews[$i]['review']);
						
						} elseif (class_exists('SitePress')) {
				            
				            // VERSION > v3.3
				            do_action('wpml_register_single_string', 'loc_sport_widgets_plugin', "$widget_id-widget[$i][review]", $reviews[$i]['review']);
				            
				            $reviews[$i]['review'] = apply_filters('wpml_translate_single_string', $reviews[$i]['review'], 'loc_sport_widgets_plugin', "$widget_id-widget[$i][review]");
						
						}

						$rating_string = "";
						for ($n = 0; $n < $reviews[$i]['rating']; $n++) {
						 	$rating_string .= " ";
						 } 
						 printf('<li><blockquote>“%s”<cite>- %s <span class="sportrate">%s</span></cite></blockquote></li>', esc_attr($reviews[$i]['review']), esc_attr($reviews[$i]['customer_name']), esc_attr($rating_string));
					}

				?>

				</ul>
			</div>



			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



