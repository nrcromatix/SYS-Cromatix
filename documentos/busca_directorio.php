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
<ul>												
<?php
$cod_documento = $_GET["cod_documento"];
?>
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
$sql2 = "SELECT * FROM directorio";
//if ($nombre_cl_pr<>"") {
//$sql2.= " WHERE";
//}
//if ($nombre_cl_pr<>"") {
//$sql2.= " razon_social LIKE '%$nombre_cl_pr%'";
//}
$sql2.= " ORDER BY nombre";
$result2 = $db->query($sql2);

if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
		
		if ($row2["tipo"]==0) {$tipo="PROVEEDOR";}
		if ($row2["tipo"]==1) {$tipo="CLIENTE";}
		if ($row2["tipo"]==2) {$tipo="USUARIO";}
		
        echo '<tr><td>'.$tipo.'</td>';
        echo '<td><a href="asigna_proveedor.php?cod_documento='.$cod_documento.'&cod_directorio='.$row2["cod_directorio"].'">'.$row2["cod_directorio"].'</a></td>';
        echo '<td>'.$row2["rut"].'</td>';
        echo '<td>'.$row2["nombre"].'</td>';
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

</ul>	
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
