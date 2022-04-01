<?php
session_start();
require 'sqlconn.php';
    if(isset($_SESSION['user'])){
 
    }else header("location: login.php");

?>
<!DOCTYPE html>
<html>
<head>
<title>God</title>

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
<script src="../JS/range.js"></script>
<script src="../JS/otherscript.js"></script>
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


<div class="MainI">

    <div class="LeftCol">
    <?php
        $userImd = $_SESSION['userIm'];
            $type=$_POST['type'];
            $pricer=$_POST['price'];
            $tok=$_POST['Tok'];
            $gas=$_POST['Gas'];
            $voda=$_POST['voda'];

        $statemf = "SELECT * FROM imoti,imot_harakter LEFT JOIN imottype ON imot_harakter.imottype=imottype.typeid
        WHERE imot_harakter.imot_id=imoti.id 
        and imot_harakter.imottype= '$type' and status='for_sale' and saleprice <= '$pricer' and  water='$voda' and gas='$gas' and electricity='$tok' ";
        $resultf = $conn -> query($statemf);
     

     while ($rowf = $resultf->fetch_assoc()) {
       
    ?>  
        <div class="icard" id="edit">
            <div class="icontainer">
            <img src="../Pictures/<?php echo $rowf['icon'] ?>" alt="Avatar" style="width:50%" id="iimg"><br>
            <label>ID na Durjatel:</label><label><?php echo $rowf['imoter_id']?></label><br>
            </div>
            <div class="icontainer">
                <label>Ime na imot:</label><label><?php echo $rowf['name']?></label><br>
                <label>Price:</label><label><?php echo $rowf['saleprice']?>€</label><br>
                <label>Rent:</label><label><?php echo $rowf['rent']?>€</label><br>
                <label>Status:</label><label><?php echo $rowf['status']?></label><br>
                <label>Type:</label><label><?php echo $rowf['type']?></label><br>
            </div>
            <div class="icontainer">
                <label>Kavdratura:</label><label><?php echo $rowf['kvadrat']?> ㎡</label><br>
                <label>Voda:</label><label>
                    <?php 
                        if($rowf['water']=="1"){echo "Yes";  }
                        else {echo "No"; }
                    ?> 
                    </label><br>

                <label>Tok:</label><label>
                    <?php 
                        if($rowf['electricity']=="1"){echo "Yes";  }
                        else {echo "No"; }
                    ?> 
                </label><br>

                <label>Gas:</label><label>
                    <?php 
                        if($rowf['gas']=="1"){echo "Yes";  }
                        else {echo "No"; }
                    ?> 
                </label><br>

            </div>
        </div>
        <?php
            }
        ?>           
    </div>
         
    <div class="RightCol">
        <button class="open-button" onclick="openForm()">FILTER</button>
        <div class="form-popup" id="myForm">
            <form method="post" action="" class="form-container">

                <<label for="timot">Type of imot:</label><br>
                <select id="type" name="type" class="inptextmod1">
                        <?php
                            $sqlt = mysqli_query($conn, "SELECT * From imottype");
                            $rowt = mysqli_num_rows($sqlt);
                            while ($rowt = mysqli_fetch_array($sqlt)){
                            echo "<option value='". $rowt['typeid'] ."'>" .$rowt['type'] ."</option>" ;
                            }
                        ?>
                    </select><br>
                <label for="price">Wanted Price:</label><br>
                    <input type="range" id="price" name="price" min="0" max="100000000" oninput="this.nextElementSibling.value = this.value">
                    <output>50000000</output><br>
                <label for="neses">Iskate li ot tiq neshta?</label><br>
                <input type="checkbox" id="Tok" name="Tok" value="1">
                <input type="hidden" id="Tokhidden" name="Tok" value="0">
                <label for="Tok"> TOK</label><br>
                <input type="checkbox" id="Gas" name="Gas" value="1">
                <input type="hidden" id="Gashidden" name="Gas" value="0">
                <label for="Gas"> GAS</label><br>
                <input type="checkbox" id="voda" name="voda" value="1">
                <input type="hidden" id="vodahidden" name="voda" value="0">
                <label for="voda"> WATER</label><br>

                

                <input type="submit" value="Filter" class="btn">
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
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