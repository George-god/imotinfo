<?php
	session_start();
	//Get values from form in login.php file
	$mail = $_POST['ename'];
	$password = $_POST['psw'];


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

	$sql = "SELECT * FROM users WHERE email ='$mail' and password ='$password'";
	$result = $conn->query($sql);

	$row = mysqli_fetch_array($result,MYSQLI_BOTH);
	$usdi=$row['id'];

	$sqlimo = "SELECT imoter_name FROM imoters WHERE admin_id ='$usdi'";
	$resultimo = $conn->query($sqlimo);

	$rowimo = mysqli_fetch_array($resultimo,MYSQLI_BOTH);
	
	$userImot= $rowimo['imoter_name'];

	if ($row['email']==$mail && $row['password']==$password) {
		echo "Login success! Welcome ".$row['Email'];
		$_SESSION['user']=$mail;
		$_SESSION['userIm']=$userImot;
		header("location: index.php");
	} else {
		echo "Failed to login!";
	}



	

?>