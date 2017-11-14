<?php
	function block_countdown_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['title'] 						= "";
			$params['datetime_string'] 				= "December 31, 2023 23:59:59";
			$params['gmt_offset'] 					= "+10";
			$params['format'] 						= "dHMS";
			$params['description'] 					= "";
			$params['use_compact'] 					= "unchecked";

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

		}

		?>

			<li class="building_block block_countdown block_group_functionality">

				<div class="block_header">
					<?php _e("Countdown", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='countdown'>
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
							<span class="detail"><?php _e("Optional", "loc_sport_core_plugin"); ?></span>
						</div>
						

					<!-- TEXT INPUT -->
						<div class="option">
							<label><?php _e("Countdown to", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][datetime_string]' value="<?php if (isset($params['datetime_string'])) echo $params['datetime_string']; ?>">
							<span class="detail"><?php _e("Must be in the format Month DD, YYYY HH:MM:SS e.g. December 31, 2023 23:59:59", "loc_sport_core_plugin"); ?></span>
						</div>
						
					<!-- TEXT INPUT -->
						<div class="option">
							<label><?php _e("GMT offset", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][gmt_offset]' value="<?php if (isset($params['gmt_offset'])) echo $params['gmt_offset']; ?>">
							<span class="detail"><?php _e("GMT offset of your current timezone. You can search for your timezone <a href='http://www.worldtimezone.com/' target='_blank'>here</a>", "loc_sport_core_plugin"); ?></span>
						</div>
						
					<!-- TEXT INPUT -->
						<div class="option">
							<label><?php _e("Output format", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][format]' value="<?php if (isset($params['format'])) echo $params['format']; ?>">
							<span class="detail"><?php _e("'Y' for years, 'O' for months, 'W' for weeks, 'D' for days, 'H' for hours, 'M' for minutes, 'S' for seconds. Use upper-case characters for required fields and lower-case characters for display only if non-zero.", "loc_sport_core_plugin"); ?></span>
						</div>
						

					<!-- TEXTAREA -->
						<div class="option">
							<label><?php _e("Description", "loc_sport_core_plugin"); ?></label>
							<textarea 
								class='block_option' 
								rows = '4'
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][description]'
							><?php if (isset($params['description'])) echo $params['description']; ?></textarea>
							<span class="detail"><?php _e("Optional. Enter text / HTML.", "loc_sport_core_plugin"); ?></span>
						</div>

					<!-- CHECKBOX -->
						<div class="option">
							<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][use_compact]" value="unchecked" />
							<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][use_compact]" class="checkbox" value="checked" <?php if (isset($params['use_compact'])) { checked($params['use_compact'] == "checked"); } ?>/> 
							<?php _e("Use compact format", "loc_sport_core_plugin"); ?>
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
					</div>
					
				</div>
				
			</li>

		<?php	
	}
