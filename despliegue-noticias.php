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
 
      $sql_noticias  = 'select  id_noticia, titulo_noticia, subtitulo_noticia, bajada_titulo, glosa_periodistica, periodista, 
      estado_publicacion, fecha_noticia from automoviles.noticias where id_noticia = "'.$valores[0].'"';
      $result_noticias = mysql_query($sql_noticias);
      $array_noticia = mysql_fetch_array($result_noticias);
      $id_noticia= $array_noticia[0];
      $titulo_noticia= $array_noticia[1]; 
      $subtitulo_noticia= $array_noticia[2]; 
      $bajada_titulo= $array_noticia[3]; 
      $glosa_periodistica= $array_noticia[4]; 
      $periodista= $array_noticia[5]; 
      $estado_publicacion= $array_noticia[6]; 

      $sql_img_noticias  = 'select  id_imagen_noticia, nombre_imagen, id_noticia from automoviles.imagenes_noticias where id_noticia = "'.$id_noticia.'"';
      $result_img_noticias = mysql_query($sql_img_noticias);
      $array_img_noticia = mysql_fetch_array($result_img_noticias);
      $id_img         = $array_img_noticia[0];
      $nombre_imagen  = $array_img_noticia[1];
	?>  
  <div id="wrap">
  
    <div id="header">
    
    <div id="publicidad_Mobile_01">
        <img src="images/publicidad-mobile.jpg" alt="Emol automviles" />      </div>

      <div id="publicidad_Mobile_02">
        <img src="images/banner-publicidad.jpg" alt="Emol automviles" />      </div>

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
    
    <div id="despliegue_not">
    
      <p class="indicador_seccion"><a href="#">Inicio</a> > <a href="#">Noticias</a></p>
      
      <div id="despliegue_noticias_Left">
      
        <p class="epigrafe"><?php echo $titulo_noticia;?></p>
        
        <h1 class="titulo_noticia"><?php echo $subtitulo_noticia;?></h1>
        
        <p class="bajada_noticia"><?php echo $bajada_titulo;?></p>
        
        <div class="content_img_despliegue"><a href="upload/noticias-autos/<?php echo $nombre_imagen;?>" rel="shadowbox"><img src="upload/noticias-autos/<?php echo $nombre_imagen;?>" alt="" /></a></div>
        
        <div class="content_info_txt">
          <div class="box fr" id="desktop"><a onclick="window.print();" style="cursor: pointer;"><img src="img/btn_impr.gif" alt="Imprimir" /></a></div>
          <p class="autor"><?php echo $periodista;?> | El Mercurio</p>
          <?php echo $glosa_periodistica;?>
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
        <div class="content_publicidad_300"><img src="images/publicidad_2.jpg" alt="Publicidad"></div>
        
      </div>
    
    </div>
    
    <div id="footer">T&eacute;rminos y Condiciones de Los Servicios &copy; 2013 El Mercurio Online</div>
  
  </div>

</body>
</html>
