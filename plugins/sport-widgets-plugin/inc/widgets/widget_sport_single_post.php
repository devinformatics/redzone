<?php

/**************************************
WIDGET: sport_single_post
***************************************/

	add_action('widgets_init', 'register_widget_sport_single_post' );
	function register_widget_sport_single_post () {
		register_widget('sport_single_post');	
	}

	class sport_single_post extends WP_Widget {

		/**************************************
		1. INIT
		***************************************/
		function __construct () {

				$widget_ops = array(
					'classname' => 'sport_single_post', 								
					'description' => __('Displays a single post', "loc_sport_widgets_plugin")	 				
				);
				$control_ops = array(
					'width' => 300, 
					'height' => 350, 
					'id_base' => 'sport_single_post' 														
				);

				parent::__construct('sport_single_post', __('Sport: Single Post', "loc_sport_widgets_plugin"), $widget_ops, $control_ops );	
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
					'use_short_excerpt' => 'checked',
				);	
			}

			//defaults
			$defaults = array( 
				'title' 	=> 'Featured Post',
				'orderby' 	=> 'post_date',
				'order' 	=> 'DESC',
			);

			//merge default
			if (!empty($defaults_checkboxes)) $defaults = array_merge($defaults, $defaults_checkboxes);

			$instance = wp_parse_args($instance, $defaults);
			extract($instance);
			
			//basic args
			$query_args = array();
			$query_args = array_merge($query_args, array(
				'post_type'    		=> 'post',
				'numberposts' 		=> -1,
				'post_status'     	=> 'publish',
				'offset' 			=> 0,
				'suppress_filters' 	=> false,
				'orderby'			=> $orderby,
				'order'				=> $order,
			));

			//final query
			$results_query = get_posts($query_args);


			?>

				<p>
					<label for="<?php echo $this->get_field_id('orderby'); ?> "><?php _e("Order posts by", "loc_sport_widgets_plugin"); ?>:</label><br>
					<select name="<?php echo $this->get_field_name('orderby'); ?>"> 
		     			<option value="post_date" <?php if (isset($orderby)) {if ($orderby == "date") echo "selected='selected'";} ?>><?php _e("Date", "loc_sport_widgets_plugin"); ?></option> 
		     			<option value="title" <?php if (isset($orderby)) {if ($orderby == "title") echo "selected='selected'";} ?>><?php _e("Title", "loc_sport_widgets_plugin"); ?></option> 
					</select> 

					<select name="<?php echo $this->get_field_name('order'); ?>"> 
		     			<option value="DESC" <?php if (isset($order)) {if ($order == "DESC") echo "selected='selected'";} ?>><?php _e("Descending", "loc_sport_widgets_plugin"); ?></option> 
		     			<option value="ASC" <?php if (isset($order)) {if ($order == "ASC") echo "selected='selected'";} ?>><?php _e("Ascending", "loc_sport_widgets_plugin"); ?></option> 
					</select> 
				</p>

				<p><i>(<?php _e("Takes effect on save", "loc_sport_widgets_plugin"); ?>)</i></p>
				<hr>

				<p>
					<label for="<?php echo $this->get_field_id('title'); ?> "><?php _e("Title", "loc_sport_widgets_plugin"); ?>: </label><br>
					<input type='text' id='<?php echo $this->get_field_id('title'); ?>' name='<?php echo $this->get_field_name('title'); ?>' value="<?php if(isset($title)) echo htmlspecialchars($title); ?>">
				</p>

				<p>	
					<label for="<?php echo $this->get_field_id('post_ID'); ?> "><?php _e("Display post", "loc_sport_widgets_plugin"); ?>:</label><br>
					<select name="<?php echo $this->get_field_name('post_ID'); ?>">
						<?php 

							for ($i = 0; $i < count($results_query); $i++) {
								$this_post = $results_query[$i];
							?>
		     					<option value="<?php echo $this_post->ID; ?>" <?php if (isset($post_ID)) {if ($post_ID == $this_post->ID) echo "selected='selected'";} ?>><?php echo $this_post->post_title; ?></option> 
							<?php
							}

						?> 
					</select> 
				</p>

				<p>
					<input type="hidden" name="<?php echo $this->get_field_name( 'use_short_excerpt' ); ?>" value="unchecked" />
					<input class="checkbox" type="checkbox" id="<?php echo $this->get_field_id( 'use_short_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'use_short_excerpt' ); ?>" value="checked" <?php checked($use_short_excerpt == "checked"); ?>/> 
					<label for="<?php echo $this->get_field_id( 'use_short_excerpt' ); ?>"><?php _e("Use short excerpt?", "loc_sport_widgets_plugin"); ?></label>
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
				$title 				= 'Featured Post';
				$orderby 			= 'post_date';
				$order 				= 'DESC';
				$use_short_excerpt  = 'checked';
			}

			// set this_post
			if (isset($post_ID)) {

                // WPML
                if (function_exists('icl_translate')) { $post_ID = icl_object_id($post_ID); }

				$this_post = get_post($post_ID);

			} else {
				$query_args = array();
				$query_args = array_merge($query_args, array(
					'post_type'    		=> 'post',
					'numberposts' 		=> 1,
					'post_status'     	=> 'publish',
					'offset' 			=> 0,
					'suppress_filters' 	=> false,
					'orderby'			=> "date",
					'order'				=> "DESC",
				));

				$this_post = get_posts($query_args);
				$this_post = $this_post[0];
			}

			// get post data
            $cmb_excerpt = get_post_meta($this_post->ID, 'cmb_excerpt', true);
            $cmb_feature = get_post_meta($this_post->ID, 'cmb_feature', true);
            $cmb_media_link = get_post_meta($this_post->ID, 'cmb_media_link', true);
            $this_post_publish_date = mb_localize_datetime(get_the_time("j M", $this_post->ID));


            // set vars
            $short_excerpt_length = 70;
            $default_excerpt_length = 210;

            // WPML
			$title = apply_filters('widget_title', empty($instance['title']) ? $title : $instance['title'], $instance );

			?>

			<?php echo $before_widget; ?>

			<?php echo $before_title . $title . $after_title; ?>

			
			<!-- featured image -->
			<?php 

                if ( ($cmb_feature == "media") && (!empty($cmb_media_link)) ) {
                    echo $cmb_media_link;
                } elseif ( ($cmb_feature == "media_in_lightbox") && (!empty($cmb_media_link)) && get_post(get_post_thumbnail_id($this_post->ID)) ) {
                    echo '<div class="mosaic-block fade">';
                    $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'full');
                    $img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
                    printf('<a href="%s" class="mosaic-overlay fancybox-media fancybox.iframe play"></a>', esc_url($cmb_media_link));
                    printf('<div class="mosaic-backdrop"><div class="corner-date">%s</div><img src="%s" alt="%s" /></div>', esc_attr($this_post_publish_date), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                    echo '</div>';
                } elseif (has_post_thumbnail($this_post->ID) && get_post(get_post_thumbnail_id($this_post->ID)) ) { 
                    echo '<div class="mosaic-block fade">';
                    $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_post->ID),'full');
                    $img_alt = get_post_meta(get_post_thumbnail_id($this_post->ID), '_wp_attachment_image_alt', true);
                    $img_post = get_post(get_post_thumbnail_id($this_post->ID));
                    printf('<a href="%s" class="mosaic-overlay fancybox" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_title));
                    printf('<div class="mosaic-backdrop"><div class="corner-date">%s</div><img src="%s" alt="%s" /></div>', esc_attr($this_post_publish_date), esc_url($post_thumbnail_src[0]), esc_attr($img_alt));
                    echo '</div>';
                }
			?>

			<!-- title -->
			<h3 class="title"><a href="<?php echo get_permalink($this_post->ID); ?>"><?php echo $this_post->post_title; ?></a></h3>

            <!-- excerpt -->
            <?php 
            	if ($use_short_excerpt == "checked") {
            		echo mb_make_excerpt($this_post->post_content, $short_excerpt_length, true); 
            	} else {
            		if (empty($cmb_excerpt)) {
            			echo mb_make_excerpt($this_post->post_content, $default_excerpt_length, true); 
            		} else {
            			echo do_shortcode($cmb_excerpt);
            		} 
            	}
            ?>

            <a href="<?php echo get_permalink($this_post->ID); ?>" class="more"><?php _e("More", "loc_sport_widgets_plugin"); ?></a>



			<?php echo $after_widget; ?>


			<?php
		}

	} //END CLASS



