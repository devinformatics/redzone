<?php
	function block_html_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!isset($params['add_outer_wrappers'])) { $params['add_outer_wrappers'] = 'checked'; }

		if (!isset($params['tab'])) { $params['tab'] = 'block_tab_general'; }

		if (!isset($params['use_parallax'])) { $params['use_parallax'] = "checked"; }
		if (!isset($params['parallax_ratio'])) { $params['parallax_ratio'] = 1; }
		if (!isset($params['bg_boxed'])) { $params['bg_boxed'] = 'unchecked'; }
		if (!isset($params['bg_color'])) { $params['bg_color'] = ''; }
		if (!isset($params['font_color'])) { $params['font_color'] = ''; }
		
		if (!isset($params['custom_classes'])) { $params['custom_classes'] = ''; }
		if (!isset($params['custom_css'])) { $params['custom_css'] = ''; }
		if (!isset($params['sticky'])) { $params['sticky'] = 'unchecked'; }


		?>

			<li class="building_block block_html block_group_functionality">

				<div class="block_header">
					<?php _e("Custom HTML + CSS", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='html'>
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

					<!-- TEXTAREA -->
						<div class="option">
							<label><?php _e("HTML", "loc_sport_core_plugin"); ?></label>
							<textarea 
								class='block_option' 
								rows = '10'
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][html]'
							><?php if (isset($params['html'])) echo $params['html']; ?></textarea>
						</div>
						
					<!-- CHECKBOX -->
						<div class="option">
							<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][add_outer_wrappers]" value="unchecked" />
							<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][add_outer_wrappers]" class="checkbox" value="checked" <?php if (isset($params['add_outer_wrappers'])) { checked($params['add_outer_wrappers'] == "checked"); } ?>/> 
							<?php _e("Boxed", "loc_sport_core_plugin"); ?>
						</div>

					</div>


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
