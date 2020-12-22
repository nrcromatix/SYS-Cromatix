<?php
include "connect.php";

$id_categoria = $_GET["id_categoria"];

$sql = "DELETE FROM categorias WHERE id_categoria='$id_categoria'";

if ($db->query($sql) === TRUE) {
header("Location: categorias.php");
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}

exit;
?>
