<?php
session_start();
if(isset($_SESSION["user"]))
{
 if((time() - $_SESSION['last_time']) > 86400) // Time in Seconds // UN DIA
 {
header("Location:../logout.php");
 }
 else
 {  $_SESSION['last_time'] = time();
include "../connect.php";
$cod_documento = $_GET["cod_documento"];
$path_file = $_GET["path_file"];


$sql = "DELETE FROM doc_paths WHERE path_file='".$path_file."'";
if ($db->query($sql) === TRUE) {
	
} 
header("Location: detalle_dcto.php?cod_documento=$cod_documento");
exit;
 }
}
else
{
header("Location:../login.php");
}
?>
