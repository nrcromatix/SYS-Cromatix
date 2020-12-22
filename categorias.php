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

</head>
<?php

include "connect.php";

//$query="SELECT * FROM categorias WHERE parent_cat=0";
//$query.=" ORDER BY nombre_cat ASC";
 
//$result = mssql_query($query);
 
//$num=mssql_num_rows($result);

//$query2="SELECT * FROM categorias WHERE parent_cat<>0";
//$query2.=" ORDER BY nombre_cat ASC";
//$result2 = mssql_query($query2);
//$num2=mssql_num_rows($result2);

//$querysc="SELECT * FROM categorias WHERE parent_cat<>0";
//$querysc.=" ORDER BY nombre_cat ASC";
//$resultsc = mssql_query($querysc);
//$numsc=mssql_num_rows($resultsc);

//$query3="SELECT * FROM categorias WHERE parent_cat<>0";
//$query3.=" ORDER BY nombre_cat ASC";
//$result3 = mssql_query($query3);
//$num3=mssql_num_rows($result3);

?>


<body>
	
	
	
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "header.php";?>
</table>	
<br>



<ul>
	
<h1>Crear Nueva Categor&iacute;a:</h1>

<form method="post" action="ingresa_cat.php">
		<h2>Nombre de Nueva Categor&iacute;a:</h2>
			<input name="nombre_cat" size="30" autofocus="autofocus" type="text" maxlength="255" value="NOMBRE DE CATEGORIA"/> 
			
			<select name="parent_cat">
<option value="0" selected>ELIJA CATEGORIA MADRE</option>

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
			    
				<input type="submit" name="submit" value="Crear" />

			</ul>
			
			
		</form>	


<ul>
 <table class="tablaprod" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Acci&oacute;n</th>
                </tr>
                
                <?php
$sql = "SELECT * FROM categorias WHERE parent_cat='0' ORDER BY nombre_cat";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr><td> '.$row["id_categoria"]. '</td> <td>' . $row["nombre_cat"]. ' </td><td>' . $row["parent_cat"]. '</td>
<td></td>
<td>
<a href="modifica_cat.php?id_categoria='.$row["id_categoria"].'">
				  <input type="button" value="Modificar" /></a>
<a href="elimina_cat.php?id_categoria='.$row["id_categoria"].'">
				  <input type="button" value="Eliminar" /></a>
					</td>
					
</tr>';

$sqlp1 = "SELECT * FROM categorias WHERE parent_cat='".$row["id_categoria"]."' ORDER BY nombre_cat";
$resultp1 = $db->query($sqlp1);

if ($resultp1->num_rows > 0) {
    // output data of each row
    while($rowp1 = $resultp1->fetch_assoc()) {
        echo '<tr><td> '.$rowp1["id_categoria"]. '</td><td></td> <td>' . $rowp1["nombre_cat"]. ' </td><td>' . $rowp1["parent_cat"]. '</td>

<td>
<a href="modifica_cat.php?id_categoria='.$rowp1["id_categoria"].'">
				  <input type="button" value="Modificar" /></a>
<a href="elimina_cat.php?id_categoria='.$rowp1["id_categoria"].'">
				  <input type="button" value="Eliminar" /></a>
					</td>
					
</tr>';

$sqlp2 = "SELECT * FROM categorias WHERE parent_cat='".$rowp1["id_categoria"]."' ORDER BY nombre_cat";
$resultp2 = $db->query($sqlp2);

if ($resultp2->num_rows > 0) {
    // output data of each row
    while($rowp2 = $resultp2->fetch_assoc()) {
        echo '<tr><td> '.$rowp2["id_categoria"]. '</td><td></td><td></td> <td>' . $rowp2["nombre_cat"]. ' </td>
<td>
<a href="modifica_cat.php?id_categoria='.$rowp2["id_categoria"].'">
				  <input type="button" value="Modificar" /></a>
<a href="elimina_cat.php?id_categoria='.$rowp2["id_categoria"].'">
				  <input type="button" value="Eliminar" /></a>
					</td>
					
</tr>';

    }
} else {
    
}

    }
} else {
    
}


    }
} else {
    echo "0 results";
}
$db->close();
?>

                </table>

</ul>

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
