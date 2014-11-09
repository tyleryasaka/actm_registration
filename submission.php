<?php

//Make sure there is post data
if(isset($_POST['school'])){

// School / Test site Information
$school = filter_input(INPUT_POST, 'school', FILTER_SANITIZE_SPECIAL_CHARS);
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
$emailResponseMessage = <<<HTML
	<!DOCTYPE HTML>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="AUTHOR" content="Tyler Yasaka, Victor Rogers, Ben Etheredge">

	</head>
	<body>
		<p>Thank you for your registering!</p>
		<p>Grand Total:$$totalPrice</p>
		<p>Please make your check for the above amount payable to <strong>Alabama Council of Teachers of Mathematics</strong>.<br><br>
		   Mail your check to:</p>
		<p>
		University of North Alabama, Dept of Mathematics<br>
		ATTN: AL HS Math Contest<br>
		One Harrison Plaza, Box 5051<br>
		Florence, AL 35632<br>
		</p>
	</body>
	</html>
HTML;

mail($mentorEmails[0], $subject, $emailResponseMessage, $headers);

// Submission Page
require 'template/header.php';
echo<<<HTML
				<h2>Thank you for your registering!</h2>
			
				<h4>Grand Total: $$totalPrice </h4>
			
				<p>Please make your check for the above amount payable to <strong>Alabama Council of Teachers of Mathematics</strong>.<br><br>
				   Mail your check to:</p>
				<p class="text-center">
				University of North Alabama, Dept of Mathematics<br>
				ATTN: AL HS Math Contest<br>
				One Harrison Plaza, Box 5051<br>
				Florence, AL 35632<br>
				</p>
HTML;
require 'template/footer.php';

}

//If no post data, redirect to index page
else header('location: index.php');

?>
