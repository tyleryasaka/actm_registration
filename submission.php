<?php

//Make sure there is post data
if(isset($_POST['school'])){

// School / Test site Information
$school = filter_input(INPUT_POST, 'school', FILTER_SANITIZE_SPECIAL_CHARS);
$street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_SPECIAL_CHARS);
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_SPECIAL_CHARS);
$state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_SPECIAL_CHARS);
$zip = filter_input(INPUT_POST, 'zip', FILTER_SANITIZE_NUMBER_INT);
$division = filter_input(INPUT_POST, 'selectDivision', FILTER_SANITIZE_SPECIAL_CHARS);
$testSite = filter_input(INPUT_POST, 'selectTestingSite', FILTER_SANITIZE_SPECIAL_CHARS);

// Mentors
$mentorNames = [];
$mentorEmails = [];
$mentorPhones = [];
$mentorCount = filter_input(INPUT_POST, "mentorcount", FILTER_SANITIZE_NUMBER_INT);

//Get all of the mentors
for($i=0;$i<$mentorCount;$i++){
	$j = $i+1;
	$mentorNames[] = filter_input(INPUT_POST, "mentorname-$j", FILTER_SANITIZE_SPECIAL_CHARS);
	$mentorEmails[] = filter_input(INPUT_POST, "mentoremail-$j", FILTER_SANITIZE_EMAIL);
	$mentorPhones[] = filter_input(INPUT_POST, "mentorphone-$j", FILTER_SANITIZE_NUMBER_INT);
}

// Test Purchase Information
$comprehensiveQty = filter_input(INPUT_POST, 'comprehensiveQty', FILTER_SANITIZE_NUMBER_INT);
$algebraIIQty = filter_input(INPUT_POST, 'algebraIIQty', FILTER_SANITIZE_NUMBER_INT);
$geometryQty = filter_input(INPUT_POST, 'geometryQty', FILTER_SANITIZE_NUMBER_INT);

// Pricing
$schoolFee = 10;
$comprehensivePrice = $comprehensiveQty * 5;
$algebraIIPrice = $algebraIIQty * 5;
$geometryPrice = $geometryQty * 5;
$totalPrice = $comprehensivePrice + $algebraIIPrice + $geometryPrice + $schoolFee;

// Email Response
$from = 'jajerkins@una.edu';
$subject = "2014 Alabama Statewide High School Mathematics Contest";
$headers = "From: $from\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//This is used for both the email and the html output page.
$confirmationMessage = <<<HTML
				<h2>Thank you for your registering!</h2>
				<h3>Grand Total: $$totalPrice </h3>
				<p>Please make your check for the above amount payable to <strong>Alabama Council of Teachers of Mathematics</strong>.<br><br>
				   Mail your check to:</p>
				<p class="text-center">
				University of North Alabama, Dept of Mathematics<br>
				ATTN: AL HS Math Contest<br>
				One Harrison Plaza, Box 5051<br>
				Florence, AL 35632<br>
				</p>
				<h3>Registration Details:</h3>
				<h4>School</h4>
				<p><strong>$school</strong></p>
				<p>$street<br>$city, $state $zip</p>
				<p><strong>$division</strong></p>
				<p>Testing Site: <strong>$testSite</strong></p>
				<h4>Mentors</h4>
				<table class="table" cellpadding="10">
					<tr><th>Name</th><th>Email</th><th>Phone</th></tr>
HTML;
for($i=0;$i<$mentorCount;$i++){
	$j = $i+1;
	$confirmationMessage .= "
					<tr><td>$mentorNames[$i]</td><td>$mentorEmails[$i]</td><td>$mentorPhones[$i]</td></tr>
	";
}
$confirmationMessage .= <<<HTML
				</table>
				<h4>Payment Information</h4>
				<table class="table" cellpadding="10">
					<tr><th>Type</th><th>Qty</th><td></td><th>Price</th></tr>
					<tr><td>Comprehensive</td><td>$comprehensiveQty</td><td>x $5 =</td><td>$$comprehensivePrice</td></tr>
					<tr><td>Algebra II w/Trig</td><td>$algebraIIQty</td><td>x $5 =</td><td>$$algebraIIPrice</td></tr>
					<tr><td>Geometry</td><td>$geometryQty</td><td>x $5 =</td><td>$$geometryPrice</td></tr>
					<tr><td>School Fee</td><td>1</td><td>x $10 =</td><td>$$schoolFee</td></tr>
					<tr><th>Total</th><td></td><td></td><th>$$totalPrice</th></tr>
				</table>
HTML;

mail($mentorEmails[0], $subject, $confirmationMessage, $headers);

// Submission Page
require 'template/header.php';
echo $confirmationMessage;
echo <<<HTML
	<p class="text-center hidden-print">
		<a class="btn btn-primary btn-lg" href="index.php">Back to Form</a>
		<btn class="btn btn-primary btn-lg" onclick="window.print()">Print</btn>
	</p>
HTML;
require 'template/footer.php';

}

//If no post data, redirect to index page
else header('location: index.php');

?>
