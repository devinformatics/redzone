<?php
	function block_gallery_preview_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['title'] 					= "Gallery Preview";
			$params['meta_text'] 				= "January 1st, 2014";
			$params['button_text'] 				= "View Gallery";
			$params['description'] 				= "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id neque urna. Morbi fringilla risus non risus ornare elementum.";
		}
		if (!isset($params['source'])) { $params['source'] = ''; }
		if (!isset($params['num_columns'])) { $params['num_columns'] = 3; }

		// APPEARANCE TAB
		if (!isset($params['tab'])) { $params['tab'] = 'block_tab_general'; }
		if (!isset($params['use_parallax'])) { $params['use_parallax'] = "checked"; }
		if (!isset($params['parallax_ratio'])) { $params['parallax_ratio'] = 0.2; }
		if (!isset($params['bg_boxed'])) { $params['bg_boxed'] = 'unchecked'; }
		if (!isset($params['bg_color'])) { $params['bg_color'] = ''; }
		if (!isset($params['font_color'])) { $params['font_color'] = ''; }
		
		// ADVANCED TAB
		if (!isset($params['custom_classes'])) { $params['custom_classes'] = ''; }
		if (!isset($params['custom_css'])) { $params['custom_css'] = ''; }

		?>

			<li class="building_block block_gallery_preview block_group_functionality<?php if(!$exist) { echo ' save_reload'; } ?>">

				<div class="block_header">
					<?php _e("Gallery Preview", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='gallery_preview'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>
					<input class='block_option' type="hidden" id='block_tab' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tab]' value='<?php if (isset($params['tab'])) { echo $params['tab']; } else { echo "block_tab_general"; } ?>'>
					
				<!--  BLOCK MENU -->
					<?php 
						pb_block_menu(array(
							'block_tab_controls' 		=> array(
								'block_tab_general'			=> __("General", "loc_sport_core_plugin"),
								'block_tab_appearance'		=> __("Appearance", "loc_sport_core_plugin"),
								'block_tab_advanced'		=> __("Advanced", "loc_sport_core_plugin"),
							),
						)); 
					?>

					
				<!-- BLOCK TAB: GENERAL -->
					<div class="block_tab block_tab_general">



					<!-- TEXT INPUT -->
						<div class="option">
							<label><?php _e("Title", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][title]' value="<?php if (isset($params['title'])) echo htmlspecialchars($params['title']); ?>">
						</div>
						

					<!-- TEXT INPUT -->
						<div class="option">
							<label><?php _e("Meta text", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][meta_text]' value="<?php if (isset($params['meta_text'])) echo htmlspecialchars($params['meta_text']); ?>">
						</div>
						

					<!-- TEXTAREA -->
						<div class="option">
							<label><?php _e("Text", "loc_sport_core_plugin"); ?></label>
							<textarea 
								class='block_option' 
								rows = '4'
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][description]'
							><?php if (isset($params['description'])) echo $params['description']; ?></textarea>
							<span class="detail"><?php _e("Enter text / HTML", "loc_cph"); ?></span>
						</div>
						
					<!-- TEXT INPUT -->
						<div class="option">
							<label><?php _e("Button text", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][button_text]' value="<?php if (isset($params['button_text'])) echo htmlspecialchars($params['button_text']); ?>">
						</div>
						
					<!-- TEXT INPUT -->
						<div class="option">
							<label><?php _e("Button URL", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][button_url]' value="<?php if (isset($params['button_url'])) echo htmlspecialchars($params['button_url']); ?>">
						</div>
						
					
					<!-- NUMBER -->
						<div class="option">
							<input 
								type='number' 
								class='block_option'
								id='num_columns' 
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][num_columns]' 
								min='1'
								max='5'
								step='1'
								style='width: 45px;'
								value='<?php if (isset($params['num_columns'])) echo esc_attr($params['num_columns']); ?>'
							><?php _e("Number of columns", "loc_sport_core_plugin"); ?>
						</div>


					<!-- WP EDITOR -->
	 					<?php 

	 						if ($exist) {
	 						?>
								<div class="option">
									<label><?php _e("Images", "loc_sport_core_plugin"); ?></label>

									<ul class="wp_galleries_source_hints">
										<li><?php _e("Add WordPress galleries using the Add Media button. You can add as many WordPress galleries as you would like.", "loc_cph"); ?></li>
										<li><?php _e("The images will appear in the same order as they appear in the galleries. Duplicate images will be removed.", "loc_cph"); ?></li>
										<li><?php _e('You can use the Text editor to rearrange the WordPress gallery shortcodes', "loc_cph"); ?></li>
									</ul>
									
									<?php 

										wp_editor($params['source'], 'block_text_'.$index, array(
										    'textarea_name' => 'canon_options_pagebuilder[blocks]['.$index.'][source]',
										    'teeny' => false,
										    'media_buttons' => true,
										    'editor_class' => 'block_option',
							    			'tinymce' => true,
										));

									?>

								</div>

	 						<?php	
	 						} else {
	 						?>

	 							<div class="option">
									<label><?php _e("Images", "loc_sport_core_plugin"); ?></label>
									<img class="editor_load" src="<?php echo plugins_url('', __FILE__ ) . "/../../img/ajax-loader.gif"; ?>">
	 							</div>
	 						
	 						<?php		
	 						}

	 					?>
						<!-- END WP EDITOR -->

						

					</div>

				<!-- BLOCK TAB: APPEARANCE -->
					<div class="block_tab block_tab_appearance">
						<?php include 'includes/inc_block_appearance_tab.php'; ?>
					</div>


				<!-- BLOCK TAB: ADVANCED -->
					<div class="block_tab block_tab_advanced">
						<?php include 'includes/inc_block_advanced_tab.php'; ?>
					</div>


				</div>
				
			</li>

		<?php	
	}
