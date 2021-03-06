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
<!-- load jQuery -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<!-- load Galleria -->
<script src="http://club.mersap.com/emol_automovil_merge/js/galleria-1.2.8.min.js"></script>
  
<link rel="stylesheet" href="css/refineslide.css" />
<script src="js/jquery.refineslide.min.js"></script>
<!--Setup Publicidades Addserver!-->
    <script type="text/javascript" src="http://banners.emol.com/tags/automoviles/setup_detalle.js"></script>
<!--end-->
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
    $MESSAGE_INVALID = 'No Especificado';

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
		$url = $indice_ficha.'_search?q=id_aviso:'.$valores[0];
		$content = file_get_contents($url);
		$json = json_decode($content, true);
		$hits = $json["hits"];

		if($hits["total"] == 0) {

			$url_aviso = $indice_aviso.$valores[0];
			$content_aviso = file_get_contents($url_aviso);
			$json_aviso = json_decode($content_aviso, true);

			foreach($json_aviso["_source"] as $item) 
					{
						$marca              = decode($item['Marca']);
				     	$modelo          = decode($item['Modelo']);
				     	$texto           = decode($item['texto']);
				       	$a�o             = $item['Anno']; 
			     	 	$kilometraje    = $item['Kilometraje'];
				      	$color         = $item['Color'];
				      	$imagen            = $item['imagen'];
				      	$transmision      = decode($item['Transmision']);
				    	$tranccion          = $item['Traccion'];
				    	$corridasAsientos   = $item['CorridasAsientos'];
			    	 	$capacidadEstanque  = $item['CapacidadEstanque'];
				      	$caracteristicas    = $item['Caracteristicas'];
			          	$fechaPublicacion    = $item['fecha_primerapub'];


          	 			  $array_caracteristicas = explode(";", $caracteristicas);
				      	  $numeropuertas     = $array_caracteristicas[0];
					      $oportunidadcomercial = $array_caracteristicas[1];
					      $tipodireccion     = $array_caracteristicas[2];
					      $equiposonido     = $array_caracteristicas[3];
					      $suspencion     = $array_caracteristicas[4];
					      $frenos        = $array_caracteristicas[5];
					      $aireacondicionado  = $array_caracteristicas[6];
					      $cambio       = $array_caracteristicas[7];
					      $cierrecentralizado = $array_caracteristicas[8];
					      $climatizador       = $array_caracteristicas[9];
					      $espejoelectronico  = $array_caracteristicas[10];
					      $llantasaleacion    = $array_caracteristicas[11];
					      $neblineros      = $array_caracteristicas[12];
					      $interiorcuero      = $array_caracteristicas[13];
					      $techocorresizo     = $array_caracteristicas[14];
					      $vidrioselectricos  = $array_caracteristicas[15];
					      $controlcrucero     = $array_caracteristicas[16];

					}	

					    

					    ?>

					  <div id="wrap">
					  
					    <div id="header">
					      
					      <div id="Logo_02">
					        <a href ="index.php"><img src="img/Logo.png" alt="Emol automviles" /></a>
						  </div>
						  <div class="content_publicidad_728">
					        <script type="text/javascript" src="http://banners.emol.com/tags/automoviles/horizontal_01.js"></script> 
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
					        
					        <p class="indicador_seccion"><a href="index.php">Inicio</a> &gt; <a href="javascript:history.go(-1)"> Resultado de B&uacute;squeda</a> &gt; Ficha <?php echo $marca.' '.$modelo;?></p>

					        <h1 class="title_color_despliegue">Aviso</h1>
					        
					        <div class="box fr" id="imprimir"><a style="cursor: pointer;" onclick="window.print();"><img src="img/btn_impr.gif" alt="Imprimir" /></a></div>
					        
					        <div class="box_info_despliegue" id="aviso_ficha"><?php echo $texto;?></div>
					        
					        <h1 class="title_color_despliegue">Detalles</h1>
					        
					        <div class="box_info_despliegue">
			          
								<ul class="list_Detalles_despliegue fl">
									<li id="fechaPubicacion">
										<span>Fecha de Publicaci&oacute;n</span>
						 				<?php
                        				 	$fecha = substr($fechaPublicacion,0,11);
                        				 	echo substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
                 						?>
             						</li>
					                <li id="anno">
         								<span>A&ntilde;o</span>
         								<?php 
         									echo $a�o;
         								?>
         							</li>
					           <?php 
					             if($kilometraje==-1)
					              {
					                $kilometraje='';
					              }
					              else{
					                  $kilometraje= $kilometraje;
					                }
					            ?> 
					            	<?php if($kilometraje !=""){ ?>
					      			<li id="kilometros">
					        			<span>Kms actuales</span>
					        			<?php 
					         				echo $kilometraje;
					        			?>
					       			</li>
				       			<?php	
				       				} ?>
					                <?php if(!($color=='')&&!($color=='Otro')){  ?>
							        	<li id="color">
							          		<span>Color</span>
							          	<?php 
							            	echo $color;
							          	?>
						       		 	</li>
					                <?php } ?>
							        
				                <?php if(!($tranccion=='')&&!($tranccion=='Otro')){  ?>
							        <li id="traccion">
							          <span>Tracci&oacute;n</span>
							          <?php 
							            echo $tranccion; ?>
							        </li>
							                <?php } ?>
							                

							        <?php if(!($numeropuertas=='')&&!($numeropuertas=='Otro')&&!(substr($numeropuertas ,-1)==='S')&&!(substr($numeropuertas ,-1)==='s')){  ?>
							        <li>
							          <span>Puertas</span>
							          <?php 
							            $numeropuertas=substr($numeropuertas ,-1);
							            echo $numeropuertas;
							          ?>
							        </li>
							        <?php } ?>
							                <?php if(!($transmision=='')&&!($transmision=='Otro')){  ?>
							        <li id="transmicion">
							          <span>Transmisi&oacute;n</span>
							          <?php 
							            echo $transmision;
							          ?>
						        </li><?php };?>
						    </ul>
					         
					         <ul class="list_Detalles_despliegue fr">
						                <?php if(!($corridasAsientos=='')&&!($corridasAsientos=='Otro')){  ?>
						        <li id="corridas_asiento">
						          <span>Corridas de asientos</span>
						          <?php 
						            echo $corridasAsientos;
						          ?>
						       </li>
						                <?php }?>
						                <?php if((substr($equiposonido ,12)!='')&&(substr($equiposonido ,12)!='Otro')){  ?>
						        <li>
						          <span>Equipo de sonido</span>
						          <?php 
						            $equiposonido=substr($equiposonido ,12);
						            echo $equiposonido;
						          ?>
						        </li>
						                <?php }?>
						        <?php if(!(substr($oportunidadcomercial ,20)=='')&&!(substr($oportunidadcomercial ,20)=='Otro')){  ?>
						        <li>
						          <span>Oportunidad comercial</span>
						          <?php
						            $oportunidadcomercial=substr($oportunidadcomercial ,20);
						            echo $oportunidadcomercial;
						          ?>
						        </li>
						                <?php } ?>
						        <?php 
						          if($capacidadEstanque=='null')
						          {
						            $capacidadEstanque='';
						          }
						          else{
						              $capacidadEstanque=$capacidadEstanque;
						              }
						        ?>
						                <?php if(!($capacidadEstanque=='')&&!($capacidadEstanque=='Otro')){  ?>
						        <li>
						          <span>Capacidad Estanque</span>
						          <?php
						            echo $capacidadEstanque;
						          ?>
						        </li>
						                <?php }?>
						        
						      </ul> 
					       </div>

			       <?php

			       		if(((substr($oportunidadcomercial ,-1)) == 1) && ((substr($vidrioselectricos ,-1)) == 1) && 
			       			((substr($llantasaleacion ,-1)) == 1) && ((substr($neblineros ,-1)) == 1) &&  ((substr($aireacondicionado ,-1)) == 1) &&
			       				 ((substr($techocorresizo ,-1)) == 1) &&   ((substr($frenos ,-1)) == 1)) { ?>

			        
					        <h1 class="title_color_despliegue">Ficha T&eacute;cnica</h1>
					        
					        <div class="box_info_despliegue">
					        
								<ul class="list_Ficha_despliegue fl">
									
							        <?php
							            if((substr($oportunidadcomercial ,-1)) == 1)
							            { ?>
							        	  <li>
							          		<span>Control Crucero</span> 	
							              	<img src="img/visto-bueno.png" alt="Si" />
							              </li>
							        <?php  } 
							            else{
							              
							              } ?>
							        
							         
							        <?php
							            if((substr($vidrioselectricos ,-1)) == 1)
							            {?>
							        		<li>
						          				<span>Vidrios El&eacute;ctricos</span>
							              		<img src="img/visto-bueno.png" alt="Si" />
							               	</li>
								<?php  }
							            else{
							                
							              } ?>
							       							        
							        <?php
							            if((substr($llantasaleacion ,-1)) == 1)
							            {?>
							        	    <li>
								          		<span>Llantas Aleaci&oacute;n</span>
								              	<img src="img/visto-bueno.png" alt="Si" />
							                </li>
							        <?php  }
							            else{
							                
							              } ?>
							       
							        <?php
							            if((substr($neblineros ,-1)) == 1)
							            {?>
								        <li>
								          <span>Neblineros</span> 
								             <img src="img/visto-bueno.png" alt="Si" />
								        </li>     
							        <?php  }
							            else{
							                
							              } ?>
							     </ul>

					          
								<ul class="list_Ficha_despliegue fr">
									
									
							            <?php
							            if((substr($aireacondicionado ,-1)) == 1)
							            {?>
						        			<li>
								          		<span>Aire Acondicionado</span>
								              	<img src="img/visto-bueno.png" alt="Si" />
							              	</li>
							        <?php  }
							            else{
							                
							              } ?>
							        <?php
							            if((substr($techocorresizo ,-1)) == 1)
							            {?>
						        			<li>
							          			<span>Techo Corredizo</span> 
							              		<img src="img/visto-bueno.png" alt="Si" />
				              			  	</li>
							        <?php  }
							            else{
							                
							              } ?>
							      	<?php
							            if((substr($frenos ,-1)) == 1)
							            {?>
								         	<li>
								         	 <span>Frenos ABS</span> 
								              <img src="img/visto-bueno.png" alt="Si" />
							                </li>
							        <?php  }
							            else{
							                
							              } ?>
							    </ul>
					        
					        </div>
					      <?php } ?>
			     
						        
						        <small class="detalle_Despliegue">* Los precios y caracter&iacute;sticas del producto publicados en esta ficha son referenciales y deben ser confirmados por el vendedor.</small>
						        
						      </div>
						        
						      <div id="despliegue_Right">
						      	<div class="content_publicidad_300">
          							<script type="text/javascript" src="http://banners.emol.com/tags/automoviles/robpg_01.js"></script>
        						</div>
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
						    			<ul>
						            		<li>
						            			<img  src="<?php echo $imagen;?>" alt="" />
						            		</li>
						            	</ul>
						        	</div>
						    <?php
								} ?>
								
								 </div>
						      
						    </div>
			
			
<?php
	    } else
   				{

	    			foreach($hits["hits"] as $hit) 
					{
						$id_ficha 					= $hit["_id"];
						$item 						= $hit["_source"]["ficha"];
						$marca              		= decode($item['marca']);
						$modelo      				= decode($item['modelo']);
						$texto       				= decode($item['texto']);
						$anno      	 				= $item['a�o']; 
						$kms_actuales				= $item['kms_actuales'];
						$color 						= $item['color'];
						$transmision  				= decode($item['transmision']);
						$traccion    	    		= $item['traccion'];
						$corridas_de_asientos   	= $item['corridas_de_asientos'];
						$capacidad_estanque  		= $item['capacidad_estanque'];
						$potencia_hp  				= $item['potencia_hp'];
						$motor_cc  					= $item['motor_cc'];
			            $fechaPublicacion  	 		= $item['fecha_primerapub'];
			            $puertas    				= $item['puertas'];
			            $oportunidad_comercial   	= decode($item['oportunidad_comercial']);
			            $direccion  				= decode($item['direccion']);
			            $equipo_de_sonido  			= decode($item['equipo_de_sonido']);
			            $suspension  				= $item['suspension'];
			            $frenos_abs    				= $item['frenos_abs'];
			            $aire_acondicionado  		= $item['aire_acondicionado'];
			            $cierre_centralizado    	= $item['cierre_centralizado'];
			            $climatizador               =  '';
			            $espejoelectronico          = '';
			            $llantas_aleacion    		= $item['llantas_aleacion'];
			            $neblineros    		        = $item['neblineros'];
			            $interior_cuero    		    = $item['interior_cuero'];
			            $techo_corredizo    		= $item['techo_corredizo'];
			            $vidrios_electricos    		= $item['vidrios_electricos'];
			            $control_crucero    		= $item['control_crucero'];
			            $airbag    					= $item['airbag'];
			            $barras_laterales    		= $item['barras_laterales'];
			            $computador_abordo			= $item['computador_abordo'];
			            $dvd                        = $item['dvd'];
			            $alarma   					= $item['alarma'];
			            $nro_bp   					= $item['nro_bp'];
			            $latitud_json       		= $item['ubicacion_coordenada_x'];
			            $longitud_json       		= $item['ubicacion_coordenada_y'];

					}	
						
						$url_aviso = $indice_aviso.$valores[0];
						$content_aviso = file_get_contents($url_aviso);
						$json_aviso = json_decode($content_aviso, true);

						foreach($json_aviso["_source"] as $item) 
						{
							$fechaPublicacion    = $item['fecha_primerapub'];
							$imagen_aviso 		 = $item['imagen'];
						}

						$sql_concesionario = 'select nombre_fantasia, logo_chico, bp_concesionario, calle, numero, comuna, ciudad, 
					    telefono, prioridad, encargado, RUT, tipo, latitud, longitud, logo_grande, imagen_concesionario, id_concesionario, email_concesionario
					    from concesionario  where bp_concesionario = "'.$nro_bp.'"';

					    $result_concesionarios= mysql_query($sql_concesionario);
					    $row_concesionarios=mysql_fetch_row($result_concesionarios);
					    $count_concesionarios = mysql_num_rows($result_concesionarios);
					    $nombre_fantasia=$row_concesionarios[0];
					    $logo=$row_concesionarios[1]; 
					    $bp_concesionario = $row_concesionarios[2];
					    $calle=$row_concesionarios[3];
					    $numero=$row_concesionarios[4];
					    $comuna=$row_concesionarios[5];
					    $ciudad = $row_concesionarios[6];
					    $telefono = $row_concesionarios[7];
					    $orden = $row_concesionarios[8];
					    $encargado = $row_concesionarios[9];
					    $rut = $row_concesionarios[10];
					    $tipo = $row_concesionarios[11];
					    $latitud = $row_concesionarios[12];
					    $longitud = $row_concesionarios[13];
					    $logo_grande = $row_concesionarios[14];
					    $imagen_concesionario = $row_concesionarios[15];
					    $id_concesionario = $row_concesionarios[16];
					    $email_concesionario = $row_concesionarios[17];

					    $latitud_identificador = substr($latitud ,3 ,1);

					    if($latitud_identificador == '.'){

					         $latitud = $latitud;

					    } else  {

					            $latitud_ini = substr($latitud ,0 ,3);
					            $latitud_inicial = $latitud_ini.'.';
					            $latitud_fin = substr($latitud ,3);
					            $latitud = $latitud_inicial.$latitud_fin;

					            }


					    $longitud_identificador = substr($longitud ,3 ,1);

					    if($longitud_identificador == '.'){

					         $longitud = $longitud;

					    } else  {

					              $longitud_ini = substr($longitud ,0 ,3);
					              $longitud_inicial = $longitud_ini.'.';
					              $longitud_fin = substr($longitud ,3);
					              $longitud = $longitud_inicial.$longitud_fin;
					                      
					            }
					    

					    ?>

					  <div id="wrap">
					  
					    <div id="header">
					      
					      <div id="Logo_02">
					        <a href ="index.php"><img src="img/Logo.png" alt="Emol automviles" /></a>
						  </div>
						  <div class="content_publicidad_728">
        					<script type="text/javascript" src="http://banners.emol.com/tags/automoviles/horizontal_01.js"></script> 
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
					        
					        <p class="indicador_seccion"><a href="index.php">Inicio</a> &gt; <a href="javascript:history.go(-1)"> Resultado de B&uacute;squeda</a> &gt; Ficha <?php echo $marca.' '.$modelo;?></p>

					        <h1 class="title_color_despliegue">Aviso</h1>

					        <div class="box fr" id="imprimir"><a style="cursor: pointer;" onclick="window.print();"><img src="img/btn_impr.gif" alt="Imprimir" /></a></div>
                            
                            <div class="box_info_despliegue" id="aviso_ficha"><?php echo $texto;?></div>
					        
					        <?php

							$url_image = $indice_imagen.'_search?q=id_ficha:'.$id_ficha;
					
							$content_image = file_get_contents($url_image);
							$json_image = json_decode($content_image, true);
							$hits_image = $json_image["hits"];
							$image_invalid = 'imagen_no_disponible.gif';
							$image_invalid2 = 'imgNoDisponible.gif';
							

								if($hits_image["total"] != 0)
								{ 

				    				foreach($hits_image["hits"] as $hit_img) 
									{ ?>
										<?php
											$item_img = $hit_img["_source"]["imagen"];
											$img_autos = $item_img['archivo'];
											$id_img    =  $item_img['id_ficha'];

									}
				                    
				                    $valida_image_1 = strpos($img_autos, $image_invalid);
				                    $valida_image_2 = strpos($img_autos, $image_invalid2);

				                    
				                    	
				             		if((!$valida_image_1) && (!$valida_image_2)){ ?>
										
										<div class="content">
											<div class="box_info_despliegue">
												<div id="galleria_imagen">
													<img src="<?php echo $imagen_aviso;?>" alt="" />
									    			<?php
									    				foreach($hits_image["hits"] as $hit_img) 
														{ ?>
															
															<?php
																$item_img = $hit_img["_source"]["imagen"];
																$img_autos = $item_img['archivo'];
																$id_img    =  $item_img['id_ficha'];
																$imagen_ficha = 'http://imgclasificados.emol.com/'.$img_autos;
																echo $imagen_autos;
										                        if($imagen_aviso !=$imagen_ficha){ ?>
																	<img src="http://imgclasificados.emol.com/<?php echo $img_autos;?>" alt="" />
																<?php
																} else {

																}
										             
														}	 
															?>
									    		</div>
								        	</div>
							        	</div>

								        <script>

									    // Load the classic theme
									    Galleria.loadTheme('http://club.mersap.com/emol_automovil_merge/js/galleria.classic.min.js');

									    // Initialize Galleria
									    Galleria.run('#galleria_imagen');

									    </script>
						    <?php
									}
								 }?>

					       
					        <div id="Detalles_mobile"><h1 class="title_color_despliegue">Detalles</h1>
					        		<div class="box_info_despliegue">
					          
										<ul class="list_Detalles_despliegue fl">
							                <li id="fechaPubicacion">
												<span>Fecha de Publicaci&oacute;n</span>
							                    <?php
		                        				 	$fecha = substr($fechaPublicacion,0,11);
		                        				 	echo substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
							                    ?>
							                </li>
											<?php if(!($anno=='') &&!($anno==$MESSAGE_INVALID)){ ?>
													<li id="anno">
													<span>A&ntilde;o</span><?php echo $anno;?>
													</li>
											<?php } ?>

											<?php if(!($kms_actuales=='') &&!($kms_actuales==$MESSAGE_INVALID)){ 
													$kms_actuales = number_format($kms_actuales, 0, ',', '.');
                          							$kms_actuales = str_replace('$','',$kms_actuales);?>
													<li id="kilometros">
														<span>Kms actuales</span><?php echo $kms_actuales;?>
													</li>
											<?php } ?>
											
							                <?php if(!($color=='') &&! ($color==$MESSAGE_INVALID)){  ?>
													<li id="color">
													<span>Color</span><?php echo $color;?>
													</li>
							                <?php } ?>
											
											<?php if(!($direccion=='') &&! ($direccion==$MESSAGE_INVALID)){  ?>
													<li id="direccion">
													<span>Direcci&oacute;n</span><?php echo $direccion;?>
													</li>
											<?php } ?>

							                <?php if(!($traccion=='') &&! ($traccion==$MESSAGE_INVALID)){  ?>
													<li id="traccion">
													<span>Tracci&oacute;n</span><?php echo $traccion;?>
													</li>
											<?php } ?>

							                <?php if(!($puertas=='') &&! ($puertas==$MESSAGE_INVALID)){  ?>
													<li id="puertas">
													<span>Puertas</span><?php echo $puertas;?>
													</li>
											<?php } ?>

											<?php if(!($transmision=='') &&! ($transmision==$MESSAGE_INVALID)){  ?>
													<li id="transmision">
													<span>Transmisi&oacute;n</span><?php echo $transmision;?>
													</li>
											<?php } ?>
										</ul>

										<ul class="list_Detalles_despliegue fr">
							                <?php if(!($corridas_de_asientos=='') &&! ($corridas_de_asientos==$MESSAGE_INVALID)){  ?>
													<li id="corridasasiento">
													<span>Corridas de asiento</span><?php echo $corridas_de_asientos;?>
													</li>
											<?php } ?>

											<?php if(!($equipo_de_sonido=='') &&! ($equipo_de_sonido==$MESSAGE_INVALID)){  ?>
													<li id="equiposonido">
													<span>Equipo de sonido</span><?php echo $equipo_de_sonido;?>
													</li>
											<?php } ?>

											<?php if(!($oportunidad_comercial=='') &&! ($oportunidad_comercial==$MESSAGE_INVALID)){  ?>
													<li id="oportunidadcomercial">
													<span>Oportunidad comercial</span><?php echo $oportunidad_comercial;?>
													</li>
											<?php } ?>

											<?php if(!($capacidad_estanque=='') &&! ($capacidad_estanque==$MESSAGE_INVALID)){  ?>
													<li id="capacidadestanque">
													<span>Capacidad estanque</span><?php echo $capacidad_estanque;?>
													</li>
											<?php } ?>

											<?php if(!($potencia_hp=='') &&! ($potencia_hp==$MESSAGE_INVALID)){  ?>
													<li id="potencia">
													<span>Potencia (HP)</span><?php echo $potencia_hp;?>
													</li>
											<?php } ?>

											<?php if(!($motor_cc=='')  &&! ($motor_cc==$MESSAGE_INVALID)){  
													$motor_cc = number_format($motor_cc, 0, ',', '.');
                          							$motor_cc = str_replace('$','',$motor_cc);?>
													<li id="motor">
													<span>Motor (cc)</span><?php echo $motor_cc;?>
													</li>
											<?php } ?>

									</ul>
							          
							        </div>
						    </div>
					<?php 
						if(($control_crucero) || ($computador_abordo) || ($dvd) || ($vidrios_electricos) || ($cierre_centralizado) ||
							($llantas_aleacion) || ($neblineros) || ($aire_acondicionado) || ($alarma)   || ($techo_corredizo) ||
							($frenos_abs) || ($airbag) || ($barras_laterales)){  ?>

		
					        <h1 class="title_color_despliegue">Ficha T&eacute;cnica</h1>
					        
					        <div class="box_info_despliegue">
					        
								<ul class="list_Ficha_despliegue fl">
									<?php if($control_crucero){  ?>
											<li id="controlcrucero">
											<span>Control Crucero</span><img src="img/visto-bueno.png" alt="Si" />
											</li>
									<?php } ?>

									<?php if($computador_abordo){  ?>
											<li id="computadorbordo">
											<span>Computador a bordo</span><img src="img/visto-bueno.png" alt="Si" />
											</li>
									<?php } ?>

									<?php if($dvd){  ?>
											<li id="dvd">
											<span>DVD</span><img src="img/visto-bueno.png" alt="Si" />
											</li>
									<?php } ?>

									<?php if($vidrios_electricos){  ?>
											<li id="vidrioselectronicos">
											<span>Vidrios El&eacute;ctricos</span><img src="img/visto-bueno.png" alt="Si" />
											</li>
									<?php } ?>

									<?php if($cierre_centralizado){  ?>
											<li id="cierrecentralizado">
											<span>Cierre Centralizado</span><img src="img/visto-bueno.png" alt="Si" />
											</li>
									<?php } ?>

									<?php if($llantas_aleacion){  ?>
											<li id="llantasaleacion">
											<span>Llantas Aleaci&oacute;n</span><img src="img/visto-bueno.png" alt="Si" />
											</li>
									<?php } ?>

									<?php if($neblineros){  ?>
											<li id="neblineros">
											<span>Neblineros</span><img src="img/visto-bueno.png" alt="Si" />
											</li>
									<?php } ?>

								</ul>
					          
								<ul class="list_Ficha_despliegue fr">
									
									<?php if($aire_acondicionado){  ?>
										<li id="aireacondicionado">
										<span>Aire Acondicionado</span><img src="img/visto-bueno.png" alt="Si" />
										</li>
									<?php } ?>

									<?php if($alarma){  ?>
										<li id="alarma">
										<span>Alarma</span><img src="img/visto-bueno.png" alt="Si" />
										</li>
									<?php } ?>
											
									
									<?php if($techo_corredizo){  ?>
										<li id="techocorredizo">
										<span>Techo Corredizo</span><img src="img/visto-bueno.png" alt="Si" />
										</li>
									<?php } ?>	

									<?php if($frenos_abs){  ?>
										<li id="frenos">
										<span>Frenos ABS</span><img src="img/visto-bueno.png" alt="Si" />
										</li>
									<?php } ?>	

									<?php if($airbag){  ?>
										<li id="airbag">
										<span>Airbag</span><img src="img/visto-bueno.png" alt="Si" />
										</li>
									<?php } ?>	

									<?php if($barras_laterales){  ?>
										<li id="barraslaterales">
										<span>Barra Laterales</span><img src="img/visto-bueno.png" alt="Si" />
										</li>
									<?php } ?>		
										
									
								</ul>
					        
					        </div>
			        <?php 	
			        		}
			        		?>
			        			<small class="detalle_Despliegue">* Los precios y caracter&iacute;sticas del producto publicados en esta ficha son referenciales y deben ser confirmados por el vendedor.</small>
						        
						    <?php    
						        if($count_concesionarios!=0){ ?>
			        
						        <div class="btn_rojo"><a href="modal-mas-info.php?id_emol=<?php echo $valores[0];?>&email=<?php echo $email_concesionario;?>" rel="Shadowbox;width=445;height=600;">PEDIR INFORMACI&oacute;N</a></div>
						<?php
								} ?>
						      </div>
						        
						      <div id="despliegue_Right">
						        
						         <h1 class="title_color_despliegue" id="Detalle_Desktop">Detalles</h1>
                                
                                <div class="boxes_aside" id="Detalle_Desktop">
                                  <ul class="list_Detalles_despliegue fl">
					                <li id="fechaPubicacion">
										<span>Fecha de Publicaci&oacute;n</span>
					                    <?php
                        				 	$fecha = substr($fechaPublicacion,0,11);
                        				 	echo substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
					                    ?>
					                </li>
									<?php if(!($anno=='') &&! ($anno==$MESSAGE_INVALID)){  ?>
											<li id="anno">
											<span>A&ntilde;o</span><?php echo $anno;?>
											</li>
									<?php } ?>
									<?php if(!($kms_actuales=='') &&! ($kms_actuales==$MESSAGE_INVALID)){  ?>
											<li id="kilometros">
											<span>Kms actuales</span><?php echo $kms_actuales;?>
											</li>
									<?php } ?>
									<?php if(!($color=='') &&! ($color==$MESSAGE_INVALID)){  ?>
											<li id="color">
											<span>Color</span><?php echo $color;?>
											</li>
					                <?php } ?>
									<?php if(!($direccion=='') &&! ($direccion==$MESSAGE_INVALID)){  ?>
											<li id="direccion">
											<span>Direcci&oacute;n</span><?php echo $direccion;?>
											</li>
									<?php } ?>
									<?php if(!($traccion=='') &&! ($traccion==$MESSAGE_INVALID)){  ?>
											<li id="traccion">
											<span>Tracci&oacute;n</span><?php echo $traccion;?>
											</li>
									<?php } ?>

									<?php if(!($puertas=='') &&! ($puertas==$MESSAGE_INVALID)){  ?>
											<li id="puertas">
											<span>Puertas</span><?php echo $puertas;?>
											</li>
									<?php } ?>

									<?php if(!($transmision=='') &&! ($transmision==$MESSAGE_INVALID)){  ?>
											<li id="transmision">
											<span>Transmisi&oacute;n</span><?php echo $transmision;?>
											</li>
									<?php } ?>
								</ul>

								  <ul class="list_Detalles_despliegue fr">
									<?php if(!($corridas_de_asientos=='') &&! ($corridas_de_asientos==$MESSAGE_INVALID)){  ?>
											<li id="corridasasiento">
											<span>Corridas de asiento</span><?php echo $corridas_de_asientos;?>
											</li>
									<?php } ?>

									<?php if(!($equipo_de_sonido=='') &&! ($equipo_de_sonido==$MESSAGE_INVALID)){  ?>
											<li id="equiposonido">
											<span>Equipo de sonido</span><?php echo $equipo_de_sonido;?>
											</li>
									<?php } ?>

									<?php if(!($oportunidad_comercial=='') &&!($oportunidad_comercial==$MESSAGE_INVALID)){  ?>
											<li id="oportunidadcomercial">
											<span>Oportunidad comercial</span><?php echo $oportunidad_comercial;?>
											</li>
									<?php } ?>

									<?php if(!($capacidad_estanque=='') &&! ($capacidad_estanque==$MESSAGE_INVALID)){  ?>
											<li id="capacidadestanque">
											<span>Capacidad estanque</span><?php echo $capacidad_estanque;?>
											</li>
									<?php } ?>

									<?php if(!($potencia_hp=='') &&! ($potencia_hp==$MESSAGE_INVALID)){  ?>
											<li id="potencia">
											<span>Potencia (HP)</span><?php echo $potencia_hp;?>
											</li>
									<?php } ?>

									<?php if(!($motor_cc=='') &&! ($motor_cc==$MESSAGE_INVALID)){  ?>
											<li id="motor">
											<span>Motor (cc)</span><?php echo $motor_cc;?>
											</li>
									<?php } ?>

							</ul>
                                </div>
						        
                                <div class="content_publicidad_300">
          							<script type="text/javascript" src="http://banners.emol.com/tags/automoviles/robpg_01.js"></script>
        						</div>
							<?php
								if($count_concesionarios!=0){ ?>


						        <div class="boxes_aside">
						          <table width="100%" border="0" cellspacing="0" cellpadding="0">
						            <tr>
						              <td width="44.5%" style="padding-bottom:10px;"><img src="upload/concesionarios/<?php echo $logo_grande;?>" width="100%" /></td>
						              <td width="55.5%" style="padding-bottom:10px;">
						                <p class="info_concesionaria">
						                  <span>Tel&eacute;fono</span> <?php echo $telefono;?><br />
						                  <span>Direcci&oacute;n</span> <?php echo $calle.' '.$numero;?><br />
						                  <span>Comuna</span> <?php echo ucwords(strtolower($comuna));?><br />
						                  <span>Ciudad</span> <?php echo ucwords(strtolower($ciudad));?><br />
						                  <?php
						                    if($encargado){ ?>
						                    	 <span>Contacto</span> <?php echo ucwords(strtolower($encargado));?>
						                   <?php 
						                    } ?>
						                </p>
						              </td>
						            </tr>
						            <tr>
						              <td  colspan="2">
						               <div id="map" style="max-width: 100%;height: 250px;"></div>
						  
								    <script>
								    	
								      var map = new XYGO.Map('map')
								      var concesionario = '<?php echo $nombre_fantasia?>'
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
						      
						        
						        <div class="btn_rojo" style="width:100%;margin-bottom: 20px;"><a onclick="procesar()" style="width:100%; padding:0; font-size:12px;">VER TODOS LOS AUTOS DE ESTA AUTOMOTORA</a></div>
						        
				          <?php } 
				          			else 
				          				if(($latitud_json) && ($longitud_json)){ 

				          			$latitud_identificador = substr($latitud_json ,3 ,1);

								    if($latitud_identificador == '.'){

								         $latitud_final = $latitud_json;

								    } else  {

								            $latitud_ini = substr($latitud_json ,0 ,3);
								            $latitud_inicial = $latitud_ini.'.';
								            $latitud_fin = substr($latitud_json ,3);
								            $latitud_final = $latitud_inicial.$latitud_fin;

								            }


								    $longitud_identificador = substr($longitud_json ,3 ,1);

								    if($longitud_identificador == '.'){

								         $longitud_final = $longitud_json;

								    } else  {

								              $longitud_ini = substr($longitud_json ,0 ,3);
								              $longitud_inicial = $longitud_ini.'.';
								              $longitud_fin = substr($longitud_json ,3);
								              $longitud_final = $longitud_inicial.$longitud_fin;
								                      
								            } ?>




				          				 <div class="boxes_aside">
								          <table width="100%" border="0" cellspacing="0" cellpadding="0">
								           <tr>
								              <td  colspan="2">
								               <div id="map" style="max-width: 100%;height: 250px;"></div>
						  
										    <script>
										    	
										      var map = new XYGO.Map('map')
										      var concesionario = 'Particular'
										      var latitud = '<?php echo $latitud_final ?>'
										      var longitud = '<?php echo $longitud_final?>'

										      var ubicacion = new L.LatLng(latitud, longitud)        
										      
										      map.setCenter(ubicacion, 15);
										      map.addMarker(ubicacion, concesionario, { open: true })

										    </script>  
										    </td>
								            </tr>
								          </table>

						       			</div>
				       			<?php
				          			}?>
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
						      </div>
						      
						    </div>

				     <script>
					function procesar()
					{
						var id_concesionario = "<?php echo $id_concesionario;?>";
						location.href="despliegue-concesionarios.php?id_concesionario="+id_concesionario;
					}
			 		</script>
   		 <?php } ?>
    
    <div id="footer">T&eacute;rminos y Condiciones de los Servicios &copy; 2013 El Mercurio Online</div>
  
  </div>
<?php 
	mysql_close($conn);   
?>
</body>
</html>
