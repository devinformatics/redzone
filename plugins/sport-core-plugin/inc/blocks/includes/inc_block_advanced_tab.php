						<div class="option">
							<label><?php _e("Custom block classes", "loc_sport_core_plugin"); ?></label>
							<input class='block_option' type='text' id='block_custom_classes' name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][custom_classes]' value="<?php if (isset($params['custom_classes'])) echo htmlspecialchars($params['custom_classes']); ?>">
						</div>

						<div class="option">
							<label><?php _e("Custom block CSS", "loc_sport_core_plugin"); ?></label>
							<span class="detail">&lt;style&gt;</span>
							<textarea 
								class='block_option' 
								id='block_custom_css' 
								name='canon_options_pagebuilder[blocks][<?php echo $index; ?>][custom_css]'
								rows='5'
							><?php if (isset($params['custom_css'])) echo $params['custom_css']; ?></textarea>
							<span class="detail">&lt;/style&gt;</span>
						</div>