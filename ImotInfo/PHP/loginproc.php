<?php
	session_start();
	require 'sqlconn.php';

	$mail = $_POST['ename'];
	$password = $_POST['psw'];

	$sql = "SELECT * FROM users WHERE email ='$mail' and password ='$password'";
	$result = $conn->query($sql);

	$row = mysqli_fetch_array($result,MYSQLI_BOTH);
	$usdi=$row['id'];

	$sqlimo = "SELECT imoter_name FROM imoters WHERE admin_id ='$usdi'";
	$resultimo = $conn->query($sqlimo);

	$rowimo = mysqli_fetch_array($resultimo,MYSQLI_BOTH);
	
	$userImot= $rowimo['imoter_name'];

	if ($row['email']==$mail && $row['password']==$password) {

		$_SESSION['user']=$mail;
		$_SESSION['userIm']=$userImot;
		header("location: index.php");

	} 
	else {
		header("location: errorpage.html");
	}



	

?>