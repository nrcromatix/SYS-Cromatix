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
$condicion = strtoupper($_POST["condicion"]);
$entrega_real = $_POST["entrega_real"];
$entrega_real=substr("$entrega_real", -4, 4)."-".substr("$entrega_real", -7, 2)."-".substr("$entrega_real", -10, 2)." 00:00:00";	
$entrega_comprometida = $_POST["entrega_comprometida"];
$entrega_comprometida=substr("$entrega_comprometida", -4, 4)."-".substr("$entrega_comprometida", -7, 2)."-".substr("$entrega_comprometida", -10, 2)." 00:00:00";	
$entrega_bl = $_POST["entrega_bl"];
$entrega_bl=substr("$entrega_bl", -4, 4)."-".substr("$entrega_bl", -7, 2)."-".substr("$entrega_bl", -10, 2)." 00:00:00";	
$entrega_cif = $_POST["entrega_cif"];
$entrega_cif=substr("$entrega_cif", -4, 4)."-".substr("$entrega_cif", -7, 2)."-".substr("$entrega_cif", -10, 2)." 00:00:00";	
$entrega_ddp = $_POST["entrega_ddp"];
$entrega_ddp=substr("$entrega_ddp", -4, 4)."-".substr("$entrega_ddp", -7, 2)."-".substr("$entrega_ddp", -10, 2)." 00:00:00";	
$dias_a_ddp = $_POST["dias_a_ddp"];
$dias_a_cif = $_POST["dias_a_cif"];
$dias_a_bl = $_POST["dias_a_bl"];
$metodo = $_POST["metodo"];

$sql = "UPDATE documentos SET metodo='".$metodo."', entrega_cif='".$entrega_cif."', entrega_bl='".$entrega_bl."', entrega_ddp='".$entrega_ddp."', dias_a_bl='".$dias_a_bl."', dias_a_ddp='".$dias_a_ddp."', dias_a_cif='".$dias_a_cif."', condicion='".$condicion."', entrega_real='".$entrega_real."', entrega_comprometida='".$entrega_comprometida."' WHERE cod_documento='".$cod_documento."'";
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
