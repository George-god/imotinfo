<!DOCTYPE html>
<?php
include ('regproc.php');
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../CSS/RS.css">
</head>
<body>
   <!--<img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="center">-->
    <div>       
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="border-radius:20px" method="POST">
            <div class="form-box">

                <div class="header-text">
                    Register
                </div>
                <input placeholder="<?php echo $emailErr;?>Your Email Address" type="text" name="email" value="" required> 
                <input placeholder="Your Password" type="password" name="psw" required>
                <input placeholder="<?php echo $passErr;?>Repeat Password" type="password" name="psw-repeat" required value=""> 

                <input id="terms" type="checkbox"> <label for="terms"></label>
                <span>Agree with <a href="#">Terms & Conditions</a></span> 

                <input type="submit" name="singup" value="Register">
                <button onclick="location.href='login.php';" type="button">Login</button>
            </div>
        </form>
    </div>    
</body>
</html>