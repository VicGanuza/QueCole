<?php
include ('lib/lib.php');

print ContactoInic();

if (!$HTTP_POST_VARS){ 
   print FormularioConsulta();
}else{ 
   	//Estoy recibiendo el formulario, compongo el cuerpo 

	$nombre = $HTTP_POST_VARS["nombre"];
	$apellido = $HTTP_POST_VARS["apellido"];
	$mail = $HTTP_POST_VARS["email"];
	$asunto = $HTTP_POST_VARS["titulo"];
	$consulta = $HTTP_POST_VARS["consulta"];

	if ($nombre || $apellido || $mail || $asunto || $consulta) 
   {

   	$cuerpo = "Formulario enviado\n"; 
   	$cuerpo .= "Nombre y Apellido: " . $HTTP_POST_VARS["nombre"] . " " . $HTTP_POST_VARS["apellido"] ."\n"; 
   	$cuerpo .= "Email: " . $HTTP_POST_VARS["email"] . "\n"; 
	$cuerpo .= "Asunto: " . $HTTP_POST_VARS["titulo"] . "\n"; 
   	$cuerpo .= "Comentarios: " . $HTTP_POST_VARS["consulta"] . "\n"; 

   	//mando el correo... 
   	mail("consultas@quecole.com.ar","Formulario recibido",$cuerpo); 
	
   	//doy las gracias por el envío 
   	print FormularioConsulta(); 
	}
	else {echo 'Complete los campos requeridos'; 
	print FormularioConsulta();}
}  

print ContactoFinal();
?>