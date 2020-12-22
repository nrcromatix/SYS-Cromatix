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
$tipo = $_POST["tipo"];
$sql = "UPDATE documentos SET tipo='".$tipo."' WHERE cod_documento='".$cod_documento."'";
if ($db->query($sql) === TRUE) {
header("Location: detalle_dcto.php?cod_documento=$cod_documento");
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}
exit;
 }
}
else
{
header("Location:../login.php");
}
?>
