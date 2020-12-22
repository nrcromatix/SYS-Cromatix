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
$id_pago = $_GET["id_pago"];

$sql = "DELETE FROM rrhh WHERE id_pago ='".$id_pago."'";
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
