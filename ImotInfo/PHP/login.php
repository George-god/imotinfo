<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Влизане</title>
    <link rel="stylesheet" type="text/css" href="../CSS/LS.css">
</head>
<body>
    <!--<img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="center">-->
    <div class="form-box">
        <div class="header-text">
            Влизане в системата
        </div>

        <form action="/PHP/loginproc.php" method="post">
            <input placeholder="Вашия Е-Мейл.." type="text" name="ename"> 
            <input placeholder="Вашата Парола.." type="password" name="psw"> 
            <input id="terms" type="checkbox"> <label for="terms"></label>
            <span>Запомни ме</span> 
            <input type="submit" value="Влизане">
            <button onclick="location.href='register.php';" type="button">Регистрация</button>
        </form>
    </div>
</body>
</html>