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
        <h1>View of Imot -> <?php echo $selection ?> </h1>
        <form action="index.php">
            <div class="container">
                <?php
                $sqlse = "SELECT * FROM imoti WHERE name='$selection'";
                $resultse = $conn->query($sqlse);

                while($row = mysqli_fetch_array($resultse,MYSQLI_BOTH)) {
                    $status = $row['status'];
                    $imid=$row['id'];
                ?>
                <label for="Imotname">Name for Imot: <?php echo $row ['name']; ?></label><br>
                <label for="cena">Price for Imot: <?php echo $row ['saleprice']; ?>.00 $</label><br>
                <label for="renta">Rent for Imot: <?php echo $row ['rent']; ?>.00 $</label><br>
                
                <label for="status">Status:</label>
                <select id="status" name="status" class="inptextmod1">
                    <option value="rented" <?php if($status=="rented") echo 'selected="selected"'; ?> >rented</option>
                    <option value="not_rented" <?php if($status=="not_rented") echo 'selected="selected"'; ?> >not_rented</option>
                    <option value="for_sale" <?php if($status=="for_sale") echo 'selected="selected"'; ?> >for_sale</option>
                </select>
                <br>
                <?php 
                $sql = "SELECT * FROM imot_harakter WHERE imot_id='$imid'";
                $result = $conn->query($sql);

                while($rower = mysqli_fetch_array($result,MYSQLI_BOTH)) {
                    $water = $rower['water'];
                    $gas = $rower['gas'];
                    $tok = $rower['electricity'];
                    $type = $rower['imottype'];
                ?>

                    <label for="type">What type:</label>
                    <select id="type" name="type" class="inptextmod1">
                        <?php
                            $sqlt = mysqli_query($conn, "SELECT * From imottype");
                                $rowt = mysqli_num_rows($sqlt);
                                while ($rowt = mysqli_fetch_array($sqlt)){
                                echo "<option value='". $rowt['typeid'] ."' ".(($type==$rowt['typeid'])?'selected="selected"':"")." >" .$rowt['type'] ."</option>" ;
                            }
                        ?>
                    </select>

                    <label for="water">Water:</label>
                    <select id="water" name="water" class="inptextmod1">
                        <option value="1" <?php if($water=="1") echo 'selected="selected"'; ?> >YES</option>
                        <option value="0" <?php if($water=="0") echo 'selected="selected"'; ?> >NO</option>
                    </select>

                    <label for="cenavoda">Cena na voda: <?php echo $rower['waterprice']; ?>.00 $</label><br>

                    <label for="gas">Gas:</label>
                    <select id="gas" name="gas" class="inptextmod1">
                        <option value="1" <?php if($gas=="1") echo 'selected="selected"'; ?> >YES</option>
                        <option value="0" <?php if($gas=="0") echo 'selected="selected"'; ?> >NO</option>
                    </select>

                    <label for="cenagas">Cena na gasta: <?php echo $rower['gasprice']; ?>.00 $</label><br>

                    <label for="tok">Tok:</label>
                    <select id="tok" name="tok" class="inptextmod1">
                        <option value="1" <?php if($tok=="1") echo 'selected="selected"'; ?> >YES</option>
                        <option value="0" <?php if($tok=="0") echo 'selected="selected"'; ?> >NO</option>
                    </select>

                    <label for="cenatok">Cena na toka: <?php echo $rower['electricityprice']; ?>.00 $</label><br>

                    <label for="kvadratura">Kvadratura: <?php echo $rower['kvadrat']; ?> kv.m</label> <br>                 

                <input type="submit" value="Done Viewing" class="inpsubmod1">                
            </div>
        </form>
        <?php
            } 
        }
        ?>
    </div>    
</body>
</html>