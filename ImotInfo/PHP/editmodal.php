<?php require 'sqlconn.php'; 
    session_start();

header("Content-Type:application/json; Charset=utf-8");

// As you can see, here you will have where Employee_ID = :employee_id, this will be
// automatically replaced by the PDO object with the data sent in execute(array('employee_id' => $_POST['Employee_ID']))
// This is a good practice to avoid SqlInyection attacks
$st = $pdo->prepare("SELECT saleprice, rent FROM imoti WHERE name = :name");
$st->execute(array ('name' => $_POST['name']));
$data = $st->fetch(PDO::FETCH_ASSOC);

echo json_encode(array ('saleprice' => $data ['cena'], 'rent' => $data ['renta']));