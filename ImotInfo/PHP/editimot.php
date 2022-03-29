<?php require 'sqlconn.php'; 
	session_start();
	$name = $_POST['Imotname'];
	$cena = $_POST['cena'];
	$renta = $_POST['renta'];
	$status = $_POST['status'];
	$water = $_POST['water'];
	$cenavoda = $_POST['cenavoda'];
	$gas = $_POST['gas'];
	$cenagas = $_POST['cenagas'];
	$tok = $_POST['tok'];
	$cenatok = $_POST['cenatok'];
	$kvadratura = $_POST['kvadratura'];
	$type =$_POST['type'];

	$sqlse = "SELECT id FROM imoti WHERE name='$name'";
    $resultse = $conn->query($sqlse);

    $row = mysqli_fetch_array($resultse,MYSQLI_BOTH);

    if ($resultse->num_rows > 0) {
        $uid=$row['id'];
    }

	$sqlr = "UPDATE imoti SET name='$name', saleprice='$cena', rent='$renta', status='$status' WHERE name='$name'";
	$result = $conn->query($sqlr);

	$sqlrh = "UPDATE imot_harakter SET imottype='$type', water='$water', gas='$gas', electricity='$tok', kvadrat='$kvadratura', gasprice='$cenagas', waterprice='$cenavoda', electricityprice='$cenatok' WHERE imot_id='$uid'";
	$resulth = $conn->query($sqlrh);

	if($result and $resulth){
		header("location: index.php");		
	}
	else {
		header("location: errorpage.html");
	}

?>
