<?php require 'sqlconn.php'; 
	session_start();

	if (isset($_POST['formmsub'])) {
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$mail = $_POST['mail'];
		$post = $_POST['pnumber'];
		$imotrad = $_POST['radioI'];


		$sqlr = "UPDATE users SET first_name='$fname', last_name='$lname', town_code='$post', email='$mail', imoter='$imotrad' WHERE email='$mail'";
		$result = $conn->query($sqlr);

		if($result){
			$_SESSION['user']=$mail;
			echo '<script>alert("Changes were saved!")</script>';
			header("location: profile.php");		
		}
		else {
			header("location: errorpage.html");
		}
	}

	if (isset($_POST['hidsub'])) {
		$uname = $_POST['username'];
		$phun = $_POST['phone'];
		$mail = $_SESSION['user'];

		$sqlse = "SELECT id FROM users WHERE email='$mail'";
		$resultse = $conn->query($sqlse);

		$row = mysqli_fetch_array($resultse,MYSQLI_BOTH);

		if ($resultse->num_rows > 0) {
  			$uid=$row['id'];
  		}

  		$sqlrU = "UPDATE imoters SET imoter_name='$uname', PhoneNumber='$phun' WHERE admin_id='$uid' ";
		$resultU = $conn->query($sqlrU);

		if($resultU){
			echo '<script>alert("Changes were saved!")</script>';
			header("location: profile.php");		
		}
		else {
			header("location: errorpage.html");
		}
	}

	

?>
