<?php
include "connect.php";

$nombre_cat = $_POST["nombre_cat"];
$parent_cat = $_POST["parent_cat"];

$sql = "INSERT INTO categorias (nombre_cat, parent_cat)
VALUES ('".$nombre_cat."', '".$parent_cat."')";

if ($db->query($sql) === TRUE) {
header("Location: categorias.php");
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}

exit;
?>
