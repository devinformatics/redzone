<?php

	function block_tribe_event_output ($params) {

		extract($params);

		$default_excerpt_length = 650;

		if (!isset($event_ID) || empty($event_ID)) { return; }

		$event = get_post($event_ID);

		// if block has event ID but the actual event does not exist then exit
		if (!isset($event)) { return; }

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
	                    	<div class="clearfix tribe-events-tcblock">

								<!-- Event Cost -->
								<div class="tribe-events-event-cost">
									<span><?php echo tribe_get_formatted_cost($event_ID); ?></span>
								</div>

								<!-- Event Title -->
								<h2 class="tribe-events-list-event-title summary">
									<?php printf('<a class="url" href="%s" title="%s" rel="bookmark">%s</a>', esc_url(tribe_get_event_link($event_ID)), esc_attr(get_the_title($event_ID)), esc_attr(get_the_title($event_ID))); ?>
								</h2>
								
								<!-- Event Image -->
								<div class="tribe-events-event-image">
									<?php 

										if ( has_post_thumbnail($event_ID) && get_post(get_post_thumbnail_id($event_ID)) ) {
                                            $post_thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($event_ID),'full');
											printf('<a href="%s" title="%s"><img src="%s" title="%s"/></a>', esc_url(tribe_get_event_link($event_ID)), esc_attr(get_the_title($event_ID)), esc_url($post_thumbnail_src[0]), esc_attr(get_the_title($event_ID))); 
										}

									?>

								</div>
								
																
								<!-- Event Meta -->
								<div class="tribe-events-event-meta  vcard location">

									<!-- Schedule & Recurrence Details -->
									<div class="updated published time-details">
										<?php printf('<span class="date-start dtstart">%s</span>', esc_attr(tribe_get_start_date($event_ID))); ?>
									</div>

									<!-- Venue Display Info -->
									<div class="tribe-events-venue-details">

										<span class="author fn org"><?php echo tribe_get_venue($event_ID); ?></span>, 

										<address class="tribe-events-address">
											<span class="adr">
												<span class="street-address"><?php echo tribe_get_address($event_ID); ?></span>
												<span class="delimiter">,</span>  
												<span class="locality"><?php echo tribe_get_city($event_ID); ?></span>
												<span class="delimiter">,</span>  
												<span class="postal-code"><?php echo tribe_get_zip($event_ID); ?></span> 
												<span class="country-name"><?php echo tribe_get_country($event_ID); ?></span>
											</span>
										</address>

										<?php printf('<a class="tribe-events-gmap" href="%s" title="Click to view a Google Map" target="_blank">- Google Map</a>', esc_url(tribe_get_map_link($event_ID))); ?>
	
									</div> <!-- .tribe-events-venue-details -->

								</div><!-- .tribe-events-event-meta -->

								
								
								<!-- Event Content -->
								<div class="tribe-events-list-event-description tribe-events-content description entry-summary">

									
									<?php 
										$event_excerpt = (!empty($event->post_excerpt)) ? do_shortcode($event->post_excerpt) : mb_make_excerpt($event->post_content, $default_excerpt_length, true);

										// excerpt
										echo "<p>";
										echo $event_excerpt;
										echo "</p>";

										// read more
										printf('<a href="%s" class="tribe-events-read-more" rel="bookmark">%s &raquo;</a>', esc_url(tribe_get_event_link($event_ID)), esc_attr(__('Find out more', "loc_sport_core_plugin")) );

									?>


									
								</div><!-- .tribe-events-list-event-description -->
	                         
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
