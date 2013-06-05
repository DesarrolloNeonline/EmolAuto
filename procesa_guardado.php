<?php
function decode($texto)
    {
      $despues = Array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&agrave;','&egrave;','&igrave;','&ograve;','&ugrave;','&Agrave;','&Egrave;','&Igrave;','&Ograve;','&Ugrave;','&atilde;','&otilde;','&acirc;','&ecirc;','&ecirc;','&ocirc;','&ucirc;','&ccedil;','&uuml;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&Atilde;','&Otilde;','&Acirc;','&Ecirc;','&Icirc;','&Ocirc;','&Ucirc;','&Ccedil;','&Uuml;','&ntilde;','&Ntilde;','&acute;','&prime;','&lsquo;','&rsquo;','&ldquo;','&rdquo;','&bdquo;','&iquest;','&#63;','&copy;','&reg;','&#153;','&ordm;','&deg;','&ordf;','&sect;','&#161;');
      $antes   = Array('á','é','í','ó','ú','à','è','ì','ò','ù','À','È','Ì','Ò','Ù','ã','õ','â','ê','î','ô','û','ç','ü','Á','É','Í','Ó','Ú','Ã','Õ','Â','Ê','Î','Ô','Û','Ç','Ü','ñ','Ñ','´','\'','‘','’','“','”','„','¿','?','©','®','™','º','°','ª','§','¡');
      $nuevo   = str_replace($antes,$despues,$texto);
      return $nuevo;
    }

$id_emol = $_POST['id_auto'];
$url = 'http://ailab01.mersap.com/autos/aviso/'.$id_emol;
		$content = file_get_contents($url);
		$json = json_decode($content, true);

		foreach($json['_source'] as $item) 
		{
			$marca            = decode($item['Marca']);
			$modelo      		  = decode($item['Modelo']);
			$precio       		= $item['precio'];
			$anno      	 	    = $item['Anno']; 
			$kms_actuales     = $item['Kilometraje'];
			$transmision      = decode($item['Transmision']);
			$combustible      = decode($item['Combustible']);
			$imagen        		= $item['imagen'];
      $logo_operador    = $item['logo_operador'];
		}	

		if($kms_actuales !="-1" && ($kms_actuales))
        {
          $kms_actuales = number_format($kms_actuales, 0, ',', '.');
          $kms_actuales = str_replace('$','',$kms_actuales);
          $kms_actuales = $kms_actuales.'Kms';

        } else
              {
                $kms_actuales = '';
              }

        if($transmision =="Otro")
        {
          $transmision ='';
        } else
              {
                $transmision = 'T.'.$transmision.'&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;';
              }      


         if($combustible =="Otro")
        {
          $combustible = '';
        } else
              {
                $combustible =  $combustible;
              }

        if($modelo =="Otro")
        {
          $modelo = '';
        } else
              {
                $modelo =  $modelo;
              }


        if($anno =="Otro")
        {
          $anno = '';
        } else
              {
                $anno =  'A&ntilde;o '.$anno.'&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;';
              }

        if($marca =="Otro")
        {
          $marca = '';
        } else
              {
                $marca =  $marca;
              }

        if($precio =="Otro")
        {
          $precio = '';
        } else
              {
                $precio  =  $precio ;
              }
         ?>

<li style="height: auto;border: 1px solid #adacac;width: 602px;margin: 0 0 14px 14px;padding: 8px;float: left;position: relative;list-style: none;">
<?php

  $condicion_img = strrpos($imagen, 'imagen_no_disponible.gif');
  if($condicion_img == false){ ?>
    <div class="img_Auto_list" style="width: 85px;height: auto;float: left;margin-right: 12px;">
    	<a href="http://club.mersap.com/emol_automovil_merge/despliegue.php?id=<?php echo $id_emol;?>">
    		<img style="max-width: 100%;height: auto;border: 0;"src="<?php echo $imagen;?>" alt="Auto" />
    	</a>
    </div>
<?php    
  } else{
        
  } ?>
  
    <div style="float: left;font-size: 13px;color: #000000;line-height: 21px;" class="content_Txt_list">
    <a href="http://club.mersap.com/emol_automovil_merge/despliegue.php?id=<?php echo $id_emol;?>"><strong style="margin-bottom: 3px;"><?php echo  $marca.' '.$modelo;?></strong></a><br /> 
    <span style="font-size: 17px;margin-bottom: 5px;position: absolute;top: 30%;right: 10px;">$ <?php echo  number_format($precio, 0, ',', '.');?> </span>
    <span class="anno" style="font-size: 12px;"><?php echo $anno.$kms_actuales;?></span>
    <span class="anno" style="font-size: 12px;"><?php echo $transmision.$combustible;?></span>
    <div style="display: block; margin-top: 5px; "class="img_Conse_resul"><img src="http://club.mersap.com/emol_automovil_merge/upload/concesionarios/<?php echo $logo_operador;?>"></div> 
  </div>
</li>