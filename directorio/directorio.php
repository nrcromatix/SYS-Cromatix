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
<br>
<ul>
<form name="formulario" method="post" action="muestra_directorio.php">					
			<h1>Directorio de Clientes, Proveedores y Usuarios</h1>				
				<a href="crea_registro.php">
                <input type="button" value="Crear Registro" /></a>
			<br>
					<br>
			<input  name="nombre_cl_pr" autofocus="autofocus" placeholder="Ingrese Nombre de Cliente o Proveedor" class="login" type="text" maxlength="255" value=""/> 
		
		<br>
			<input  name="rut_cl_pr" class="login" placeholder="Buscar por RUT de Cliente o Proveedor" type="text" maxlength="255" value="" onChange="function()"/> 			
		<br>
		<br>
		<input type="checkbox" name="showp" value="1" checked>Proveedores<br>
		<input type="checkbox" name="showc" value="1" checked>Clientes<br>
		<?php if ($_SESSION["user"]=="alesgare") { ?>
		<input type="checkbox" name="showusu" value="1">Usuarios<br>
		 <?php } ?>
			<br>			
				<input class="login" type="submit" name="submit" value="Buscar" />		
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
