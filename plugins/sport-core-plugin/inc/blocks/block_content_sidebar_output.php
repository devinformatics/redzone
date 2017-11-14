<?php

	function block_content_sidebar_output ($params) {

		extract($params);

		$canon_options = get_option('canon_options');

		// FAILSAFE DEFAULTS
		if (!isset($sidebar_id)) { $sidebar_id = "canon_page_sidebar_widget_area"; }
		if (!isset($hide_page_title)) { $hide_page_title = "unchecked"; }

		// BLOCK CLASSES
		$block_classes = "outter-wrapper";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		// SET MAIN CONTENT CLASS
		$main_content_class = "main-content three-fourths";
		if ($canon_options['sidebars_alignment'] == 'left') { $main_content_class .= " left-main-content"; }

		// SET ASIDE CLASS
		$aside_class = ($canon_options['sidebars_alignment'] == 'left') ? 'left-aside fourth' : 'right-aside fourth last';

		?>

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
	                    <div class="<?php echo esc_attr($main_content_class); ?>">

	    	
		                	<div class="clearfix">

	                            <!-- THE TITLE --> 
	                            <?php if ($hide_page_title != "checked") { printf('<h1>%s</h1>', wp_kses_post(get_the_title())); } ?> 
		                        
	                             <!-- THE CONTENT -->
	                            <?php the_content(); ?>
	                            
	                            <!-- WP_LINK_PAGES -->
	                            <?php wp_link_pages(array('before' => '<p>' . __('Pages:','loc_sport_core_plugin'))); ?>
		                                                                                               
		                	</div>  

	                    </div>
	                    <!-- end main-content -->
	    					
	                    <!-- SIDEBAR -->
						<aside class="<?php echo esc_attr($aside_class); ?>">

							<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar_id)) : ?>  
								
		                        <h4><?php _e("No Widgets added.", "loc_sport_core_plugin"); ?></h4>
		                        <p><i><?php _e("Please login and add some widgets to this widget area.", "loc_sport_core_plugin"); ?></i></p> 
							
					        <?php endif; ?>  

						</aside>
						 <!-- END SIDEBAR -->	


	                </div>
	                <!-- end main wrapper -->
	            </div>
	             <!-- end main-container -->
	        </div>
	        <!-- end outter-wrapper -->
		
		<?php

		return true;		
	}
