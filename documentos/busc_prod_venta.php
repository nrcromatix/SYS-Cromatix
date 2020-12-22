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
<html >
<head>
<link rel="stylesheet" type="text/css" href="../stylesheet.css"> 
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>
<?php

include "../connect.php";
?>



<?php
//$result = mssql_query('SELECT * FROM productos where estado=1 AND tipo_prod=1');
 
//$num=mssql_num_rows($result);

$cod_documento = $_GET["cod_documento"];
$tipo = $_GET["tipo"];

?>
<body>
	
	
	
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "../header.php";?>
</table>	
<br>


<ul>
<form id="form_980511" class="appnitro"  method="post" action="muestra_producto_venta.php?cod_documento=<?php echo $cod_documento; ?>&tipo=<?php echo $tipo; ?>">
					<div class="form_description">
					
			<h1>Buscador de Productos - ASIGNAR A VENTA</h1>
			<p>Ingrese el nombre o c&oacute;digo del producto solicitado para asignar a venta.</p>
		</div>						
			
			
			<input name="nombre_producto" autofocus="autofocus" class="login" type="text" placeholder="Nombre Producto" maxlength="255" value=""/> 
		</div> 
		
		<div>
			<input  name="codigo" class="login" placeholder="C&oacute;digo de Producto" type="text" maxlength="255" value=""/> 
		</div> 
		
		
				
		
		<div>
			<input  name="temperatura" class="login" placeholder="Temperatura (K)" type="text" maxlength="255" value=""/> 
		</div> 
		<div>
			<input  name="dimension" class="login" placeholder="Dimension" type="text" maxlength="255" value=""/> 
		</div> 
		<br>
		<select name="prov">
			

 <?php
 
 echo '<option value="">PROVEEDOR</option>';
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
<br>
		
		
		<br>
		<input type="checkbox" name="avanzada" value="VA" checked="checked"> Vista Avanzada<br>	
		<input  type="checkbox" name="desactivados" value="MD"> Mostrar Desactivados<br>
		
			<br>
				
			    
				<input class="login" type="submit" name="submit" value="Buscar" />
		
				
		</form>	
	</ul >
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
