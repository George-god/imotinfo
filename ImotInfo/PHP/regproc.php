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

	$queryc = mysqli_query($conn, "SELECT * FROM `users` WHERE email='".$email."'");

	if(mysqli_num_rows($queryc) > 0){
    $emailErr = "Email is in use!";
	}
	elseif(!empty($pass))
	{
		$password = mysqli_real_escape_string($conn, $pass);
		$password = password_hash($password, PASSWORD_DEFAULT);

		$stmt = $conn->prepare("INSERT INTO users (password, email) VALUES (?, ?)");
		$stmt->bind_param("ss", $password, $email);

    //$sqlr = "INSERT INTO users (password , email) VALUES('$password', '$email')";
		//$result = $conn->query($sqlr);

		//if($result){
			$stmt->execute();
			$_SESSION['user']=$email;
			$stmt->close();
			header("location: login.php");
		//}
		//else {
			//header("location: errorpage.html");
		//}

	}
	else {

	 } 
  } 
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>