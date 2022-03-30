<?php
session_start();
require 'sqlconn.php';



unset($_SESSION['user']);
unset($_SESSION['userIm']);
header("location: login.php");


?>