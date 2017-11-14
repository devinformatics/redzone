<?php

	function block_gallery_output ($params) {

		extract($params);

		$block_classes = "outter-wrapper";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }
    	
		// HANDLE WP GALLERY SOURCE
		$consolidated_gallery_array = array();
		$gallery_array = mb_strip_wp_galleries_to_array($source);
		$consolidated_gallery_array = mb_convert_wp_galleries_array_to_consolidated_wp_gallery_array($gallery_array);

		$size_class = mb_get_size_class_from_num($num_columns, "third");

		// var_dump($size_class);


		?>

		<!-- BLOCK: LATEST POSTS-->

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

							<!-- Start Gallery --> 
							<div class="clearfix">


								<!-- Start Meta -->
								<aside class="clearfix">

									<div class="text-seperator gal-sep">

										<h5><?php echo $params['title']; ?></h5>
										

										<ul class="meta option-set isotope_filter_menu right clearfix">
	                                    <?php

	                                    	if ($hide_filter_menu != "checked") {
                               					mb_list_categories_of_consolidated_wp_gallery($consolidated_gallery_array);
	                                    	}
	                                    	
	                                    ?>
									  </ul>
									</div>
								
								</aside>

								<!-- Start Isotope -->
								<div class="last thumb-gallery super-list variable-sizes pb_isotope_gallery" data-num_columns="<?php echo $num_columns; ?>">

	                            <?php

	                                        
	                                for ($i = 0; $i < count($consolidated_gallery_array); $i++) { 

	                                    $last_class = (($i+1)%$num_columns) ? "" : " last";
	                                    $cat_class = "";
	                                    foreach ($consolidated_gallery_array[$i]['categories'] as $key => $value) { $cat_class .= " " . $key; }
	                                    $final_class = $size_class . $cat_class . $last_class;

	                                    $post_thumbnail_src = wp_get_attachment_image_src($consolidated_gallery_array[$i]['id'],'full');
	                                    $post_thumbnail_src_fit = wp_get_attachment_image_src($consolidated_gallery_array[$i]['id'],'gallery_isotope_x2');
	                                    $img_alt = get_post_meta($consolidated_gallery_array[$i]['id'], '_wp_attachment_image_alt', true);
	                                    $img_post = get_post($consolidated_gallery_array[$i]['id']);
	                                            
	                                    printf('<div class="gallery_item mosaic-block fade element %s">', esc_attr($final_class));
	                                    printf('<a href="%s" class="mosaic-overlay fancybox" title="%s"></a>', esc_url($post_thumbnail_src[0]), esc_attr($img_post->post_excerpt));
	                                    printf('<div class="mosaic-backdrop"><img src="%s" alt="%s" /></div>', esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));
	                                    echo '</div>';

	                                }

	                            ?>



								</div>
								<!-- end isotope -->

							</div>
							<!-- end gallery -->


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
