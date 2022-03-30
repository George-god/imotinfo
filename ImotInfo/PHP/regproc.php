<?php
	require 'sqlconn.php';

	//$data = $_POST;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if ($_POST['psw'] !== $_POST['psw-repeat']) {
   		$passErr = "Password is not matching!";  
   } else {
   		$passErr = test_input($_POST["psw"]);
   } 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

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
			$_SESSION['user']=$mail;
			header("location: index.php");
		}
		else {
			header("location: errorpage.html");
		}
	}

	

?>