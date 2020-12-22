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
$fecha = $_POST["fecha"];
$monto = $_POST["monto"];
$obs=strtoupper($_POST["obs"]);
$medio_pago = $_POST["medio_pago"];
$fecha=substr("$fecha", -4, 4)."-".substr("$fecha", -7, 2)."-".substr("$fecha", -10, 2)." 00:00:00";
$sql = "INSERT INTO info_pago (cod_documento, fecha, obs, monto, medio_pago) VALUES ('".$cod_documento."', '".$fecha."', '".$obs."','".$monto."','".$medio_pago."')";
if ($db->query($sql) === TRUE) {
	$last_id = $db->insert_id;
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
