<?php
	function block_featured_icons_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['title'] 					= "Features";
			$params['column'] 					= array(
				0									=> array(
					'icon'								=> 'fa-pencil-square',
					'title'								=> 'Beautiful Design',
					'text'								=> 'Nullam quis risus eget urna mollis ornare vel eu leo. Etiam porta sem malesuada magna.',
				),
				1									=> array(
					'icon'								=> 'fa-users',
					'title'								=> 'SEO Optimized',
					'text'								=> 'Risus eget urna mollis ornare vel eu leo. Nulla vitae elit libero, a pharetra augue.',
				),
				2									=> array(
					'icon'								=> 'fa-foursquare',
					'title'								=> 'Responsive',
					'text'								=> 'Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibhmat.',
				),
				3									=> array(
					'icon'								=> 'fa-comments',
					'title'								=> 'Full Support',
					'text'								=> 'Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibhmat.',
				),
			);

			// APPEARANCE TAB
			$params['tab'] 							= 'block_tab_general';
			$params['use_parallax'] 				= "checked";
			$params['parallax_ratio'] 				= 0.2;
			$params['bg_boxed'] 					= 'unchecked';
			$params['bg_color'] 					= '';
			$params['font_color'] 					= '';

			$params['icon_color'] 					= '';
			$params['icon_size'] 					= 80;

			// ADVANCED TAB
			$params['custom_classes'] 				= '';
			$params['custom_css'] 					= '';
			$params['sticky'] 						= 'unchecked';

		}

		// var_dump($params);

		?>

			<li class="building_block block_featured_icons block_group_functionality">

				<div class="block_header">
					<?php _e("Featured Icons", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='featured_icons'>
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
						
					<!-- PB SORTABLE -->	
						<ul class="pb_sortable featured_icons_sortable">

							<?php 

								for ($i = 0; $i < count($params['column']); $i++) {  
								?>

									<li>

										<table class="options_table option">

										<!-- ICON -->
											<?php $font_awesome_array = mb_get_font_awesome_icon_names_in_array(); ?>

											<tr>
												<th><?php _e("Icon", "loc_sport_core_plugin"); ?></th>
												<td>
													<select class="block_option fa_select" name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][column][<?php echo $i; ?>][icon]'> 
														<?php 

															for ($n = 0; $n < count($font_awesome_array); $n++) {  
															?>
										     					<option value="<?php echo $font_awesome_array[$n]; ?>" <?php if (isset($params['column'][$i]['icon'])) {if ($params['column'][$i]['icon'] == $font_awesome_array[$n]) echo "selected='selected'";} ?>><?php echo $font_awesome_array[$n]; ?></option> 
															<?php
															}

														?>
													</select> 

													<i class="fa <?php if (isset($params['column'][$i]['icon'])) { echo $params['column'][$i]['icon']; } else { echo "fa-flag"; } ?>"></i>

												</td>
											</tr>


										<!-- TITLE -->
											<tr>
												<th><?php _e("Title", "loc_sport_core_plugin"); ?></th>
												<td>
													<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][column][<?php echo $i; ?>][title]' value="<?php if (isset($params['column'][$i]['title'])) echo htmlspecialchars($params['column'][$i]['title']); ?>">
												</td>
											</tr>

										<!-- TEXT -->
											<tr>
												<th><?php _e("Text", "loc_sport_core_plugin"); ?></th>
												<td>
													<textarea 
														class='block_option' 
														rows = '3'
														name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][column][<?php echo $i; ?>][text]'
													><?php if (isset($params['column'][$i]['text'])) echo $params['column'][$i]['text']; ?></textarea>
												</td>
											</tr>

										<!-- DELETE -->
											<tr>
												<td colspan="2" class="delete_from_sortable"><a href=""><?php _e("delete", "loc_sport_core_plugin"); ?></a></td>
											</tr>

										</table>

									</li>
									
								<?php
								}

							?>
						</ul>

						<div class="pb_sortable_controls" data-min_num_elements="1" data-max_num_elements="5">
							<input type="button" class="button button_add_to_sortable" value="<?php _e("Add new column", "loc_sport_core_plugin"); ?>" />
						</div>


					</div>
				<!-- END BLOCK TAB: GENERAL -->

					
				<!-- BLOCK TAB: APPEARANCE -->
					<div class="block_tab block_tab_appearance">
						<?php include 'includes/inc_block_appearance_tab.php'; ?>

						<div class="option">
							<div class="colorSelectorBox pb_color_selector"><div style="background-color: <?php echo $params['icon_color']; ?>"></div></div>
							<input class='block_option color_input' type="text" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][icon_color]" value="<?php if (isset($params['icon_color'])) echo $params['icon_color']; ?>" />    
							<label class="color_label"><?php _e("Icon Color", "loc_sport_core_plugin"); ?></label>
						</div>	

						<div class="option">
							<input 
								type='number' 
								class='block_option'
								id='num_columns' 
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][icon_size]' 
								min='1'
								max='200'
								step='1'
								style='width: 45px;'
								value='<?php if (isset($params['icon_size'])) echo esc_attr($params['icon_size']); ?>'
							><?php _e("Icon Size <i>(px)</i>", "loc_sport_core_plugin"); ?>
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
