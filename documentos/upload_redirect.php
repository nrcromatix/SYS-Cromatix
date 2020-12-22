

<?php
include "../connect.php";
$cod_documento = $_GET["cod_documento"];
$td = $_GET["td"];
$target_dir = "cromatix_files/";


$newfilename = $cod_documento . '.' . end(explode(".", $_FILES["fileToUpload"]["name"]));

//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

echo $newfilename;

echo $target_file;

//break;



if ($td=="pi") { $newfilename="pi".$newfilename; $sql = "UPDATE documentos SET doc_pi='$newfilename' WHERE cod_documento='".$cod_documento."'"; }
if ($td=="ci") { $newfilename="ci".$newfilename; $sql = "UPDATE documentos SET doc_ci='$newfilename' WHERE cod_documento='".$cod_documento."'"; }
if ($td=="pl") { $newfilename="pl".$newfilename; $sql = "UPDATE documentos SET doc_pl='$newfilename' WHERE cod_documento='".$cod_documento."'"; }
if ($td=="oc") { $newfilename="oc".$newfilename; $sql = "UPDATE documentos SET doc_oc='$newfilename' WHERE cod_documento='".$cod_documento."'"; }
if ($td=="bl") { $newfilename="bl".$newfilename; $sql = "UPDATE documentos SET doc_bl='$newfilename' WHERE cod_documento='".$cod_documento."'"; }
if ($db->query($sql) === TRUE) { } //cierre de IF de UPDATE en DB

$target_file = $target_dir . $newfilename;

$uploadOk = 1;

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

    
        header('Location: ' . $_SERVER['HTTP_REFERER']);

mssql_close();
    
    
    
    


    
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


?>
