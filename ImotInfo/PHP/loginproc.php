<?php
	require 'sqlconn.php';

   			if(empty($_POST["ename"]) || empty($_POST["psw"]))  
      		{    
      		}  
      		else  
      		{  
           		$username = mysqli_real_escape_string($conn, $_POST["ename"]);  
           		$password = mysqli_real_escape_string($conn, $_POST["psw"]);  
           		$query = "SELECT * FROM users WHERE email = '$username'";  
           		$result = mysqli_query($conn, $query);  
           	if(mysqli_num_rows($result) > 0)  
           	{  
                while($row = mysqli_fetch_array($result))  
                {              
                     if(password_verify($password, $row["password"]))  
                     {  
                     	session_start(); 
                          $_SESSION['user'] = $username;
                          $usdi=$row['id'];
                          $sqlimo = "SELECT imoter_name FROM imoters WHERE admin_id ='$usdi'";
						  $resultimo = mysqli_query($conn, $sqlimo);

						  if(mysqli_num_rows($resultimo) > 0){
						  	$rowimo = mysqli_fetch_array($resultimo,MYSQLI_BOTH);
						  	$userImot= $rowimo['imoter_name'];
						  	$_SESSION['userIm']=$userImot;				
						  	header("location: index.php");
						  }
						  else {
						  	header("location: index.php");
						  }  
                     }  
                     else  
                     {    
                          echo '<script>alert("Wrong User Pass")</script>';   
                     }  
                }  
           	}  
           	else  
           	{  
                echo '<script>alert("Wrong User Email maybe")</script>';  
           	}  
      	}  
 
?>