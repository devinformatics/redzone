<?php

/**************************************
CUSTOM META FIELD
***************************************/

	//metaboxes
	add_action('add_meta_boxes', 'register_cmb_canon_cpt_people');
	add_action ('save_post', 'update_cmb_canon_cpt_people');

	function register_cmb_canon_cpt_people () {
		add_meta_box('cmb_canon_cpt_people','Sport People Settings', 'display_cmb_canon_cpt_people','cpt_people','normal','high');
	}

	function display_cmb_canon_cpt_people ($post) {

	/**************************************
	GET VALUES
	***************************************/

	// OPTIONS
		$default_excerpt_len = 80;

		$cmb_title = get_post_meta($post->ID, 'cmb_title', true);
		$cmb_info = get_post_meta($post->ID, 'cmb_info', true);
		$cmb_excerpt = get_post_meta($post->ID, 'cmb_excerpt', true);
		$cmb_excerpt_is_quote = get_post_meta($post->ID, 'cmb_excerpt_is_quote', true);
		$cmb_index = get_post_meta($post->ID, 'cmb_index', true);
		$cmb_show_social_links = get_post_meta($post->ID, 'cmb_show_social_links', true);
		$cmb_social_links = get_post_meta($post->ID, 'cmb_social_links', true);

		$cmb_exist = get_post_meta($post->ID, 'cmb_exist', true);


		//make sure (empty) arrays are defined as arrays
		if (empty($cmb_social_links)) $cmb_social_links = array();


		//defaults
		if (empty($cmb_exist)) {
			
			update_post_meta($post->ID, 'cmb_excerpt_is_quote', 'unchecked');
			update_post_meta($post->ID, 'cmb_show_social_links', 'checked');
			update_post_meta($post->ID, 'cmb_index', 1000);

		}

	/**************************************
	DISPLAY CONTENT
	***************************************/

		?>

	<!-- DETAILS -->

		<div class="option_heading">
			<span><?php _e("Details", "loc_sport_core_plugin"); ?></span>
		</div>

		<?php
			
			fw_cmb_option(array(
				'type'					=> 'text',
				'title' 				=> __('Title / position', 'loc_sport_core_plugin'),
				'slug' 					=> 'cmb_title',
				'class'					=> 'widefat',
				'post_id'				=> $post->ID,
			)); 
		
			fw_cmb_option(array(
				'type'					=> 'textarea',
				'title' 				=> __('Info', 'loc_sport_core_plugin'),
				'slug' 					=> 'cmb_info',
				'rows'					=> '5',
				'hint'					=> __('Optional. HTML allowed.', 'loc_sport_core_plugin'),
				'class'					=> 'widefat',
				'post_id'				=> $post->ID,
			)); 

		?>

		<div class="option_item">
			<label for='cmb_excerpt'><?php _e("Excerpt / Quote", "loc_sport_core_plugin"); ?></label><br>
			<textarea id='cmb_excerpt' name='cmb_excerpt' class='widefat' rows='5'><?php if (!empty($cmb_excerpt)) echo $cmb_excerpt; ?></textarea>
			<button type="button" name="button_generate_excerpt" id='button_generate_excerpt' class="button-secondary auto_generate" value="<?php echo mb_make_excerpt($post->post_content, $default_excerpt_len, true); ?>">Auto-generate</button>
			<span class="item_hint float_right"><?php _e("Optional. HTML allowed", "loc_sport_core_plugin"); ?></span>
		</div>

		<?php
			
			fw_cmb_option(array(
				'type'					=> 'checkbox',
				'title' 				=> __('Display excerpt as quote', 'loc_sport_core_plugin'),
				'slug' 					=> 'cmb_excerpt_is_quote',
				'post_id'				=> $post->ID,
			)); 
								
			fw_cmb_option(array(
				'type'					=> 'number',
				'title' 				=> __('Position index <span class="item_hint">(determines order of appearance)</span>', 'loc_sport_core_plugin'),
				'slug' 					=> 'cmb_index',
				'min'					=> '1',										// optional
				'max'					=> '100000',								// optional
				'step'					=> '1',										// optional
				'width_px'				=> '60',									// optional
				'post_id'				=> $post->ID,
			)); 
		
		?>		



	<!-- SOCIAL LINKS -->

		<div class="option_heading">
			<span>Social Links</span>
		</div>

		<div class="option_item">
		
			<input type="hidden" name="cmb_show_social_links" value="unchecked" />
			<input type='checkbox' name='cmb_show_social_links' value='checked' <?php checked($cmb_show_social_links == "checked"); ?>>
			<label for='cmb_show_social_links'><?php _e("Show social links:", "loc_sport_core_plugin"); ?></label>

			<table class='form-table cmb_social_links'>
				<?php 

					$font_awesome_array = mb_get_font_awesome_icon_names_in_array();

					$social_links_num = (!empty($cmb_social_links)) ? count($cmb_social_links) : 1;

					for ($i = 0; $i < $social_links_num; $i++) {  
					?>

					<tr valign='top' class='cmb_social_links_row'>
						<th scope='row'>Social link <?php echo $i+1; ?></th>
						<td>
							<select class="cmb_social_links_icon fa_select" name='cmb_social_links[<?php echo $i; ?>][icon]'> 
								<?php 

									for ($n = 0; $n < count($font_awesome_array); $n++) {  
									?>
				     					<option value="<?php echo $font_awesome_array[$n]; ?>" <?php if (isset($cmb_social_links[$i]['icon'])) {if ($cmb_social_links[$i]['icon'] == $font_awesome_array[$n]) echo "selected='selected'";} ?>><?php echo $font_awesome_array[$n]; ?></option> 
									<?php
									}

								?>
							</select> 

							<i class="fa <?php if (isset($cmb_social_links[$i]['icon'])) { echo $cmb_social_links[$i]['icon']; } else { echo "fa-flag"; } ?>"></i>

							<input type='text' class='cmb_social_links_link' name='cmb_social_links[<?php echo $i; ?>][link]' value='<?php if (isset($cmb_social_links[$i]['link'])) echo $cmb_social_links[$i]['link']; ?>'>
						</td>
					</tr>

					<?php

					}

				?>
			</table>

			<table class='form-table cmb_social_links_control'>
				<tr valign='top'>
					<th scope='row'></th>
					<td>
						<input type="button" class="button cmb_button_add_social_link" value="Add social link" />
						<input type="button" class="button cmb_button_remove_social_link" value="Remove social link" />
					</td>
				</tr>

			</table>
		</div>


		<!-- add nonce -->
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
		<input type="hidden" name="cmb_exist" value="true" />
		<?php	
	}



/**************************************
UPDATE
***************************************/

	function update_cmb_canon_cpt_people ($post_id) {
		// avoid activation on irrelevant admin pages
		if (!isset($_POST['cmb_nonce'])) {
			return false;		
		}

		// verify nonce.    
		if (!wp_verify_nonce($_POST['cmb_nonce'], basename(__FILE__)) || !isset($_POST['cmb_nonce'])) {
			return false;
		}

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		} else {

			//make sure $_POST['cmb_gallery_cat_ID'] is defined
			if (!isset($_POST['cmb_gallery_cat_ID'])) { $_POST['cmb_gallery_cat_ID'] = array(); }

			if (isset($_POST['cmb_title'])) { update_post_meta($post_id, 'cmb_title', $_POST['cmb_title']); } else { update_post_meta($post_id, 'cmb_title', null); };
			if (isset($_POST['cmb_info'])) { update_post_meta($post_id, 'cmb_info', $_POST['cmb_info']); } else { update_post_meta($post_id, 'cmb_info', null); };
			if (isset($_POST['cmb_excerpt'])) { update_post_meta($post_id, 'cmb_excerpt', $_POST['cmb_excerpt']); } else { update_post_meta($post_id, 'cmb_excerpt', null); };
			if (isset($_POST['cmb_excerpt_is_quote'])) { update_post_meta($post_id, 'cmb_excerpt_is_quote', $_POST['cmb_excerpt_is_quote']); } else { update_post_meta($post_id, 'cmb_excerpt_is_quote', null); };
			if (isset($_POST['cmb_index'])) { update_post_meta($post_id, 'cmb_index', $_POST['cmb_index']); } else { update_post_meta($post_id, 'cmb_index', null); };
			if (isset($_POST['cmb_show_social_links'])) { update_post_meta($post_id, 'cmb_show_social_links', $_POST['cmb_show_social_links']); } else { update_post_meta($post_id, 'cmb_show_social_links', null); };
			if (isset($_POST['cmb_social_links'])) { update_post_meta($post_id, 'cmb_social_links', $_POST['cmb_social_links']); } else { update_post_meta($post_id, 'cmb_social_links', null); };

			if (isset($_POST['cmb_exist'])) { update_post_meta($post_id, 'cmb_exist', $_POST['cmb_exist']); } else { update_post_meta($post_id, 'cmb_exist', null); };

		}
	}


