
<html>
	<head>
		
<link href="navigation.css" rel="stylesheet">
</head>

<body>
<nav id="navigation" class="site-navigation" role="navigation">
	<center>
  <ul class="menu">
   
   
        <li class="menu-item"><a href="/busca_producto.php">Productos</a>
      <ul class="dropdown">
<?php 


$sqlper = "SELECT * FROM directorio WHERE login='".$_SESSION["user"]."'";
$resultper = $db->query($sqlper);
if ($resultper->num_rows > 0) {
    // output data of each row
    while($rowper = $resultper->fetch_assoc()) {
$nivelper=$rowper["nivel"];
$id_vendedor=$rowper["cod_directorio"];
}}

if ($nivelper<>3 and $nivelper<>4) { ?>
		  <li class="menu-item sub-menu"><a href="/nuevo_producto.php">Nuevo Producto</a></li>
		   <li class="menu-item sub-menu"><a href="/categorias.php">Categorias</a></li>
	<?php } ?>
      </ul>
    </li>
<?php
if ($nivelper<>4) { ?>

    
            <li class="menu-item"><a href="/directorio/directorio.php">Directorio</a>
      <ul class="dropdown">

      </ul>
    </li>

<?php } ?>

            <li class="menu-item"><a href="/documentos/documentos.php">Documentos</a>
<?php if ($nivelper<>4) { ?>         
<ul class="dropdown">
<li class="menu-item sub-menu"><a href="/documentos/ordenes_compra.php">Seguimiento Ordenes</a></li>
      </ul><?php } ?>
    </li>

<?php if ($nivelper<>3 and $nivelper<>4) { ?>     
              <li class="menu-item"><a href="">Reportes</a>
      <ul class="dropdown">
		  <li class="menu-item sub-menu"><a href="/reporte_cot_aceptadas.php">Cotizaciones Aceptadas</a></li>
		   <li class="menu-item sub-menu"><a href="/flujo_caja.php">Flujo de Caja</a></li>
		   <li class="menu-item sub-menu"><a href="/cobranza.php">Cobranza</a></li>
			<li class="menu-item sub-menu"><a href="/ventasxcliente.php">Ventas por Cliente</a></li>
      </ul>
    </li>
    
    </li>
<?php } ?>
           <li class="menu-item"><a href="/rrhh/rrhh.php">RRHH</a>
      <ul class="dropdown">

      </ul>
            <li class="menu-item"><a href="/logout.php">Salir</a>
      <ul class="dropdown">

      </ul>
    </li>
   
    
 
          
      </ul>
  
</nav>
<br>
<b><font size=1> v1.0</font></b>
<br>
<b><font size=1> user: <?php echo $_SESSION["user"]; ?></font></b>
</center>
</body>
</html>
