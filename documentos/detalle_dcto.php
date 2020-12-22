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
<?PHP include "../header.php";?>
</table>	
<ul>												
<?php
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
$fecha_creacion=substr("$fecha_creacion", -11, 2)."-".substr("$fecha_creacion", -14, 2)."-".substr("$fecha_creacion", -19, 4);
$fecha_emision=$row2["fecha_emision"];
$fecha_emision=substr("$fecha_emision", -11, 2)."-".substr("$fecha_emision", -14, 2)."-".substr("$fecha_emision", -19, 4);
$total_venta=$row2["total_venta"];
$total_venta_neto=$row2["total_venta_neto"];
$monto_descuento_neto=$row2["monto_descuento_neto"];
$e_numero_documento=$row2["e_numero_documento"];
$id_pago=$row2["id_pago"];
$observaciones=$row2["observaciones"];
$referencia=$row2["referencia"];
$iva_extra=$row2["iva_extra"];
$gastos_extra=$row2["gastos_extra"];
$entrega_real=$row2["entrega_real"];
$entrega_comprometida=$row2["entrega_comprometida"];
$asociacion=$row2["asociacion"];
$condicion=$row2["condicion"];
$concepto=$row2["concepto_compra"];
$moneda=$row2["moneda"];
$metodo=$row2["metodo"];
$att=$row2["att"];
$plazo_entrega=$row2["plazo_entrega"];
$cond_venta=$row2["cond_venta"];
$glosa_guia=$row2["glosa_guia"];
$cod_doc_ref=$row2["cod_doc_ref"];
$bl=$row2["bl"];
$cod_forwarder=$row2["cod_forwarder"];
$dcto_total_items=$row2["dcto_total_items"];

$doc_pi=$row2["doc_pi"];
$doc_ci=$row2["doc_ci"];
$doc_pl=$row2["doc_pl"];
$doc_oc=$row2["doc_oc"];
$doc_bl=$row2["doc_bl"];

$entrega_bl=$row2["entrega_bl"];
$entrega_cif=$row2["entrega_cif"];
$entrega_ddp=$row2["entrega_ddp"];
$dias_a_bl=$row2["dias_a_bl"];
$dias_a_cif=$row2["dias_a_cif"];
$dias_a_ddp=$row2["dias_a_ddp"];

$entrega_comprometida=substr("$entrega_comprometida", -11, 2)."-".substr("$entrega_comprometida", -14, 2)."-".substr("$entrega_comprometida", -19, 4);
$entrega_real=substr("$entrega_real", -11, 2)."-".substr("$entrega_real", -14, 2)."-".substr("$entrega_real", -19, 4);
$entrega_bl=substr("$entrega_bl", -11, 2)."-".substr("$entrega_bl", -14, 2)."-".substr("$entrega_bl", -19, 4);
$entrega_cif=substr("$entrega_cif", -11, 2)."-".substr("$entrega_cif", -14, 2)."-".substr("$entrega_cif", -19, 4);
$entrega_ddp=substr("$entrega_ddp", -11, 2)."-".substr("$entrega_ddp", -14, 2)."-".substr("$entrega_ddp", -19, 4);


//WEBEO PARA PRONOSTICO DE FECHAS

if ($metodo=="BY OCEAN") {
if ($dias_a_bl<>0) { $dias_a_bl_p=$dias_a_bl; } else { $dias_a_bl_p=5; $col_bl=""; }
if ($dias_a_cif<>0) { $dias_a_cif_p=$dias_a_cif; } else { $dias_a_cif_p=45; $col_cif=""; }
if ($dias_a_ddp<>0) { $dias_a_ddp_p=$dias_a_ddp; } else { $dias_a_ddp_p=5; $col_ddp=""; }

	}

if ($metodo=="BY AIR") {
if ($dias_a_bl<>0) { $dias_a_bl_p=$dias_a_bl; } else { $dias_a_bl_p=3; $col_bl=""; }
if ($dias_a_cif<>0) { $dias_a_cif_p=$dias_a_cif; } else { $dias_a_cif_p=7; $col_cif=""; }
if ($dias_a_ddp<>0) { $dias_a_ddp_p=$dias_a_ddp; } else { $dias_a_ddp_p=3; $col_ddp=""; }

	}

if ($entrega_comprometida<>NULL) {
	
	//CALCULO DE ESTIMADO DE ENTREGA REAL
	if ($entrega_real==NULL OR $entrega_real=="00-00-0000") {
		$entrega_real_e=$entrega_comprometida;		
	}
	
	//CALCULO ESTIMADO ENTREGA BL
	if ($entrega_bl==NULL OR $entrega_bl=="00-00-0000") {
		if ($entrega_real==NULL OR $entrega_real=="00-00-0000") {
			$entrega_bl_e=date('d-m-Y', strtotime($entrega_real_e. ' + '.$dias_a_bl_p.' days'));
			}
			else {$entrega_bl_e=date('d-m-Y', strtotime($entrega_real. ' + '.$dias_a_bl_p.' days'));}
		}
	//CALCULO ESTIMADO ENTREGA CIF
		if ($entrega_cif==NULL OR $entrega_cif=="00-00-0000") {
		if ($entrega_bl==NULL OR $entrega_bl=="00-00-0000") {
			$entrega_cif_e=date('d-m-Y', strtotime($entrega_bl_e. ' + '.$dias_a_cif_p.' days'));
			}
			else {$entrega_cif_e=date('d-m-Y', strtotime($entrega_bl. ' + '.$dias_a_cif_p.' days'));}
		}
	//CALCULO ESTIMADO ENTREGA DDP
		if ($entrega_ddp==NULL OR $entrega_ddp=="00-00-0000") {
		if ($entrega_cif==NULL OR $entrega_cif=="00-00-0000") {
			$entrega_ddp_e=date('d-m-Y', strtotime($entrega_cif_e. ' + '.$dias_a_ddp_p.' days'));
			}
			else {$entrega_ddp_e=date('d-m-Y', strtotime($entrega_cif. ' + '.$dias_a_ddp_p.' days'));}
		}
	}
	


// FIN WEBEO PRONOSTICOS

$total_venta_neto=$total_venta_neto-$dcto_total_items;


if ($total_venta_neto<>0) { $descuento_p=round($monto_descuento_neto/$total_venta_neto*100,2); } else { $descuento_p=0;} 

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

if ($tipo=="ORDEN DE COMPRA") {
//$total_neto=0;
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
$email_cliente=$row["email"];
    }
} else {
    
}


if ($estado==0) {$estado_text="PENDIENTE";}
if ($estado==1) {$estado_text="EMITIDA";}
if ($estado==4) {$estado_text="ELIMINADA";}
if ($estado==2) {$estado_text="ACEPTADA";} 
if ($estado==3) {$estado_text="CREDITO";}
if ($estado==5) {$estado_text="REVISION";} 
if ($estado==6) {$estado_text="ENVIADA";} 
if ($estado==7) {$estado_text="REVISION COMERCIAL";} 


?>
<table class="tablaprod" border="1">
	<tr>
	<th>		
		
		Tipo de Documento
	</th>
	<th>Cod. Documento 
 <?php if ($tipo<>"GUIA") { ?>
<a href="copiar_documento.php?cod_documento=<?php echo $cod_documento; ?>">
<img border="0" alt="Copiar Documento" src="os.png" width="15" height="15">
</a>
 <?php } ?>
</th>
	
	<th>Fecha Creacion</th>
	<th>Vendedor</th>
	</tr>
	<tr>
					<form id="modifica_tipo" name="modifica_tipo" method="post" action="modifica_tipo.php?cod_documento=<?php echo $cod_documento; ?>">	

	<td>
		
		
		
	
	<select name="tipo" onchange="document.getElementById('modifica_tipo').submit();" <?php if ($tipo=="GUIA") { ?> disabled <?php } ?>>
  <option value="COTIZACION" <?php if ($tipo=="COTIZACION") {echo "selected";} ?>>COTIZACION</option>
  <option value="QUOTATION" <?php if ($tipo=="QUOTATION") {echo "selected";} ?>>QUOTATION</option>
  <option value="BOLETA" <?php if ($tipo=="BOLETA") {echo "selected";} ?>>BOLETA</option>
  <option value="FACTURA" <?php if ($tipo=="FACTURA") {echo "selected";} ?>>FACTURA</option>
  <option value="FACTURA EXENTA" <?php if ($tipo=="FACTURA EXENTA") {echo "selected";} ?>>FACTURA EXENTA</option>
  <?php if ($tipo=="GUIA") { ?> 
	  <option value="GUIA" <?php if ($tipo=="GUIA") {echo "selected";} ?>>GUIA DE DESPACHO</option>    
	  <?php } ?>>

  <option value="NOTA DE CREDITO" <?php if ($tipo=="NOTA DE CREDITO") {echo "selected";} ?>>NOTA DE CREDITO</option>
  <option value="FACTURA DE COMPRA" <?php if ($tipo=="FACTURA DE COMPRA") {echo "selected";} ?>>FACTURA DE COMPRA</option>
  <option value="FACTURA DE COMPRA EX" <?php if ($tipo=="FACTURA DE COMPRA EX") {echo "selected";} ?>>FACTURA DE COMPRA EX</option>
  <option value="ORDEN DE COMPRA" <?php if ($tipo=="ORDEN DE COMPRA") {echo "selected";} ?>>ORDEN DE COMPRA</option>
  <option value="RFQ" <?php if ($tipo=="RFQ") {echo "selected";} ?>>RFQ</option>
</select>
	 </td>
	 </form>
		
		
		
		 </center>
</td>
	<td>
		<center><?php echo $cod_documento; ?>
		

		
		
		
		
		</center>
	</td>
	<td>
		<?php echo $fecha_creacion; ?>
	</td>
	<td><?php echo $nombre_vendedor; ?></td>
	</tr>
	<tr>
	<th>Estado</th>
	<th>Numero de Documento</th>
	<th>Fecha Emision</th>
	<th>Proyecto/Referencia - 
<?php if ($cod_doc_ref<>0) { ?>
<a href="detalle_dcto.php?cod_documento=<?php echo $cod_doc_ref; ?>">
<?php echo $cod_doc_asoc; ?>
Cod. Doc</a>
<?php } else { echo "Cod. Doc"; } ?></th>
	</tr>
	<tr>
				
		
		
	<td>
		<center>
	<table class="tablaprod" border="0">
		<tr>
				<form id="modifica_estado" name="modifica_estado" method="post" action="modifica_estado.php?cod_documento=<?php echo $cod_documento; ?>">	
	<td>
		
		
		<?php if ($estado=="1" AND $_SESSION["user"]<>'alesgare' AND $tipo<>"COTIZACION") { echo "<font color='green'>EMITIDA</font>"; } 
			
			else { ?>
		
	<select name="estado" onchange="document.getElementById('modifica_estado').submit();" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "disabled";} ?>>
<option value="0" <?php if ($estado=="0") {echo "selected";} ?>>PENDIENTE</option>
	<?php 
if ($_SESSION["user"]=='alesgare' OR $tipo=="COTIZACION" OR $tipo=="QUOTATION")  {
	
?>
<option value="1" <?php if ($estado=="1") {echo "selected";} ?>>EMITIDA</option> <?php } ?>
<?php if ($tipo=="COTIZACION" OR $tipo=="ORDEN DE COMPRA" OR $tipo=="QUOTATION") { ?>
<option value="2" <?php if ($estado=="2") {echo "selected";} ?>>ACEPTADA</option>
 <?php } ?>
<?php if ($tipo=="GUIA" OR $tipo=="FACTURA" OR $tipo=="NOTA DE CREDITO") {  ?>
<?php if ($glosa_guia<>"VENTA" OR ($glosa_guia=="VENTA" AND $cod_doc_ref<>'0' AND $e_numero_documento<>'0')) { ?>
<option value="3" <?php if ($estado=="3") {echo "selected";} ?>>CREDITO</option>  <?php } ?> <?php } ?>
<option value="4" <?php if ($estado=="4") {echo "selected";} ?>>ELIMINADA</option>

		<?php 
if ($_SESSION["nivel"]=="1" AND ($tipo=="ORDEN DE COMPRA" OR $tipo=="RFQ")) {
?>
<option value="5" <?php if ($estado=="5") {echo "selected";} ?>>REVISION</option>  
<option value="7" <?php if ($estado=="7") {echo "selected";} ?>>REVISION COMERCIAL</option> 
<option value="6" <?php if ($estado=="6") {echo "selected";} ?>>ENVIADA</option>  
<?php } ?> 
</select>

<?php } ?> 

<?php
$link2='http://sys.cromatix.cl/documentos/mensaje_cliente1.php';?>

</center>
   </td>
  </form>


<?php if ($tipo=="GUIA") { ?>
  
  				<form id="modifica_glosa" name="modifica_glosa" method="post" action="modifica_glosa.php?cod_documento=<?php echo $cod_documento; ?>">	
	<td>
	<select name="glosa_guia" onchange="document.getElementById('modifica_glosa').submit();" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "disabled";} ?>>
<option value="VENTA" <?php if ($glosa_guia=="VENTA") {echo "selected";} ?>>VENTA</option>
<option value="TRASLADO" <?php if ($glosa_guia=="TRASLADO") {echo "selected";} ?>>TRASLADO</option>
<option value="CONSIGNACION" <?php if ($glosa_guia=="CONSIGNACION") {echo "selected";} ?>>CONSIGNACION</option>
<option value="RESERVA" <?php if ($glosa_guia=="RESERVA") {echo "selected";} ?>>RESERVA</option>
<option value="REPUESTO" <?php if ($glosa_guia=="REPUESTO") {echo "selected";} ?>>REPUESTO</option>
<option value="DEFECTUOSO" <?php if ($glosa_guia=="DEFECTUOSO") {echo "selected";} ?>>DEFECTUOSO</option>

</select>
 </td>
 <?php } ?>
 </tr>
  </form>
 
  </table></center>
	 </td>
	
	 
		<form id="modifica_dcto" name="modifica_dcto" method="post" action="modifica_n_dcto.php?cod_documento=<?php echo $cod_documento; ?>">		
	<td>
						
<input  size="8" name="e_numero_documento" placeholder="Numero Documento" class="style1" type="text" maxlength="255" value="<?php echo $e_numero_documento; ?>" onchange="document.getElementById('modifica_dcto').submit();" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "readonly";} ?> /> 
					
	
	</td>
	</form>
	<td><?php echo $fecha_emision; ?></td>
	
	<td>
						
						<table class="tablaprod" border="0">
		<tr>
			<form id="modifica_referencia" name="modifica_referencia" method="post" action="modifica_referencia.php?cod_documento=<?php echo $cod_documento;?>">		
			<td>
<input  size="22" name="referencia" placeholder="Referencia" class="style1" type="text" maxlength="255" value="<?php echo $referencia;?>" onchange="document.getElementById('modifica_referencia').submit();" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "readonly";} ?>/> 
			</td>	
				  </form>
				  			<form id="modifica_cod_ref" name="modifica_cod_ref" method="post" action="modifica_doc_ref.php?cod_documento=<?php echo $cod_documento;?>">		
			<td>
<input  size="5" name="cod_doc_ref" placeholder="Cod Ref." class="style1" type="text" maxlength="255" value="<?php echo $cod_doc_ref;?>" onchange="document.getElementById('modifica_cod_ref').submit();" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "readonly";} ?> /> 
			</td>	
				  </form>
	 </tr>

 
  </table>
	</td>
	
	</tr>
	<tr>
	<th>Cliente / Proveedor</th><td colspan=3>
		<?php if ($_SESSION["nivel"]=="1" OR $_SESSION["nivel"]=="2") { ?> 
		<a href="busca_directorio.php?cod_documento=<?php echo $cod_documento; ?>"><?php } ?><?php echo $rut; ?>
		<?php if ($_SESSION["nivel"]=="1" OR $_SESSION["nivel"]=="2") { ?> 
			
		</a><?php } ?> - <?php echo $nombre_cliente; ?> - <?php echo $email_cliente; ?>
	<?php 
	if ($rut==NULL) {
		?>
		<a href="busca_directorio.php?cod_documento=<?php echo $cod_documento; ?>">NO ASIGNADO</a>
	<?php
		}
	?>
	</td>
	</tr>
	
	<tr>
	<th>
	Atenci&oacute;n:
	
	</th>
	
	<form name="att" method="post" action="att.php?cod_documento=<?php echo $cod_documento?>">		
	<td colspan=3>
						
<input  size="45" name="att" placeholder="Sr..." class="style1" type="text" maxlength="255" value="<?php echo $att; ?>" onchange="document.getElementById('att').submit();" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "readonly";} ?>/> 
				
				
	
	</td>
	</form>
	
	</tr>
	<tr><th>
	Plazo de Entrega
	
	</th>
	
	
	<form name="plazo_entrega" method="post" action="plazo_entrega.php?cod_documento=<?php echo $cod_documento?>" >		
	<td colspan=3>
						
<input  size="45" name="plazo_entrega" placeholder="Plazo Entrega" class="style1" type="text" maxlength="255" value="<?php echo $plazo_entrega; ?>" onchange="document.getElementById('plazo_entrega').submit();" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "readonly";} ?>/> 
				
				
	
	</td>
	</form>
	
	</tr>
	
	
	<tr><th>
	Condiciones de Venta
	
	</th>
	
	
	<form name="cond_venta" method="post" action="cond_venta.php?cod_documento=<?php echo $cod_documento?>" >		
	<td colspan=3>
						
<input  size="45" name="cond_venta" class="style1" type="text" maxlength="255" value="<?php echo $cond_venta; ?>" onchange="document.getElementById('cond_venta').submit();" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "readonly";} ?>/> 
				
				
	
	</td>
	</form>
	
	</tr>
<?php 
	if ($tipo=="ORDEN DE COMPRA" OR $tipo=="RFQ" OR  $tipo=="FACTURA DE COMPRA") {
	?>
<tr><th>
	Referencias Seguimiento
	
	</th>
	
	
	<form name="ref_seg" method="post" action="ref_seg.php?cod_documento=<?php echo $cod_documento?>" >		
	<td >
			

Cod. Seguimiento: <input  size="15" name="cod_forwarder" class="style1" type="text" maxlength="255" value="<?php echo $cod_forwarder; ?>" onchange="document.getElementByName('ref_seg').submit();"/> 
				
				
	
	</td>
	</form>
<form name="ref_seg2" method="post" action="ref_seg2.php?cod_documento=<?php echo $cod_documento?>" >		
	<td colspan=2>

<table class="tablaprod" border="0">
<tr>
<td <?php if ($doc_bl<>"") { echo 'bgcolor="#e8ffb5"'; } ?>>

BL: <input  size="10" name="bl" class="style1" type="text" maxlength="255" value="<?php echo $bl; ?>" onchange="document.getElementById('ref_seg2').submit();"/> 						

<?php 
if ($doc_bl=="") {
?>
<?php echo $bl; ?>
<a href="upload_doc.php?cod_documento=<?php echo $cod_documento; ?>&td=bl">
<img src="uf.jpg" alt="Upload File" height="16" width="16"> </a>
<?php 
}

else {

?>
<a href="cromatix_files/<?php echo $doc_bl; ?>">
<img src="oc.png" alt="See File" height="16" width="16">  </a>
<a href="elimina_documento.php?cod_documento=<?php echo $cod_documento?>&td=bl">
<img border="0" alt="Eliminar" src="delete.png" width="15" height="15">
</a>
<?php 

}
?>
</td>
</form>


<th>PI</th>
<td <?php if ($doc_pi<>"") { echo 'bgcolor="#e8ffb5"'; } ?> >
<?php 
if ($doc_pi=="") {
?>
<a href="upload_doc.php?cod_documento=<?php echo $cod_documento; ?>&td=pi">
<img src="uf.jpg" alt="Upload File" height="16" width="16"> </a>

<?php 
}

else {

?>
<a href="cromatix_files/<?php echo $doc_pi; ?>">
<img src="pi.png" alt="See File" height="16" width="16"> </a>
<a href="elimina_documento.php?cod_documento=<?php echo $cod_documento?>&td=pi">
<img border="0" alt="Eliminar" src="delete.png" width="15" height="15">
</a>
<?php 

}
?>

</td>

<th>CI</th>
<td <?php if ($doc_ci<>"") { echo 'bgcolor="#e8ffb5"'; } ?>>
<?php 
if ($doc_ci=="") {
?>
<a href="upload_doc.php?cod_documento=<?php echo $cod_documento; ?>&td=ci">
<img src="uf.jpg" alt="Upload File" height="16" width="16"> </a>
<?php 
}

else {

?>
<a href="cromatix_files/<?php echo $doc_ci; ?>">
<img src="ci.png" alt="See File" height="16" width="16"> </a>
<a href="elimina_documento.php?cod_documento=<?php echo $cod_documento?>&td=ci">
<img border="0" alt="Eliminar" src="delete.png" width="15" height="15">
</a>
<?php 

}
?>

</td>
<th>PL</th>
<td <?php if ($doc_pl<>"") { echo 'bgcolor="#e8ffb5"'; } ?>>
<?php 
if ($doc_pl=="") {
?>
<a href="upload_doc.php?cod_documento=<?php echo $cod_documento; ?>&td=pl">
<img src="uf.jpg" alt="Upload File" height="16" width="16"> </a>
<?php 
}

else {

?>
<a href="cromatix_files/<?php echo $doc_pl; ?>">
<img src="pl.jpg" alt="See File" height="16" width="16"> </a>
<a href="elimina_documento.php?cod_documento=<?php echo $cod_documento?>&td=pl">
<img border="0" alt="Eliminar" src="delete.png" width="15" height="15">
</a>
<?php 

}
?>

</td>
<th>OC</th>
<td <?php if ($doc_oc<>"") { echo 'bgcolor="#e8ffb5"'; } ?>>
<?php 
if ($doc_oc=="") {
?>
<a href="upload_doc.php?cod_documento=<?php echo $cod_documento; ?>&td=oc">
<img src="uf.jpg" alt="Upload File" height="16" width="16"> </a>
<?php 
}

else {

?>
<a href="cromatix_files/<?php echo $doc_oc; ?>">
<img src="oc.png" alt="See File" height="16" width="16"> </a>
<a href="elimina_documento.php?cod_documento=<?php echo $cod_documento?>&td=oc">
<img border="0" alt="Eliminar" src="delete.png" width="15" height="15">
</a>
<?php 

}
?>

</td>
</tr>

</table>
				
				
	
	</td>
	
	
	</tr>
	<?php 
	}
	?>
	
		<?php 
	if ($tipo=="FACTURA DE COMPRA" || $tipo=="FACTURA DE COMPRA EX") {
	?>
	
<tr>
<th>Asociado a O/C: </th>
<form name="asociado" method="post" action="asociar.php?cod_documento=<?php echo $cod_documento?>">		
	<td>
						
<input  size="8" name="asociacion" placeholder="Numero O/C" class="style1" type="text" maxlength="255" value="<?php echo $asociacion; ?>" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "readonly";} ?>/> 
				<input class="style1" type="submit" name="submit" value="Asociar" />	
				
	
	</td>
	</form>
<th>Concepto: </th>
<form id="mod_concepto" name="mod_concepto" method="post" action="mod_concepto.php?cod_documento=<?php echo $cod_documento; ?>">	
	<td>
	<select name="concepto" onchange="document.getElementById('mod_concepto').submit();">
<option value="GASTO" <?php if ($concepto=="GASTO") {echo "selected";} ?>>GASTO</option>
<option value="COSTO VENTA" <?php if ($concepto=="COSTO VENTA") {echo "selected";} ?>>COSTO VENTA</option>
</select>
	 </td>
	 </form>
</tr>
		<?php 
	}
	?>
	
	<?php 
	if ($tipo=="ORDEN DE COMPRA" OR $tipo=="RFQ" ) {
	?>
<tr>
<th>Condicion</th>
<th>Entrega Comprometida (EXW)</th>
<th>Entrega Real (EXW)</th>
<th>Fecha BL (FOB)</th>
</tr>
<tr align="center">
<form name="info_orden" method="post" action="cambiar_info.php?cod_documento=<?php echo $cod_documento?>">		
	<td align="center">
						
<input  size="8" name="condicion" placeholder="EJ: CIF" class="style1" type="text" maxlength="255" value="<?php echo $condicion; ?>"/> 
				
				
	
	</td>

	
	<td align="center">
						
<input  size="12" name="entrega_comprometida"  placeholder="EJ: 24-05-2018" class="style1" type="text" maxlength="255" value="<?php echo $entrega_comprometida; ?>"/> 
				
				
	
	</td>
	

	<td align="center">
						
<input  size="12" name="entrega_real"  <?php if ($entrega_real==NULL OR $entrega_real=="00-00-0000") { echo 'STYLE="background-color: #f4c242;"'; } ?> placeholder="<?php echo $entrega_real_e; ?>" class="style1" type="text" maxlength="255" value="<?php if ($entrega_real<>NULL AND $entrega_real<>"00-00-0000") {echo $entrega_real;} ?>"/> 
				
				
	
	</td>
	
<td align="center">
<input  size="2" name="dias_a_bl"  <?php if ($dias_a_bl==0) { echo 'STYLE="background-color: #f4c242;"'; } ?> placeholder="<?php echo $dias_a_bl_p; ?>" class="style1" type="text" maxlength="255" value="<?php if ($dias_a_bl<>0) {echo $dias_a_bl;} ?>"/> 

<input  size="12" name="entrega_bl"  <?php if ($entrega_bl==NULL OR $entrega_bl=="00-00-0000") { echo 'STYLE="background-color: #f4c242;"'; } ?> placeholder="<?php echo $entrega_bl_e; ?>" class="style1" type="text" maxlength="255" value="<?php if ($entrega_bl<>NULL AND $entrega_bl<>"00-00-0000") {echo $entrega_bl;} ?>"/> 
		</td>

</tr>

<tr align="center">
<th>Fecha Arribo (CIF)</th>
<th>Fecha en Bodega (DDP)</th>
<th></th>
<th></th>
</tr>
<tr>
<td align="center">
	<input  size="2" name="dias_a_cif"  <?php if ($dias_a_cif==0) { echo 'STYLE="background-color: #f4c242;"'; } ?> placeholder="<?php echo $dias_a_cif_p; ?>" class="style1" type="text" maxlength="255" value="<?php if ($dias_a_cif<>0) {echo $dias_a_cif;} ?>"/> 
	<input  size="12" name="entrega_cif"  <?php if ($entrega_cif==NULL OR $entrega_cif=="00-00-0000") { echo 'STYLE="background-color: #f4c242;"'; } ?> placeholder="<?php echo $entrega_cif_e; ?>" class="style1" type="text" maxlength="255" value="<?php if ($entrega_cif<>NULL AND $entrega_cif<>"00-00-0000") {echo $entrega_cif;} ?>"/> 
	</td>
<td align="center">
	<input  size="2" name="dias_a_ddp"  <?php if ($dias_a_ddp==0) { echo 'STYLE="background-color: #f4c242;"'; } ?> placeholder="<?php echo $dias_a_ddp_p; ?>" class="style1" type="text" maxlength="255" value="<?php if ($dias_a_ddp<>0) {echo $dias_a_ddp;} ?>"/> 
	<input  size="12" name="entrega_ddp"  <?php if ($entrega_ddp==NULL OR $entrega_ddp=="00-00-0000") { echo 'STYLE="background-color: #f4c242;"'; } ?> placeholder="<?php echo $entrega_ddp_e; ?>" class="style1" type="text" maxlength="255" value="<?php if ($entrega_ddp<>NULL AND $entrega_ddp<>"00-00-0000") {echo $entrega_ddp;} ?>"/> 
	</td>
<td>

	<select name="metodo">
<option value="BY OCEAN" <?php if ($metodo=="BY OCEAN") {echo "selected";} ?>>BY OCEAN</option>
<option value="BY AIR" <?php if ($metodo=="BY AIR") {echo "selected";} ?>>BY AIR</option>
</select>

</td>
<td align="center"><input class="style1" type="submit" name="submit" value="Modificar" /></td>
</form>
</tr>

		<?php 
	}

if ($tipo=="RFQ" OR $tipo=="ORDEN DE COMPRA") { $link='documento_ingles.php';}
else {$link='cotizacion_im_pe.php';}

	?>

	</table>
	
<?php 	if ($tipo=="COTIZACION") {	?>

		<h1>Documentos Asociados:</h1>

		<table class="tablaprod" border="1">
		<?php

$sqlda = "SELECT * FROM documentos WHERE cod_doc_ref='".$cod_documento."'";
$resultda = $db->query($sqlda);
if ($resultda->num_rows > 0) {
while($row = $resultda->fetch_assoc()) {
$tipo_a=$row["tipo"];
$fecha_creacion_a=$row["fecha_creacion"];
$fecha_creacion_a=substr("$fecha_creacion_a", -11, 2)."-".substr("$fecha_creacion_a", -14, 2)."-".substr("$fecha_creacion_a", -19, 4);

$cod_doc_asoc=$row["cod_documento"];
$total_venta_neto_a=$row["total_venta_neto"];
$monto_descuento_neto_a=$row["monto_descuento_neto"];
$dcto_total_items=$row["dcto_total_items"];
$monto_doc_asoc_bruto=($total_venta_neto_a-$monto_descuento_neto_a-$dcto_total_items)*1.19;
$estado_a=$row["estado"];

if ($estado_a==0) {$estado_text_a="PENDIENTE";}
if ($estado_a==1) {$estado_text_a="EMITIDA";}
if ($estado_a==4) {$estado_text_a="ELIMINADA";}
if ($estado_a==2) {$estado_text_a="ACEPTADA";} 
if ($estado_a==3) {$estado_text_a="CREDITO";}
if ($estado_a==5) {$estado_text_a="REVISION";} 
				?>
				
	<tr>
<td><?php echo $fecha_creacion_a; ?></td>
<td><?php echo $tipo_a; ?></td>
<td><a href="detalle_dcto.php?cod_documento=<?php echo $cod_doc_asoc; ?>">
<?php echo $cod_doc_asoc; ?>
</a>
</td>
<td><?php echo "$ ".number_format($monto_doc_asoc_bruto, $d, ",", "."); ?></td>

<td><?php echo $estado_text_a; ?></td>


	</tr>
	
					<?php
}				
}

				?>
	
	</table>
	
					<?php
}				


				?>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
<h2>Productos Ingresados - <a href="<?php echo $link;?>?cod_documento=<?php echo $cod_documento;?>">
<img border="0" alt="Imprimir" src="printer.png" width="15" height="15">
</a>
</h2>

<table class="gridtable" border="1">
	<?php if ($_SESSION["nivel"]=="1" OR $_SESSION["nivel"]=="2") { ?> 
	<tr>
		<form name="formulario" method="post" action="agrega_producto.php?cod_documento=<?php echo $cod_documento;?>&tipo=<?php echo $tipo;?>">					

	<td colspan="5" align="left">Ingreso Rapido: 
<input  size="15" name="cod_producto" autofocus="autofocus" placeholder="Codigo Producto" class="style1" type="text" maxlength="255" value=""/> 
<input  size="8" name="cantidad" placeholder="Cantidad" class="style1" type="text" maxlength="255" value=""/> 	
				<input class="style1" type="submit" name="submit" value="Ingresar" />	
	</td>
	</form>
	
	<form name="buscap" method="post" action="busc_prod_venta.php?cod_documento=<?php echo $cod_documento; ?>&tipo=<?php echo $tipo; ?>">
		<td>
    <input class="style1" type="submit" value="Buscar" />
    </td>
</form>
	
		<form id="modifica_moneda" name="modifica_moneda" method="post" action="modifica_moneda.php?cod_documento=<?php echo $cod_documento; ?>">	
	<td>
	<select name="moneda" onchange="document.getElementById('modifica_moneda').submit();">
<option value="CLP" <?php if ($moneda=="CLP") {echo "selected";} ?>>CLP</option>
<option value="USD" <?php if ($moneda=="USD") {echo "selected";} ?>>USD</option>
<option value="EUR" <?php if ($moneda=="EUR") {echo "selected";} ?>>EUR</option>
</select>
	 </td>
	 </form>
<?php if ($tipo<>"RFQ") { ?>
	<td>
		
	<?php if ($tipo<>"FACTURA EXENTA" AND $tipo<>"FACTURA DE COMPRA EX" AND $tipo<>"QUOTATION") { ?>
		
			
<center>
<?php $link_price='actualiza_precio_doc.php'; ?>

<a href="<?php echo $link_price;?>?cod_documento=<?php echo $cod_documento;?>&tipo=<?php echo $tipo;?>">
<img border="0" alt="Actualizar Precios" src="refresh_price.png" width="25" height="25">
</a>
</center>

<?php } ?> 

</td>
<?php } ?>
	<?php } ?> 
	</tr>
	<tr>
		
		<th></th>
		
		<th>Codigo</th>
	<th>ITEM</th>
	<?php if ($tipo=="RFQ" OR $tipo=="ORDEN DE COMPRA") {echo "<th>Factory COD</th>";} ?>
<th>Nombre Cromatix</th>
<?php if ($tipo<>"RFQ") { ?>
<th>Precio Unitario</th>
<?php } ?>
<th>Cantidad</th>
<?php if ($tipo<>"RFQ") { ?>


<th>Dcto(%)</th>
<th>Totales</th>
<th>Orden</th>

<?php } ?>

<?php if ($tipo=="ORDEN DE COMPRA" OR $tipo=="FACTURA DE COMPRA") { ?>
	<th>EI</th>
	<?php } ?>

</tr>
<?php
$tot_ge=0;
$sql3 = "SELECT * FROM detalle_documento WHERE cod_documento='".$cod_documento."' ORDER BY orden DESC, id_detalle ASC";
$result3 = $db->query($sql3);
if ($result3->num_rows > 0) {
	while($row = $result3->fetch_assoc()) {
$cod_producto=$row["cod_producto"];
$cantidad=$row["cantidad"];
$costo_venta_unitario=$row["costo_venta_unitario"];
$monto_unitario_venta=$row["monto_unitario_venta"];
$monto_total_venta=$row["monto_total_venta"];
$descuento_item=$row["descuento"];
$dcto_item_pct=1-($descuento_item/100);
$item=$row["item"];
$orden=$row["orden"];
$id_detalle=$row["id_detalle"];
$stock_ing=$row["stock_ing"];

//MODIFICADOR DE MONTO TOTAL VENTA
$monto_total_venta_dcto=$monto_total_venta*$dcto_item_pct;
$diferencias_dcto_item=$diferencias_dcto_item+$monto_total_venta*($descuento_item/100);

if ($tipo=="ORDEN DE COMPRA" OR $tipo=="FACTURA DE COMPRA" OR $tipo=="FACTURA DE COMPRA EX") {

//$monto_total_venta=$cantidad*$monto_unitario_venta;
//$total_neto=$monto_total_venta+$total_neto-$dcto_total_items;


if ($item=="GE") {
	$tot_ge=$tot_ge+$monto_total_venta;
}
}



//NOMBRE
$sql_n = "SELECT * FROM productos WHERE id_producto='".$cod_producto."'";
$result_n = $db->query($sql_n);
if ($result_n->num_rows > 0) {
	while($row_n = $result_n->fetch_assoc()) {
$nombre_producto=$row_n["nombre"];
$nombre_pdcto_proveedor=$row_n["nombre_pdcto_proveedor"];
$cod_proveedor=$row_n["cod_proveedor"];
$moneda_origen=$row_n["moneda_origen"];

//COSTO
if ($moneda_origen=="CLP") {$mult=1;} else {$mult=1.4;}
$costo_total_venta=$cantidad*$costo_venta_unitario*$mult;
$costo_neto=$costo_total_venta+$costo_neto;

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


    }
} else {
    
}

?>
<tr>
	
	<td bgcolor='<?php echo $color_p;?>'></td>
	<td>
	<?php if ($_SESSION["nivel"]=="1" OR $_SESSION["nivel"]=="2") { ?> 
	<a href="../detalle_producto.php?cod_producto=<?php echo $cod_producto; ?>"><?php } ?><?php echo $cod_producto; ?><?php if ($_SESSION["nivel"]=="1" OR $_SESSION["nivel"]=="2") { ?> </a><?php } ?>
	
	
	</td>
	<form id="def_item" name="def_item" method="post" action="def_item.php?cod_documento=<?php echo $cod_documento; ?>&id_detalle=<?php echo $id_detalle?>">		
	<td>						
<input  size="5" name="item" type="text" maxlength="255" value="<?php echo $item; ?>" onchange="document.getElementById('def_item').submit();" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "readonly";} ?>/> 
	</td>
	</form>

	<?php if ($tipo=="RFQ" OR $tipo=="ORDEN DE COMPRA") {echo "<td>".$nombre_pdcto_proveedor."</td>";} ?>
<td><?php echo $nombre_producto; ?></td>
<?php if ($tipo<>"RFQ") { ?>
	
<?php if ($moneda<>"CLP") { $d=2;} else {$d=0;} ?>
<td align="right"><?php echo "$ ".number_format($monto_unitario_venta, $d, ",", "."); ?></td>
<?php } ?>

<?php if ($cantidad==0) {$color_cantidad="#f44242";} else {}?>
<?php if ($estado<>4) { ?>
<form id="cantidad" name="cantidad" method="post" action="modifica_cantidad.php?cod_documento=<?php echo $cod_documento?>&id_detalle=<?php echo $id_detalle?>&tipo=<?php echo $tipo;?>">		
<td bgcolor='<?php echo $color_cantidad;?>' align="center">
<input  size="4" name="cantidad_mod" type="text" maxlength="255" value="<?php echo $cantidad; ?>" onchange="document.getElementById('cantidad').submit();" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "readonly";} ?>/> 
</td>
</form>
<?php } else { echo "<td>".$cantidad."</td>"; } ?>
<?php if ($tipo<>"RFQ") { ?>
	

			<form id="descuento_item" name="descuento_item" method="post" action="descuento_item.php?cod_documento=<?php echo $cod_documento; ?>&id_detalle=<?php echo $id_detalle?>&total_item=<?php echo $monto_total_venta?>">		
	<td>						
<input  size="4" name="descuento_item" type="text" maxlength="20" value="<?php echo $descuento_item; ?>" onchange="document.getElementById('descuento_item').submit();" <?php if ($_SESSION["nivel"]<>1) { echo "readonly";} ?> /> 
	</td>
	</form>
	

	
<td align="right"> <?php echo "$ ".number_format($monto_total_venta_dcto, $d, ",", "."); ?></td>

	


<?php } ?>
		<form id="ordenar" name="ordenar" method="post" action="ordenar.php?cod_documento=<?php echo $cod_documento; ?>&id_detalle=<?php echo $id_detalle?>">		
	<td>						
<input  size="1" name="orden" type="text" maxlength="255" value="<?php echo $orden; ?>" onchange="document.getElementById('ordenar').submit();" <?php if ($_SESSION["nivel"]<>"1" AND $_SESSION["nivel"]<>"2") { echo "readonly";} ?>/> 
	</td>
	</form>
	
	
<?php 

if ($stock_ing==$cantidad) { $col_is="#80ff33"; }
if ($stock_ing<>$cantidad AND $stock_ing<>0) { $col_is="#ffe033"; }
if ($stock_ing==0) { $col_is="#ffa38b"; }


if ($tipo=="ORDEN DE COMPRA" OR $tipo=="FACTURA DE COMPRA") { ?>
		<form id="is" name="is" method="post" action="is.php?cod_documento=<?php echo $cod_documento; ?>&id_detalle=<?php echo $id_detalle?>&cod_producto=<?php echo $cod_producto; ?>&stock_old=<?php echo $stock_ing; ?>">		
	<td bgcolor='<?php echo $col_is;?>'>						
<input  size="1" name="stock_ing" type="text" maxlength="255" value="<?php echo $stock_ing; ?>" onchange="document.getElementById('is').submit();" <?php if ($_SESSION["user"]<>'alesgare') echo 'disabled'; ?> /> 
	</td>
	</form>
	<?php } ?>


	
<?php if ($_SESSION["nivel"]==1) { 
	
$mp_p=round((-1+($monto_total_venta_dcto/$costo_total_venta))*100,2);

if ($mp_p>=100) { $col_mp="#97ff0f"; }
if ($mp_p<100 AND $mp_p>60) { $col_mp="#c8ff80"; }
if ($mp_p<=60 AND $mp_p>43) { $col_mp="#e9ffcc"; }
if ($mp_p<=43 AND $mp_p>30) { $col_mp="#ffd4cc"; }
if ($mp_p<=30 AND $mp_p>10) { $col_mp="#ff866e"; }
if ($mp_p<=10) { $col_mp="#ff2f05"; 	}

	
	?>
<?php if ($tipo<>"ORDEN DE COMPRA" AND $tipo<>"RFQ" AND $tipo<>"FACTURA DE COMPRA") { ?>
	<td bgcolor='<?php echo $col_mp;?>' align="center">

<font size="1"><?php echo $mp_p."%"; ?></font>
<?php } ?>	
	
	</td>
	<?php } ?>
	<td>
<?php if ($estado<>4 and $descuento_item==0) { ?>
	<?php if ($_SESSION["nivel"]=="1" OR $_SESSION["nivel"]=="2") { ?> 
<a href="elimina_producto.php?cod_documento=<?php echo $cod_documento?>&id_detalle=<?php echo $id_detalle?>&tipo=<?php echo $tipo;?>">
<img border="0" alt="Eliminar" src="delete.png" width="15" height="15">
</a><?php } ?>
<?php } ?>
</td>
</tr>

<?php
    }
} else {
    
}
?>

<?php if ($tipo<>"RFQ") { ?>
	
	<tr>
	<th colspan=6 align="right">Monto Descuento Global Neto</th>
	
<td align="right">
	
	<?php if ($monto_descuento_neto<>0) { ?>
	
	<?php echo "- $ ".number_format($monto_descuento_neto, $d, ",", "."); ?>
	
	<?php } ?>
	
	</td>

<form id="aplica_descuento" name="aplica_descuento" method="post" action="aplica_descuento.php?cod_documento=<?php echo $cod_documento;?>&tipo=<?php echo $tipo; ?>">		
	<td colspan=2>
	<?php if ($_SESSION["nivel"]==1) {	?>				
<input  size="3" name="descuento_p" placeholder="%" class="style1" type="text" maxlength="255" value="<?php echo $descuento_p;?>" onchange="document.getElementById('aplica_descuento').submit();"/> %
				
	<?php }	?>				
	
	</td>
	</form>
	
</tr>
<tr>
	
	
	<th colspan=6 align="right">Total Neto</th>
<td align="right"><?php echo "$ ".number_format($total_neto, $d, ",", "."); ?></td>
</tr>
<?php if (($tipo<>"FACTURA EXENTA" AND $tipo<>"FACTURA DE COMPRA EX" AND $tipo<>"QUOTATION" AND $tipo<>"ORDEN DE COMPRA") OR ($tipo=="ORDEN DE COMPRA" AND $moneda=="CLP")) { ?>
	

<tr>
	<th colspan=6 align="right">I.V.A.</th>
<td align="right"><?php echo "$ ".number_format($iva, $d, ",", "."); ?></td>
</tr>
<tr>
	<th colspan=6 align="right">Total Bruto</th>
<td align="right"><?php echo "$ ".number_format($total_venta, $d, ",", "."); ?></td>


<?php 

if ($tipo<>"ORDEN DE COMPRA") { 

if ($costo_neto > 0){
$mp=round((-1+($total_neto/$costo_neto))*100,2);
}


if ($mp>=100) { $col_mpp="#97ff0f"; }
if ($mp<100 AND $mp>60) { $col_mpp="#c8ff80"; }
if ($mp<=60 AND $mp>43) { $col_mpp="#e9ffcc"; }
if ($mp<=43 AND $mp>30) { $col_mpp="#ffd4cc"; }
if ($mp<=30 AND $mp>10) { $col_mpp="#ff866e"; }
if ($mp<=10) { $col_mpp="#ff2f05"; 	}

	
	?>

	<td bgcolor='<?php echo $col_mpp;?>' align="center">




<?php if ($_SESSION["nivel"]==1) { ?>
<font size="1"><?php echo "MP: ".$mp."%"; ?></font>
<?php } ?>
</td>
</tr>

<?php } ?>

<?php } ?>

<?php } ?>
	
	
</table>

<br>
<?php if ($_SESSION["nivel"]=="1" OR $_SESSION["nivel"]=="2") { ?> 
<table class="gridtable" border="1">
	<tr>
		<form name="formulario_libre" method="post" action="ingresa_libre.php?cod_documento=<?php echo $cod_documento?>&tipo=<?php echo $tipo?>">					

	<td colspan="5" align="left">
<?php if ($tipo=="RFQ" OR $tipo=="ORDEN DE COMPRA") 
{echo '<input  size="30" name="nombre_fabrica" placeholder="Nombre Fabrica" class="style1" type="text" maxlength="255" value=""/> ';} ?>
<input  size="30" name="nombre_producto" placeholder="Nombre Producto" class="style1" type="text" maxlength="255" value=""/> 
<input  size="8" name="precio" placeholder="($) Neto" class="style1" type="text" maxlength="255" value=""/> 
<input  size="8" name="cantidad" placeholder="Cantidad" class="style1" type="text" maxlength="255" value=""/>
<input class="style1" type="submit" name="submit" value="Ingreso Libre" /> 	<br>
<textarea name="descr" placeholder="Descripcion Adicional" ROWS=2 COLS=64></textarea>
					
	</td>
	</form>
	</tr>
	
	</table>
	
	<?php } ?> 
	
	<br>
	<table class="gridtable" border="1">
	<tr>
		<form id="ing_observaciones" name="ing_observaciones" method="post" action="ing_observaciones.php?cod_documento=<?php echo $cod_documento?>">					

	<td colspan="5" align="left">
<textarea name="obs" ROWS=2 COLS=64 placeholder="Ingresar Observaciones Generales..." onchange="document.getElementById('ing_observaciones').submit();"><?php echo $observaciones?></textarea><br>
	
	</td>
	</form>
	</tr>
	</table>
	<br>
	<?php 
	if ($tipo=="FACTURA DE COMPRA") {
	?>
	<table class="gridtable" border="1">
	<tr>
		<form name="datos_fact_compras" method="post" action="ingresa_extras.php?cod_documento=<?php echo $cod_documento?>">					

	<td colspan="5" align="left">
Gastos Extra: 
<input  size="10" name="gastos_extra" placeholder="Ingresar" class="style1" type="text" maxlength="255" value="<?php echo $gastos_extra;?>"/> 
IVA Extra: 
<input  size="10" name="iva_extra" placeholder="Ingresar" class="style1" type="text" maxlength="255" value="<?php echo $iva_extra;?>"/> 	
				<input class="style1" type="submit" name="submit" value="Ingresar Extras" />	
	</td>
	</form>
	</tr>
	</table>
		<?php 
	
	}
	?>
	
	<?php $current_date=date("d-m-Y"); ?>
	<h1>Pagos:</h1>
	
<table class="gridtable" border="1">
	
	<tr><td>
		
		
		<table class="tablaprod" border="1">
				<?php 
if ($_SESSION["nivel"]==1) {
?>
	<tr>
		<form name="ingresa_pago" method="post" action="ingresa_pago.php?cod_documento=<?php echo $cod_documento?>">					

	<td colspan="5" align="left">
<input  size="10" name="fecha" class="style1" type="text" maxlength="255" value="<?php echo $current_date; ?>"/> 
<input  size="10" name="monto" placeholder="Monto ($)" class="style1" type="text" maxlength="255" value=""/> 
	<select name="medio_pago" >
<option value="TRANSFERENCIA"  >TRANSFERENCIA</option>
<option value="CHEQUE" >CHEQUE</option>
<option value="EFECTIVO">EFECTIVO</option>
</select>
<input  size="10" name="obs" placeholder="Observacion" class="style1" type="text" maxlength="255" value=""/> 	
				<input class="style1" type="submit" name="submit" value="Ingresar Pago" />	
	</td>
	</form>
	</tr>
			<?php 
}
?>

		<?php

$total_pagos=0;
			
$sqlp = "SELECT * FROM info_pago WHERE cod_documento='".$cod_documento."'";
$resultp = $db->query($sqlp);
if ($resultp->num_rows > 0) {
	while($row = $resultp->fetch_assoc()) {
$monto=$row["monto"];
$fecha=$row["fecha"];
$fecha=substr("$fecha", -11, 2)."-".substr("$fecha", -14, 2)."-".substr("$fecha", -19, 4);

$obs=$row["obs"];
$medio_pago=$row["medio_pago"];
$id_pago=$row["id_pago"];

$total_pagos=$total_pagos+$monto;

				?>
				
	<tr>
<td><?php echo $fecha; ?></td>
<td  align='right'><?php echo "$ ".number_format($monto, $d, ",", "."); ?></td>
<td><?php echo $medio_pago; ?></td>
<td><?php echo $obs; ?></td>
<td><a href="elimina_pago.php?cod_documento=<?php echo $cod_documento?>&id_pago=<?php echo $id_pago?>">
<img border="0" alt="Eliminar" src="delete.png" width="15" height="15">
</a></td>

	</tr>
	
					<?php
}				
}

echo "<tr><td align='right'>Total Pagos:</td><td align='right'><b>$ ".number_format($total_pagos, $d, ",", ".")."</b></td></tr>";

				?>
	
	</table>
	</td>
	<form name="emite_dcto" method="post" action="PDFService/app">
	<td>
	<?php 
	
	if ($tipo=="FACTURA")
	
	{ ?>
	<input class="style1" type="submit" name="submit" value="Emite Documento" />	
	<?php  } ?>
	</td>
	
	</form>
	</tr>

	</table>
	
	
	
	

	
	<?php 
	
	if ($tipo=="ORDEN DE COMPRA") {
		
echo "<br><h1>Costos Asociados:</h1>";
echo '<table class="tablaprod" border="1">';
?>

<tr>
<th>Fecha</th>
<th>Tipo</th>
<th>Proveedor</th>
<th>Numero Doc.</th>
<th>Total Neto</th>
<th>Gastos Extra</th>
<th>IVA Extra</th>
<th>Referencia</th>
<th>Concepto</th>

</tr>

<?php




$total_c=0;
	
$sqlas = "SELECT * FROM documentos WHERE asociacion='".$cod_documento."'";
$resultas = $db->query($sqlas);
if ($resultas->num_rows > 0) {
	while($row = $resultas->fetch_assoc()) {

$tipo=$row["tipo"];
$fecha_creacion=$row["fecha_creacion"];
$fecha_creacion=substr("$fecha_creacion", -11, 2)."-".substr("$fecha_creacion", -14, 2)."-".substr("$fecha_creacion", -19, 4);
$total_venta=$row["total_venta"];
$id_cliente=$row["id_cliente"];
$total_venta_neto=$row["total_venta_neto"];
$e_numero_documento=$row["e_numero_documento"];
$referencia=$row["referencia"];
$iva_extra=$row["iva_extra"];
$gastos_extra=$row["gastos_extra"];
$asociacion=$row["asociacion"];
$concepto=$row["concepto_compra"];



if ($total_venta_neto==0) { $total_venta_neto=round($total_venta/1.19);}


$total_c=$total_c+$total_venta_neto+$gastos_extra;

//CONSULTA CLIENTE

$sql3 = "SELECT * FROM directorio WHERE cod_directorio='".$id_cliente."'";
$result3 = $db->query($sql3);
if ($result3->num_rows > 0) {
	while($row = $result3->fetch_assoc()) {
$rut=$row["rut"];
$nombre_cliente_g=$row["nombre"];
    }
} else {
    
}

?>

<tr>
<td><?php echo $fecha_creacion; ?></td>
<td><?php echo $tipo; ?></td>
<td><?php echo $nombre_cliente_g; ?></td>
<td><?php echo $e_numero_documento; ?></td>
<td><b><?php echo "$ ".number_format($total_venta_neto, 0, ",", "."); ?></b></td>
<td><b><?php echo "$ ".number_format($gastos_extra, 0, ",", "."); ?></b></td>
<td><?php echo "$ ".number_format($iva_extra, 0, ",", "."); ?></td>
<td><?php echo $referencia; ?></td>
<td><?php echo $concepto; ?></td>
</tr>


<?php


}

}

$apiUrl = 'https://mindicador.cl/api';
//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
if ( ini_get('allow_url_fopen') ) {
    $json = file_get_contents($apiUrl);
} else {
    //De otra forma utilizamos cURL
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    curl_close($curl);
}
 
$dailyIndicators = json_decode($json);
//echo 'El valor actual de la UF es $' . $dailyIndicators->uf->valor;
//echo 'El valor actual del Dólar observado es $' . $dailyIndicators->dolar->valor;
//echo 'El valor actual del Dólar acuerdo es $' . $dailyIndicators->dolar_intercambio->valor;
//echo 'El valor actual del Euro es $' . $dailyIndicators->euro->valor;

$valor_USD=round($dailyIndicators->dolar->valor+1);
$valor_EUR=round($dailyIndicators->euro->valor+1);

$tot_ge=$tot_ge*$valor_USD;
$tot_clp=$total_neto*$valor_USD-$tot_ge;

$ddp=($tot_clp+$tot_ge+$total_c)/$tot_clp*100-100;

?>

<tr>
<th>Calculo a DDP</th>
<td>Total Costos Extra Automaticos:</td>
<td><b><?php echo "$ ".number_format($total_c, 0, ",", "."); ?></b></td>
<th>Dolar Hoy</th>
<td><?php echo "$ ".number_format($valor_USD, 0, ",", "."); ?></td>
<th>Gastos Origen</th>
<td><?php echo "$ ".number_format($tot_ge, 0, ",", "."); ?></td>
<th>Productos</th>
<td><?php echo "$ ".number_format($tot_clp, 0, ",", "."); ?></td>
</tr>
<tr></tr>
<th colspan=9>DDP: <?php echo round($ddp,2).' %'; ?></th>

<?php
	echo '</table>';	
		
		
		}
	
	?>
	
	</table>
	

	<h1>Archivos Asociados:</h1>


<form id="form1" name="upload" action="upload_file_doc.php?cod_documento=<?php echo $cod_documento?>" method="post" enctype="multipart/form-data">

    Seleccione Archivo
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Subir Archivo" name="submit" >

</form>
<table class="tablaprod" border="1">
				<?php 
$sqldp = "SELECT * FROM doc_paths WHERE cod_dcto='".$cod_documento."'";
$resultdp = $db->query($sqldp);
if ($resultdp->num_rows > 0) {
	while($row = $resultdp->fetch_assoc()) {
$path_file=$row["path_file"];


				?>
				
	<tr>
<td>
<img border="0" alt="Eliminar" src="<?php echo 'other_files/'.$path_file; ?>" width="15" height="15">
</td>
<td><a href="<?php echo 'other_files/'.$path_file; ?>"><?php echo $path_file; ?></a></td>

<td><a href="elimina_archivo.php?cod_documento=<?php echo $cod_documento?>&path_file=<?php echo $path_file?>">
<img border="0" alt="Eliminar" src="delete.png" width="15" height="15">
</a></td>

	</tr>
	
					<?php
}				
}

				?>
	
	</table>
	
	<br>

	<form method="POST" action="enviarprueba.php" style="font-family: Calibri" >
    <input type="text" value="<?php echo $nombre_cliente;?>" name="nombre" hidden>
    <input type="text" value="<?php echo $email_cliente;?>" name="emailenvio" hidden >
    <input type="text" value='http://sys.cromatix.cl/documentos/mensaje_cliente1.php?cod_documento=<?php echo $cod_documento;?>' name="cotizacion" hidden>
    <input type="text" value="Envio Avances Cromatix" name="asunto" hidden> <br>
    <input type="text" value="<br>Estimado Cliente: <br> Nos dirijimos a usted para informarle que la mercaderia ha sido despachada como se evidencia en las imagenes anexas." name="msg" hidden>
 <?php if ($email_cliente !== '' ): ?>
    <input type="submit" value="Enviar Aviso de Entrega" name="submit">
<?php endif ?>
</form>

<br>

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

