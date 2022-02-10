<?php require 'sqlconn.php'; 
	session_start();
	$uname = $_POST['username'];
	$phun = $_POST['phone'];
	$mail = $_SESSION['user'];
	$idgen = rand(1,25).rand(50,150);

	$sqlse = "SELECT id,town_code FROM users WHERE email='$mail'";
	$resultse = $conn->query($sqlse);

	$row = mysqli_fetch_array($resultse,MYSQLI_BOTH);

	if ($resultse->num_rows > 0) {

  		$postu=$row['town_code'];
  		$uid=$row['id'];

  	}

	$sqlr = "INSERT INTO imoters SET id='$idgen', town_code='$postu', imoter_name='$uname', admin_id='$uid', PhoneNumber='$phun' ";
	$result = $conn->query($sqlr);

	if($result){
		$_SESSION['userIm']=$uname;
		echo '<script>alert("Changes were saved!")</script>';
		session_unset();
		header("location: Login.html");		
	}
	else {
		echo 'Welp. Something didnt happend';
	}

?>
