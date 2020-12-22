<?php

$email1= htmlspecialchars($_POST["emailenvio"]);
$adjunto = $_FILES["adjunto"];
// $urlfinal = ($_POST["imagenmail"]);
$urlfinal1 = str_replace(' ', '%20', $urlfinal);

if(isset($_POST ['submit'])){
    
    require '../documentos/PHPMailer/PHPMailerAutoload.php';

    $archivos3=""; 

    $mail = new PHPMailer;

    $mail->Host='smtp.gmail.com';
    $mail->Port='587';
    $mail->SMTPAuth=true;
    $mail->SMTPSecure='tls';
    $mail->Username="alejandrogajardo@cromatix.cl";
    $mail->Password="al267428";

    $mail->setFrom("Info@cromatix.cl");
    $mail->addAddress($email1);


    $mail->isHTML(true);
    $mail->Subject='Asunto: ' .$_POST['asunto'];
    $mail->Body= '<h4 align=left>'
                 .$_POST['nombre'] . 
                 '@CROMATIX' .
                 $_POST['msg'] . 
                 '<br>Productos Despachados: '
                 .$_POST['Cotizacion'] .
                 '</h4>';

    

    if(!$mail->send()){
        $result="Something went wrong, Try Again!";
    }else {
        $result = "Thanks ". $_POST['nombre'];
    }
}
header('Location: ' . $_SERVER["HTTP_REFERER"] );
// header("Location:../documentos/detalle_dcto.php")

?>

<!-- Beta = Ambas Alpha = class. -->