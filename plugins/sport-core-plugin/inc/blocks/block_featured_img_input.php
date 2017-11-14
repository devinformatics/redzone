<?php
		function block_featured_img_input ($passed_vars) {

			$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
			$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

			// ADVANCED TAB
			if (!isset($params['tab'])) { $params['tab'] = 'block_tab_general'; }
			if (!isset($params['custom_classes'])) { $params['custom_classes'] = ''; }
			if (!isset($params['custom_css'])) { $params['custom_css'] = ''; }


			?>

			<li class="building_block block_featured_img block_group_native">

				<div class="block_header">
					<?php _e("Featured Image", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='featured_img'>
					<input class='block_option' type="hidden" id='block_status' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][status]' value='<?php if (isset($params)) {echo $params['status'];} else {echo "open";} ?>'>
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
							<span class="detail"><?php _e("Displays the featured image of your page. Make sure the page using this pagebuilder template has a featured image.", "loc_sport_core_plugin"); ?></span>
						</div>

					</div>

				<!-- BLOCK TAB: ADVANCED -->
					<div class="block_tab block_tab_advanced">
						<?php include 'includes/inc_block_advanced_tab.php'; ?>
					</div>


				</div>
				<!-- END BLOCK_OPTIONS -->
			</li>

			<?php	
		}
