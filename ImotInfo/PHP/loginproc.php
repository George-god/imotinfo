<?php
	require 'sqlconn.php';

   			if(empty($_POST["ename"]) || empty($_POST["psw"]))  
      		{
      			    
      		}  
      		else  
      		{  
           		$username = mysqli_real_escape_string($conn, $_POST["ename"]);  
           		$password = mysqli_real_escape_string($conn, $_POST["psw"]); 


           		$checkpass = $conn->prepare("SELECT password,id FROM users WHERE email=?");
				$checkpass->bind_param("s", $username);
				$checkpass->execute();

				//get and check result
				$checkpass->bind_result($getpass,$idr);
				$checkpass->fetch();
				if (!password_verify($password, $getpass)) {
    					echo '<script>alert("Wrong User Pass")</script>'; 
    					return false;
    					exit;
				}
				else {
					session_start(); 
					$_SESSION['user'] = $username;
					$id = $idr;
					$checkpass->close();
					$checkimot = $conn->prepare("SELECT imoter_name FROM imoters WHERE admin_id=?");
					$checkimot->bind_param("i", $id);
					$checkimot->execute();

					$result=$checkimot->get_result();
					if($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$_SESSION['userIm']=$row['imoter_name'];
							header("location: index.php");
							$checkimot->close();
						}
					}else { 
						$checkimot->close();
						header("location: profile.php"); 
					}

					$conn->close();
				} 
      	}  
 
?>