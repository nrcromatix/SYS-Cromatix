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
<html >
<head>
<link rel="stylesheet" type="text/css" href="../stylesheet.css">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<script type="text/javascript">
</script>
</head>

<?php
    include "../connect.php";
    
    $cod_documento = $_GET["cod_documento"];
    $td = $_GET["td"];
    ?>

<body>



<table width="900" cellpadding="1" cellspacing="1" align="center">
<?PHP include "../header.php";?>
</table>
<br>

<ul>



<h1>Carga de Archivos</h1>
<p>Debe seleccionar el archivo "<?php echo $td; ?>" relacionado a la orden <b><?php echo $cod_documento; ?></b>.</p>
<br>

<?php
    //mssql_close();
    ?>
<form id="form1" name="upload" action="upload_redirect.php?cod_documento=<?php echo $cod_documento; ?>&td=<?php echo $td; ?>" method="post" enctype="multipart/form-data">

Seleccione Archivo:
<input type="file" name="fileToUpload" id="fileToUpload">
<input type="submit" value="Subir..." name="submit">

</form>


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

