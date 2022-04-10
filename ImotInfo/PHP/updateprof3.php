<?php require 'sqlconn.php'; 
	session_start();

	if (isset($_POST['formmsub'])) {
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
  			trigger_error($update->error, E_USER_ERROR);
  			$update->close();
  			header("location: errorpage.html");

		}
		else {
			$_SESSION['user']=$mail;
			$update->close();
			header("location: profile.php");
		}
	}

	if (isset($_POST['hidsub'])) {

		

		$idselect = $conn->prepare("SELECT id FROM users WHERE email=?");

		$mail = $_SESSION['user'];
		$idselect->bind_param("s",$mail);

		$idselect->execute();

		$result=$idselect->get_result();
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$id=$row['id'];
					$idselect->close();
				}
			}else { 
				$idselect->close();
				header("location: errorpage.html"); 
			}

		$updatei = $conn->prepare("UPDATE imoters SET imoter_name=?, PhoneNumber=? WHERE admin_id=? ");

		$uname = $_POST['username'];
		$phun = $_POST['phone'];

		$updatei->bind_param("ssd",$uname,$phun,$id);

		$statusi=$updatei->execute();

		if ($statusi === false) {
  			trigger_error($updatei->error, E_USER_ERROR);
  			$updatei->close();
  			header("location: errorpage.html");

		}
		else {
			$_SESSION['userIm']=$uname;
			$updatei->close();
			header("location: profile.php");
		}

	}

	

?>
