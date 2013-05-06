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
				if (document.form.rut.value.length==0)
				{
					alert("Ingrese su RUT")
					document.form.rut.focus()
					return 0;
				} 
				if (document.form.telefono.value.length==0)
				{
					alert("Ingrese su telefono")
					document.form.telefono.focus()
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
							document.form.action= "procesa_modal_concesionario.php";
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
    patron =/[A-Za-zñÑ\s]/; // 4
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
  <div id="content_modal">
  <form name = "form" id='form_1' class='appnitro'  method='post' enctype='multipart/form-data' >
    <h1 class="title_color_modal">Solicitud de informaci&oacute;n</h1>
    
    <div id="resultado">
	<div class="content_Item_form">
      <label>Nombre*</label>
      <input name="name" id="name" type="text" value="" placeholder="Ingrese Nombre y Apellido" style="line-height: 22px;" onkeypress="return validar(event)"/>
    </div>
    
    <div class="content_Item_form">
      <label>RUT*</label>
      <input name="rut" id="rut" type="text" value="" placeholder="Ingrese RUT sin puntos y sin gui&oacute;n" style="line-height: 22px;"/>
    </div>
    
    <div class="content_Item_form">
      <label>Tel&eacute;fono*</label>
      <input name="telefono" id="telefono" type="text" value="" placeholder="Ingrese tel&eacute;fono" style="line-height: 22px;" onkeypress="return solonumeros(event)"/>
    </div>
    
    <div class="content_Item_form">
      <label>Celular</label>
      <input name="celular" id="celular" type="text" value="" placeholder="Ingrese celular" style="line-height: 22px;" onkeypress="return solonumeros(event)"/>
    </div>
    
    <div class="content_Item_form">
      <label>Email*</label>
      <input name="email" id="email" type="text" value="" placeholder="Ingrese email" style="line-height: 22px;"/>
    </div>
    
    <div class="content_Item_form">
      <label>Detalle de Email*</label>
      <div class="content_textarea" style="border:1px solid #abaaaa;">
        <textarea name="mensaje" id="mensaje" cols="" rows=""></textarea>
      </div>
      <small>*Campos obligatorios</small>
    </div>
    
    <div class="content_Item_form">
		<input name="enviar" style="width: 100px;height: 40px;background: red;border: none; color: #fff;font-family: Arial, Helvetica, sans-serif;" class= "btn btn-success" type="button" class="BUTTON" id="enviar" value="ENVIAR" onclick="procesa($('#name').val(),$('#rut').val(),$('#telefono').val(),$('#celular').val(),$('#email').val(),$('#mensaje').val());">	
	</div>
	 </div>
	</form>
  </div>

</body>
</html>
