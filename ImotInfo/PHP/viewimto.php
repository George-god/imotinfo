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
    <title>AdImot</title>
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
        <form action="index.php">
            <div class="container">
                <?php
                $sqlse = "SELECT * FROM imoti WHERE name='$selection'";
                $resultse = $conn->query($sqlse);

                while($row = mysqli_fetch_array($resultse,MYSQLI_BOTH)) {
                    $imid=$row['id'];
                ?>
                <div class="left">
                <label for="Imotname">Name for Imot: <?php echo $row ['name']; ?></label><br>
                <label for="cena">Price for Imot: <?php echo $row ['saleprice']; ?>.00 €</label><br>
                <label for="renta">Rent for Imot: <?php echo $row ['rent']; ?>.00 €</label><br>
                <label for="status">Status: <?php echo $row ['status']; ?></label><br>
                </div>
                <?php 
                $sql = "SELECT * FROM imot_harakter INNER JOIN imottype on imot_harakter.imottype = imottype.typeid WHERE imot_id='$imid'";
                $result = $conn->query($sql);

                while($rower = mysqli_fetch_array($result,MYSQLI_BOTH)) {
                    $water = $rower['water'];
                    $gas = $rower['gas'];
                    $tok = $rower['electricity'];
                ?>
                    <div class="right">
                        <div class="rightleft">
                        <label for="type">What type: <?php echo $rower['type']; ?></label><br>

                        <label for="water">Water:
                            <?php
                                if($water=="1"){
                                    echo '<img src="../Pictures/check.png">';
                                }
                                else {
                                    echo '<img src="../Pictures/remove.png">';
                                }
                            ?>
                        </label><br>

                        <label for="gas">Gas:
                            <?php
                                if($gas=="1"){
                                    echo '<img src="../Pictures/check.png">';
                                }
                                else {
                                    echo '<img src="../Pictures/remove.png">';
                                }
                            ?>
                        </label><br>

                        <label for="tok">Elec.:
                            <?php
                                if($tok=="1"){
                                    echo '<img src="../Pictures/check.png">';
                                }
                                else {
                                    echo '<img src="../Pictures/remove.png">';
                                }
                            ?>
                        </label> <br>              
                        </div>
                        <div class="rightright">
                            <label for="cenatok">Elec. Price:<?php echo $rower['electricityprice']; ?>.00 €</label>
                            <form form action="" method="post" name="tokform">
                                <input type="hidden" name="idm" value="<?php echo $imid ?>">
                                <input type="image" src="../Pictures/history.png" alt="Submit" name="submita" form="tokform">
                            </form> 
                            <label for="cenavoda">Water Price:<?php echo $rower['waterprice']; ?>.00 €</label> 
                                <img src="../Pictures/history.png" onclick="openHistory()"> 
                            <label for="cenagas">Gas Price:<?php echo $rower['gasprice']; ?>.00 €</label>
                                <img src="../Pictures/history.png" onclick="openHistory()"> 
                            <label for="kvadratura">Squaring:<?php echo $rower['kvadrat']; ?> ㎡</label> <br> 
                        </div>
                    </div>                

                <input type="submit" value="Done Viewing" class="inpsubmod1">                
            </div>
        </form>
        <?php
            } 
        }
        ?>
    </div>

    <div id="myHistory" class="hisory-popup">
        <?php
                    $sqlcena = "SELECT * FROM cena_history WHERE imot_id='$imid'";
                    $resultcena = $conn->query($sqlcena);
            if(isset($_POST['submite'])){
                ?>  

                <tr>
                    <th>DateChanged</th>
                    <th>Old Price</th>
                    <th>New Price</th>
                </tr>
            <?php 
                while ($rowcena = mysqli_fetch_array($resultcena)){
                    echo "<tr>
                    <td>" . htmlspecialchars($rowcena['date']) . "</td>
                    <td>" . htmlspecialchars($rowcena['old']) . "</td>
                    <td>" . htmlspecialchars($rowcena['new']) . "</td>
                    </tr>";
                }
            }
        ?>
    </div>
                   
</body>
</html>