<?php 

$email =   trim($_POST['email']);
$div_autos =   $_POST['div_autos'];
$contenido = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Emol Propiedades</title>
</head>
<body style="background: #f4f6f5;   font: normal small Arial, Helvetica, sans-serif; margin:0; padding:0">
<table width="602" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td>
      <table border="0" align="center" cellpadding="0" cellspacing="0" id="table27" width="602" height="65">
        <tr>
          <td style="font-size:10px;color:#666666;font-family:verdana;text-decoration:none;line-height:12px;">
            <div style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#333333; text-align: center;">Si no puedes ver correctamente este e-mail, entra aqu&iacute; a la <a href="http://vivedescuentos.us2.list-manage.com/track/click?u=a9a36829e777f003dd763ed26&id=dbe6310e50&e=41536289e6" target="_blank" style="color:#5283d9">versi&oacute;n online</a></div>
            <div style="font-family: Arial, Helvetica, sans-serif; font-size: 11px; color: #333333; text-align: center;">Agrega newsletter@propiedades.emol.com a tus direcciones de contacto para recibir las nuevas propiedades</div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td style="border:1px solid #a6a4a4; background-color:#FFFFFF; width:560px; padding:0px 20px 20px;" valign="top">
      <table align="center" width="560" cellspacing="0" cellpadding="0" border="0">
        <tr>
          <td align="left" height="80" style="padding:7px 0;"><img width="113" height="59" src="http://club.mersap.com/emol_automovil_merge/img/Logo.jpg"></td>
        </tr>
        <tr>
          <td style="border-top:2px solid #1952b4; padding-top:10px;">
            <table align="center" width="560" cellspacing="0" cellpadding="0" border="0">
              <tr>
                <td>
                  <h1 style="font-family:Arial, Helvetica, sans-serif; font-size:21px; color:#444444; font-weight:normal; margin:0">Veh&iacute;culos seleccionados</h1>    
                </td>
              </tr>
                </tbody>
            </table>  
        </td>
    </tr>  
</table>
         <div id="content_List_selected" style="width: auto;float: left;text-align: left;">'.$div_autos.'</div>
</td>
        
    </td>
  </tr>
  <tr>
    <td>
      <table width="602" border="0" align="center" cellpadding="0" cellspacing="0" height="80">
        <tr>
          <td width="602" align="center" valign="middle" style="color:#000000"><span style="font-family:Arial, Helvetica, sans-serif; font-size:11px; line-height:16px; text-align: center;">
            Enviado a:  '.$email.'<br />
            <a href="http://vivedescuentos.us2.list-manage.com/about?u=a9a36829e777f003dd763ed26&id=779a64958d&e=41536289e6&c=0d71dc68c8" style="color:#5283d9">&iquest;Por qu&eacute; me lleg&oacute; esto?</a> | 
            <a href="http://vivedescuentos.us2.list-manage.com/unsubscribe?u=a9a36829e777f003dd763ed26&id=779a64958d&e=41536289e6&c=0d71dc68c8" style="color:#5283d9">Anular mi suscripci&oacute;n a esta lista</a> | <a href="http://vivedescuentos.us2.list-manage.com/profile?u=a9a36829e777f003dd763ed26&id=779a64958d&e=41536289e6" style="color:#5283d9">Actualizar datos de suscripci&oacute;n</a><br />
            Propiedades.emol.com &middot; Santa Mar&iacute;a 5542 &middot; Santiago .</span>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>     
</html>';

$fecha = date("Y-m-d");
$para =  $email;
$asunto = "EMOL Automóvil - Información de Vehículos [".$fecha."]";
$email_server = 'automoviles@emolautomovil.cl';
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'From:'.$email_server.' ' . "\r\n" .
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

mail($para, $asunto, $contenido, $cabeceras);
?>