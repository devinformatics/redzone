<?php
	function block_revslider_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

		//DEFAULTS
		if (!isset($params['alias'])) { $params['alias'] = "homepage"; }

		// ADVANCED TAB
		if (!isset($params['tab'])) { $params['tab'] = 'block_tab_general'; }
		if (!isset($params['custom_classes'])) { $params['custom_classes'] = ''; }
		if (!isset($params['custom_css'])) { $params['custom_css'] = ''; }

		?>

			<li class="building_block block_revslider block_group_functionality">

				<div class="block_header">
					<?php _e("Revolution Slider", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='revslider'>
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


						<div class="option">
							<label><?php _e("Slider alias", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' id='block_alias' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][alias]' value="<?php if (isset($params['alias'])) echo htmlspecialchars($params['alias']); ?>">
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
