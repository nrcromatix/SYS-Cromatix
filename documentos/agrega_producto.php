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
$cod_producto = $_POST["cod_producto"];
$cantidad = $_POST["cantidad"];

$current_date=date("Y-m-d");
$fecha_ultima_modificacion=substr("$current_date", -10, 4)."-".substr("$current_date", -5, 2)."-".substr("$current_date", -2, 2)." 00:00:00";

//REBAJA DE INVENTARIO

if ($tipo=="BOLETA" OR $tipo=="GUIA") {	
	if ($tipo=="NOTA DE CREDITO") { $cantidad_dif=$cantidad; } else { $cantidad_dif=-1*$cantidad; } //MODIFICAR DESPUES PARA GUIA DE DEVOLUCION
$sql_ri = "UPDATE productos SET stock=stock+'".$cantidad_dif."' WHERE id_producto='".$cod_producto."'";
if ($db->query($sql_ri) === TRUE)
{} 
else {
echo "Error: " . $sql_ri . "<br>" . $db->error;
}
}

//HISTORICO DE INVENTARIO

if ($tipo=="BOLETA" OR $tipo=="GUIA") {	
if ($tipo=="NOTA DE CREDITO") { $cantidad_dif=$cantidad; } else { $cantidad_dif=-1*$cantidad; }	//MODIFICAR DESPUES PARA GUIA DE DEVOLUCION
$sql_hi = "INSERT INTO mov_inventario (fecha_mov, cod_pdcto, cod_documento, diferencia_inventario, tipo_mod, usuario)
VALUES ('".$fecha_ultima_modificacion."', '".$cod_producto."', '".$cod_documento."', '".$cantidad_dif."', 'VENTAS / INGRESO DOCUMENTO', '".$_SESSION['user_id']."')";
if ($db->query($sql_hi) === TRUE)
{} 
else {
echo "Error: " . $sql_hi . "<br>" . $db->error;
}
}


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
$monto_unitario=$costo_usd;	$dec=2;
	}

else { $monto_unitario=round(round($precio,0)/1.19,0); $dec=0;}

$monto_total=round($monto_unitario,$dec)*$cantidad;
$monto_total_bruto=$monto_total*1.19;

//echo $monto_unitario."<br>";
//echo $cantidad."<br>";
//echo $monto_total;
//exit;

$sql = "INSERT INTO detalle_documento (cod_documento, cod_producto, cantidad, monto_unitario_venta, monto_total_venta, costo_venta_unitario)
VALUES ('".$cod_documento."', '".$cod_producto."', '".$cantidad."', '".$monto_unitario."', '".$monto_total."', '".$costo_neto."')";
if ($db->query($sql) === TRUE) {
	
$sql_t = "UPDATE documentos SET total_venta=total_venta+'".$monto_total_bruto."', total_venta_neto=total_venta_neto+'".$monto_total."' WHERE cod_documento='".$cod_documento."'";
if ($db->query($sql_t) === TRUE) {
header('Location: ' . $_SERVER["HTTP_REFERER"] );
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
