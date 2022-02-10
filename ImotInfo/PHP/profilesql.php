<?php
	$mail=$_SESSION['email'];
	$sql = "SELECT * FROM users WHERE email ='$mail' ";
	$result = $conn->query($sql);

	while($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
?>