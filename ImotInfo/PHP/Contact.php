<?php
session_start();
require 'sqlconn.php';
require 'mailsend.php';
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
    }else header("location: login.php");

?>
<!DOCTYPE html>
<html>
<head>
<title>Контакти</title>

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

<div id="mySidenav" class="sidenav">
  <a href="index.php" id="about">Имоти</a>
  <a href="finance.php" id="blog">Финанси</a>
  <a href="market.php" id="projects">Пазар</a>
  <a href="profile.php" id="profile">Профил</a>
  <a href="Csontact.php" id="contact">Контакт</a>
</div>

<div class="container">
  <div style="text-align:center">
    <h2>Свържи се с нас</h2>
    <p>Мини при нас и ни купи кафе:</p>
  </div>
  <div class="row">
    <div class="column">
      <img src="/Pictures/img_avatar.png" style="width:100%">
    </div>
    <div class="column">
      <form action="" method="post">
        <input type="text" id="mail" name="mail" value="<?php echo $user;?>" hidden>
        <label for="fname">Потребителско име или цяло име:</label>
        <input type="text" id="name" name="name" placeholder="Username or Fullname..">
        <label for="lname">Тема:</label>
        <input type="text" id="subject" name="subject" placeholder="Subject..">
        <label for="subject">Доп. инфо</label>
        <textarea id="subject" name="problem" placeholder="Write something.." style="height:170px"></textarea>
        <input type="submit" value="Прати">
      </form>
    </div>
  </div>
</div>

</body>
</html>