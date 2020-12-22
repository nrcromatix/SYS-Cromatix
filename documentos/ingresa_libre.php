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
$nombre_producto = $_POST["nombre_producto"];
$nombre_producto=strtoupper($nombre_producto);
$nombre_fabrica = strtoupper($_POST["nombre_fabrica"]);
$precio = $_POST["precio"];
$cantidad = $_POST["cantidad"];
$descr = strtoupper($_POST["descr"]);
$current_date=date("Y-m-d");
$precio_real_venta=round($precio*1.19);

$fecha_ultima_modificacion=substr("$current_date", -10, 4)."-".substr("$current_date", -5, 2)."-".substr("$current_date", -2, 2)." 00:00:00";	

if ($tipo<>"ORDEN DE COMPRA" AND $tipo<>"RFQ") {

$total=round($cantidad*$precio);

$sql = "INSERT INTO productos (nombre, precio_real_venta,tipo_prod, descripcion, nombre_pdcto_proveedor)
VALUES ('".$nombre_producto."', '".$precio_real_venta."','1','".$descr."','".$nombre_fabrica."')";
if ($db->query($sql) === TRUE) {
	$last_id = $db->insert_id;
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}



} // TERMINO DE IF DISTINTO O/C

if ($tipo=="ORDEN DE COMPRA" OR $tipo=="RFQ") {
	
	$total=$cantidad*$precio;	
	
	$sql = "INSERT INTO productos (nombre, costo_usd,tipo_prod, description, nombre_pdcto_proveedor)
VALUES ('".$nombre_producto."', '".$precio."','1','".$descr."','".$nombre_fabrica."')";
if ($db->query($sql) === TRUE) {
	$last_id = $db->insert_id;
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}


	
	}


 }

$costo=round($precio*0.7);

$monto_total_bruto=round($total*1.19);

$sql = "INSERT INTO detalle_documento (cod_documento, cod_producto, cantidad, monto_unitario_venta, monto_total_venta, costo_venta_unitario)
VALUES ('".$cod_documento."', '".$last_id."', '".$cantidad."', '".$precio."', '".$total."', '".$costo."')";
if ($db->query($sql) === TRUE) {
	$sql_t = "UPDATE documentos SET total_venta=total_venta+'".$monto_total_bruto."', total_venta_neto=total_venta_neto+'".$total."' WHERE cod_documento='".$cod_documento."'";
if ($db->query($sql_t) === TRUE) {
header("Location: detalle_dcto.php?cod_documento=$cod_documento");
exit;
}
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}
exit;
 }
else
{
header("Location:../login.php");
}
?>
