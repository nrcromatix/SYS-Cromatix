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
$tipo = $_GET["tipo"];
$cod_producto = $_GET["cod_producto"];
$cantidad=0;

//PRECIO Y COSTO

$sql2 = "SELECT * FROM productos WHERE id_producto='".$cod_producto."'";
$result2 = $db->query($sql2);
if ($result2->num_rows > 0) {
	while($row = $result2->fetch_assoc()) {
$costo_neto=$row["costo_neto"];
$precio=$row["precio_real_venta"];
$costo_usd=$row["costo_usd"];
    }
} else {
    echo "0 results";
}
if ($tipo=="ORDEN DE COMPRA" OR $tipo=="RFQ" OR $tipo=="FACTURA DE COMPRA" OR $tipo=="QUOTATION") { 
$monto_unitario=round($costo_usd,2);	
	}
else { 
	
	$monto_unitario=round($precio/1.19,0); }
$monto_total=$monto_unitario*$cantidad;
$monto_total_bruto=$monto_total*1.19;
$sql = "INSERT INTO detalle_documento (cod_documento, cod_producto, cantidad, monto_unitario_venta, monto_total_venta, costo_venta_unitario)
VALUES ('".$cod_documento."', '".$cod_producto."', '".$cantidad."', '".$monto_unitario."', '".$monto_total."', '".$costo_neto."')";
if ($db->query($sql) === TRUE) {
	
$sql_t = "UPDATE documentos SET total_venta=total_venta+'".$monto_total_bruto."', total_venta_neto=total_venta_neto+'".$monto_total."' WHERE cod_documento='".$cod_documento."'";
if ($db->query($sql_t) === TRUE) {
header("Location: detalle_dcto.php?cod_documento=$cod_documento");
exit;
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}
exit;
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
