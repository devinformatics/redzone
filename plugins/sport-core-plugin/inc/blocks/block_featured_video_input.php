<?php
	function block_featured_video_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

		// DEFAULTS
		if (!isset($params['before_video'])) { $params['before_video'] = "<h4>Sport for WordPress, better for business</h4>"; }
		if (!isset($params['embed_code'])) { $params['embed_code'] = '<iframe src="//player.vimeo.com/video/64742893" width="500" height="281" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'; }
		if (!isset($params['after_video'])) { $params['after_video'] = "<h5>See how sport can help you.</h5>"; }
		
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

			<li class="building_block block_featured_video block_group_functionality">

			<!-- BLOCK HEADER -->
				<div class="block_header">
					<?php _e("Featured Video", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

			<!-- BLOCK OPTIONS -->
				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='featured_video'>
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


						<div class="option">
							<label><?php _e("Before video", "loc_sport_core_plugin"); ?></label>
							<textarea 
								class='block_option services' 
								id='block_before_video' 
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][before_video]'
							><?php if (isset($params['before_video'])) echo $params['before_video']; ?></textarea>
							<span class="detail">Text / HTML</span>
						</div>

						<div class="option">
							<label><?php _e("Embeddable media code", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' id='block_embed_code' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][embed_code]' value="<?php if (isset($params['embed_code'])) echo htmlspecialchars($params['embed_code']); ?>">
						</div>

						<div class="option">
							<label><?php _e("After video", "loc_sport_core_plugin"); ?></label>
							<textarea 
								class='block_option services' 
								id='block_after_video' 
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][after_video]'
							><?php if (isset($params['after_video'])) echo $params['after_video']; ?></textarea>
							<span class="detail"><?php _e("Text / HTML", "loc_sport_core_plugin"); ?></span>
						</div>


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
				<!-- END BLOCK OPTIONS -->
				
			</li>

		<?php	
	}
