<?php

	function block_featured_video_output ($params) {

		extract($params);

		// BLOCK CLASSES
		$block_classes = "outter-wrapper feature parallax-block centered";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		?>

		<!-- BLOCK: FEATURED VIDEO-->

			
			
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

						  		<?php echo do_shortcode($before_video); ?>
						  		<?php echo $embed_code; ?>
						  		<?php echo do_shortcode($after_video); ?>
	                         
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
