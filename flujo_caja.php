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

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          
['Mes', 'Ventas'],




<?php

include "connect.php";

$sql = "SELECT Month, Year, sum(MontoF) as MF, sum(MontoNC) as MNC
FROM (
SELECT DATE_FORMAT(fecha_creacion, '%m') AS Month, DATE_FORMAT(fecha_creacion, '%Y') AS Year, SUM(total_venta_neto-monto_descuento_neto) AS MontoF, '0' AS MontoNC
FROM documentos
WHERE tipo='FACTURA' AND (estado=1 OR estado=3)
GROUP BY DATE_FORMAT(fecha_creacion, '%m-%Y') 
UNION ALL
SELECT DATE_FORMAT(fecha_creacion, '%m') AS Month, DATE_FORMAT(fecha_creacion, '%Y') AS Year, '0' AS MontoF, SUM(total_venta_neto-monto_descuento_neto) AS MontoNC
FROM documentos
WHERE tipo='NOTA DE CREDITO' AND (estado=1 OR estado=3)
GROUP BY DATE_FORMAT(fecha_creacion, '%m-%Y') ) as a
GROUP BY Month, year
ORDER BY Year DESC, Month DESC";

$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row2 = $result->fetch_assoc()) {
		$mes=$row2["Month"];
$anio=$row2["Year"];
$mes=$row2["Month"];
$montoF=$row2["MF"];
$montoNC=$row2["MNC"];
$neta_total=$montoF-$montoNC;

?>
[ new Date(<?php echo $anio; ?>, <?php echo $mes; ?>),<?php echo $neta_total; ?>],

<?php
}}
?>



        ]);

var options = {
          title: 'Reporte de Facturas de Venta (-NC) por Mes',
          curveType: 'function',
          legend: { position: 'bottom' },

trendlines: {
    0: {
       type: 'exponential',
      color: 'violet',
      lineWidth: 3,
      opacity: 1,
      showR2: true
    }
  }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

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

<div id="curve_chart" style="width: 900px; height: 500px"></div>


<ul>

<h1>Flujo de Caja</h1>

			<table class="tablaprod" border="1">
	<tr>
		<th>Año</th>
		<th>Mes</th>
		<th>Facturas Netas($)</th>
	<th>Notas Credito Netas($)</th>
	<th>Venta Netas($)</th>
		
		
		</tr>
		
<?php

$sql = "SELECT Month, Year, sum(MontoF) as MF, sum(MontoNC) as MNC
FROM (
SELECT DATE_FORMAT(fecha_creacion, '%m') AS Month, DATE_FORMAT(fecha_creacion, '%Y') AS Year, SUM(total_venta_neto-monto_descuento_neto) AS MontoF, '0' AS MontoNC
FROM documentos
WHERE tipo='FACTURA' AND (estado=1 OR estado=3)
GROUP BY DATE_FORMAT(fecha_creacion, '%m-%Y') 
UNION ALL
SELECT DATE_FORMAT(fecha_creacion, '%m') AS Month, DATE_FORMAT(fecha_creacion, '%Y') AS Year, '0' AS MontoF, SUM(total_venta_neto-monto_descuento_neto) AS MontoNC
FROM documentos
WHERE tipo='NOTA DE CREDITO' AND (estado=1 OR estado=3)
GROUP BY DATE_FORMAT(fecha_creacion, '%m-%Y') ) as a
GROUP BY Month, year
ORDER BY Year DESC, Month DESC";

$result = $db->query($sql);
if ($result->num_rows > 0) {
	while($row2 = $result->fetch_assoc()) {
		$mes=$row2["Month"];
$anio=$row2["Year"];
$montoF=$row2["MF"];
$montoNC=$row2["MNC"];
$neta_total=$montoF-$montoNC;





?>
<tr <?php if($datediff>9 && $estado=="0") { echo "bgcolor='#ff8080'";} ?></tr>
		<td><?php echo $anio; ?></td>
		<td><?php echo $mes; ?></td>

		<td align="right"><?php echo "$ ".number_format($montoF, 0, ",", "."); ?></td>
<td align="right"><font color='red'><?php echo "$ ".number_format($montoNC, 0, ",", "."); ?></font></td>
<td align="right"><b><?php echo "$ ".number_format($neta_total, 0, ",", "."); ?></b></td>
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
