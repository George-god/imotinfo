<?php

	$mail = $_POST['email'];
	$pass = $_POST['psw'];
	$time = $_SERVER['REQUEST_TIME'];

	//Connect to server and select database
	$userS = 'NGoshko';
	$passwordS = 'Goshko993';
	$server = 'localhost';
	$database = 'imotdata';
	$conn = mysqli_connect($server, $userS, $passwordS, $database);

	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";

	$sqlr = "INSERT INTO users (password , email) VALUES('$pass', '$mail')";
	$result = $conn->query($sqlr);

	if($result){
		$_SESSION['message'] = "You are now a member of the ImotInfo";
		$_SESSION['user']=$mail;
		header("location: index.php");
	}
	else {
		header("location: errorpage.html");
	}

?>