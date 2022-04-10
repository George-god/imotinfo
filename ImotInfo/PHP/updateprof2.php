<?php require 'sqlconn.php'; 
	session_start();
	

	$selector = $conn->prepare("SELECT id,town_code FROM users WHERE email=?");

	$mail = $_SESSION['user'];
	$selector->bind_param("s",$mail);

	$selector->execute();

	$result=$selector->get_result();
			if($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$id=$row['id'];
					$town=$row['town_code'];
					$selector->close();
				}
			}else { 
				$selector->close();
				header("location: errorpage.html"); 
			}


	$insertor = $conn->prepare("INSERT INTO imoters SET id=?, town_code=?, imoter_name=?, admin_id=?, PhoneNumber=? ");

	$uname = $_POST['username'];
	$phun = $_POST['phone'];
	$idgen = rand(1,999)."$id";

	$insertor->bind_param("ddsds",$idgen,$town,$uname,$id,$phun);
	$status=$insertor->execute();

	if ($status === false) {
  			trigger_error($insertor->error, E_USER_ERROR);
  			$insertor->close();
  			header("location: errorpage.html");

		}
		else {
			$_SESSION['userIm']=$uname;
			$insertor->close();
			header("location: profile.php");
		}

?>
