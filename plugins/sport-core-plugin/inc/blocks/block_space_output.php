<?php

	function block_space_output ($params) {

		extract($params);

		?>

		<!-- BLOCK: SPACE-->


	        <!-- start outter-wrapper -->   
	        <div <?php pb_block_id_class('outter-wrapper', $params); ?>>
	            <!-- start main-container -->
	            <div class="main-container">
	                <!-- start main wrapper -->
	                <div class="main wrapper clearfix">
	                    <!-- start main-content -->
	                    <div class="main-content">

	                    	<!-- Start Post --> 
	                    	<div class="clearfix">

								<style type="text/css" scoped>

									#pb_block-<?php echo $block_index; ?> { height: <?php echo $space; ?>px; }

									@media only screen and (max-width: 980px) { #pb_block-<?php echo $block_index; ?> { height: <?php echo $space_980; ?>px; } }
									@media only screen and (max-width: 768px) { #pb_block-<?php echo $block_index; ?> { height: <?php echo $space_768; ?>px; } }
									@media only screen and (max-width: 480px) { #pb_block-<?php echo $block_index; ?> { height: <?php echo $space_480; ?>px; } }

								</style>
							
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
