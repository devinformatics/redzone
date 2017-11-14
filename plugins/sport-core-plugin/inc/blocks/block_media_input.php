<?php
	function block_media_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['title'] 						= "Media";
			$params['media_by'] 					= "Anonymous";
			$params['media_by_link'] 				= "";
			$params['meta_info'] 					= "Once upon a time in a galaxy far, far away.";
			$params['img_url'] 						= "";
			$params['video_link'] 					= "http://player.vimeo.com/video/22428395";
			$params['audio_link'] 					= "https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/48574136";
			$params['text_link'] 					= "";
			$params['force_download'] 				= "unchecked";
			$params['description'] 					= "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur id neque urna. Morbi fringilla risus non risus ornare elementum. In vitae sollicitudin arcu. Cras dui massa, ullamcorper vel porta eget, porttitor sit amet lorem. Nunc viverra eros ac nisi hendrerit dignissim. Nunc consequat nunc quis massa pulvinar eget mollis leo lobortis. Nullam vitae quam neque. Integer bibendum tortor eu neque malesuada pharetra.";
			$params['read_more_link']				= "";
		}

		// ADVANCED TAB
		if (!isset($params['tab'])) { $params['tab'] = 'block_tab_general'; }
		if (!isset($params['custom_classes'])) { $params['custom_classes'] = ''; }
		if (!isset($params['custom_css'])) { $params['custom_css'] = ''; }

		?>

			<li class="building_block block_media block_group_functionality">

				<div class="block_header">
					<?php _e("Media", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='media'>
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


					<!-- TEXT INPUT -->
						<div class="option">
							<label><?php _e("Title", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][title]' value="<?php if (isset($params['title'])) echo htmlspecialchars($params['title']); ?>">
						</div>
						
					<!-- TEXT INPUT -->
						<div class="option">
							<label><?php _e("Media by", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][media_by]' value="<?php if (isset($params['media_by'])) echo htmlspecialchars($params['media_by']); ?>">
						</div>
						
					<!-- TEXT INPUT -->
						<div class="option">
							<label><?php _e("Media by link", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][media_by_link]' value="<?php if (isset($params['media_by_link'])) echo htmlspecialchars($params['media_by_link']); ?>">
						</div>
						

					<!-- TEXT INPUT -->
						<div class="option">
							<p><strong><?php _e("Meta info", "loc_sport_core_plugin"); ?></strong> <i>(<?php _e("e.g. location, time etc.", "loc_sport_core_plugin"); ?>)</i></p>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][meta_info]' value="<?php if (isset($params['meta_info'])) echo htmlspecialchars($params['meta_info']); ?>">
						</div>
						
					<!-- UPLOAD -->
						<div class="option">
							<label><?php _e("Image", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' id='img_url' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][img_url]' class='url' value='<?php if (isset($params['img_url'])) echo $params['img_url']; ?>'>
							<input type="button" id="upload_img_url_btn" class="upload button upload_button" value="<?php _e("Select image", "loc_sport_core_plugin"); ?>" />
						</div>

					<!-- UPLOAD -->
						<div class="option">
							<p><strong><?php _e("Video Link", "loc_sport_core_plugin"); ?></strong> <i>(<?php _e("supply external video link or choose video from media library", "loc_sport_core_plugin"); ?>)</i></p>
							<input class='block_option' type='text' id='img_url' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][video_link]' class='url' value='<?php if (isset($params['video_link'])) echo $params['video_link']; ?>'>
							<input type="button" id="upload_media_button" class="upload button upload_media_button" value="<?php _e("Media library", "loc_sport_core_plugin"); ?>" /> 
						</div>
						
					<!-- UPLOAD -->
						<div class="option">
							<p><strong><?php _e("Audio Link", "loc_sport_core_plugin"); ?></strong> <i>(<?php _e("supply external audio link or choose audio from media library", "loc_sport_core_plugin"); ?>)</i></p>
							<input class='block_option' type='text' id='img_url' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][audio_link]' class='url' value='<?php if (isset($params['audio_link'])) echo $params['audio_link']; ?>'>
							<input type="button" id="upload_media_button" class="upload button upload_media_button" value="<?php _e("Media library", "loc_sport_core_plugin"); ?>" />
						</div>
						
					<!-- UPLOAD -->
						<div class="option">
							<p><strong><?php _e("Text Link", "loc_sport_core_plugin"); ?></strong> <i>(<?php _e("supply external text link or choose text file from media library", "loc_sport_core_plugin"); ?>)</i></p>
							<input class='block_option' type='text' id='img_url' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][text_link]' class='url' value='<?php if (isset($params['text_link'])) echo $params['text_link']; ?>'>
							<input type="button" id="upload_media_button" class="upload button upload_media_button" value="<?php _e("Media library", "loc_sport_core_plugin"); ?>" />
						</div>
						
					<!-- CHECKBOX -->
						<div class="option">
							<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][force_download]" value="unchecked" />
							<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][force_download]" class="checkbox" value="checked" <?php if (isset($params['force_download'])) { checked($params['force_download'] == "checked"); } ?>/> 
							<?php _e("Force text file to download", "loc_sport_core_plugin"); ?>
						</div>

					<!-- TEXTAREA -->
						<div class="option">
							<label><?php _e("Media description", "loc_sport_core_plugin"); ?></label>
							<textarea 
								class='block_option' 
								rows = '4'
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][description]'
							><?php if (isset($params['description'])) echo $params['description']; ?></textarea>
						</div>
						
					<!-- TEXT INPUT -->
						<div class="option">
							<label><?php _e("Read more link", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][read_more_link]' value="<?php if (isset($params['read_more_link'])) echo htmlspecialchars($params['read_more_link']); ?>">
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
