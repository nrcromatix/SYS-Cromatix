<?php
include "../connect.php";
$cod_documento = $_GET["cod_documento"];
$td = $_GET["td"];
$target_dir = "other_files/";


$newfilename = date("Ymd_His_") . $cod_documento. '.' . end(explode(".", $_FILES["fileToUpload"]["name"]));

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

$target_file = $target_dir . $newfilename;

echo $target_file;
$uploadOk = 1;


$sql = "INSERT INTO doc_paths (cod_dcto, path_file) VALUES ('$cod_documento','$newfilename')";

if ($db->query($sql) === TRUE) {

} else {
echo "Error: " . $sql . "<br>" . $db->error;
}

 //Check if file already exists
 if (file_exists($target_file)) {
    header('Location: ' . $_SERVER["HTTP_REFERER"] );
     $uploadOk = 0;
 }
 // Check file size
 if ($_FILES["fileToUpload"]["size"] > 5000000) {
    header('Location: ' . $_SERVER["HTTP_REFERER"] );
     $uploadOk = 0;
 }
 // Check if $uploadOk is set to 0 by an error
 if ($uploadOk == 0) {
    header('Location: ' . $_SERVER["HTTP_REFERER"] );
 // if everything is ok, try to upload file
 } else {
     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        header('Location: ' . $_SERVER["HTTP_REFERER"] );
     } else {
        header('Location: ' . $_SERVER["HTTP_REFERER"] );
     }
 }

// header('Location: ' . $_SERVER["HTTP_REFERER"] );



?>
