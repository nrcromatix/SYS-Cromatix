<?php
include "connect.php";

$cod_producto = $_GET["cod_producto"];

$sql="INSERT INTO productos (nombre, costo_neto, precio_real_venta, desc_comercial, cod_proveedor, estado, tipo_prod, categoria, imagen, u_medida, zoma, descripcion, costo_usd, costo_eur, cod_pdcto_proveedor, nombre_pdcto_proveedor, temperatura, consumo, dimension, lumens, ip, ik, factor_ddp, peso, ekit, input_volt, eficiencia, tipo_control, driver, color_luz, color_equipo, moneda_origen, description) SELECT CONCAT(nombre,'(COPIA)'), costo_neto, precio_real_venta, desc_comercial, cod_proveedor, estado, tipo_prod, categoria, imagen, u_medida, zoma, descripcion, costo_usd, costo_eur, cod_pdcto_proveedor, nombre_pdcto_proveedor, temperatura, consumo, dimension, lumens, ip, ik, factor_ddp, peso, ekit, input_volt, eficiencia, tipo_control, driver, color_luz, color_equipo, moneda_origen, description FROM productos WHERE id_producto='$cod_producto'";


if ($db->query($sql) === TRUE) {
header("Location: busca_producto.php");
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}
?>
