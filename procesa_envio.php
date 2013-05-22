<?php 

$email =   trim($_POST['email']);
$div_autos =   $_POST['div_autos'];
$contenido = '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>
<table style="display:inline-table" border="0" cellpadding="0" cellspacing="0" width="740" align="center">
    <tbody><tr>
        <td width="6" height="14"></td>
        <td width="4"></td>
        <td width="599"></td>
        <td width="5"></td>
        <td width="13"></td>
    </tr>
    <tr>
        <td height="50"></td>
        <td colspan="3" valign="top">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FF0000">
                 
                <tbody><tr>
                    <td width="17" height="5"></td>
                    <td width="84"></td>
                    <td width="65"></td>
                    <td width="301"></td>
                    <td width="141"></td>
                </tr>
                <tr>
                    <td height="9"></td>
                    <td rowspan="3" valign="top"><img src="http://automoviles.emol.com/img/logo.png" width="84" height="43"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td height="21"></td>
                    <td></td>
                    <td valign="top"><span>Veh&iacute;culos Seleccionados</span></td>
                    <td></td>
                </tr>
                </tbody>
            </table>  
        </td>
    </tr>  
</table>
         <div id="content_List_selected" style="width: auto;float: left;text-align: left;">'.$div_autos.'</div>
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