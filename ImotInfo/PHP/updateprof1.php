<?php require 'sqlconn.php'; 
	
	$update = $conn->prepare("UPDATE users SET first_name=?, last_name=?, town_code=?, email=?, imoter=? WHERE email=?");
	if ($update === false) {
  		trigger_error($conn->mysqli->error, E_USER_ERROR);
  		return;
	}
	$mail = $_POST['mail'];
	$fname = $_POST['firstname'];
	$lname = $_POST['lastname'];
	$post = $_POST['pnumber'];
	$imotrad = $_POST['radioI'];


	$update->bind_param("ssisis",$fname,$lname,$post,$mail,$imotrad,$mail);
	$status=$update->execute();

	if ($status === false) {
  		trigger_error($stmt->error, E_USER_ERROR);
  		header("location: errorpage.html");
	}
	else {
		$_SESSION['user']=$mail;
		echo '<script>alert("Changes were saved!")</script>';
		header("location: profile.php");
	}

?>
