jQuery(document).ready(function() {
// ---------------------------------------------------------
//  	Image
// ---------------------------------------------------------
	var imageOptions = jQuery('#tz-meta-box-image');
	var imageTrigger = jQuery('#post-format-image');
	
	imageOptions.css('display', 'none');
// ---------------------------------------------------------
//  	Link
// ---------------------------------------------------------
	var linkOptions = jQuery('#tz-meta-box-link');
	var linkTrigger = jQuery('#post-format-link');
	
	linkOptions.css('display', 'none');
// ---------------------------------------------------------
//  	Core
// ---------------------------------------------------------
	var group = jQuery('#post-formats-select input');
	group.change( function() {
		
		if(jQuery(this).val() == 'link') {
			linkOptions.css('display', 'block');
			tzHideAll(linkOptions);
		} else if(jQuery(this).val() == 'image') {
			imageOptions.css('display', 'block');
			tzHideAll(imageOptions);
		} else {
			linkOptions.css('display', 'none');
			imageOptions.css('display', 'none');
		}
		
	});

	if(linkTrigger.is(':checked'))
		linkOptions.css('display', 'block');
	if(imageTrigger.is(':checked'))
		imageOptions.css('display', 'block');
		
	function tzHideAll(notThisOne) {
		linkOptions.css('display', 'none');
		imageOptions.css('display', 'none');
		notThisOne.css('display', 'block');
	}
});