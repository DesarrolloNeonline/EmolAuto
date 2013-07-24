<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Emol autom&oacute;viles</title>
  <meta name="description" content="Autos nuevos, Autos usados, jeep, camionetas, todo terreno, compra y venta, Automviles EMOL">
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/main.css">
  <script src="js/jquery-latest.js"></script>
  <script type="text/javascript" src="js/vendor/jquery-1.7.1.js"></script>
  <script src="js/jquery.js" type="text/javascript"></script> 
  <script src="js/jquery.Rut.js" type="text/javascript"></script>

<script>
	function procesa(name, rut, telefono, celular, email, mensaje){
	
				var ExpRegular = /(\w+)(\.?)(\w*)(\@{1})(\w+)(\.?)(\w*)(\.{1})(\w{2,3})/;

				if (document.form.name.value.length==0)
				{
					alert("Ingrese su nombre")
					document.form.name.focus()
					return 0;
				} 
				if (document.form.email.value.length==0)
				{
					alert("Ingrese su email")
					document.form.email.focus()
					return 0;
				} 

						if (ExpRegular.test(email))
						{
							document.form.action= "procesa_modal.php";
							document.form.method= "POST";
							document.form.submit(); 
							document.form.enctype="multipart/form-data";  
						} else 
								{
								alert("La direcci\xf3n de email es incorrecta.");
								document.form.email.focus()
								return 0;
								}
	}
</script>
<script>
    $( document ).ready(function() {
       $('#rut').Rut({
	  on_error: function(){ alert('El RUT ingresado es incorrecto'); },
	  format_on: 'keyup'
	});
    });
</script>

<script type="text/javascript">   
    function alpha(e) {
    var k;
    document.all ? k = e.keyCode : k = e.which;
    return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
    }
</script>
<script type="text/javascript">
function validar(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron =/[A-Za-z\s]/; // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
</script>
<script type="text/javascript">
function solonumeros(e) { // 1
    tecla = (document.all) ? e.keyCode : e.which; // 2
    if (tecla==8) return true; // 3
    patron = /\d/;  // 4
    te = String.fromCharCode(tecla); // 5
    return patron.test(te); // 6
} 
</script>
</head>

<body style="height:auto;">
<?php 
		function decode($texto)
		{
				$despues = Array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&agrave;','&egrave;','&igrave;','&ograve;','&ugrave;','&Agrave;','&Egrave;','&Igrave;','&Ograve;','&Ugrave;','&atilde;','&otilde;','&acirc;','&ecirc;','&ecirc;','&ocirc;','&ucirc;','&ccedil;','&uuml;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&Atilde;','&Otilde;','&Acirc;','&Ecirc;','&Icirc;','&Ocirc;','&Ucirc;','&Ccedil;','&Uuml;','&ntilde;','&Ntilde;','&acute;','&prime;','&lsquo;','&rsquo;','&ldquo;','&rdquo;','&bdquo;','&iquest;','&#63;','&copy;','&reg;','&#153;','&ordm;','&deg;','&ordf;','&sect;','&#161;');
				$antes 	 = Array('á','é','í','ó','ú','à','è','ì','ò','ù','À','È','Ì','Ò','Ù','ã','õ','â','ê','î','ô','û','ç','ü','Á','É','Í','Ó','Ú','Ã','Õ','Â','Ê','Î','Ô','Û','Ç','Ü','ñ','Ñ','´','\'','‘','’','“','”','„','¿','?','©','®','™','º','°','ª','§','¡');
				$nuevo 	 = str_replace($antes,$despues,$texto);
				return $nuevo;
		} 
		
		$valores = array_values($_GET);
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
  <div id="content_modal">
  <form name = "form" id='form_1' class='appnitro'  method='post' enctype='multipart/form-data' action='desplieuge.php'>
    <h1 class="title_color_modal">Solicitud de informaci&oacute;n</h1>
    
    <div id="resultado">
	<div class="content_Item_form">
      <label>Nombre*</label>
      <input name="name" id="name" type="text" value="" placeholder="Ingrese Nombre y Apellido" onkeypress="return validar(event)"/>
    </div>
    
    <div class="content_Item_form">
      <label>RUT</label>
      <input name="rut" id="rut" type="text" value="" placeholder="Ingrese RUT sin puntos y sin gui&oacute;n"/>
    </div>
    
    <div class="content_Item_form">
      <label>Tel&eacute;fono</label>
      <input name="telefono" id="telefono" type="text" value="" placeholder="Ingrese tel&eacute;fono" onkeypress="return solonumeros(event)"/>
    </div>
    
    <div class="content_Item_form">
      <label>Celular</label>
      <input name="celular" id="celular" type="text" value="" placeholder="Ingrese celular" onkeypress="return solonumeros(event)"/>
    </div>
    
    <div class="content_Item_form">
      <label>Email*</label>
      <input name="email" id="email" type="text" value="" placeholder="Ingrese email"/>
    </div>
    
    <div class="content_Item_form">
      <label>Mensaje*</label>
      <div class="content_textarea" style="border:1px solid #abaaaa;">
        <textarea name="mensaje" id="mensaje" cols="" rows="">Solicito informaci&oacute;n adicional sobre el veh&iacute;culo <?php echo $marca.' '.$modelo.' '.$año.' kms';?>,  F: 7201106. Para el veh&iacute;culo: http://club.mersap.com/emol_automovil/despliegue.php?id=<?php echo $valores[0];?> Cod Cliente: crlz63</textarea>
      </div>
      <small>*Campos obligatorios</small>
    </div>
		<input name="codigo_emol" type="hidden" value="<?php echo $valores[0];?>"  />
    	<input name="email_concesionario" type="hidden" value="<?php echo $valores[1];?>"  />
    <div class="content_Item_form">
		<input name="enviar" class="btn_Azul" type="button" id="enviar" value="ENVIAR" onclick="procesa($('#name').val(),$('#rut').val(),$('#telefono').val(),$('#celular').val(),$('#email').val(),$('#mensaje').val());">	
	</div>
	 </div>
	</form>
  </div>

</body>
</html>
