<?php 
require 'sqlconn.php'; 
    session_start();

header("Content-Type:application/json; Charset=utf-8");

$st = $pdo->prepare("SELECT saleprice, rent FROM imoti WHERE name = :name");
$st->execute(array ('name' => $_POST['name']));
$data = $st->fetch(PDO::FETCH_ASSOC);

echo json_encode(array ('saleprice' => $data ['cena'], 'rent' => $data ['renta']));