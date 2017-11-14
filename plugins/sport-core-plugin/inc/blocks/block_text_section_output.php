<?php

	function block_text_section_output ($params) {

		extract($params);

		// DEFAULTS
		if (!isset($text)) { $text = ""; }
		if (!isset($use_autoformat)) { $use_autoformat = "unchecked"; }

		// BLOCK CLASSES
		$block_classes = "outter-wrapper";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		?>

		<!-- BLOCK: TEXT SECTION-->

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

	    	                	<?php if ($hide_title != "checked" && !empty($title)) { printf('<div class="text-seperator"><h5>%s</h5></div>', $title); } ?>
	    	                	
		    	                <?php 

	    	                		if ($use_autoformat == "checked") {
	    	                			echo apply_filters('the_content', $text);
	    	                		} else {
	    	                			echo do_shortcode($text);
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
