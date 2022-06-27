<?php 
session_start();
require 'sqlconn.php'; 
	
	$imotname = $_POST['removimo'];

	$sqls = "SELECT id FROM imoti WHERE name='$imotname'";
	$results = $conn->query($sqls);

	$row = mysqli_fetch_array($results,MYSQLI_BOTH);

	if ($results->num_rows > 0) {

  		$imid=$row['id'];
  	}

  	$sqlse = "DELETE FROM cena_history WHERE imot_id='$imid' ";
	$resultse = $conn->query($sqlse);

  	$sqlse = "DELETE FROM imot_harakter WHERE imot_id='$imid' ";
	$resultse = $conn->query($sqlse);

	$sqlse = "DELETE FROM imoti WHERE name='$imotname' ";
	$resultse = $conn->query($sqlse);

	



	if($resultse){
		$_SESSION['message'] = "Imot was Deleted";
		header("location: index.php");
	}
	else {
		header("location: errorpage.html");

	}

?>