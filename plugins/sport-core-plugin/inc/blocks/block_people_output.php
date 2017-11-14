<?php

	function block_people_output ($params) {

		extract($params);

	    //	VARS
		$default_excerpt_length = 80;

	    //	SET CLASSES
	    $base_class = "boxed";
	    $size_class = " " . mb_get_size_class_from_num($num_columns, "fourth");

	    //	GET PEOPLE
	    $query_args = array();
		$query_args = array(
			'post_type' 		=> 'cpt_people',
			'posts_per_page'	=> -1,
	        'post_status'       => 'publish',
			'tax_query' 		=> array(
				array(
					'taxonomy' 		=> 'people_category',
					'field' 		=> 'slug',
					'terms' 		=> $show
				),
			),
			'suppress_filters' 	=> false,
		);

		// DETERMINE ORDER
		if ($orderby == "alphabetical_asc") {
			$query_args = array_merge($query_args, array(
		        'orderby'           => 'title',
		        'order'             => 'ASC',
			));
		} elseif ($orderby == "alphabetical_desc") {
			$query_args = array_merge($query_args, array(
		        'orderby'           => 'title',
		        'order'             => 'DESC',
			));
		} elseif ($orderby == "date_asc") {
			$query_args = array_merge($query_args, array(
		        'orderby'           => 'date',
		        'order'             => 'ASC',
			));
		} elseif ($orderby == "date_desc") {
			$query_args = array_merge($query_args, array(
		        'orderby'           => 'date',
		        'order'             => 'DESC',
			));
		} elseif ($orderby == "index_asc") {
			$query_args = array_merge($query_args, array(
				'meta_key'			=> 'cmb_index',
	    		'orderby'   		=> 'meta_value_num',
				'order'				=> 'ASC',
			));
		} elseif ($orderby == "index_desc") {
			$query_args = array_merge($query_args, array(
				'meta_key'			=> 'cmb_index',
	    		'orderby'   		=> 'meta_value_num',
				'order'				=> 'DESC',
			));
		} else {
			$query_args = array_merge($query_args, array(
		        'orderby'           => 'rand',
			));
		}



		//	FINAL QUERY
		$results_people = get_posts($query_args);

		// UPDATE NUM PEOPLE
		if (count($results_people) < $num_people) { $num_people = count($results_people); }

		// BLOCK CLASSES
		$block_classes = "outter-wrapper";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		?>

		<!-- BLOCK: PEOPLE-->

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


	                    		<?php 

	                    			for ($i = 0; $i < $num_people; $i++) { 
	                    				$last_class = ( ($i+1)%$num_columns ) ? "" : " last";
	                    				$final_class = $base_class . $size_class . $last_class;

	                    				$this_person = $results_people[$i];

										// get custom fields
										$cmb_title = get_post_meta($this_person->ID, 'cmb_title', true);
										$cmb_excerpt = get_post_meta($this_person->ID, 'cmb_excerpt', true);
										$cmb_excerpt_is_quote = get_post_meta($this_person->ID, 'cmb_excerpt_is_quote', true);
										$cmb_show_social_links = get_post_meta($this_person->ID, 'cmb_show_social_links', true);
										$cmb_social_links = get_post_meta($this_person->ID, 'cmb_social_links', true);

                                        // get featured image
                                        $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($this_person->ID),'full');
                                        $img_alt = get_post_meta(get_post_thumbnail_id($this_person->ID), '_wp_attachment_image_alt', true);

	                    				// var_dump($this_person);
	                    			?>

	                    			<?php if ( ($i === 0) || ($i%$num_columns === 0) ) { echo '<div class="clearfix">'; } ?>

		    	                		<div class="<?php echo $final_class; ?> personColumn">


		    	                			<!-- image -->
		    	                			<?php 

		    	                				if ($post_thumbnail_src) { 
		    	                				
		    	                					if ($link_through == "checked") {
			    	                					printf('<a href="%s"><img src="%s" alt="%s" /></a>', esc_url(get_permalink($this_person->ID)), esc_url($post_thumbnail_src[0]), esc_attr($img_alt)); 
		    	                					} else {
			    	                					printf('<img src="%s" alt="%s" />', esc_url($post_thumbnail_src[0]), esc_attr($img_alt)); 
		    	                					}

		    	                				} 

		    	                			?>

		    	                			<div class="inner-box">

		    	                				<div class="person_info<?php if ($even_height == "checked") { echo " even-height"; } ?>" data-even_height_group="inner-box-<?php echo $block_index; ?>">

			    	                				<!-- name -->
			    	                				<?php 

			    	                					if ($link_through == "checked") {
			    	                						printf( '<h4><a href="%s">%s</a></h4>', esc_url(get_permalink($this_person->ID)), esc_attr($this_person->post_title) );
			    	                					} else {
			    	                						printf( '<h4>%s</h4>', esc_attr($this_person->post_title) );
			    	                					}

			    	                				?>

			    	                				<h5><?php echo $cmb_title; ?></h5>
			    	                				<em class="<?php if ($cmb_excerpt_is_quote == 'checked') { echo "quote"; } ?>"><?php if (empty($cmb_excerpt)) { echo mb_make_excerpt($this_person->post_content, $default_excerpt_length, true); } else {echo do_shortcode($cmb_excerpt);} ?></em>

		    	                				</div>
		    	                				

                                            <?php 

                                                if ($cmb_show_social_links == "checked") {

                                                    echo '<ul class="social-link">';

                                                    for ($n = 0; $n < count($cmb_social_links); $n++) { 
                                                    ?>
                                                        <li><a href="<?php echo $cmb_social_links[$n]['link']; ?>" target="_blank"><em class="fa <?php echo $cmb_social_links[$n]['icon']; ?>"></em></a></li>
                                                    <?php
                                                    }

                                                    echo '</ul>';
                                                        
                                                }

                                            ?>

		    	                			</div>
		    	                		</div>
	                    				
	                    			<?php if ( (($i+1)%$num_columns === 0)  || (($i+1) === $num_people) ) { echo '</div>'; } ?>

	                    			<?php

	                    			}

	                    		?>

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
