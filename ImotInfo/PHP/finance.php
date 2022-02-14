<?php
session_start();
require 'sqlconn.php';
    if(isset($_SESSION['user'])){
        $userImed = $_SESSION['userIm'];
    }else header("location: Login.html");

?>
<!DOCTYPE html>
<html>
<head>
<title>God</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../CSS/finance.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script type="module" src="../JS/js.cookie.mjs"></script>
<script nomodule defer src="../JS/js.cookie.js"></script>
<script src="../JS/cookie.js"></script>
<script src="../JS/formfilt.js"></script>
<script src="../JS/table.js"></script>
</head>

<body>
    
<header>
    <img src="../Pictures/LogoMaybe.png" alt="Italian Trulli" class="logo">
</header>
 

<div id="mySidenav" class="sidenav">
  <a href="index.php" id="about">Imoti</a>
  <a href="finance.php" id="blog">Finansi</a>
  <a href="#" id="projects">Market</a>
  <a href="profile.php" id="profile">Profile</a>
  <a href="Contact.php" id="contact">Contact</a>
</div>

<div class="FinanceMain">
<h1>Finance Manager</h1>

    <div class="filterfinance">
        <form action="" id="finfil" method="post">
        <div id="svetatri">
            <div id="fin">
                <p>Use the min and max attributes to add restrictions to dates:</p>

                <label for="datemin">Enter a date after 2000-01-01:</label>
                <input type="date" id="datemin" name="datemin" min="2000-01-02"><br>

                <label for="datemax">Enter a date before 2050-01-01:</label>
                <input type="date" id="datemax" name="datemax" max="2049-12-31"><br>
            </div>
            
            <div id="fin">
                
                <label for="Razhodi">Koi imoti da se vkluchat vuv finansite?</label><br>

                <select name="imoti[]" multiple>
                    <?php
                        $sqlse = "SELECT id FROM imoters WHERE imoter_name='$userImed'";
                        $resultse = $conn->query($sqlse);
                        $rowe = mysqli_fetch_array($resultse,MYSQLI_BOTH);
                        $imdie = $rowe['id'];                
                        $sql = mysqli_query($conn, "SELECT name From imoti WHERE imoter_id=$imdie and status='rented' ");
                        $row = mysqli_num_rows($sql);
                        while ($row = mysqli_fetch_array($sql)){
                            echo "<option value=\"".$row['name']."\" data-json='" . json_encode($row) . "'>" .$row['name'] ."</option>" ;
                        }
                    ?>
                </select>
                
            </div>

            <div id="fin">
                <input type="reset" id="Resetbtn">
                <input type="submit" id="Filterbtn" name="submit">
            </div>
        </div>

            
        </form>
    </div>
    <br><br><br>
    <div class="resultshow">
        <?php
            

            if(isset($_POST['submit'])){
                $imoti = implode("','",$_POST['imoti']);
                $sdate =$_POST['datemin'];
                $edate =$_POST['datemax'];

                $ds1=strtotime($sdate);
                $ds2=strtotime($edate);

                $year1 = date('Y', $ds1);
                $year2 = date('Y', $ds2);

                $month1 = date('m', $ds1);
                $month2 = date('m', $ds2);

                $diff = (($year2 - $year1) * 12) + ($month2 - $month1);



                
            $sqlt ="SELECT * FROM imoti,imot_harakter WHERE (imot_harakter.imot_id = imoti.id and imoti.name IN ('$imoti') )";
            $resultt = mysqli_query($conn,$sqlt);

                $resultd = mysqli_query($conn, "SELECT SUM(rent) AS rent_sum FROM imoti WHERE name IN ('$imoti') "); 
                $rowd = mysqli_fetch_assoc($resultd); 
                $sum = $rowd['rent_sum'];
                $sumdif=$sum*$diff;

                $resultr = mysqli_query($conn, 
                    'SELECT SUM(COALESCE(gasprice,0))
                        + COALESCE(waterprice,0) 
                        + COALESCE(electricity,0)
                         AS razh_sum FROM imot_harakter'); 
                $rowr = mysqli_fetch_assoc($resultr); 
                $sumr = $rowr['razh_sum'];
                $sumrdif=$sumr*$diff;

                $treud = $sumdif-$sumrdif;
            
        echo "<table id='imotiinfo'> ";
        ?>
            <tr>
                <th>Imot-Name</th>
                <th>Status</th>
                <th>Rent</th>
                <th>Gas</th>
                <th>Tok(Elec)</th>
                <th>Water</th>
            </tr>
            <?php
            while ($rowt = mysqli_fetch_array($resultt)){
                echo "<tr>
                <td>" . htmlspecialchars($rowt['name']) . "</td>
                <td>" . htmlspecialchars($rowt['status']) . "</td>
                <td>" . htmlspecialchars($rowt['rent']) . "</td>
                <td>" . htmlspecialchars($rowt['gasprice']) . "</td>
                <td>" . htmlspecialchars($rowt['electricityprice']) . "</td>
                <td>" . htmlspecialchars($rowt['gasprice']) . "</td>
                </tr>";
            }
        echo "</table>";
        

        echo "<table id='imotifinan'> ";
        ?>
            <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Dohodi</th>
                <th>Razhodi</th>
                <th>True Dohod</th>
            </tr>
            
            <tr>
                <td><?php echo $sdate ?></td>
                <td><?php echo $edate ?></td>
                <td style="background-color: #4dff4d"><?php echo $sumdif ?></td>
                <td style="background-color: #ff3333"><?php echo $sumrdif ?></td>
                <td><?php echo $treud ?></td>
            </tr>
        <?php   
        echo "</table>";
        }
        ?>
    </div>
    

   

</div>


    
    
    
    
    <footer>
         <div class=’cookie-banner’ style=’display: none’>
            <p>
            By using our website, you agree to our 
            <a href=’insert-link’>cookie policy</a>
            </p>
        </div>
        <p>This website is made by Georgi Pavlov. Please, if you are thinking of stealing it then don't!</p>
        
    </footer>    
          
</body>
</html>