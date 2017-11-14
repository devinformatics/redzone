<?php

	function block_img_output ($params) {

		extract($params);

        // set classes

        switch ($layout) {
            case 'full_width_fit':
                $block_classes = "outter-wrapper pb_no_top_hr";
                $outer_wrapper_class = "outter-wrapper feature";
                $inner_wrapper_class = "";
                break;
            case 'boxed_fit':
                $block_classes = "outter-wrapper";
                $outer_wrapper_class = "outter-wrapper feature";
                $inner_wrapper_class = "wrapper feature-boxed";
                break;
            case 'boxed':
                $block_classes = "outter-wrapper";
                $outer_wrapper_class = "outter-wrapper";
                $inner_wrapper_class = "wrapper";
                break;
            case 'boxed_center':
                $block_classes = "outter-wrapper";
                $outer_wrapper_class = "outter-wrapper";
                $inner_wrapper_class = "wrapper align_center";
                break;
            case 'boxed_right':
                $block_classes = "outter-wrapper";
                $outer_wrapper_class = "outter-wrapper";
                $inner_wrapper_class = "wrapper align_right";
                break;
            default:
                $block_classes = "outter-wrapper";
                $outer_wrapper_class = "outter-wrapper feature";
                $inner_wrapper_class = "";
                break;
        }

        // BLOCK CLASSES
        if (!empty($custom_classes)) { $block_classes .= " " . $custom_classes; }

		?>

		<!-- BLOCK: IMAGE-->
        <?php

            if (!empty($img_url)) { 
            ?>

                <div <?php pb_block_id_class($block_classes, $params); ?>>
                
                    <!-- block styles -->
                    <style type="text/css" scoped>
                        <?php include 'includes/inc_block_output_style.php'; ?>
                    </style>

                    <div class="<?php echo $outer_wrapper_class; ?>">
                        <div class="<?php echo $inner_wrapper_class; ?>">

                            <img src="<?php echo $img_url; ?>" alt="blockimage">

                        </div>
                    </div>
                </div>

            <?php
            } 

        ?>
		<!-- END BLOCK -->
		
		<?php

		return true;		
	}
