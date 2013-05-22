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
   <script src="http://apps.emol.com/widgets/mapas/v3/xygo.min.js"></script>

    
</head>

<body>
  
 <?php 
 include('connect.php'); 
 include('menu.php');

    $valores = array_values($_GET);
    $id_concesionario = $valores[0];

    $sql_concesionario = 'select nombre_fantasia,  logo_chico, bp_concesionario, calle, numero, comuna, ciudad, 
    telefono, telefono_adicional, prioridad, encargado, RUT, tipo, latitud, longitud, logo_grande, imagen_concesionario from concesionario  where id_concesionario = "'.$id_concesionario.'"';
    $result_concesionarios= mysql_query($sql_concesionario);
    $row_concesionarios=mysql_fetch_row($result_concesionarios);
    $nombre_fantasia=$row_concesionarios[0];
    $logo=$row_concesionarios[1]; 
    $bp_concesionario = $row_concesionarios[2];
    $calle=$row_concesionarios[3];
    $numero=$row_concesionarios[4];
    $comuna=$row_concesionarios[5];
    $ciudad = $row_concesionarios[6];
    $telefono = $row_concesionarios[7];
    $telefono_adicional = $row_concesionarios[8];
    $orden = $row_concesionarios[9];
    $encargado = $row_concesionarios[10];
    $rut = $row_concesionarios[11];
    $tipo = $row_concesionarios[12];
    $latitud = $row_concesionarios[13];
    $longitud = $row_concesionarios[14];
    $logo_grande = $row_concesionarios[15];
    $imagen_concesionario = $row_concesionarios[16];


    $latitud_ini = substr($latitud ,0 ,3);
    $latitud_inicial = $latitud_ini.'.';
    $latitud_fin = substr($latitud ,3);
    $latitud = $latitud_inicial.$latitud_fin;

    $longitud_ini = substr($longitud ,0 ,3);
    $longitud_inicial = $longitud_ini.'.';
    $longitud_fin = substr($longitud ,3);
    $longitud = $longitud_inicial.$longitud_fin;


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
    
    <div id="despliegue_concesionarios">
    
      <p class="indicador_seccion"><a href="index.php">Inicio</a> > <a href="listado-concesionarios.php">Concesionarios</a>  >  <?php echo $nombre_fantasia;?></p>
      
      <div id="despliegue_concesionario_Left">
        
        <h1 class="nombre_concesionario"><?php echo $nombre_fantasia;?></h1>
        
        <div class="content_img_concesionario">
		
		<?php
			if($imagen_concesionario)
			{?>
				 <img src="upload/concesionarios/<?php echo $imagen_concesionario;?>" alt="Nombre Concesionario" />
	<?php	} 
				else { ?>
						
			<?php	}	?>
        </div>
        
        <div class="content_info_concesionario">
          <div class="img_Logo_concesionario"><img src="upload/concesionarios/<?php echo $logo;?>" alt="Nombre concesionario" /></div>
          <div class="info_concesionario"><strong>Tipo</strong><br /><?php echo $tipo;?></div>
          <div class="info_concesionario">
            <strong>Contacto</strong><br />
            <?php 
              if($encargado)
              {
                echo $encargado;
              }
                else
                    {
                      echo "No existe informaci&oacute;n.";
                    }
             ?>
          </div>

          <div class="info_concesionario"><strong>Tel&eacute;fono</strong><br /><?php echo $telefono;?></div>
      <?php 
        if($telefono_adicional){ ?>
          <div class="info_concesionario"><strong>Tel&eacute;fono Adicional</strong><br /><?php echo $telefono_adicional;?></div>
      <?php 
        } ?>
        <div class="info_concesionario"><strong>Direcci&oacute;n</strong><br /><?php echo $calle.' '.$numero.', '.$comuna;?></div>
        </div>
        
        <div class="content_Btn_concesionario">
          <div class="btn_concesionario"><a href="modal-mas-info-concesionario.php?" rel="Shadowbox;width=445;height=600;">pedir informaci&oacute;n</a></div>
          <div class="btn_concesionario"><a onClick="$('#content_mapa_sucursal').slideToggle('middle')">mapa de ubicaci&oacute;n</a></div>
          <div class="btn_concesionario"><a onClick="$('#sucursales').slideToggle('middle')">otras sucursales</a></div>
        </div>
        
        <ul class="otras_sucursales" id="sucursales">
          <?php 
          $sql_concesionario_sucursales = 'select  calle, numero, comuna from concesionario where RUT = "'.$rut.'" and bp_concesionario  not like "'.$bp_concesionario.'" ';
          $result_concesionario_sucursales =mysql_query($sql_concesionario_sucursales);
          $max = mysql_num_rows($result_concesionario_sucursales);
          
          if($max==0)
          { ?>
               <li>No existen otras Sucursales para este Concesionario.</li>
        <?php  
          } else
                {

                  for($i=0;$i<$max;$i++)
                  {  
                    $row_sucursales=mysql_fetch_row($result_concesionario_sucursales);
                    $calle=$row_sucursales[0];
                    $numero=$row_sucursales[1];
                    $comuna=$row_sucursales[2];
                    ?>
                 
                     <li><strong>Sucursal <?php echo $comuna;?> </strong> &nbsp;&nbsp;<?php echo $calle.' '.$numero;?></li>
            <?php       
                   } 
                }?>
        </ul>
        
		<?php  
		if(($latitud!=0) &&($longitud!=0))
		{ ?>
				<div id="content_mapa_sucursal" style="display:block;">
				   <div id="map" style="max-width:638px;height:198px"></div>
						<script>
							var map = new XYGO.Map('map')
							var concesionario = '<?php echo $nombre_fantasia?>'
							var latitud = '<?php echo $latitud?>'
							var longitud = '<?php echo $longitud?>'

							var ubicacion = new L.LatLng(latitud, longitud)        
							
							map.setCenter(ubicacion, 15);
							map.addMarker(ubicacion, concesionario, { open: true })

					  </script>  
				</div>
		<?php   } ?>

    <?php

    $url = 'http://ailab01.mersap.com/automoviles/ficha/_search?q=nro_bp:'.$bp_concesionario;
    $content = file_get_contents($url);
    $json = json_decode($content, true);

    foreach($json['_source'] as $item) 
    {
      $marca              = $item['marca'];
      $modelo             = $item['modelo'];
      $texto              = $item['texto'];
      $anno               = $item['año']; 
      $precio             = $item['precio'];
           
    }  ?>
 
        <!--<div id="content_List_autos">
        
          <h1 class="title_color_despliegue">Avisos publicados</h1>
    
          <ul class="List_result">
        
            <li>
              <div class="img_Auto_list"><img src="images/auto.jpg" alt="Auto" /></div>
              <div class="content_Txt_list">
                <a href="#"><strong>Mercedes Benz Motor Home</strong></a><br />
                <span>$ 18.000.000</span><br />
                2006
              </div>
              <div class="content_Select_send">
                <input type="checkbox" id="auto1" name="estado" value="all">
                <label for="auto1" title="Autos 0 Km" class="someClass">&nbsp;</label>
              </div>
            </li>
            <li>
              <div class="img_Auto_list"><img src="images/auto.jpg" alt="Auto" /></div>
              <div class="content_Txt_list">
                <a href="#"><strong>Mercedes Benz Motor Home</strong></a><br />
                <span>$ 18.000.000</span><br />
                2006
              </div>
              <div class="content_Select_send">
                <input type="checkbox" id="auto2" name="estado" value="all">
                <label for="auto2" title="Autos 0 Km" class="someClass">&nbsp;</label>
              </div>
            </li>
      
        
          </ul>
    
        </div> !-->
      
      
      </div>
        
      <div id="despliegue_concesionario_Right">
        
        <div class="content_publicidad_300"><img src="images/publicidad_2.jpg" alt="Publicidad" /></div>
        
        <div id="publicidad_Mobile_02"><img src="images/banner-publicidad.jpg" alt="Emol automviles" /></div>
        
      </div>
    
    </div>
    </div>
    <div id="footer">T&eacute;rminos y Condiciones de Los Servicios &copy; 2013 El Mercurio Online</div>
  
  </div>

</body>
</html>
