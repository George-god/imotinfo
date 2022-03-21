<?php
session_start();
require 'sqlconn.php';
    if(isset($_SESSION['user'])){
        $userImed = $_SESSION['userIm'];
    }else header("location: Login.html");

?>
<!DOCTYPE html>
<html>
<head>
<title>God</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../CSS/contact.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script type="module" src="../JS/js.cookie.mjs"></script>
<script nomodule defer src="../JS/js.cookie.js"></script>
<script src="../JS/cookie.js"></script>
</head>

<body>

<header>
    <img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="logo">
</header>

<div id="mySidenav" class="sidenav">
  <a href="index.php" id="about">Imoti</a>
  <a href="finance.php" id="blog">Finansi</a>
  <a href="market.php" id="projects">Market</a>
  <a href="profile.php" id="profile">Profile</a>
  <a href="Csontact.php" id="contact">Contact</a>
</div>

<div class="container">
  <div style="text-align:center">
    <h2>Contact Us</h2>
    <p>Swing by for a cup of coffee, or leave us a message:</p>
  </div>
  <div class="row">
    <div class="column">
      <img src="/Pictures/img_avatar.png" style="width:100%">
    </div>
    <div class="column">
      <form action="/action_page.php">
        <label for="fname">Username OR Fullname:</label>
        <input type="text" id="name" name="name" placeholder="Username or Fullname..">
        <label for="lname">Problem:</label>
        <input type="text" id="problem" name="problem" placeholder="Problem..">
        <label for="country">Country:</label>
        <select id="country" name="country">
          <option value="australia">Australia</option>
          <option value="canada">Canada</option>
          <option value="usa">USA</option>
        </select>
        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px"></textarea>
        <input type="submit" value="Submit">
      </form>
    </div>
  </div>
</div>

</body>
</html>