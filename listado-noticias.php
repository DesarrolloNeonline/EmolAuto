
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

    $dbh      = new PDO($config['dsn'], $config['username'], $config['password']);
    $stmt     = $dbh ->prepare('select  id_noticia, titulo_noticia, subtitulo_noticia, bajada_titulo, glosa_periodistica, periodista, estado_publicacion, target from automoviles.noticias order by fecha_noticia DESC');
    $stmt  -> execute();     
  ?>
    <div id="wrap">
      <div id="header">
        <div id="Logo_02">
          <a href="index.php"><img src="img/Logo.png" alt="Emol automviles" /></a>
        </div>
        <div class="content_publicidad_728">
          <script type="text/javascript" src="http://banners.emol.com/tags/automoviles/horizontal_01.js"></script> 
        </div>
        <div id="btn_menu_mobile" onClick="$('#nav').slideToggle('middle')">
          <img src="img/btn-menu.gif" alt="Menú" />
        </div>
        <div id="nav">
          <a href="<?php echo $url1;?>"><?php echo $menu1;?></a>
          <a href="<?php echo $url2;?>"><?php echo $menu2;?></a>
          <a href="<?php echo $url3;?>"><?php echo $menu3;?></a>
          <a href="<?php echo $url4;?>"><?php echo $menu4;?></a>
          <?php 
          if($menu5)
          { ?>
            <a href="<?php echo $url5;?>"><?php echo $menu5;?></a>
          <?php   
          }
          else
              {

              } ?>
        </div>
      </div>
      <div id="despliegue_not">
        <p class="indicador_seccion"><a href="index.php">Inicio</a> > <a href="listado-noticias.php">Noticias</a></p>
        <div id="listado_noticias_Left">
          <ul class="List_noticias">
            <?php
              while($post = $stmt-> fetch()){
                $stmt_2     = $dbh ->prepare('select  id_imagen_noticia, nombre_imagen_1, id_noticia from automoviles.imagenes_noticias where id_noticia = "'.$post["id_noticia"].'"');
                $stmt_2  -> execute(); 
                $post_2 = $stmt_2-> fetch();
                  if($post['estado_publicacion']==1)
                  {  
                    if($post['target']=='1')
                    { ?>
                      <li>
                        <a href="despliegue-noticias.php?id-noticia=<?php echo $post['id_noticia'];?>" target="_blank"><img src="upload/noticias-autos/<?php echo $post_2['nombre_imagen_1'];?>" alt="<?php echo $post['titulo_noticia'];?>" /></a>
                        <a href="despliegue-noticias.php?id-noticia=<?php echo $post['id_noticia'];?>" target="_blank"><h1><?php echo $post['titulo_noticia']; ?></h1></a>
                        <p><?php echo $post['bajada_titulo']; ?></p>
                      </li>
                <?php
                    } 
                    else  { ?>
                            <li>
                              <a href="despliegue-noticias.php?id-noticia=<?php echo $post['id_noticia']; ?>"><img src="upload/noticias-autos/<?php echo $post_2['nombre_imagen_1'];?>" alt="<?php echo $post['titulo_noticia']; ?>" /></a>
                              <a href="despliegue-noticias.php?id-noticia=<?php echo $post['id_noticia']; ?>"><h1><?php echo $post['titulo_noticia']; ?></h1></a>
                              <p><?php echo $post['bajada_titulo']; ?></p>
                            </li>
                <?php
                          } 
                  } 
              } ?>
          </ul>
        
          <!--<div class="pagination">
            <ul>
              <li class="prev"><a class="facetview_decrement" href="#">..</a></li>
              <li class="active"><a>1 &minus; 10 of 12</a></li>
              <li class="next"><a class="facetview_increment" href="#">Siguiente &raquo;</a></li>
            </ul>
          </div>!-->
        
        </div>
        <div id="listado_noticias_Right">
          <div class="content_publicidad_300">
            <script type="text/javascript" src="http://banners.emol.com/tags/automoviles/robpg_01.js"></script>
          </div>
          <!--div id="publicidad_Mobile_02">
            <script type="text/javascript" src="http://banners.emol.com/tags/automoviles/robpg_01.js"></script>
          </div-->
        </div>
      </div>
      <div id="footer">T&eacute;rminos y Condiciones de los Servicios &copy; 2013 El Mercurio Online</div>
    </div>

</body>
</html>
