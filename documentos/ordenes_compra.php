<?php
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
											
			
		


			<h1>Listado de Ordenes de Compra (100 MAX)</h1>
			
			<table class="tablaprod" border="1">
	<tr>
		<th>Cod</th>

		<th>Cliente/Proveedor</th>
		<th>Referencia Cromatix</th>
		<?php if ($_SESSION["nivel"]=="1") { ?> 
<th>PI</th>
		<th>Ref. Fwd</th>
		<th>BL</th>
<th>CI</th>
<th>PL</th>
<th>OC</th>
<?php } ?> 
		<th>Condicion</th>
		<th>Envio</th>
		<th>EXW</th>
		<th>EXW Real</th>
		<th>FOB</th>
		<th>CIF</th>
		<th>DDP</th>
		<th>(*)</th>
		<th>Monto Total</th>
		<th>Estado</th>
		
		
		</tr>
		
		<?php 
$filtro_estado = $_POST["filtro_estado"];
$tipo_dcto_filtro = $_POST["tipo_dcto_filtro"];

$sql = "SELECT * FROM documentos WHERE estado<>4 AND tipo='ORDEN DE COMPRA'";
$sql .= " ORDER BY FIELD(estado,'1','7','5','2', '0') DESC, entrega_ddp DESC LIMIT 100";
$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row2 = $result->fetch_assoc()) {
		$cod_documento=$row2["cod_documento"];
$tipo=$row2["tipo"];
$id_vendedor=$row2["id_vendedor"];
$id_cliente=$row2["id_cliente"];
$estado=$row2["estado"];
$fecha_creacion=$row2["fecha_creacion"];
$fecha_emision=$row2["fecha_emision"];
$total_venta=$row2["total_venta"];
$total_venta_neto=$row2["total_venta_neto"];
$e_numero_documento=$row2["e_numero_documento"];
$id_pago=$row2["id_pago"];
$observaciones=$row2["observaciones"];
$entrega_real=$row2["entrega_real"];
$entrega_comprometida=$row2["entrega_comprometida"];
$condicion=$row2["condicion"];
$referencia=$row2["referencia"];
$metodo=$row2["metodo"];
$bl=$row2["bl"];
$cod_forwarder=$row2["cod_forwarder"];

$entrega_bl=$row2["entrega_bl"];
$entrega_cif=$row2["entrega_cif"];
$entrega_ddp=$row2["entrega_ddp"];
$dias_a_bl=$row2["dias_a_bl"];
$dias_a_cif=$row2["dias_a_cif"];
$dias_a_ddp=$row2["dias_a_ddp"];

$doc_pi=$row2["doc_pi"];
$doc_ci=$row2["doc_ci"];
$doc_pl=$row2["doc_pl"];
$doc_oc=$row2["doc_oc"];
$doc_bl=$row2["doc_bl"];

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

//ALARMA

if ($entrega_ddp==NULL OR $entrega_ddp=="00-00-0000") {
$entrega_ddp_e_a=date("Y-m-d", strtotime($entrega_ddp_e));}
else {
$entrega_ddp_e_a=date("Y-m-d", strtotime($entrega_ddp));	
	}

$now = time(); // or your date as well
$entrega_ddp_e_a = strtotime($entrega_ddp_e_a);
$alarma = $now - $entrega_ddp_e_a;
if ($alarma>0 and $estado==2) { $alarma=0; }
$alarma=round($alarma / (60 * 60 * 24));

$entrega_comprometida_e_a=date("Y-m-d", strtotime($entrega_comprometida));
$entrega_comprometida_e_a = strtotime($entrega_comprometida_e_a);
$dias_totales=round(($entrega_ddp_e_a-$entrega_comprometida_e_a) / (60 * 60 * 24));

if ($alarma<-30) {$a_b="bgcolor='#e2ff66'";}
else if ($alarma<-20) {$a_b="bgcolor='#ffc966'";}
else if ($alarma<-10) {$a_b="bgcolor='#ff8484'";}
else if ($alarma<-5) {$a_b="bgcolor='#ff6363'";}
else if ($alarma<-2) {$a_b="bgcolor='#ff3838'";}
else if ($alarma<=0) {$a_b="bgcolor='#ff0000'";}
else { $a_b=""; }


//ALARMA

if ($estado==0) {$estado_text="PENDIENTE";}
if ($estado==1) {$estado_text="EMITIDA";}
if ($estado==2) {$estado_text="ACEPTADA";}
if ($estado==3) {$estado_text="CREDITO";}
if ($estado==4) {$estado_text="ELIMINADA";}
if ($estado==5) {$estado_text="REVISION";}
if ($estado==7) {$estado_text="REVISION COMERCIAL";}

if ($total_venta_neto==0) {
	
	$total_neto=$total_venta/1.19;
$iva=$total_venta-$total_neto;

}

else {
	
	$total_neto=$total_venta_neto;
	$total_venta=round($total_venta_neto*1.19);
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

?>
<tr <?php if ($estado=="2") { ?> bgcolor="#ffcccc" <?php } else if ($estado=="5") { ?> bgcolor="#91fbff" <?php } else if ($estado=="7") { ?> bgcolor="#e3a6ff" <?php } else {}  ?>>
		<td><a href="detalle_dcto.php?cod_documento=<?php echo $cod_documento; ?>"><?php echo $cod_documento; ?></a></td>
	
	
		<td><?php echo $nombre; ?></td>
		<td><?php echo $referencia; ?></td>
		
<?php if ($_SESSION["nivel"]=="1") { ?> 
	
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
<?php 

}
?>

</td>

<td><?php echo $cod_forwarder; ?></td>
<td <?php if ($doc_bl<>"") { echo 'bgcolor="#e8ffb5"'; } ?>>

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
<?php echo $bl; ?> </a>
<?php 

}
?>


</td>


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
<?php 

}
?>

</td>


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
<?php 

}
?>

</td>


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
<?php 

}
?>

</td>
<?php } ?> 

		<td><center><?php echo $condicion; ?></center></td>
		<td><?php echo $metodo; ?></td>
		
		<td><?php echo $entrega_comprometida; ?></td>
		<td><?php if ($entrega_real<>NULL AND $entrega_real<>"00-00-0000") {echo $entrega_real;} else {echo '<span style="background-color: #ffb075">'.$entrega_real_e.'</span>';} ?></td>
		<td><?php if ($entrega_bl<>NULL AND $entrega_bl<>"00-00-0000") {echo $entrega_bl;} else {echo '<span style="background-color: #ffb075">'.$entrega_bl_e.'</span>';} ?></td>
		<td><?php if ($entrega_cif<>NULL AND $entrega_cif<>"00-00-0000") {echo $entrega_cif;} else {echo '<span style="background-color: #ffb075">'.$entrega_cif_e.'</span>';} ?></td>
		<td bgcolor='#ffe311'><b><?php if ($entrega_ddp<>NULL AND $entrega_ddp<>"00-00-0000") {echo $entrega_ddp;} else {echo '<span style="background-color: #ffb075">'.$entrega_ddp_e.'</span>';} ?></b></td>
		
		<td <?php echo $a_b; ?>><center><b><?php if ($alarma<=0) {echo $alarma;} else {echo $dias_totales;}?></b></center></td>
		
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
