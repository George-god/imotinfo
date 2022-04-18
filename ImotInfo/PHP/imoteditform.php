<?php
session_start();
require 'sqlconn.php';
    if(isset($_SESSION['user'])){
 
    }else header("location: login.php");
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
                <input type="text" id="Imotname" name="Imotname" class="inptextmod1" value="<?php echo $row ['name']; ?>" placeholder="The name.." maxlength="100">

                <label for="cena">Price for Imot:</label>
                <input type="number" id="cena" name="cena" class="inptextmod1" value="<?php echo $row ['saleprice']; ?>" placeholder="Zadai cenata.." maxlength="1000000000">

                <label for="renta">Rent for Imot:</label>
                <input type="number" id="renta" name="renta" class="inptextmod1" value="<?php echo $row ['rent']; ?>" placeholder="Zadai rentata.." maxlength="100000">

                <label for="status">Status:</label>
                <select id="status" name="status" class="inptextmod1">
                    <option value="rented" <?php if($status=="rented") echo 'selected="selected"'; ?> >rented</option>
                    <option value="not_rented" <?php if($status=="not_rented") echo 'selected="selected"'; ?> >not_rented</option>
                    <option value="for_sale" <?php if($status=="for_sale") echo 'selected="selected"'; ?> >for_sale</option>
                </select>
                <h4><b>Property characteristics:</b></h4><br>
                <div class="hara">
                <div class="har1">
                <?php 
                $sql = "SELECT * FROM imot_harakter WHERE imot_id='$imid'";
                $result = $conn->query($sql);

                while($rower = mysqli_fetch_array($result,MYSQLI_BOTH)) {
                    $water = $rower['water'];
                    $gas = $rower['gas'];
                    $tok = $rower['electricity'];
                    $type = $rower['imottype'];
                    $obza = $rower['obzaveden'];
                    $dogra = $rower['dograma'];
                    $banq = $rower['banqsitu'];
                    $pod = $rower['poda'];
                    $steni = $rower['steni'];
                    $tera = $rower['terasa'];
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

                    <label for="cenavoda">Water Price:</label>
                    <input type="number" id="cenavoda" name="cenavoda" class="inptextmod1" value="<?php echo $rower['waterprice']; ?>" placeholder="Zadai cenata na vodata.." maxlength="100000">

                    <label for="gas">Gas:</label>
                    <select id="gas" name="gas" class="inptextmod1">
                        <option value="1" <?php if($gas=="1") echo 'selected="selected"'; ?> >YES</option>
                        <option value="0" <?php if($gas=="0") echo 'selected="selected"'; ?> >NO</option>
                    </select>

                    <label for="cenagas">Gas Price:</label>
                    <input type="number" id="cenagas" name="cenagas" class="inptextmod1" value="<?php echo $rower['gasprice']; ?>" placeholder="Zadai cenata na gasta.." maxlength="100000">

                    <label for="tok">Tok:</label>
                    <select id="tok" name="tok" class="inptextmod1">
                        <option value="1" <?php if($tok=="1") echo 'selected="selected"'; ?> >YES</option>
                        <option value="0" <?php if($tok=="0") echo 'selected="selected"'; ?> >NO</option>
                    </select>

                    <label for="cenatok">Elec. Price:</label>
                    <input type="number" id="cenatok" name="cenatok" class="inptextmod1" value="<?php echo $rower['electricityprice']; ?>" placeholder="Zadai cenata na toka.." maxlength="100000">

                    <label for="kvadratura">Squaring:</label>
                    <input type="number" id="kvadratura" name="kvadratura" class="inptextmod1" value="<?php echo $rower['kvadrat']; ?>" placeholder="Zadai kvadratura.." maxlength="1000000">
                    </div>
                    <div class="har2">
                        <label for="obzav">Obzaveden:</label>
                        <select id="obzav" name="obzav" class="inptextmod1">
                            <option value="1" <?php if($obza=="1") echo 'selected="selected"'; ?> >YES</option>
                            <option value="0" <?php if($obza=="0") echo 'selected="selected"'; ?> >NO</option>
                        </select>

                        <label for="dogra">Dograma:</label>
                        <select id="dogra" name="dogra" class="inptextmod1">
                            <option value="1" <?php if($dogra=="1") echo 'selected="selected"'; ?> >YES</option>
                            <option value="0" <?php if($dogra=="0") echo 'selected="selected"'; ?> >NO</option>
                        </select>

                        <label for="banq">Banq:</label>
                        <select id="banq" name="banq" class="inptextmod1">
                            <option value="vana" <?php if($banq=="vana") echo 'selected="selected"'; ?> >vana</option>
                            <option value="dush" <?php if($banq=="dush") echo 'selected="selected"'; ?> >dush</option>
                        </select>

                        <label for="pod">Podova nastilka:</label>
                        <select id="pod" name="pod" class="inptextmod1">
                            <option value="laminat" <?php if($pod=="laminat") echo 'selected="selected"'; ?> >laminat</option>
                            <option value="chastichen_laminat" <?php if($pod=="chastichen_laminat") echo 'selected="selected"'; ?> >chastichen_laminat</option>
                            <option value="parket" <?php if($pod=="parket") echo 'selected="selected"'; ?> >parket</option>
                            <option value="keramika" <?php if($pod=="keramika") echo 'selected="selected"'; ?> >keramika</option>
                            <option value="kamuk" <?php if($pod=="kamuk") echo 'selected="selected"'; ?> >kamuk</option>
                            <option value="vinil" <?php if($pod=="vinil") echo 'selected="selected"'; ?> >vinil</option>
                        </select>

                        <label for="steni">Steni:</label>
                        <select id="steni" name="steni" class="inptextmod1">
                            <option value="kamuk" <?php if($steni=="kamuk") echo 'selected="selected"'; ?> >kamuk</option>
                            <option value="beton_blok" <?php if($steni=="beton_blok") echo 'selected="selected"'; ?> >beton_blok</option>
                            <option value="tuhli" <?php if($steni=="tuhli") echo 'selected="selected"'; ?> >tuhli</option>
                            <option value="durvo" <?php if($steni=="durvo") echo 'selected="selected"'; ?> >durvo</option>
                        </select>

                        <label for="terasa">Terasa:</label>
                        <select id="terasa" name="terasa" class="inptextmod1">
                            <option value="nqma" <?php if($tera=="nqma") echo 'selected="selected"'; ?> >nqma</option>
                            <option value="otkrita" <?php if($tera=="otkrita") echo 'selected="selected"'; ?> >otkrita</option>
                            <option value="zakrita" <?php if($tera=="zakrita") echo 'selected="selected"'; ?> >zakrita</option>
                            <option value="sredno_otkrita" <?php if($tera=="sredno_otkrita") echo 'selected="selected"'; ?> >sredno_otkrita</option>
                        </select>

                     </div>
                    </div> 
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