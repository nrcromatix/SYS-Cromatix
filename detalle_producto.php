<?php

	 ini_set('session.cache_limiter','public');
session_cache_limiter(false);

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

<link rel="stylesheet" type="text/css" href="stylesheet.css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script type="text/javascript" src="../css/view.js"></script>

<script type="text/javascript">



//function updatepventa() {
//document.formulario.precio_real_venta.value = Math.round((document.formulario.costo_neto.value * (1+document.formulario.porc_utilidad.value/100))*1.19/10)*10;
//document.formulario.precio_neto.value = Math.round(document.formulario.precio_real_venta.value/1.19/10)*10;
 //}

function modifprecio() {
document.formulario.precio_real_venta.value = Math.round(document.formulario.venta_neto.value*1.19);
document.formulario.porc_utilidad.value = ((document.formulario.precio_real_venta.value/(1.19*document.formulario.costo_neto.value))-1)*100; 
}

//function updateprecioneto() {
//document.formulario.venta_neto.value = Math.round(document.formulario.precio_real_venta.value/1.19);
 //}

 //function cambia_precio() {
//updateputilidad();
//updatepventa();
 //}
 
  function updatemoneda() {
	  var VALOR
	  if (document.formulario.moneda_origen.value=='EUR') {VALOR=EUR;}
	  else if (document.formulario.moneda_origen.value=='CLP') {VALOR=CLP;}
	  else if (document.formulario.moneda_origen.value=='USD') {VALOR=USD;}
document.formulario.valor_moneda.value = VALOR;
 }
 
   function recalcular() {
document.formulario.costo_neto.value = document.formulario.costo_usd.value*document.formulario.valor_moneda.value;
document.formulario.precio_real_venta.value = Math.round((document.formulario.costo_neto.value * (1+document.formulario.porc_utilidad.value/100))*1.19/10)*10;
document.formulario.venta_neto.value = Math.round(document.formulario.precio_real_venta.value/1.19);
document.formulario.valor_utilizado.value=Math.round(document.formulario.costo_neto.value/document.formulario.costo_usd.value);
return false;
 }

//function updatedescventa() {
//document.formulario.desc_venta.value = -((document.formulario.precio_con_descuento.value/(document.formulario.precio_real_venta.value))-1)*100; }
	
function actualiza_fecha() {
	   var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
    var today = dd+'-'+mm+'-'+yyyy;
document.formulario.fecha_ultima_compra.value = today; }

function validarForm(formulario) {
  
    if(document.formulario.categoria.value=="" || document.formulario.categoria.value== 0 || document.formulario.categoria.value== null) { //Debe ser distinto de vacío
    document.formulario.categoria.focus();    // Damos el foco al control
    alert('Debe llenar el campo de categoria.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
  
 
  return true; //Si ha llegado hasta aquí, es que todo es correcto
}

</script>





</head>

<?php
include "connect.php";

$cod_producto = $_GET["cod_producto"];

//$result = mssql_query("SELECT * FROM Productos WHERE cod_producto='$cod_producto'");
//$num=mssql_num_rows($result);

$sql_cod = "SELECT * FROM productos WHERE id_producto='$cod_producto'";
$result_cod = $db->query($sql_cod);

if ($result_cod->num_rows > 0) {
    // output data of each row
    while($row_cod = $result_cod->fetch_assoc()) {
        



$id=$row_cod["id_producto"];
$cod_pdcto_proveedor=$row_cod["cod_pdcto_proveedor"];
$nombre=$row_cod["nombre"];
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
if ($precio_real_venta==$costo_neto) {
	$porc_utilidad=1.3;
	}
else { $porc_utilidad=($venta_neto/$costo_neto)-1; }
$porc_utilidad=$porc_utilidad*100;

$valor_utilizado=round($costo_neto/$costo_usd);

//$precio_neto=mssql_result($result,$i,"precio_neto");
$descr=$row_cod["descripcion"];
$description=$row_cod["description"];
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

    }
} else {
    echo "0 results";
}

$sql_pm = "SELECT * FROM param_globales";
$result_pm = $db->query($sql_pm);

if ($result_pm->num_rows > 0) {
    // output data of each row
    while($row_pm = $result_pm->fetch_assoc()) {
        
$nombre_moneda=$row_pm["nombre"];
$valor_moneda=$row_pm["valor"];

if ($nombre_moneda=="CLP") {$valor_CLP=$valor_moneda;}
if ($nombre_moneda=="USD") {$valor_USD=$valor_moneda;}
if ($nombre_moneda=="EUR") {$valor_EUR=$valor_moneda;}

    }
} else {
    echo "0 results";
}



$apiUrl = 'https://mindicador.cl/api';
//Es necesario tener habilitada la directiva allow_url_fopen para usar file_get_contents
if ( ini_get('allow_url_fopen') ) {
	
    $json = @file_get_contents($apiUrl);
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

if($json === FALSE) { 
	$valor_USD=820; //CAMBIAR ACA VALORES FIJOS DE DOLAR PROPUESTO
	$valor_EUR=900; //CAMBIAR ACA VALORES FIJOS DE EURO PROPUESTO
	$fixed_warning="<font size='1' color='red'>FIXED</font>";
	 }

if ($moneda_origen=="CLP") {$valor_moneda=$valor_CLP;}
if ($moneda_origen=="USD") {$valor_moneda=$valor_USD;}
if ($moneda_origen=="EUR") {$valor_moneda=$valor_EUR;}

?>
<script type="text/javascript">
var CLP = <?php echo $valor_CLP;?>;
var USD = <?php echo $valor_USD;?>;
var EUR = <?php echo $valor_EUR;?>;
</script>
<?php
//COD BARRA
//$result_cf = mssql_query("SELECT * FROM codigos_fabricante WHERE cod_producto='$cod_producto'");
//$num_cf=mssql_num_rows($result_cf);


//CATEGORIA
//$result_nom1 = mssql_query("SELECT * FROM categorias WHERE id_cat='$id_cat'");
//$nombre_cat1=mssql_result($result_nom1,0,"nombre_cat");

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
 
$sql_pro = "SELECT * FROM directorio WHERE cod_directorio='$cod_proveedor'";
$result_pro = $db->query($sql_pro);

if ($result_pro->num_rows > 0) {
    // output data of each row
    while($row_pro = $result_pro->fetch_assoc()) {
$nombre_proveedor=$row_pro["nombre"];
    }
} else {
    echo "0 results";
}


?>


<body>
	
	
	
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "header.php";?>
</table>	
<br>

<ul>
	


<form id="form_980511" class="appnitro"  name="formulario" method="post" action="modifica_producto.php?cod_producto=<?php echo "$id"; ?>" onsubmit="return validarForm(this);">
 <table class="gridtable" border="1">
<tr>
<th><?php echo "Codigo Cromatix"; ?> <font color="red"><b>(*)</b></font></th>
<td><input size="20" name="id" class="element text medium" type="text" maxlength="255" value="<?php echo $id; ?>" readonly/></td>
<th><?php echo "Codigo Proveedor"; ?> <font color="red"><b>(*)</b></font></th>
<td><input size="20" name="cod_pdcto_proveedor" class="element text medium" type="text" maxlength="255" value="<?php echo $cod_pdcto_proveedor; ?>"/>

<a href="copiar_producto.php?cod_producto=<?php echo "$id"; ?>">
<img border="0" align="bottom" alt="Copiar" src="copy.png" width="20" height="20">
</a>

</td>
</tr>
<tr>
<th><?php echo "Nombre Cromatix"; ?> <font color="red"><b>(*)</b></font></th><td colspan=3><input size="80" name="nombre" autofocus="autofocus" class="element text medium" type="text" maxlength="255" value="<?php echo $nombre; ?>"/> </td>
</tr>
<tr>
<th><?php echo "Nombre Proveedor"; ?> <font color="red"><b>(*)</b></font></th><td colspan=3><input size="80" name="nombre_proveedor" class="element text medium" type="text" maxlength="255" value="<?php echo $nombre_pdcto_proveedor; ?>"/> </td>
</tr>
<tr>
<th><?php echo "Categoria"; ?> <font color="red"><b>(*)</b></font></th><td>
	
<select name="categoria">
	
 <?php
$sql2 = "SELECT * FROM categorias ORDER BY nombre_cat";
$result2 = $db->query($sql2);
echo '<option value="'.$categoria.'" default>'.$nombre_cat.'</option>';
if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
        echo '<option value="'.$row2["id_categoria"].'">'.$row2["nombre_cat"].'</option>';
    }
} else {
    echo "0 results";
}

?>


</select>

</td>

<th>Proveedor Principal <font color="red"><b>(*)</b></font></th>

<td>

<select name="prov">

 <?php
$sql3 = "SELECT * FROM directorio WHERE tipo=0 ORDER BY nombre";
$result3 = $db->query($sql3);
 echo '<option value="'.$cod_proveedor.'" default>'.$nombre_proveedor.'</option>';
if ($result3->num_rows > 0) {
    // output data of each row
    while($row3 = $result3->fetch_assoc()) {
        echo '<option value="'.$row3["cod_directorio"].'">'.$row3["nombre"].'</option>';
    }
} else {
    echo "0 results";
}

?>



</select>

</td>

</tr>

    </table>


<br>
<?php 
if ($_SESSION["nivel"]<>1) {
?>
<p hidden>
<?php
    }
    ?>

 <br>
 <table class="gridtable" border="1">
<tr>
<th><?php echo "Costo CLP($)"; ?></th><td><input size="10" name="costo_neto" type="text" maxlength="255" value="<?php echo "$costo_neto"; ?>"  readonly /> </td>
<th><?php echo "Costo Origen"; ?></th><td><input size="10" name="costo_usd" type="text" maxlength="255" value="<?php echo "$costo_usd"; ?>" /> </td>
<th><?php echo "Moneda Origen"; ?></th>
<td>
	<select name="moneda_origen" onChange="updatemoneda()">
<option value="USD" <?php if ($moneda_origen=="USD") {echo "selected";} ?>>USD</option>
<option value="CLP" <?php if ($moneda_origen=="CLP") {echo "selected";} ?>>CLP</option>
<option value="EUR" <?php if ($moneda_origen=="EUR") {echo "selected";} ?>>EUR</option>
</select>
	 </td>
</tr>
<tr>
<th><?php echo "Utilidad (%)"; ?></th><td><input size="10" name="porc_utilidad" type="text" maxlength="255" value="<?php echo "$porc_utilidad"; ?>"  /> </td>
<td colspan=2 align="center" >
Utilizado: <input size="5" name="valor_utilizado" type="text" maxlength="255" value="<?php echo "$valor_utilizado"; ?>" readonly/>
<button type="button" onclick="return recalcular();">Ajustar Moneda</button></td>
<td colspan=2 align="center" >Valor Hoy: <input size="5" name="valor_moneda" type="text" maxlength="255" value="<?php echo "$valor_moneda"; ?>" /> <?php echo $fixed_warning; ?></td>
</tr>


    </table>
    
<?php
    if ($_SESSION["nivel"]<>1) {
    ?>
</p>
<?php
    }
    ?>

<br>

 <table class="gridtable" border="1">
	 
<tr>
<th><?php echo "Stock"; ?>

<a href="ver_historia.php?cod_producto=<?php echo "$id"; ?>">
<img border="0" align="bottom" alt="Copiar" src="history.png" width="20" height="20">
</a>

</th><td><input size="10" name="stock" type="text" maxlength="255" value="<?php echo "$stock";  ?>" <?php if ($_SESSION["user"]<>'alesgare') { echo 'readonly'; }  ?>/> </td>
<th><?php echo "Zona/Bodega"; ?></th><td><input size="10" name="zona" type="text" maxlength="255" value="<?php echo "$zona"; ?>" /> </td>
	<th>Tipo</th>
	
			
	<td>
	<select name="tipo_prod" >
<option value="0" <?php if ($tipo_prod=="0") {echo "selected";} ?>>Tipo 0</option>
<option value="1" <?php if ($tipo_prod=="1") {echo "selected";} ?>>Tipo 1</option>

</select>
	 </td>
	


</tr>

<tr>
<th><?php echo "Venta Neto ($)"; ?></th><td><input size="10" name="venta_neto" type="text" maxlength="255" value="<?php echo "$venta_neto"; ?>"  <?php if ($_SESSION["nivel"]<>1) { ?> readonly <?php }?> onChange="modifprecio()" /> </td>
<th><?php echo "Venta + IVA ($)"; ?></th><td><input size="10" name="precio_real_venta" type="text" maxlength="255" value="<?php echo "$precio_real_venta"; ?>"  readonly /> </td>
<th><?php echo "Descuento Comercial (%)"; ?></th><td><input size="10" name="desc_venta" type="text" maxlength="255" value="<?php echo "$desc_venta"; ?>"  <?php if ($_SESSION["nivel"]<>1) { ?> readonly <?php }?> /> </td>
</tr>
 </table>
    
<br>
 <table class="gridtable" border="1">
	 
<tr>
<th><?php echo "Unidad de Medida"; ?></th><td><input size="10" name="u_medida" type="text" maxlength="255" value="<?php echo "$u_medida"; ?>" /> </td>
<th><?php echo "Lumens"; ?></th><td><input size="10" name="lumens" type="text" maxlength="255" value="<?php echo "$lumens"; ?>" /> </td>
<td rowspan=6>

	 <table class="gridtable" border="1">
		 <tr>
		 <th>Imagen Referencial:</th>		 
		 </tr>
		 <tr>
		 <td align="center">
		 <?php 
		 
		 $filename='cromatiximg/'.$imagen;
		 echo  '<img src="'.$filename.'" style="width:200px;height:150px;">';
		 
		 ?>	 
		 </td>
		 </tr>
		 <tr>
		 <td align="center">
		 <input size="6" name="imagen" type="text" maxlength="255" value="<?php echo "$imagen"; ?>"/> <a href="ficha_producto.php?cod_producto=<?php echo "$cod_producto"; ?>"><input type="button" value="Ver Ficha" /></a>  <a href="genera_sticker.php?cod_producto=<?php echo "$cod_producto"; ?>">
   <input type="button" value="PDF" /></a> 
		 </td>
		 
		 </tr>
		 
		 </table>



</td>
</tr>


<tr>
<th><?php echo "Temperatura (K)"; ?></th><td><input size="10" name="temperatura" type="text" maxlength="255" value="<?php echo "$temperatura"; ?>" /> </td>
<th><?php echo "Consumo (W)"; ?></th><td><input size="10" name="consumo" type="text" maxlength="255" value="<?php echo "$consumo"; ?>" /> </td>
</tr>
<tr>
<th><?php echo "Color de Luz"; ?></th><td><input size="10" name="color_luz" type="text" maxlength="255" value="<?php echo "$color_luz"; ?>" /> </td>
<th><?php echo "Color Equipo"; ?></th><td><input size="10" name="color_equipo" type="text" maxlength="255" value="<?php echo "$color_equipo"; ?>" /> </td>
</tr>
<tr>
<th><?php echo "CRI:>"; ?></th><td><input size="10" name="factor_ddp" type="text" maxlength="255" value="<?php echo "$factor_ddp"; ?>" /> </td>
<td align="center"><?php echo "IP "; ?><input size="2" name="ip" type="text" maxlength="255" value="<?php echo "$ip"; ?>" /> </td>
<td align="center"><?php echo "IK "; ?><input size="2" name="ik" type="text" maxlength="255" value="<?php echo "$ik"; ?>" /> </td>
</tr>

<tr>
<th><?php echo "Peso (KG)"; ?></th><td><input size="10" name="peso" type="text" maxlength="255" value="<?php echo "$peso"; ?>" /> </td>
<th><?php echo "Dimension (mm) <br>[LxWxH]"; ?></th><td><input size="10" name="dimension" type="text" maxlength="255" value="<?php echo "$dimension"; ?>" /> </td>
</tr>
<tr>
	<th><?php echo "E-Kit"; ?></th><td>
		<select name="ekit">
	
 <?php
	if ($ekit==0) {echo '<option value="'.$ekit.'">NO</option>';}
	else { echo '<option value="'.$ekit.'">SI</option>';}
        
        echo '<option value="0">NO</option>';
        echo '<option value="1">SI</option>';
        
?>


</select>
	 </td>
	<th><?php echo "Voltaje de Entrada"; ?></th><td><input size="10" name="input_volt" type="text" maxlength="255" value="<?php echo "$input_volt"; ?>" /> </td>

</tr>
<tr>
	<th><?php echo "Eficiencia"; ?></th><td><input size="10" name="eficiencia" type="text" maxlength="255" value="<?php echo "$eficiencia"; ?>" /> </td>
	<th><?php echo "Tipo Control"; ?></th><td><input size="10" name="tipo_control" type="text" maxlength="255" value="<?php echo "$tipo_control"; ?>" /> </td>



</tr>
<tr>
	<th><?php echo "Driver"; ?></th><td><input size="10" name="driver" type="text" maxlength="255" value="<?php echo "$driver"; ?>" /> </td>
	

</tr>
    </table>
    
       
<br>
 <table class="gridtable" border="1">
	 
<tr>
<th>Descripci&oacute;n:</th>
<td colspan=4 ><textarea name="descr" ROWS=10 COLS=100><?php echo $descr;?></textarea></td>

</tr>

    </table>
       <br>
       <table class="gridtable" border="1">
	 
<tr>
<th>Description:</th>
<td colspan=4 ><textarea name="description" ROWS=10 COLS=100><?php echo $description;?></textarea></td>

</tr>

    </table>
       <br>
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Modificar" />


    <br>



		
		
		</form>		
	<br>




<?php
//mssql_close();
?>
<form id="form1" name="upload" action="upload.php?cod_producto=<?php echo $id;?>" method="post" enctype="multipart/form-data">

    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">

</form>


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
