<?php require 'sqlconn.php'; 
	
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$mail = $_POST['mail'];
	$post = $_POST['pnumber'];
	$imotrad = $_POST['radioI'];


	$sqlr = "UPDATE users SET first_name='$fname', last_name='$lname', town_code='$post', email='$mail', imoter='$imotrad' WHERE email='$mail'";
	$result = $conn->query($sqlr);

	if($result){
		$_SESSION['message'] = "You are now a member of the ImotInfo";
		$_SESSION['user']=$mail;
		echo '<script>alert("Changes were saved!")</script>';
		session_unset();
		header("location: Login.html");		
	}
	else {
		echo 'Welp. Something didnt happend';
		header("location: index.php");
	}

?>
