<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../CSS/LS.css">
</head>
<body>
    <!--<img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="center">-->
    <div class="form-box">
        <div class="header-text">
            Login Form
        </div>

        <form action="/PHP/loginproc.php" method="post">
            <input placeholder="Your Email Address" type="text" name="ename"> 
            <input placeholder="Your Password" type="password" name="psw"> 
            <input id="terms" type="checkbox"> <label for="terms"></label>
            <span>Remember me</span> 
            <input type="submit" value="Login">
            <button onclick="location.href='register.php';" type="button">Register</button>
        </form>
    </div>
</body>
</html>