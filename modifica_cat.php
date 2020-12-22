<html>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
 
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "header.php";?>
</table>	
<br>

<?php
include "connect.php";

$id_cat = $_GET["id_categoria"];

$sqlp2 = "SELECT * FROM categorias WHERE id_categoria='".$id_cat."'";
$resultp2 = $db->query($sqlp2);

if ($resultp2->num_rows > 0) {
    // output data of each row
    while($rowp2 = $resultp2->fetch_assoc()) {

$nombre_cat1=$rowp2["nombre_cat"];
$parent_cat1=$rowp2["parent_cat"];

    }
} else {
    
}


$sqlp3 = "SELECT * FROM categorias WHERE id_categoria='".$parent_cat1."'";
$resultp3 = $db->query($sqlp3);

if ($resultp3->num_rows > 0) {
    // output data of each row
    while($rowp3 = $resultp3->fetch_assoc()) {

$nombre_cat3=$rowp3["nombre_cat"];


    }
} else {
    
}

//$result_nom2 = mssql_query("SELECT * FROM categorias WHERE id_cat='$parent_cat1'");
//$nombre_cat2=mssql_result($result_nom2,0,"nombre_cat");

//$query="SELECT * FROM categorias";
//$query.=" ORDER BY nombre_cat ASC";
 
//$result = mssql_query($query);
 
//$num=mssql_num_rows($result);


?>   
    
 
</head>


<center>

<form method="post" name="formulario" action="modifica_cat2.php?id_cat=<?php echo "$id_cat";?>">


		<h2>Modificar Categor&iacute;a:</h2>
			<input name="nombre_cat" autofocus="autofocus" class="element text medium" type="text" maxlength="255" value="<?php echo "$nombre_cat1";?>"/> 
			
			<select name="parent_cat">
<option value="<?php echo "$parent_cat1";?>"><?php echo "$nombre_cat3";?></option>
<?php
$sql2 = "SELECT * FROM categorias ORDER BY nombre_cat";
$result2 = $db->query($sql2);

if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
        echo '<option value="'.$row2["id_categoria"].'">'.$row2["nombre_cat"].'</option>';
    }
} else {
    
}

$db->close();
?>

</select>
			    <br>
			    <br>
				<input type="submit" name="submit" value="Modificar" />

			</ul>
			
		</form>	
</center>

</html>







