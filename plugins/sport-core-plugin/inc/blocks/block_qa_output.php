<?php

	function block_qa_output ($params) {

		extract($params);

		$params['question'] = array_values($params['question']);
		$params['answer'] = array_values($params['answer']);

		// BLOCK CLASSES
		$block_classes = "outter-wrapper";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		?>

		<!-- BLOCK: LATEST POSTS-->

	        <!-- start outter-wrapper -->   
	        <div <?php pb_block_id_class($block_classes, $params); ?>>
	            
	            <!-- block styles -->
	            <style type="text/css" scoped>
					<?php include 'includes/inc_block_output_style.php'; ?>
	            </style>
	            
	            <!-- start main-container -->
	            <div class="main-container">
	                <!-- start main wrapper -->
	                <div class="main wrapper clearfix">
	                    <!-- start main-content -->
	                    <div class="main-content">

	                    	<!-- Start Post --> 
	                    	<div class="clearfix">

	    	                	<?php if (!empty($title)) { printf('<h1>%s</h1>', esc_attr($title)); } ?>
	    	                	<?php if (!empty($text)) { printf('<p class="lead">%s</p>', do_shortcode($text)); } ?>
			                	
			                	
			                	<ul class="<?php echo $toggletype; ?>">

			                		<?php 

			                			for ($i = 0; $i < count($params['question']); $i++) {  
			                			?>
					                	    <li>
					                	      <a href='#' class='<?php echo $toggletype; ?>-btn'><?php echo $params['question'][$i]; ?></a>
					                	      <div class='<?php echo $toggletype; ?>-content'>
					                	      	<p><?php echo do_shortcode($params['answer'][$i]); ?></p>
					                	      </div>
					                	    </li>
			                				
			                			<?php
			                			}

			                		?>

			                	  </ul>
	                         
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
