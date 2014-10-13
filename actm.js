//Tyler Yasaka, Victor Rogers, Ben Etheredge

var current_section=1, total_sections=3;
var currentMentorsDisplayed=1, maxMentorsDisplayed=4;
var tests = ['comprehensive','algebraII','geometry'];
var schoolfee = 10;

$(document).ready(function() {
	//Hide sections to begin with.
	for(var i=1;i<=total_sections;i++){
		$('.section-'+i).hide();
	}
	$('#register button#back').hide();
	toggleSection();
});

function addMentor(){
	if(currentMentorsDisplayed <= maxMentorsDisplayed){
		currentMentorsDisplayed++;
		var mentor_container = $('#mentorcontainer').html();
		mentor_container +=
						['<h4>Additional Mentor</h4>',
						'<div class="form-group">',
                            '<label>Name</label>',
                            '<input class="form-control" type="text" ',
                            '    name="mentorname-'+currentMentorsDisplayed+'"/>',
                        '</div>',
                        '<div class="form-group">',
                        '    <label>Email</label>',
                        '    <input class="form-control" type="email"', 
                        '        name="mentoremail-'+currentMentorsDisplayed+'"/>',
                        '</div>',
                        '<div class="form-group">',
                        '    <label>Phone Number</label>',
                        '    <input class="form-control" type="tel"', 
                        '        name="mentorphone-'+currentMentorsDisplayed+'"/>',
                        '</div>'
		].join('\n');
		$('#mentorcontainer').html(mentor_container);
	}
	if(currentMentorsDisplayed == maxMentorsDisplayed){
		$('#mentorButton').hide();
	}
}

function updatePrice(test) {
	$('#'+test+'Price').val($('#'+test+'Qty').val() * 5);
	//Initialize total with flat school fee
	var total=schoolfee;
	for(var i in tests){
		total+=parseInt($('#'+tests[i]+'Price').val());
	}
	$('#total').val(total);
}

function validatePayment(){
	if( $('#comprehensiveQty').val() + $('#algebraIIQty').val() + $('#geometryQty').val() < 1){
		$('#paymenterror').html('\nPlease select at least 1 test.');
		return false;
	}
	else return true;
}

function nextSection() {
	if($('.section-'+current_section+' input').valid()){
		toggleSection();
		if(current_section==1) $('#register button#back').toggle();
		if(current_section==total_sections-1) $('#register button#next').html('Register');
		if(current_section==total_sections) {
			//Submit registration form.
			if(validatePayment()) $('#mainform').submit();
		}
		if(current_section < total_sections) current_section+=1;
		toggleSection();
		//Jump to top of new form section
		$("html, body").scrollTop($('#toggle-container').offset().top);
	}
	//Jump to top of page to see errors
	else $("html, body").scrollTop($('#toggle-container').offset().top);
}

function prevSection() {
    toggleSection();
	if(current_section==total_sections) $('#register button#next').html('Next');
	if(current_section==2) $('#register button#back').toggle();
    if(current_section>1) current_section-=1;
    toggleSection();
    //Jump to top of new form section
    $("html, body").scrollTop($('#toggle-container').offset().top);
}

function toggleSection() {
    $('#toggle-container div:nth-child('+current_section+')').toggle();
    $('#section-counter').html('Step '+current_section+' of '+total_sections);
}
