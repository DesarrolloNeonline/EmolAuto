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
    $id_sucursal = $valores[1];

    $sql_concesionario = 'select nombre_concesionario, logo, bp_concesionario from concesionario_sap  where id_concesionario_sap = "'.$id_concesionario.'"';
    $result_concesionarios= mysql_query($sql_concesionario);
    $row_concesionarios=mysql_fetch_row($result_concesionarios);
    $nombre_concesionario=$row_concesionarios[0];
    $logo=$row_concesionarios[1]; 
    $bp_concesionario = $row_concesionarios[2];

    $sql_sucursales = 'select  calle, numero, comuna, ciudad, telefono, id_concesionario, prioridad, encargado, latitud, longitud
     from sucursales where id_sucursal = "'.$id_sucursal.'"';
    $result_sucursales =mysql_query($sql_sucursales);
    $max = mysql_num_rows($result_sucursales);
    $row_sucursales=mysql_fetch_row($result_sucursales);
    $calle=$row_sucursales[0];
    $numero=$row_sucursales[1];
    $comuna=$row_sucursales[2];
    $ciudad = $row_sucursales[3];
    $telefono = $row_sucursales[4];
    $id_concesionario = $row_sucursales[5];
    $orden = $row_sucursales[6];
    $latitud = '-33.4265814';
    $longitud = '-70.5838641';
    $encargado = $row_sucursales[7];

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
    
    <div id="despliegue_concesionarios">
    
      <p class="indicador_seccion"><a href="index.php">Inicio</a> > <a href="listado-concesionarios.php">Concesionarios</a>  >  <?php echo $nombre_concesionario;?></p>
      
      <div id="despliegue_concesionario_Left">
        
        <h1 class="nombre_concesionario"><?php echo $nombre_concesionario;?></h1>
        
        <div class="content_img_concesionario">
          <img src="images/IL1828399.jpg" alt="Nombre Concesionario" style="width: 300px;" />
        </div>
        
        <div class="content_info_concesionario">
          <div class="img_Logo_concesionario"><img src="upload/concesionarios/<?php echo $logo;?>" alt="Nombre concesionario" /></div>
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
          <div class="info_concesionario"><strong>Direcci&oacute;n</strong><br /><?php echo $calle.' '.$numero.', '.$comuna;?></div>
        </div>
        
        <div class="content_Btn_concesionario">
          <div class="btn_concesionario"><a href="modal-mas-info-concesionario.php?" rel="Shadowbox;width=445;height=600;">pedir informaci&oacute;n</a></div>
          <div class="btn_concesionario"><a onClick="$('#content_mapa_sucursal').slideToggle('middle')">mapa de ubicaci&oacute;n</a></div>
          <div class="btn_concesionario"><a onClick="$('#sucursales').slideToggle('middle')">otras sucursales</a></div>
        </div>
        
        <ul class="otras_sucursales" id="sucursales">
          <?php 
          $sql_sucursales = 'select id_sucursal, calle, numero, comuna, ciudad, telefono, id_concesionario, prioridad from sucursales where id_concesionario = "'.$bp_concesionario.'" 
          and id_sucursal  not like "'.$id_sucursal.'" ';
          $result_sucursales =mysql_query($sql_sucursales);
          $max = mysql_num_rows($result_sucursales);
          
          if($max==0)
          { ?>
               <li>No existen otras Sucursales para este Concesionario.</li>
        <?php  
          } else
                {

                  for($i=0;$i<$max;$i++)
                  {  
                    $row_sucursales=mysql_fetch_row($result_sucursales);
                    $id_sucursal=$row_sucursales[0];
                    $calle=$row_sucursales[1];
                    $numero=$row_sucursales[2];
                    $comuna=$row_sucursales[3];
                    $ciudad = $row_sucursales[4];
                    ?>
                 
                     <li><strong>Sucursal <?php echo $comuna;?> </strong> &nbsp;&nbsp;<?php echo $calle.' '.$numero;?></li>
            <?php       
                   } 
                }?>
        </ul>
        
        <div id="content_mapa_sucursal" style="display:block;">
           <div id="map" style="max-width:638px;height:198px"></div>
                <script>
                    var map = new XYGO.Map('map')
                    var concesionario = '<?php echo $nombre_concesionario?>'
                    var latitud = '<?php echo $latitud?>'
                    var longitud = '<?php echo $longitud?>'

                    var ubicacion = new L.LatLng(latitud, longitud)        
                    
                    map.setCenter(ubicacion, 15);
                    map.addMarker(ubicacion, concesionario, { open: true })

              </script>  
        </div>
<!--
        <div id="content_List_autos">
        
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
            <li>
              <div class="img_Auto_list"><img src="images/auto.jpg" alt="Auto" /></div>
              <div class="content_Txt_list">
                <a href="#"><strong>Mercedes Benz Motor Home</strong></a><br />
                <span>$ 18.000.000</span><br />
                2006
              </div>
              <div class="content_Select_send">
                <input type="checkbox" id="auto3" name="estado" value="all">
                <label for="auto3" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto4" name="estado" value="all">
                <label for="auto4" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto5" name="estado" value="all">
                <label for="auto5" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto6" name="estado" value="all">
                <label for="auto6" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto7" name="estado" value="all">
                <label for="auto7" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto8" name="estado" value="all">
                <label for="auto8" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto9" name="estado" value="all">
                <label for="auto9" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto10" name="estado" value="all">
                <label for="auto10" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto11" name="estado" value="all">
                <label for="auto11" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto12" name="estado" value="all">
                <label for="auto12" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto13" name="estado" value="all">
                <label for="auto13" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto14" name="estado" value="all">
                <label for="auto14" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto15" name="estado" value="all">
                <label for="auto15" title="Autos 0 Km" class="someClass">&nbsp;</label>
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
                <input type="checkbox" id="auto16" name="estado" value="all">
                <label for="auto16" title="Autos 0 Km" class="someClass">&nbsp;</label>
              </div>
            </li>
        
          </ul>
          
          <div class="pagination">
            <ul>
              <li class="prev"><a class="facetview_decrement" href="#">..</a></li>
              <li class="active"><a>1 &minus; 10 de 12</a></li>
              <li class="next"><a class="facetview_increment" href="#">Siguiente &raquo;</a></li>
            </ul>
          </div>
    
        </div> 
      !-->
      
      </div>
        
      <div id="despliegue_concesionario_Right">
        
        <div class="content_publicidad_300"><img src="images/publicidad_2.jpg" alt="Publicidad" /></div>
        
        <div id="publicidad_Mobile_02">
          <img src="images/banner-publicidad.jpg" alt="Emol automviles" />
        </div>
        
      </div>
    
    </div>
    
    <div id="footer">T&eacute;rminos y Condiciones de Los Servicios &copy; 2013 El Mercurio Online</div>
  
  </div>

</body>
</html>
