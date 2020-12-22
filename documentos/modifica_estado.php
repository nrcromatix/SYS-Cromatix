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
$estado = $_POST["estado"];

$current_date=date("Y-m-d");
$fecha_ultima_modificacion=substr("$current_date", -10, 4)."-".substr("$current_date", -5, 2)."-".substr("$current_date", -2, 2)." 00:00:00";


//ACTUALIZA INVENTARIO
//________________________________

//DEVUELVE-SACA MERCADERIA

// ---> Consulta datos de documento:
$sql_n = "SELECT * FROM documentos WHERE cod_documento='".$cod_documento."'";
$result_n = $db->query($sql_n);
if ($result_n->num_rows > 0) {
	while($row_n = $result_n->fetch_assoc()) {
$tipo=$row_n["tipo"];	
$estado_old=$row_n["estado"];	
    }
} else {
}

// ---> Comienza IF:

if ($tipo=="GUIA") {	

//if ($estado==0) {$estado_text="PENDIENTE";}
//if ($estado==1) {$estado_text="EMITIDA";}
//if ($estado==4) {$estado_text="ELIMINADA";}
//if ($estado==2) {$estado_text="ACEPTADA";} 
//if ($estado==3) {$estado_text="CREDITO";}
//if ($estado==5) {$estado_text="REVISION";} 

if (($estado_old=="0" OR $estado_old=="1" OR $estado_old=="3") AND $estado=="4") {
	
	//REINGRESAR TODO AL STOCK
	
$sql3 = "SELECT * FROM detalle_documento WHERE cod_documento='".$cod_documento."' ORDER BY orden DESC, id_detalle ASC";
$result3 = $db->query($sql3);
if ($result3->num_rows > 0) {
while($row = $result3->fetch_assoc()) {
$cod_producto_dif=$row["cod_producto"];
$cantidad_dif=$row["cantidad"];
$monto_unitario_venta=$row["monto_unitario_venta"];
$monto_total_venta=$row["monto_total_venta"];
$item=$row["item"];
$orden=$row["orden"];
$id_detalle=$row["id_detalle"];

$sql_ri = "UPDATE productos SET stock=stock+'".$cantidad_dif."' WHERE id_producto='".$cod_producto_dif."'";
if ($db->query($sql_ri) === TRUE)
{} 
// HISTORICOS:
$sql_hi = "INSERT INTO mov_inventario (fecha_mov, cod_pdcto, cod_documento, diferencia_inventario, tipo_mod, usuario)
VALUES ('".$fecha_ultima_modificacion."', '".$cod_producto_dif."', '".$cod_documento."', '".$cantidad_dif."', 'VENTAS / CAMBIO ESTADO DOCUMENTO', '".$_SESSION['user_id']."')";
if ($db->query($sql_hi) === TRUE)
{} 

}
}

	
	
	//
	
	}
	
else if (($estado=="0" OR $estado=="1" OR $estado=="3") AND $estado_old=="4") {
	
	//SACAR TODO DEL STOCK
	
	$sql3 = "SELECT * FROM detalle_documento WHERE cod_documento='".$cod_documento."' ORDER BY orden DESC, id_detalle ASC";
$result3 = $db->query($sql3);
if ($result3->num_rows > 0) {
while($row = $result3->fetch_assoc()) {
$cod_producto_dif=$row["cod_producto"];
$cantidad_dif=$row["cantidad"];
$monto_unitario_venta=$row["monto_unitario_venta"];
$monto_total_venta=$row["monto_total_venta"];
$item=$row["item"];
$orden=$row["orden"];
$id_detalle=$row["id_detalle"];

$sql_ri = "UPDATE productos SET stock=stock-'".$cantidad_dif."' WHERE id_producto='".$cod_producto_dif."'";
if ($db->query($sql_ri) === TRUE)
{} 
// HISTORICOS:
$sql_hi = "INSERT INTO mov_inventario (fecha_mov, cod_pdcto, cod_documento, diferencia_inventario, tipo_mod, usuario)
VALUES ('".$fecha_ultima_modificacion."', '".$cod_producto_dif."', '".$cod_documento."', -'".$cantidad_dif."', 'VENTAS / CAMBIO ESTADO DOCUMENTO', '".$_SESSION['user_id']."')";
if ($db->query($sql_hi) === TRUE)
{} 


}
}
	
	
	}
	//HISTORICO DE MOVIMIENTOS
	
	
	
	
	}


//HISTORICO DE MOVIMIENTOS





$sql = "UPDATE documentos SET estado='".$estado."' WHERE cod_documento='".$cod_documento."'";
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
