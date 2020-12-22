<?php

	 ini_set('session.cache_limiter','public');
session_cache_limiter(false);

session_start();
if(isset($_SESSION["user"]))
{
 if((time() - $_SESSION['last_time']) > 86400) // Time in Seconds // UN DIA
 {
header("Location:../logout.php");
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
include "../connect.php";
?>
<body>	
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?php include "../header.php";?>
</table>	
<ul>												
			<form name="formulario" method="post" action="crea_documento.php">					
					<select class="style1" name="tipo_dcto">
  <option value="COTIZACION">COTIZACION</option>
<?php if ($nivelper<>4) { ?> 
	 <option value="QUOTATION">QUOTATION</option>
 <option value="BOLETA">BOLETA</option>
  <option value="FACTURA">FACTURA</option>
  <option value="FACTURA EXENTA">FACTURA EXENTA</option>
  <option value="GUIA">GUIA DE DESPACHO</option>
  <option value="NOTA DE CREDITO">NOTA DE CREDITO</option>
  <option value="FACTURA DE COMPRA">FACTURA DE COMPRA</option>
  <option value="FACTURA DE COMPRA EX">FACTURA DE COMPRA EX</option>
  <option value="ORDEN DE COMPRA">ORDEN DE COMPRA</option>
  <option value="RFQ">RFQ</option> <?php } ?>
</select>		
				<input class="style1" type="submit" name="submit" value="Crear" />	
					</form>
					
					<h1>Filtro</h1>
					
				
		<form id="filtra" name="filtra" method="post" action="documentos.php">	
	<td>
							<select class="style1" name="tipo_dcto_filtro">
    <option value="">TODOS</option>
  <option value="COTIZACION">COTIZACION</option> <?php if ($nivelper<>4) { ?> 
  <option value="QUOTATION">QUOTATION</option>
  <option value="BOLETA">BOLETA</option>
  <option value="FACTURA">FACTURA</option>
  <option value="FACTURA EXENTA">FACTURA EXENTA</option>
  <option value="GUIA">GUIA DE DESPACHO</option>
  <option value="NOTA DE CREDITO">NOTA DE CREDITO</option>
  <option value="FACTURA DE COMPRA">FACTURA DE COMPRA</option>
  <option value="FACTURA DE COMPRA EX">FACTURA DE COMPRA EX</option>
  <option value="ORDEN DE COMPRA">ORDEN DE COMPRA</option>
  <option value="RFQ">RFQ</option> <?php } ?>
</select>	
	<select class="style1" name="filtro_estado" >
<option value="X" selected="selected">TODOS</option>
<option value="0" >PENDIENTE</option>
<option value="1" >EMITIDA</option>
<option value="2" >ACEPTADA</option>
<option value="3" >CREDITO</option>
<option value="4" >ELIMINADA</option>
<option value="5" >REVISION</option>
<option value="6" >ENVIADA</option>
<option value="7" >REVISION COMERCIAL</option>
</select>

	<select class="style1" name="filtro_glosa_guia" >
<option value="" selected="selected">TODOS</option>
<option value="VENTA" >VENTA</option>
<option value="TRASLADO" >TRASLADO</option>
<option value="CONSIGNACION" >CONSIGNACION</option>
<option value="RESERVA" >RESERVA</option>
<option value="REPUESTO" >REPUESTO</option>
<option value="DEFECTUOSO" >DEFECTUOSO</option>
</select>

<input  size="4" name="cod_doc_filtro" placeholder="Cod. Doc" class="style1" type="text" maxlength="255" value=""/>
<input  size="4" name="num_doc_filtro" placeholder="Num. Doc" class="style1" type="text" maxlength="255" value=""/>
<br>

<input  size="20" name="nombre_cliente_filtro" placeholder="Nombre Cliente" class="style1" type="text" maxlength="255" value=""/>
<input  size="20" name="rut_cliente_filtro" placeholder="RUT Cliente" class="style1" type="text" maxlength="255" value=""/>
<input  size="20" name="referencia_filtro" placeholder="Referencia" class="style1" type="text" maxlength="255" value=""/>

<input class="style1" type="submit" name="submit" value="Filtrar" />	
	 </td>
	 </form>
		
		
		


			<h1>Listado de Documentos (300 MAX)</h1>
			
			<table class="tablaprod" border="1">
	<tr>
		<th>Cod</th>
		<th>Tipo Documento</th>
		<th>ID Vendedor</th>
		<th>Cliente/Proveedor</th>
		<th>Referencia</th>
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
$nombre_cliente_filtro = $_POST["nombre_cliente_filtro"];
$rut_cliente_filtro = $_POST["rut_cliente_filtro"];
$referencia_filtro = $_POST["referencia_filtro"];
$filtro_glosa_guia = $_POST["filtro_glosa_guia"];

$sql = "SELECT directorio.cod_directorio, documentos.cod_documento, documentos.tipo, documentos.id_vendedor, documentos.id_cliente, documentos.estado, documentos.fecha_creacion, documentos.fecha_emision, documentos.total_venta, documentos.total_venta_neto, documentos.e_numero_documento, documentos.referencia, documentos.monto_descuento_neto, documentos.dcto_total_items, documentos.id_pago, documentos.observaciones, documentos.glosa_guia FROM documentos LEFT JOIN directorio ON documentos.id_cliente=directorio.cod_directorio ";
if ($filtro_estado=="") { $sql .= " WHERE documentos.estado=0 "; }
else if ($filtro_estado=="X") { $sql .= " WHERE documentos.estado<>4 "; }
else { $sql .= " WHERE documentos.estado='$filtro_estado' "; }
if ($nivelper==4) { $sql .= " AND documentos.id_vendedor='$id_vendedor' "; }
if ($tipo_dcto_filtro<>"") { $sql .= " AND documentos.tipo='$tipo_dcto_filtro' "; }
if ($filtro_glosa_guia<>"") { $sql .= " AND documentos.glosa_guia='$filtro_glosa_guia' "; }

            if ($cod_doc_filtro<>"") { $sql .= " AND documentos.cod_documento='$cod_doc_filtro' "; }
            if ($num_doc_filtro<>"") { $sql .= " AND documentos.e_numero_documento='$num_doc_filtro' "; }

if ($nombre_cliente_filtro<>"") { $sql .= " AND directorio.nombre LIKE '%$nombre_cliente_filtro%' "; }
if ($rut_cliente_filtro<>"") { $sql .= " AND directorio.rut LIKE '%$rut_cliente_filtro%' "; }
if ($referencia_filtro<>"") { $sql .= " AND documentos.referencia LIKE '%$referencia_filtro%' "; }

$sql .= "ORDER BY documentos.cod_documento DESC LIMIT 300";
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
$dcto_total_items=$row2["dcto_total_items"];


if ($estado==0) {$estado_text="PENDIENTE";}
if ($estado==1) {$estado_text="EMITIDA";}
if ($estado==2) {$estado_text="ACEPTADA";}
if ($estado==3) {$estado_text="CREDITO";}
if ($estado==4) {$estado_text="ELIMINADA";}
if ($estado==5) {$estado_text="REVISION";}
if ($estado==6) {$estado_text="ENVIADA";}
if ($estado==7) {$estado_text="REVISION COMERCIAL";}

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

$now = time(); // or your date as well
$your_date = strtotime($fecha_creacion);
$datediff = $now - $your_date;
$datediff=round($datediff / (60 * 60 * 24));


?>
<tr <?php if($datediff>9 && $estado=="0") { echo "bgcolor='#ff8080'";} ?></tr>
		<td><a href="detalle_dcto.php?cod_documento=<?php echo $cod_documento; ?>"><?php echo $cod_documento; ?></a></td>
		<td><?php echo $tipo; ?></td>
		<td><?php echo $id_vendedor; ?></td>
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
		<td><?php echo $estado_text; ?></td>
</tr>
<?php


    }
} else {
    echo "0 results";
}

?>
		
		</table
		
			
</ul>	
	</body>
</html>
<?php
 }
}
else
{
header("Location:../login.php");
}
?>
