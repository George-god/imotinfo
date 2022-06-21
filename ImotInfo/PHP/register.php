<!DOCTYPE html>
<?php
include ('regproc.php');
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Регистрация в системата</title>
    <link rel="stylesheet" type="text/css" href="../CSS/RS.css">
</head>
<body>
   <!--<img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="center">-->
    <div>       
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="border-radius:20px" method="POST">
            <div class="form-box">

                <div class="header-text">
                    Регистрация
                </div>
                <input placeholder="<?php echo $emailErr;?>Вашият Имейл..." type="text" name="email" value="" required> 
                <input placeholder="Вашата парола..." type="password" name="psw" required>
                <input placeholder="<?php echo $passErr;?>Повторете парола..." type="password" name="psw-repeat" required value=""> 

                <input id="terms" type="checkbox"> <label for="terms"></label>
                <span>Съгласявам се с <a href="#">Terms & Conditions</a></span> 

                <input type="submit" name="singup" value="Регистрация">
                <button onclick="location.href='login.php';" type="button">Влизане</button>
            </div>
        </form>
    </div>    
</body>
</html>