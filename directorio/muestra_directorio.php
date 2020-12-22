<html >
<head>

<link rel="stylesheet" type="text/css" href="../stylesheet.css">

<script type="text/javascript">


</script>





</head>

<?php
include "../connect.php";

$nombre_cl_pr=$_POST['nombre_cl_pr'];
$rut_cl_pr=$_POST['rut_cl_pr']; 
$showp=$_POST['showp']; 
$showc=$_POST['showc']; 
$showusu=$_POST['showusu']; 

//CONSULTA A PROVEEDORES
//$query="SELECT * FROM proveedores where (razon_social LIKE '%$nombre_cl_pr%' OR nombre_fantasia Like '%$nombre_cl_pr%')";



?>


<body>
	
		
	
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "../header.php";?>
</table>	
<br>
<ul >


	
 <table class="tablaprod" border="1">
        <thead>
            <tr>
				<th>Tipo</th>
                <th>C&oacute;digo</th>
                <th>RUT</th>
                <th>Razon Social</th>
                
			
          


            </tr>
        </thead>
        <tbody>



				
				<?php
$sql2 = "SELECT * FROM directorio WHERE nombre LIKE '%$nombre_cl_pr%'";
if ($showusu<>"" || $showp<>"" || $showc<>"") {
$sql2.= "  AND (tipo=''";
if ($showp<>"") {
$sql2.= "  OR tipo=0";
}
if ($showc<>"") {
$sql2.= "  OR tipo=1";
}
if ($showusu<>"") {
$sql2.= "  OR tipo=2";
}
$sql2.= "  )";
}
$sql2.= " ORDER BY nombre";
$result2 = $db->query($sql2);

if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
		
		if ($row2["tipo"]==0) {$tipo="PROVEEDOR";}
		if ($row2["tipo"]==1) {$tipo="CLIENTE";}
		if ($row2["tipo"]==2) {$tipo="USUARIO";}
		
		
        echo '<tr><td>'.$tipo.'</td>';
        echo '<td>'.$row2["cod_directorio"].'</td>';
        echo '<td><a href="modifica_registro.php?cod_directorio='.$row2["cod_directorio"].'">'.$row2["rut"].'</a></td>';
        echo '<td>'.$row2["nombre"].'</td> </tr>';
        
    }
} else {
    echo "0 results";
}

?>
				
				
			
           
  



        </tbody>
    </table>


<?php
$db->close();
?>




	
	</body>
</html>
