<?php
// Include the database configuration file
session_start();
$mail=$_SESSION['user'];
include '../PHP/sqlconn.php';
//$imid = $_POST['idim'];

// File upload path
$targetDir = "uploads/";
$target_file = $targetDir . basename($_FILES["upload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["upload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["upload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
    //echo "The file ". htmlspecialchars( basename( $_FILES["upload"]["name"])). " has been uploaded.";
    $pic=htmlspecialchars( basename( $_FILES["upload"]["name"]));
    $sqlr = "UPDATE users SET profpic='$pic' WHERE email='$mail' ";
    //$result = $conn->query($sqlr);
    if(mysqli_query($conn, $sqlr)){
      header("location: ../PHP/profile.php");
    }
    else {
      echo "Error updating record: " . mysqli_error($conn);
      //header("location: ../PHP/errorpage.html");
    }
  } else {
      //header("location: ../PHP/errorpage.html");
      echo "da go iba drugo";
  }
}
?>