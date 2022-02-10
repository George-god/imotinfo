<?php
//Connect to server and select database
	$userS = 'NGoshko';
	$passwordS = 'Goshko993';
	$server = 'localhost';
	$database = 'imotdata';


	$conn = mysqli_connect($server, $userS, $passwordS, $database);
	if (!$conn) {
    die("" . mysqli_connect_error());
	}
	echo "";

?>