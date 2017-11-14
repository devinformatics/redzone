<?php

	function block_cta_output ($params) {

		extract($params);

		// BLOCK CLASSES
		$block_classes = "outter-wrapper";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		?>

		<!-- BLOCK: CALL TO ACTION BOX-->


	        <!-- start outter-wrapper -->   
	        <div <?php pb_block_id_class($block_classes, $params); ?>>

	            <!-- block styles -->
	            <style type="text/css" scoped>
					<?php include 'includes/inc_block_output_style.php'; ?>
					
                    #pb_block-<?php echo $params['block_index']; ?> .message.promo {
                        background-color: <?php echo $bg_color; ?>;
                    }
					#pb_block-<?php echo $params['block_index']; ?> .message.promo *{
						color: <?php echo $text_color; ?>;
					}
                    #pb_block-<?php echo $params['block_index']; ?> .message.promo a{
                        color: <?php echo $link_color; ?>;
                    }
	            </style>
	            
	            <!-- start main-container -->
	            <div class="main-container">
	                <!-- start main wrapper -->
	                <div class="main wrapper clearfix">
	                    <!-- start main-content -->
	                    <div class="main-content">

	                    	<!-- Start Post --> 
	                    	<div class="clearfix">

			                	<div class="message promo clearfix">
			                		<h4><?php echo do_shortcode($params['text']); ?></h4>
			                	</div>
	                         
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
