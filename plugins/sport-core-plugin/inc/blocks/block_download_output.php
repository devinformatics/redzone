<?php

	function block_download_output ($params) {

		extract($params);

        // MAKE SURE ARRAY IS TIGHT
		$tables = array_values($tables);

		// BLOCK CLASSES
		$block_classes = "outter-wrapper";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		?>

		<!-- BLOCK: DOWNLOAD LIST-->

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
		                	
	                		<hr/>
	                		
	                    	<!-- Start Post --> 
	                    	<div class="clearfix">


    	                		<?php 
    	                			$base_class = "price-table download-table";
    	                		
    	                			for ($i = 0; $i < count($tables); $i++) { 

    	                				$feature_class = ($tables[$i]['feature'] == "checked") ? " price-table-feature" : "";
    	                				$final_class = $base_class . $feature_class;

    	                			?>

			    	                	<!-- Start Price -->
			    	                	<div class="<?php echo $final_class; ?>">
				    	                	<div class="price-row">
				    	                		
				    	                		<!-- feature icon/img -->
				    	                		<?php if (!empty($tables[$i]['img_url'])) : ?>
				    	                				
					    	                		<div class="price-cell feature-image">

					    	                			<img src="<?php echo $tables[$i]['img_url']; ?>">
					    	                			
					    	                		</div>

				    	                		<?php else : ?>

					    	                		<div class="price-cell feature">

					    	                			<span class="fa <?php echo $tables[$i]['icon']; ?>"></span>
					    	                			
					    	                		</div>
				    	                				
				    	                		<?php endif; ?>

				    	                		<!-- main content -->
				    	                		<?php  

				    	                			if (!empty($tables[$i]['box_title']) || !empty($tables[$i]['description'])) {
			    	                				?>
			    	                					<div class="price-cell content">
			    	                						<h3><?php echo $tables[$i]['box_title']; ?></h3>
			    	                						<?php echo do_shortcode($tables[$i]['description']); ?>
			    	                					</div>
			    	                				<?php
				    	                			}

				    	                		?>
				    	                		
				    	                		
				    	                		<!-- button cell -->
				    	                		<div class="price-cell last">
			    	                				<?php if (!empty($tables[$i]['btn_text'])) { printf('<p><a class="btn" href="%s">%s</a></p>', esc_url($tables[$i]['file_url']), esc_attr($tables[$i]['btn_text'])); } ?>
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
