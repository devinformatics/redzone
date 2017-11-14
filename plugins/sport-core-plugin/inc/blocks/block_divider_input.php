<?php
	function block_divider_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['divider_text'] 				= "Divide and conquer!";
			$params['divider_type'] 				= "text_bar";

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

		?>

			<li class="building_block block_divider block_group_layout">

				<div class="block_header">
					<?php _e("Divider", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='divider'>
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

					<!-- DYNAMIC SELECT -->
						<div class="option">
							<label><?php _e("Type", "loc_sport_core_plugin"); ?></label>
							<select id="divider_type" class='block_option' name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][divider_type]"> 
				     			<option value="hr" <?php if (isset($params['divider_type'])) {if ($params['divider_type'] == "hr") echo "selected='selected'";} ?>><?php _e("Horizontal ruler", "loc_sport_core_plugin"); ?></option> 
				     			<option value="text_bar" <?php if (isset($params['divider_type'])) {if ($params['divider_type'] == "text_bar") echo "selected='selected'";} ?>><?php _e("Text bar", "loc_sport_core_plugin"); ?></option> 
							</select> 
						</div>
						
					<!-- TEXT BAR SPECIFIC OPTION: TEXT INPUT -->

						<div class="pb_dynamic_option" data-listen_to="#divider_type" data-listen_for="text_bar" data-same_level_parent_container=".option">

							<div class="option">
								<label><?php _e("Divider text", "loc_sport_core_plugin"); ?></label>
								<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][divider_text]' value="<?php if (isset($params['divider_text'])) echo htmlspecialchars($params['divider_text']); ?>">
							</div>

						</div>

					</div>
				<!-- END BLOCK TAB: GENERAL -->

					
				<!-- BLOCK TAB: APPEARANCE -->
					<div class="block_tab block_tab_appearance">
						<?php include 'includes/inc_block_appearance_tab.php'; ?>
					</div>


				<!-- BLOCK TAB: ADVANCED -->
					<div class="block_tab block_tab_advanced">
						<?php include 'includes/inc_block_advanced_tab.php'; ?>

						<div class="option">
							<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][sticky]" value="unchecked" />
							<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][sticky]" class="checkbox" value="checked" <?php if (isset($params['sticky'])) { checked($params['sticky'] == "checked"); } ?>/> 
							<?php _e("Sticky", "loc_sport_core_plugin"); ?> <i>(<?php _e("should only be used on blocks with static heights", "loc_sport_core_plugin"); ?>)</i>
						</div>

					</div>

				</div>
				
			</li>

		<?php	
	}
