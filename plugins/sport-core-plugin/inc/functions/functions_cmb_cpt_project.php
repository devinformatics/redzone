<?php

/**************************************
CUSTOM META FIELD
***************************************/

	//metaboxes
	add_action('add_meta_boxes', 'register_cmb_cpt_project');
	add_action ('save_post', 'update_cmb_cpt_project');

	function register_cmb_cpt_project () {
		add_meta_box('cmb_cpt_project','Sport Project Settings', 'display_cmb_cpt_project','cpt_project','normal','high');
	}

	function display_cmb_cpt_project ($post) {

	/**************************************
	GET VALUES
	***************************************/

	// OPTIONS
		$default_excerpt_len = 300;
	    $canon_options_post = get_option('canon_options_post'); 

	//SET DEFAULT
	    if (!isset($canon_options_post['post_slider'])) { $canon_options_post['post_slider'] = "automatic"; }


	// GENERAL

		$cmb_feature = get_post_meta($post->ID, 'cmb_feature', true);
		$cmb_media_link = get_post_meta($post->ID, 'cmb_media_link', true);
		$cmb_excerpt = get_post_meta($post->ID, 'cmb_excerpt', true);
		$cmb_portfolio_client_name = get_post_meta($post->ID, 'cmb_portfolio_client_name', true);
		$cmb_portfolio_client_url = get_post_meta($post->ID, 'cmb_portfolio_client_url', true);
		$cmb_hide_feat_img = get_post_meta($post->ID, 'cmb_hide_feat_img', true);

	// POST SLIDER
		$cmb_post_show_post_slider = get_post_meta($post->ID, 'cmb_post_show_post_slider', true);
		$cmb_post_slider_source = get_post_meta($post->ID, 'cmb_post_slider_source', true);

		$cmb_exist = get_post_meta($post->ID, 'cmb_exist', true);

	    //GET POST ATTACHMENTS
	    $args = array(
	        'post_type' => 'attachment',
	        'numberposts' => -1,
	        'post_status' => null,
	        'orderby' => 'title',
	        'order'  => 'ASC',
	        'post_parent' => $post->ID
	    );

	    $post_attachments = get_posts( $args );

		//defaults
		if (empty($cmb_exist)) {

			update_post_meta($post->ID, 'cmb_feature', 'image');

		}

	/**************************************
	DISPLAY CONTENT
	***************************************/
		?>

	<!-- GENERAL -->

		<div class="option_heading">
			<span><?php _e("General", "loc_sport_core_plugin"); ?></span>
		</div>

		<?php
						
			fw_cmb_option(array(
				'type'					=> 'select',
				'title' 				=> __('Feature style', 'loc_sport_core_plugin'),
				'slug' 					=> 'cmb_feature',
				'select_options'		=> array(
					'image'				=> __('Featured image', 'loc_sport_core_plugin'),
					'media'				=> __('Use embeddable media instead of featured image', 'loc_sport_core_plugin'),
					'media_in_lightbox'	=> __('Use featured image but open media link in lightbox', 'loc_sport_core_plugin'),
				),
				'post_id'				=> $post->ID,
			)); 
						
			fw_cmb_option(array(
				'type'					=> 'text',
				'title' 				=> __('Featured media - <i>(optional)</i>', 'loc_sport_core_plugin'),
				'slug' 					=> 'cmb_media_link',
				'class' 				=> 'widefat',
				'post_id'				=> $post->ID,
			)); 


		?>


		<div class="option_item">
			<label for='cmb_excerpt'><?php _e("Excerpt", "loc_sport_core_plugin"); ?></label><br>
			<textarea id='cmb_excerpt' name='cmb_excerpt' class='widefat' rows='5'><?php if (!empty($cmb_excerpt)) echo $cmb_excerpt; ?></textarea>
			<button type="button" name="button_generate_excerpt" id='button_generate_excerpt' class="button-secondary auto_generate" value="<?php echo mb_make_excerpt($post->post_content, $default_excerpt_len, true); ?>">Auto-generate</button>
			<span class="item_hint float_right"><?php _e("HTML allowed", "loc_sport_core_plugin"); ?></span>
		</div>


		<?php
	
			fw_cmb_option(array(
				'type'					=> 'text',
				'title' 				=> __('Client name', 'loc_trades_core_plugin'),
				'slug' 					=> 'cmb_portfolio_client_name',
				'class' 				=> 'widefat',
				'post_id'				=> $post->ID,
			)); 

			fw_cmb_option(array(
				'type'					=> 'text',
				'title' 				=> __('Client URL', 'loc_trades_core_plugin'),
				'slug' 					=> 'cmb_portfolio_client_url',
				'class' 				=> 'widefat',
				'post_id'				=> $post->ID,
			)); 



		?>

		<?php
			
			if (has_post_thumbnail($post->ID)) {
			?>
				<div class="option_item">
					<input type="hidden" name="cmb_hide_feat_img" value="unchecked" />
					<input type='checkbox' id='cmb_hide_feat_img' name='cmb_hide_feat_img' value='checked' <?php checked($cmb_hide_feat_img == "checked"); ?>>
					<label for='cmb_hide_feat_img'><?php _e("Hide featured image in post", "loc_sport_core_plugin"); ?></label>
				</div>
					
			<?php
			}
		
		?>	

		<!-- 
		--------------------------------------------------------------------------
			POST SLIDER
	    -------------------------------------------------------------------------- 
		-->

		<div class="option_heading">
			<span><?php _e("Project Slider", "loc_sport_core_plugin"); ?></span>
		</div>

		<div class="option_item">
			<input type="hidden" name="cmb_post_show_post_slider" value="unchecked" />
			<input type='checkbox' id='cmb_post_show_post_slider' name='cmb_post_show_post_slider' value='checked' <?php checked($cmb_post_show_post_slider == "checked"); ?>>
			<label for='cmb_post_show_post_slider'><?php _e("Show project slider", "loc_sport_core_plugin"); ?></label><br>
		</div>

		<div class="dynamic_option default-hidden" data-listen_to="#cmb_post_show_post_slider" data-listen_for="checked">

			<ul class="wp_galleries_source_hints">
				<li><?php _e("The project slider will replace the featured image at the top of the post.", "loc_sport_core_plugin"); ?></li>
				<li><?php _e("Add WordPress galleries using the Add Media button. You can add as many WordPress galleries as you would like.", "loc_sport_core_plugin"); ?></li>
				<li><?php _e("The images from these WordPress galleries will be used in the project slider.", "loc_sport_core_plugin"); ?></li>
				<li><?php _e("The images will appear in the same order as they appear in the galleries. Duplicate images will be removed.", "loc_sport_core_plugin"); ?></li>
			</ul>

			<?php 

				wp_editor($cmb_post_slider_source, 'cmb_post_slider_source', array(
				    'textarea_name' 		=> 'cmb_post_slider_source',
				    'teeny' 				=> true,
				    'media_buttons' 		=> true,
	    			'tinymce' 				=> true,
	    			'quicktags'				=> true,
	    			'textarea_rows' 		=> 20,
	    			'editor_class'			=> 'post_slider_source'
				));

			?>

		</div>






		<!-- add nonce -->
		<input type="hidden" name="cmb_nonce" value="<?php echo wp_create_nonce(basename(__FILE__)); ?>" />
		<input type="hidden" name="cmb_exist" value="true" />






		<?php	
	}



/**************************************
UPDATE
***************************************/

	function update_cmb_cpt_project ($post_id) {
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

		//GENERAL
			if (isset($_POST['cmb_feature'])) { update_post_meta($post_id, 'cmb_feature', $_POST['cmb_feature']); } else { update_post_meta($post_id, 'cmb_feature', null); };
			if (isset($_POST['cmb_media_link'])) { update_post_meta($post_id, 'cmb_media_link', $_POST['cmb_media_link']); } else { update_post_meta($post_id, 'cmb_media_link', null); };
			if (isset($_POST['cmb_excerpt'])) { update_post_meta($post_id, 'cmb_excerpt', $_POST['cmb_excerpt']); } else { update_post_meta($post_id, 'cmb_excerpt', null); };
			if (isset($_POST['cmb_portfolio_client_name'])) { update_post_meta($post_id, 'cmb_portfolio_client_name', $_POST['cmb_portfolio_client_name']); } else { update_post_meta($post_id, 'cmb_portfolio_client_name', null); };
			if (isset($_POST['cmb_portfolio_client_url'])) { update_post_meta($post_id, 'cmb_portfolio_client_url', $_POST['cmb_portfolio_client_url']); } else { update_post_meta($post_id, 'cmb_portfolio_client_url', null); };
			if (isset($_POST['cmb_hide_feat_img'])) { update_post_meta($post_id, 'cmb_hide_feat_img', $_POST['cmb_hide_feat_img']); } else { update_post_meta($post_id, 'cmb_hide_feat_img', null); };
			
		// POST SLIDER
			if (isset($_POST['cmb_post_show_post_slider'])) { update_post_meta($post_id, 'cmb_post_show_post_slider', $_POST['cmb_post_show_post_slider']); } else { update_post_meta($post_id, 'cmb_post_show_post_slider', null); };
			if (isset($_POST['cmb_post_slider_source'])) { update_post_meta($post_id, 'cmb_post_slider_source', $_POST['cmb_post_slider_source']); } else { update_post_meta($post_id, 'cmb_post_slider_source', null); };

			if (isset($_POST['cmb_exist'])) { update_post_meta($post_id, 'cmb_exist', $_POST['cmb_exist']); } else { update_post_meta($post_id, 'cmb_exist', null); };

		}
	}


