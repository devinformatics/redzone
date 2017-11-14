<?php
	function block_gallery_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		// DEFAULTS
		if (!$exist) {
			$params['title'] 						= "My Gallery";
			$params['hide_filter_menu'] 			= 'unchecked';

			// APPEARANCE TAB
			$params['tab'] 							= 'block_tab_general';
			$params['use_parallax'] 				= "checked";
			$params['parallax_ratio'] 				= 0.2;
			$params['bg_boxed'] 					= 'unchecked';
			$params['bg_color'] 					= '';
			$params['font_color'] 					= '';

			// ADVANCED TAB
			$params['custom_classes'] 				= '';
			$params['custom_css'] 					= '';
			$params['sticky'] 						= 'unchecked';

		}
		if (!isset($params['source'])) { $params['source'] = ''; }
		if (!isset($params['num_columns'])) { $params['num_columns'] = 4; }


		?>

			<li class="building_block block_gallery block_group_functionality<?php if(!$exist) { echo ' save_reload'; } ?>">

				<div class="block_header">
					<?php _e("Gallery", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='gallery'>
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


					<!-- CHECKBOX -->
						<div class="option">
							<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][hide_filter_menu]" value="unchecked" />
							<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][hide_filter_menu]" class="checkbox" value="checked" <?php if (isset($params['hide_filter_menu'])) { checked($params['hide_filter_menu'] == "checked"); } ?>/> 
							<?php _e("Hide filter menu", "loc_sport_core_plugin"); ?>
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
										<li><?php _e('You can use the Text editor to add a category attribute to the shortcodes e.g. [gallery ids="1,2,3" category="My Category"]', "loc_cph"); ?></li>
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
				<!-- END BLOCK TAB: GENERAL -->

					
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
