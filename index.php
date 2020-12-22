<?php
session_start();
if(isset($_SESSION["user"]))
{
 if((time() - $_SESSION['last_time']) > 86400) // Time in Seconds // UN DIA
 {
header("Location:logout.php");
 }
 else
 {
 $_SESSION['last_time'] = time();
header("Location: busca_producto.php");
 }
}
else
{
header("Location:login.php");
}
?>
