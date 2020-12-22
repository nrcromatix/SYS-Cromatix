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
$monto_descuento_neto=$row2["monto_descuento_neto"];
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
$metodo=$row2["metodo"];
$moneda=$row2["moneda"];
$concepto=$row2["concepto_compra"];

if ($moneda<>"CLP") { $d=2;} else {$d=0;}

if ($total_venta_neto==0) {
	
	$total_venta=$total_venta-$monto_descuento_neto*1.19;
	$total_neto=$total_venta/1.19;
	$iva=$total_venta-$total_neto;

}

else {
	
	$total_neto=$total_venta_neto-$monto_descuento_neto;
	$total_venta=$total_neto*1.19;
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


if ($tipo=="ORDEN DE COMPRA") { $tipo_tx="ORDER SHEET";} else {$tipo_tx=$tipo;}

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
 <table class="tab" border="0" width="600">	
	<tr>
	<td width="400" border=0>
	<img src="logocot.png" ALT="CROMATIX">
	</td>
	<td>
		<table class="cot" border=4 width="190">
			<tr><td border=0>	
		<center>
	<b>
	<font size="3">	CROMATIX SPA</font><br>
R.U.T.: 76.836.147-9
<br><br>
<font size="4"><?php echo "$tipo_tx"; ?>
<br><br>
N&deg;: <?php echo " ".$cod_documento; ?><br></font>
<font color="red"><?php echo "$referencia"; ?></font>
</center></b>
</td></tr>
</table>
	</td>
	</tr>
	</table>
	<br>
	
 <table class="tablacot" border="1" width="600">
<tr>
<th>Doc. Name</th><th>Doc. Number</th><th>Date Created</th><th>User</th>

</tr>
<tr>
<td><?php echo "$tipo"; ?></td><td><?php echo "$cod_documento"; ?></td><td><?php echo "$fecha_creacion"; ?></td><td><?php echo "$nombre_vendedor"; ?></td>

</tr>
<tr>
<th>Supplier</th>
<td><?php echo $rut; ?></td>
<td colspan=2 ><b><?php echo $nombre_cliente; ?></b></td>
</tr>
<tr>
<th>Condition</th>
<td><b><?php echo '<span style="background-color: #ffff00">'.$condicion.'</span>'; ?></b></td>
<td colspan=2 ><?php echo $direccion.", ".$comuna.", ".$ciudad; ?></td>
</tr>
<tr>
<th>Shipping Method</th><td><b><?php echo '<span style="background-color: #ffff00">'.$metodo.'</span>'; ?></b></td>
<th>Project / Ref:</th><td><b><?php echo '<span style="background-color: #ffff00">'.$referencia.'</span>'; ?></b></td>
</tr>



    </table>
    
    
   
   <h2>List of Items:</h2>


     <table class="tablacomp" border="1" width="600">

		  <thead>
				  <tr>
 <td colspan="11" align="right">Currency: <?php echo $moneda;?></td>

</tr>	 
<tr>
<th>Cromatix COD</th>
	<th>Factory COD</th>
<th>Item</th>
<th>Ref.</th>
<th>Supplier Name</th>
<th>Cromatix Name</th>
<th>Power</th>
<th>Light Color</th>
<th>Equipment Color</th>

<th>Qty</th>
<?php if ($tipo<>"RFQ") { ?>
<th>Unit Price</th>
<th>Total</th>
<?php } ?>
</tr>
</thead>

	
		<?php		
//$total_neto=0;			
$sql3 = "SELECT * FROM detalle_documento WHERE cod_documento='".$cod_documento."' ORDER BY orden DESC";
$result3 = $db->query($sql3);
if ($result3->num_rows > 0) {
	while($row = $result3->fetch_assoc()) {
$cod_producto=$row["cod_producto"];
$cantidad=$row["cantidad"];
$monto_unitario_venta=$row["monto_unitario_venta"];
$monto_total_venta=$row["monto_total_venta"];
$item=$row["item"];

//if ($tipo=="ORDEN DE COMPRA") {
//$monto_total_venta=$cantidad*$monto_unitario_venta;
//$total_neto=$monto_total_venta+$total_neto;


//}


//NOMBRE
$sql_n = "SELECT * FROM productos WHERE id_producto='".$cod_producto."'";
$result_n = $db->query($sql_n);
if ($result_n->num_rows > 0) {
	while($row_n = $result_n->fetch_assoc()) {
$nombre_producto=$row_n["nombre"];
$nombre_pdcto_proveedor=$row_n["nombre_pdcto_proveedor"];
$cod_pdcto_proveedor=$row_n["cod_pdcto_proveedor"];
$imagen=$row_n["imagen"];
$description=$row_n["description"];
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
if ($color_equipo=="BLANCO") {$cf_color_equipo="#ffffff"; $color_equipo="WHITE";}
else if ($color_equipo=="NEGRO") {$cf_color_equipo="#000000"; $cl="#ffffff"; $color_equipo="BLACK";}
else if ($color_equipo=="ALUMINIO") {$cf_color_equipo="#afafaf"; $color_equipo="ALUMINIUM";}
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
<td align="center"><b><?php echo $cod_producto; ?></b></td>	
  <td align="center" bgcolor='<?php echo $color_p;?>'><b><?php echo $cod_pdcto_proveedor; ?></b></td>
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

<?php if ($moneda<>"CLP") { $d=2;} else {$d=0;} ?>

<td><b><?php echo $nombre_pdcto_proveedor; ?></b></td>
<td><b><?php echo $nombre_producto; ?></b></td>
<td align="center"><?php if ($consumo<>"0 W") { echo $consumo; } else {} ?></td>
<td align="center" <?php if ($cf_color_luz<>'') {echo 'bgcolor="'.$cf_color_luz.'"';} ?>><?php if ($temperatura<>"0 K") {echo $temperatura;} else if ($color_luz<>"") { if ($color_luz=="RGBW") { echo "<font color='red'>R</font><font color='green'>G</font><font color='blue'>B</font><font color='black'>W</font>"; } else if ($color_luz=="RGB") { echo "<font color='red'>R</font><font color='green'>G</font><font color='blue'>B</font>"; } else {echo $color_luz;} } else {} ?></td>
<td align="center" <?php if ($cf_color_equipo<>'') {echo 'bgcolor="'.$cf_color_equipo.'"';} ?>><font color="<?php echo $cl;?>"><?php echo $color_equipo; ?></font></td>


<td align="center"><b><?php echo "$cantidad"; ?></b></td>
<?php if ($tipo<>"RFQ") { ?>
	<?php if ($moneda<>"CLP") { $d=2;} else {$d=0;} ?>
<td align="right"><b><?php echo "$".number_format("$monto_unitario_venta",2,",","."); ?></b></td>
<td align="right"><b><?php echo "$".number_format("$monto_total_venta",2,",",".");?></b></td>
<?php } ?>
</tr>

<tr> <?php
if ($imagen<>"sinfoto.jpg") {
echo "<td colspan=3></td>";
 } 
else {
	
	echo "<td colspan=4></td>";
	}
 
 ?>
<td colspan=4><?php echo "$description"; ?></td>
<td align="center"><?php if ($ip<>"" AND $ik=="") {echo $ip;} else if ($ip<>"" AND $ik<>"")  {echo $ip." / ".$ik;}?> </td>
<td colspan=3 align="center"><?php echo $dimension; ?></td>

</tr>

    
<?php

    }
} else {
    
}

?>

<?php if ($tipo<>"RFQ") { ?>

<?php 

if ($total_venta_neto<>0) { $descuento_p=round($monto_descuento_neto/$total_venta_neto*100,2); } else { $descuento_p=0;} 

if ($monto_descuento_neto<>0) { ?>
<tr>
 <th colspan="8" align="right">Descuento Global Neto:</th><td colspan="4" align="right"><font size="2"><?php echo "(".$descuento_p." %) - $ ".number_format("$monto_descuento_neto",2,",",".");?></font></td>

</tr>
<?php } ?>
<tr>
 <th colspan="8" align="right">Total:</th><td colspan="4" align="right"><font size="2"><?php echo "$ ".number_format("$total_neto",$d,",",".");?></font></td>

</tr>


<?php } ?>



<!--
<tr>
 <th colspan="8" align="right">N&uacute;mero de Items Ingresados:</th><td align="right"><?php echo $row;?></td>
</tr>
-->


	
	
    </table>
    
    	<br>
	
	<?php if ($observaciones<>"") { ?>
	
	<table class="tablacot" border="1" width="600">
	<tr><td>
		
		<b>ADDITIONAL REQUIREMENTS</b>
<br>
<?php echo '<span style="background-color: #ffff00">'.$observaciones.'</span>'; ?>
	</td>
	</tr>

	</table>
	
	<br>
    <?php } ?>
		

<table class="tablacot" border="1" width="600">
	<tr><th><center>
E-MAIL: INFO@CROMATIX.CL - WWW.CROMATIX.CL</center>
	</th>
	</tr>

	</table>
	
	
	<br>
	
	

<!--
    <form method="post" action="email_send.php?id_dcto=<?php echo "$id_dcto"; ?>&tipo_dcto=<?php echo "$tipo_dcto"; ?>">
<input type="submit" value="Enviar por eMail">
 </form>
-->
   


</ul>

	
	</body>
</html>

<?php


//TERMINA
}
}
else
{
header("Location:../login.php");
}
?>
