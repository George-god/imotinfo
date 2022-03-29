<?php
	require 'sqlconn.php';

	$mail = $_POST['email'];
	$pass = $_POST['psw'];
	
	$sqlcheck = "SELECT 1 FROM users WHERE email = '$mail' ";
	$resultcheck = $conn->query($sqlcheck);

	if($resultcheck){
		header("location: errorpagemail.html");
	}
	else {
		
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
	}

	

?>