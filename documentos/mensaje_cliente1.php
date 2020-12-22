<?php

include "../connect.php";

// EMPIEZA

$cod_documento = $_GET["cod_documento"];
$sql = "SELECT * FROM documentos WHERE cod_documento='".$cod_documento."'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row2 = $result->fetch_assoc()) {
$tipo=$row2["tipo"];
$id_vendedor=$row2["id_vendedor"];
$id_cliente=$row2["id_cliente"];
$estado=$row2["estado"];
$fecha_creacion=$row2["fecha_creacion"];
$fecha_emision=$row2["fecha_emision"];
$total_venta=$row2["total_venta"];
$total_venta_neto=$row2["total_venta_neto"];
$monto_descuento_neto=round($row2["monto_descuento_neto"]);
$e_numero_documento=$row2["e_numero_documento"];
$id_pago=$row2["id_pago"];
$observaciones=$row2["observaciones"];
$referencia=$row2["referencia"];
$iva_extra=$row2["iva_extra"];
$gastos_extra=$row2["gastos_extra"];
$entrega_real=$row2["entrega_real"];
$entrega_real=substr("$entrega_real", -11, 2)."-".substr("$entrega_real", -14, 2)."-".substr("$entrega_real", -19, 4);
$entrega_comprometida=$row2["entrega_comprometida"];
$entrega_comprometida=substr("$entrega_comprometida", -11, 2)."-".substr("$entrega_comprometida", -14, 2)."-".substr("$entrega_comprometida", -19, 4);
$asociacion=$row2["asociacion"];
$condicion=$row2["condicion"];
$concepto=$row2["concepto_compra"];
$att=$row2["att"];
$plazo_entrega=$row2["plazo_entrega"];
$cond_venta=$row2["cond_venta"];
$dcto_total_items=$row2["dcto_total_items"];
$total_venta_neto=$total_venta_neto-$dcto_total_items;

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


    }
} else {
    echo "0 results";
}

//CONSULTA VENDEDOR



$sql2 = "SELECT * FROM directorio WHERE cod_directorio='".$id_vendedor."'";
$result2 = $db->query($sql2);
if ($result2->num_rows > 0) {
	while($row = $result2->fetch_assoc()) {
$nombre_vendedor=$row["nombre"];
    }
} else {
    
}




//CONSULTA CLIENTE

$sql2 = "SELECT * FROM directorio WHERE cod_directorio='".$id_cliente."'";
$result2 = $db->query($sql2);
if ($result2->num_rows > 0) {
	while($row = $result2->fetch_assoc()) {
$rut=$row["rut"];
$nombre_cliente=$row["nombre"];
$direccion=$row["direccion"];
$comuna=$row["comuna"];
$ciudad=$row["ciudad"];
    }
} else {
    
}


if ($estado==0) {$estado_text="PENDIENTE";}
if ($estado==1) {$estado_text="EMITIDA";}
if ($estado==2) {$estado_text="ACEPTADA";}
if ($estado==3) {$estado_text="CREDITO";}
if ($estado==4) {$estado_text="ELIMINADA";}
if ($estado==5) {$estado_text="RETIRO";}




?>

<html >
<head>

<link rel="stylesheet" type="text/css" href="../stylesheet.css">
</head>
<style>
.tab {border-collapse:collapse;}
.tab .first {border-bottom:1px solid #EEE;}
.tab .second {border-top:1px solid #CCC;box-shadow: inset 0 1px 0 #CCC;}​
</style>

<body>
	

	

<ul>

<table BORDER=5 CELLPADDING=10 CELLSPACING=10 ><td>
	<table class="tablacot" border="1" width="600" >
  <tr>
    <td align=center colspan=3>Archivos Correspondientes a Entrega</td>
  </tr>

  <style>
	a {
		text-transform: uppercase;
	}
  </style>

<tr>
	<?php 
	
// IMAGENES MENSAJE
$var=0;

$sqldp = "SELECT * FROM doc_paths WHERE cod_dcto='".$cod_documento."'";

$resultdp = $db->query($sqldp);
if ($resultdp->num_rows > 0) {
	while($row = $resultdp->fetch_assoc()) {
$path_file=$row["path_file"];


?>
				
		<td>
			<center><img border="0" src="<?php echo 'other_files/'.$path_file; ?>" width="180" height="150"></center>
		</td>
		<?php
		if ($var>1){
			echo "</tr><tr>"; $var=0;
		}
		$var = $var+1;
		?>
	
	
					<?php
}				
}
?>
	</table>
		</td>
</table>

<br>


<table BORDER=5 CELLPADDING=10 CELLSPACING=10 ><td>
 <table class="tab" border="0" width="600">	
	<tr>
	<td width="400" border=0>
	<img src="logocot.png" ALT="CROMATIX">
	</td>
	<td>
		<table class="cot" border=4 width="190">
			<tr><td border=0>	
		<center>
	<h2>CROMATIX SPA<br>
R.U.T.: 76.836.147-9</h2>

<h2><?php echo "$tipo"; ?></h2> 

<h1>N&deg;: <?php echo " ".$cod_documento; ?></h1>
</center>
</td></tr>
</table>
	</td>
	</tr>
	</table>
	<br>
	
 <table class="tablacot" border="1" width="600">
<tr>
<th><?php echo "Tipo de Documento"; ?></th><th><?php echo "C&oacute;digo de Documento"; ?></th><th><?php echo "Fecha"; ?></th><th><?php echo "Vendedor"; ?></th>
<th>Estado</th>
</tr>
<tr>
<td><?php echo "$tipo"; ?></td><td><?php echo "$cod_documento"; ?></td><td><?php echo date("d-m-Y"); ?></td><td><?php echo "$nombre_vendedor"; ?></td>
<td><?php echo "$estado_text"; ?></td>
</tr>
<tr>
<th>Cliente</th>
<td><?php echo $rut; ?></td>
<td colspan=3 ><?php echo $nombre_cliente; ?></td>
</tr>
<tr>
<th>Proyecto / Ref:</th>
<td><?php echo "$referencia"; ?></td>
<td colspan=3 ><?php echo $direccion.", ".$comuna.", ".$ciudad; ?></td>
</tr>
<tr><th>Atenci&oacute;n</th><td colspan=4 >
<?php echo "$att"; ?>
</td></tr><tr>
	<th>Plazo de Entrega</th><td colspan=4 >
	<?php echo "$plazo_entrega"; ?>
	</td></tr>
<tr>
	<th>Condiciones de Venta</th><td colspan=4 >
	<?php echo "$cond_venta"; ?>
	</td></tr>


    </table>
    
    
   
   <h2>Productos Ingresados en la Venta Actual:</h2>


   <table class="tablacomp" border="1" width="600">
		  <thead>
<tr>
	<th></th>
<th><?php echo "Item"; ?></th>
<th>Imagen Ref.</th>
<th><?php echo "Nombre Producto"; ?></th>
<th><?php echo "Consumo"; ?></th>
<th><?php echo "Color Luz"; ?></th>
<th><?php echo "Color Equipo"; ?></th>

<th><?php echo "Cantidad"; ?></th>
<th><?php echo "Monto Unitario"; ?></th>
<?php if ($dcto_total_items>0) { ?>
<th><?php echo "Descuento"; ?></th>
<?php } ?>
<th><?php echo "Monto Total Venta Neto"; ?></th>
</tr>
 </thead>

	
		<?php		
			
$sql3 = "SELECT * FROM detalle_documento WHERE cod_documento='".$cod_documento."' ORDER BY orden DESC";
$result3 = $db->query($sql3);
if ($result3->num_rows > 0) {
	while($row = $result3->fetch_assoc()) {
$cod_producto=$row["cod_producto"];
$cantidad=$row["cantidad"];
$monto_unitario_venta=$row["monto_unitario_venta"];
$monto_total_venta=$row["monto_total_venta"];
$item=$row["item"];
$descuento_item=$row["descuento"];
$dcto_item_pct=1-($descuento_item/100);

//MODIFICADOR DE MONTO TOTAL VENTA
$monto_total_venta_dcto=$monto_total_venta*$dcto_item_pct;
if ($dcto_total_items<0) { 
$monto_unitario_venta=$monto_unitario_venta*$dcto_item_pct; }
$diferencias_dcto_item=$diferencias_dcto_item+$monto_total_venta*($descuento_item/100);

//NOMBRE
$sql_n = "SELECT * FROM productos WHERE id_producto='".$cod_producto."'";
$result_n = $db->query($sql_n);
if ($result_n->num_rows > 0) {
	while($row_n = $result_n->fetch_assoc()) {
$nombre_producto=$row_n["nombre"];
$imagen=$row_n["imagen"];
$descripcion=$row_n["descripcion"];
$u_medida=$row_n["u_medida"];
$temperatura=$row_n["temperatura"];
$consumo=$row_n["consumo"];
$dimension=$row_n["dimension"];
$ip=$row_n["ip"];
$color_luz=$row_n["color_luz"];
$color_equipo=$row_n["color_equipo"];


$cod_proveedor=$row_n["cod_proveedor"];

//COLORES FONDO
if ($temperatura<=2500) {$cf_color_luz="";}
else if ($temperatura<=3550) {$cf_color_luz="f4c842";}
else if ($temperatura<=4550) {$cf_color_luz="#fffce8";}
else if ($temperatura<=6550) {$cf_color_luz="#d6f0ff";}
else if ($temperatura=="") { $cf_color_luz=""; }

$cl="#000000";
if ($color_equipo=="BLANCO") {$cf_color_equipo="#ffffff";}
else if ($color_equipo=="NEGRO") {$cf_color_equipo="#000000"; $cl="#ffffff";}
else if ($color_equipo=="ALUMINIO") {$cf_color_equipo="#afafaf";}
else if ($color_equipo=="GRIS") {$cf_color_equipo="#919191";}
else { $cf_color_equipo="";}

// PROVEEDOR

//CONSULTA CLIENTE

$sqlpr = "SELECT * FROM directorio WHERE cod_directorio='".$cod_proveedor."'";
$resultpr = $db->query($sqlpr);
if ($resultpr->num_rows > 0) {
	while($rowpr = $resultpr->fetch_assoc()) {
$color_p=$rowpr["color_p"];

    }
} else {
    
}

//TERMINA PROVEEDOR


if ($temperatura<>"") { $temperatura=$temperatura." K"; }
if ($consumo<>"") { $consumo=$consumo." W"; }
if ($ip<>"" AND $ip<>0) { $ip="IP ".$ip; } else {$ip="";}
if ($ik<>"" AND $ik<>0) { $ik="IK ".$ik; } else {$ik="";}
if ($dimension<>"") { $dimension="&Oslash; ".$dimension; }
    }
} else {
    
}

?>

<tr bgcolor="e5ebff">
	
  <td bgcolor='<?php echo $color_p;?>'></td>
<td><?php echo "$item"; ?></td>


<?php 
	
	if ($imagen<>"sinfoto.jpg") {
		 echo '<td valign="top" rowspan=2 bgcolor="white">';
		 $filename='../cromatiximg/'.$imagen;
		 echo  '<img src="'.$filename.'" style="width:48px;height:40px;">'; 
		 echo '</td>';
		 
		 }
		 else { echo '<td></td>';}
?>



<td><b><?php echo $nombre_producto; ?></b></td>
<td align="center"><?php if ($consumo<>"0 W") { echo $consumo; } else {} ?></td>
<td align="center" <?php if ($cf_color_luz<>'') {echo 'bgcolor="'.$cf_color_luz.'"';} ?>><?php if ($temperatura<>"0 K") {echo $temperatura;} else if ($color_luz<>"") { if ($color_luz=="RGBW") { echo "<font color='red'>R</font><font color='green'>G</font><font color='blue'>B</font><font color='black'>W</font>"; } else if ($color_luz=="RGB") { echo "<font color='red'>R</font><font color='green'>G</font><font color='blue'>B</font>"; } else {echo $color_luz;} } else {} ?></td>
<td align="center" <?php if ($cf_color_equipo<>'') {echo 'bgcolor="'.$cf_color_equipo.'"';} ?>><font color="<?php echo $cl;?>"><?php echo $color_equipo; ?></font></td>


<td align="center"><b><?php echo "$cantidad"; ?></b></td>

<td align="right"><b><?php echo "$".number_format("$monto_unitario_venta",0,",","."); ?></b></td>

<?php if ($dcto_total_items<>0) { ?>
	<?php if ($dcto_total_items>0) { ?>
<td align="center"><b><?php echo "$descuento_item"." %"; ?></b></td>
<?php } ?>
<?php } ?>

<td align="right"><b><?php echo "$".number_format("$monto_total_venta_dcto",0,",",".");?></b></td>
</tr>

<tr> <?php
if ($imagen<>"sinfoto.jpg") {
echo "<td colspan=2></td>";
 } 
else {
	
	echo "<td colspan=3></td>";
	}
 
 ?>
<td colspan=4><?php echo "$descripcion"; ?></td>
<td align="center"><?php if ($ip<>"" AND $ik=="") {echo $ip;} else if ($ip<>"" AND $ik<>"")  {echo $ip." / ".$ik;}?> </td>
<td colspan=2 align="center"><?php echo $dimension; ?></td>

</tr>

    
<?php

    }
} else {
    
}

?>
<?php 

if ($total_venta_neto<>0) { $descuento_p=round($monto_descuento_neto/$total_venta_neto*100,2); } else { $descuento_p=0;} 

if ($monto_descuento_neto<>0) { ?>
<tr>
 <th colspan="7" align="right">Descuento Global Neto:</th><td colspan="3" align="right"><font size="2"><?php echo "(".$descuento_p." %) - $ ".number_format("$monto_descuento_neto",0,",",".");?></font></td>

</tr>
<?php } ?>
<tr>
 <th <?php if ($dcto_total_items>0) { echo 'colspan="8"'; } else { echo 'colspan="7"'; } ?> align="right">Total Neto:</th><td colspan="3" align="right"><font size="2"><?php echo "$ ".number_format("$total_neto",0,",",".");?></font></td>

</tr>
<?php if ($tipo<>"FACTURA EXENTA") { ?>
<tr>
 <th <?php if ($dcto_total_items>0) { echo 'colspan="8"'; } else { echo 'colspan="7"'; } ?> align="right">I.V.A.:</th><td colspan="3" align="right"><font size="2"><?php echo "$ ".number_format("$iva",0,",",".");?></font></td>

</tr>

<tr>
 <th <?php if ($dcto_total_items>0) { echo 'colspan="8"'; } else { echo 'colspan="7"'; } ?> align="right">Total Venta Actual:</th><td colspan="3" align="right"><font size="2"><b><?php echo "$ ".number_format("$total_venta",0,",",".");?></b></font></td>
</tr>
<?php } ?>
<!--
<tr>
 <th colspan="8" align="right">N&uacute;mero de Items Ingresados:</th><td align="right"><?php echo $row;?></td>
</tr>
-->


	
	
    </table>
	</td></table>	
<br>
  


</ul>

	
	</body>
</html>

<?php


//TERMINA


?>

