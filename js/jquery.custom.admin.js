jQuery(document).ready(function() {
// ---------------------------------------------------------
//  	Image
// ---------------------------------------------------------
	var imageOptions = jQuery('#tz-meta-box-image'),
		imageTrigger = jQuery('#post-format-image');
	
	imageOptions.css('display', 'none');
// ---------------------------------------------------------
//  	Audio
// ---------------------------------------------------------
	var audioOptions = jQuery('#tz-meta-box-audio'),
		audioTrigger = jQuery('#post-format-audio');
	
	audioOptions.css('display', 'none');
// ---------------------------------------------------------
//  	Video
// ---------------------------------------------------------
	var videoOptions = jQuery('#tz-meta-box-video'),
		videoTrigger = jQuery('#post-format-video');
	
	videoOptions.css('display', 'none');
// ---------------------------------------------------------
//  	Add Links
// ---------------------------------------------------------
	var addLinks = jQuery('#tz-meta-box-add-links');
	addLinks.css('display', 'none');

	jQuery('#typechecklist input').change(function(){
		if (jQuery(this).is(':checked')){
			addLinks.css('display', 'block');
		} else {
			addLinks.css('display', 'none');
		}
	});
// ---------------------------------------------------------
//  	Core
// ---------------------------------------------------------
	var group = jQuery('#post-formats-select input');
	group.change( function() {
		
		if(jQuery(this).val() == 'audio') {
			audioOptions.css('display', 'block');
			tzHideAll(audioOptions);
		} else if(jQuery(this).val() == 'video') {
			videoOptions.css('display', 'block');
			tzHideAll(videoOptions);
		} else if(jQuery(this).val() == 'image') {
			imageOptions.css('display', 'block');
			tzHideAll(imageOptions);
		} else {
			audioOptions.css('display', 'none');
			videoOptions.css('display', 'none');
			imageOptions.css('display', 'none');
		}
		
	});

	if(audioTrigger.is(':checked'))
		audioOptions.css('display', 'block');
	if(videoTrigger.is(':checked'))
		videoOptions.css('display', 'block');
	if(imageTrigger.is(':checked'))
		imageOptions.css('display', 'block');
		
	function tzHideAll(notThisOne) {
		audioOptions.css('display', 'none');
		videoOptions.css('display', 'none');
		imageOptions.css('display', 'none');
		notThisOne.css('display', 'block');
	}
});