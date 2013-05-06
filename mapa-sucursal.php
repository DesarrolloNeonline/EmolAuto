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
  <script src="http://apps.emol.com/widgets/mapas/v3/xygo.min.js"></script>
  
</head>

<body style="border:none;">
  
  <div id="content_modal_mapa">
    <?php 
    $valores = array_values($_GET);
    $nombre_concesionario = $valores[0];
    $lat = $valores[1];
    $lon = $valores[2];
 ?>
 <div id="map" style="max-width: 297px;height: 250px;"></div>
  
        <script>
          
          var map = new XYGO.Map('map')
          var concesionario = '<?php echo $nombre_concesionario?>'
          var latitud = '<?php echo $lat?>'
          var longitud = '<?php echo $lon?>'

          var ubicacion = new L.LatLng(latitud, longitud)        
          
          map.setCenter(ubicacion, 15);
          map.addMarker(ubicacion, concesionario, { open: true })

        </script>  
  </div>

</body>
</html>
