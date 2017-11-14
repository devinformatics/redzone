<?php
	function block_pricing_input ($passed_vars) {

		$index = isset($passed_vars[0]) ? $passed_vars[0] : "block_index";
		$params = isset($passed_vars[1]) ? $passed_vars[1] : null;

		//DEFAULTS
		if (!isset($params['type'])) {
			$params['title'] 					= "Payment Plans";

			$params['tables']					= array(
				0									=> array(
					'table_status'						=> 'open',
					'feature'							=> 'unchecked',
					'table_title'						=> 'Beginner',
					'price'								=> '$9',
					'interval'							=> 'p/month',
					'content'							=> '<p><strong>Help provide essential tools needed to clean up beaches.</strong></p>
<ul>
	<li>Yearly Fee</li>
	<li>Name in newsletter</li>
	<li>Avatar on Site</li>
	<li>Photo Updates</li>
	<li>Sport Newsletter</li>
</ul>',
					'btn_text'							=> 'Donate Today',
					'btn_link'							=> '',
				),

				1									=> array(
					'table_status'						=> 'open',
					'feature'							=> 'checked',
					'table_title'						=> 'Intermediate',
					'price'								=> '$22',
					'interval'							=> 'p/month',
					'content'							=> '<p><strong>Provides much needed tools needed to repair barrier reefs.</strong></p>
<ul>
	<li>Yearly Fee</li>
	<li>Compete in all games</li>
	<li>Name in newsletter</li>
	<li>Avatar on Site</li>
	<li>Sport Newsletter</li>
	<li>Club Jersey</li>
</ul>',
					'btn_text'							=> 'Donate Today',
					'btn_link'							=> '',
				),

				2									=> array(
					'table_status'						=> 'open',
					'feature'							=> 'unchecked',
					'table_title'						=> 'Expert',
					'price'								=> '$34',
					'interval'							=> 'p/month',
					'content'							=> '<p><strong>Help provide essential tools to resuscitate our rivers.</strong></p>
<ul>
	<li>Yearly Fee</li>
	<li>Name in newsletter</li>
	<li>Newsletter</li>
	<li>Avatar on Site</li>
	<li>Sport Newsletter</li>
</ul>',
					'btn_text'							=> 'Donate Today',
					'btn_link'							=> '',
				),
			);
		}

		// ADVANCED TAB
		if (!isset($params['tab'])) { $params['tab'] = 'block_tab_general'; }
		if (!isset($params['custom_classes'])) { $params['custom_classes'] = ''; }
		if (!isset($params['custom_css'])) { $params['custom_css'] = ''; }

        // MAKE SURE ARRAY IS TIGHT
        $params['tables'] = array_values($params['tables']);

		// var_dump($params['tables']);



		?>

			<li class="building_block block_pricing block_group_functionality">

				<div class="block_header">
					<?php _e("Pricing Tables", "loc_sport_core_plugin"); ?>
					<span class="block-edit"></span>
				</div>

				<div class="block_options">

					<input class='block_option' type="hidden" id='block_type' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][type]' value='pricing'>
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
						
					<!-- SORTABLE -->
						<ul class="pb_sortable pricing_sortable">

							<?php 

								for ($i = 0; $i < count($params['tables']); $i++) {  
								?>

									<li>

										<div class="block_subheader table_toggle">
											<?php _e("Table", "loc_sport_core_plugin"); ?>
										</div>

										<table class="options_table option">

											<input class='block_option table_status' type="hidden" name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][table_status]' value='<?php if (isset($params['tables'][$i]['table_status'])) {echo $params['tables'][$i]['table_status'];} else {echo "open";} ?>'>
											
											<tr>
												<th><?php _e("Featured table", "loc_sport_core_plugin"); ?></th>
												<td>
													<input class='block_option' type="hidden" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][feature]" value="unchecked" />
													<input class='block_option' type="checkbox" name="canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][feature]" class="checkbox" value="checked" <?php if (isset($params['tables'][$i]['feature'])) { checked($params['tables'][$i]['feature'] == "checked"); } ?>/> 
												</td>
											</tr>

											<tr>
												<th><?php _e("Table title", "loc_sport_core_plugin"); ?></th>
												<td>
													<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][table_title]' value="<?php if (isset($params['tables'][$i]['table_title'])) echo htmlspecialchars($params['tables'][$i]['table_title']); ?>">
												</td>
											</tr>

											<tr>
												<th><?php _e("Price", "loc_sport_core_plugin"); ?></th>
												<td>
													<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][price]' value="<?php if (isset($params['tables'][$i]['price'])) echo htmlspecialchars($params['tables'][$i]['price']); ?>">
												</td>
											</tr>

											<tr>
												<th><?php _e("Interval", "loc_sport_core_plugin"); ?></th>
												<td>
													<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][interval]' value="<?php if (isset($params['tables'][$i]['interval'])) echo htmlspecialchars($params['tables'][$i]['interval']); ?>">
												</td>
											</tr>

											<tr>
												<th><?php _e("Content", "loc_sport_core_plugin"); ?></th>
												<td>
													<textarea 
														class='block_option' 
														rows = '8'
														name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][content]'
													><?php if (isset($params['tables'][$i]['content'])) echo $params['tables'][$i]['content']; ?></textarea>
												</td>
											</tr>

											<tr>
												<th><?php _e("Button text", "loc_sport_core_plugin"); ?></th>
												<td>
													<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][btn_text]' value="<?php if (isset($params['tables'][$i]['btn_text'])) echo htmlspecialchars($params['tables'][$i]['btn_text']); ?>">
												</td>
											</tr>

											<tr>
												<th><?php _e("Button link", "loc_sport_core_plugin"); ?></th>
												<td>
													<input class='block_option' type='text' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][tables][<?php echo $i; ?>][btn_link]' value="<?php if (isset($params['tables'][$i]['btn_link'])) echo htmlspecialchars($params['tables'][$i]['btn_link']); ?>">
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

						<div class="pb_sortable_controls" data-min_num_elements="1" data-max_num_elements="5">
							<input type="button" class="button button_add_to_sortable" value="<?php _e("Add new pricing table", "loc_sport_core_plugin"); ?>" />
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
