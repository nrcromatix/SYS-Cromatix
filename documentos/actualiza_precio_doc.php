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
$td = $_GET["tipo"];

$current_date=date("Y-m-d");
$fecha_ultima_modificacion=substr("$current_date", -10, 4)."-".substr("$current_date", -5, 2)."-".substr("$current_date", -2, 2)." 00:00:00";

$new_total_venta=0;
$new_monto_dcto_item=0;

//INSERTA PRODUCTOS AL NUEVO DOCUMENTO:

$sql3 = "SELECT * FROM detalle_documento WHERE cod_documento='".$cod_documento."'";
$result3 = $db->query($sql3);
if ($result3->num_rows > 0) {
while($row = $result3->fetch_assoc()) {
$cod_producto_2=$row["cod_producto"];
$cantidad_2=$row["cantidad"];
$monto_unitario_venta_2=$row["monto_unitario_venta"];
$monto_total_venta_2=$row["monto_total_venta"];
$costo_venta_unitario_2=$row["costo_venta_unitario"];
$item_2=$row["item"];
$orden_2=$row["orden"];
$id_detalle_2=$row["id_detalle"];
$descuento_2=$row["descuento"];

$sql_update = "SELECT * FROM productos WHERE id_producto='".$cod_producto_2."'";
$result5 = $db->query($sql_update);
if ($result5->num_rows > 0) {
while($row2 = $result5->fetch_assoc()) {
$id_producto=$row2["id_producto"];
$costo_neto=$row2["costo_neto"];
$costo_usd=$row2["costo_usd"];
$precio_real_venta=$row2["precio_real_venta"];
$moneda_origen=$row2["moneda_origen"];
 } 
}

if ($td<>"ORDEN DE COMPRA" AND $td<>"RFQ" AND $td<>"FACTURA DE COMPRA" AND $td<>"FACTURA DE COMPRA EX") {

$new_monto_unitario=round($precio_real_venta/1.19,0);
$new_monto_total=$new_monto_unitario*$cantidad_2;

//if ($moneda_origen<>"CLP") { $mult=1.4; } else { $mult=1; }



$new_costo_neto=$costo_neto;

$new_monto_dcto_item=$new_monto_dcto_item+round($descuento_2/100*$new_monto_total,0);

$new_total_venta=$new_total_venta+round($new_monto_total,0);

}

else {
	
$new_monto_unitario=$costo_usd;
$new_monto_total=$new_monto_unitario*$cantidad_2;
$new_costo_neto=$costo_usd;

$new_monto_dcto_item=$new_monto_dcto_item+round($descuento_2/100*$new_monto_total,2);

$new_total_venta=$new_total_venta+round($new_monto_total,2);
	
	}

$sql_pro = "UPDATE detalle_documento SET monto_unitario_venta='".$new_monto_unitario."', monto_total_venta='".$new_monto_total."', costo_venta_unitario='".$new_costo_neto."' WHERE cod_documento='".$cod_documento."' AND cod_producto='".$cod_producto_2."' AND id_detalle='".$id_detalle_2."' ";
if ($db->query($sql_pro) === TRUE) {  } 
else {
    echo "Error: " . $sql_pro . "<br>" . $db->error;
}

}
}

$sql_tot = "UPDATE documentos SET total_venta_neto='".$new_total_venta."', dcto_total_items='".$new_monto_dcto_item."' WHERE cod_documento='".$cod_documento."' ";
if ($db->query($sql_tot) === TRUE) {  } 
else {
    echo "Error: " . $sql_tot . "<br>" . $db->error;
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
