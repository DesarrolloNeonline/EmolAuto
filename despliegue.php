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
  <script src="http://apps.emol.com/widgets/mapas/v3/xygo.min.js"></script>
  
  <link rel="stylesheet" href="css/refineslide.css" />
  <script src="js/jquery.refineslide.min.js"></script>
 <script type="text/javascript">
    $(document).ready(function () {
        $('.rs-slider').refineSlide({
            transition         : 'slideH',
            transitionDuration : 1000,
            autoPlay           : false,
            keyNav             : true,
            delay              : 0,
            controls           : 'thumbs',
			thumbMargin        : 3,
			arrowTemplate      : '<div class="rs-arrows"><a href="#" class="rs-prev"></a><a href="#" class="rs-next"></a></div>'
        });
    });
  </script>
  <script>
		function procesar()
		{
			var id_concesionario = "#";
			location.href="despliegue-concesionarios.php?id_concesionario=31";
		}
  
  </script>
  <script>
  function getUrlVars() 
  {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
  }
  </script> 
  <!--Parseando json por jquery!-->
  <!--<script type="text/javascript" > 
	var first = getUrlVars()["id"];
	$.getJSON("http://ailab01.mersap.com/autos/aviso/"+first,function(data){ 
		for(titulo in data._source)
		{  
			$("#aviso_ficha").append("<b>"+data._source[titulo].texto+"</b>");
			$("#anno").append("<b>"+data._source[titulo].Anno+"</b>"); 
			$("#kilometros").append("<b>"+data._source[titulo].Kilometraje+"</b>"); 
			$("#color").append("<b>"+data._source[titulo].Color+"</b>"); 
            $("#traccion").append("<b>"+data._source[titulo].Traccion+"</b>"); 
			$("#transmicion").append("<b>"+data._source[titulo].Transmision+"</b>"); 
			$("#corridas_asiento").append("<b>"+data._source[titulo].CorridasAsientos+"</b>");
			$("#clasificacion").append("<b>"+data._source[titulo].clasificacion+"</b>");
		} 
	}); 
  </script>!-->
  
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
		
		function decode($texto)
		{
				$despues = Array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&agrave;','&egrave;','&igrave;','&ograve;','&ugrave;','&Agrave;','&Egrave;','&Igrave;','&Ograve;','&Ugrave;','&atilde;','&otilde;','&acirc;','&ecirc;','&ecirc;','&ocirc;','&ucirc;','&ccedil;','&uuml;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&Atilde;','&Otilde;','&Acirc;','&Ecirc;','&Icirc;','&Ocirc;','&Ucirc;','&Ccedil;','&Uuml;','&ntilde;','&Ntilde;','&acute;','&prime;','&lsquo;','&rsquo;','&ldquo;','&rdquo;','&bdquo;','&iquest;','&#63;','&copy;','&reg;','&#153;','&ordm;','&deg;','&ordf;','&sect;','&#161;');
				$antes 	 = Array('á','é','í','ó','ú','à','è','ì','ò','ù','À','È','Ì','Ò','Ù','ã','õ','â','ê','î','ô','û','ç','ü','Á','É','Í','Ó','Ú','Ã','Õ','Â','Ê','Î','Ô','Û','Ç','Ü','ñ','Ñ','´','\'','‘','’','“','”','„','¿','?','©','®','™','º','°','ª','§','¡');
				$nuevo 	 = str_replace($antes,$despues,$texto);
				return $nuevo;
		} 
		
		$valores = array_values($_GET);
		$bp_sucursal = 9; 

		$sql_sucursal = 'select calle, numero, comuna, telefono, latitud, longitud, ciudad, id_concesionario  from sucursales where bp_sucursal = "'.$bp_sucursal.'"';
		$result_sucursal = mysql_query($sql_sucursal);
		$array_sucursal = mysql_fetch_array($result_sucursal);
		$calle = $array_sucursal[0];
		$numero = $array_sucursal[1];
		$comuna = $array_sucursal[2];
		$telefono = $array_sucursal[3];
		$latitud = $array_sucursal[4];
		$longitud = $array_sucursal[5];
		$ciudad = $array_sucursal[6];
		$id_concesionario = $array_sucursal[7];

		$sql_concesionario = 'select nombre_concesionario, logo  from concesionario_sap where bp_concesionario= "'.$id_concesionario.'"';
		$result_concesionario = mysql_query($sql_concesionario);
		$array_concesionario = mysql_fetch_array($result_concesionario);
		$nombre_concesionario = $array_concesionario[0];
		$logo = $array_concesionario[1];

		$url = 'http://ailab01.mersap.com/autos/aviso/'.$valores[0];
		$content = file_get_contents($url);
		$json = json_decode($content, true);

		foreach($json['_source'] as $item) 
		{
			$marca              = decode($item['Marca']);
			$modelo      		= decode($item['Modelo']);
			$texto       		= decode($item['texto']);
			$año      	 		= $item['Anno']; 
			$kilometraje		= $item['Kilometraje'];
			$color 				= $item['Color'];
			$imagen        		= $item['imagen'];
			$transmision  		= decode($item['Transmision']);
			$tranccion    	    = $item['Traccion'];
			$corridasAsientos   = $item['CorridasAsientos'];
			$capacidadEstanque  = $item['CapacidadEstanque'];
			$caracteristicas    = $item['Caracteristicas'];
		}	
			$array_caracteristicas = explode(";", $caracteristicas);
			$numeropuertas 		= $array_caracteristicas[0];
			$oportunidadcomercial = $array_caracteristicas[1];
			$tipodireccion 		= $array_caracteristicas[2];
			$equiposonido 		= $array_caracteristicas[3];
			$suspencion 		= $array_caracteristicas[4];
			$frenos  			= $array_caracteristicas[5];
			$aireacondicionado	= $array_caracteristicas[6];
			$cambio 			= $array_caracteristicas[7];
			$cierrecentralizado = $array_caracteristicas[8];
			$climatizador       = $array_caracteristicas[9];
			$espejoelectronico  = $array_caracteristicas[10];
			$llantasaleacion    = $array_caracteristicas[11];
			$neblineros  		= $array_caracteristicas[12];
			$interiorcuero      = $array_caracteristicas[13];
			$techocorresizo     = $array_caracteristicas[14];
			$vidrioselectricos  = $array_caracteristicas[15];
			$controlcrucero     = $array_caracteristicas[16];

?>

  <div id="wrap">
  
    <div id="header">
    
      <div id="publicidad_Mobile_01">
        <img src="images/publicidad-mobile.jpg" alt="Emol automviles" />      </div>
      
      <div id="publicidad_Mobile_02">
        <img src="images/banner-publicidad.jpg" alt="Emol automviles" />      </div>
      
      <div id="Logo_02">
        <a href ="index.php"><img src="img/Logo.png" alt="Emol automviles" /></a>
	  </div>
      
      <div id="btn_menu_mobile" onClick="$('#nav').slideToggle('middle')"><img src="img/btn-menu.gif" alt="Men�" /></div>
            
       <div id="nav">
        <a href="<?php echo $url1;?>"><?php echo $menu1;?></a>
        <a href="<?php echo $url2;?>"><?php echo $menu2;?></a>
        <a href="<?php echo $url3;?>"><?php echo $menu3;?></a>
        <a href="<?php echo $url4;?>"><?php echo $menu4;?></a>
        <a href="<?php echo $url5;?>"><?php echo $menu5;?></a>
      </div>
          
    </div>
    
    <div id="wrap_despliegue">
      
      <div id="despliegue_Left">
        
        <p class="indicador_seccion"><a href="#">Inicio</a> &gt; B&uacute;squeda Inteligente &gt; Despliegue Ficha &gt; <?php echo $marca.' '.$modelo;?></p>

        <h1 class="title_color_despliegue">Aviso</h1>
        
        <div class="box fr"><a style="cursor: pointer;" onclick="window.print();"><img src="img/btn_impr.gif" alt="Imprimir" /></a></div>
        
        <div class="box_info_despliegue" id="aviso_ficha"><?php echo $texto;?></div>
        
        <h1 class="title_color_despliegue">Detalles</h1>
        
        <div class="box_info_despliegue">
          
			<ul class="list_Detalles_despliegue fl">
				<li id="anno">
					<span>A&ntilde;o</span><?php echo $año;?></li>
						<?php 
							if($kilometraje==-1)
							{
								$kilometraje='';
							}
							else{
									$kilometraje= $kilometraje;
								}
						?>
				<li id="kilometros">
					<span>Kms actuales</span>
					<?php 
						echo $kilometraje;
					?>
				</li>
				<li id="color">
					<span>Color</span>
					<?php 
						echo $color;
					?>
				</li>
				<li>
					<span>Direcci&oacute;n</span>
					Hidra&uacute;lica
				</li>
				<li id="traccion">
					<span>Tracci&oacute;n</span>
					<?php 
						echo $tranccion ;?>
				</li>
				<li>
					<span>Puertas</span>
					<?php 
						$numeropuertas=substr($numeropuertas ,-1);
						echo $numeropuertas;
					?>
				</li>
				<li id="transmicion">
					<span>Transmisi&oacute;n</span>
					<?php 
						echo $transmision;
					?>
				</li>
			</ul>
			<ul class="list_Detalles_despliegue fr">
				<li id="corridas_asiento">
					<span>Corridas de asientos</span>
					<?php 
						echo $corridasAsientos;
					?>
				</li>
				<li>
					<span>Equipo de sonido</span>
					<?php 
						$equiposonido=substr($equiposonido ,12);
						echo $equiposonido;
					?>
				</li>
				<li>
					<span>Oportunidad comercial</span>
					<?php
						$oportunidadcomercial=substr($oportunidadcomercial ,20);
						echo $oportunidadcomercial;
					?>
				</li>
				<?php 
					if($capacidadEstanque=='null')
					{
						$capacidadEstanque='';
					}
					else{
							$capacidadEstanque=$capacidadEstanque;
					    }
				?>
				<li>
					<span>Capacidad Estanque</span>
					<?php
						echo $capacidadEstanque;
					?>
				</li>
				<li>
					<span>Potencia (HP)</span> 
						210
				</li>
				<li>
					<span>Motor (cc)</span>
						1.600
				</li>
			</ul>
          
        </div>
        
        <h1 class="title_color_despliegue">Ficha T&eacute;cnica</h1>
        
        <div class="box_info_despliegue">
        
			<ul class="list_Ficha_despliegue fl">
				<li>
					<span>Control Crucero</span> 
				<?php
						if((substr($oportunidadcomercial ,-1)) == 1)
						{ ?>
							<img src="img/visto-bueno.png" alt="Si" />
				<?php	} 
						else{
							
							} ?>
				</li>
				<li>
					<span>Computador a bordo</span> 
				</li>
				<li>
					<span>DVD</span> 
					
				</li>
				<li>
					<span>Vidrios El&eacute;ctricos</span> 
				<?php
						if((substr($vidrioselectricos ,-1)) == 1)
						{?>
							<img src="img/visto-bueno.png" alt="Si" />
				<?php	}
						else{
								
							} ?>
				</li>
				<li>
					<span>Cierre Centralizado</span> 
					<?php
						if((substr($vidrioselectricos ,-1)) == 1)
						{?>
							<img src="img/visto-bueno.png" alt="Si" />
				<?php	}
						else{
								
							} ?>
				</li>
				<li>
					<span>Llantas Aleaci&oacute;n</span>
					<?php
						if((substr($llantasaleacion ,-1)) == 1)
						{?>
							<img src="img/visto-bueno.png" alt="Si" />
				<?php	}
						else{
								
							} ?>
				</li>
				<li>
					<span>Neblineros</span> 
					<?php
						if((substr($neblineros ,-1)) == 1)
						{?>
							<img src="img/visto-bueno.png" alt="Si" />
				<?php	}
						else{
								
							} ?>
				</li>
			</ul>
          
			<ul class="list_Ficha_despliegue fr">
				<li>
					<span>Aire Acondicionado</span>
						<?php
						if((substr($aireacondicionado ,-1)) == 1)
						{?>
							<img src="img/visto-bueno.png" alt="Si" />
				<?php	}
						else{
								
							} ?>
				</li>
				<li>
					<span>Alarma</span> 
				</li>
				<li>
					<span>Techo Corredizo</span> 
					<?php
						if((substr($techocorresizo ,-1)) == 1)
						{?>
							<img src="img/visto-bueno.png" alt="Si" />
				<?php	}
						else{
								
							} ?>
				</li>
				<li>
					<span>Frenos ABS</span> 
					<?php
						if((substr($frenos ,-1)) == 1)
						{?>
							<img src="img/visto-bueno.png" alt="Si" />
				<?php	}
						else{
								
							} ?>
				</li>
				<li>
					<span>Airbag</span>
					
				</li>
				<li>
					<span>Barra Laterales</span>
					
				</li>
			</ul>
        
        </div>
        
        <div class="btn_rojo"><a href="modal-mas-info.php?id_emol=<?php echo $valores[0];?>" rel="Shadowbox;width=445;height=600;">PEDIR INFORMACI&oacute;N</a></div>
        
        <small class="detalle_Despliegue">* Los precios y caracter&iacute;sticas del producto publicados en esta ficha son referenciales y deben ser confirmados por el vendedor.</small>
        
      </div>
        
      <div id="despliegue_Right">
        
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
        
	<?php
		if($imagen)
		{ ?>
			<div class="boxes_aside">
    			<ul class="rs-slider">
            		<li>
            			<img  src="<?php echo $imagen;?>" alt="" />
            		</li>
            		<li><img src="images/gallery-02.jpg" alt="" /></li>
		            <li><img src="images/gallery-01.jpg" alt="" /></li>
		            <li><img src="images/gallery-02.jpg" alt="" /></li>
		            <li><img src="images/gallery-01.jpg" alt="" /></li>
		            <li><img src="images/gallery-02.jpg" alt="" /></li>
          		</ul>
        	</div>
    <?php
		} ?>
		
        <div class="boxes_aside">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="44.5%" style="padding-bottom:10px;"><img src="upload/concesionarios/<?php echo $logo;?>" width="100%" /></td>
              <td width="55.5%" style="padding-bottom:10px;">
                <p class="info_concesionaria">
                  <span>Tel&eacute;fono</span> <?php echo $telefono;?><br />
                  <span>Direcci&oacute;n</span> <?php echo $calle.' '.$numero;?><br />
                  <span>Comuna</span> <?php echo $comuna;?><br />
                  <span>Ciudad</span> <?php echo $ciudad;?>
                </p>
              </td>
            </tr>
            <tr>
              <td  colspan="2">
               <div id="map" style="max-width: 297px;height: 250px;"></div>
  
		    <script>
		    	
		      var map = new XYGO.Map('map')
		      var concesionario = '<?php echo $nombre_concesionario?>'
		      var latitud = '<?php echo $latitud?>'
		      var longitud = '<?php echo $longitud?>'

		      var ubicacion = new L.LatLng(latitud, longitud)        
		      
		      map.setCenter(ubicacion, 15);
		      map.addMarker(ubicacion, concesionario, { open: true })

		    </script>  
		    </td>
            </tr>
          </table>

        </div>
        
        <div class="btn_rojo" style="width:100%;"><a onclick="procesar()" style="width:100%; padding:0; font-size:12px;">VER TODOS LOS AUTOS DE ESTA AUTOMOTORA</a></div>
        
      </div>
      
    </div>
    
    <div id="footer">T&eacute;rminos y Condiciones de Los Servicios &copy; 2013 El Mercurio Online</div>
  
  </div>
<?php 
	mysql_close($conn);   
?>
</body>
</html>
