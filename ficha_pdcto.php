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
<html >
<head>
<title>Ficha Producto</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css"> 
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style>
.tab {border-collapse:collapse;}
.tab .first {border-bottom:1px solid #EEE;}
.tab .second {border-top:1px solid #CCC;box-shadow: inset 0 1px 0 #CCC;}​
</style>
</head>


<?php
include "connect.php";


$codigo_producto=$_GET['cod_producto']; 

//NOMBRE
$sql_cod = "SELECT * FROM productos WHERE id_producto='$codigo_producto'";
$result_cod = $db->query($sql_cod);

if ($result_cod->num_rows > 0) {
    // output data of each row
    while($row_cod = $result_cod->fetch_assoc()) {

$id=$row_cod["id_producto"];
$cod_pdcto_proveedor=$row_cod["cod_pdcto_proveedor"];
$nombre_producto=$row_cod["nombre"];
$tipo_prod=$row_cod["tipo_prod"];
$nombre_pdcto_proveedor=$row_cod["nombre_pdcto_proveedor"];
$nombre=str_replace('"',"'",$nombre);
$stock=$row_cod["stock"];
$precio_venta=$row_cod["precio_real_venta"];
$precio_costo=$row_cod["costo_neto"];

//$precio_real_venta=mssql_result($result,$i,"precio_real_venta");
$desc_venta=$row_cod["desc_comercial"];
$desc_venta=$desc_venta*100;
$cod_proveedor=$row_cod["cod_proveedor"];
$costo_neto=$row_cod["costo_neto"];
$costo_usd=$row_cod["costo_usd"];
$costo_eur=$row_cod["costo_eur"];
$precio_real_venta=$row_cod["precio_real_venta"];
$venta_neto=round($precio_real_venta/1.19);



//$precio_neto=mssql_result($result,$i,"precio_neto");
$descr=$row_cod["descripcion"];
$descripcion=$row_cod["description"];
//$descr=mssql_result($result,$i,"descr");
$imagen=$row_cod["imagen"];
//$precio_con_descuento=mssql_result($result,$i,"precio_con_descuento");
//$fecha_ultima_compra=mssql_result($result,$i,"fecha_ultima_compra");
//$fecha_ultima_compra=date("d-m-Y", strtotime($fecha_ultima_compra)); 
//$fecha_ultima_modificacion=mssql_result($result,$i,"fecha_ultima_modificacion");
//$fecha_ultima_modificacion=date("d-m-Y", strtotime($fecha_ultima_modificacion)); 
$u_medida=$row_cod["u_medida"];
//$fact_precio=mssql_result($result,$i,"fact_precio");
//$fact_desglo=mssql_result($result,$i,"fact_desglo");
//$pre_sec=$precio_real_venta*$fact_precio/$fact_desglo;
//$cod_sec=mssql_result($result,$i,"cod_sec");
$categoria=$row_cod["categoria"];
//$id_prov=mssql_result($result,$i,"id_prov");
//$imagen=mssql_result($result,$i,"imagen");
//$u_medida_2=mssql_result($result,$i,"u_medida_2");
//$granel=mssql_result($result,$i,"granel");
//$color_hex=mssql_result($result,$i,"color_hex");
$lumens=$row_cod["lumens"];
$temperatura=$row_cod["temperatura"];
$consumo=$row_cod["consumo"];
$factor_ddp=$row_cod["factor_ddp"];
$ip=$row_cod["ip"];
$ik=$row_cod["ik"];
$peso=$row_cod["peso"];
$dimension=$row_cod["dimension"];
$zona=$row_cod["zoma"];
$imagen=$row_cod["imagen"];
//$ml=mssql_result($result,$i,"ml");

$color_luz=$row_cod["color_luz"];
$color_equipo=$row_cod["color_equipo"];
$ekit=$row_cod["ekit"];
$input_volt=$row_cod["input_volt"];
$eficiencia=$row_cod["eficiencia"];
$tipo_control=$row_cod["tipo_control"];
$driver=$row_cod["driver"];

$moneda_origen=$row_cod["moneda_origen"];

//TODAS LAS CATEGORIAS

$sql_cat = "SELECT * FROM categorias WHERE id_categoria='$categoria'";
$result_cat = $db->query($sql_cat);

if ($result_cat->num_rows > 0) {
    // output data of each row
    while($row_cat = $result_cat->fetch_assoc()) {
$nombre_cat=$row_cat["nombre_cat"];
    }
} else {
    echo "0 results";
}

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


if ($temperatura<>"") { $temperatura=$temperatura." K"; }
if ($consumo<>"") { $consumo=$consumo." W"; }
if ($ip<>"" AND $ip<>0) { $ip="IP ".$ip; } else {$ip="";}
if ($ik<>"" AND $ik<>0) { $ik="IK ".$ik; } else {$ik="";}
if ($dimension<>"") { $dimension="&Oslash; ".$dimension; }
    }
} else {
    
}



?>
<body>


<table class="tab" border="0" width="600">	
	<tr>
	<td width="300" border=0>
	<img src="logocot.png" ALT="CROMATIX">
	</td>
	<td>
		
	</td>
	</tr>
	</table>




 <table class="tablacomp" border="1" width="600">
		 
<tr>
<td>

	 <table class="gridtable" border="1">
		 <tr>
		 <th>Imagen Referencial:</th>		 
		 </tr>
		 <tr>
		 <td align="center">
		 <?php 
		 
		 $filename='cromatiximg/'.$imagen;
		 echo  '<img src="'.$filename.'" style="width:290px;">';
		 
		 ?>	 
		 </td>
		 </tr>

		 
		 </table>


</td>
<td valign="top">
<br>
Nombre Producto:<br>
<b><font size="3"><?php echo $nombre_producto; ?></font></b><?php echo " SKU: ".$id; ?>
<br>
<br>

   <table class="tablacomp" border="1" width="290">
		  <thead>
<tr>
<th>
Categoria</th>
<td colspan=2><?php echo $nombre_cat; ?></td>
</tr>

</table><br>

   <table class="tablacomp" border="1" width="290">
		  
<tr>



<th><?php echo "Consumo"; ?></th>
<th><?php echo "Color Luz"; ?></th>
<th><?php echo "Color Equipo"; ?></th>


</tr>
 </thead>
<tr>
	<td align="center"><?php if ($consumo<>"0 W") { echo $consumo; } else {} ?></td>
<td align="center" <?php if ($cf_color_luz<>'') {echo 'bgcolor="'.$cf_color_luz.'"';} ?>><?php if ($temperatura<>"0 K") {echo $temperatura;} else if ($color_luz<>"") { if ($color_luz=="RGBW") { echo "<font color='red'>R</font><font color='green'>G</font><font color='blue'>B</font><font color='black'>W</font>"; } else if ($color_luz=="RGB") { echo "<font color='red'>R</font><font color='green'>G</font><font color='blue'>B</font>"; } else {echo $color_luz;} } else {} ?></td>
<td align="center" <?php if ($cf_color_equipo<>'') {echo 'bgcolor="'.$cf_color_equipo.'"';} ?>><font color="<?php echo $cl;?>"><?php echo $color_equipo; ?></font></td>


</tr>

<tr>
<th colspan=3>Descripcion</th>
</tr>
<tr>
<td colspan=3><?php echo "$descr"; ?></td>
</tr>

</td>
</tr>

</table>
<br>
   <table class="tablacomp" border="1" width="290">
<tr>
<th>IP / IK</th>
<th colspan=2>Dimension</th>
</tr>		
<tr>

<td align="center"><?php if ($ip<>"" AND $ik=="") {echo $ip;} else if ($ip<>"" AND $ik<>"")  {echo $ip." / ".$ik;}?> </td>
<td colspan=2 align="center"><?php echo $dimension; ?></td>

</tr>
<tr>
<th>Driver</th>
<th>eKIT</th>
<th>Peso</th>
</tr>
<tr>
<td><?php echo "$driver"; ?></td>
<td><?php echo "$ekit"; ?></td>
<td><?php echo "$peso"; ?></td>
</tr>
</table>


</table>
<br>

<table class="tablacot" border="1" width="610">
	<tr><th><center>
MAIL: INFO@CROMATIX.CL - WWW.CROMATIX.CL</center>
	</th>
	</tr>

	</table>


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
