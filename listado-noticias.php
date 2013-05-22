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
	
 //Consulta de Noticias cargadas.

    try
    {
      $sql_noticias  = 'select  id_noticia, titulo_noticia, subtitulo_noticia, bajada_titulo, glosa_periodistica, periodista, 
      estado_publicacion, target from automoviles.noticias order by fecha_noticia DESC';
      $result_noticias = mysql_query($sql_noticias);
      $max = mysql_num_rows($result_noticias);
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
          for($i=0;$i<$max;$i++)
          {
              $array_noticia = mysql_fetch_array($result_noticias);
              $id_noticia= $array_noticia[0];
              $titulo_noticia= $array_noticia[1]; 
              $subtitulo_noticia= $array_noticia[2]; 
              $bajada_titulo= $array_noticia[3]; 
              $glosa_periodistica= $array_noticia[4]; 
              $periodista= $array_noticia[5]; 
              $estado_publicacion= $array_noticia[6]; 
              $target = $array_noticia[7];

              $sql_img_noticias  = 'select  id_imagen_noticia, nombre_imagen, id_noticia from automoviles.imagenes_noticias where id_noticia = "'.$id_noticia.'"';
              $result_img_noticias = mysql_query($sql_img_noticias);
              $array_img_noticia = mysql_fetch_array($result_img_noticias);
              $id_img         = $array_img_noticia[0];
              $nombre_imagen  = $array_img_noticia[1];

              if($estado_publicacion==1)
              {  

                  if($target=='1')
                  { ?>
                      <li>
                        <a href="despliegue-noticias.php?id-noticia=<?php echo $id_noticia;?>" target="_blank"><img src="upload/noticias-autos/<?php echo $nombre_imagen;?>" alt="<?php echo  $titulo_noticia;?>" /></a>
                        <a href="despliegue-noticias.php?id-noticia=<?php echo $id_noticia;?>" target="_blank"><h1><?php echo $titulo_noticia;?></h1></a>
                        <p><?php echo $bajada_titulo;?></p>
                      </li>
              <?php
                  } 
                    else  { ?>
                            <li>
                              <a href="despliegue-noticias.php?id-noticia=<?php echo $id_noticia;?>"><img src="upload/noticias-autos/<?php echo $nombre_imagen;?>" alt="<?php echo  $titulo_noticia;?>" /></a>
                              <a href="despliegue-noticias.php?id-noticia=<?php echo $id_noticia;?>"><h1><?php echo $titulo_noticia;?></h1></a>
                              <p><?php echo $bajada_titulo;?></p>
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
        
          <div class="content_publicidad_300"><img src="images/publicidad_2.jpg" alt="Publicidad" /></div>
        
          <div id="publicidad_Mobile_02"><img src="images/banner-publicidad.jpg" alt="Emol automviles" /></div>
        
      </div>
    
    </div>
    
    <div id="footer">T&eacute;rminos y Condiciones de Los Servicios &copy; 2013 El Mercurio Online</div>
  
  </div>
<?php 
	mysql_close($conn);   
?>
</body>
</html>
