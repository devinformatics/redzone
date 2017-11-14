"use strict";

/*************************************************************
WIDGETS PLUGIN BACKEND SCRIPTS

COLOR WIDGETS
UL CONTROL
MAKE UL SORTABLE
FONT AWESOME SELECT PREVIEW ICON
WIDGET COLORPICKER

*************************************************************/


/*************************************************************
COLOR WIDGETS
*************************************************************/

	jQuery(document).ready(function($) {
		if ($('.widget').size() > 0) {

			//color widgets
			$('.widget').each(function(index, e) {
				var $this = $(this);
				if ($this.attr('id')) {
					if ($this.attr('id').indexOf('sport_') != -1) $this.find('.widget-title').css({
						'backgroundColor': '#dd4400',
						'color': '#ffffff',
						'text-shadow': 'none'
					});
				}

			});

		}
	});

/*************************************************************
UL CONTROL

This script assumes the structure

<ul class="ul_sortable" data-split_index="">
	<li>
		<input class="li_option" type='text' name='somename' value="">
	</li>
</ul>
<div class="ul_control" data-min="" data-max="">
	<input type="button" class="button ul_add" value="<?php _e("Add", "loc_sport_widgets_plugin"); ?>" />
	<input type="button" class="button ul_del" value="<?php _e("Delete", "loc_sport_widgets_plugin"); ?>" />
</div>

clicking class ul_add will clone and add last li 
clicking class ul_del will remove last li unless li is the last one left
each input with a name attr must have li_option class so that it is reindexed
data-min and data-max determine min and max number of elements
data-split_index determines what index to update
*************************************************************/

	jQuery(document).ready(function($) {
		if ($('.ul_control').size() > 0) {

			$('body').on('click', '.ul_add', function(event) {
				var $this = $(this);
				var $thisControl = $(this).closest('.ul_control');
				var $relatedUL = $thisControl.prev('ul');
				var $LIs = $relatedUL.find('li');
				var numLIs = $LIs.size();
				var min = $thisControl.attr('data-min');
				var max = $thisControl.attr('data-max');

				if (numLIs < max) {
					$LIs.last().clone().appendTo($relatedUL);

					var $newLIs = $this.closest('.ul_control').prev('ul').find('li').last();
					var splitIndex = $relatedUL.attr('data-split_index');

					var $liOptions = $newLIs.find('.li_option');
					$liOptions.each(function(index, el) {
						var $this = $(this);
						var name = $this.attr('name');

						var nameArray = name.split('[');
						nameArray[splitIndex] = numLIs+"]";

						name = nameArray.join('[');
						$this.attr('name',name);

					});
				}
			});

			$('body').on('click', '.ul_del', function(event) {
				var $this = $(this);
				var $thisControl = $(this).closest('.ul_control');
				var $relatedUL = $thisControl.prev('ul');
				var $LIs = $relatedUL.find('li');
				var numLIs = $LIs.size();
				var min = $thisControl.attr('data-min');

				if ( (numLIs > 1) && (numLIs > min) ) {
					$LIs.last().remove();	
				}
			});

		}
	});

/*************************************************************
MAKE UL SORTABLE
*************************************************************/

	// on document ready
	jQuery(document).ready(function($) {
		if ($('.widget_sortable').size() > 0) {

			initWidgetSortable();

			// reinit on widget add (previewer)
			$(document).on( 'widget-added', function (event) {
				initWidgetSortable();
			});

		}

		function initWidgetSortable () {
				
			$('.widget_sortable').sortable ({
				placeholder: 'widget_sortable_placeholder',
				revert: true,
				update: updateIndexesWidgetSortable,
			});

		}


		function updateIndexesWidgetSortable (event, ui) {

			var $this = $(this);


			var blockName ="";
			var splitIndex = $this.attr('data-split_index');
			var liIndex = 0;
			var optionNameArray = new Array();
			var $LIs = $this.find('li');
			$LIs.each(function (index, element) {
				var $this = $(this);
				var liIndex = index;
				var $options = $this.find('.li_option');
				$options.each(function (index, element) {
					var $thisOption = $(this);
					//update option name (make sure it only updates numbers in 2nd bracket)
					var optionName = $thisOption.attr('name');
					var optionNameArray = optionName.split('[');
					optionNameArray[splitIndex] = liIndex+"]";

					optionName = optionNameArray.join('[');
					$thisOption.attr('name',optionName);
				});
			}); 

			// force change event on first input to activae previewer to update
			$this.find('input').first().trigger('change');
		}



	});

	// when ever a theme widget has bee saved. NB: remember to change widget_id_base for future themes.
	jQuery(document).ajaxSuccess(function(e, xhr, settings) {

		$ = jQuery;

		// make sure this code only runs on widgets page
		if ($('.widgets-php').size() > 0) {

			var widget_id_base = 'sport';

			if(settings.data.search('action=save-widget') != -1 && settings.data.search('id_base=' + widget_id_base) != -1) {

				//SORTABLE
				$('.widget_sortable').sortable ({
					placeholder: 'widget_sortable_placeholder',
					revert: true,
					update: ajaxUpdateIndexesWidgetSortable,
				});
				
			}

		}

		function ajaxUpdateIndexesWidgetSortable (event, ui) {

			$ = jQuery;

			var $this = $(this);
			var blockName ="";
			var splitIndex = $this.attr('data-split_index');
			var liIndex = 0;
			var optionNameArray = new Array();
			var $LIs = $this.find('li');
			$LIs.each(function (index, element) {
				var $this = $(this);
				var liIndex = index;
				var $options = $this.find('.li_option');
				$options.each(function (index, element) {
					var $thisOption = $(this);
					//update option name (make sure it only updates numbers in 2nd bracket)
					var optionName = $thisOption.attr('name');
					var optionNameArray = optionName.split('[');
					optionNameArray[splitIndex] = liIndex+"]";

					optionName = optionNameArray.join('[');
					$thisOption.attr('name',optionName);
				});
			}); 

		}

	});

/*****************************************
FONT AWESOME SELECT PREVIEW ICON
*****************************************/

	jQuery(document).ready(function($) {
		if ($('.fa_select').size() > 0) {

			$('body').on('change', '.fa_select', function(event) {
				var $this = $(this);
				var thisValue = $this.val();
				var $iconPreview = $this.next('i');

				$iconPreview.attr('class', "fa " + thisValue);
			});

		}

	});

/*****************************************
WIDGET COLORPICKER
*****************************************/

	jQuery(document).ready(function($) {

		//init
		initWidgetColorPicker();

		// reinit on sortstart
		$('div.widgets-sortables').on('sortstart',function(event,ui){
			initWidgetColorPicker();
		});	

		// reinit on click add widget button notice delay to allow for actual moving
		$('.widgets-chooser-actions .button-primary').on('click', function () {
			setTimeout(function(){
				initWidgetColorPicker();
			},1000);
			
		});

		// reinit on add chart data
		$('body').on('click', '.ul_add', function (event) {
			initWidgetColorPicker();
		});

		// reinit on widget add (previewer)
		$(document).on( 'widget-added', function (event) {
			initWidgetColorPicker();
		});	

		function initWidgetColorPicker () {

			$('.colorSelectorBox.widget_color_selector').each(function (index, e) {
				var $this = $(this);
				var $relatedInput = $this.next('input');
				$this.ColorPicker({
					color: $relatedInput.val(),
					onShow: function (colpkr) {
						$(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						$(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						$this.find('div').css('backgroundColor', '#' + hex);
						$relatedInput.val("#" + hex);
						// console.log(rgb.b);
					}
				});
					
			});

		}

	});



