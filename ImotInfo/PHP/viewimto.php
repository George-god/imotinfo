<?php
session_start();
require 'sqlconn.php';
    if(isset($_SESSION['user'])){
 
    }else header("location: login.php");
$selection = $_POST['imotnamecard'];
$imoterID = $_SESSION['userIm'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Поглед на Имот</title>
    <link rel="stylesheet" type="text/css" href="../CSS/imotformeditSview.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="module" src="../JS/js.cookie.mjs"></script>
    <script nomodule defer src="../JS/js.cookie.js"></script>
    <script src="../JS/cookie.js"></script>
    <script src="../JS/otherscript.js"></script>
</head>
<body>
    <img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="center">
    
    <div class="conui">
        <form action="history.php" method="post">
            <div class="container">
                <?php
                $sqlse = "SELECT * FROM imoti WHERE name='$selection'";
                $resultse = $conn->query($sqlse);

                while($row = mysqli_fetch_array($resultse,MYSQLI_BOTH)) {
                    $imid=$row['id'];
                ?>

                <div class="left">
                <label for="Imotname">Име на Имота: <?php echo $row ['name']; ?></label><br>
                <label for="cena">Цена на Имота: <?php echo $row ['saleprice']; ?>.00 €</label><br>
                <label for="renta">Рента за Имота: <?php echo $row ['rent']; ?>.00 €</label><br>
                <label for="status">Статус: <?php echo $row ['status']; ?></label><br>
                </div>
                <?php 
                $sql = "SELECT * FROM imot_harakter INNER JOIN imottype on imot_harakter.imottype = imottype.typeid WHERE imot_id='$imid'";
                $result = $conn->query($sql);

                while($rower = mysqli_fetch_array($result,MYSQLI_BOTH)) {
                    $water = $rower['water'];
                    $gas = $rower['gas'];
                    $tok = $rower['electricity'];
                    $obza = $rower['obzaveden'];
                    $dogram = $rower['dograma'];
                ?>
                    <div class="right">
                        <div class="rightleft">
                        <label for="type">Тип на Имота: <?php echo $rower['type']; ?></label><br>

                        <label for="water">Вода:
                            <?php
                                if($water=="1"){
                                    echo '<img src="../Pictures/check.png">';
                                }
                                else {
                                    echo '<img src="../Pictures/remove.png">';
                                }
                            ?>
                        </label><br>

                        <label for="gas">Газ:
                            <?php
                                if($gas=="1"){
                                    echo '<img src="../Pictures/check.png">';
                                }
                                else {
                                    echo '<img src="../Pictures/remove.png">';
                                }
                            ?>
                        </label><br>

                        <label for="tok">Ток:
                            <?php
                                if($tok=="1"){
                                    echo '<img src="../Pictures/check.png">';
                                }
                                else {
                                    echo '<img src="../Pictures/remove.png">';
                                }
                            ?>
                        </label> <br> 
                        <label for="obzav">Обзавеждане:
                            <?php
                                if($obza=="1"){
                                    echo '<img src="../Pictures/check.png">';
                                }
                                else {
                                    echo '<img src="../Pictures/remove.png">';
                                }
                            ?>
                    </label> <br> 
                    <label for="dogra">Дограма:
                            <?php
                                if($dogram=="1"){
                                    echo '<img src="../Pictures/check.png">';
                                }
                                else {
                                    echo '<img src="../Pictures/remove.png">';
                                }
                            ?>
                    </label> <br>             
                        </div>
                        <div class="rightright">
                            <label for="cenatok">Цена Ток:<?php echo $rower['electricityprice']; ?>.00 €</label>
                                <input type="hidden" name="idm" value="<?php echo $imid; ?>">
                                <input type="submit" value="" class="imgClass" name="submita" title="Cena Tok History">
                            <label for="cenavoda">Цена Вода:<?php echo $rower['waterprice']; ?>.00 €</label>
                                <input type="submit" value="" class="imgClass" name="submitb" title="Cena Voda History">  
                            <label for="cenagas">Цена Газ:<?php echo $rower['gasprice']; ?>.00 €</label>
                                <input type="submit" value="" class="imgClass" name="submitc" title="Cena Gas History">
                            <label for="kvadratura">Квадратура:<?php echo $rower['kvadrat']; ?> ㎡</label> <br>
                            <label for="banq">Баня:<?php echo $rower['banqsitu']; ?></label><br>
                            <label for="pod">Подова настилка:<?php echo $rower['poda']; ?></label><br>
                            <label for="steni">Стени:<?php echo $rower['steni']; ?></label><br>
                            <label for="terasa">Тераса:<?php echo $rower['terasa']; ?></label> 
                        </div>
                    </div>

                <input type="submit" value="Готов с гледането" class="inpsubmod1" name="subback">                
            </div>
        </form>
        <?php
            } 
        }
        ?>
    </div>

</body>
</html>