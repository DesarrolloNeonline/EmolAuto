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
  <!-- Slider Price -->
  <link rel="stylesheet" href="css/jslider.css" type="text/css">
  <script type="text/javascript" src="js/slider-price/jshashtable-2.1_src.js"></script>
  <script type="text/javascript" src="js/slider-price/jquery.numberformatter-1.2.3.js"></script>
  <script type="text/javascript" src="js/slider-price/tmpl.js"></script>
  <script type="text/javascript" src="js/slider-price/jquery.dependClass-0.1.js"></script>
  <script type="text/javascript" src="js/slider-price/draggable-0.1.js"></script>
  <script type="text/javascript" src="js/slider-price/jquery.slider.js"></script>
  <!--end!-->
  <!--Setup Publicidades Addserver!-->
  <script type="text/javascript"src="http://banners.emol.com/tags/automoviles/setup_portada.js"></script>
  <!-- end -->
  <script type="text/javascript">
    $(function() {
      $(".select-category a").click( function( )
      {
      var current = $(this);
      var name = current.attr('href');
      $('a.selected').removeClass('selected');
      current.addClass("selected");
    
        return false;
      });
    });
  </script>
  <script>
    function strtolower (str) {
      return (str + '').toLowerCase();
    }
  </script>
  <script>
    function ucwords (str) {
      return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function ($1) {
      return $1.toUpperCase();
      });
    }
  </script>
  <script>
    function busqueda_nomal(marca,ciudad)
    {
      if((marca == '')&&(ciudad =='')){

          location.href='resultado-busqueda.php?source={"query": {"custom_score": {"query": {"match_all": {}},"script": "_score+doc[\'score\'].value"}},"facets": {"aviso.Marca": {"terms": {"field": "aviso.Marca"}},"aviso.Modelo": {"terms": {"field": "aviso.Modelo"}},"aviso.Categoria": {"terms": {"field": "aviso.Categoria"}},"aviso.precio": {"terms": {"field": "aviso.precio"}},"aviso.Anno": {"terms": {"field": "aviso.Anno"}},"aviso.Comuna": {"terms": {"field": "aviso.Comuna"}},"aviso.Color": {"terms": {"field": "aviso.Color"}}}}&busqueda=inteligente&priceUp=90000000&priceDown=0&typeSearch=inteligente&marca='+marca+'&ciudad='+ciudad;
      }
        else
            if((marca === '')&&(ciudad!='')){

                ciudad = strtolower(ciudad);
                ciudad = ucwords(ciudad);

                if(ciudad ==='Santiago'){

                  ciudad = '';
                  location.href='resultado-busqueda.php?source={"query": {"custom_score": {"query": {"match_all": {}},"script": "_score+doc[\'score\'].value"}},"facets": {"aviso.Marca": {"terms": {"field": "aviso.Marca"}},"aviso.Modelo": {"terms": {"field": "aviso.Modelo"}},"aviso.Categoria": {"terms": {"field": "aviso.Categoria"}},"aviso.precio": {"terms": {"field": "aviso.precio"}},"aviso.Anno": {"terms": {"field": "aviso.Anno"}},"aviso.Comuna": {"terms": {"field": "aviso.Comuna"}},"aviso.Color": {"terms": {"field": "aviso.Color"}}}}&busqueda=inteligente&priceUp=90000000&priceDown=0&typeSearch=inteligente&marca='+marca+'&ciudad='+ciudad;

                }
                  else{
                        location.href='resultado-busqueda.php?source={"query":{"bool":{"must":[{"term":{"aviso.Comuna":"'+ciudad+'"}},{"query_string":{"query":"'+marca+'"}}]}}}&busqueda=inteligente&priceUp=90000000&priceDown=0&typeSearch=inteligente';
                  }
                
            } else if((marca != '')&&(ciudad=='')) {

                     marca = strtolower(marca);
                     marca = ucwords(marca);

                     
                     location.href='resultado-busqueda.php?source={"query":{"bool":{"must":[{"query_string":{"query":"'+marca+'"}}]}}}&busqueda=inteligente&priceUp=90000000&priceDown=0&typeSearch=inteligente';
                    }  else if((marca !='')&&(ciudad !='')){

                                  ciudad = strtolower(ciudad);
                                  ciudad = ucwords(ciudad);

                                  marca = strtolower(marca);
                                  marca = ucwords(marca);

                                   location.href='resultado-busqueda.php?source={"query":{"bool":{"must":[{"term":{"aviso.Comuna":"'+ciudad+'"}},{"query_string":{"query":"'+marca+'"}}]}}}&busqueda=inteligente&priceUp=90000000&priceDown=0&typeSearch=inteligente';

                             }
   }
  </script>
  <script type="text/javascript">   
    function alpha(e) {
    var k;
    document.all ? k = e.keyCode : k = e.which;
   
      if (e.keyCode == 13) {   
       busqueda_nomal($('#marca').val(),$('#ciudad').val());return false; 
     }else{  
           return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || k==241 || k==209 || (k >= 48 && k <= 57));
      }
    }

  </script>
  <script>
    function busqueda_sofisticada(price,year)
    {
      var posicion_price = price.indexOf(';');
      var priceUp = price.substring(posicion_price+1);
      var priceDown = price.replace(priceUp ,'');
      priceDown = priceDown.replace(';','');

      var posicion_year = year.indexOf(';');
      var anno = year.substring(posicion_year+1);
    
      for(i=0;i<document.formulario_tipo.tipo.length;i++)
      {
        if(document.formulario_tipo.tipo[i].checked) 
        {
          tipo_check = document.formulario_tipo.tipo[i].value;
        }
      }
      location.href='resultado-busqueda.php?source={"query":{"bool":{"must":[{"term":{"aviso.Categoria":"'+tipo_check+'"}}]}},"facets":{"aviso.Marca":{"terms":{"field":"aviso.Marca"}},"aviso.Modelo":{"terms":{"field":"aviso.Modelo"}},"aviso.Categoria":{"terms":{"field":"aviso.Categoria"}},"aviso.precio":{"terms":{"field":"aviso.precio"}},"aviso.Anno":{"terms":{"field":"aviso.Anno"}},"aviso.Comuna":{"terms":{"field":"aviso.Comuna"}},"aviso.Color":{"terms":{"field":"aviso.Color"}}}}&busqueda=categoria&anno='+anno+'&type='+tipo_check+'&priceUp='+priceUp+'&priceDown='+priceDown+'&typeSearch=categoria';
   }
   </script>
  <!-- Tooltip -->
  <link rel="stylesheet" href="css/tipTip.css" type="text/css">
  <script type="text/javascript" src="js/jquery.tipTip.js"></script>
  <script type="text/javascript" src="js/jquery.tipTip.minified.js"></script>
  <script type="text/javascript">
    $(function(){
      $(".someClass").tipTip();
    });
  </script>
  
  <script type="text/javascript">
  function showhide(divid, state){
    document.getElementById(divid).style.display=state
  }
  </script>
  
</head>

<body>
<script type="text/javascript" src=" http://banners.emol.com/tags/automoviles/flotante_itt.js"></script>
<!--body style="padding-top: 160px;">
<div id="publicidad_fondo"></div>-->
<?php
  include ('connect.php'); 
 //Consulta de Menu de navegación.
  include ('menu.php'); 
?>
  <div id="wrap">
  
    <div id="header">
      <div id="Content_pub_expand"><script type="text/javascript" src="http://banners.emol.com/tags/automoviles/flotante_push.js"></script></div>
      
      <!--div id="publicidad_Mobile_01">
        <img src="images/publicidad-mobile.jpg" alt="Emol automviles" />      </div>
      
      <div id="publicidad_Mobile_02">
         <img src="images/banner-publicidad.jpg" alt="Emol automviles" />      </div>
    
      <!--div id="Logo_01">
        <img src="img/Logo-transparente.png" alt="Emol automviles" />      </div>
      
      <div id="Logo_02" style="margin-left:-127px; opacity:0; filter: alpha(opacity = 0);">
        <img src="img/Logo.png" alt="Emol automviles" />      </div-->
        
      <div id="Logo_02">
        <img src="img/Logo.png" alt="Emol automviles" />      </div>
        
      <div class="content_publicidad_728">
        <script type="text/javascript" src="http://banners.emol.com/tags/automoviles/horizontal_01.js"></script> 
      </div>
      
      <div id="btn_menu_mobile" onClick="$('#nav').slideToggle('middle')"><img src="img/btn-menu.gif" alt="Men&uacute;" /></div>
      
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
      <!-- <a href="#" id="ocultar" style="float:right;">Ocultar publicidad</a> -->     
      </div>
      
      <script type="text/javascript">
        $("#ocultar").click(function(){
          $("body").animate({"padding-top": "0"}, "middle");
          $("#publicidad_fondo").animate({"opacity": "0"}, "middle");
          $("#Logo_01").animate({"opacity": "0"}, "middle");
          $("#Logo_02").animate({"opacity": "1"}, "middle");
          $("#ocultar").animate({"opacity": "0"}, "middle");
        });
      </script>
    </div>
          
    <div id="buscador_home">
      
      <div id="content_Pant_busq">
        
        <div class="content_Busq_home">
          
          <div class="content_Busq_auto">
            <h1 class="title_color_home">B&uacute;squeda libre</h1>
            <form action="" method="get" name="Busq_Autos">
              <div class="Block_busq">
                <label>Escribe la marca y/o modelo y/o c&oacute;digo Emol</label>
                <input name="marca-modelo-codigo" id="marca" type="text" onkeypress="return alpha(event)"/>
                <!--<p class="Busq_avanzada"><a href="#">B&uacute;squeda avanzada &raquo;</a></p>-->
        </div>
              
              <div class="Block_busq">
                <label>En qu&eacute; ciudad</label>
                <input name="ciudad" type="text" id ="ciudad" value="Santiago" onkeypress="return alpha(event)"/>
      </div>
        
              <div class="Block_busq_2">
                <input name="Buscar" type="button" value="Buscar" class="btn_Azul" onclick="busqueda_nomal($('#marca').val(),$('#ciudad').val());return false;"/>
    </div>
    
            </form>
      
          </div>
          
          <div class="btn_Slide_busq_avanzada_home" id="busq-cat">Ir a B&uacute;squeda por categor&iacute;a</div>
        
        </div>
      
        <div class="content_Busq_home" id="Busq_categoria">
          <div class="content_Busq_auto">
      
            <h1 class="title_color_home">B&uacute;squeda por categor&iacute;a</h1>
            
            <form action="" method="get" name="formulario_tipo">
            
              <div class="Block_busq_cat">
              
        <div class="select-category">
            <input type="radio" id="autos" name="tipo" value="Autos" checked>
            <label for="autos"><img src="img/autos.png" alt="Autos" /></label>
            <input type="radio" id="todo-terreno" name="tipo" value="Todo Terreno">
            <label for="todo-terreno"><img src="img/todo-terreno.png" alt="Todo Terreno" /></label>
            <input type="radio" id="camionetas" name="tipo" value="Camioneta">
            <label for="camionetas"><img src="img/camionetas.png" alt="Camionetas" /></label>
            <input type="radio" id="furgon" name="tipo" value="Furg&oacute;n">
            <label for="furgon"><img src="img/furgones.png" alt="Furgones" /></label>
            <input type="radio" id="camiones" name="tipo" value="Camiones">
            <label for="camiones"><img src="img/camiones.png" alt="Camiones" /></label>
            <input type="radio" id="motos" name="tipo" value="Motos">
            <label for="motos" style="margin-right:0px;"><img src="img/motos.png" alt="Motos" /></label>
        </div>
                
                <hr />
                
                <div class="content_Slider_buscador">
                  <p class="txt_buscador">Precio desde</p>
                  <input id="Price" type="slider" name="price" value="500000;25000000" />
                  <script type="text/javascript" charset="utf-8">
                    jQuery("#Price").slider({ from: 500000, to: 90000000, step: 50000, dimension: '$&nbsp;' });
					<!--jQuery("#Price").slider({ from: 500000, to: 90000000, heterogeneity: ['50/50000'], step: 500000, round: 1, format: { format: '##', locale: 'de' }, dimension: '$ ', skin: "round" });-->
                </script>
                </div>
        
                <div class="content_Slider_buscador_2">
                  <p class="txt_buscador">A&ntilde;o desde</p>
                  <input id="Year" type="slider" name="ao" value="2000"  style="margin-left: 30px;"/>
                  <script type="text/javascript" charset="utf-8">
                    jQuery("#Year").slider({ from: 1960, to: 2013, step: 1, round: 1, format: { format: '##', locale: 'de' }, dimension: '', skin: "round" });
                  </script>
                </div>
              
              </form>
     
                <!--<p class="Busq_avanzada"><a href="#">B&uacute;squeda avanzada &raquo;</a></p>-->
              
              </div>
      
              <div class="Block_busq_2">                
                <input name="Buscar" type="button" value="Buscar" class="btn_Azul" onclick="busqueda_sofisticada($('#Price').val(),$('#Year').val());return false;" style="margin: 87px 0 0 1px;
" />
               </div>

            </form>
          
            <div class="btn_Slide_busq_inteligente_home" id="busq-int">Ir a B&uacute;squeda libre</div>
            
          </div>
        </div>
      
      </div>
      
      <script type="text/javascript">
        $("#busq-cat").click(function(){
          $("#content_Pant_busq").animate({"top": "-212px"}, "middle");
        });
        $("#busq-int").click(function(){
          $("#content_Pant_busq").animate({"top": "0px"}, "middle");
        });
      </script>
      
    </div>
<?php
  // Consulta de Destacados Home.
  try 
    {
      $sql_destacado1  = 'select nombre_img, url_destino, titulo, sub_titulo, descripcion from automoviles.destacados_home where id_destacado = 0';
      $destacado1 = mysql_query($sql_destacado1);
      $result_destacado1 = mysql_fetch_array($destacado1);
      $url_origen= $result_destacado1[0];
      $url_destino= $result_destacado1[1];
      $titulo= $result_destacado1[2];
      $sub_titulo= $result_destacado1[3];
      $descripcion= $result_destacado1[4];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar primer Destacado');
    }
    try 
    {
      $sql_destacado2  = 'select nombre_img, url_destino, titulo, sub_titulo, descripcion from automoviles.destacados_home where id_destacado = 1';
      $destacado2 = mysql_query($sql_destacado2);
      $result_destacado2 = mysql_fetch_array($destacado2);
      $url_origen2= $result_destacado2[0];
      $url_destino2= $result_destacado2[1];
      $titulo2= $result_destacado2[2];
      $sub_titulo2= $result_destacado2[3];
      $descripcion2= $result_destacado2[4];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar segundo Destacado');
    }
    try
    {
      $sql_destacado3  = 'select nombre_img, url_destino, titulo, sub_titulo, descripcion from automoviles.destacados_home where id_destacado = 2';
      $destacado3 = mysql_query($sql_destacado3);
      $result_destacado3 = mysql_fetch_array($destacado3);
      $url_origen3= $result_destacado3[0];
      $url_destino3= $result_destacado3[1];
      $titulo3= $result_destacado3[2];
      $sub_titulo3= $result_destacado3[3];
      $descripcion3= $result_destacado3[4];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar tercer Destacado');
    }
?>    
    <div id="noticias_home">
    
      <div class="article">
        <div class="imagen_noticia"><a href="<?php echo $url_destino;?>"><img  src="upload/destacados-home/<?php echo $url_origen;?>" alt="Ttulo noticia" /></a></div>
        <div class="content_info_noticia">
          <h1><?php echo $titulo;?></h1>
          <h3><?php echo $sub_titulo;?></h3>
          <p><?php echo $descripcion;?></p>
        </div>
        <div class="content_ver_mas">
          <div class="btn_Azul"><a href="<?php echo $url_destino;?>"><img src="img/btn-ver-mas.png" alt="Ver ms" /></a></div>
          <a href="listado-noticias.php" class="txt_ver_mas">+ M&aacute;s noticias</a>
        </div>
      </div>
      
      <div class="article">
        <div class="imagen_noticia"><a href="<?php echo $url_destino2;?>"><img src="upload/destacados-home/<?php echo $url_origen2;?>" alt="Ttulo noticia" /></a></div>
        <div class="content_info_noticia">
         <h1><?php echo $titulo2;?></h1>
          <h3><?php echo $sub_titulo2;?></h3>
          <p><?php echo $descripcion2;?></p>
        </div>
        <div class="content_ver_mas">
          <div class="btn_Azul"><a href="<?php echo $url_destino2;?>"><img src="img/btn-ver-mas.png" alt="Ver ms" /></a></div>
          <a href="listado-noticias.php" class="txt_ver_mas">+ M&aacute;s noticias</a>
        </div>
      </div>
      
      <div class="article">
        <div class="imagen_noticia"><a href="<?php echo $url_destino3;?>"><img src="upload/destacados-home/<?php echo $url_origen3;?>"  alt="Ttulo noticia" /></a></div>
        <div class="content_info_noticia">
         <h1><?php echo $titulo3;?></h1>
          <h3><?php echo $sub_titulo3;?></h3>
          <p><?php echo $descripcion3;?></p>
        </div>
        <div class="content_ver_mas">
          <div class="btn_Azul"><a href="<?php echo $url_destino3;?>"><img src="img/btn-ver-mas.png" alt="Ver ms" /></a></div>
          <a href="listado-noticias.php" class="txt_ver_mas">+ M&aacute;s noticias</a>
        </div>
      </div>
    
    </div>
    
    <div id="bottom_home">
      
      <div class="content_Left_bottom_home">
        <div class="content_List_bottom_home">
          <h1 class="title_color_home">Modelos usados m&aacute;s publicados</h1>
          <hr />
          <!-- ucwords -> Funcion PHP transforma primera letra en mayscual del string !-->
          <ul class="List_mas_usados">
            <li class="title"><strong>Autos</strong></li>
           <?php 
              $url_autos = $indice_mmp.'1';
              $content_autos = file_get_contents($url_autos);
              $json_autos = json_decode($content_autos, true);
              $hits_autos = $json_autos["_source"]["mmp"];
             

              foreach($hits_autos['lista'] as $item) 
              {
                $marca          = ucwords($item['marca']);
                $modelo         = ucwords($item['modelo']);
                $count          = $item['count']; ?>

              <a href='resultado-busqueda.php?source={"query":{"bool":{"must":[{"term":{"aviso.Categoria":"Autos"}},{"term":{"aviso.Marca":"<?php echo $marca;?>"}},{"term":{"aviso.Modelo":"<?php echo $modelo;?>"}},{"query_string":{"query":""}}]}}}'><li><?php echo ucwords(strtolower($marca)).' '.ucwords(strtolower($modelo)).' ('.$count.')';?></li></a>
              
              
           <?php
              }
          ?>
          </ul>


          <ul class="List_mas_usados">
            <li class="title"><strong>Camionetas</strong></li>
           <?php 
              $url_camionetas = $indice_mmp.'4';
              $content_camionetas = file_get_contents($url_camionetas);
              $json_camionetas = json_decode($content_camionetas, true);
              $hits_camionetas = $json_camionetas["_source"]["mmp"];
             

              foreach($hits_camionetas['lista'] as $item) 
              {
                $marca          = $item['marca'];
                $modelo         = $item['modelo'];
                $count          = $item['count']; ?>

              <a href='resultado-busqueda.php?source={"query":{"bool":{"must":[{"term":{"aviso.Categoria":"Camioneta"}},{"term":{"aviso.Marca":"<?php echo $marca;?>"}},{"term":{"aviso.Modelo":"<?php echo $modelo;?>"}},{"query_string":{"query":""}}]}}}'><li><?php echo ucwords(strtolower($marca)).' '.ucwords(strtolower($modelo)).' ('.$count.')';?></li></a>
              
              
           <?php
              }
          ?>
          </ul>

          <ul class="List_mas_usados">
            <li class="title"><strong>Todo Terreno</strong></li>
           <?php 
              $url_terreno = $indice_mmp.'2';
              $content_terreno = file_get_contents($url_terreno);
              $json_terreno = json_decode($content_terreno, true);
              $hits_terreno = $json_terreno["_source"]["mmp"];
             

              foreach($hits_terreno['lista'] as $item) 
              {
                $marca          = $item['marca'];
                $modelo         = $item['modelo'];
                $count          = $item['count']; ?>

              <a href='resultado-busqueda.php?source={"query":{"bool":{"must":[{"term":{"aviso.Categoria":"Todo Terreno"}},{"term":{"aviso.Marca":"<?php echo $marca;?>"}},{"term":{"aviso.Modelo":"<?php echo $modelo;?>"}},{"query_string":{"query":""}}]}}}'><li><?php echo ucwords(strtolower($marca)).' '.ucwords(strtolower($modelo)).' ('.$count.')';?></li></a>
              
              
           <?php
              }
          ?>
          </ul> 

          <ul class="List_mas_usados">
            <li class="title"><strong>Motos</strong></li>
           <?php 
              $url_motos = $indice_mmp.'6';
              $content_motos = file_get_contents($url_motos);
              $json_motos = json_decode($content_motos, true);
              $hits_motos = $json_motos["_source"]["mmp"];
             

              foreach($hits_motos['lista'] as $item) 
              {
                $marca          = $item['marca'];
                $modelo         = $item['modelo'];
                $count          = $item['count']; ?>

              <a href='resultado-busqueda.php?source={"query":{"bool":{"must":[{"term":{"aviso.Categoria":"Motos"}},{"term":{"aviso.Marca":"<?php echo $marca;?>"}},{"term":{"aviso.Modelo":"<?php echo $modelo;?>"}},{"query_string":{"query":""}}]}}}'><li><?php echo ucwords(strtolower($marca)).' '.ucwords(strtolower($modelo)).' ('.$count.')';?></li></a>
              
              
           <?php
              }
          ?>
          </ul>  
        </div>
        
<?php 

try 
    {
      $sql_destacado_1  = 'select bp_concesionario from concesionarios_destacados where id_destacado = 1';
      $result_destacado_1 = mysql_query($sql_destacado_1);
      $array_destacado_1 = mysql_fetch_array($result_destacado_1);
      $bp_concesionario_1 =  $array_destacado_1[0];

      $sql_concesionario_1  = 'select nombre_fantasia, logo_chico, id_concesionario from automoviles.concesionario where bp_concesionario ="'.$bp_concesionario_1.'"';
      $result_concesionario_1 = mysql_query($sql_concesionario_1);
      $array_concesionario_1 = mysql_fetch_array($result_concesionario_1);
      $nombre_concesionario_1 = $array_concesionario_1[0];
      $logo_1                = $array_concesionario_1[1];
      $id_concesionario_1    = $array_concesionario_1[2];

    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar primer destacado');
    }
    try 
    {
      $sql_destacado_2  = 'select bp_concesionario from concesionarios_destacados where id_destacado = 2';
      $result_destacado_2 = mysql_query($sql_destacado_2);
      $array_destacado_2 = mysql_fetch_array($result_destacado_2);
      $bp_concesionario_2 =  $array_destacado_2[0];

      $sql_concesionario_2  = 'select nombre_fantasia, logo_chico, id_concesionario from automoviles.concesionario where bp_concesionario ="'.$bp_concesionario_2.'"';
      $result_concesionario_2 = mysql_query($sql_concesionario_2);
      $array_concesionario_2 = mysql_fetch_array($result_concesionario_2);
      $nombre_concesionario_2 = $array_concesionario_2[0];
      $logo_2         = $array_concesionario_2[1];
      $id_concesionario_2       = $array_concesionario_2[2];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar segundo destacado 2');
    }
    try
    {
      $sql_destacado_3  = 'select bp_concesionario from concesionarios_destacados where id_destacado = 3';
      $result_destacado_3 = mysql_query($sql_destacado_3);
      $array_destacado_3 = mysql_fetch_array($result_destacado_3);
      $bp_concesionario_3 =  $array_destacado_3[0];

      $sql_concesionario_3  = 'select nombre_fantasia, logo_chico, id_concesionario from automoviles.concesionario where bp_concesionario ="'.$bp_concesionario_3.'"';
      $result_concesionario_3 = mysql_query($sql_concesionario_3);
      $array_concesionario_3 = mysql_fetch_array($result_concesionario_3);
      $nombre_concesionario_3 = $array_concesionario_3[0];
      $logo_3       = $array_concesionario_3[1];
      $id_concesionario_3       = $array_concesionario_3[2];
    
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar tercer destacado 3');
    }
    try
    {
      $sql_destacado_4  = 'select bp_concesionario from concesionarios_destacados where id_destacado = 4';
      $result_destacado_4 = mysql_query($sql_destacado_4);
      $array_destacado_4 = mysql_fetch_array($result_destacado_4);
      $bp_concesionario_4 =  $array_destacado_4[0];

      $sql_concesionario_4  = 'select nombre_fantasia, logo_chico, id_concesionario from automoviles.concesionario where bp_concesionario ="'.$bp_concesionario_4.'"';
      $result_concesionario_4 = mysql_query($sql_concesionario_4);
      $array_concesionario_4 = mysql_fetch_array($result_concesionario_4);
      $nombre_concesionario_4 = $array_concesionario_4[0];
      $logo_4       = $array_concesionario_4[1];
      $id_concesionario_4       = $array_concesionario_4[2];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar cuarto destacado 4');
    }
    try
    {
      $sql_destacado_5  = 'select bp_concesionario from concesionarios_destacados where id_destacado = 5';
      $result_destacado_5 = mysql_query($sql_destacado_5);
      $array_destacado_5 = mysql_fetch_array($result_destacado_5);
      $bp_concesionario_5 =  $array_destacado_5[0];

      $sql_concesionario_5  = 'select nombre_fantasia, logo_chico, id_concesionario from automoviles.concesionario where bp_concesionario ="'.$bp_concesionario_5.'"';
      $result_concesionario_5 = mysql_query($sql_concesionario_5);
      $array_concesionario_5 = mysql_fetch_array($result_concesionario_5);
      $nombre_concesionario_5 = $array_concesionario_5[0];
      $logo_5       = $array_concesionario_5[1];
      $id_concesionario_5       = $array_concesionario_5[2];

    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar quinto destacado');
    }
    try
    {
      $sql_destacado_6  = 'select bp_concesionario from concesionarios_destacados where id_destacado = 6';
      $result_destacado_6 = mysql_query($sql_destacado_6);
      $array_destacado_6 = mysql_fetch_array($result_destacado_6);
      $bp_concesionario_6 =  $array_destacado_6[0];

      $sql_concesionario_6  = 'select nombre_fantasia, logo_chico, id_concesionario from automoviles.concesionario where bp_concesionario ="'.$bp_concesionario_6.'"';
      $result_concesionario_6 = mysql_query($sql_concesionario_6);
      $array_concesionario_6 = mysql_fetch_array($result_concesionario_6);
      $nombre_concesionario_6 = $array_concesionario_6[0];
      $logo_6       = $array_concesionario_6[1];
      $id_concesionario_6       = $array_concesionario_6[2];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar sexto destacado');
    }
    try
    {
      $sql_destacado_7  = 'select bp_concesionario from concesionarios_destacados where id_destacado = 7';
      $result_destacado_7 = mysql_query($sql_destacado_7);
      $array_destacado_7 = mysql_fetch_array($result_destacado_7);
      $bp_concesionario_7 =  $array_destacado_7[0];

      $sql_concesionario_7  = 'select nombre_fantasia, logo_chico, id_concesionario from automoviles.concesionario where bp_concesionario ="'.$bp_concesionario_7.'"';
      $result_concesionario_7 = mysql_query($sql_concesionario_7);
      $array_concesionario_7 = mysql_fetch_array($result_concesionario_7);
      $nombre_concesionario_7 = $array_concesionario_7[0];
      $logo_7       = $array_concesionario_7[1];
      $id_concesionario_7       = $array_concesionario_7[2];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar septimo destacado');
    }
    try
    {
      $sql_destacado_8  = 'select bp_concesionario from concesionarios_destacados where id_destacado = 8';
      $result_destacado_8 = mysql_query($sql_destacado_8);
      $array_destacado_8 = mysql_fetch_array($result_destacado_8);
      $bp_concesionario_8 =  $array_destacado_8[0];

      $sql_concesionario_8  = 'select nombre_fantasia, logo_chico, id_concesionario from automoviles.concesionario where bp_concesionario ="'.$bp_concesionario_8.'"';
      $result_concesionario_8 = mysql_query($sql_concesionario_8);
      $array_concesionario_8 = mysql_fetch_array($result_concesionario_8);
      $nombre_concesionario_8 = $array_concesionario_8[0];
      $logo_8       = $array_concesionario_8[1];
      $id_concesionario_8       = $array_concesionario_8[2];
    }
    catch(PDOException $e) 
    {
      error_log($e->getMessage());
      die('Error al seleccionar octavo destacado');
    }
?>
        
        <div class="content_List_concesionarios_home">  
          <h1 class="title_color_home">Concesionarios destacados</h1>
          
          <ul class="List_concesionarias">
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_1;?>"><img src="<?php echo $folder_frontend;?>/upload/concesionarios/<?php echo $logo_1;?>" style="width: 86px;height: 23px;" /></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_2;?>"><img src="<?php echo $folder_frontend;?>/upload/concesionarios/<?php echo $logo_2;?>" style="width: 86px;height: 23px;"/></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_3;?>"><img src="<?php echo $folder_frontend;?>/upload/concesionarios/<?php echo $logo_3;?>" style="width: 86px;height: 23px;"/></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_4;?>"><img src="<?php echo $folder_frontend;?>/upload/concesionarios/<?php echo $logo_4;?>" style="width: 86px;height: 23px;"/></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_5;?>"><img src="<?php echo $folder_frontend;?>/upload/concesionarios/<?php echo $logo_5;?>" style="width: 86px;height: 23px;"/></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_6;?>"><img src="<?php echo $folder_frontend;?>/upload/concesionarios/<?php echo $logo_6;?>" style="width: 86px;height: 23px;"/></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_7;?>"><img src="<?php echo $folder_frontend;?>/upload/concesionarios/<?php echo $logo_7;?>" style="width: 86px;height: 23px;"/></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_8;?>"><img src="<?php echo $folder_frontend;?>/upload/concesionarios/<?php echo $logo_8;?>" style="width: 86px;height: 23px;"/></a></li>
		  </ul>
          
        </div>
      </div>
      
      <div class="publicidad_300_home">
        <script type="text/javascript"src="http://banners.emol.com/tags/automoviles/robpg_01.js"></script>
        <!--<img src="images/publicidad_2.jpg" alt="Publicidad" />!-->
      </div>
         
    </div>
    
    <div id="footer">T&eacute;rminos y Condiciones de los Servicios &copy; 2013 El Mercurio Online</div>
  
  </div>
<?php 
  mysql_close($conn);   
?>
</body>
</html>
