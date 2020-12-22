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
$tipo = $_POST["tipo_dcto"];
$current_date=date("Y-m-d");
$fecha_ultima_modificacion=substr("$current_date", -10, 4)."-".substr("$current_date", -5, 2)."-".substr("$current_date", -2, 2)." 00:00:00";	
$sql = "INSERT INTO documentos (tipo, id_vendedor, estado, fecha_creacion)
VALUES ('".$tipo."', '".$_SESSION['user_id']."', '0', '".$fecha_ultima_modificacion."')";
if ($db->query($sql) === TRUE) {
	$last_id = $db->insert_id;
header("Location: detalle_dcto.php?cod_documento=$last_id");
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
