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
<title>Muestra Productos - ASIGNAR A VENTA</title>
<link rel="stylesheet" type="text/css" href="../stylesheet.css"> 
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>


<?php
include "../connect.php";

$cod_documento = $_GET["cod_documento"];
$tipo = $_GET["tipo"];

$nombre_producto=$_POST['nombre_producto'];
$codigo_producto=$_POST['codigo']; 
$temperatura=$_POST['temperatura'];
$dimension=$_POST['dimension'];
$prov=$_POST['prov'];
$desactivados=$_POST['desactivados']; 
$avanzada=$_POST['avanzada'];
$up=$_POST['up']; 
$cod_fab=$_POST['cod_fab']; 
?>
<body>
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "../header.php";?>
</table>	




<ul >
	<h2>Productos Encontrados</h2>
 <table class="tablaprod" border="1">
       
            <tr><th></th>
				<th>C&oacute;digo</th>
                <th></th>
                <th>Nombre de Producto</th>
                <th>Stock</th>             		
															
                <th>Precio Neto</th>   
                <th>Consumo</th> 
                <th>Dimension</th> 
                <th>Color Equipo</th> 
                <th>Temperatura (K)</th>                                                     
               
            </tr>
      
       
<?php
$query="SELECT * FROM productos WHERE tipo_prod=0 AND nombre LIKE '$nombre_producto%'";
if ($desactivados<>"MD") {
$query.=" AND estado=1";
}
$query.=" AND id_producto LIKE '$codigo_producto%'";
if ($temperatura<>"") {
$query.=" AND temperatura LIKE '%$temperatura%'";
}
if ($dimension<>"") {
$query.=" AND dimension LIKE '%$dimension%'";
}
if ($prov<>"") {
$query.=" AND cod_proveedor='$prov'";
}
$query.=" ORDER BY nombre ASC";
$sql2 = $query;
$result2 = $db->query($sql2);	
				
if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
       


$id=$row2["id_producto"];
$nombre=$row2["nombre"];
$stock=$row2["stock"];
$precio_costo=$row2["costo_neto"];
$precio_venta=round($row2["precio_real_venta"]/1.19);
$u_medida=$row2["u_medida"];
$estado=$row2["estado"];
$imagen=$row2["imagen"];
$consumo=$row2["consumo"];
$dimension=$row2["dimension"];
$color_equipo=$row2["color_equipo"];
$color_luz=$row2["color_luz"];
$temperatura=$row2["temperatura"];
$cod_proveedor=$row2["cod_proveedor"];

// PROVEEDOR

$sqlpr = "SELECT * FROM directorio WHERE cod_directorio='".$cod_proveedor."'";
$resultpr = $db->query($sqlpr);
if ($resultpr->num_rows > 0) {
	while($rowpr = $resultpr->fetch_assoc()) {
$color_p=$rowpr["color_p"];

    }
} else {
    
}

?>
				 <tr>
					 
					 <td bgcolor='<?php echo $color_p;?>'></td>


                <td align="center">
					
					<?php echo "$id"; ?>
				</td>
						
						                						<td bgcolor='#FFFFFF'>
	 <?php 
	 
	 if ($imagen<>"sinfoto.jpg") {

		echo  '<img src="/cromatiximg/'.$imagen.'" style="width:27px;height:20px;">';	 
		 	} ?>	 
						</td>
						
				<td>
					<a href="agrega_pdcto_nombre.php?cod_producto=<?php echo "$id"; ?>&cod_documento=<?php echo $cod_documento; ?>&tipo=<?php echo $tipo; ?>">
					<?php echo "$nombre";?>
					</a>
					</td>
				
					<td align="center">
						
							<?php echo "$stock";?>
							</td>

						<td align="right"><?php echo "$ ".number_format("$precio_venta",0,",",".");?></td>
						
						
						<td><?php echo "$consumo";?></td>
						<td><?php echo "$dimension";?></td>
						<td><?php echo "$color_equipo";?></td>
						<td><?php echo "$temperatura";?></td>
						
						
			
            </tr>
      
        
       


<?php



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
header("Location:../login.php");
}
?>
