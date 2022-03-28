<?php
session_start();
require 'sqlconn.php';
    if(isset($_SESSION['user'])){
 
    }else header("location: Login.html");

    if(isset($_SESSION['userIm'])){

    }else header("location: market.php");


?>
<!DOCTYPE html>
<html>
<head>
<title>God</title>

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
<!-- <script src="../JS/msaved.js"></script> -->
</head>

<body onload="">
    
<header>
    <img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="logo">
</header>
 

<div id="mySidenav" class="sidenav">
  <a href="index.php" id="about">Imoti</a>
  <a href="finance.php" id="blog">Finansi</a>
  <a href="market.php" id="projects">Market</a>
  <a href="profile.php" id="profile">Profile</a>
  <a href="Contact.php" id="contact">Contact</a>
</div>

<div id="imotside" class="sidenavimot">
  <a href="#" id="addn">AddImot</a>
  <a href="#" id="editn" onclick="editimot1()">EditImot</a>
  <a href="#" id="deleten" onclick="remimot1()">Delete Imot</a>
</div>


<div class="MainI">
<h1>Здравейте 
<?php 
    if(isset($_SESSION['userIm'])){
        echo $_SESSION['userIm']; 
    }else {echo $_SESSION['user'];}
?>
<h2>Това са вашите имоти</h2>
    <div class="LeftCol">
    <?php
    $userImd = $_SESSION['userIm'];
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
                $stpic = "SELECT imot_harakter.imottype,imottype.typeid,imottype.icon,imottype.type From imottype INNER JOIN imot_harakter on imot_harakter.imottype = imottype.typeid WHERE imot_id='$imotid' ";
                $respic = $conn -> query($stpic);
                $rowpic = mysqli_fetch_array($respic,MYSQLI_BOTH);
            ?>

            <img src="../Pictures/<?php echo $rowpic['icon'] ?>" alt="Avatar" style="width:100%" id="iimg">
            <div class="icontainer">
                <form method="post" action="viewimto.php">
                    <label class="cenlab uno"><?php echo $row['name'] ?> </label><br>
                    <input type="hidden" name="imotnamecard" value="<?php echo $row['name'] ?>">
                    <label class="cenlab dos"><?php echo $row['status'] ?></label><br>
                    <label class="cenlab tres"><?php echo $rowpic['type'] ?></label><br>
                    
                    <input type="submit" value="View" id="viewbtn" onclick="">
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
                            <h2>New Imot</h2>
                        </div>
                        <div class="modal-body">
                            <form action="addimot.php" method="post">
                                <label for="Imotname">Name for Imot:</label>
                                <input type="text" id="Imotname" name="Imotname" class="inptextmod1" placeholder="The name..">

                                <label for="cena">Price for Imot:</label>
                                <input type="number" id="cena" name="cena" class="inptextmod1" placeholder="Zadai cenata..">

                                <label for="renta">Rent for Imot:</label>
                                <input type="number" id="renta" name="renta" class="inptextmod1" placeholder="Zadai rentata..">

                                <label for="status">Status:</label>
                                <select id="status" name="status" class="inptextmod1">
                                    <option value="rented">rented</option>
                                    <option value="not_rented">not_rented</option>
                                    <option value="for_sale">for_sale</option>
                                </select>

                                <input type="submit" value="Submit" class="inpsubmod1">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <h3>Imot Info</h3>
                            <p>This website is made by Georgi Pavlov. Please, if you are thinking of stealing it then don't!</p>
                        </div>
                    </div>

                </div>

                <div id="myModal2" class="modal two">

                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close dre" onclick="editimot2()">&times;</span>
                            <h2>Edit the Imot</h2>
                        </div>
                        <div class="modal-body">
                            <form action="imoteditform.php" id="cform" method="post">
                                <label for="selectimo">Which Imot do you want to edit:</label>
                                <select id="selectimo" name="selectimo" class="inptextmod1">
                                    <option disabled selected>-- Select Imot --</option>
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
                                <input type="submit" value="Submit" class="inpsubmod1">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <h3>Imot Info</h3>
                            <p>This website is made by Georgi Pavlov. Please, if you are thinking of stealing it then don't!</p>
                        </div>
                    </div>

                </div>

                <div id="myModal3" class="modal three">

                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close dre" onclick="remimot2()">&times;</span>
                            <h2>Remove Imot</h2>
                        </div>
                        <div class="modal-body">
                            <form action="deleteimot.php" method="post">
                                <label for="removimo">Which Imot do you want to remove:</label>
                                <select id="removimo" name="removimo" class="inptextmod1">
                                    <option disabled selected>-- Select Imot --</option>
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
                                <input type="submit" value="Submit" class="inpsubmod1">
                            </form>
                        </div>
                    </div>

                </div>

    <div class="RightCol">
        <p>REKLAME</p>
        <div class="ad">

        </div>
        <br>
        <div class="ad">
            
        </div>
        <br>
        <div class="ad">
            
        </div>
        <br>
        <div class="ad">
            
        </div>
        <br>
        <div class="ad">
            
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