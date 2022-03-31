<?php
require 'sqlconn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name=$_POST['name'];
	$subjecto=$_POST['subject'];
	$comment=$_POST['problem'];
	$mail=$_POST['mail'];

	$to = "wesnoth7@gmail.com";
	$subject = $subjecto;
	$txt = $comment;
	$headers = "From:". $mail;

	mail($to,$subject,$txt,$headers);
	$message = "MAIL WAS SENT";
	echo "<script type='text/javascript'>alert('$message');</script>";
}
?>