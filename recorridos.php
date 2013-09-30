<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>

	<?php
	include_once("includes/header.php"); 
	require("xml/dbinfo.php");

	$linea = $_GET['lin'];
	$s = $_GET['s'];
	$base = $database . "colectivos";
	$tabla = 'Lineas_y_Sentidos';

	$connection=mysql_connect ($host, $username, $password);
	if (!$connection) {
	die('Not connected : ' . mysql_error());
		}

	$db_selected = mysql_select_db($base, $connection);
	if (!$db_selected) {
	die ('Can\'t use db : ' . mysql_error());
		}

	if ($linea)
	{
		if($s=='ida'){ $query = "SELECT Nom_ida AS titulo FROM $tabla WHERE Linea=$linea";}
		         else{ $query = "SELECT Nom_vuelta AS titulo FROM $tabla WHERE Linea=$linea";}

		$result = mysql_query($query);
		if (!$result) {
		die('Invalid query: ' . mysql_error());
			}

		if($row = @mysql_fetch_assoc($result)) {$titulo = $row['titulo'];}
	}
	
	?>
		
		
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="js/responsiveslides.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"> </script>
	<script type="text/javascript" src="lib/libreria.js"></script>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(["_setAccount", "UA-32689978-1"]);
  _gaq.push(["_setDomainName", "quecole.com.ar"]);
  _gaq.push(["_trackPageview"]);

  (function() {
    var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
    ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
  })();

  </script>

	<script type="text/javascript">
	var Url = location.href;
	Url = Url.replace(/.*\?(.*?)/,"$1");
	Variables = Url.split ("&");
	for (i = 0; i < Variables.length; i++) {
       Separ = Variables[i].split("=");
       eval ('var '+Separ[0]+'="'+Separ[1]+'"');
	}

	MostrarRecorrido(lin,s);

	</script>
	
	<!-- boxslider js-->

	<script src="js/bxSlider.min.js" type="text/javascript"></script>
	<link href="css/bxslider.css" rel="stylesheet">
	<script type="text/javascript">
	  $(document).ready(function(){
		
			$('.bxslider').bxSlider({
			  minSlides: 3,
			  maxSlides: 3,
			  auto: true,
			  controls: false,
			  pager: false,
			  slideWidth: 300,
			  slideMargin: 10
			});
	  
	  });
	</script>

	
	


</head>
<body>
	
	<header id="header">
		<?php 
				$active = "recorridos";
				include_once("includes/menu.php");
		?>
	</header>


<div class="container" >		
		<div class="row">
			<div class="span3">
				<h3>Recorridos</h3>
			</div>
			<div class="span9">
			 	<h3><?php if ($linea) {echo ' L&iacute;nea: '.$linea . ' - Sentido: '. $titulo; }
				      else { echo ' Visualice los recorridos en el mapa ';}
					  ?> 
			    </h3>
			</div>
		</div>
		<div class="row">
				
				<div class="span3">
					<div class="accordion stacked2" id="accordion">

						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse1" data-parent="#accordion" data-toggle="collapse">
							  500
							</a>
						  </div>
						  <div id="collapse1" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							  <div><a href="recorridos.php?lin=500&s=ida"> Sesquicentenario - Ing. White</a></div>
							  <div><a href="recorridos.php?lin=500&s=vuelta"> Ing. White - Sesquicentenario</a></div>
							</div>
						  </div>
						</div>

						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse2" data-parent="#accordion" data-toggle="collapse">
							  502
							</a>
						  </div>
						  <div id="collapse2" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							  <div><a href="recorridos.php?lin=502&s=ida">V. Rosas - V. Floresta</a></div>
							  <div><a href="recorridos.php?lin=502&s=vuelta">V. Floresta - V. Rosas</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse3" data-parent="#accordion" data-toggle="collapse">
							  503
							</a>
						  </div>
						  <div id="collapse3" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							  <div><a href="recorridos.php?lin=503&s=ida">Spurr - Wall Mart</a></div>
							  <div><a href="recorridos.php?lin=503&s=vuelta"> Wall Mart - Spurr</a></div>
							</div>
						  </div>
						</div>

						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse4" data-parent="#accordion" data-toggle="collapse">
							  504
							</a>
						  </div>
						  <div id="collapse4" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							  <div><a href="recorridos.php?lin=504&s=ida">Ing. White - Hospital Penna</a></div>
							  <div><a href="recorridos.php?lin=504&s=vuelta">Hospital Penna - Ing. White</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse5" data-parent="#accordion" data-toggle="collapse">
							  505
							</a>
						  </div>
						  <div id="collapse5" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							  <div><a href="recorridos.php?lin=505&s=ida">Rosendo L&oacute;pez - Noroeste</a></div>
							  <div><a href="recorridos.php?lin=505&s=vuelta">Noroeste - Rosendo L&oacute;pez</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse6" data-parent="#accordion" data-toggle="collapse">
							  506
							</a>
						  </div>
						  <div id="collapse6" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							  <div><a href="recorridos.php?lin=506&s=ida">Rosendo L&oacute;pez - 17 de Mayo</a></div>
							  <div><a href="recorridos.php?lin=506&s=vuelta">17 de Mayo - Rosendo L&oacute;pez</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse7" data-parent="#accordion" data-toggle="collapse">
							  507
							</a>
						  </div>
						  <div id="collapse7" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							  <div><a href="recorridos.php?lin=507&s=ida">Villa Hardin Green - Hospital Municipal</a></div>
							  <div><a href="recorridos.php?lin=507&s=vuelta">Hospital Municipal - Villa Hardin Green</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse8" data-parent="#accordion" data-toggle="collapse">
							  509
							</a>
						  </div>
						  <div id="collapse8" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							   <div><a href="recorridos.php?lin=509&s=ida">Pq. de la ciudad - Bella Vista</a></div>
							  <div><a href="recorridos.php?lin=509&s=vuelta">Bella Vista - Pq. de la ciudad</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse9" data-parent="#accordion" data-toggle="collapse">
							  512
							</a>
						  </div>
						  <div id="collapse9" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							   <div><a href="recorridos.php?lin=512&s=ida">Pq. de la ciudad - B. 5 de Abril</a></div>
							  <div><a href="recorridos.php?lin=512&s=vuelta">B. 5 de Abril - Pq. de la ciudad</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse10" data-parent="#accordion" data-toggle="collapse">
							  513
							</a>
						  </div>
						  <div id="collapse10" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							   <div><a href="recorridos.php?lin=513&s=ida">Pq. de la ciudad - V. Don Bosco</a></div>
							  <div><a href="recorridos.php?lin=513&s=vuelta">V. Don Bosco - Pq. de la ciudad</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse11" data-parent="#accordion" data-toggle="collapse">
							  514
							</a>
						  </div>
						  <div id="collapse11" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							   <div><a href="recorridos.php?lin=514&s=ida">Coca Cola - Maldonado</a></div>
							  <div><a href="recorridos.php?lin=514&s=vuelta">Maldonado - Coca Cola</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse12" data-parent="#accordion" data-toggle="collapse">
							  516
							</a>
						  </div>
						  <div id="collapse12" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							   <div><a href="recorridos.php?lin=516&s=ida">Newton - Panam&aacute; al 3500</a></div>
							  <div><a href="recorridos.php?lin=516&s=vuelta">Panam&aacute; al 3500 - Newton</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse13" data-parent="#accordion" data-toggle="collapse">
							  517
							</a>
						  </div>
						  <div id="collapse13" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							   <div><a href="recorridos.php?lin=517&s=ida">Pq. de la ciudad - Espora</a></div>
							  <div><a href="recorridos.php?lin=517&s=vuelta">Espora - Pq. de la ciudad</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse14" data-parent="#accordion" data-toggle="collapse">
							  518
							</a>
						  </div>
						  <div id="collapse14" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							   <div><a href="recorridos.php?lin=518&s=ida">Spurr - Hospital Municipal</a></div>
							  <div><a href="recorridos.php?lin=518&s=vuelta">Hospital Municipal- Spurr</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse15" data-parent="#accordion" data-toggle="collapse">
							  519
							</a>
						  </div>
						  <div id="collapse15" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							   <div><a href="recorridos.php?lin=519&s=ida">Bah&iacute;a Blanca - Cerri</a></div>
							  <div><a href="recorridos.php?lin=519&s=vuelta">Cerri - Bah&iacute;a Blanca</a></div>
							</div>
						  </div>
						</div>
						
						<div class="accordion-group">
						  <div class="accordion-heading">
							<a class="accordion-toggle" href="#collapse16" data-parent="#accordion" data-toggle="collapse">
							  519A
							</a>
						  </div>
						  <div id="collapse16" class="accordion-body collapse" style="height: 0px;">
							<div class="accordion-inner">
							   <div><a href="recorridos.php?lin=519A&s=ida">Predio Plaza - Patagonia</a></div>
							  <div><a href="recorridos.php?lin=519A&s=vuelta">Patagonia - Predio Plaza</a></div>
							</div>
						  </div>
						</div>

					</div>
				</div>
					
				<div class="span9">
				 <div id="mapa" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" ></div>
				 <div class="sombra-mapa"></div>
					
				</div>
			</div>
			
			
		</div>


<div class="container">

	<div class="row" >

		<div class="span12">
			
			<?php include_once("includes/pubs-horizontales.php"); ?>
			
		</div>
		
	</div>
	<!-- end .row -->

	</div>
	<hr />
	
	<div class="container">

	<div class="row" id="portfolio">
		<?php include_once("includes/bloques-abajo.php"); ?>
	</div>	

	</div>


	<!-- Footer
	================================================== -->

	<footer id="footer">
		<?php include_once("includes/footer.php"); ?>
	</footer><!-- end #footer -->

	<footer id="copyright">
		<?php include_once("includes/pie-gral.php"); ?>
	</footer><!-- end #footer-extra -->


	<!-- Javascript - Placed at the end of the document so the pages load faster 
	================================================== -->

	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
	<script type="text/javascript" src="js/jquery.hotkeys.min.js" charset='utf-8'></script>
	<script type="text/javascript" src="js/functions.js"></script>
	<script type="text/javascript">
		var latlong = new google.maps.LatLng(-38.71900114221921,-62.26432800292969);
		var opciones = { zoom: 13,
						 center: latlong,
						 mapTypeId: google.maps.MapTypeId.ROADMAP
						 };
		var map = new google.maps.Map(document.getElementById("mapa"), opciones);
	</script>
</body>
</html>		