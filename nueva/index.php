<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>

	<?php include_once("includes/header.php"); ?>
	
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
		$(document).ready(function() {
			$("#publicidades").responsiveSlides({
				auto: true,
				pager: false,
				timeout: 10000,
				nav: true,
				speed: 1000,
				namespace: "centered-btns"
			});

		});
	</script>
	
	
</head>
<body onload="initialize()">

	
	<header id="header">
		<?php
			$active = "home";
			include_once("includes/menu.php");
		?>
	</header>




	<div class="container"  style="margin-bottom: 5px;">		
			
			<div class="row">
				<div class="span8 borde-abajo">
					<h3>Ingresa tus datos para ver que cole tomar</h3>	
					<div class="box-fondo">
							
								<form class="formulario" name="formulario">
									<div class="donde-estas">
										<div class="cuad-izq">
											<span class="num">1</span>
										</div>
										
										<div class="cuad-der">
											<h5>Dónde estás?</h5>
											<input type="text" id="direOrigen">
										</div>
									</div>
									
									<div class="donde-vas">
										<div class="cuad-izq">
											<span class="num">2</span>
										</div>
										<div class="cuad-der">
											<h5>A dónde vas?</h5>
											<input type="text" id="direDest"> 
										</div>
									</div>
									
									<div class="cuadras">
										<div class="cuad-izq">
											<span class="num">3</span>
										</div>
										<div class="cuad-der">
											<h5>Cuadras a la parada</h5>
											<input type="text" id="cantCuad" size="1">
										</div>
								  </div>
								  
								  <input type="button" onClick="BuscarLocaciones()" class="button blue casero" value="Consultar"/> 
								  <div class="opcional2"></div>
								</form> 	
								
								<div class="derecha">
										<div class="opcional"></div>
								</div>
								
							
					</div>			
				</div>
				
				<div class="span4">
					<h3>Auspiciantes</h3>	
					<ul class="rslides" id="publicidades">
					  <li>
							<a href="http://temporada-sma.com.ar/" target="_blank">
								<img src="publicidades/Publicite-aqui-Grande-Medidas.jpg" alt="Publicite Aquí"/>
							</a>
						</li>
					</ul>
					<div class="anuncie">
						<a class="anuncie-aqui" href="#bla">Anuncie Aquí</a>
						<div class="gadget"></div>
					</div>
					
						
				</div>
				
			</div>

	</div>
	<div class="container">
	 	<div class="row">
			<div class="span8">
				 <div id="mapa" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" >
				 </div>
				 <div class="sombra-mapa"></div>
				 <!-- img src="mapa.jpg" -->
				 <table class="stacked">
					<thead>
						<tr>
							<th>Línea</th>
							<th>Próximos arribos</th>
							<th>Tiempo estimado (aprox)</th>
						</tr>
					</thead>
					<tbody id="HorariosParadas">
					</tbody>
		 		</table>
		 		<table class="stacked1">
					<thead>
						<tr>
							<th>Opción</th>
							<th>Ver en Mapa</th>
						</tr>
					</thead>
					<tbody id="VerHorarios">
					</tbody>
				</table>
			</div>
			<div class="span4">
				<?php include_once("includes/pubs-laterales.php"); ?>
			</div>
		</div>
		<!-- end .row -->
		<hr/>
		<div class="row" id="portfolio">
			<?php include_once("includes/bloques-abajo.php"); ?>
		</div>	
		<div class="banner_pie">
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-2637818123363245";
				/* Banner Pie Pagina */
				google_ad_slot = "3686586008";
				google_ad_width = 728;
				google_ad_height = 90;
				//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</div>
		<div class="banner_pie_celu">
			<script type="text/javascript"><!--
				google_ad_client = "ca-pub-2637818123363245";
				/* banner_celu */
				google_ad_slot = "9277291209";
				google_ad_width = 320;
				google_ad_height = 50;
				//-->
			</script>
			<script type="text/javascript"
			src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
			</script>
		</div>
	</div>

	<footer id="footer">
		<?php include_once("includes/footer.php"); ?>
	</footer>

	<footer id="copyright">
		<?php include_once("includes/pie-gral.php"); ?>
	</footer>



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