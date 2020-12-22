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

<link rel="stylesheet" type="text/css" href="stylesheet.css">

<script type="text/javascript" src="../css/view.js"></script>

<script type="text/javascript">

function updatepventa() {
document.formulario.precio_real_venta.value = Math.round((document.formulario.precio_costo.value * (1+document.formulario.porc_utilidad.value/100))*1.19/10)*10;
updateputilidad();
define_dcto();
updatepreciodcto();
document.formulario.precio_neto.value = document.formulario.precio_real_venta.value/1.19;
 }

function updateputilidad() {
document.formulario.porc_utilidad.value = ((document.formulario.precio_real_venta.value/(1.19*document.formulario.precio_costo.value))-1)*100; 
document.formulario.precio_neto.value = document.formulario.precio_real_venta.value/1.19;}

function updatepreciodcto() {
document.formulario.precio_con_descuento.value = Math.round((document.formulario.precio_real_venta.value * (1-document.formulario.desc_venta.value/100))/10)*10;
updatedescventa();
 }
 
  function define_dcto() {
if (document.formulario.porc_utilidad.value<29) { document.formulario.desc_venta.value=0; }
else { document.formulario.desc_venta.value=(5*document.formulario.porc_utilidad.value+70)/57; }
 }

function updatedescventa() {
document.formulario.desc_venta.value = -((document.formulario.precio_con_descuento.value/(document.formulario.precio_real_venta.value))-1)*100; }

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
  
    if(document.formulario.nombre.value=="" || document.formulario.nombre.value== null) { //Debe ser distinto de vacío
    document.formulario.nombre.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
      if(document.formulario.categoria.value=="SIN CATEGORIA") { //Debe ser distinto de vacío
    document.formulario.categoria.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
        if(document.formulario.prov.value=="SIN PROVEEDOR") { //Debe ser distinto de vacío
    document.formulario.prov.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
      if(document.formulario.stock.value=="" || document.formulario.stock.value== null) { //Debe ser distinto de vacío
    document.formulario.stock.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
      if(document.formulario.precio_costo.value=="" || document.formulario.precio_costo.value== null) { //Debe ser distinto de vacío
    document.formulario.precio_costo.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
      if(document.formulario.porc_utilidad.value=="" || document.formulario.porc_utilidad.value== null) { //Debe ser distinto de vacío
    document.formulario.porc_utilidad.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
      if(document.formulario.precio_real_venta.value=="" || document.formulario.precio_real_venta.value== null) { //Debe ser distinto de vacío
    document.formulario.precio_real_venta.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
        if(document.formulario.desc_venta.value=="" || document.formulario.desc_venta.value== null) { //Debe ser distinto de vacío
    document.formulario.desc_venta.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
        if(document.formulario.precio_con_descuento.value=="" || document.formulario.precio_con_descuento.value== null) { //Debe ser distinto de vacío
    document.formulario.precio_con_descuento.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
        if(document.formulario.precio_neto.value=="" || document.formulario.precio_neto.value== null) { //Debe ser distinto de vacío
    document.formulario.precio_neto.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
          if(document.formulario.precio_neto.value=="" || document.formulario.precio_neto.value== null) { //Debe ser distinto de vacío
    document.formulario.precio_neto.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
            if(document.formulario.ultimo_prov.value=="" || document.formulario.ultimo_prov.value== null) { //Debe ser distinto de vacío
    document.formulario.ultimo_prov.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
 
  return true; //Si ha llegado hasta aquí, es que todo es correcto
}
</script>





</head>

<?php
include "connect.php";


 

//DESPLIEGO CATEGORIAS
//$result5 = mssql_query($query2);
//$num5=mssql_num_rows($result5);

//$querysc="SELECT * FROM categorias WHERE parent_cat<>0";
//$querysc.=" ORDER BY nombre_cat ASC";
//$resultsc = mssql_query($querysc);
//$numsc=mssql_num_rows($resultsc);

//$querysc2="SELECT * FROM categorias WHERE parent_cat<>0";
//$querysc2.=" ORDER BY nombre_cat ASC";
//$resultsc2 = mssql_query($querysc2);
//$numsc2=mssql_num_rows($resultsc2);


////CARGA BASE DE PROVEEDORES
//$query32="SELECT * FROM proveedores";
//$query32.=" ORDER BY nombre_fantasia ASC";
 
//$result32 = mssql_query($query32);
//$num32=mssql_num_rows($result32);

?>


<body>
	
	
	
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "header.php";?>
</table>	
<br>

<ul>
	


<form id="form_980511" class="appnitro"  name="formulario" method="post" action="crea_producto.php" onsubmit="return validarForm(this);">
 <table class="gridtable" border="1">
<tr>
<th><?php echo "Nombre Producto Cromatix"; ?> <font color="red"><b>(*)</b></font></th><td colspan=3><input size="80" name="nombre" autofocus="autofocus" class="element text medium" type="text" maxlength="255" value=""/> </td>
</tr>
<tr>
<th><?php echo "Nombre Producto Proveedor"; ?> <font color="red"><b>(*)</b></font></th><td colspan=3><input size="80" name="nombre_proveedor" class="element text medium" type="text" maxlength="255" value=""/> </td>
</tr>
<tr>
<th><?php echo "Categoria"; ?> <font color="red"><b>(*)</b></font></th><td>
	
<select name="categoria">
 <?php
$sql2 = "SELECT * FROM categorias ORDER BY nombre_cat";
$result2 = $db->query($sql2);

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



				<input id="saveForm" class="button_text" type="submit" name="submit" value="Crear" />


		
		
		</form>		
	<br>




<?php
//mssql_close();
?>



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
