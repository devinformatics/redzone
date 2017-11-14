	            	#<?php echo pb_get_block_id($params); ?> <?php if (isset($bg_boxed)) { if($bg_boxed == 'checked') { echo ".main.wrapper"; } } ?>

	            	{
	            		<?php if (!empty($bg_img)) { echo "background-image: url('$bg_img');"; } ?>
	            		<?php if (!empty($bg_color)) { echo "background-color: $bg_color;"; } ?>
	            	}

					#<?php echo pb_get_block_id($params); ?> blockquote, 
					#<?php echo pb_get_block_id($params); ?> h1,
					#<?php echo pb_get_block_id($params); ?> h1 *,
					#<?php echo pb_get_block_id($params); ?> h2,
					#<?php echo pb_get_block_id($params); ?> h2 *,
					#<?php echo pb_get_block_id($params); ?> h3,
					#<?php echo pb_get_block_id($params); ?> h3 *,
					#<?php echo pb_get_block_id($params); ?> h4,
					#<?php echo pb_get_block_id($params); ?> h4 *,
					#<?php echo pb_get_block_id($params); ?> h5,
					#<?php echo pb_get_block_id($params); ?> h5 *,
					#<?php echo pb_get_block_id($params); ?> h6,
					#<?php echo pb_get_block_id($params); ?> h6 *,
					#<?php echo pb_get_block_id($params); ?> a,
					#<?php echo pb_get_block_id($params); ?> p
					

					{
	            		<?php if (!empty($font_color)) { echo  "color: $font_color;"; } ?>
					}

					<?php if (!empty($custom_css)) { echo $custom_css; } ?>
