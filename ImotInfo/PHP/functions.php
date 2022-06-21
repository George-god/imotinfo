<?php
require 'sqlconn.php';

function logout() {


  unset($_SESSION['user']);
  unset($_SESSION['userIm']);
  header("location: login.php");
}
?>