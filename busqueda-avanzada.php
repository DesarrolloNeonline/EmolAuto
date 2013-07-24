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
  <link rel="stylesheet" href="css/chosen.css">
  <script type="text/javascript" src="js/vendor/jquery-1.7.1.js"></script>
  <script type="text/javascript" src="js/vendor/modernizr-2.6.2.min.js"></script>
    
  <script type="text/javascript">
   function ilumina(divid){
    if (document.getElementById(divid).style.backgroundColor=="")
        {
        document.getElementById(divid).style.backgroundColor="#f9f8f8";
        }
    else
        {
        document.getElementById(divid).style.backgroundColor="";
        }
    }
  </script>
    
  <script type="text/javascript">
	function showhide(divid, state){
	  document.getElementById(divid).style.display=state
	}
  </script>
    
</head>

<body>
  <?php
  require_once 'connect.php'; 
    //Consulta de Menu de navegación.
    try 
    {
      $sql_nav_menu1  = 'select name_menu,url from nav_menu where id = 1';
      $nav_menu1 = mysql_query($sql_nav_menu1);
      $result_nav_menu1 = mysql_fetch_array($nav_menu1);
      $menu1= $result_nav_menu1[0];
      $url1= $result_nav_menu1[1];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar primer campo de menu');
    }
    try 
    {
      $sql_nav_menu2  = 'select name_menu,url from nav_menu where id = 2';
      $nav_menu2 = mysql_query($sql_nav_menu2);
      $result_nav_menu2 = mysql_fetch_array($nav_menu2);
      $menu2= $result_nav_menu2[0];
      $url2= $result_nav_menu2[1];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar segundo campo de menu');
    }
    try
    {
      $sql_nav_menu3  = 'select name_menu, url from nav_menu where id = 3';
      $nav_menu3 = mysql_query($sql_nav_menu3);
      $result_nav_menu3 = mysql_fetch_array($nav_menu3);
      $menu3= $result_nav_menu3[0];
      $url3= $result_nav_menu3[1];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar tercer campo de menu');
    }
    try
    {
      $sql_nav_menu4  = 'select name_menu, url from nav_menu where id = 4';
      $nav_menu4 = mysql_query($sql_nav_menu4);
      $result_nav_menu4 = mysql_fetch_array($nav_menu4);
      $menu4= $result_nav_menu4[0];
      $url4= $result_nav_menu4[1];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar cuarto campo de menu');
    }
    try
    {
      $sql_nav_menu5  = 'select name_menu, url from nav_menu where id = 5';
      $nav_menu5 = mysql_query($sql_nav_menu5);
      $result_nav_menu5 = mysql_fetch_array($nav_menu5);
      $menu5= $result_nav_menu5[0];
      $url5= $result_nav_menu5[1];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar quinto campo de menu');
    }

  ?>     
  <div id="wrap">
  
    <div id="header">
      
      <div id="publicidad_Mobile"><a href="index.php"/><img src="images/publicidad-mobile.jpg" alt="Publicidad" /></a></div>
      <div id="logo"><img src="img/Logo.jpg" alt="Emol automviles" /></div>
      <div id="publicidad"><img src="img/banner-publicidad.jpg" alt="Publicidad" /></div>
      
      <div id="nav">
        <a href="<?php echo $url1;?>"><?php echo $menu1;?></a>
        <a href="<?php echo $url2;?>"><?php echo $menu2;?></a>
        <a href="<?php echo $url3;?>"><?php echo $menu3;?></a>
        <a href="<?php echo $url4;?>"><?php echo $menu4;?></a>
        <a href="<?php echo $url5;?>"><?php echo $menu5;?></a>
      </div>
      
      <!-- Men mobile -->
      <div id="content_menu_mobile">
        <div class="btn_list_menu" onClick="$('#menu_mobile').slideToggle('middle')">
          <div class="section_current" id="on" onClick="showhide('off', 'block'); showhide('on', 'none'); return false">Desplegar men&uacute; &nbsp;&nbsp;<img src="img/flecha-down.png" /></div>
          <div class="section_current" id="off" onClick="showhide('off', 'none'); showhide('on', 'block'); return false" style="display:none;">Ocultar men&uacute;&nbsp;&nbsp;<img src="img/flecha-up.png" /></div>
        </div>
        <ul class="list_menu" id="menu_mobile">
          <li><a href="<?php echo $url1;?>"><?php echo $menu1;?></a></li>
          <li><a href="<?php echo $url2;?>"><?php echo $menu2;?></a></li>
          <li> <a href="<?php echo $url3;?>"><?php echo $menu3;?></a></li>
          <li><a href="<?php echo $url4;?>"><?php echo $menu4;?></a></li>
          <li><a href="<?php echo $url5;?>"><?php echo $menu5;?></a></li>
        </ul>
      </div>
        
    </div>
    
    <div id="busqueda_avanzada">
    
      <p class="indicador_seccion" style="padding-left:21px;"><a href="#">Inicio</a> > <a href="#">B&uacute;squeda avanzada</a></p>
        
        <div id="content_Busqueda_avanzada">
        <form>
        
          <div id="content_Form_Bavanzada" class="fl">
            <div class="content_Item_form">
              <label>Categor&iacute;a</label>
              <select data-placeholder="" class="chzn-select" tabindex="2">
                <option value=""></option> 
                <option>Todos</option>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
              </select>
            </div>
            <div class="content_Item_form">
              <label>Marca</label>
              <!--div class="content_select_mult desktop" style="border:1px solid #abaaaa;"-->
                <select data-placeholder="" multiple class="chzn-select  chzn-rtl" tabindex="10">
                  <option value=""></option>
                  <option>Todos</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
              <!--/div-->
            </div>
            <div class="content_Item_form">
              <label>Regi&oacute;n</label>
              <select data-placeholder="" class="chzn-select" tabindex="2">
                <option value=""></option>
                <option>Todas las regiones</option>
                <option>Region Metropolitana</option>
                <option>I Region</option>
                <option>II Region</option>
                <option>III Region</option>
                <option>IV Region</option>
                <option>V Region</option>
                <option>VI Region</option>
                <option>VII Region</option>
                <option>VIII Region</option>
                <option>IX Region</option>
                <option>X Region</option>
                <option>XI Region</option>
                <option>XII Region</option>
                <option>XIV Region</option>
                <option>XV Region</option>
              </select>
            </div>
            <div class="content_Item_form">
              <label>A&ntilde;o</label>
              <div class="content_inputs">
                <input name="Year" type="text" style="width:75px;" value="Ej: 1987" id="Year_1" />
                <span>a</span>
                <input name="Year" type="text" style="width:76px;" value="Ej: 2013" id="Year_2" />
              </div>
            </div>
            <div class="content_Item_form">
              <label>Kilometraje</label>
              <select data-placeholder="" class="chzn-select" tabindex="2">
                <option value=""></option>
                <option>Todos</option>
                <option>Hasta 10.000 Kms</option>
                <option>De 10.001 a 40.000 Kms</option>
                <option>De 40.001 a 80.000 Kms</option>
                <option>M&aacute;s de 80.000 Kms</option>
              </select>
            </div>
            <div class="content_Item_form">
              <label>Combustible</label>
              <select data-placeholder="" class="chzn-select" tabindex="2">
                <option value=""></option>
                <option>Todos</option>
                <option>Bencina</option>
                <option>Diesel</option>
                <option>Gas</option>
                <option>H&iacute;brido</option>
                <option>No Especificado</option>
                <option>El&eacute;ctrico</option>
              </select>
            </div>
            <div class="content_Item_form">
              <label>Fotos</label>
              <select data-placeholder="" class="chzn-select" tabindex="2">
                <option value=""></option>
                <option>Todos</option>
                <option>Con foto</option>
                <option>Sin foto</option>
              </select>
            </div>
            <div class="content_Item_form desktop">
              <div class="btn_Azul fl"><a href="#">buscar</a></div>
            </div>
            
          </div>
          
          <div id="content_Form_Bavanzada" class="fr">
          
            <div class="content_Item_form">
              <label>Tipo</label>
              <select data-placeholder="" class="chzn-select" tabindex="2">
                <option value=""></option>
                <option>Todos</option>
                <option>Nuevo</option>
                <option>Usados</option>
              </select>
            </div>
            <div class="content_Item_form">
              <label>Modelo</label>
                <select data-placeholder="" multiple class="chzn-select  chzn-rtl" tabindex="10">
                  <option value=""></option>
                  <option>Todos</option>
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                </select>
            </div>
            <div class="content_Item_form">
              <label>Precio</label>
              <div class="content_inputs">
                <input name="Year" type="text" style="width:75px;" value="Ej: 700.000" id="Price_1" />
                <span>a</span>
                <input name="Year" type="text" style="width:76px;" value="Ej: 7.000.000" id="Price_2" />
              </div>
            </div>
            <div class="content_Item_form">
              <label>Tracci&oacute;n</label>
              <select data-placeholder="" class="chzn-select" tabindex="2">
                <option value=""></option>
                <option>Todos</option>
                <option>4x2</option>
                <option>4x4</option>
                <option>No Especificado</option>
              </select>
            </div>
            <div class="content_Item_form">
              <label>Color</label>
              <select data-placeholder="" class="chzn-select" tabindex="2">
                <option value=""></option>
                <option>Todos</option>
                <option>Rojo</option>
                <option>Verde</option>
                <option>Azul</option>
                <option>Blanco</option>
                <option>Amarillo</option>
                <option>Negro</option>
                <option>Rosado</option>
                <option>Caf&eacute;</option>
                <option>Morado</option>
                <option>Celeste</option>
                <option>Plateado</option>
                <option>Burdeo</option>
                <option>Dorado</option>
                <option>Gris</option>
                <option>Beige</option>
                <option>Grafito</option>
                <option>Bronce</option>
                <option>Bicolor</option>
                <option>Champagne</option>
                <option>Naranjo</option>
                <option>No Especificado</option>
              </select>
            </div>
            <div class="content_Item_form">
              <input name="Asientos" id="corrida" type="checkbox" />
              <label for="corrida" class="checkbox" style="width:80%;">3 &oacute; (+) corridas de asiento</label>
            </div>
            
            <div class="content_Item_form mobile">
              <div class="btn_Azul fl"><a href="#">buscar</a></div>
            </div>
            
          </div>
          
          <div id="content_Form_full">
            <div class="content_Item_form">
              <label>B&uacute;squeda por texto</label>
              <input name="Year" type="text" value="Ej: diesel manual (no ponga comas)" class="fl" />
              <div class="btn_Azul fl" style="margin:0 0 0 30px;"><a href="#">buscar</a></div>
            </div>
          </div>
          
          <script src="js/select/chosen.jquery.js" type="text/javascript" charset="utf-8"></script>
          <script type="text/javascript"> $(".chzn-select").chosen(); $(".chzn-select-deselect").chosen({allow_single_deselect:true}); </script>
          
        </form>
        
        </div>
        
        <div id="content_Left_filter">
        
          <h1 class="filter_result">Otras b&uacute;squedas</h1>
          
          <div class="block_busqueda_Left" id="cont_venden">
            <div onclick="ilumina('cont_venden')">
              <span class="List_filter">VEH&Iacute;CULOS VENDEN</span>
              <i class="more" id="more_1" onClick="showhide('more_1', 'none'); showhide('less_1', 'block'), $('#venden').slideToggle('fast'); return false"></i>
              <i class="less" id="less_1" onClick="showhide('less_1', 'none'); showhide('more_1', 'block'), $('#venden').slideToggle('fast'); return false" style="display:none"></i>
            </div>
            <ul id="venden" class="List_filter_bavanzada">
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
            </ul>
          </div>
          
          <div class="block_busqueda_Left" id="cont_compran">
            <div onclick="ilumina('cont_compran')">
              <span class="List_filter">VEH&Iacute;CULOS COMPRAN</span>
              <i class="more" id="more_2" onClick="showhide('more_2', 'none'); showhide('less_2', 'block'), $('#compran').slideToggle('fast'); return false; return false"></i>
              <i class="less" id="less_2" onClick="showhide('less_2', 'none'); showhide('more_2', 'block'), $('#compran').slideToggle('fast'); return false; return false" style="display:none"></i>
            </div>
            <ul id="compran" class="List_filter_bavanzada">
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
            </ul>
          </div>
          
          <div class="block_busqueda_Left" id="servicio">
            <div onclick="ilumina('servicio')">
              <span class="List_filter">SERVICIOS</span>
              <i class="more" id="more_3" onClick="showhide('more_3', 'none'); showhide('less_3', 'block'), $('#servicios').slideToggle('fast'); return false"></i>
              <i class="less" id="less_3" onClick="showhide('less_3', 'none'); showhide('more_3', 'block'), $('#servicios').slideToggle('fast'); return false" style="display:none"></i>
            </div>
            <ul id="servicios" class="List_filter_bavanzada">
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
              <li><a href="#">Item</a></li>
            </ul>
          </div>
        
        </div>
    
    </div>
    
    <div id="footer">T&eacute;rminos y Condiciones de Los Servicios &copy; 2010 El Mercurio Online</div>
  
  </div>

</body>
</html>
