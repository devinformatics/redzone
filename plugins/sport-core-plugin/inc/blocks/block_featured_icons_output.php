<?php

	function block_featured_icons_output ($params) {

		extract($params);

		$block_classes = "outter-wrapper";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		$size_class = mb_get_size_class_from_num(count($column), "fourth");

		?>

		<!-- BLOCK: LATEST POSTS-->

	        <!-- start outter-wrapper -->   
	        <div <?php pb_block_id_class($block_classes, $params); ?> <?php if ($bg_boxed != 'checked') { printf("data-stellar-background-ratio='$parallax_ratio'"); } ?>>
	        	
	            <!-- block styles -->
	            <style type="text/css" scoped>
	            
					#<?php echo pb_get_block_id($params); ?> .iconBlock em {
	            		<?php if (!empty($icon_color)) { echo  "color: $icon_color;"; } ?>
	            		<?php if (!empty($icon_size)) { echo  "font-size: ".$icon_size."px;"; } ?>
					}

					<?php include 'includes/inc_block_output_style.php'; ?>
					
	            </style>
        
	            <!-- start main-container -->
	            <div class="main-container">
	                <!-- start main wrapper -->
	                <div class="main wrapper clearfix" <?php if ($bg_boxed == 'checked') { printf("data-stellar-background-ratio='$parallax_ratio'"); } ?>>
	                    <!-- start main-content -->
	                    <div class="main-content">

	                    	<!-- Start Post --> 
							<div class="clearfix iconBlock centered">

    	                		<?php if (!empty($title)) { printf('<h2>%s</h2>', esc_attr($title)); } ?>

								<?php
									
									for ($i = 0; $i < count($column); $i++) {
										if ( $i == (count($column)-1) ) { $size_class .= " last"; }
									?>
										<div class="<?php echo $size_class ?>">
											<em class="fa <?php echo $column[$i]['icon']; ?>"></em>
											<h3><?php echo $column[$i]['title']; ?></h3>
											<p><?php echo do_shortcode($column[$i]['text']); ?></p>
										</div>
									<?php 
									}
								
								?>
								
							</div>

	                    </div>
	                    <!-- end main-content -->
	                </div>
	                <!-- end main wrapper -->
	            </div>
	             <!-- end main-container -->
	        </div>
	        <!-- end outter-wrapper -->
	        
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}


