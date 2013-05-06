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
  <script>
  function procesa()
  {
	document.form.action= "modal-mas-info.php";
	document.form.method= "POST";
	document.form.submit(); 
	document.form.enctype="multipart/form-data"; 
  }
  </script>
  </head>

<body style="height:auto;">
<?php
include('connect.php');

$sql_max_id = "select max(id_solicitud) from solicitudes";
$max_id = mysql_query($sql_max_id);
$array_max_id = mysql_fetch_array($max_id);
$id_solicitud= $array_max_id[0];

$sql_solicitud = "select nombre, rut, telefono, celular, email, mensaje from solicitudes where id_solicitud = '$id_solicitud'";
$solicitud = mysql_query($sql_solicitud);
$array_solicitud = mysql_fetch_array($solicitud);
$name = $array_solicitud[0];
$rut = $array_solicitud[1];
$telefono = $array_solicitud[2];
$celular = $array_solicitud[3];
$email = $array_solicitud[4];
$mensaje = $array_solicitud[5];
?>

<div id="content_modal">
  <form name = "form" id='form_1' class='appnitro'  method='post' enctype='multipart/form-data' action='desplieuge.php'>
    <h1 class="title_color_modal">Solicitud de informaci&oacute;n</h1>
    
    <div id="resultado">
	<div class="content_Item_form">
      <label>Nombre*</label>
      <?php echo $name;?>
    </div>
    
    <div class="content_Item_form">
      <label>RUT*</label>
      <?php echo $rut;?>
    </div>
    
    <div class="content_Item_form">
      <label>Tel&eacute;fono*</label>
      <?php echo $telefono;?>
    </div>
    
    <div class="content_Item_form">
      <label>Celular</label>
      <?php echo $celular;?>
    </div>
    
    <div class="content_Item_form">
      <label>Email*</label>
      <?php echo $email;?>
    </div>
    
    <div class="content_Item_form">
      <label>Detalle de Email*</label>
      <div class="content_textarea">
        <?php echo $mensaje;?>
      </div>
    </div>
    
    <div class="content_Item_form">
		<input name="enviar" style="width: 155px;height: 40px;background: red;border: none; color: #fff;font-family: Arial, Helvetica, sans-serif;" class= "btn btn-success" type="button" class="BUTTON" id="enviar" value="ENVIAR OTRA CONSULTA" onclick="procesa();">	
	</div>
	 </div>
	</form>
  </div>
 <?php 
 mysql_close($conn);
 ?>
</body>
</html>
