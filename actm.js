//Tyler Yasaka, Victor Rogers, Ben Etheredge


var current_section=1, total_sections=3;
var currentMentorsDisplayed=1, maxMentorsDisplayed=4;
var tests = ['comprehensive','algebraII','geometry'];
var schoolfee = 10;


// Function Name: 
// Inputs  :
// Outputs :
// Return  :
// Description:
// Programmer: 
$(document).ready(function() {
	//Hide sections to begin with.
	for(var i=1;i<=total_sections;i++){
		$('.section-'+i).hide();
	}
	$('#register button#back').hide();
	toggleSection();
});

// Function Name: addMentor
// Inputs  : NONE
// Outputs : div - container of additional mentor form slots
// Return  : NONE
// Description: adds an addition form area for additional mentor information
// Programmer: 
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

// Function Name: updatePrice
// Inputs  : string - id/name of input element
// Outputs : Updates price field
// Return  : NONE
// Description: Calculates and updates price field calling it
// Programmer: 
function updatePrice(test) {
	$('#'+test+'Price').val($('#'+test+'Qty').val() * 5);
	//Initialize total with flat school fee
	var total=schoolfee;
	for(var i in tests){
		total+=parseInt($('#'+tests[i]+'Price').val());
	}
	$('#total').val(total);
}

// Function Name: itemValidate
// Inputs  : string - id of element
//			 regex - pattern for regular expression
// Outputs : 
// Return  : function = re.test(item)
// Description: Checks for the validity of the input id against the
//				input regular expression
// Programmer: 
function itemValidate(id, regex){
	var item = $('#'+id).val();
	var re = regex;
	if (!re.test(item)){
		displayError(id);
	}
	else {
		removeError(id);
	}
	return re.test(item);
}

// Function Name: displayError
// Inputs  : string - id of element
// Outputs :
// Return  :
// Description:
// Programmer: 
function displayError(id){
	$('#'+id).parent().addClass('has-error');}

// Function Name: removeError
// Inputs  : string - id of element
// Outputs :
// Return  :
// Description:
// Programmer: 
function removeError(id){
	$('#'+id).parent().removeClass('has-error');
}

// Function Name: sectionValidate
// Inputs  : NONE
// Outputs :
// Return  : boolean - is input is valid
// Description:
// Programmer: 
function sectionValidate(){
	//Ok by default
	var OK = true;
	//Custom validate for page 1
	if(current_section==1){
		//Call desired validation functions
		OK=itemValidate('school', /./);
	}
	//Custom validate for page 2
	if(current_section==2){
		//Call desired validation functions
		OK=(itemValidate('mentorname-1', /./)&&
			itemValidate('mentoremail-1', /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/)&&
			itemValidate('mentorphone-1', /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/));
	}
	//Custom validate page 3
	if(current_section==3){
		//I call this function separately because it uses a different validation function.
		//Due to the way JS evaluates truth statements, this ensures that the function is actually
		//called every time. Thus the error message used by this function will display and hide appropriately.
		var payment_validated=validatePayment();
		//Call desired validation functions
		OK=(payment_validated&&
			itemValidate('comprehensiveQty', /[0-9]+/)&&
			itemValidate('algebraIIQty', /[0-9]+/)&&
			itemValidate('geometryQty', /[0-9]+/));
	}
	return OK;
}



// Function Name: 
// Inputs  :
// Outputs :
// Return  :
// Description: This requires custom validation because it depends on multiple inputs and needs to display an error message.
// Programmer: 
function validatePayment(){
	OK = true
	if( $('#comprehensiveQty').val() + $('#algebraIIQty').val() + $('#geometryQty').val() < 1){
		$('#paymenterror').html('\nPlease select at least 1 test.');
		OK = false;
	}
	//Reset the error message.
	else $('#paymenterror').html('');
	return OK;
}

// Function Name: nextSection
// Inputs  : NONE
// Outputs :
// Return  :
// Description:
// Programmer: 
function nextSection() {
	if(sectionValidate()){
		//Reset the error message at top of page.
		$('#sectionerror').html('');
		toggleSection();
		if(current_section==1) $('#register button#back').toggle();
		if(current_section==total_sections-1) $('#register button#next').html('Register');
		if(current_section==total_sections) {
			//Submit registration form.
			$('#mainform').submit();
		}
		if(current_section < total_sections) current_section+=1;
		toggleSection();
		//Jump to top of new form section
		$("html, body").scrollTop($('#toggle-container').offset().top);
	}
	else {
		//Display error message at top of page, jump to this message.
		$('#sectionerror').html('<h4 class="error">Please fix the errors on this page.</h4>');
		$("html, body").scrollTop($('#sectionerror').offset().top);
	}
}

// Function Name: 
// Inputs  :
// Outputs :
// Return  :
// Description:
// Programmer: 
function prevSection() {
    toggleSection();
	if(current_section==total_sections) $('#register button#next').html('Next');
	if(current_section==2) $('#register button#back').toggle();
    if(current_section>1) current_section-=1;
    toggleSection();
    //Jump to top of new form section
    $("html, body").scrollTop($('#toggle-container').offset().top);
}

// Function Name: 
// Inputs  :
// Outputs :
// Return  :
// Description:
// Programmer: 
function toggleSection() {
    $('#toggle-container div:nth-child('+current_section+')').toggle();
    $('#section-counter').html('Step '+current_section+' of '+total_sections);
}
