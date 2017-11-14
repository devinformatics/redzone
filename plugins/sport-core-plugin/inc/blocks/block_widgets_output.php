<?php

	function block_widgets_output ($params) {

		extract($params);

		$block_classes = "outter-wrapper";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		$layout_array = explode("_", $layout);

		?>

		<!-- BLOCK: WIDGETS-->

	        <!-- start outter-wrapper -->   
	        <div <?php pb_block_id_class($block_classes, $params); ?> <?php if ($bg_boxed != 'checked') { printf("data-stellar-background-ratio='$parallax_ratio'"); } ?>>
			        	
	            <!-- block styles -->
	            <style type="text/css" scoped>
					<?php include 'includes/inc_block_output_style.php'; ?>
	            </style>
	            
	            <!-- start main-container -->
	            <div class="main-container">
	                <!-- start main wrapper -->
	                <div class="main wrapper clearfix" <?php if ($bg_boxed == 'checked') { printf("data-stellar-background-ratio='$parallax_ratio'"); } ?>>
	                    <!-- start main-content -->
	                    <div class="main-content">

	                    	<!-- Start Post --> 
	                    	<div class="clearfix">

	                    		<?php 

	                    			for ($i = 0; $i < count($layout_array); $i++) { 

	                    				$container_class = ($i == count($layout_array)-1) ? $layout_array[$i] . " last" : $layout_array[$i];

	                    			?>

				    	               <!-- Start Column --> 		
				    	                <div class="<?php echo $container_class; ?>">

											<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($widget_area[$i+1])) : ?>  
												
						                        <h4><?php _e("Widget Area", "loc_sport_core_plugin"); ?></h4>
						                        <p><i><?php _e("Please login and add some widgets to this widget area.", "loc_sport_core_plugin"); ?></i></p> 
											
									        <?php endif; ?>  

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
