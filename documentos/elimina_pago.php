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
$id_pago = $_GET["id_pago"];


$sql = "DELETE FROM info_pago WHERE id_pago='".$id_pago."'";
if ($db->query($sql) === TRUE) {
	$sql_t = "UPDATE documentos SET total_venta=total_venta-'".$monto_total_venta."', total_venta_neto=total_venta_neto-'".$monto_total_venta_neto."' WHERE cod_documento='".$cod_documento."'";

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
