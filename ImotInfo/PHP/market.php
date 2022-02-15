<?php
session_start();
require 'sqlconn.php';
    if(isset($_SESSION['user'])){
 
    }else header("location: Login.html");

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
<h1>Здравейте 
<?php 
    if(isset($_SESSION['userIm'])){
        echo $_SESSION['userIm']; 
    }else {echo $_SESSION['user'];}
?>
<h2>This is the marketplace</h2>
 
    <div class="LeftCol">
    <?php
    
        $userImd = $_SESSION['userIm'];
        $statem = "SELECT * FROM imoti,imot_harakter WHERE imot_harakter.imot_id=imoti.id ";
        $resultc = $conn -> query($statem);
     

     while ($row = $resultc->fetch_assoc()) {
       
    ?>  
        <div class="icard" id="edit">
            <div class="icontainer">
            <img src="../Pictures/img_avatar.png" alt="Avatar" style="width:50%" id="iimg"><br>
            <label>ID na Durjatel:</label><label><?php echo $row['imoter_id']?></label><br>
            </div>
            <div class="icontainer">
                <label>Ime na imot:</label><label><?php echo $row['name']?></label><br>
                <label>Price:</label><label><?php echo $row['saleprice']?>€</label><br>
                <label>Rent:</label><label><?php echo $row['rent']?>€</label><br>
                <label>Status:</label><label><?php echo $row['status']?></label><br>
            </div>
            <div class="icontainer">
                <label>Kavdratura:</label><label><?php echo $row['kvadrat']?> ㎡</label><br>
                <label>Voda:</label><label>
                    <?php 
                        if($row['water']=="1"){echo "Yes";  }
                        else {echo "No"; }
                    ?> 
                    </label><br>

                <label>Tok:</label><label>
                    <?php 
                        if($row['electricity']=="1"){echo "Yes";  }
                        else {echo "No"; }
                    ?> 
                </label><br>

                <label>Gas:</label><label>
                    <?php 
                        if($row['gas']=="1"){echo "Yes";  }
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
        <p>FILTER</p>
        <div class="filter">
            <form method="post" action="">

                <label for="timot">Type of imot:</label><br>
                <select id="timot" name="timot">
                    <option value="">1 room</option>
                    <option value="">2 rooms</option>
                    <option value="">3 rooms</option>
                </select><br>
                <label for="price">Wanted Price:</label><br>
                    <input type="range" id="price" name="price" min="0" max="1000000" oninput="this.nextElementSibling.value = this.value">
                    <output>500000</output><br>
                <label for="neses">Iskate li ot tiq neshta?</label><br>
                <label class="containers">Tok
                    <input type="checkbox" name="neses" value="electricity">
                    <span class="checkmark"></span>
                </label>

                <label class="containers">Gas
                    <input type="checkbox" name="neses" value="gas">
                    <span class="checkmark"></span>
                </label>

                <label class="containers">Voda
                    <input type="checkbox" name="neses" value="water">
                    <span class="checkmark"></span>
                </label>

                

                <input type="submit" value="Filter">
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