<?php
	function block_qa_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

		//DEFAULTS
		if (!isset($params['type'])) {
			$params['title'] 					= "Q & A";
			$params['question'][0] 				= 'My Credit Card Is Stuck In My Computer?';
			$params['answer'][0] 				= 'You should probably get it out of there!';
			$params['toggletype'] 				= 'toggle';
		}

		$params['question'] = array_values($params['question']);
		$params['answer'] = array_values($params['answer']);

		// ADVANCED TAB
		if (!isset($params['tab'])) { $params['tab'] = 'block_tab_general'; }
		if (!isset($params['custom_classes'])) { $params['custom_classes'] = ''; }
		if (!isset($params['custom_css'])) { $params['custom_css'] = ''; }

		?>

			<li class="building_block block_qa block_group_functionality">

				<div class="block_header">
					<?php _e("Q & A", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='qa'>
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
						

					<!-- TEXTAREA -->
						<div class="option">
							<label><?php _e("Text", "loc_sport_core_plugin"); ?></label>
							<textarea 
								class='block_option' 
								rows = '3'
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][text]'
							><?php if (isset($params['text'])) echo $params['text']; ?></textarea>
							<span class="detail">Enter text / HTML</span>
						</div>
						
						
					<!-- SELECT -->
						<div class="option">
							<label><?php _e("Type", "loc_sport_core_plugin"); ?></label>
							<select class='block_option' name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][toggletype]"> 
				     			<option value="toggle" <?php if (isset($params['toggletype'])) {if ($params['toggletype'] == "toggle") echo "selected='selected'";} ?>>Toggle</option> 
				     			<option value="accordion" <?php if (isset($params['toggletype'])) {if ($params['toggletype'] == "accordion") echo "selected='selected'";} ?>>Accordion</option> 
							</select> 
						</div>

						<ul class="pb_sortable qa_sortable">

							<?php 

								for ($i = 0; $i < count($params['question']); $i++) {  
								?>

									<li>

										<table class="options_table option">
											<tr>
												<th><?php _e("Question", "loc_sport_core_plugin"); ?></th>
												<td>
													<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][question][<?php echo $i; ?>]' value="<?php if (isset($params['question'][$i])) echo htmlspecialchars($params['question'][$i]); ?>">
												</td>
											</tr>

											<tr>
												<th><?php _e("Answer", "loc_sport_core_plugin"); ?></th>
												<td>
													<textarea 
														class='block_option' 
														rows = '3'
														name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][answer][<?php echo $i; ?>]'
													><?php if (isset($params['answer'][$i])) echo $params['answer'][$i]; ?></textarea>
												</td>
											</tr>

											<tr>
												<td colspan="2" class="delete_from_sortable"><a href=""><?php _e("delete", "loc_sport_core_plugin"); ?></a></td>
											</tr>

										</table>

									</li>
									
								<?php
								}

							?>
						</ul>

						<div class="pb_sortable_controls" data-min_num_elements="1" data-max_num_elements="10000">
							<input type="button" class="button button_add_to_sortable" value="<?php _e("Add new Q&A", "loc_sport_core_plugin"); ?>" />
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
