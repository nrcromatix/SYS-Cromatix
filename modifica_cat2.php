<?php
include "connect.php";

$id_cat = $_GET["id_cat"];
$nombre_cat = $_POST["nombre_cat"];
$parent_cat = $_POST["parent_cat"];

$sql = "UPDATE categorias SET nombre_cat='$nombre_cat', parent_cat='$parent_cat' WHERE id_categoria='$id_cat'";

if ($db->query($sql) === TRUE) {
header("Location: categorias.php");
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}

exit;
?>
