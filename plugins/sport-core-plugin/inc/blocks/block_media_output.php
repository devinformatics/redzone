<?php

	function block_media_output ($params) {

		extract($params);

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
	                    
	                    		<div class="media_wrapper clearfix">


	                    			<div class="media_content">
			    	                	<?php if (!empty($title)) { printf('<div class="media_title"><h2>%s</h2></div>', esc_attr($title)); } ?>

	                    				<div class="media_meta">
	                    					<!-- byline -->
	                    					<?php 
	                    						if (!empty($media_by)) { 
	                    							if (!empty($media_by_link)) {
	                    								printf('<a href="%s">%s</a>', esc_url($media_by_link), esc_attr($media_by));
	                    							} else {
	                    								echo esc_attr($media_by);
	                    							}
	                    						} 
	                    					?>

	                    					<!-- divider -->
	  	                    				<?php if (!empty($media_by) && !empty($meta_info)) { echo " - "; } ?>
                  					
	                    					<!-- meta info -->
	                    					<?php if (!empty($meta_info)) { echo $meta_info; } ?>
	                    				</div>
	                    				
	                    				
	                    				
	                    				<div class="media_links">
	                    					<ul>
	                    						<?php if (!empty($video_link)) { printf("<li><a href='%s' class='fancybox-media fancybox.iframe'><em class='fa fa-play-circle-o'></em></a></li>", $video_link); } ?>
	                    						<?php if (!empty($audio_link)) { printf("<li><a href='%s' class='fancybox-media fancybox.iframe'><em class='fa fa-volume-up'></em></a></li>", $audio_link); } ?>
	                    						<?php 

	                    							if (!empty($text_link)) { 
	                    								if ($force_download == "checked") {
		                    								printf("<li><a href='%s' download><em class='fa fa-download'></em></a></li>", $text_link);
	                    								} else {
		                    								printf("<li><a href='%s'><em class='fa fa-file-text-o'></em></a></li>", $text_link);
	                    								}
	                    							}
	                    						
	                    						?>
	                    					</ul>
	                    				</div>
	                    				
	                    				
	                    				<?php if (!empty($img_url)) { printf('<div class="media_image"><img src="%s"></div>', esc_url($img_url)); } ?>
	                    				

	                    				<div class="media_description">
				    	                	<!-- description -->
				    	                	<?php if (!empty($description)) { echo do_shortcode($description); } ?>

				                        	<!-- more link -->
				                        	<?php if (!empty($read_more_link)) { printf('<a class="more" href="%s">%s</a>', esc_url($read_more_link), __("more", "loc_sport_core_plugin")); } ?>
	                    				</div>

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
