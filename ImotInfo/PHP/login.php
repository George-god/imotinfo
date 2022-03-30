<!DOCTYPE html>
<?php
//include ('loginproc.php');
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../CSS/LS.css">
</head>
<body>
    <img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="center">
    <div>
        <h1>Влизане/Login</h1>
        <form action="/PHP/loginproc.php" method="post">
            <div class="container">
                <label for="ename"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="ename" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
        
                <button type="submit" name="login">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button class="cancelbtn" onclick="location.href='register.php';">Register</button>
                <span class="psw">Forgot <a href="#">password?</a></span>
            </div>
        </form>
    </div>    
</body>
</html>