<?php
session_start();
require 'sqlconn.php';
    if(isset($_SESSION['user'])){
 
    }else header("location: login.php");

?>
<!DOCTYPE html>
<html>
<head>
<title>Пазар</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../CSS/market.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="module" src="../JS/js.cookie.mjs"></script>
<script nomodule defer src="../JS/js.cookie.js"></script>
<script src="../JS/menu.js"></script>
<script src="../JS/cookie.js"></script>
<script src="../JS/chekbox.js"></script>
<script src="../JS/otherscript.js"></script>
</head>

<body onload="">
    
<header>
    <img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="logo">
</header>
 

<div id="mySidenav" class="sidenav">
  <a href="index.php" id="about">Имоти</a>
  <a href="finance.php" id="blog">Финанси</a>
  <a href="market.php" id="projects">Пазар</a>
  <a href="profile.php" id="profile">Профил</a>
  <a href="Contact.php" id="contact">Докладвай</a>
</div>


<div class="MainI">

<h2>Добре дошли в Пазара</h2>
 
    <div class="LeftCol">
    <?php
        $userImd = $_SESSION['userIm'];       
        $statem = "SELECT * FROM imoti,imot_harakter LEFT JOIN imottype ON imot_harakter.imottype=imottype.typeid WHERE imot_harakter.imot_id=imoti.id ";
        $resultc = $conn -> query($statem);
     

     while ($row = $resultc->fetch_assoc()) {
       $id=$row['imoter_id'];
    ?>  
        <div class="icard" id="edit">
            <span title="REPORT"><a href="Contact.php">&#9872;</a></span>
            <div class="icontainer">

            <img src="../Pictures/<?php echo $row['icon'] ?>" alt="Avatar" style="width:50%" id="iimg"><br>
            <?php
                $staten = "SELECT imoter_name FROM imoters WHERE id='$id' ";
                $resultn = $conn -> query($staten);
                while ($rown = $resultn->fetch_assoc()) {
            ?>
            <label>Име на Държател:</label><label><?php echo $rown['imoter_name']?></label><br>
            <?php } ?>
            </div>
            <div class="icontainer">
                <label>Име на имота:</label><label><?php echo $row['name']?></label><br>
                <label>Цена:</label><label><?php echo $row['saleprice']?>€</label><br>
                <label>Рента:</label><label><?php echo $row['rent']?>€</label><br>
                <label>Статус:</label><label><?php echo $row['status']?></label><br>
                <label>Тип:</label><label><?php echo $row['type']?></label><br>
            </div>
            <div class="icontainer">
                <label>Квадратура:</label><label><?php echo $row['kvadrat']?> ㎡</label><br>
                <label>Вода:</label><label>
                    <?php 
                        if($row['water']=="1"){echo '<img src="../Pictures/check.png">';  }
                        else {echo '<img src="../Pictures/remove.png">'; }
                    ?> 
                    </label><br>

                <label>Ток:</label><label>
                    <?php 
                        if($row['electricity']=="1"){echo '<img src="../Pictures/check.png">';  }
                        else {echo '<img src="../Pictures/remove.png">'; }
                    ?> 
                </label><br>

                <label>Газ:</label><label>
                    <?php 
                        if($row['gas']=="1"){echo '<img src="../Pictures/check.png">';  }
                        else {echo '<img src="../Pictures/remove.png">'; }
                    ?> 
                </label><br>
                <?php
                $statet = "SELECT PhoneNumber FROM imoters WHERE id='$id' ";
                $resultt = $conn -> query($statet);
                while ($rowt = $resultt->fetch_assoc()) {
                ?>

                <label>Тел за връзка:</label><label><?php echo $rowt['PhoneNumber']?></label>
                <?php } ?>
            </div>
        </div>        
    <?php
    }
    ?> 
    </div>
         
    <div class="RightCol">
        <button class="open-button" onclick="openForm()">Филтър</button>
        <div class="form-popup" id="myForm">
            <form method="post" action="market2.php" class="form-container">

                <label for="timot">Тип на Имота:</label><br>
                <select id="type" name="type" class="inptextmod1">
                        <?php
                            $sqlt = mysqli_query($conn, "SELECT * From imottype");
                            $rowt = mysqli_num_rows($sqlt);
                            while ($rowt = mysqli_fetch_array($sqlt)){
                            echo "<option value='". $rowt['typeid'] ."'>" .$rowt['type'] ."</option>" ;
                            }
                        ?>
                    </select><br>
                <label for="price">Желана цена:</label><br>
                    <input type="range" id="price" name="price" min="0" max="100000000" oninput="this.nextElementSibling.value = this.value">
                    <output>50000000</output><br>
                <label for="neses">Искате ли от тези?</label><br>
                <input type="checkbox" id="Tok" name="Tok" value="1">
                <input type="hidden" id="Tokhidden" name="Tok" value="0">
                <label for="Tok"> Ток</label><br>
                <input type="checkbox" id="Gas" name="Gas" value="1">
                <input type="hidden" id="Gashidden" name="Gas" value="0">
                <label for="Gas"> Газ</label><br>
                <input type="checkbox" id="voda" name="voda" value="1">
                <input type="hidden" id="vodahidden" name="voda" value="0">
                <label for="voda"> Вода</label><br>

                

                <input type="submit" value="Филтър" class="btn">
                <button type="button" class="btn cancel" onclick="closeForm()">Затвори</button>
            </form>

            
        </div>
        <br>

    </div>

   

</div>


    
    
    
    
    <footer>
         <div class=’cookie-banner’ style=’display: none’>
            <p>
            By using our website, you agree to our 
            <a href=’insert-link’>cookie policy</a>
            </p>
        </div>
        <p>This website is made by Georgi Pavlov. Please, if you are thinking of stealing it then don't!</p>
        
    </footer>    
          
</body>
</html>