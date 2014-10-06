var slidestory_width = 0,current_slide=1,total_slides=3;

$(document).ready(function() {
	toggleSlide();
	});

	function nextSlide() {
	    toggleSlide();
	    if(current_slide<total_slides) current_slide+=1;
	    toggleSlide();
	}

	function toggleSlide() {
	    '#toggle-container div:nth-child('+current_slide+')').toggleClass('show-slide');
		//$('#toggle-container div:nth-child('+current_slide+')').toggleClass('show-slide');
	}
