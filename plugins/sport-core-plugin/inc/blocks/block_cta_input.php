<?php
	function block_cta_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['text'] 					= 'Purchase this theme today, no sign up or credit card needed, <a href="">Get it now</a>';
			$params['bg_color'] 				= "#f5f5f5";
			$params['text_color'] 				= "#2f353f";
			$params['link_color'] 				= "#ffc000";
		}

		if (!isset($params['bg_boxed'])) { $params['bg_boxed'] = 'checked'; }

		// ADVANCED TAB
		if (!isset($params['tab'])) { $params['tab'] = 'block_tab_general'; }
		if (!isset($params['custom_classes'])) { $params['custom_classes'] = ''; }
		if (!isset($params['custom_css'])) { $params['custom_css'] = ''; }

		?>

			<li class="building_block block_cta block_group_functionality<?php if(!$exist) { echo ' save_reload'; } ?>">

				<div class="block_header">
					<?php _e("Call to Action Box", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='cta'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params['status'])) {echo $params['status'];} else {echo "open";} ?>'>
					<input class='block_option' type="hidden" id='block_tab' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tab]' value='<?php if (isset($params['tab'])) { echo $params['tab']; } else { echo "block_tab_general"; } ?>'>

				<!--  BLOCK MENU -->
					<?php 
						pb_block_menu(array(
							'block_tab_controls' 		=> array(
								'block_tab_general'			=> __("General", "loc_sport_core_plugin"),
								'block_tab_advanced'		=> __("Advanced", "loc_sport_core_plugin"),
							),
						)); 
					?>

				<!-- BLOCK TAB: GENERAL -->
					<div class="block_tab block_tab_general">


					<!-- TEXTAREA -->
						<div class="option">
							<label><?php _e("Text", "loc_sport_core_plugin"); ?></label>
							<textarea 
								class='block_option' 
								rows = '4'
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][text]'
							><?php if (isset($params['text'])) echo $params['text']; ?></textarea>
							<span class="detail">Enter text / HTML</span>
						</div>
						
					<!-- COLORPICKER -->
						<div class="option">
							<label><?php _e("Background Color", "loc_sport_core_plugin"); ?></label>
							<div class="colorSelectorBox pb_color_selector"><div style="background-color: <?php echo $params['bg_color']; ?>"></div></div>
							<input class='block_option color_input' type="text" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][bg_color]" value="<?php if (isset($params['bg_color'])) echo $params['bg_color']; ?>" />    
						</div>

					<!-- COLORPICKER -->
						<div class="option">
							<label><?php _e("Text Color", "loc_sport_core_plugin"); ?></label>
							<div class="colorSelectorBox pb_color_selector"><div style="background-color: <?php echo $params['text_color']; ?>"></div></div>
							<input class='block_option color_input' type="text" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][text_color]" value="<?php if (isset($params['text_color'])) echo $params['text_color']; ?>" />    
						</div>

					<!-- COLORPICKER -->
						<div class="option">
							<label><?php _e("Link Color", "loc_sport_core_plugin"); ?></label>
							<div class="colorSelectorBox pb_color_selector"><div style="background-color: <?php echo $params['link_color']; ?>"></div></div>
							<input class='block_option color_input' type="text" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][link_color]" value="<?php if (isset($params['link_color'])) echo $params['link_color']; ?>" />    
						</div>

					<!-- CHECKBOX -->
						<div class="option">
							<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][bg_boxed]" value="unchecked" />
							<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][bg_boxed]" class="checkbox" value="checked" <?php if (isset($params['bg_boxed'])) { checked($params['bg_boxed'] == "checked"); } ?>/> 
							<?php _e("Boxed background", "loc_sport_core_plugin"); ?>
						</div>

					</div>
					

				<!-- BLOCK TAB: ADVANCED -->
					<div class="block_tab block_tab_advanced">
						<?php include 'includes/inc_block_advanced_tab.php'; ?>
					</div>





				</div>
				
			</li>

		<?php	
	}
