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
$stock_ing = $_POST["stock_ing"];
$stock_old = $_GET["stock_old"];
$id_detalle = $_GET["id_detalle"];

$current_date=date("Y-m-d");
$fecha_ultima_modificacion=substr("$current_date", -10, 4)."-".substr("$current_date", -5, 2)."-".substr("$current_date", -2, 2)." 00:00:00";

$diff_stock=$stock_ing-$stock_old;

$sql = "UPDATE productos SET stock=stock+'".$diff_stock."' WHERE id_producto='".$cod_producto."'";
if ($db->query($sql) === TRUE) {
}
 else {
echo "Error: " . $sql . "<br>" . $db->error;
}

$sql = "INSERT INTO mov_inventario (fecha_mov, cod_pdcto, cod_documento, diferencia_inventario, tipo_mod, usuario)
VALUES ('".$fecha_ultima_modificacion."', '".$cod_producto."', '".$cod_documento."', '".$diff_stock."', 'ADMIN / INGRESO OC', '".$_SESSION['user_id']."')";
if ($db->query($sql) === TRUE) {
}
 else {
echo "Error: " . $sql . "<br>" . $db->error;
}

$sql = "UPDATE detalle_documento SET stock_ing='".$stock_ing."' WHERE cod_documento='".$cod_documento."' AND id_detalle='".$id_detalle."'";
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
