<?php 
session_start();
require 'sqlconn.php'; 
	
	$imotname = $_POST['Imotname'];
	$imotcena = $_POST['cena'];
	$userIm = $_SESSION['userIm'];
	$imotrenta = $_POST['renta'];
	$imotstatus = $_POST['status'];


	$idyear = date("y");
	$idday = date("d");
	$idmont = date("m");
	$idgen = $idday.rand(1,9).$idmont.$idyear.rand(1,9);
	$idhargen = rand(1,9).rand(13,96);

	$sqlse = "SELECT id FROM imoters WHERE imoter_name='$userIm'";
	$resultse = $conn->query($sqlse);

	$row = mysqli_fetch_array($resultse,MYSQLI_BOTH);

	if ($resultse->num_rows > 0) {

  		$imid=$row['id'];
  	}


	$sqlr = "INSERT INTO imoti (id , name, imoter_id, saleprice, rent, status) VALUES('$idgen', '$imotname','$imid','$imotcena','$imotrenta','$imotstatus')";
	$result = $conn->query($sqlr);

	$sqlrhar = "INSERT INTO imot_harakter (harakter_id , imot_id) VALUES('$idhargen', '$idgen')";
	$resulthar = $conn->query($sqlrhar);

	if($result and $resulthar){
		header("location: index.php");
	}
	else {
		header("location: errorpage.html");
	}

?>