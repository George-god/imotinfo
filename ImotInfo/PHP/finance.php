<?php
session_start();
require 'sqlconn.php';
    if(isset($_SESSION['user'])){
        $userImed = $_SESSION['userIm'];
    }else header("location: login.php");

?>
<!DOCTYPE html>
<html>
<head>
<title>Финанси</title>

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
  <a href="index.php" id="about">Имоти</a>
  <a href="finance.php" id="blog">Финанси</a>
  <a href="market.php" id="projects">Пазар</a>
  <a href="profile.php" id="profile">Профил</a>
  <a href="Contact.php" id="contact">Докладвай</a>
</div>

<div class="FinanceMain">
<h1>Мениджър на Финансите</h1>

    <div class="filterfinance">
        <form action="" id="finfil" method="post">
        <div class="svetatri">
            <div class="fin">
                <p><b>Трябва да има минимум 1 месец разлика в датите:</b></p>

                <label for="datemin">Задай дата след 2000-01-01:</label>
                <input type="date" id="datemin" name="datemin" min="2000-01-02"><br>

                <label for="datemax">Задай дата преди 2050-01-01:</label>
                <input type="date" id="datemax" name="datemax" max="2049-12-31"><br>
            </div>
            
            <div class="fin">
                
                <label for="Razhodi">Кои имоти да се включат във финансите?</label><br>

                <select name="imoti[]" multiple >
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

            <div class="fin finsub">
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



            
            $sqlall ="SELECT * FROM imoti,imot_harakter WHERE (imot_harakter.imot_id = imoti.id and imoti.name IN ('$imoti') )";
            $resultall = mysqli_query($conn,$sqlall);

            $sqlt ="SELECT id FROM imoti WHERE (imoti.name IN ('$imoti') )";
            $resultt = $conn->query($sqlt);

            while ($rowt = $resultt->fetch_assoc()) {
                $ids = $rowt['id'];
                $idres[]=$ids;
            }

            $id=implode("','", $idres);
            
                $resultd = mysqli_query($conn, "SELECT SUM(rent) AS rent_sum FROM imoti WHERE name IN ('$imoti') "); 
                $rowd = mysqli_fetch_assoc($resultd); 
                $sum = $rowd['rent_sum'];
                $sumdif=$sum*$diff;


                $resultr = mysqli_query($conn, 
                "SELECT SUM(gasprice + waterprice + electricityprice) AS razh_sum FROM imot_harakter WHERE (imot_id IN ('$id'))" ); 
                $rowr = mysqli_fetch_assoc($resultr); 
                $sumr = $rowr['razh_sum'];
                $sumrdif=$sumr*$diff;

                $treud = $sumdif-$sumrdif;
            
        echo "<table id='imotiinfo'> ";
        ?>
            <tr>
                <th>Име на имота</th>
                <th>Статус</th>
                <th>Рента</th>
                <th>Газ</th>
                <th>Ток</th>
                <th>Вода</th>
            </tr>
            <?php
            while ($rowall = mysqli_fetch_array($resultall)){

                echo "<tr>
                <td>" . htmlspecialchars($rowall['name']) . "</td>
                <td>" . htmlspecialchars($rowall['status']) . "</td>
                <td>" . htmlspecialchars($rowall['rent']) . "</td>
                <td>" . htmlspecialchars($rowall['gasprice']) . "</td>
                <td>" . htmlspecialchars($rowall['electricityprice']) . "</td>
                <td>" . htmlspecialchars($rowall['waterprice']) . "</td>
                </tr>";
            }
        echo "</table>";
        

        echo "<table id='imotifinan'> ";
        ?>
            <tr>
                <th>Начална Дата</th>
                <th>Крайна Дата</th>
                <th>Доходи</th>
                <th>Разходи</th>
                <th>Бюджет</th>
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