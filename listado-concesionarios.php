
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
  	include('menu.php');

    $config = include(dirname(__FILE__) . "/config/config.php");

    $dbh = new PDO($config["dsn"], $config["username"], $config["password"]);
    $stmt = $dbh->prepare('SELECT id_concesionario, calle, numero, comuna, ciudad, telefono, telefono_adicional, id_concesionario, prioridad,
    nombre_fantasia,logo_chico, logo_grande, estado_publicacion, bp_concesionario FROM concesionario where estado_publicacion = "1" ORDER BY nombre_fantasia ASC ');
    $stmt->execute();
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
          <?php 
          if($menu5){ ?>
             <a href="<?php echo $url5;?>"><?php echo $menu5;?></a>
          <?php   
          }
          else{

          } ?>
          </div>    
        </div>
        <div id="Listado_concesionarios">
          <p class="indicador_seccion" style="padding-left:21px;"><a href="index.php">Inicio</a> > <a style="text-decoration: none;">Concesionarios</a></p>
          <ul class="List_conces">

        <?php
   
          while($value = $stmt->fetch()) {  

            $bp_concesionario = $value['bp_concesionario'];

            $url = 'http://ailab01.mersap.com/automoviles/ficha/_search?q=nro_bp:'.$bp_concesionario;
            $content = file_get_contents($url);
            $json = json_decode($content, true);
            $hits = $json["hits"]; 
            $hits['total'];
               
               if($hits['total'] > 5){ ?>

                <li>
                  <a href="despliegue-concesionarios.php?id_concesionario=<?php echo $value['id_concesionario'];?>"><img src="upload/concesionarios/<?php echo $value['logo_grande'];?>" /></a>
                  <h1><?php echo $value['nombre_fantasia'];?></h1>
                  <p>
                  <?php if($value['calle']) {
                       echo $value['calle'].' '.$value['numero'].', '.$value['comuna']; ?><br />
                  <?php } ?>
                   Fono: <?php echo $value['telefono'];?></p>
                </li>
          <?php
             }
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
