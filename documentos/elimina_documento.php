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
$td = $_GET["td"];


$sql = "UPDATE documentos SET doc_".$td."='' WHERE cod_documento='".$cod_documento."'";
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
