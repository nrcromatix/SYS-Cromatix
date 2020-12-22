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
$cod_producto = $_GET["cod_producto"];
$id_detalle = $_GET["id_detalle"];
$tipo = $_GET["tipo"];

$current_date=date("Y-m-d");
$fecha_ultima_modificacion=substr("$current_date", -10, 4)."-".substr("$current_date", -5, 2)."-".substr("$current_date", -2, 2)." 00:00:00";


//NOMBRE
$sql_n = "SELECT * FROM detalle_documento WHERE cod_documento='".$cod_documento."' AND id_detalle='".$id_detalle."'";
$result_n = $db->query($sql_n);
if ($result_n->num_rows > 0) {
	while($row_n = $result_n->fetch_assoc()) {
$monto_total_venta_neto=$row_n["monto_total_venta"];	
$monto_total_venta=round($row_n["monto_total_venta"]*1.19);
$cantidad=$row_n["cantidad"];
$cod_producto=$row_n["cod_producto"];
    }
} else {
    
}

//REBAJA DE INVENTARIO

if ($tipo=="BOLETA" OR $tipo=="GUIA") {	
	if ($tipo=="NOTA DE CREDITO") { $cantidad_dif=-1*$cantidad; } else { $cantidad_dif=$cantidad; } //MODIFICAR DESPUES PARA GUIA DE DEVOLUCION
$sql_ri = "UPDATE productos SET stock=stock+'".$cantidad_dif."' WHERE id_producto='".$cod_producto."'";
if ($db->query($sql_ri) === TRUE)
{} 
else {
echo "Error: " . $sql_ri . "<br>" . $db->error;
}
}

//HISTORICO DE INVENTARIO

if ($tipo=="BOLETA" OR $tipo=="GUIA") {	
if ($tipo=="NOTA DE CREDITO") { $cantidad_dif=-1*$cantidad; } else { $cantidad_dif=$cantidad; } //MODIFICAR DESPUES PARA GUIA DE DEVOLUCION
$sql_hi = "INSERT INTO mov_inventario (fecha_mov, cod_pdcto, cod_documento, diferencia_inventario, tipo_mod, usuario)
VALUES ('".$fecha_ultima_modificacion."', '".$cod_producto."', '".$cod_documento."', '".$cantidad_dif."', 'VENTAS / INGRESO DOCUMENTO', '".$_SESSION['user_id']."')";
if ($db->query($sql_hi) === TRUE)
{} 
else {
echo "Error: " . $sql_hi . "<br>" . $db->error;
}
}

$sql = "DELETE FROM detalle_documento WHERE cod_documento='".$cod_documento."' AND id_detalle='".$id_detalle."'";
if ($db->query($sql) === TRUE) {
	$sql_t = "UPDATE documentos SET total_venta=total_venta-'".$monto_total_venta."', total_venta_neto=total_venta_neto-'".$monto_total_venta_neto."' WHERE cod_documento='".$cod_documento."'";
if ($db->query($sql_t) === TRUE) {
header("Location: detalle_dcto.php?cod_documento=$cod_documento");
exit;
}
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
