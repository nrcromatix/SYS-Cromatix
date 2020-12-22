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

$current_date=date("Y-m-d");
$fecha_ultima_modificacion=substr("$current_date", -10, 4)."-".substr("$current_date", -5, 2)."-".substr("$current_date", -2, 2)." 00:00:00";


//COPIA DOCUMENTO
$sql="INSERT INTO documentos (dcto_total_items, tipo, id_vendedor,id_cliente, estado,fecha_creacion, fecha_emision, total_venta, e_numero_documento, id_pago, observaciones, referencia, entrega_real, entrega_comprometida, condicion, asociacion, concepto_compra, iva_extra, gastos_extra, total_venta_neto, entrega_bl, entrega_cif, entrega_ddp, dias_a_cif, dias_a_ddp, dias_a_bl, monto_descuento_neto, moneda, metodo, att, plazo_entrega, glosa_guia, cod_doc_ref) SELECT dcto_total_items, tipo, id_vendedor,id_cliente, 0 ,'".$fecha_ultima_modificacion."', fecha_emision, total_venta, e_numero_documento, id_pago, observaciones, referencia, entrega_real, entrega_comprometida, condicion, asociacion, concepto_compra, iva_extra, gastos_extra, total_venta_neto, entrega_bl, entrega_cif, entrega_ddp, dias_a_cif, dias_a_ddp, dias_a_bl, monto_descuento_neto, moneda, metodo, att, plazo_entrega, glosa_guia, cod_doc_ref FROM documentos WHERE cod_documento='$cod_documento'";
if ($db->query($sql) === TRUE) {

} 

$last_id_doc = $db->insert_id;


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


$sql_pro = "INSERT INTO detalle_documento (cod_documento, cod_producto, cantidad, monto_unitario_venta, monto_total_venta, costo_venta_unitario, item, orden, descuento) VALUES ('$last_id_doc', '$cod_producto_2', '$cantidad_2', '$monto_unitario_venta_2', '$monto_total_venta_2', '$costo_venta_unitario_2', '$item_2', '$orden_2', '$descuento_2')";
if ($db->query($sql_pro) === TRUE) {  } 
else {
    echo "Error: " . $sql_pro . "<br>" . $db->error;
}

}
}



header("Location: documentos.php");

exit;
 }
}
else
{
header("Location:../login.php");
}
?>
