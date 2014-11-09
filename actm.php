<?php
// School / Test site Information
$school = filter_input(INPUT_POST, 'school', FILTER_SANITIZE_SPECIAL_CHARS);
$division = filter_input(INPUT_POST, 'selectDivision', FILTER_SANITIZE_SPECIAL_CHARS);
$testSite = filter_input(INPUT_POST, 'selectTestingSite', FILTER_SANITIZE_SPECIAL_CHARS);

// Mentors
// Mentor 1
$mentor_1 = filter_input(INPUT_POST, 'mentorname-1', FILTER_SANITIZE_SPECIAL_CHARS);
$mentorEmail_1 = filter_input(INPUT_POST, 'mentoremail-1', FILTER_SANITIZE_EMAIL);
$mentorPhone_1 = filter_input(INPUT_POST, 'mentorphone-1', FILTER_SANITIZE_NUMBER_INT);
	
// Mentor 2
$mentor_2 = filter_input(INPUT_POST, 'mentorname-1', FILTER_SANITIZE_SPECIAL_CHARS);
$mentorEmail_2 = filter_input(INPUT_POST, 'mentoremail-1', FILTER_SANITIZE_EMAIL);
$mentorPhone_2 = filter_input(INPUT_POST, 'mentorphone-1', FILTER_SANITIZE_NUMBER_INT);
	
// Mentor 3
$mentor_3 = filter_input(INPUT_POST, 'mentorname-1', FILTER_SANITIZE_SPECIAL_CHARS);
$mentorEmail_3 = filter_input(INPUT_POST, 'mentoremail-1', FILTER_SANITIZE_EMAIL);
$mentorPhone_3 = filter_input(INPUT_POST, 'mentorphone-1', FILTER_SANITIZE_NUMBER_INT);
	
// Mentor 4
$mentor_4 = filter_input(INPUT_POST, 'mentorname-1', FILTER_SANITIZE_SPECIAL_CHARS);
$mentorEmail_4 = filter_input(INPUT_POST, 'mentoremail-1', FILTER_SANITIZE_EMAIL);
$mentorPhone_4 = filter_input(INPUT_POST, 'mentorphone-1', FILTER_SANITIZE_NUMBER_INT);

// Test Purchase Information
$comprehensiveQty = filter_input(INPUT_POST, 'comprehensiveQty', FILTER_SANITIZE_NUMBER_INT);
$algebraIIQty = filter_input(INPUT_POST, 'algebraIIQty', FILTER_SANITIZE_NUMBER_INT);
$geometryQty = filter_input(INPUT_POST, 'geometryQty', FILTER_SANITIZE_NUMBER_INT);

// Pricing
$comprehensivePrice = $comprehensiveQty * 5;
$algebraIIPrice = $algebraIIQty * 5;
$geometryPrice = $geometryQty * 5;
$totalPrice = $comprehensivePrice + $algebraIIPrice + $geometryPrice;

// Email Response

$subject = "2014 Alabama Statewide High School Mathematics Contest"
$headers  = 'MIME-Version: 1.0' . "\r\n";
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

mail($mentorEmail_1, $subject, $emailResponseMessage, $headers);


// Submission Page
echo<<<HTML
	<!DOCTYPE HTML>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="AUTHOR" content="Tyler Yasaka, Victor Rogers, Ben Etheredge">
		<title>- ACTM - Thank you for registering! -</title>

		<!--Bootsrap-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<!--Latest Compiled and minified Javascript-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<!--CSS-->
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="container">
			<div id="top">
				<img id="logo" alt="Alabama Council of Teachers of Mathematics" src="logo.png">
				<h4>Thank you for your registering!</h4><br>
			
				<h4>Grand Total:$$totalPrice </h4><br>
			
				<p>Please make your check for the above amount payable to <strong>Alabama Council of Teachers of Mathematics</strong>.<br><br>
				   Mail your check to:</p>
				<p class="center">
				University of North Alabama, Dept of Mathematics<br>
				ATTN: AL HS Math Contest<br>
				One Harrison Plaza, Box 5051<br>
				Florence, AL 35632<br>
				</p>
			</div>
		</div>
	</body>
	</html>
HTML;
?>
