<?php
$target_dir = "../../public_ftp/incoming/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  echo "Sorry, your file is too large Max is 5Mb.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

$refinvoice = htmlspecialchars($_POST['proofp']);
$item1 = $_POST['crystal1'];
$item2 = $_POST['crystal2'];
$item3 = $_POST['crystal3'];
$item4 = $_POST['crystal4'];
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    echo "Passing file $target_file </br>";
    echo "Ref $refinvoice </br>";
    //$passURI="fileToEmail=$target_file&proofp=$refinvoice";
    //echo " URI = $passURI </br>";
    //$url_encoded = urlencode($passURI);
    //echo "Encoded now = $url_encoded";
    $output = file_get_contents("https://madredemisericordia.es/customainze.com/sendpicone.php?fileToEmail=$target_file&proofp=$refinvoice&crystal1=$item1&crystal2=$item2&crystal3=$item3&crystal4=$item4");
    echo $output;
  } else 
    echo "Sorry, there was an error uploading your file.";
  }
?>