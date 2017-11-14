<?php

	function block_featured_img_output ($params) {

		extract($params);

        // BLOCK CLASSES
        $block_classes = "outter-wrapper feature";
        if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		?>

		<!-- BLOCK: FEATURED IMAGE-->
        <?php

            if (has_post_thumbnail(get_the_ID())) { 
            ?>

                <div <?php pb_block_id_class($block_classes, $params); ?>>
                
                    <!-- block styles -->
                    <style type="text/css" scoped>
                        <?php include 'includes/inc_block_output_style.php'; ?>
                    </style>

                    <?php the_post_thumbnail(); ?>
                    
                </div>

            <?php
            } else {
            ?>

                <!-- Start Outter Wrapper -->   
                <div <?php pb_block_id_class('outter-wrapper feature', $params); ?>>
                    <hr>
                </div>
                <!-- End Outter Wrapper --> 
                       
            <?php       
                    
            }

        ?>
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}
