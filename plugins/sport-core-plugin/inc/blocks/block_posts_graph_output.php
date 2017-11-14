<?php

	function block_posts_graph_output ($params) {

		extract($params);

		// BLOCK CLASSES
		$block_classes = "outter-wrapper graph-block";
		if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }
		if (true) { $bg_boxed = "unchecked"; }	// this block only has full width content

	    // VARS
	    $default_excerpt_length = 165;

		//build exclude string
		$exclude_string = "";
		$results_exclude_posts = get_posts(array(
			'numberposts'		=> -1,
    		'meta_key'          => 'cmb_hide_from_popular',
			'meta_value'		=> 'checked',
			'orderby'			=> 'post_date',
			'order'				=> 'DESC',
			'post_type'			=> 'any',
		));
		if (count($results_exclude_posts) > 0) {
			$exclude_string = "";
			for ($i = 0; $i < count($results_exclude_posts); $i++) {  
				$exclude_string .= $results_exclude_posts[$i]->ID . ",";
			}	
			$exclude_string = substr($exclude_string, 0, strlen($exclude_string)-1);
		} 

		//basic args
		$query_args = array();
		$query_args = array_merge($query_args, array(
			'post_type'    		=> 'post',
			'numberposts' 		=> $num_posts,
			'post_status'     	=> 'publish',
			'offset' 			=> 0,
			'suppress_filters' 	=> false
		));

		if ($show == "latest_posts") {
			$query_args = array_merge($query_args, array(
				'category'			=> '',
				'orderby'			=> 'post_date',
				'order'				=> 'DESC',
			));
		} elseif ($show == "random_posts") {
			$query_args = array_merge($query_args, array(
				'category'			=> '',
				'orderby'			=> 'rand',
			));
		} elseif ($show == "popular_views") {
			$query_args = array_merge($query_args, array(
				'category'			=> '',
				'meta_key'			=> 'post_views',
        		'orderby'   		=> 'meta_value_num', //or 'meta_value_num'
				'order'				=> 'DESC',
				'exclude'			=> $exclude_string,
			));
		} elseif ($show == "popular_comments") {
			$query_args = array_merge($query_args, array(
				'category'			=> '',
				'orderby'			=> 'comment_count',
				'order'				=> 'DESC',
				'exclude'			=> $exclude_string,
			));
		} elseif (strpos($show, "postcat_") !== false) {
			$show = str_replace("postcat_", "", $show);
			$query_args = array_merge($query_args, array(
				'category_name'		=> $show,
				'orderby'			=> 'post_date',
				'order'				=> 'DESC',
			));
		}

		//final query
		$results_query = get_posts($query_args);

		// determine x-axis chronology
		if ($x_axis == "new_right") { $results_query = array_reverse($results_query); }

		// var_dump($query_args);
		// var_dump($results_query);

		//if less posts in query set num_posts to num query posts
		if (count($results_query) < $num_posts) $num_posts = count($results_query);


		?>

		<!-- BLOCK: LATEST POSTS-->

	        <!-- start outter-wrapper -->   
	        <div <?php pb_block_id_class($block_classes, $params); ?> <?php if ($bg_boxed != 'checked') { printf("data-stellar-background-ratio='$parallax_ratio'"); } ?>>

	            <!-- block styles -->
	            <style type="text/css" scoped>
					<?php include 'includes/inc_block_output_style.php'; ?>

					<?php 
						// block exclusive styles
						if (!empty($font_color)) {
							printf("#%s .graph-img { border-color: %s; }", pb_get_block_id($params), esc_attr($font_color));
							printf("#%s .graph-stem { background-color: %s; }", pb_get_block_id($params), esc_attr($font_color));
						}
					 ?>
	            </style>

				<!-- Start Post --> 
            	<div class="clearfix">

					<h1 class="centered"><?php echo $title; ?></h1>

					<p class="centered"><?php echo do_shortcode($description); ?></p>	
       
       
	               	<div class="contents-graph">

	               		<?php 

							for ($i = 0; $i < count($results_query); $i++) { 
								
								$current_post = $results_query[$i];

                                $post_thumbnail_src_fit = wp_get_attachment_image_src(get_post_thumbnail_id($current_post->ID),'posts_graph_thumb_x2');
                                $img_alt = get_post_meta(get_post_thumbnail_id($current_post->ID), '_wp_attachment_image_alt', true);
                                $img_post = get_post(get_post_thumbnail_id($current_post->ID));

                                $y_value = 0;
                                switch ($y_axis) {
                                	case 'hits':
										$y_value =  get_post_meta( $current_post->ID, 'post_views', true );
                                		break;
                                	default:
                                		$y_value = $current_post->comment_count;
                                		break;
                                }
								
								?>

				               		<div class="single-graph">
				               			<div class="graph-inner" data-y_value="<?php echo $y_value; ?>">

				               				<?php 

				               					if ( has_post_thumbnail($current_post->ID) && get_post(get_post_thumbnail_id($current_post->ID)) ) { 
					               					printf('<a href="%s"><img class="graph-img" src="%s" alt="%s" /></a>', get_permalink($current_post->ID), esc_url($post_thumbnail_src_fit[0]), esc_attr($img_alt)); 
				               					} else {
					               					printf('<a href="%s"><img class="graph-img" src="%s" alt="%s" /></a>', get_permalink($current_post->ID), plugins_url('', __FILE__ ) . "/../../img/default_posts_graph.jpg", esc_attr($img_alt)); 
				               							
				               					}

				               				?>

				               				<div class="graph-stem"></div>
				               			</div>
				               		</div>

								<?php

							}

	               		?>

	               		
	               		<div class="justify-fix"></div>

	               	</div>
	               	<!-- end contents-graph -->
	               		
				</div>
				<!-- end clearfix -->




	        </div>
	        <!-- end outter-wrapper -->
	        
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}
