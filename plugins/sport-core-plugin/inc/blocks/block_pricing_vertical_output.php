<?php

	function block_pricing_vertical_output ($params) {

		extract($params);

        // MAKE SURE ARRAY IS TIGHT
		$tables = array_values($tables);

		// BLOCK CLASSES
		$block_classes = "outter-wrapper";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		?>

		<!-- BLOCK: PRICING VERTICAL-->

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

    	                	<?php if (!empty($title)) { printf('<h1>%s</h1>', esc_attr($title)); } ?>
    	                	<?php if (!empty($text)) { printf('<p class="lead">%s</p>', do_shortcode($text)); } ?>
		                	
	                		
	                		
	                    	<!-- Start Post --> 
	                    	<div class="clearfix">


    	                		<?php 
    	                			$base_class = "price-table";
    	                		
    	                			for ($i = 0; $i < count($tables); $i++) { 

    	                				$feature_class = ($tables[$i]['feature'] == "checked") ? " price-table-feature" : "";
    	                				$final_class = $base_class . $feature_class;
    	                			?>

			    	                	<!-- Start Price -->
			    	                	<div class="<?php echo $final_class; ?>">
				    	                	<div class="price-row">
				    	                		<div class="price-cell feature">

				    	                			<p><?php echo $tables[$i]['price']; ?>
				    	                					<span><?php echo $tables[$i]['interval']; ?></span>
				    	                			</p>
				    	                			
				    	                		</div>

				    	                		<!-- main content -->
				    	                		<?php  

				    	                			if (!empty($tables[$i]['content'])) {
				    	                				echo '<div class="price-cell">';

				    	                				if (!empty($tables[$i]['bonus_content_1']) || !empty($tables[$i]['bonus_content_2'])) {
				    	                					printf('<div class="inwrap">%s</div>', do_shortcode($tables[$i]['content']));
				    	                				} else {
				    	                					echo do_shortcode($tables[$i]['content']);
				    	                				}

				    	                				echo '</div>';
				    	                					
				    	                			}

				    	                		?>
				    	                		
				    	                		<!-- bonus content 1 -->
				    	                		<?php  

				    	                			if (!empty($tables[$i]['bonus_content_1'])) {
				    	                				echo '<div class="price-cell">';

				    	                				if (!empty($tables[$i]['bonus_content_2'])) {
				    	                					printf('<div class="inwrap">%s</div>', do_shortcode($tables[$i]['bonus_content_1']));
				    	                				} else {
				    	                					echo do_shortcode($tables[$i]['bonus_content_1']);
				    	                				}

				    	                				echo '</div>';
				    	                					
				    	                			}

				    	                		?>
				    	                		
				    	                		<!-- bonus content 2 -->
				    	                		<?php  

				    	                			if (!empty($tables[$i]['bonus_content_2'])) {
				    	                				echo '<div class="price-cell">';
				    	                				echo do_shortcode($tables[$i]['bonus_content_2']);
				    	                				echo '</div>';
				    	                			}

				    	                		?>
				    	                		
				    	                		<!-- button cell -->
				    	                		<div class="price-cell last">
			    	                				<?php if (!empty($tables[$i]['btn_text'])) { printf('<p><a class="btn" href="%s">%s</a></p>', esc_url($tables[$i]['btn_link']), esc_attr($tables[$i]['btn_text'])); } ?>
				    	                		</div>
				    	                	</div>
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
