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
?>


<body>
	
		
	
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "../header.php";?>

</table>	

<br>
<ul>
<h1>Ingreso de Nuevo Registro</h1>	
</ul>
<ul>

 <table class="tablaprod" border="1">
	 <form name="formulario" method="post" action="red_modifica_registro.php?cod_directorio=0" onsubmit="return validarForm(this);">

	 <tr>
	 
	 <th>Tipo <font color="red"><b>(*)</b></font></th>
<td>

<select name="tipo">
<option value="0" selected>PROVEEDOR</option>
<option value="1" >CLIENTE</option>
<option value="2" >USUARIO</option>
</select>

</td>
	 </tr>



	 <tr>
	 
	 <th>Raz&oacute;n Social / Nombre <font color="red"><b>(*)</b></font></th><td><input size="60" name="razon_social" autofocus="autofocus" type="text" maxlength="80" value="<?php echo "$razon_social"; ?>"/></td>
	 </tr>
	  <tr>
	 <th>RUT <font color="red"><b>(*)</b></font></th><td><input size="10" name="rut" type="text" maxlength="80" value="<?php echo "$rut"; ?>" onChange="d_verif()"/> 
	 - <input size="1" name="d_v" type="text" maxlength="80" value="" readonly/></td>
	 
	 </tr>

	 	 	  <tr>
	 <th>Giro <font color="red"><b>(*)</b></font></th><td><input size="60" name="giro" type="text" maxlength="80" value="<?php echo "$giro"; ?>"/></td>
	 </tr>
	 	 	  <tr>
	 <th>Direcci&oacute;n <font color="red"><b>(*)</b></font></th><td><input size="60" name="direccion" type="text" maxlength="80" value="<?php echo "$direccion_cliente"; ?>"/></td>
	 </tr>
	 	 	  <tr>
	 <th>Comuna <font color="red"><b>(*)</b></font></th><td><input size="60" name="comuna" type="text" maxlength="80" value="<?php echo "$comuna"; ?>"/></td>
	 </tr>
	 <tr>
	 <th>Ciudad <font color="red"><b>(*)</b></font></th><td><input size="60" name="ciudad" type="text" maxlength="80" value="SANTIAGO"/></td>
	 </tr>
	 	 <tr>
	 <th>Fono</th><td><input size="60" name="fono" type="text" maxlength="80" value=""/></td>
	 </tr>
	 	 <tr>
	 <th>eMail</th><td><input size="60" name="email" type="text" maxlength="80" value=""/></td>
	 </tr>

	 	 	 <tr>
	 <th>Forma de Pago</th><td>
		 <select name="credito_contado">
		<option value="CONTADO">CONTADO</option>
		<option value="CREDITO">CREDITO</option>
		 </select>
		 </td>
	 </tr>


	 
	 </table>
	<br>
	<input id="saveForm" class="button_text" type="submit" name="submit" value="Crear/Modificar" />


		
		
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

