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

i = 2
function toggleMentor() {
		if i = 2
			'#mentor2.toggleClass('mentor2');
		else if i=3
			'#mentor3 div:nth-child('+current_slide+')').toggleClass('mentor3');
		else	
			'#mentor4 div:nth-child('+current_slide+')').toggleClass('mentor4');

	i+=1
//$('#toggle-container div:nth-child('+current_slide+')').toggleClass('show-slide');
}
