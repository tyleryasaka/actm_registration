<?php
$servername = "localhost";
$username = "actm";
$password = "4034df8b";
$conn = mysqli_connect($servername, $username, $password);
mysqli_select_db($conn,'actm');
$search = $_GET['query'];
$query = "SELECT name, address_street AS 'street', address_city AS 'city',
			address_state AS 'state', address_zip AS 'zip' FROM schools 
			WHERE name LIKE '%{$search}%'";
$result = mysqli_query($conn,$query);
$schools = [];
while($school = mysqli_fetch_assoc($result))
	$schools[] = $school;
echo json_encode($schools);
?>
