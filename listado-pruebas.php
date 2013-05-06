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
      $sql_pruebas_maneja = 'select id_prueba, titulo_prueba, periodista, fecha_prueba, bajada_titulo, estado_prueba  from pruebas_manejo order by fecha_prueba DESC';
      $result_pruebas_manejo= mysql_query($sql_pruebas_maneja);
      $max = mysql_num_rows($result_pruebas_manejo);
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar noticias');
    }

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
    
      <p class="indicador_seccion"><a href="index.php">Inicio</a> > <a href="listado-pruebas.php">Pruebas de Manejo</a></p>
      
      <div id="listado_noticias_Left">
      
        <ul class="List_noticias">
         
        <?php
          for($i=0;$i<$max;$i++)
          {
              $array_pruebas_manejo =mysql_fetch_row($result_pruebas_manejo);
              $id_prueba        =$array_pruebas_manejo[0];
              $titulo_prueba      =$array_pruebas_manejo[1];
              $periodista       =$array_pruebas_manejo[2];
              $fecha          = $array_pruebas_manejo[3];
              $bajada_titulo      = $array_pruebas_manejo[4];
              $estado_prueba      = $array_pruebas_manejo[5];
              
              $sql_img_pruebas  = 'select  id_imagen_prueba, imagen_prueba, id_prueba_manejo from automoviles.imagenes_pruebas_manejo where id_prueba_manejo = "'.$id_prueba.'"';
              $result_img_prueba = mysql_query($sql_img_pruebas);
              $array_img_prueba = mysql_fetch_array($result_img_prueba);
              $id_img         = $array_img_prueba[0];
              $nombre_imagen  = $array_img_prueba[1];

              if($estado_prueba ==1)
              {
         ?>
              <li>
                <a href="despliegue-pruebas.php?id-noticia=<?php echo $id_prueba;?>"><img style ="width: 160px; height: 100px;"src="upload/pruebas-manejo/<?php echo $nombre_imagen;?>" alt="<?php echo  $titulo_prueba;?>" /></a>
                <a href="despliegue-pruebas.php?id-noticia=<?php echo $id_prueba;?>"><h1><?php echo $titulo_prueba;?></h1></a>
                <p><?php echo $bajada_titulo;?></p>
              </li>
        <?php  }
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
        
        <div class="content_Publicidad_desp" style="margin:0">
          <img src="images/publicidad_2.jpg" alt="Publicidad" />
        </div>
        
      </div>
    
    </div>
    
    <div id="footer">T&eacute;rminos y Condiciones de Los Servicios &copy; 2013 El Mercurio Online</div>
  
  </div>
<?php 
	mysql_close($conn);   
?>
</body>
</html>
