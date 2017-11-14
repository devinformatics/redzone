<?php

	function block_divider_output ($params) {

		extract($params);

		$block_classes = "outter-wrapper feature";
		if ($divider_type == "text_bar") { $block_classes .= " callout-block centered"; }
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }
		if ($sticky == 'checked') { $block_classes .= " canon_sticky"; }

		?>

		<!-- BLOCK: DIVIDER-->

			<?php
				
				if ($divider_type == "hr") {
				?>
					
		            <!-- Start Outter Wrapper -->   
		            <div <?php pb_block_id_class($block_classes, $params); ?> <?php if ($bg_boxed != 'checked') { printf("data-stellar-background-ratio='$parallax_ratio'"); } ?>>
		                <hr>
		            </div>
		            <!-- End Outter Wrapper -->  
		            
				<?php
				}
			
				if ($divider_type == "text_bar") {
				?>
					
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

					  					<?php if (!empty($divider_text)) { printf('<h4>%s</h4>', esc_attr($divider_text)); } else { echo '<br/>'; }?>
			                         
			                        </div>


			                    </div>
			                    <!-- end main-content -->
			                </div>
			                <!-- end main wrapper -->
			            </div>
			             <!-- end main-container -->
			        </div>
			        <!-- end outter-wrapper -->
		            
				<?php
				}
			
			?>



			        
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}
