<?php

$id_emol = $_POST['id_auto'];
$url = 'http://ailab01.mersap.com/autos/aviso/'.$id_emol;
		$content = file_get_contents($url);
		$json = json_decode($content, true);

		foreach($json['_source'] as $item) 
		{
			$marca              = $item['Marca'];
			$modelo      		= $item['Modelo'];
			$precio       		= $item['precio'];
			$año      	 		= $item['Anno']; 
			$imagen        		= $item['imagen'];
		}	
?>
<li style="height: 49px;border: 1px solid #adacac;width: 282px;margin: 0 0 13px 13px;padding: 8px;float: left;">
          <div class="img_Auto_list"><a href="http://club.mersap.com/emol_automovil_merge/despliegue.php?id=<?php echo $id_emol;?>"><img style="width: 66px;height: 49px;float: left;margin-right: 8px;" src="<?php echo $imagen;?>" alt="Auto" /></a></div>
          <div class="content_Txt_list">
            <strong><?php echo $marca.' '.$modelo;?></strong><br />
            <span>$ <?php echo  number_format($precio, 0, ',', '.');?>  </span><br />
            <?php echo $año ;?>
          </div>
</li>