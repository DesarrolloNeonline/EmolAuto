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
  <!-- end -->
  
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
   function busqueda_nomal(marca,ciudad)
   {
		
			location.href='resultado-busqueda.php?source={"query":{"bool":{"must":[{"term":{"aviso.Comuna":"'+ciudad+'"}},{"query_string":{"query":"'+marca+'"}}]}}}';
      
   }
   </script>
   <script type="text/javascript">   
    function alpha(e) {
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
    }
    </script>
    <script>
     function busqueda_sofisticada(price,year)
    {
		var posicion_price = price.indexOf(';');
		var precio = price.substring(posicion_price+1);
		var posicion_year = year.indexOf(';');
		var año = year.substring(posicion_year+1);
		
		for(i=0;i<document.formulario_tipo.tipo.length;i++)
		{
			if(document.formulario_tipo.tipo[i].checked) 
			{
				tipo_check = document.formulario_tipo.tipo[i].value;
			}
		}
		
		/*if(document.getElementById("checkbox1").checked)		
		{
			estado_nuevo = document.getElementById("checkbox1").value;
		}
		if(document.getElementById("checkbox2").checked)		
		{
			estado_usado = document.getElementById("checkbox2").value;
		}
		if(document.getElementById("checkbox3").checked)		
		{
			estado_particular = document.getElementById("checkbox3").value;
		}
		if(document.getElementById("checkbox1").checked)
		{
			location.href="resultado-busqueda.php?q="+tipo_check+" "+precio+" "+" "+año+" "+" "+estado_nuevo;
		}
		if(document.getElementById("checkbox2").checked)
		{
			location.href="resultado-busqueda.php?q="+tipo_check+" "+precio+" "+" "+año+" "+" "+estado_usado;
		}
		if(document.getElementById("checkbox3").checked)
		{
			location.href="resultado-busqueda.php?q="+tipo_check+" "+precio+" "+año+" "+estado_particular;
		}
		if((document.getElementById("checkbox1").checked)  && (document.getElementById("checkbox3").checked))
		{
			location.href="resultado-busqueda.php?q="+tipo_check+" "+precio+" "+año+" "+estado_nuevo+" "+estado_particular; 
		}
		if((document.getElementById("checkbox2").checked) && (document.getElementById("checkbox3").checked))
		{
			location.href="resultado-busqueda.php?q="+tipo_check+" "+precio+" "+año+" "+estado_usado+" "+estado_particular; 
		}
		if((document.getElementById("checkbox1").checked) && (document.getElementById("checkbox2").checked))
		{
			location.href="resultado-busqueda.php?q="+tipo_check+" "+precio+" "+año+" "+estado_nuevo+" "+estado_usado; 
		}
		if((document.getElementById("checkbox1").checked) && (document.getElementById("checkbox2").checked) && (document.getElementById("checkbox3").checked))
		{
			location.href="resultado-busqueda.php?q="+tipo_check+" "+precio+" "+año+" "+estado_nuevo+" "+estado_usado+" "+estado_particular; 
		}
    */
    location.href='resultado-busqueda.php?source={"query":{"bool":{"must":[{"term":{"aviso.Categoria":"'+tipo_check+'"}},{"term":{"aviso.Anno":"'+año+'"}}]}},"facets":{"aviso.Marca":{"terms":{"field":"aviso.Marca"}},"aviso.Modelo":{"terms":{"field":"aviso.Modelo"}},"aviso.Categoria":{"terms":{"field":"aviso.Categoria"}},"aviso.precio":{"terms":{"field":"aviso.precio"}},"aviso.Anno":{"terms":{"field":"aviso.Anno"}},"aviso.Comuna":{"terms":{"field":"aviso.Comuna"}},"aviso.Color":{"terms":{"field":"aviso.Color"}}}}';
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

<body style="padding-top: 160px;">
<div id="publicidad_fondo"></div>
<?php
  include ('connect.php'); 
 //Consulta de Menu de navegación.
  include ('menu.php'); 
?>
  <div id="wrap">
  
    <div id="header">
      
      <div id="publicidad_Mobile_01">
        <img src="images/publicidad-mobile.jpg" alt="Emol automviles" />      </div>
      
      <div id="publicidad_Mobile_02">
        <img src="images/banner-publicidad.jpg" alt="Emol automviles" />      </div>
    
      <div id="Logo_01">
        <img src="img/Logo-transparente.png" alt="Emol automviles" />      </div>
      
      <div id="Logo_02" style="margin-left:-127px; opacity:0; filter: alpha(opacity = 0);">
        <img src="img/Logo.png" alt="Emol automviles" />      </div>
      
      <div id="btn_menu_mobile" onClick="$('#nav').slideToggle('middle')"><img src="img/btn-menu.gif" alt="MenÃº" /></div>
      
      <div id="nav">
        <a href="<?php echo $url1;?>"><?php echo $menu1;?></a>
        <a href="<?php echo $url2;?>"><?php echo $menu2;?></a>
        <a href="<?php echo $url3;?>"><?php echo $menu3;?></a>
        <a href="<?php echo $url4;?>"><?php echo $menu4;?></a>
        <a href="#" id="ocultar" style="float:right;">Ocultar publicidad</a>      </div>
      
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
            <h1 class="title_color_home">Busca tu auto</h1>
            <form action="" method="get" name="Busq_Autos">
              <div class="Block_busq">
                <label>Escribe la marca y/o modelo y/o c&oacute;digo Emol</label>
                <input name="marca-modelo-codigo" id="marca" type="text" onkeypress="return alpha(event)"/>
                <!--<p class="Busq_avanzada"><a href="#">B&uacute;squeda avanzada &raquo;</a></p>-->
        </div>
              
              <div class="Block_busq">
                <label>En qu&eacute; ciudad o comuna</label>
                <input name="ciudad" type="text" id ="ciudad" value="Santiago" onkeypress="return alpha(event)"/>
      </div>
        
              <div class="Block_busq_2">
                <input name="Buscar" type="button" value="Buscar" class="btn_Azul" onclick="busqueda_nomal($('#marca').val(),$('#ciudad').val());return false;"/>
    </div>
    
            </form>
      
          </div>
        	
          <div class="btn_Slide_busq_avanzada_home" id="busq-cat">Búsqueda por categoría</div>
        
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
                    jQuery("#Price").slider({ from: 500000, to: 90000000, step: 500000, round: 1, format: { format: '##', locale: 'de' }, dimension: '', skin: "round" });
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
          
            <div class="btn_Slide_busq_inteligente_home" id="busq-int">Búsqueda inteligente</div>
            
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
        <div class="imagen_noticia"><a href="<?php echo $url_destino;?>"><img  src="upload/destacados-home/<?php echo $url_origen;?>" alt="Ttulo noticia" class="imagen_noticia" /></a></div>
        <div class="content_info_noticia">
          <h1><?php echo $titulo;?></h1>
          <h3><?php echo $sub_titulo;?></h3>
          <p><?php echo $descripcion;?></p>
        </div>
        <div class="content_ver_mas">
          <div class="btn_Azul"><a href="<?php echo $url_destino;?>"><img src="img/btn-ver-mas.png" alt="Ver ms" /></a></div>
          <a href="<?php echo $url_destino;?>" class="txt_ver_mas">+ M&aacute;s noticias</a>
        </div>
      </div>
      
      <div class="article">
        <div class="imagen_noticia"><a href="<?php echo $url_destino2;?>"><img src="upload/destacados-home/<?php echo $url_origen2;?>" alt="Ttulo noticia" class="imagen_noticia" /></a></div>
        <div class="content_info_noticia">
         <h1><?php echo $titulo2;?></h1>
          <h3><?php echo $sub_titulo2;?></h3>
          <p><?php echo $descripcion2;?></p>
        </div>
        <div class="content_ver_mas">
          <div class="btn_Azul"><a href="<?php echo $url_destino2;?>"><img src="img/btn-ver-mas.png" alt="Ver ms" /></a></div>
          <a href="<?php echo $url_destino2;?>" class="txt_ver_mas">+ M&aacute;s noticias</a>
        </div>
      </div>
      
      <div class="article">
        <div class="imagen_noticia"><a href="<?php echo $url_destino3;?>"><img src="upload/destacados-home/<?php echo $url_origen3;?>"  alt="Ttulo noticia" class="imagen_noticia" /></a></div>
        <div class="content_info_noticia">
         <h1><?php echo $titulo3;?></h1>
          <h3><?php echo $sub_titulo3;?></h3>
          <p><?php echo $descripcion3;?></p>
        </div>
        <div class="content_ver_mas">
          <div class="btn_Azul"><a href="<?php echo $url_destino3;?>"><img src="img/btn-ver-mas.png" alt="Ver ms" /></a></div>
          <a href="<?php echo $url_destino3;?>" class="txt_ver_mas">+ M&aacute;s noticias</a>
        </div>
      </div>
    
    </div>
    
    <div id="bottom_home">
      
      <div class="content_Left_bottom_home">
        <div class="content_List_bottom_home">
          
          <h1 class="title_color_home">Modelos usados m&aacute;s publicados</h1>
          
          <hr />
          
          <ul class="List_mas_usados">
            <li class="title"><a href="#"><strong>AUTOS</strong></a></li>
            <li><a href="#">Toyota YARIS (66)</a></li>
            <li><a href="#">Chevrolet CORSA (39)</a></li>
            <li><a href="#">Subaru LEGACY (33)</a></li>
            <li><a href="#">Citroen C4 (30)</a></li>
            <li><a href="#">Hyundai ACCENT (30)</a></li>
          </ul>
          
          <ul class="List_mas_usados">
            <li class="title"><a href="#"><strong>Camionetas</strong></a></li>
            <li><a href="#">Ford RANGER (20)</a></li>
            <li><a href="#">Sangyong ACTYON (13)</a></li>
            <li><a href="#">Toyota HILUX (11)</a></li>
            <li><a href="#">Ford F-150 (10)</a></li>
            <li><a href="#">Nissan TERRANO (10)</a></li>
          </ul>
          
          <ul class="List_mas_usados">
            <li class="title"><a href="#"><strong>Todo terreno</strong></a></li>
            <li><a href="#">Hyundai TUCSON (20)</a></li>
            <li><a href="#">Hyundai SANTA FE (13)</a></li>
            <li><a href="#">Jeep COMPASS (11)</a></li>
            <li><a href="#">Suzuki GRAND NOMADE (10)</a></li>
            <li><a href="#">Suzuki GRAND VITARA (10)</a></li>
          </ul>
          
          <ul class="List_mas_usados">
            <li class="title"><a href="#"><strong>Motos</strong></a></li>
            <li><a href="#">Husaberg 450 (20)</a></li>
            <li><a href="#">BMW 650 (13)</a></li>
            <li><a href="#">KTM 990 (11)</a></li>
            <li><a href="#">Suzuki BOULEVARD (10)</a></li>
            <li><a href="#">Honda BUGGI (10)</a></li>
          </ul>
          
        </div>
        
<?php 

try 
{
	$sql_destacado  = 'select bp_sucursal from sucursales_destacados where id_destacado = 1';
  $result_destacado = mysql_query($sql_destacado);
  $array_destacado = mysql_fetch_array($result_destacado);
  $bp_sucursal_1 =  $array_destacado[0];

  $sql_sucursal  = 'select id_concesionario, id_sucursal from automoviles.sucursales where bp_sucursal ="'.$bp_sucursal_1.'"';
  $result_sucursal = mysql_query($sql_sucursal);
  $array_sucursal = mysql_fetch_array($result_sucursal);
  $bp_concesionario_1 =  $array_sucursal[0];
  $id_sucursal_1 = $array_sucursal[1];

  
  $sql_concesionario = 'select  nombre_concesionario, logo, id_concesionario_sap from automoviles.concesionario_sap 
  where bp_concesionario = "'.$bp_concesionario_1.'"';
  $result_concesionario = mysql_query($sql_concesionario);
  $array_concesionario = mysql_fetch_array($result_concesionario);
  $nombre_concesionario = $array_concesionario[0];
  $logo_1 = $array_concesionario[1];
  $id_concesionario_1 = $array_concesionario[2];


}
catch(PDOException $e) 
{
	error_log($e->getMessage());
	die('Error al seleccionar primer destacado');
}
try 
{
	$sql_destacado_2    = 'select bp_sucursal from sucursales_destacados where id_destacado = 2';
  $result_destacado_2 = mysql_query($sql_destacado_2);
  $array_destacado_2  = mysql_fetch_array($result_destacado_2);
  $bp_sucursal_2 = $array_destacado_2[0];

  $sql_sucursal_2  = 'select id_concesionario, id_sucursal from automoviles.sucursales where bp_sucursal ="'.$bp_sucursal_2.'"';
  $result_sucursal_2 = mysql_query($sql_sucursal_2);
  $array_sucursal_2 = mysql_fetch_array($result_sucursal_2);
  $bp_concesionario_2 =  $array_sucursal_2[0];
  $id_sucursal_2 = $array_sucursal_2[1];

  $sql_concesionario_2 = 'select  nombre_concesionario, logo, id_concesionario_sap from automoviles.concesionario_sap 
  where bp_concesionario = "'.$bp_concesionario_2.'"';
  $result_concesionario_2 = mysql_query($sql_concesionario_2);
  $array_concesionario_2= mysql_fetch_array($result_concesionario_2);
  $nombre_concesionario_2 = $array_concesionario_2[0];
  $logo_2 = $array_concesionario_2[1];
  $id_concesionario_2 = $array_concesionario_2[2];
}
catch(PDOException $e) 
{
	error_log($e->getMessage());
	die('Error al seleccionar segundo destacado');
}
try 
{
	$sql_destacado_3    = 'select bp_sucursal from sucursales_destacados where id_destacado = 3';
  $result_destacado_3 = mysql_query($sql_destacado_3);
  $array_destacado_3  = mysql_fetch_array($result_destacado_3);
  $bp_sucursal_3 = $array_destacado_3[0];

  $sql_sucursal_3  = 'select id_concesionario, id_sucursal from automoviles.sucursales where bp_sucursal ="'.$bp_sucursal_3.'"';
  $result_sucursal_3 = mysql_query($sql_sucursal_3);
  $array_sucursal_3 = mysql_fetch_array($result_sucursal_3);
  $bp_concesionario_3 =  $array_sucursal_3[0];
  $id_sucursal_3 = $array_sucursal_3[1];

  $sql_concesionario_3 = 'select  nombre_concesionario, logo, id_concesionario_sap from automoviles.concesionario_sap 
  where bp_concesionario = "'.$bp_concesionario_3.'"';
  $result_concesionario_3 = mysql_query($sql_concesionario_3);
  $array_concesionario_3= mysql_fetch_array($result_concesionario_3);
  $nombre_concesionario_3 = $array_concesionario_3[0];
  $logo_3= $array_concesionario_3[1];
  $id_concesionario_3 = $array_concesionario_3[2];


}
catch(PDOException $e) 
{
	error_log($e->getMessage());
	die('Error al seleccionar tercero destacado');
}
try 
{
	$sql_destacado_4    = 'select bp_sucursal from sucursales_destacados where id_destacado = 4';
  $result_destacado_4 = mysql_query($sql_destacado_4);
  $array_destacado_4  = mysql_fetch_array($result_destacado_4);
  $bp_sucursal_4 = $array_destacado_4[0];

  $sql_sucursal_4  = 'select id_concesionario, id_sucursal from automoviles.sucursales where bp_sucursal ="'.$bp_sucursal_4.'"';
  $result_sucursal_4 = mysql_query($sql_sucursal_4);
  $array_sucursal_4 = mysql_fetch_array($result_sucursal_4);
  $bp_concesionario_4 =  $array_sucursal_4[0];
  $id_sucursal_4 = $array_sucursal_4[1];


  $sql_concesionario_4 = 'select  nombre_concesionario, logo, id_concesionario_sap from automoviles.concesionario_sap 
  where bp_concesionario = "'.$bp_concesionario_4.'"';
  $result_concesionario_4 = mysql_query($sql_concesionario_4);
  $array_concesionario_4= mysql_fetch_array($result_concesionario_4);
  $nombre_concesionario_4 = $array_concesionario_4[0];
  $logo_4 = $array_concesionario_4[1];
  $id_concesionario_4 = $array_concesionario_4[2];

}
catch(PDOException $e) 
{
	error_log($e->getMessage());
	die('Error al seleccionar cuarto destacado');
}
try 
{
	$sql_destacado_5  = 'select bp_sucursal from sucursales_destacados where id_destacado = 5';
  $result_destacado_5 = mysql_query($sql_destacado_5);
  $array_destacado_5 = mysql_fetch_array($result_destacado_5);
  $bp_sucursal_5 = $array_destacado_5[0];

  $sql_sucursal_5  = 'select id_concesionario, id_sucursal from automoviles.sucursales where bp_sucursal ="'.$bp_sucursal_5.'"';
  $result_sucursal_5 = mysql_query($sql_sucursal_5);
  $array_sucursal_5 = mysql_fetch_array($result_sucursal_5);
  $bp_concesionario_5 =  $array_sucursal_5[0];
  $id_sucursal_5 = $array_sucursal_5[1];

  $sql_concesionario_5 = 'select  nombre_concesionario, logo, id_concesionario_sap from automoviles.concesionario_sap 
  where bp_concesionario = "'.$bp_concesionario_5.'"';
  $result_concesionario_5 = mysql_query($sql_concesionario_5);
  $array_concesionario_5= mysql_fetch_array($result_concesionario_5);
  $nombre_concesionario_5 = $array_concesionario_5[0];
  $logo_5 = $array_concesionario_5[1];
  $id_concesionario_5 = $array_concesionario_5[2];

}
catch(PDOException $e) 
{
	error_log($e->getMessage());
	die('Error al seleccionar quinto destacado');
}
try 
{
  $sql_destacado_6  = 'select bp_sucursal from sucursales_destacados where id_destacado = 6';
  $result_destacado_6 = mysql_query($sql_destacado_6);
  $array_destacado_6 = mysql_fetch_array($result_destacado_6);
  $bp_sucursal_6 = $array_destacado_6[0];

  $sql_sucursal_6  = 'select id_concesionario, id_sucursal from automoviles.sucursales where bp_sucursal ="'.$bp_sucursal_6.'"';
  $result_sucursal_6 = mysql_query($sql_sucursal_6);
  $array_sucursal_6 = mysql_fetch_array($result_sucursal_6);
  $bp_concesionario_6 =  $array_sucursal_6[0];
  $id_sucursal_6 = $array_sucursal_6[1];

  $sql_concesionario_6 = 'select  nombre_concesionario, logo, id_concesionario_sap from automoviles.concesionario_sap 
  where bp_concesionario = "'.$bp_concesionario_6.'"';
  $result_concesionario_6 = mysql_query($sql_concesionario_6);
  $array_concesionario_6= mysql_fetch_array($result_concesionario_6);
  $nombre_concesionario_6 = $array_concesionario_6[0];
  $logo_6 = $array_concesionario_6[1];
  $id_concesionario_6 = $array_concesionario_6[2];

}
catch(PDOException $e) 
{
  error_log($e->getMessage());
  die('Error al seleccionar quinto destacado');
}
?>
        
        <div class="content_List_concesionarios_home">  
          <h1 class="title_color_home">Sucuarsales destacadas</h1>
          
          <ul class="List_concesionarias">
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_1;?>&id_sucursal=<?php echo $id_sucursal_1;?>"><img src="http://club.mersap.com/emol_automovil/upload/concesionarios/<?php echo $logo_1;?>" style="width: 86px;height: 23px;" /></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_2;?>&id_sucursal=<?php echo $id_sucursal_2;?>"><img src="http://club.mersap.com/emol_automovil/upload/concesionarios/<?php echo $logo_2;?>" style="width: 86px;height: 23px;"/></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_3;?>&id_sucursal=<?php echo $id_sucursal_3;?>"><img src="http://club.mersap.com/emol_automovil/upload/concesionarios/<?php echo $logo_3;?>" style="width: 86px;height: 23px;"/></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_4;?>&id_sucursal=<?php echo $id_sucursal_4;?>>"><img src="http://club.mersap.com/emol_automovil/upload/concesionarios/<?php echo $logo_4;?>" style="width: 86px;height: 23px;"/></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_5;?>&id_sucursal=<?php echo $id_sucursal_5;?>"><img src="http://club.mersap.com/emol_automovil/upload/concesionarios/<?php echo $logo_5;?>" style="width: 86px;height: 23px;"/></a></li>
            <li><a href="despliegue-concesionarios.php?id_concesionario=<?php echo $id_concesionario_6;?>&id_sucursal=<?php echo $id_sucursal_6;?>"><img src="http://club.mersap.com/emol_automovil/upload/concesionarios/<?php echo $logo_6;?>" style="width: 86px;height: 23px;"/></a></li>
          </ul>
          
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
