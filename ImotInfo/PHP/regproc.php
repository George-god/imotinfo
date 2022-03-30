<?php
	require 'sqlconn.php';

	//$data = $_POST;
	$emailErr = $passErr = "";

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
   		$pass = $_POST["psw"];
   }

   if (isset($_POST['singup'])) {
    //$mail = $_POST['email'];
	//$pass = $_POST['psw'];

	$queryc = mysqli_query($conn, "SELECT * FROM `users` WHERE email='".$email."'");

	if(mysqli_num_rows($queryc) > 0){
    $emailErr = "Email is in use!";
	}
	elseif(!empty($pass))
	{
		$password = mysqli_real_escape_string($conn, $pass);
		$password = password_hash($password, PASSWORD_DEFAULT);
    	$sqlr = "INSERT INTO users (password , email) VALUES('$password', '$email')";
		$result = $conn->query($sqlr);

		if($result){
			$_SESSION['user']=$email;
			header("location: index.php");
		}
		else {
			header("location: errorpage.html");
		}

	}
	else {}

	
	//$sqlcheck = "SELECT COUNT(*) FROM users WHERE email = '$email' ";
	//$resultcheck = $conn->query($sqlcheck);

	//if($resultcheck->fetchColumn() > 0){

		//$emailErr = "Email is in use!";
	//}
	//else {
		
		
	//} 
  } 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>