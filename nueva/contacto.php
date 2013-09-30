<?php 

	if(isset($_POST['send'])){
		//enviamos el mail
		$para = "consultas@quecole.com.ar";
		$de = "Consulta desde Que Cole!";
		
		$headers = 'From: '. $_POST['correo'] ."\r\n" .
		"Content-type: text/plain; charset=utf-8\r\n".
		'Reply-To: ' . $_POST['correo'] . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		
		
		
		$cuerpo = "De: ".$_POST['nombre'] ." ";

		$asunto = "";	
		switch ($_POST['asunto']) {
			case "1": $asunto = "Consulta";
					break;
			case "2": $asunto = "Por Publicidad";
					break;
			case "3": $asunto = "Sugerencia";
					break;
		}
		
		$cuerpo = $cuerpo."\nAsunto: ". $asunto;
				
		$cuerpo = $cuerpo."\nE-Mail: ".$_POST['correo'];
		$cuerpo = $cuerpo."\nMensaje: ".$_POST['mensaje'];
		
		//envio el mail
		if (mail($para,$de,$cuerpo, $headers)){
			$msg_mail_ok = "Mensaje enviado. Gracias!";
		}
		else{
			$msg_mail_error = "Su mensaje NO ha sido enviado. Inténtelo nuevamente.";
		}
	}
?>


<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>
	
	<?php include_once("includes/header.php"); ?>

	<link rel="stylesheet" type="text/css" href="js/messages/messages.css" />
	<script type="text/javascript" src="js/messages/messages.js"></script>
	<script type="text/javascript" charset="utf-8">
		function validar(form){
			var name = form.nombre.value;
			var email = form.email.value;
			var mensaje = form.mensaje.value;
			var filter = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
				if (name==""){
					inlineMsg('nombre','Debe ingresar un nombre!',7);
					return false;
				}
				else if (email==""){
					inlineMsg('email','Debe ingresar un e-mail!',7);
					return false;
				}
				else if (!filter.test(email)) {
					inlineMsg('email','E-mail incorrecto!',7);
					return false;
				}
				else if (mensaje==""){
					inlineMsg('mensaje','Debe ingresar un mensaje!',7);
					return false;
				}
				return true;
			}
		 </script>
	
</head>

<body>
	<header id="header">
		<?php 
				$active = "contacto";
				include_once("includes/menu.php");
		?>
	</header>
	
	<!-- Content	================================================== -->	
	<section id="content" class="container">	
		<div class="hero-unit">		
			 <img class="bus_contact" src="img/retro_bus.png" />
			<img id="map-shadow" src="img/shadow.png" />	
		</div>		
		
		<div class="row">		
			<div class="span4 offset1">			
				<h3>Siganos!</h3>			<br />			<p class="active lead">		
					<a class="social-network facebook" href="http://www.facebook.com/quecole.com.ar" target="_blank"></a> &nbsp;				
					<a class="social-network twitter" href="http://twitter.com/Que_Cole" target="_blank"></a> &nbsp;		
				</p>			
				<?php 
				/* <br />			
								<h3>Somos</h3>		
				<p class="lead">				Bahia Blanca <br />				Argentina <br />							
				</p> */ ?>	
			</div>		
		
			<div class="span6 pull1">			
				<h3>Escribanos!</h3><br />				
						
				<form  class="row"  method="post" action="contacto.php" onsubmit="return validar(this);">			
					<div class="span3">		
					<label>Nombre y Apellido</label>					
					<input type="text" name="nombre" id="nombre" class="required" placeholder="Su Nombre y apellido" />			
					</div>				
					<div class="span3">			
						<label>E-mail</label>			
							<input type="email" class="required" id="email" name="correo" placeholder="@" />
					</div>					
					<div class="span6" style="margin: 0 0 7px 21px;">	
							<label>Asunto</label>
							<select name="asunto" class="span6" style="padding: 4px 5px 3px 3px;">
								<option value="1">Consulta</option>
								<option value="2">Por publicidad</option>
								<option value="3">Sugerencia</option>
							</select>
					</div>					
					<div class="span6">	
						<label>Mensaje</label>				
						<textarea id="mensaje" class="required" name="mensaje" style="width:450px; resize: none;" rows="4" placeholder="Dejenos su mensaje, sugerencia o consulta!"></textarea>			
						<p>						
							<input type="submit"  name="send" class="button yellow fr">&nbsp;<i class="icon-chevron-right"></i></input>		
						</p>				
					</div>				
				</form>		
			</div>	
		</div>	
	</section>	
	
	
	
	<footer id="footer">
		<?php include_once("includes/footer.php"); ?>
	</footer><!-- end #footer -->

	<footer id="copyright">
		<?php include_once("includes/pie-gral.php"); ?>
	</footer><!-- end #footer-extra -->
		<!-- Javascript - Placed at the end of the document so the pages load faster 	================================================== -->
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/jquery.isotope.min.js"></script>	
		<script type="text/javascript" src="js/jquery.hotkeys.min.js" charset='utf-8'></script>	
		<script type="text/javascript" src="js/functions.js"></script>
</body>

</html>		