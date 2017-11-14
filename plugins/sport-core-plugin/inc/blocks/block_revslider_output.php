<?php

	function block_revslider_output ($params) {

		extract($params);

		// BLOCK CLASSES
		$block_classes = "outter-wrapper feature";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		?>

		<!-- BLOCK: REVSLIDER-->
		<div <?php pb_block_id_class($block_classes, $params); ?>>
	            
            <!-- block styles -->
            <style type="text/css" scoped>
				<?php include 'includes/inc_block_output_style.php'; ?>
            </style>
	            
	    	<div class="fullwidthbanner-container">
	    		<div class="fullwidthbanner">

	                <?php 
	                    if (function_exists("putRevSlider")) {
	                        putRevSlider($alias);    
	                    }
	                ?>

	    		</div>
	    	</div>
		</div>	
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}
