jQuery(document).ready(function() {
// ---------------------------------------------------------
//  	Image
// ---------------------------------------------------------
	var imageOptions = jQuery('#tz-meta-box-image');
	var imageTrigger = jQuery('#post-format-image');
	
	imageOptions.css('display', 'none');
// ---------------------------------------------------------
//  	Audio
// ---------------------------------------------------------
	var audioOptions = jQuery('#tz-meta-box-audio');
	var audioTrigger = jQuery('#post-format-audio');
	
	audioOptions.css('display', 'none');
// ---------------------------------------------------------
//  	Core
// ---------------------------------------------------------
	var group = jQuery('#post-formats-select input');
	group.change( function() {
		
		if(jQuery(this).val() == 'audio') {
			audioOptions.css('display', 'block');
			tzHideAll(audioOptions);
		} else if(jQuery(this).val() == 'image') {
			imageOptions.css('display', 'block');
			tzHideAll(imageOptions);
		} else {
			audioOptions.css('display', 'none');
			imageOptions.css('display', 'none');
		}
		
	});

	if(audioTrigger.is(':checked'))
		audioOptions.css('display', 'block');
	if(imageTrigger.is(':checked'))
		imageOptions.css('display', 'block');
		
	function tzHideAll(notThisOne) {
		audioOptions.css('display', 'none');
		imageOptions.css('display', 'none');
		notThisOne.css('display', 'block');
	}
});