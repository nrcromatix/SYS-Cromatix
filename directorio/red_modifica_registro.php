<?php

include "../connect.php";

$cod_directorio=$_GET['cod_directorio'];

$tipo=$_POST['tipo'];
$razon_social=$_POST['razon_social']; //
$razon_social=strtoupper($razon_social);
$giro=$_POST['giro'];
$giro=strtoupper($giro);
$direccion=$_POST['direccion'];
$direccion=strtoupper($direccion);
$comuna=$_POST['comuna'];
$ciudad=$_POST['ciudad'];
$comuna=strtoupper($comuna);
$ciudad=strtoupper($ciudad);
$fono=$_POST['fono'];
$rut=$_POST['rut']; //
$d_v=$_POST['d_v'];
$rut=$rut."-".$d_v;
$email=$_POST['email'];
$forma_pago=$_POST['forma_pago'];
$contacto=$_POST['contacto'];
$color_p=$_POST['color_p'];
$email=strtoupper($email);

if ($cod_directorio==0){

	//INGRESAR REGISTRO AL SISTEMA CON INSERT

$sql = "INSERT INTO directorio (color_p, tipo, rut, nombre, giro, direccion, comuna, ciudad, fono, email, observaciones, forma_pago)
VALUES ('".$color_p."', '".$tipo."', '".$rut."', '".$razon_social."', '".$giro."', '".$direccion."', '".$comuna."', '".$ciudad."', '".$fono."', '".$email."', '".$observaciones."', '".$forma_pago."')";




if ($db->query($sql) === TRUE) {
header("Location: directorio.php");
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}
exit;

}

else { 

//MODIFICA PRODUCTO
$sql = "UPDATE directorio SET color_p='$color_p', tipo='$tipo', rut='$rut', nombre='$razon_social', giro='$giro', direccion='$direccion', comuna='$comuna', ciudad='$ciudad', fono='$fono', email='$email', observaciones='$observaciones', forma_pago='$forma_pago' WHERE cod_directorio='$cod_directorio'";

if ($db->query($sql) === TRUE) {
header("Location: directorio.php");
} else {
echo "Error: " . $sql . "<br>" . $db->error;
}

exit;
}

?>
