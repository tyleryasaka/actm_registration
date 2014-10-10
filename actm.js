var current_section=1;
var total_sections=3;

$(document).ready(function() {
	toggleSection();
	$('#mentor2').hide();
	$('#mentor3').hide();
	$('#mentor4').hide();
});

function nextSection() {
    toggleSection();
	if(current_section==1) $('#register button#back').toggleClass('hide');
	if(current_section==total_sections-1) $('#register button#next').html('Register');
	if(current_section==total_sections) {
		//Submit registration form.
		alert('We\'ll submit the registration form here.');
	}
    if(current_section<total_sections) current_section+=1;
    toggleSection();
    //Jump to top of new form section
    $("html, body").scrollTop($('#toggle-container').offset().top);
}

function prevSection() {
    toggleSection();
	if(current_section==total_sections) $('#register button#next').html('Next');
	if(current_section==2) $('#register button#back').toggleClass('hide');
    if(current_section>1) current_section-=1;
    toggleSection();
    //Jump to top of new form section
    $("html, body").scrollTop($('#toggle-container').offset().top);
}
	function toggleSection() {
    $('#toggle-container div:nth-child('+current_section+')').toggleClass('hide');
    $('#section-counter').html('Step '+current_section+' of '+total_sections);
}
