<?php
	function block_posts_graph_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['title'] 						= "Trending Posts";
			$params['description'] 					= "Display a category of trending posts either by most views or by most comments. It's a great way to showcase what hot in your blog.";
			$params['show'] 						= "latest_posts";
			$params['num_posts'] 					= 14;
			$params['y_axis'] 						= "hits";
			$params['x_axis'] 						= "new_right";

			// APPEARANCE TAB
			$params['tab'] 							= 'block_tab_general';
			$params['use_parallax'] 				= "checked";
			$params['parallax_ratio'] 				= 1;
			$params['bg_boxed'] 					= 'unchecked';
			$params['bg_color'] 					= '';
			$params['font_color'] 					= '';

			// ADVANCED TAB
			$params['custom_classes'] 				= '';
			$params['custom_css'] 					= '';

		}

		?>

			<li class="building_block block_posts_graph block_group_functionality">

				<div class="block_header">
					<?php _e("Posts Graph", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='posts_graph'>
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
						

					<!-- TEXTAREA -->
						<div class="option">
							<label><?php _e("Description", "loc_sport_core_plugin"); ?></label>
							<textarea 
								class='block_option' 
								rows = '4'
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][description]'
							><?php if (isset($params['description'])) echo $params['description']; ?></textarea>
							<span class="detail">Enter text / HTML</span>
						</div>
						
					<!-- DYNAMIC SELECT -->
						<?php 

							$cat_list = get_categories(array(
								'hide_empty' => 0
							));
							$cat_list = array_values($cat_list);

						 ?>
						<div class="option">
							<label><?php _e("Show", "loc_sport_core_plugin"); ?></label>
							<select class='block_option' id="show" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][show]"> 
				     			<option value="latest_posts" <?php if (isset($params['show'])) {if ($params['show'] == "latest_posts") echo "selected='selected'";} ?>><?php _e("Latest posts", "loc_sport_core_plugin"); ?></option> 
				     			<option value="random_posts" <?php if (isset($params['show'])) {if ($params['show'] == "random_posts") echo "selected='selected'";} ?>><?php _e("Random posts", "loc_sport_core_plugin"); ?></option> 
				     			<option value="latest_posts"></option> 

				     			<option value="popular_views" <?php if (isset($params['show'])) {if ($params['show'] == "popular_views") echo "selected='selected'";} ?>><?php _e("Popular posts by views", "loc_sport_core_plugin"); ?>	</option> 
			 					<option value="popular_comments" <?php if (isset($params['show'])) {if ($params['show'] == "popular_comments") echo "selected='selected'";} ?>><?php _e("Popular posts by comments", "loc_sport_core_plugin"); ?>	</option> 
				     			<option value="latest_posts"></option> 

							<?php 
								for ($i = 0; $i < count($cat_list); $i++) { 
								?>
				     				<option value="postcat_<?php echo $cat_list[$i]->slug; ?>" <?php if (isset($params['show'])) {if ($params['show'] == "postcat_" . $cat_list[$i]->slug) echo "selected='selected'";} ?>><?php echo $cat_list[$i]->name; ?> category</option> 
								<?php
								}
							?>
							</select> 
						</div>
							
						
					<!-- NUMBER -->
						<div class="option">
							<input 
								type='number' 
								class='block_option'
								id='num_posts' 
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][num_posts]' 
								min='2'
								max='16'
								step='1'
								style='width: 45px;'
								value='<?php if (isset($params['num_posts'])) echo esc_attr($params['num_posts']); ?>'
							><?php _e("Number of posts to load", "loc_sport_core_plugin"); ?>
						</div>

					<!-- SELECT -->
						<div class="option">
							<label><?php _e("X-axis", "loc_sport_core_plugin"); ?></label>
							<select class='block_option' name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][x_axis]"> 
				     			<option value="new_right" <?php if (isset($params['x_axis'])) {if ($params['x_axis'] == "new_right") echo "selected='selected'";} ?>><?php _e("Newest posts to the right", "loc_sport_core_plugin"); ?></option> 
				     			<option value="new_left" <?php if (isset($params['x_axis'])) {if ($params['x_axis'] == "new_left") echo "selected='selected'";} ?>><?php _e("Newest posts to the left", "loc_sport_core_plugin"); ?></option> 
							</select> 
						</div>

					<!-- SELECT -->
						<div class="option">
							<label><?php _e("Y-axis", "loc_sport_core_plugin"); ?></label>
							<select class='block_option' name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][y_axis]"> 
				     			<option value="hits" <?php if (isset($params['y_axis'])) {if ($params['y_axis'] == "hits") echo "selected='selected'";} ?>><?php _e("Number of views", "loc_sport_core_plugin"); ?></option> 
				     			<option value="comments" <?php if (isset($params['y_axis'])) {if ($params['y_axis'] == "comments") echo "selected='selected'";} ?>><?php _e("Number of comments", "loc_sport_core_plugin"); ?></option> 
							</select> 
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
				
			</li>

		<?php	
	}
