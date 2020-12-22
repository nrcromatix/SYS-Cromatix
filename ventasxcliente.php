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
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Nombre', 'Monto'],




<?php

$meses = $_GET["meses"];

if ($meses==0 OR $meses=="") { $meses=6; }

include "connect.php";

$sql = "SELECT CLIENTE, NOMBRE, sum(MontoF) as MF, sum(MontoNC) as MNC, sum(MontoF)-sum(MontoNC) as TOTAL
FROM (
SELECT directorio.cod_directorio, directorio.nombre AS NOMBRE, documentos.id_cliente AS CLIENTE, SUM(documentos.total_venta_neto-documentos.monto_descuento_neto) AS MontoF, '0' AS MontoNC
FROM documentos LEFT JOIN directorio ON directorio.cod_directorio=documentos.id_cliente
WHERE documentos.tipo='FACTURA' AND (documentos.estado=1 OR documentos.estado=3) AND documentos.fecha_creacion>DATE_SUB(curdate(), INTERVAL ".$meses." MONTH)
GROUP BY CLIENTE
UNION ALL
SELECT directorio.cod_directorio, directorio.nombre AS NOMBRE, documentos.id_cliente AS CLIENTE, '0' AS MontoF, SUM(documentos.total_venta_neto-documentos.monto_descuento_neto) AS MontoNC
FROM documentos LEFT JOIN directorio ON directorio.cod_directorio=documentos.id_cliente
WHERE documentos.tipo='NOTA DE CREDITO' AND (documentos.estado=1 OR documentos.estado=3) AND documentos.fecha_creacion>DATE_SUB(curdate(), INTERVAL ".$meses." MONTH)
GROUP BY CLIENTE ) as a
GROUP BY CLIENTE
ORDER BY TOTAL DESC";

$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row2 = $result->fetch_assoc()) {
$id_cliente=$row2["CLIENTE"];
$nombre=$row2["NOMBRE"];
$montoT=$row2["TOTAL"];

if ($montoT>0) {
?>

[<?php echo "'".$nombre."'"; ?>,<?php echo $montoT; ?>],

<?php
}
}
}
?>






        ]);

        var options = {
          title: 'Ventas por Cliente'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>










</head>
<?php

include "connect.php";
?>



<?php
//$result = mssql_query('SELECT * FROM productos where estado=1 AND tipo_prod=1');
 
//$num=mssql_num_rows($result);

?>
<body>
	
	
	
<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "header.php";?>
</table>	


	 
	 </form>
	 
	 
 <div id="piechart" style="width: 1200px; height: 500px;"></div>

	


<ul>

<form name="meses" method="get" action="ventasxcliente.php">	
	<input  size="4" name="meses" placeholder="6" class="style1" type="text" maxlength="255" value=""/>
	
<input class="style1" type="submit" name="submit" value="Meses" />	


<h1>Ventas por Cliente Últimos  <?php echo $meses; ?>  Meses</h1>

			<table class="tablaprod" border="1">
	<tr>
		<th>ID Cliente</th>
		<th>Nombre Cliente</th>
	<th>Venta Netas($)</th>
		
		
		</tr>
		
<?php

$sql = "SELECT CLIENTE, NOMBRE, sum(MontoF) as MF, sum(MontoNC) as MNC, sum(MontoF)-sum(MontoNC) as TOTAL
FROM (
SELECT directorio.cod_directorio, directorio.nombre AS NOMBRE, documentos.id_cliente AS CLIENTE, SUM(documentos.total_venta_neto-documentos.monto_descuento_neto) AS MontoF, '0' AS MontoNC
FROM documentos LEFT JOIN directorio ON directorio.cod_directorio=documentos.id_cliente
WHERE documentos.tipo='FACTURA' AND (documentos.estado=1 OR documentos.estado=3) AND documentos.fecha_creacion>DATE_SUB(curdate(), INTERVAL ".$meses." MONTH)
GROUP BY CLIENTE
UNION ALL
SELECT directorio.cod_directorio, directorio.nombre AS NOMBRE, documentos.id_cliente AS CLIENTE, '0' AS MontoF, SUM(documentos.total_venta_neto-documentos.monto_descuento_neto) AS MontoNC
FROM documentos LEFT JOIN directorio ON directorio.cod_directorio=documentos.id_cliente
WHERE documentos.tipo='NOTA DE CREDITO' AND (documentos.estado=1 OR documentos.estado=3) AND documentos.fecha_creacion>DATE_SUB(curdate(), INTERVAL ".$meses." MONTH)
GROUP BY CLIENTE ) as a
GROUP BY CLIENTE
ORDER BY TOTAL DESC";

$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row2 = $result->fetch_assoc()) {
$id_cliente=$row2["CLIENTE"];
$nombre=$row2["NOMBRE"];
$montoT=$row2["TOTAL"];





?>
<tr>
		<td><?php echo $id_cliente; ?></td>
		<td><?php echo $nombre; ?></td>

		<td align="right"><?php echo "$ ".number_format($montoT, 0, ",", "."); ?></td>

</tr>
<?php


    }
} else {
    echo "0 results";
}

?>
		
		</table>
		
		
		
		


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
