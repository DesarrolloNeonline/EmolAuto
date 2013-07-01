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

  
  <script type="text/javascript" src="js/styleswitcher.js"></script>
  <link rel="stylesheet" type="text/css" href="css/normal1.css" title="normal1">
  <link rel="stylesheet" type="text/css" href="css/normal2.css" title="normal2">

  <script type="text/javascript" src="js/vendor/modernizr-2.6.2.min.js"></script>
   <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="vendor/bootstrap/js/bootstrap.min.js"></script>  

	<script type="text/javascript" src="vendor/linkify/1.0/jquery.linkify-1.0-min.js"></script>  

	<link rel="stylesheet" href="vendor/jquery-ui-1.8.18.custom/jquery-ui-1.8.18.custom.css">
	<script type="text/javascript" src="vendor/jquery-ui-1.8.18.custom/jquery-ui-1.8.18.custom.min.js"></script>

	<script type="text/javascript" src="js/jquery.facetview.js"></script>

	<link rel="stylesheet" href="css/facetview.css">

	<link rel="stylesheet" href="css/style.css">

  <script type="text/javascript">

    var sort="desc";;

     function sort() {  
        sort = "asd"; 
        alert(sort);// jQuery ensures 'this' will be the button  
    };

    function getUrlVars() 
    {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
        });
        return vars;
    }
  </script>

	<script type="text/javascript">
            jQuery(document).ready(function($) {

          var typeSearch = localStorage.getItem("typeSearch");
            if(typeSearch=='inteligente')
            {
                $('.facet-view-simple').facetview({
                      search_url: 'http://ailab01.mersap.com/autos/aviso/_search',
                      search_index: 'elasticsearch',
                      facets: [
                          {'field':'aviso.Comuna', 'display': 'Comuna'} ,
                          {'field':'aviso.Marca', 'display': 'Marca'} ,
                          {'field':'aviso.Modelo', 'display': 'Modelo'} ,
                          {'field':'aviso.precio', 'display': 'Precio'} ,
                          {'field':'aviso.Anno', 'display': 'A&ntilde;o'},
                          {'field':'aviso.Categoria', 'display': 'Categoria'} , 
                          {'field':'aviso.Color', 'display': 'Color'}
                      ],
                      result_display:
                      [
                          [
                              {"field": "aviso.Marca"}
                          ],
  						            [
                              {"field": "aviso.Modelo"}
                          ],
                          [
                               {"field": "aviso.precio"}
                          ],
                          [
                              {"field": "aviso.Anno"}
                          ],
  						            [
                              {"field": "aviso.Kilometraje"}
                          ],
                          [
                              {"field": "aviso.Transmision"}
                          ],
                          [
                              {"field": "aviso.Combustible"}
                          ],
                          [
                              {"field": "aviso.logo_operador"}
                          ],
                      ],
                      paging: 
                      {
                          from: 0,
                          size: 10
                      }
                  });
              
            }  
              else {

                        $('.facet-view-simple').facetview({
                        search_url: 'http://ailab01.mersap.com/autos/aviso/_search',
                        search_index: 'elasticsearch',
                        facets: [
                            {'field':'aviso.Categoria', 'display': 'Categoria'} , 
                            {'field':'aviso.precio', 'display': 'Precio'} ,
                            {'field':'aviso.Anno', 'display': 'A&ntilde;o'},
                            {'field':'aviso.Marca', 'display': 'Marca'} ,
                            {'field':'aviso.Modelo', 'display': 'Modelo'} ,
                            {'field':'aviso.Comuna', 'display': 'Comuna'} ,
                            {'field':'aviso.Color', 'display': 'Color'}
                        ],
                        result_display:
                        [
                           [
                              {"field": "aviso.Marca"}
                          ],
                          [
                              {"field": "aviso.Modelo"}
                          ],
                          
                          [
                               {"field": "aviso.precio"}
                          ],
                          [
                              {"field": "aviso.Anno"}
                          ],
                          [
                              {"field": "aviso.Kilometraje"}
                          ],
                          [
                              {"field": "aviso.Transmision"}
                          ],
                          [
                              {"field": "aviso.Combustible"}
                          ],
                          [
                              {"field": "aviso.logo_operador"}
                          ],
                        ],
                        paging: 
                        {
                            from: 0,
                            size: 30
                        }
                    });
                  }

                // set up form
                $('.demo-form').submit(function(e) {
                    e.preventDefault();
                    var $form = $(e.target);
                    var _data = {};
                    $.each($form.serializeArray(), function(idx, item) {
                        _data[item.name] = item.value;
                    });
                    $('.facet-view-here').facetview(_data);
                });
           

            });
  </script>
  <script type="text/javascript">
        function ilumina(celda){
          if (celda.style.backgroundColor=="")
          {
            celda.style.backgroundColor="#f9f8f8";
          }
            else
                {
                  celda.style.backgroundColor="";
                }
        }
        function setVisibility(){

          var aa= document.getElementById('frm1');
          for(var i = 0; i < aa.elements.length; i++){ 
            if(aa.elements[i].checked)
            { 
              document.getElementById('fondoTransparente').style.display = 'inline';
              document.getElementById('content_modal_enviar').style.display = 'inline';
              return true; 
            } 
          }
          alert('Debe seleccionar al menos un automovil.'); 
          return false; 
        }


    function setVisibilityNone() {
	  document.getElementById("email").value="";
	  document.getElementById("resultado").innerHTML="";
	  document.getElementById('content_modal_enviar').style.display = 'None';
      document.getElementById('fondoTransparente').style.display = 'None';

      var aa= document.getElementById('frm1');
      for (var i =0; i < aa.elements.length; i++){
        aa.elements[i].checked = false;
      }
	  

    }
  </script>
     <link rel="stylesheet" type="text/css" href="js/lightbox/shadowbox.css">
  <script type="text/javascript" src="js/lightbox/shadowbox.js"></script>
  <script type="text/javascript">
    Shadowbox.init();
  </script>
  <script type="text/javascript">
    function enviar()
    {
      var email = document.getElementById('email').value;
      var div_autos = document.getElementById('resultado').innerHTML;
      var ExpRegular = /(\w+)(\.?)(\w*)(\@{1})(\w+)(\.?)(\w*)(\.{1})(\w{2,3})/;

     if(email!="")
     {
        if(ExpRegular.test(email))
        {

              var parametros = 
              {
                            "email" : email,
                            "div_autos" : div_autos

             };
                    $.ajax({
                            data:  parametros,
                            url:    'procesa_envio.php',
                            type:   'post',
                            beforeSend: function () {
                                    $("#resultado").html("<img style='margin-left: 270px;width: 40px;' src='images/cargando.gif'>");

                            },
                            success:  function (response) {
                                    $("#resultado").html(response);
                            }
						});
						
						alert('El correo se ha enviado exitosamente');
						document.getElementById("email").value="";
						document.getElementById('content_modal_enviar').style.display = 'None';
						document.getElementById('fondoTransparente').style.display = 'None';
						
						var aa= document.getElementById('frm1');
						for (var i =0; i < aa.elements.length; i++){
							aa.elements[i].checked = false;
						}
			}	
        
          else  {
                  alert("La direcci\xf3n de email es incorrecta.");
                  return 0;
                }

    }
        else  {
                 alert("Debe ingresar su correo electronico");
                 return 0;
              }
    }
  </script>
 <script type="text/javascript">
    $(document).ready(function(){
      $("#filtros").click(function () {
        $("#facetview_filters").slideToggle("middle");
      });
	});
  </script>
  <script>
    function limpiar()
    {
      document.getElementById("resultado").innerHTML="";
      document.getElementById("email").value="";

      var aa= document.getElementById('frm1');
      for (var i =0; i < aa.elements.length; i++){
        aa.elements[i].checked = false;
      }
    }
  </script>
   <script type="text/javascript" src="js/format-number/accounting.js"></script>
   <script type="text/javascript" src="js/format-number/accounting.min.js"></script>
  <style type="text/css">
  #fondoTransparente
{
  /*Div que ocupa toda la pantalla*/
  position:absolute;
  top:0px;
  left:0px;
  width:100%;
  height:100%;
  background-color:#000;
  /*IE*/
  filter: alpha(opacity=50);
  /*FireFox Opera*/
  opacity: .5;
}
</style>

</head>
<body>
<?php
  include('connect.php'); 
	//Consulta de Menu de navegación.
  include('menu.php');
	?>
  
  <div id="wrap">
  
    <div id="header">
      
      <div id="Logo_02" style="z-index: 0;">
        <a href="index.php"><img src="img/Logo.png" alt="Emol automviles"/></a>
	  </div>
      
      <div id="btn_menu_mobile" onClick="$('#nav').slideToggle('middle')"><img src="img/btn-menu.gif" alt="MenÃº" /></div>
      
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
    <?php
		$valores = array_values($_GET);
	?>
    <div id="content_resultado_busqueda">
		<p class="indicador_seccion">
			<a href="index.php">Inicio</a> > <a href="">Resultado de b&uacute;squeda</a>
		</p>

			<div class="facet-view-simple"></div>
      <div id="content_modal_enviar">
  
        <div id="top_modal" style="padding: 20px;">
          <h1 style="margin-bottom: 10px;">Enviar avisos seleccionados</h1>
          <i class="icon-white icon-remove" style="margin-top: 1px; float: right; margin-top: -40px; cursor: pointer;" onclick="setVisibilityNone()"></i>
          <div class="content_Item_form_modal">
            <label>Correo</label>
            <input name="email" id="email" type="text" value="" placeholder="Ej: correo@correo.cl"/>
            <input name="enviar"  type="button" value="Enviar" onclick="enviar()" title="enviar correo" />
          </div>
        </div>
    
    <div id="content_List_selected" >
    
      <ul class="List_Autos_selected" id="resultado">
        
      </ul>
  
    </div>
  </div>
  <div id='fondoTransparente' style="display:none;position:fixed;">
</div>
   </div>
    <div id="footer">T&eacute;rminos y Condiciones de Los Servicios &copy; 2013 El Mercurio Online</div>

</body>
</html>
