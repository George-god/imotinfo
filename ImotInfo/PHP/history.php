<?php
session_start();
require 'sqlconn.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>History</title>
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
<div class="historyback">
    <div class="conuib">

         <table class="historytab">
            <tr>
                <th>DateChanged</th>
                <th>Old Price</th>
                <th>New Price</th>
            </tr>
        <?php

            $id=$_POST['idm'];
            $tok = "electricity";
            $gas = "gas";
            $water = "water";
            

            if(isset($_POST['submita'])){
                $sqltok = "SELECT * FROM cena_history WHERE imot_id='$id' and ptype = '$tok' ";
                $resulttok = $conn->query($sqltok);

                while ($rowtok = mysqli_fetch_array($resulttok)){
                    echo 
                    "<tr>
                        <td>" . $rowtok['date'] . "</td>
                        <td>" . $rowtok['old'] . "</td>
                        <td>" . $rowtok['new'] . "</td>
                    </tr>";
                }
            }
        ?>
        <?php
            if(isset($_POST['submitb'])){
                $sqlvod = "SELECT * FROM cena_history WHERE imot_id='$id' and ptype = '$water' ";
                $resultvod = $conn->query($sqlvod);
 
                while ($rowvod = mysqli_fetch_array($resultvod)){
                    echo "<tr>
                    <td>" . htmlspecialchars($rowvod['date']) . "</td>
                    <td>" . htmlspecialchars($rowvod['old']) . "</td>
                    <td>" . htmlspecialchars($rowvod['new']) . "</td>
                    </tr>";
                }
            }
        ?>
        <?php 
            if(isset($_POST['submitc'])){
                $sqlgas = "SELECT * FROM cena_history WHERE imot_id='$id' and ptype = '$gas' ";
                $resultgas = $conn->query($sqlgas);

                while ($rowgas = mysqli_fetch_array($resultgas)){
                    echo "<tr>
                    <td>" . htmlspecialchars($rowgas['date']) . "</td>
                    <td>" . htmlspecialchars($rowgas['old']) . "</td>
                    <td>" . htmlspecialchars($rowgas['new']) . "</td>
                    </tr>";
                }
            }
        ?>
        <?php
            if(isset($_POST['subback'])){
                header("location: index.php");
            }    
        ?>
    </table>
    <form>
        <input type="button" value="Go back!" onclick="history.back()">
    </form>
    </div>
</div>