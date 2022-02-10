<?php
session_start();
require 'sqlconn.php';
    if(isset($_SESSION['user'])){
 
    }else header("location: Login.html");
$selection = $_POST['selectimo'];
$imoterID = $_SESSION['userIm'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AdImot</title>
    <link rel="stylesheet" type="text/css" href="../CSS/imotformeditS.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="module" src="../JS/js.cookie.mjs"></script>
    <script nomodule defer src="../JS/js.cookie.js"></script>
    <script src="../JS/cookie.js"></script>
</head>
<body>
    <img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="center">
    <div>
        <h1>Update Imot - <?php echo $selection ?> </h1>
        <form action="editimot.php" method="post">
            <div class="container">
                <?php
                $sqlse = "SELECT * FROM imoti WHERE name='$selection'";
                $resultse = $conn->query($sqlse);

                while($row = mysqli_fetch_array($resultse,MYSQLI_BOTH)) {
                    $status = $row['status'];
                    $imid=$row['id'];
                ?>
                <label for="Imotname">Name for Imot:</label>
                <input type="text" id="Imotname" name="Imotname" class="inptextmod1" value="<?php echo $row ['name']; ?>" placeholder="The name..">

                <label for="cena">Price for Imot:</label>
                <input type="number" id="cena" name="cena" class="inptextmod1" value="<?php echo $row ['saleprice']; ?>" placeholder="Zadai cenata..">

                <label for="renta">Rent for Imot:</label>
                <input type="number" id="renta" name="renta" class="inptextmod1" value="<?php echo $row ['rent']; ?>" placeholder="Zadai rentata..">

                <label for="status">Status:</label>
                <select id="status" name="status" class="inptextmod1">
                    <option value="rented" <?php if($status=="rented") echo 'selected="selected"'; ?> >rented</option>
                    <option value="not_rented" <?php if($status=="not_rented") echo 'selected="selected"'; ?> >not_rented</option>
                    <option value="for_sale" <?php if($status=="for_sale") echo 'selected="selected"'; ?> >for_sale</option>
                </select>
                <p>Harakteristiki za imota:</p><br>
                <?php 
                $sql = "SELECT * FROM imot_harakter WHERE imot_id='$imid'";
                $result = $conn->query($sql);

                while($rower = mysqli_fetch_array($result,MYSQLI_BOTH)) {
                    $water = $rower['water'];
                    $gas = $rower['gas'];
                    $tok = $rower['electricity'];
                ?>
                    <label for="water">Water:</label>
                    <select id="water" name="water" class="inptextmod1">
                        <option value="1" <?php if($water=="1") echo 'selected="selected"'; ?> >YES</option>
                        <option value="0" <?php if($water=="0") echo 'selected="selected"'; ?> >NO</option>
                    </select>

                    <label for="cenavoda">Cena na voda:</label>
                    <input type="number" id="cenavoda" name="cenavoda" class="inptextmod1" value="<?php echo $rower['waterprice']; ?>" placeholder="Zadai cenata na vodata..">

                    <label for="gas">Gas:</label>
                    <select id="gas" name="gas" class="inptextmod1">
                        <option value="1" <?php if($gas=="1") echo 'selected="selected"'; ?> >YES</option>
                        <option value="0" <?php if($gas=="0") echo 'selected="selected"'; ?> >NO</option>
                    </select>

                    <label for="cenagas">Cena na gasta:</label>
                    <input type="number" id="cenagas" name="cenagas" class="inptextmod1" value="<?php echo $rower['gasprice']; ?>" placeholder="Zadai cenata na gasta..">

                    <label for="tok">Tok:</label>
                    <select id="tok" name="tok" class="inptextmod1">
                        <option value="1" <?php if($tok=="1") echo 'selected="selected"'; ?> >YES</option>
                        <option value="0" <?php if($tok=="0") echo 'selected="selected"'; ?> >NO</option>
                    </select>

                    <label for="cenatok">Cena na toka:</label>
                    <input type="number" id="cenatok" name="cenatok" class="inptextmod1" value="<?php echo $rower['electricityprice']; ?>" placeholder="Zadai cenata na toka..">

                    <label for="kvadratura">Kvadratura:</label>
                    <input type="number" id="kvadratura" name="kvadratura" class="inptextmod1" value="<?php echo $rower['kvadrat']; ?>" placeholder="Zadai kvadratura..">

                <input type="submit" value="Submit" class="inpsubmod1">                
            </div>
        </form>
        <?php
            } 
        }
        ?>
    </div>    
</body>
</html>