<html>
<head>
<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=./modal-mas-complete.php">
</head>
<body>
<?php
include('connect.php');
function decode($texto)
{
	$despues = Array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&agrave;','&egrave;','&igrave;','&ograve;','&ugrave;','&Agrave;','&Egrave;','&Igrave;','&Ograve;','&Ugrave;','&atilde;','&otilde;','&acirc;','&ecirc;','&ecirc;','&ocirc;','&ucirc;','&ccedil;','&uuml;','&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;','&Atilde;','&Otilde;','&Acirc;','&Ecirc;','&Icirc;','&Ocirc;','&Ucirc;','&Ccedil;','&Uuml;','&ntilde;','&Ntilde;','&acute;','&prime;','&lsquo;','&rsquo;','&ldquo;','&rdquo;','&bdquo;','&iquest;','&#63;','&copy;','&reg;','&#153;','&ordm;','&deg;','&ordf;','&sect;','&#161;');
	$antes 	 = Array('á','é','í','ó','ú','à','è','ì','ò','ù','À','È','Ì','Ò','Ù','ã','õ','â','ê','î','ô','û','ç','ü','Á','É','Í','Ó','Ú','Ã','Õ','Â','Ê','Î','Ô','Û','Ç','Ü','ñ','Ñ','´','\'','‘','’','“','”','„','¿','?','©','®','™','º','°','ª','§','¡');
	$nuevo 	 = str_replace($antes,$despues,$texto);
	return $nuevo;
} 

$name = decode($_POST['name']);
$rut =   $_POST['rut'];
$telefono =$_POST['telefono'];
$celular= $_POST['celular'];
$email = $_POST['email'];
$mensaje = decode($_POST['mensaje']);
$date   = date('Y-m-d');
$codigo_emol = $_POST['codigo_emol'];

echo name.$rut.$telefono.$celular.$email.$mensaje.$date;

$sql1 = "insert into automoviles.solicitudes (id_solicitud, nombre, rut, telefono, celular, email, mensaje, fecha, codigo_emol)values('', '$name', '$rut', 
	'$telefono', '$celular', '$email', '$mensaje', 
	DATE_FORMAT('".$date."','%Y-%m-%d'),$codigo_emol)";
mysql_query($sql1);	
				
$para =  $email;
$asunto = "Solicitar informacion de auto";
$email_server = 'matias.salvadores@gmail.com';
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'From:'.$email_server.' ' . "\r\n" .
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

mail($para, $asunto, $mensaje, $cabeceras); ?>

echo "El correo se ha registrado con &eacute;xito."; 
 mysql_close($conn);
?>
</body>
</html>