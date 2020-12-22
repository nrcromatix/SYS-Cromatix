<?php
include "connect.php";

$nombre = $_POST["nombre"];
$nombre_proveedor = $_POST["nombre_proveedor"];
$categoria = $_POST["categoria"];
$prov = $_POST["prov"];

$sql = "INSERT INTO productos (nombre, nombre_pdcto_proveedor, categoria, cod_proveedor)
VALUES ('".$nombre."', '".$nombre_proveedor."', '".$categoria."', '".$prov."')";

if ($db->query($sql) === TRUE) {
header("Location: busca_producto.php");
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}

exit;
?>
