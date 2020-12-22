<?php
include "connect.php";

$id_mov = $_GET["id_mov"];

$sql2 = "SELECT * FROM mov_inventario WHERE id_mov='".$id_mov."'";
$result2 = $db->query($sql2);
if ($result2->num_rows > 0) {
	while($row = $result2->fetch_assoc()) {
$cod_producto=$row["cod_pdcto"];
$diferencia=$row["diferencia_inventario"];
    }
} else {
    
}

$query4="UPDATE productos SET stock=stock-'$diferencia' WHERE id_producto='$cod_producto'";

if ($db->query($query4) === TRUE) {
} else {
echo "Error: " . $query4 . "<br>" . $db->error;
}



$sql = "DELETE FROM mov_inventario WHERE id_mov='$id_mov'";

if ($db->query($sql) === TRUE) {
header("Location: ver_duplicidad.php");
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}

exit;
?>
