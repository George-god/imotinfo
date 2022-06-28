<?php
session_start();
require 'sqlconn.php';
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        if(isset($_SESSION['userIm'])){
            $userImd = $_SESSION['userIm'];
        }else header("location: profile.php");
 
    }else {
        header("location: login.php");
    }

?>
<!DOCTYPE html>
<html>
<head>
<title>Имоти</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../CSS/MainS.css">
<link rel="icon" type="image/x-icon" href="../Picures/favicon.ico">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="module" src="../JS/js.cookie.mjs"></script>
<script nomodule defer src="../JS/js.cookie.js"></script>
<script src="../JS/menu.js"></script>
<script src="../JS/modal.js"></script>
<script src="../JS/modal2.js"></script>
<script src="../JS/modal3.js"></script>
<script src="../JS/cookie.js"></script>
<script src="../JS/MSEdit.js"></script>
<script src="../JS/indexmarketscroll.js"></script>
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

<div id="imotside" class="sidenavimot">
  <a href="#" id="addn">Добави Имот</a>
  <a href="#" id="editn" onclick="editimot1()">Редак. Имот</a>
  <a href="#" id="deleten" onclick="remimot1()">Изтрий Имот</a>
</div>


<div class="MainI">
<h2 class="wordCarousel">
    <span><b>Това са вашите:<b></span>
    <div>
        <!-- Use classes 2,3, or 4 to match the number of words -->
        <ul class="flip4">
            <li>Имоти</li>
            <li>Магазини</li>
            <li>Хотели</li>
            <li>Земи</li>
        </ul>
    </div>

</h2>
    <div class="LeftCol">
    <?php
    $sqlse = "SELECT id FROM imoters WHERE imoter_name='$userImd'";
    $resultse = $conn->query($sqlse);

    $row = mysqli_fetch_array($resultse,MYSQLI_BOTH);

    if ($resultse->num_rows > 0) {
        $uid=$row['id'];
    }
     $statem = "SELECT * FROM imoti WHERE imoter_id= '$uid' ";
     $resultc = $conn -> query($statem);
     

     while ($row = $resultc->fetch_assoc()) {
        $imotid=$row['id'];
    ?>  
        <div class="icard" id="edit">

            <?php 
                $stpic = "SELECT imot_harakter.imottype,imottype.typeid,imottype.icon,imottype.type,imot_harakter.srok_dogovor From imottype INNER JOIN imot_harakter on imot_harakter.imottype = imottype.typeid WHERE imot_id='$imotid' ";
                $respic = $conn -> query($stpic);
                $rowpic = mysqli_fetch_array($respic,MYSQLI_BOTH);

                $date1 = date("Y-m-d");
                $nowdate = new Datetime($date1);
                $expdate = new Datetime($rowpic['srok_dogovor']);
                $close = date_diff($nowdate,$expdate);

            ?>

            <?php 
                if($close->format("%R%a") > 15) {
                 echo "<div style='color:black;' class='warning' ><span class='warningtext' >Далече</span>&#9888;</div> " ;
                }
                elseif($close->format("%R%a") < 0) {
                 echo "<div style='color:black;' class='warning' ><span class='warningtext'>Няма</span>&#9888;</div>";
                }
                elseif($close->format("%R%a") == 0) {
                 echo "<div style='color:red;' class='warning' ><span class='warningtext' >Край</span>&#9888;</div>";
                }
                elseif($close->format("%R%a") < 15) {
                 echo "<div style='color:orange;' class='warning' ><span class='warningtext'>Наближава</span>&#9888;</div>";
                } ?>
            <img src="../Pictures/<?php echo $rowpic['icon'] ?>" alt="Avatar" style="width:100%" id="iimg">
            <div class="icontainer">
                <form method="post" action="viewimto.php">
                    <label class="cenlab uno"><?php echo 'Име:'.$row['name'] ?> </label><br>
                    <input type="hidden" name="imotnamecard" value="<?php echo $row['name'] ?>">
                    <label class="cenlab dos"><?php echo 'Статус:'.$row['status'] ?></label><br>
                    <label class="cenlab tres"><?php echo 'Тип:'.$rowpic['type'] ?></label><br>
                    
                    <input type="submit" value="Разгледай" id="viewbtn" onclick="">
                </form>
            </div>
        </div>        
    <?php
    }
    ?>

    </div>


    
                <div id="myModal" class="modal">

            <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close">&times;</span>
                            <h2>Нов имот</h2>
                        </div>
                        <div class="modal-body">
                            <form action="addimot.php" method="post">
                                <label for="Imotname">Име на Имота:</label>
                                <input type="text" id="Imotname" name="Imotname" class="inptextmod1" placeholder="Име.." maxlength="50">

                                <label for="cena">Цена на Имота:</label>
                                <input type="number" id="cena" name="cena" class="inptextmod1" placeholder="Цена.." maxlength="11">

                                <label for="renta">Рента на Имота:</label>
                                <input type="number" id="renta" name="renta" class="inptextmod1" placeholder="Рента.." maxlength="5">

                                <label for="status">Статус:</label>
                                <select id="status" name="status" class="inptextmod1">
                                    <option disabled selected>-- Избери статус --</option>
                                    <option value="rented">Под наем</option>
                                    <option value="not_rented">Не под наем</option>
                                    <option value="for_sale">За продажба</option>
                                </select>

                                <input type="submit" value="Добави" class="inpsubmod1">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <h3>Imot Info</h3>
                            <p>This website is made by Georgi Pavlov. Please, if you are thinking of stealing it then don't!</p>
                        </div>
                    </div>

                </div>

                <div id="myModal2" class="modal two">

                    <div class="modal-content" id="editmod">
                        <div class="modal-header">
                            <span class="close dre" onclick="editimot2()">&times;</span>
                            <h2>Редактиране на имот</h2>
                        </div>
                        <div class="modal-body">
                            <form action="imoteditform.php" id="cform" method="post">
                                <label for="selectimo">Кой имот искате на редактирате:</label>
                                <select id="selectimo" name="selectimo" class="inptextmod1">
                                    <option disabled selected>-- Изберете Имот --</option>
                                    <?php
                                        $userImed = $_SESSION['userIm'];
                                        $sqlse = "SELECT id FROM imoters WHERE imoter_name='$userImed'";
                                        $resultse = $conn->query($sqlse);
                                        $rowe = mysqli_fetch_array($resultse,MYSQLI_BOTH);
                                        $imdie = $rowe['id'];                
                                        $sql = mysqli_query($conn, "SELECT * From imoti WHERE imoter_id=$imdie");
                                        $row = mysqli_num_rows($sql);
                                        while ($row = mysqli_fetch_array($sql)){
                                            echo "<option value=\"".$row['name']."\" data-json='" . json_encode($row) . "'>" .$row['name'] ."</option>" ;
                                        }
                                    ?>
                                </select>
                                <input type="submit" value="Редактиране" class="inpsubmod1">
                            </form>
                        </div>
                    </div>
                </div>

                <div id="myModal3" class="modal three">

                    <div class="modal-content">
                        <div class="modal-header" id="moddelhead">
                            <span class="close dre" onclick="remimot2()">&times;</span>
                            <h2>Изтрий Имот</h2>
                        </div>
                        <div class="modal-body">
                            <form action="deleteimot.php" method="post">
                                <label for="removimo">Кой Имот искате да изтрийте:</label>
                                <select id="removimo" name="removimo" class="inptextmod1">
                                    <option disabled selected>-- Изберете Имот --</option>
                                    <?php
                                        $userIm = $_SESSION['userIm'];
                                        $sqlse = "SELECT id FROM imoters WHERE imoter_name='$userIm'";
                                        $resultse = $conn->query($sqlse);
                                        $rowe = mysqli_fetch_array($resultse,MYSQLI_BOTH);
                                        $imdi = $rowe['id'];                
                                        $sql = mysqli_query($conn, "SELECT name From imoti WHERE imoter_id=$imdi");
                                        $row = mysqli_num_rows($sql);
                                        while ($row = mysqli_fetch_array($sql)){
                                        echo "<option value='". $row['name'] ."'>" .$row['name'] ."</option>" ;
                                        }
                                    ?>
                                </select>
                                <input type="submit" value="Delete" class="delimot">
                            </form>
                        </div>
                    </div>

                </div>


    <h2>ПОСЛЕДНИ ДОБАВКИ В ПАЗАРА</h2>

    <div class="RightCol">
        <?php
        $statemark = "SELECT * FROM imoti,imot_harakter LEFT JOIN imottype ON imot_harakter.imottype=imottype.typeid WHERE imot_harakter.imot_id=imoti.id AND status='for_sale' LIMIT 5";
        $resultmark = $conn -> query($statemark);
        while ($rowmark = $resultmark->fetch_assoc()) {
        ?>  
            <div class="ad">
                <p>Име:<?php echo $rowmark['name'];?></p><br>
                <p>
                  Цена: <?php echo $rowmark['saleprice'];?> € Тип: <?php echo $rowmark['type'];?>
                </p>
            </div>
                
        <?php
        }
        ?>
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