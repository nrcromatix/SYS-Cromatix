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
		
		
<h1>Gestión Cuenta Corriente Usuarios:</h1>

<form method="post" action="ingresa_rrhh.php">
		<h2>Datos de la Rendicion:</h2>

				<select name="usuario">
 <?php

if ($_SESSION["user"]=="alesgare") 

{

$sql2 = "SELECT * FROM directorio WHERE tipo=2 ORDER BY nombre";
$result2 = $db->query($sql2);

if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
        echo '<option value="'.$row2["cod_directorio"].'">'.$row2["nombre"].'</option>';
    }
} else {
    echo "0 results";
}

}

else {
$user=$_SESSION["user"];

$sql2 = "SELECT * FROM directorio WHERE tipo=2 AND login='".$user."' ORDER BY nombre";
$result2 = $db->query($sql2);

if ($result2->num_rows > 0) {
    // output data of each row
    while($row2 = $result2->fetch_assoc()) {
        echo '<option value="'.$row2["cod_directorio"].'">'.$row2["nombre"].'</option>';
    }
} else {
    echo "0 results";
}

	
	
	}

?>
</select> <br>

<?php $today = date("d-m-Y"); ?> 	
					
<input size="5" name="fecha" type="text" maxlength="255" value="<?php echo "$today"; ?>" <?php if ($_SESSION["user"]<>"alesgare") 

{ echo "readonly"; } ?>/>

<input name="monto" size="5" autofocus="autofocus" type="text" maxlength="255" placeholder="($)"/> 


 <?php

if ($_SESSION["user"]=="alesgare") 

{?>
			

			<input name="dias" size="5" type="text" maxlength="255" placeholder="Dias"/> 
			
			
			 <?php
	}

?>
			
			
			<input name="doc_ref" size="9" type="text" maxlength="255" placeholder="Documento Ref."/> 
			<input name="observaciones" size="40" type="text" maxlength="255" placeholder="Observaciones"/> 
			<br>
			<select name="tipo">
<option value="RENDICION GASTO" selected>RENDICION GASTO</option>

 <?php

if ($_SESSION["user"]=="alesgare") 

{?>
<option value="RETIRO" >RETIRO</option>
<option value="ABONO" >ABONO</option>
<option value="VACACIONES" >VACACIONES</option>

 <?php
	}

?>
</select>




			    
			  
				<input type="submit" name="submit" value="Crear Movimiento" />

			</ul>
			
			
		</form>	


<ul>
	<table border="0"><tr> <td>
 <table class="tablaprod" border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Monto($)</th>
                <th>Dias</th>
                <th>Doc. Referencia</th>
                <th>Motivo / Observaciones</th>
                </tr>
                
                <?php

$uuser=$_SESSION["user"];

$sqluu = "SELECT * FROM directorio WHERE login='".$uuser."'";
$resultuu = $db->query($sqluu);
if ($resultuu->num_rows > 0) {
    // output data of each row
    while($rowuu = $resultuu->fetch_assoc()) {
$id_usuario=$rowuu["cod_directorio"];

$fecha_inic_cont=$rowuu["fecha_inic_contrato"];
$fecha_inic_cont=date("d-m-Y", strtotime($fecha_inic_cont));
$fecha_inic_prev=$rowuu["fecha_inic_prevision"];
if ($fecha_inic_prev=="") {$fecha_inic_prev=$fecha_inic_cont;}
$fecha_inic_prev=date("d-m-Y", strtotime($fecha_inic_prev));

$fecha_inic_MES=substr("$fecha_inic_prev", -7, 2);
$fecha_inic_ANIO=substr("$fecha_inic_prev", -4, 4);

$fecha_inic_MES_co=substr("$fecha_inic_cont", -7, 2);
$fecha_inic_ANIO_co=substr("$fecha_inic_cont", -4, 4);

$today = date("d-m-Y");
$fecha_hoy_MES=substr("$today", -7, 2);
$fecha_hoy_ANIO=substr("$today", -4, 4);
$anios=$fecha_hoy_ANIO-$fecha_inic_ANIO;
$meses=$fecha_hoy_MES-$fecha_inic_MES; // SE RESTA UN MES YA QUE DEBE SER MES CUMPLIDO
$total_meses=($anios*12+$meses-120)/12/3;
if ($total_meses<1){ $total_meses=0; }
$total_meses=floor($total_meses); //SE SUMA 15 POR VAC LEGAL
$vac_pdtes=$total_meses;

$anios_co=$fecha_hoy_ANIO-$fecha_inic_ANIO_co;
$meses_co=$fecha_hoy_MES-$fecha_inic_MES;
$vac_corr=($anios_co*12+$meses_co)*1.25; //1.25 x MES TRABAJADO


}}


//if ($uuser=='alesgare'){
//$sqls = "SELECT SUM(monto) as suma FROM rrhh"; }
//else {
$sqls = "SELECT SUM(monto) as suma, SUM(dias) as dias_vac  FROM rrhh WHERE id_usuario='".$id_usuario."'"; 

//}

$results = $db->query($sqls);


if ($results->num_rows > 0) {
    // output data of each row
    while($row = $results->fetch_assoc()) {
		
		$disponibles=$vac_corr-$row["dias_vac"]; 

 echo '<tr bgcolor="#f1adff"><td> </td> <td> </td><td></td>
<td  align="right"><b>Total Disponible:</b></td><td align="right"><b>$ '.number_format($row["suma"], 0, ",", "."). '</b></td>
<td>'.$row["dias_vac"].' / '.$vac_corr.' / <mark>'.$disponibles.'</mark></td><td></td>
<td></td>';
					

echo '</tr>';


}
}



if ($uuser=='alesgare'){
$sql = "SELECT * FROM rrhh ORDER BY id_pago DESC"; }
else {
$sql = "SELECT * FROM rrhh WHERE id_usuario='".$id_usuario."'  ORDER BY id_pago DESC"; }
$result = $db->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {


$sqlu = "SELECT * FROM directorio WHERE cod_directorio=".$row["id_usuario"]."";
$resultu = $db->query($sqlu);
if ($resultu->num_rows > 0) {
    // output data of each row
    while($rowu = $resultu->fetch_assoc()) {
$nombre_usuario=$rowu["nombre"];
}}

if ($row["monto"]<0) {$color='palegreen';}
if ($row["monto"]>0) {$color='lightcoral';}
if ($row["monto"]==0 || $row["monto"]=='') {$color='white';}



        echo '<tr><td> '.$row["id_pago"]. '</td> <td>' . $row["tipo"]. ' </td><td>' . $row["fecha"]. '</td>
<td>' . $nombre_usuario. '</td><td bgcolor='.$color.' align="right">'.number_format($row["monto"], 0, ",", "."). '</td><td>' . $row["dias"]. '</td><td>' . $row["referencia"]. '</td>
<td>' . $row["obs"]. '</td>';
if ($_SESSION["user"]=='alesgare' || $row["tipo"]=='RENDICION GASTO') {
echo '<td>
<a href="elimina_mov.php?id_pago='.$row["id_pago"].'">
<input type="button" value="Eliminar" /></a></td>';
}					

echo '</tr>';



    }
} else {
    echo "0 results";
}

?>

                </table></td><td></td>
                
                <td valign="top">
					
<?php
if ($_SESSION["user"]=="viviana") { $id_vendedor="documentos.id_vendedor='10' AND"; $com=0.02; }
else if ($_SESSION["user"]=="rodrigo") { $id_vendedor=""; $com=0.01; }
else if ($_SESSION["user"]=="pzaghloul") { $id_vendedor="documentos.id_vendedor='201' AND"; $com=0.015; }
else { $com=0; }
$com_p=$com*100;

if ($com>0) {
?>				
					<table class="tablaprod" border="1">
        <thead>
            <tr><th>Mes</th><th>Monto Com. Neto (<?php echo $com_p."%"; ?>)</th></tr>
            </thead>
                <tr>
                <?php 



$sqlf = "SELECT info_pago.fecha, MONTH(info_pago.fecha) as mes, YEAR(info_pago.fecha) as anio, SUM(CASE WHEN documentos.tipo='FACTURA' THEN info_pago.monto ELSE -info_pago.monto END) as suma, info_pago.cod_documento, "; 
$sqlf .= " documentos.cod_documento, documentos.tipo, documentos.id_vendedor";
$sqlf .= " FROM info_pago";
$sqlf .= " LEFT JOIN documentos ON documentos.cod_documento = info_pago.cod_documento WHERE ".$id_vendedor." (documentos.tipo='FACTURA' OR documentos.tipo='NOTA DE CREDITO')";
$sqlf .= " GROUP BY YEAR(info_pago.fecha), MONTH(info_pago.fecha) ORDER BY info_pago.fecha DESC LIMIT 100;";

$resultf = $db->query($sqlf);
if ($resultf->num_rows > 0) {
	while($rowf = $resultf->fetch_assoc()) {
		
$mes=$rowf["mes"];
$anio=$rowf["anio"];
$fecha=$rowf["fecha"];
$suma=$rowf["suma"]/1.19*$com;


echo "<tr><td bgcolor='beige'>".$mes."/".$anio."</td><td align='right'>".number_format($suma, 0, ",", ".")."</td></tr>";


}
}
    
    
             
     ?>  
     </tr>
     </table>   
<?php
}  $db->close();  ?>     
                </td>
</tr>
</table>




			
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
