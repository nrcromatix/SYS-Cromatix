<?php
session_start();
if(isset($_SESSION["user"]))
{
 if((time() - $_SESSION['last_time']) > 86400) // Time in Seconds // UN DIA
 {
header("Location:logout.php");
 }
 else
 {  $_SESSION['last_time'] = time();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../stylesheet.css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script type="text/javascript">
</script>
</head>
<?php
include "connect.php";
?>
<body>	
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?php include "header.php";?>
</table>	
<ul>												
		
		
		
		


			<h1>Lista de Facturas a Crédito, Pdtes. de Pago (300 MAX)</h1>
			
			<table class="tablaprod" border="1">
	<tr>
		<th>Cod</th>
		<th>Tipo Documento</th>
		<th>Cliente/Proveedor</th>
		<th>Referencia</th>
		<th>Vendedor</th>
		<th>Fecha Creacion</th>
		<th>Numero Documento</th>
		<th>Monto Total</th>
		<th>Estado</th>
		
		
		</tr>
		
		<?php 


$filtro_estado = $_POST["filtro_estado"];
$tipo_dcto_filtro = $_POST["tipo_dcto_filtro"];
$cod_doc_filtro = $_POST["cod_doc_filtro"];
$num_doc_filtro = $_POST["num_doc_filtro"];

$sql = "SELECT * FROM documentos WHERE estado=3";
if ($filtro_estado=="") { $sql .= "  "; }
else { $sql .= " WHERE estado='$filtro_estado' "; }
if ($nivelper==4) { $sql .= " AND id_vendedor='$id_vendedor' "; }
$sql .= " AND tipo='FACTURA'";
            if ($cod_doc_filtro<>"") { $sql .= " AND cod_documento='$cod_doc_filtro' "; }
            if ($num_doc_filtro<>"") { $sql .= " AND e_numero_documento='$num_doc_filtro' "; }
$sql .= "ORDER BY cod_documento DESC LIMIT 300";
$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row2 = $result->fetch_assoc()) {
		$cod_documento=$row2["cod_documento"];
$tipo=$row2["tipo"];
$id_vendedor=$row2["id_vendedor"];
$id_cliente=$row2["id_cliente"];
$estado=$row2["estado"];
$fecha_creacion=substr($row2["fecha_creacion"],0,10);
$fecha_emision=$row2["fecha_emision"];
$total_venta=$row2["total_venta"];
$total_venta_neto=$row2["total_venta_neto"];
$e_numero_documento=$row2["e_numero_documento"];
$id_pago=$row2["id_pago"];
$observaciones=$row2["observaciones"];
$referencia=$row2["referencia"];
$monto_descuento_neto=round($row2["monto_descuento_neto"]);

if ($estado==0) {$estado_text="PENDIENTE";}
if ($estado==1) {$estado_text="EMITIDA";}
if ($estado==2) {$estado_text="ACEPTADA";}
if ($estado==3) {$estado_text="CREDITO";}
if ($estado==4) {$estado_text="ELIMINADA";}
if ($estado==5) {$estado_text="RETIRO";}

if ($total_venta_neto==0) {
	
	$total_venta=$total_venta-$monto_descuento_neto*1.19;
	$total_neto=$total_venta/1.19;
	$iva=$total_venta-$total_neto;

}

else {
	
	$total_neto=$total_venta_neto-$monto_descuento_neto;
	$total_venta=round($total_neto*1.19);
	$iva=$total_venta-$total_neto;
	
	}

//CONSULTA CLIENTE/PROV
$sql2 = "SELECT * FROM directorio WHERE cod_directorio='".$id_cliente."'";
$result2 = $db->query($sql2);
if ($result2->num_rows > 0) {
	while($row = $result2->fetch_assoc()) {
$nombre=$row["nombre"];
    }
} else {
   $nombre="";
}

//CONSULTA USER
$sqlus = "SELECT * FROM directorio WHERE cod_directorio='".$id_vendedor."'";
$resultus = $db->query($sqlus);
if ($resultus->num_rows > 0) {
	while($row_us = $resultus->fetch_assoc()) {
$nombre_vendedor=$row_us["nombre"];
    }
}

$now = time(); // or your date as well
$your_date = strtotime($fecha_creacion);
$datediff = $now - $your_date;
$datediff=round($datediff / (60 * 60 * 24));


?>
<tr <?php if($datediff>9 && $estado=="0") { echo "bgcolor='#ff8080'";} ?></tr>
		<td><a href="/documentos/detalle_dcto.php?cod_documento=<?php echo $cod_documento; ?>"><?php echo $cod_documento; ?></a></td>
		<td><?php echo $tipo; ?></td>
		<td><?php echo $nombre; ?></td>
		<td><?php echo $referencia; ?></td>
		<td><?php echo $nombre_vendedor; ?></td>
		<td><?php echo $fecha_creacion; ?></td>
		<td><?php echo $e_numero_documento; ?></td>
		<?php if ($tipo<>"FACTURA EXENTA" AND $tipo<>"FACTURA DE COMPRA EX" AND $tipo<>"ORDEN DE COMPRA") {
		?>
		<td align="right"><?php echo "$ ".number_format($total_venta, 0, ",", "."); ?></td>
		<?php	} else { ?>
		<td align="right"><?php echo "$ ".number_format($total_neto, 0, ",", "."); ?></td>
		<?php } ?>
		<td><?php echo $estado_text; ?></td>
</tr>
<?php


    }
} else {
    echo "0 results";
}

?>
		
		</table>

<h1>Lista de Ultimos Pagos Realizados (100 MAX)</h1>
			


			<table class="tablaprod" border="1">
	<tr>
		<th>Cod</th>
		<th>Tipo Documento</th>
		<th>Cliente/Proveedor</th>
		<th>Referencia</th>
		<th>Fecha Creacion</th>
		<th>Numero Documento</th>
		<th>Monto Total</th>
<th>Fecha Pago</th>
		<th>Total Pagado</th>
<th>Medio Pago</th>
<th>Vendedor</th>
		<th>Estado</th>
		
		
		</tr>
		
		<?php 


$sqlf = "SELECT info_pago.id_pago, info_pago.fecha, info_pago.monto, info_pago.medio_pago, info_pago.obs, info_pago.cod_documento, "; 
$sqlf .= " documentos.cod_documento, documentos.estado, documentos.tipo, documentos.total_venta_neto, documentos.id_cliente, documentos.referencia, documentos.fecha_creacion, documentos.e_numero_documento, documentos.id_vendedor";
$sqlf .= " FROM info_pago";
$sqlf .= " LEFT JOIN documentos ON documentos.cod_documento = info_pago.cod_documento WHERE documentos.tipo='FACTURA' OR documentos.tipo='NOTA DE CREDITO'";
$sqlf .= " ORDER BY info_pago.fecha DESC LIMIT 100;";

$resultf = $db->query($sqlf);
if ($resultf->num_rows > 0) {
	while($rowf = $resultf->fetch_assoc()) {
		
$cod_documento=$rowf["cod_documento"];
$tipo=$rowf["tipo"];
$id_vendedor=$rowf["id_vendedor"];
$id_cliente=$rowf["id_cliente"];
$estado=$rowf["estado"];
$fecha_creacion=substr($rowf["fecha_creacion"],0,10);
$fecha=substr($rowf["fecha"],0,10);
$fecha_emision=$rowf["fecha_emision"];
$total_venta=$rowf["total_venta"];
$medio_pago=$rowf["medio_pago"];
$total_venta_neto=$rowf["total_venta_neto"];
$monto=$rowf["monto"];
$e_numero_documento=$rowf["e_numero_documento"];
$id_pago=$rowf["id_pago"];
$id_vendero=$rowf["id_vendedor"];
$observaciones=$rowf["observaciones"];
$referencia=$rowf["referencia"];
$monto_descuento_neto=round($rowf["monto_descuento_neto"]);



if ($estado==0) {$estado_text="PENDIENTE";}
if ($estado==1) {$estado_text="EMITIDA";}
if ($estado==2) {$estado_text="ACEPTADA";}
if ($estado==3) {$estado_text="CREDITO";}
if ($estado==4) {$estado_text="ELIMINADA";}
if ($estado==5) {$estado_text="RETIRO";}

if ($total_venta_neto==0) {
	
	$total_venta=$total_venta-$monto_descuento_neto*1.19;
	$total_neto=$total_venta/1.19;
	$iva=$total_venta-$total_neto;

}

else {
	
	$total_neto=$total_venta_neto-$monto_descuento_neto;
	$total_venta=round($total_neto*1.19);
	$iva=$total_venta-$total_neto;
	
	}

if ($total_venta<>$monto) { $color_alerta="DeepSkyBlue"; } else { $color_alerta="LightGreen";  }
if ($tipo=="NOTA DE CREDITO") { $color_alerta="LightCoral"; }

//CONSULTA CLIENTE/PROV
$sql2 = "SELECT * FROM directorio WHERE cod_directorio='".$id_cliente."'";
$result2 = $db->query($sql2);
if ($result2->num_rows > 0) {
	while($row = $result2->fetch_assoc()) {
$nombre=$row["nombre"];
    }
} else {
   $nombre="";
}

//CONSULTA USUARIO
$sql5 = "SELECT * FROM directorio WHERE cod_directorio='".$id_vendedor."'";
$result5 = $db->query($sql5);
if ($result5->num_rows > 0) {
	while($row5 = $result5->fetch_assoc()) {
$nombre_v=$row5["nombre"];
    }
} else {
   $nombre_v="";
}

$now = time(); // or your date as well
$your_date = strtotime($fecha_creacion);
$datediff = $now - $your_date;
$datediff=round($datediff / (60 * 60 * 24));


?>
<tr <?php if($datediff>9 && $estado=="0") { echo "bgcolor='#ff8080'";} ?></tr>
		<td><a href="/documentos/detalle_dcto.php?cod_documento=<?php echo $cod_documento; ?>"><?php echo $cod_documento; ?></a></td>
		<td><?php echo $tipo; ?></td>
		<td><?php echo $nombre; ?></td>
		<td><?php echo $referencia; ?></td>
		<td><?php echo $fecha_creacion; ?></td>
		<td><?php echo $e_numero_documento; ?></td>
		<?php if ($tipo<>"FACTURA EXENTA" AND $tipo<>"FACTURA DE COMPRA EX" AND $tipo<>"ORDEN DE COMPRA") {
		?>
		<td align="right"><?php echo "$ ".number_format($total_venta, 0, ",", "."); ?></td>
		<?php	} else { ?>
		<td align="right"><?php echo "$ ".number_format($total_neto, 0, ",", "."); ?></td>
		<?php } ?>
<td><?php echo $fecha; ?></td>
		<td bgcolor="<?php echo $color_alerta; ?>" align="right"><?php echo "$ ".number_format($monto, 0, ",", "."); ?></td>
<td><?php echo $medio_pago; ?></td>
<td><?php echo $nombre_v; ?></td>
		<td><?php echo $estado_text; ?></td>
</tr>
<?php


    }
} else {
    echo "0 results";
}

?>
		
		</table>





			
</ul>	
	</body>
</html>
<?php
 }
}
else
{
header("Location:login.php");
}
?>
