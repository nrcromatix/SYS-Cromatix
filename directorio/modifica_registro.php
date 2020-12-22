<html >
<head>

<link rel="stylesheet" type="text/css" href="../stylesheet.css">

<script type="text/javascript">
function validarForm(formulario) {
  
    if(document.formulario.razon_social.value=="" || document.formulario.razon_social.value== null) { //Debe ser distinto de vacío
    document.formulario.razon_social.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
      if(document.formulario.rut_cliente.value=="" || document.formulario.rut_cliente.value== null) { //Debe ser distinto de vacío
    document.formulario.rut_cliente.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
      if(document.formulario.giro.value=="" || document.formulario.giro.value== null) { //Debe ser distinto de vacío
    document.formulario.giro.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
      if(document.formulario.direccion_cliente.value=="" || document.formulario.direccion_cliente.value== null) { //Debe ser distinto de vacío
    document.formulario.direccion_cliente.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
      if(document.formulario.comuna.value=="" || document.formulario.comuna.value== null) { //Debe ser distinto de vacío
    document.formulario.comuna.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
      if(document.formulario.ciudad.value=="" || document.formulario.ciudad.value== null) { //Debe ser distinto de vacío
    document.formulario.ciudad.focus();    // Damos el foco al control
    alert('Debe llenar todos los campos obligatorios.'); //Mostramos el mensaje
    return false; //devolvemos el foco
  }
  
  
 
  return true; //Si ha llegado hasta aquí, es que todo es correcto
}

 dv = function(T) {
     var M=0,S=1;
     for(;T;T=Math.floor(T/10))
        S=(S+T%10*(9-M++%6))%11;
     return S?S-1:'K';
  }
  
  function d_verif() {
document.formulario.d_v.value=dv(document.formulario.rut.value);
}

</script>





</head>


<?php 
include "../connect.php";
$cod_directorio=$_GET['cod_directorio'];
$sql2 = "SELECT * FROM directorio WHERE cod_directorio='".$cod_directorio."'";
$result2 = $db->query($sql2);
if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
		
$nombre=$row2["nombre"];
$rut=$row2["rut"];
$giro=$row2["giro"];
$tipo=$row2["tipo"];
$direccion=$row2["direccion"];
$comuna=$row2["comuna"];
$ciudad=$row2["ciudad"];
$fono=$row2["fono"];
$email=$row2["email"];
$forma_pago=$row2["forma_pago"];
$color_p=$row2["color_p"];

$d_v=substr($rut,-1);
$rut=substr($rut,0,strlen($rut)-2);

        
    }
} else {
    echo "0 results";
}
?>

<body>
	
		
	
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "../header.php";?>
</table>	

<br>
<ul>
<h1>Modificacion de Registro en Directorio</h1>	
</ul>
<ul>

 <table class="tablaprod" border="1">
	 <form name="formulario" method="post" action="red_modifica_registro.php?cod_directorio=<?php echo "$cod_directorio"; ?>" onsubmit="return validarForm(this);">

	 <tr>
	 
	 <th>Tipo <font color="red"><b>(*)</b></font></th>
<td>

<select name="tipo">

<option value="<?php echo "$tipo"; ?>" selected><?php if ($tipo==0) {echo "PROVEEDOR";} else if ($tipo==1) {echo "CLIENTE";} else {echo "USUARIO";}?> </option>
<option value="0" >PROVEEDOR</option>
<option value="1" >CLIENTE</option>
<option value="2" >USUARIO</option>
</select>

</td>
	 </tr>



	 <tr>
	 
	 <th>Raz&oacute;n Social / Nombre <font color="red"><b>(*)</b></font></th><td><input size="60" name="razon_social" autofocus="autofocus" type="text" maxlength="80" value="<?php echo "$nombre"; ?>"/></td>
	 </tr>
	  <tr>
	 <th>RUT <font color="red"><b>(*)</b></font></th><td><input size="10" name="rut" type="text" maxlength="80" value="<?php echo "$rut"; ?>" onChange="d_verif()"/> 
	 - <input size="1" name="d_v" type="text" maxlength="80" value="<?php echo "$d_v"; ?>" readonly/></td>
	 
	 </tr>

	 	 	  <tr>
	 <th>Giro <font color="red"><b>(*)</b></font></th><td><input size="60" name="giro" type="text" maxlength="80" value="<?php echo "$giro"; ?>"/></td>
	 </tr>
	 	 	  <tr>
	 <th>Direcci&oacute;n <font color="red"><b>(*)</b></font></th><td><input size="60" name="direccion" type="text" maxlength="80" value="<?php echo "$direccion"; ?>"/></td>
	 </tr>
	 	 	  <tr>
	 <th>Comuna <font color="red"><b>(*)</b></font></th><td><input size="60" name="comuna" type="text" maxlength="80" value="<?php echo "$comuna"; ?>"/></td>
	 </tr>
	 <tr>
	 <th>Ciudad <font color="red"><b>(*)</b></font></th><td><input size="60" name="ciudad" type="text" maxlength="80" value="<?php echo "$ciudad"; ?>"/></td>
	 </tr>
	 	 <tr>
	 <th>Fono</th><td><input size="60" name="fono" type="text" maxlength="80" value="<?php echo "$fono"; ?>"/></td>
	 </tr>
	 	 <tr>
	 <th>eMail</th><td><input size="60" name="email" type="text" maxlength="80" value="<?php echo "$email"; ?>"/></td>
	 </tr>

	 	 	 <tr>
	 <th>Forma de Pago</th><td>
		 <select name="forma_pago">
		<option value="<?php echo "$forma_pago"; ?>"><?php echo "$forma_pago"; ?></option>	 
		<option value="CONTADO">CONTADO</option>
		<option value="CREDITO">CREDITO</option>
		 </select>
		 </td>
	 </tr>
	 	 <tr>
	 <th>Color</th><td bgcolor='<?php echo $color_p;?>'><input size="60" name="color_p" type="text" maxlength="80" value="<?php echo "$color_p"; ?>"/></td>
	 </tr>


	 
	 </table>
	<br>
	<input id="saveForm" class="button_text" type="submit" name="submit" value="Crear/Modificar" />


		
		
		</form>		







</ul>




	
	</body>
</html>
