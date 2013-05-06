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
<!--<tbody><tr><td width="599" height="74" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#EAF3F7"><tbody><tr><td width="472" height="6"></td><td width="125"></td><td width="2"></td></tr><tr><td height="61" valign="top"><table width="100%" border="0" cellpadding="1" cellspacing="0"><tbody><tr><td width="2" height="61"></td><td width="455" valign="top"><span><font face="Arial, Helvetica, sans-serif"><span><font face="Arial, Helvetica, sans-serif" size="2">Toyota, Yaris, 2009, Sport XLi 1.3, $ 4.990.000, . F: <a href="tel:6006005200" value="+566006005200" target="_blank">6006005200</a> <a href="mailto:alexis.orellana@indumotora.cl" target="_blank">alexis.orellana@indumotora.cl</a> Cod. Emol: 16758634<br></font></span><font face="Arial, Helvetica, sans-serif" size="1">Publicado: 13/04/2013</font></font></span></td><td width="10"></td></tr></tbody></table></td><td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0"><tbody><tr><td width="8" height="60"></td><td width="80" valign="top"><a href="http://automoviles.emol.com/Ficha/Usado/Toyota/Yaris/Sport%20XLi%201.3/16758634" target="_blank"><img src="http://imgclasificados.emol.com/79567420_3/116/F23824216972257191231512283323520217069116.jpg" width="80" height="60"></a></td><td width="38"></td></tr><tr><td height="1"></td><td></td><td></td></tr></tbody></table></td><td>&nbsp;</td></tr><tr><td height="5"></td><td></td><td></td></tr></tbody></table></td></tr>!-->