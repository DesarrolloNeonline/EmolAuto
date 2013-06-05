  <?php 
      $url_autos = 'http://ailab01.mersap.com/automoviles/mmp/1';
      $content_autos = file_get_contents($url_autos);
      $json_autos = json_decode($content_autos, true);
      $hits_autos = $json_autos["_source"]["mmp"];
      var_dump($hits_autos);

 foreach($hits_autos['lista'] as $item) 
 {
      $marca          = $item['marca'];
      $modelo         = $item['modelo'];
      $count          = $item['count'];

      echo  $marca.$modelo.$count;
      
 }

echo  'hola'.$marca.$modelo.$count;
 ?>