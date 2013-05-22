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
  //Consulta de Menu de navegaci&oacute;n.
  include('menu.php');
		
    
  $valores = array_values($_GET);
 
      $sql_pruebas_maneja = 'select id_prueba, titulo_prueba, subtitulo_prueba, periodista, fecha_prueba, bajada_titulo, estado_prueba, glosa_periodistica  from pruebas_manejo 
      where id_prueba = "'.$valores[0].'"';
      $result_pruebas_manejo= mysql_query($sql_pruebas_maneja);
      $array_pruebas_manejo =mysql_fetch_row($result_pruebas_manejo);
      $id_prueba        =$array_pruebas_manejo[0];
      $titulo_prueba      =$array_pruebas_manejo[1];
      $subtitulo_prueba  = $array_pruebas_manejo[2];
      $periodista       =$array_pruebas_manejo[3];
      $fecha          = $array_pruebas_manejo[4];
      $bajada_titulo      = $array_pruebas_manejo[5];
      $estado_prueba      = $array_pruebas_manejo[6];
      $glosa_periodistica  = $array_pruebas_manejo[7];
      
      $sql_img_pruebas  = 'select  id_imagen_prueba, imagen_prueba, id_prueba_manejo from automoviles.imagenes_pruebas_manejo where id_prueba_manejo = "'.$id_prueba.'"';
      $result_img_prueba = mysql_query($sql_img_pruebas);
      $array_img_prueba = mysql_fetch_array($result_img_prueba);
      $id_img         = $array_img_prueba[0];
      $nombre_imagen  = $array_img_prueba[1];
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
    
      <p class="indicador_seccion"><a href="index.php">Inicio</a> > <a href="listado-pruebas.php">Pruebas de manejo</a> > <a ><?php echo $titulo_prueba;?>s</a></p>
      
      <div id="despliegue_noticias_Left">
      
        <p class="epigrafe"><?php echo $titulo_prueba;?></p>
        
        <h1 class="titulo_noticia"><?php echo $subtitulo_prueba;?></h1>
        
        <p class="bajada_noticia"><?php echo $bajada_titulo;?></p>
        
        <div class="content_img_despliegue"><a href="upload/noticias-autos/<?php echo $nombre_imagen;?>" rel="shadowbox"><img src="upload/pruebas-manejo/<?php echo $nombre_imagen;?>" alt="" /></a></div>
        
        <div class="content_info_txt">
          <div class="box fr" id="desktop"><a onclick="window.print();" style="cursor: pointer;"><img src="img/btn_impr.gif" alt="Imprimir" /></a></div>
          <p class="autor"><?php echo $periodista;?> | El Mercurio</p>
          <p><?php echo $glosa_periodistica;?></p>
          </div>
      
      </div>
        
      <div id="despliegue_noticias_Right">
        
        <div class="box_redes_sociales boxes_aside">
          <div class="box">
            <!-- AddThis Button BEGIN -->
            <div class="addthis_toolbox addthis_default_style">
              <a class="addthis_button_preferred_1"></a>
              <a class="addthis_button_preferred_2"></a>
              <a class="addthis_button_preferred_3"></a>
              <a class="addthis_button_preferred_4"></a>
              <a class="addthis_button_compact"></a>
              <a class="addthis_counter addthis_bubble_style"></a>
          </div>
            <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-516d5cbc05abd6c6"></script>
            <!-- AddThis Button END -->
          </div>
        </div>
        
        <div class="content_publicidad_300"><img src="images/publicidad_2.jpg" alt="Publicidad" /></div>
        
        <div id="publicidad_Mobile_02"><img src="images/banner-publicidad.jpg" alt="Emol automviles" /></div>
        
      </div>
    
    </div>
    
    <div id="footer">T&eacute;rminos y Condiciones de Los Servicios &copy; 2013 El Mercurio Online</div>
  
  </div>

</body>
</html>
