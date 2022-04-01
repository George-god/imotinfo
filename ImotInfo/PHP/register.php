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
    <img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="center">
    <div>       
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="border-radius:20px" method="POST">
            <div class="container">
                <h1>Регистрация</h1>
                <p>Моля попълнете формуляра!</p>
                <hr>

                <label for="email"><b>Email</b></label><span class="error">* <?php echo $emailErr;?></span>
                <input type="text" placeholder="Enter Email" name="email" required>

                <label for="psw"><b>Password/Парола</b></label><span class="error">*</span>
                <input type="password" placeholder="Enter Password" name="psw" required>

                <label for="psw-repeat"><b>Repeat Password/Повтори парола</b></label><span class="error">* <?php echo $passErr;?></span>
                <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
    
                <label>
                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                </label>
    
                <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

                <div class="clearfix">
                    <button type="button" class="login" onclick="location.href='login.php';" >Login</button>
                    <button type="submit" class="signupbtn" name="singup">Sign Up</button>
                </div>
            </div>
        </form>
    </div>    
</body>
</html>