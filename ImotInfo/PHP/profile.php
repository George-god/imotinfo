<?php
session_start();
    if(isset($_SESSION['user'])){
 
    }else header("location: login.php");

?>
<?php require 'sqlconn.php'; ?>

<!DOCTYPE html>
<html>
<head>
<title>God</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../CSS/ProfileS.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="module" src="../JS/js.cookie.mjs"></script>
<script nomodule defer src="../JS/js.cookie.js"></script>
<script src="../JS/menu.js"></script>
<script src="../JS/cookie.js"></script>
<script src="../JS/tabsrcip.js"></script>
<script src="../JS/imothid.js"></script>
<script src="../JS/modalprof.js"></script>
<script src="../JS/resetpass.js"></script>
<script src="../JS/passcheck.js"></script>
<script src="../JS/editbtn.js"></script>
<script src="../JS/savebtn.js"></script>
</head>
   
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

<body>
<div class="MainI">
<h1>Profile</h1>

    <div class="tab">
        <button class="tablinks" onclick="tabProfil(event, 'Info')" id="defaultOpen">Info</button>
        <button class="tablinks" onclick="tabProfil(event, 'Security')">Security</button>
        <button class="tablinks" onclick="tabProfil(event, 'Other')">Other</button>
    </div>

    <div class="tabcontent" id="Info">
        
        <div class="imoterinfo">
            <h3>Info za immoter</h3>
           <form action="updateprof3.php" method="post">
                <?php
                    if(isset($_SESSION['userIm'])){
                        $uname = $_SESSION['userIm'];
                    
                    $sqlimo = "SELECT * FROM imoters WHERE imoter_name ='$uname' ";
                    $resultimo = $conn->query($sqlimo);

                    while($rower = mysqli_fetch_array($resultimo,MYSQLI_BOTH)) {
                ?>
                <label for="uname">Username:</label><br>
                <input type="text" id="uname" name="username" value="<?php echo $rower ['imoter_name']; ?>" class="hidform" >
                <br>
                <label for="phone">PhoneNumber:</label><br>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{5}-[0-9]{4}" value="<?php echo $rower ['PhoneNumber']; ?>" class="hidform" >
                <br>
                <?php
                    $id=$rower['id'];
                    $sqlcout = "SELECT * FROM imoti WHERE imoter_id ='$id' ";
                    $resultcount = mysqli_query($conn, $sqlcout);
                    $row = mysqli_num_rows($resultcount);
                ?>
                <label for="bnumber">Broi Imoti:</label><br>
                <input type="number" id="bnumber" name="bnumber" value="<?php echo $row ?>" class="hidform" readonly>
                <br>
                <input type="submit" value="Save" id="savebtni" class="hidformb" name="hidsub">

            </form>
            <?php
                }
            }

                if(isset($_SESSION['userIm'])){}
                else {
            ?>
                    <button type="button" id="addim" class="hidformb">Add Yourself</button>
            <?php
                }
            ?>
            
        </div>

        <div class="imgvata">
            <?php
                    $mailpic=$_SESSION['user'];
                    $sqlpic = "SELECT profpic FROM users WHERE email ='$mailpic' ";
                    $resultpic = $conn->query($sqlpic);
                    if($resultpic){
                        $rowpic = mysqli_fetch_array($resultpic,MYSQLI_BOTH);?>
                        <img src="../Pictures/<?php echo $rowpic['profpic'] ?> " alt="Italian Trulli" id="primg">  <?php
                    }
                    else {?>
                        <img src="../Pictures/img_avatar.png" alt="Italian Trulli" id="primg"><?php
                    }
            ?>
            
        </div>

        <br>

        <div class="norminfo">
            <form action="updateprof1.php" method="post" id="formmain" name="formmain">

                <?php
                    $mail=$_SESSION['user'];
                    $sql = "SELECT * FROM users WHERE email ='$mail' ";
                    $result = $conn->query($sql);

                    while($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
                ?>

                <label for="fname" id="shitname">First Name:</label>
                <input type="text" id="fname" name="firstname" value="<?php echo $row ['first_name']; ?>" class="normform" >

                <label for="lname">Last Name:</label>
                <input type="text" id="lname" name="lastname" value="<?php echo $row ['last_name']; ?>" class="normform" >

                <label for="mail">Mail:</label>
                <input type="mail" id="mail" name="mail" value="<?php echo $row ['email']; ?>" class="normform" >

                <label for="pnumber">PostCode</label>
                <input type="number" id="pnumber" name="pnumber" value="<?php echo $row ['town_code']; ?>" class="normform" >

                <label>Immoter li si:</label>
                <label class="imoterr">DA
                <input type="radio"  name="radioI" class="normform" id="imotda" value="1" <?php if($row['imoter'] == "1") echo " checked";?>>
                <span class="checkmark"></span>
                </label>

                <label class="imoterr">NE
                <input type="radio" name="radioI" class="normform" id="imotne" value="0" <?php if($row['imoter'] == "0") echo " checked";?>>
                <span class="checkmark"></span>
                </label>
               
                <input type="submit" value="Save" id="savebtn" class="normformb" name="formmsub">

            </form>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="tabcontent" id="Security">
        <div class="container1">
            <form action="">
                <label for="opsw">Old Password</label>
                <input type="password" id="opsw" name="opsw" class="inp" required>

                <label for="psw">Password</label>
                <input type="password" id="psw" name="psw" onkeyup='check();' class="inp" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

                <label for="rpsw">Repeat Password</label>
                <input type="password" id="rpsw" name="rpsw" class="inp" onkeyup='check();' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                <span id='message'></span>
                <input type="submit" value="Submit" class="inps">
            </form>
        </div>
      
    </div>

    <div class="tabcontent" id="Other">
        <form action="logout.php" method="post">

                <label for="Logout">Logout:</label>

                <input type="submit" value="Logout" class="inpsubmod1">
        </form>
        <form action="../Pictures/upload.php" method="post" enctype="multipart/form-data">

                <label for="upload">Upload:</label>
                <input type="file" name="upload" id="upload">

                <input type="submit" value="Set Profile Pic" class="inpsubmod1">
        </form>
        
    </div>

    <div id="myModal" class="modal">

    <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="updateprof2.php" method="post">
               
                <label for="uname">Username:</label><br>
                <input type="text" id="uname" name="username" placeholder="Set username..." class="hidform" required>
                <br>
                <label for="phone">PhoneNumber:</label><br>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{5}-[0-9]{4}" placeholder="Ex:359-87880-1144" class="hidform" required>
                <br>
                <input type="submit" value="Save" id="savebtnin" class="hidformb">
  </div>

</div>

</div>

    
    
<script>
document.getElementById("defaultOpen").click();
</script>
    
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