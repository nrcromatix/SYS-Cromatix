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
$total_item = $_GET["total_item"];
$descuento_item = $_POST["descuento_item"];
$id_detalle = $_GET["id_detalle"];

$sql_n = "SELECT * FROM detalle_documento WHERE cod_documento='".$cod_documento."' AND id_detalle='".$id_detalle."'";
$result_n = $db->query($sql_n);
if ($result_n->num_rows > 0) {
	while($row_n = $result_n->fetch_assoc()) {
$desc_ant=$row_n["descuento"];
$diff_dctos=$total_item*($desc_ant-$descuento_item)/100;
}}


$sql2 = "UPDATE documentos SET dcto_total_items=dcto_total_items-'".$diff_dctos."' WHERE cod_documento='".$cod_documento."'";
if ($db->query($sql2) === TRUE) {

} else {
echo "Error: " . $sql . "<br>" . $db->error;
}


$sql = "UPDATE detalle_documento SET descuento='".$descuento_item."' WHERE cod_documento='".$cod_documento."' AND id_detalle='".$id_detalle."'";
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
