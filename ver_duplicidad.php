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
<title>Muestra Productos</title>
<link rel="stylesheet" type="text/css" href="stylesheet.css"> 
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>


<?php
include "connect.php";

$cod_producto=$_GET['cod_producto']; 

?>
<body>
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "header.php";?>
</table>	




<ul >
	<h2>Historia de Movimientos Producto: <?php echo $cod_producto; ?></h2>
 <table class="tablaprod" border="1">
       
            <tr>
				<th>ID Movimiento</th>
                 <th>Cod Producto</th>
                <th>Fecha Mov.</th>             		
															
                <th>Cod. Documento</th>   
                <th>Diferencia Inventario</th> 
                <th>Tipo Mod.</th> 
                <th>Usuario</th> 
            </tr>
      
       
<?php
$query="SELECT * FROM mov_inventario WHERE tipo_mod='ADMIN / INGRESO OC' ORDER BY id_mov DESC";
$sql2 = $query;
$result2 = $db->query($sql2);	
				
if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
       


$id_mov=$row2["id_mov"];
$fecha_mov=$row2["fecha_mov"];
$cod_producto=$row2["cod_pdcto"];
$cod_documento=$row2["cod_documento"];
$diferencia_inventario=$row2["diferencia_inventario"];
$tipo_modificacion=$row2["tipo_mod"];
$usuario=$row2["usuario"];

if ($diferencia_inventario==$diferencia_inventario_ant AND $cod_producto==$cod_producto_ant) {
	
	$background="bgcolor='yellow'";

	
	}
	


?>
				 <tr <?php echo $background; ?>>

						
				<td><?php echo "$id_mov";?></td>
				<td><?php echo "$cod_producto";?></td>
				<td><?php echo "$fecha_mov";?></td>
				<td>
					<a href="documentos/detalle_dcto.php?cod_documento=<?php echo "$cod_documento"; ?>">
					<?php echo "$cod_documento";?></td></a>
				<td><?php echo "$diferencia_inventario";?></td>
				<td><?php echo "$tipo_modificacion";?></td>
				<td><?php echo "$usuario";?></td>
				
				<?php if ($background<>"") { ?>
				<td><a href="elimina_duplicidad.php?id_mov=<?php echo "$id_mov"; ?>">
<img border="0" alt="Eliminar" src="/documentos/delete.png" width="15" height="15">
</a></td>
				<?php } ?>
            </tr>
      
        
       


<?php

$diferencia_inventario_ant=$diferencia_inventario;
$cod_producto_ant=$cod_producto;
$background="";

    }
} else {
    echo "0 results";
}
?>
       
    </table>
    <br>

	</ul >
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
