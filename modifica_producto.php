<?php
include "connect.php";

$cod_producto = $_GET["cod_producto"];
$prov = $_POST["prov"];

//ACTIVA/DESACTIVA
$est = $_GET["est"];
$me = $_GET["me"];

if ($me==1) {
	
$current_date=date("Y-m-d");
$fecha_ultima_modificacion=substr("$current_date", -10, 4)."-".substr("$current_date", -5, 2)."-".substr("$current_date", -2, 2)." 00:00:00";	
$query4="UPDATE productos SET fecha_ultima_modif='$fecha_ultima_modificacion', estado='$est' WHERE id_producto='$cod_producto'";

if ($db->query($query4) === TRUE) {
header("Location: busca_producto.php");
} else {
echo "Error: " . $query4 . "<br>" . $db->error;
}
}

else {

//DE MODIFICACION DE CANTIDAD ** DESACTIVADO
$cantidad = $_POST["cantidad"];

if ($cantidad<>0 or $cantidad<>"") {

$current_date=date("Y-m-d");
$fecha_ultima_modificacion=substr("$current_date", -10, 4)."-".substr("$current_date", -5, 2)."-".substr("$current_date", -2, 2)." 00:00:00";	
//$query3="UPDATE productos SET fecha_ultima_modificacion='$fecha_ultima_modificacion', stock=stock+'$cantidad' WHERE cod_producto='$cod_producto'";
//$result3 = mssql_query($query3);

//ACTUALIZA HISTORICOS **DESACTIVADOS

$whoami=gethostbyaddr($_SERVER['REMOTE_ADDR']);
$fecha_imp=date("Y-m-d");
$hora_imp=date("H:i:s");
$fecha_db=$fecha_imp." ".$hora_imp;

//$sqlh = "INSERT INTO product_history (cod_producto,fecha_mov,dif_stock,ip_pc,tipo_modif)";
//$sqlh .= " VALUES ('$cod_producto','$fecha_db','$cantidad','$whoami','ADMIN - CANTIDAD')";

//mssql_query($sqlh, $link) or die(mssql_get_last_message());

//if (!mssql_query) {
    //// The query has failed, print a nice error message
    //// using mssql_get_last_message()
    //die('MSSQL error: ' . mssql_get_last_message());
//}



////ACTUALIZA AJUSTES DE INVENTARIO

//if ($prov=="AJ") {

//$result_nomm = mssql_query("SELECT * FROM productos WHERE cod_producto='$cod_producto'");
//$nombre=mssql_result($result_nomm,0,"Nombre");
//$costo=mssql_result($result_nomm,0,"precio_costo");

//$sqlaj = "INSERT INTO ajustes_inventario (cod_producto,fecha_ajuste,diferencia,ip,nombre,costo_neto)";
//$sqlaj .= " VALUES ('$cod_producto','$fecha_db','$cantidad','$whoami','$nombre','$costo')";

//mssql_query($sqlaj, $link) or die(mssql_get_last_message());

//if (!mssql_query) {
    //// The query has failed, print a nice error message
    //// using mssql_get_last_message()
    //die('MSSQL error: ' . mssql_get_last_message());
//}

//}

//mssql_close();

?>
    <script language="Javascript">
			 
            window.opener.location.href="index.php";
            self.close();
    
    </script>
<?php
	
	}
	
else {

//PARAMETROS PDCTO PRIMARIO
$nombre = $_POST["nombre"];
$cod_pdcto_proveedor = $_POST["cod_pdcto_proveedor"];
$nombre=str_replace("'",'"',$nombre);
$nombre_proveedor = $_POST["nombre_proveedor"];
$nombre_proveedor=str_replace("'",'"',$nombre_proveedor);
$stock = $_POST["stock"];
$costo_neto = $_POST["costo_neto"];
$costo_usd = $_POST["costo_usd"];
$costo_eur = $_POST["costo_eur"];
$precio_real_venta = $_POST["precio_real_venta"];
$desc_comercial = $_POST["desc_venta"];
$desc_comercial=$desc_comercial/100;
$lumens = $_POST["lumens"];
$current_date=date("Y-m-d");
$fecha_ultima_modif=substr("$current_date", -10, 4)."-".substr("$current_date", -5, 2)."-".substr("$current_date", -2, 2)." 00:00:00";
$u_medida = $_POST["u_medida"];
$temperatura = $_POST["temperatura"];
$consumo = $_POST["consumo"];
$factor_ddp = $_POST["factor_ddp"];
$ip = $_POST["ip"];
$ik = $_POST["ik"];
$categoria = $_POST["categoria"];
$id_prov = $_POST["prov"];
$imagen = $_POST["imagen"];
$peso = $_POST["peso"];
$dimension = $_POST["dimension"];
$descr = $_POST["descr"];
$description = $_POST["description"];
$zona = $_POST["zona"];
$color_luz=$_POST["color_luz"];
$color_equipo=$_POST["color_equipo"];
$ekit=$_POST["ekit"];
$input_volt=$_POST["input_volt"];
$eficiencia=$_POST["eficiencia"];
$tipo_control=$_POST["tipo_control"];
$driver=$_POST["driver"];
$moneda_origen=$_POST["moneda_origen"];
$tipo_prod=$_POST["tipo_prod"];

function normalize ($string) {
    $table = array(
        'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
        'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
    );
    
    return strtr($string, $table);
}

$descr=normalize($descr);

$sql="UPDATE productos SET description='$description', tipo_prod='$tipo_prod', moneda_origen='$moneda_origen', peso='$peso', input_volt='$input_volt', eficiencia='$eficiencia', tipo_control='$tipo_control', driver='$driver', color_luz='$color_luz', color_equipo='$color_equipo', ekit='$ekit', zoma='$zona', descripcion='$descr', imagen='$imagen', cod_proveedor='$id_prov', categoria='$categoria', fecha_ultima_modif='$fecha_ultima_modif', nombre='$nombre', nombre_pdcto_proveedor='$nombre_proveedor', cod_pdcto_proveedor='$cod_pdcto_proveedor', stock='$stock', costo_neto='$costo_neto', costo_usd='$costo_usd',costo_eur='$costo_neto', precio_real_venta='$precio_real_venta', desc_comercial='$desc_comercial', u_medida='$u_medida', ip='$ip', ik='$ik', factor_ddp='$factor_ddp', factor_ddp='$factor_ddp', temperatura='$temperatura', consumo='$consumo', dimension='$dimension', lumens='$lumens' WHERE id_producto='$cod_producto'";


    
//$result = mssql_query($query);

//$sql = "INSERT INTO productos (nombre, nombre_pdcto_proveedor, categoria, cod_proveedor)
//VALUES ('".$nombre."', '".$nombre_proveedor."', '".$categoria."', '".$prov."')";

if ($db->query($sql) === TRUE) {
header("Location: busca_producto.php");
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}
}
}
?>
