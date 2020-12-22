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
$usuario = $_POST["usuario"];
$fecha = $_POST["fecha"];
$fecha=substr("$fecha", -4, 4)."-".substr("$fecha", -7, 2)."-".substr("$fecha", -10, 2)." 00:00:00";
$monto = $_POST["monto"];
if ($_SESSION["user"]<>'alesgare') { $monto=-1*abs($monto); }
$dias = $_POST["dias"];
$doc_ref = $_POST["doc_ref"];
$obs=strtoupper($_POST["observaciones"]);
$tipo = $_POST["tipo"];


$sql = "INSERT INTO rrhh (id_usuario, tipo, fecha, monto, dias, referencia, obs) VALUES ('".$usuario."', '".$tipo."', '".$fecha."','".$monto."','".$dias."','".$doc_ref."','".$obs."')";
if ($db->query($sql) === TRUE) {
header("Location: rrhh.php");
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
