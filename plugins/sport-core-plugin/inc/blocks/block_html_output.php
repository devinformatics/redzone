<?php

	function block_html_output ($params) {

		extract($params);

		$block_classes = "outter-wrapper";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }
		if ($sticky == 'checked') { $block_classes .= " canon_sticky"; }

		// IF FULL WIDTH CONTENT THEN FORCE BG FULL WIDTH
		if ($add_outer_wrappers != "checked") { $bg_boxed = "unchecked"; }

		?>

		<!-- BLOCK: HTML+CSS-->


		        <!-- start outter-wrapper -->   
	        	<div <?php pb_block_id_class($block_classes, $params); ?> <?php if ($bg_boxed != 'checked') { printf("data-stellar-background-ratio='$parallax_ratio'"); } ?>>
		
		            <!-- block styles -->
					<style type="text/css" scoped>
						<?php include 'includes/inc_block_output_style.php'; ?>
					</style>

		<?php 

			if ($add_outer_wrappers == "checked") {
			?>

		            <!-- start main-container -->
		            <div class="main-container">
		                <!-- start main wrapper -->
		                <div class="main wrapper clearfix" <?php if ($bg_boxed == 'checked') { printf("data-stellar-background-ratio='$parallax_ratio'"); } ?>>
		                    <!-- start main-content -->
		                    <div class="main-content">

		                    	<!-- Start Post --> 
		                    	<div class="clearfix">

			<?php		
			}

		?>


									
									<?php echo do_shortcode($html); ?>

		<?php 

			if ($add_outer_wrappers == "checked") {
			?>

		                        </div>


		                    </div>
		                    <!-- end main-content -->
		                </div>
		                <!-- end main wrapper -->
		            </div>
		             <!-- end main-container -->

			<?php		
			}
		?>

		        </div>
		        <!-- end outter-wrapper -->
	        
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}
