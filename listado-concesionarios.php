<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Emol autom&oacute;viles</title>
  <meta name="description" content="Autos nuevos, Autos usados, jeep, camionetas, todo terreno, compra y venta, Automviles EMOL">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="css/normalize.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script type="text/javascript" src="js/vendor/jquery-1.7.1.js"></script>
  <script type="text/javascript" src="js/vendor/modernizr-2.6.2.min.js"></script>
    
  <!-- LIGHTBOX -->
  <link rel="stylesheet" type="text/css" href="js/lightbox/shadowbox.css">
  <script type="text/javascript" src="js/lightbox/shadowbox.js"></script>
  <script type="text/javascript">
    Shadowbox.init();
  </script>

    
</head>

<body>
<?php
  include('connect.php'); 
	
  //Consulta de Menu de navegación.
	include('menu.php');

    //Consulta de Sucursaless de Concesionarios cargadas.

    try
    {
      $sql_sucursales = 'select id_sucursal, calle, numero, comuna, ciudad, telefono, id_concesionario, prioridad from sucursales order by prioridad ASC ';
      $result_sucursales =mysql_query($sql_sucursales);
      $max = mysql_num_rows($result_sucursales);
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar noticias');
    }
	?>    
  <div id="wrap">
  
    <div id="header">
      
      <div id="Logo_02">
        <a href="index.php"><img src="img/Logo.png" alt="Emol automviles" /></a>
	  </div>
      
      <div id="btn_menu_mobile" onClick="$('#nav').slideToggle('middle')"><img src="img/btn-menu.gif" alt="Menú" /></div>
     
      <div id="nav">
        <a href="<?php echo $url1;?>"><?php echo $menu1;?></a>
        <a href="<?php echo $url2;?>"><?php echo $menu2;?></a>
        <a href="<?php echo $url3;?>"><?php echo $menu3;?></a>
        <a href="<?php echo $url4;?>"><?php echo $menu4;?></a>
        <a href="<?php echo $url5;?>"><?php echo $menu5;?></a>
      </div>
          
    </div>
    
    <div id="Listado_concesionarios">
    
      <p class="indicador_seccion" style="padding-left:21px;"><a href="index.php">Inicio</a> > <a style="text-decoration: none;">Concesionarios</a></p>
      
      <ul class="List_conces">
         
    <?php 
                for($i=0;$i<$max;$i++)
                {
                  $row_sucursales=mysql_fetch_row($result_sucursales);
                  $id_sucursal=$row_sucursales[0];
                  $calle=$row_sucursales[1];
                  $numero=$row_sucursales[2];
                  $comuna=$row_sucursales[3];
                  $ciudad = $row_sucursales[4];
                  $telefono = $row_sucursales[5];
                  $id_concesionario = $row_sucursales[6];
                  $orden = $row_sucursales[7];
                  
                  $sql_concesionario = 'select nombre_concesionario, logo, id_concesionario_sap  from concesionario_sap  where bp_concesionario = "'.$id_concesionario.'"';
                  $result_concesionarios= mysql_query($sql_concesionario);
                  $row_concesionarios=mysql_fetch_row($result_concesionarios);
                  $nombre_concesionario=$row_concesionarios[0];
                  $logo=$row_concesionarios[1]; 
                  $id_concesionario = $row_concesionarios[2];
      ?>
                  <li>
                    <a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario;?>&id_sucursal=<?php echo $id_sucursal;?>"><img style="width:160px; height:70px;" src="upload/concesionarios/<?php echo $logo;?>" alt="<?php echo $nombre_concesionario;?>" /></a>
                    <h1><?php echo $nombre_concesionario;?></h1>
                    <p>
                    <?php
                        if($calle)
                        {
                         echo $calle.' '.$numero.', '.$comuna; ?><br />
                    <?php
                       } 
                    ?>
                     Fono: <?php echo $telefono;?></p>
                  </li>
      <?php  
                }
      ?>
          
       </ul>
        
  <!--<div class="pagination">
        <ul>
          <li class="prev"><a class="facetview_decrement" href="#">..</a></li>
          <li class="active"><a>1 &minus; 10 de 12</a></li>
          <li class="next"><a class="facetview_increment" href="#">Siguiente &raquo;</a></li>
        </ul>
      </div>!-->
      
    
    </div>
    
    <div id="footer">T&eacute;rminos y Condiciones de Los Servicios &copy; 2013 El Mercurio Online</div>
  
  </div>
<?php 
	mysql_close($conn);   
?>
</body>
</html>
