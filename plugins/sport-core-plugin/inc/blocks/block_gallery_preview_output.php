<?php

	function block_gallery_preview_output ($params) {

		extract($params);

		// BLOCK CLASSES
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

							<!-- start gallery preview--> 
							<div class="clearfix">

								<!-- Start Meta -->
								<aside class="left-aside left fifth">
									<ul class="meta">
										<li><strong><?php echo $title; ?></strong></li>
										<li><?php echo $meta_text; ?></li>
									</ul>

									<?php if (!empty($description)) { printf('<p>%s</p>', do_shortcode($description)); } ?>
									<?php if (!empty($button_text)) { printf('<p><a href="%s" class="btn">%s</a></p>', esc_url($button_url), esc_attr($button_text)); } ?>

								</aside> 

								<div class="four-fifths right last thumb-gallery">

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
												
										printf('<div class="%s"><img src="%s" alt="%s" /></div>', esc_attr($final_class), esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt));

									}

								?>


								</div>

							</div>                              
							<!-- end gallery preview--> 

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
