<?php
	function block_widgets_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;
		$exist = isset($passed_vars[1]) ? true : false;

		//DEFAULTS
		if (!$exist) {
			$params['layout'] = "third_third_third";	

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

			<li class="building_block block_widgets block_group_functionality<?php if(!$exist) { echo ' save_reload'; } ?>">

				<div class="block_header">
					<?php _e("Widgets", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='widgets'>
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
							<label><?php _e("Layout", "loc_sport_core_plugin"); ?></label>
							<select class='block_option layout_select' id="layout" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][layout]"> 
				     			<option value="half_half">-- <?php _e("TWO COLUMN LAYOUT", "loc_sport_core_plugin"); ?></option> 
				     			<option value="half_half" <?php if (isset($params['layout'])) {if ($params['layout'] == "half_half") echo "selected='selected'";} ?>>half_half</option> 

				     			<option value="third_third_third">--- <?php _e("THREE COLUMN LAYOUTS", "loc_sport_core_plugin"); ?></option> 
				     			<option value="third_third_third" <?php if (isset($params['layout'])) {if ($params['layout'] == "third_third_third") echo "selected='selected'";} ?>>third_third_third</option> 
				     			<option value="two-thirds_third" <?php if (isset($params['layout'])) {if ($params['layout'] == "two-thirds_third") echo "selected='selected'";} ?>>two-thirds_third</option> 
				     			<option value="third_two-thirds" <?php if (isset($params['layout'])) {if ($params['layout'] == "third_two-thirds") echo "selected='selected'";} ?>>third_two-thirds</option> 

				     			<option value="fourth_fourth_fourth_fourth">---- <?php _e("FOUR COLUMN LAYOUTS", "loc_sport_core_plugin"); ?></option> 
				     			<option value="fourth_fourth_fourth_fourth" <?php if (isset($params['layout'])) {if ($params['layout'] == "fourth_fourth_fourth_fourth") echo "selected='selected'";} ?>>fourth_fourth_fourth_fourth</option> 
				     			<option value="half_fourth_fourth" <?php if (isset($params['layout'])) {if ($params['layout'] == "half_fourth_fourth") echo "selected='selected'";} ?>>half_fourth_fourth</option> 
				     			<option value="fourth_half_fourth" <?php if (isset($params['layout'])) {if ($params['layout'] == "fourth_half_fourth") echo "selected='selected'";} ?>>fourth_half_fourth</option> 
				     			<option value="fourth_fourth_half" <?php if (isset($params['layout'])) {if ($params['layout'] == "fourth_fourth_half") echo "selected='selected'";} ?>>fourth_fourth_half</option> 
				     			<option value="three-fourths_fourth" <?php if (isset($params['layout'])) {if ($params['layout'] == "three-fourths_fourth") echo "selected='selected'";} ?>>three-fourths_fourth</option> 

				     			<option value="fifth_fifth_fifth_fifth_fifth">---- <?php _e("FIVE COLUMN LAYOUTS", "loc_sport_core_plugin"); ?></option> 
				     			<option value="fifth_fifth_fifth_fifth_fifth" <?php if (isset($params['layout'])) {if ($params['layout'] == "fifth_fifth_fifth_fifth_fifth") echo "selected='selected'";} ?>>fifth_fifth_fifth_fifth_fifth</option> 
							</select> 
						</div>
						
						<?php 

							// get array of registered sidebars
							$registered_sidebars_array = array();

							foreach ($GLOBALS['wp_registered_sidebars'] as $key => $value) {
								array_push($registered_sidebars_array, $value);
							}

							for ($n = 1; $n < 6; $n++) {
							?>
								<div class="option">
									<label>Widget Area <?php echo $n; ?></label>
									<select class='block_option widget_area_select' id="widget_area" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][widget_area][<?php echo $n; ?>]"> 

									<?php 
										for ($i = 0; $i < count($registered_sidebars_array); $i++) { 
										?>
						     				<option value="<?php echo $registered_sidebars_array[$i]['id']; ?>" <?php if (isset($params["widget_area"][$n])) {if ($params["widget_area"][$n] ==  $registered_sidebars_array[$i]['id']) echo "selected='selected'";} ?>><?php echo  $registered_sidebars_array[$i]['name']; ?></option> 
										<?php
										}
									?>
									</select> 
								</div>
								
							<?php
							}

						 ?>
					
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
