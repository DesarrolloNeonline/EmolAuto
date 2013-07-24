<?php/*
include('connect.php'); 

$sql_fecha_modificacion = 'select  fecha_modificacion FROM concesionario';
$result_update_concesionarios= mysql_query($sql_fecha_modificacion);
$array_fecha_modificacion= mysql_fetch_row($result_update_concesionarios);
$fecha_modificacion = $array_fecha_modificacion[0];
date_default_timezone_set("America/Santiago");
$date = date('Y-m-d');

if($fecha_modificacion != $date){

      echo $date;
      $sql_update_concesionario = 'select id_concesionario, bp_concesionario FROM concesionario';
      $result_update_concesionarios= mysql_query($sql_update_concesionario);
      $max_concesionario= mysql_num_rows($result_update_concesionarios);

      for($i=0;$i<$max_concesionario;$i++){

        $row_concesionarios=mysql_fetch_row($result_update_concesionarios);
        $id_concesionario = $row_concesionarios[0];
        $bp_concesionario = $row_concesionarios[1];

        $url = $indice_ficha.'_search?q=nro_bp:'.$bp_concesionario;
        $content = file_get_contents($url);
        $json = json_decode($content, true);
        $hits = $json["hits"]; 
        $cantidad_ficha = $hits['total'];


        $sql_update_concesionario = 'update automoviles.concesionario set cantidad_ficha = "'.$cantidad_ficha.'", fecha_modificacion = "'.$date .'"
        where bp_concesionario = "'.$bp_concesionario.'"';
        mysql_query($sql_update_concesionario);
      }
}*/
?>
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
    <!--Setup Publicidades Addserver!-->
    <script type="text/javascript" src="http://banners.emol.com/tags/automoviles/setup_detalle.js"></script>
    <!--end-->
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
    nombre_fantasia,logo_chico, logo_grande, estado_publicacion, bp_concesionario, cantidad_ficha FROM concesionario where estado_publicacion = "1" ORDER BY cantidad_ficha DESC ');
    $stmt->execute();
    ?>    
    <div id="wrap">
      <div id="header">
        <div id="Logo_02">
          <a href="index.php"><img src="img/Logo.png" alt="Emol automviles" /></a>
        </div>
        <div class="content_publicidad_728">
          <script type="text/javascript" src="http://banners.emol.com/tags/automoviles/horizontal_01.js"></script> 
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
   
          /*
          while($value = $stmt->fetch()) {  

            if($value['cantidad_ficha'] > 5){ ?>

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
          }*/

          //Solución Json indice concesionarios
            $url = $indice_concesionario.'_search?source=%7B"query"%3A%7B"custom_score"%3A%7B"query"%3A%7B"match_all"%3A%7B%7D%7D%2C"script"%3A"_score%2Bdoc%5B%27nacfp%27%5D.value"%7D%7D%7D&size=300';
            $content = file_get_contents($url);
            $json = json_decode($content, true);
            $hits = $json["hits"]; 
            

            foreach($hits["hits"] as $hit_concesionario) 
            { 
                    
              $item_img           = $hit_concesionario["_source"]["concesionario"];
              $logo_grande        = $item_img['logo_grande'];
              $nombre_fantasia    =  $item_img['nombre_fantasia'];
              $bp_concesionario    =  $item_img['bp_concesionario'];

              $url = $indice_ficha.'_search?q=nro_bp:'.$bp_concesionario;
              $content = file_get_contents($url);
              $json = json_decode($content, true);
              $hits = $json["hits"]; 
              $cantidad_ficha = $hits['total'];

              if($cantidad_ficha>=5){

                    $sql_concesionario  = 'select   id_concesionario, telefono, comuna, calle, numero, estado_publicacion from automoviles.concesionario
                    where bp_concesionario ="'.$bp_concesionario.'"';
                    $result_concesionario = mysql_query($sql_concesionario);
                    $array_concesionarios = mysql_fetch_array($result_concesionario);
                    $id_concesionario= $array_concesionarios[0];
                    $telefono= $array_concesionarios[1];
                    $comuna= $array_concesionarios[2];
                    $calle= $array_concesionarios[3];
                    $numero= $array_concesionarios[4];
                    $estado_publicacionfrom= $array_concesionarios[5];
                  ?>

                    <li>
                        <a href="despliegue-concesionarios.php?id_concesionario=<?php echo  $id_concesionario;?>"><img src="upload/concesionarios/<?php echo $logo_grande;?>" /></a>
                        <h1><?php echo  $nombre_fantasia ;?></h1>
                        <p>
                          <?php if($calle) {
                               echo $calle.' '.$numero.', '.$comuna; ?><br />
                          <?php } ?>
                           Fono: <?php echo $telefono;?> <br><br>
                           <b>Cantidad Fichas: <?php echo $cantidad_ficha;?><b>
                        </p>
                    </li>
              <?php
              }
            }?>
          </ul>
        
  <!--<div class="pagination">
        <ul>
          <li class="prev"><a class="facetview_decrement" href="#">..</a></li>
          <li class="active"><a>1 &minus; 10 de 12</a></li>
          <li class="next"><a class="facetview_increment" href="#">Siguiente &raquo;</a></li>
        </ul>
      </div>!-->
      </div>
      <div id="footer">T&eacute;rminos y Condiciones de los Servicios &copy; 2013 El Mercurio Online</div>
    </div>
    <?php 
      mysql_close($conn);   
    ?>
  </body>
</html>