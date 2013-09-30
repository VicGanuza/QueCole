!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html class="not-ie" lang="en"> <!--<![endif]-->
<head>

	<?php include_once("includes/header.php"); ?>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/jquery.qtip-1.0.0-rc3.min.js"></script>
	
	<script src="js/responsiveslides.min.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"> </script>
	<script type="text/javascript" src="lib/libreria.js"></script>
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			$("#publicidades").responsiveSlides({
				auto: true,
				pager: false,
				timeout: 4000,
				nav: true,
				speed: 500,
				namespace: "centered-btns"
			});

		});

		// Create the tooltips only on document load
	/*	$(document).ready(function() 
		{
		   // By suppling no content attribute, the library uses each elements title attribute by default
		   $('.container.span4.h3').qtip({
			  // Simply use an HTML img tag within the HTML string
			  content: 'let´s see'
		   });
		});*/

		$(document).ready(function(){
    $('div.span4').qtip({
        content: 'This is the tooltip',
        show: {
            when: false, // Don't specify a show event
            ready: true // Show the tooltip when ready
        },
        hide: false // Don't specify a hide event
    })
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
							<img src="publicidades/CabTemporada.jpg" alt="Cabañas Temporada" title="Cabañas Temporada" />
						</a>
					</li>
				  <li>
						<a href="http://www.estudiosarasa.com" target="_blank">
							<img src="publicidades/sarasa-main.jpg" alt="Estudio Sarasa - Web & Software!" title="Estudio Sarasa - Web & Software!" />
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
						<th>Próximos arrivos</th>
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

	<hr />

	<div class="row" id="portfolio">
		<?php include_once("includes/bloques-abajo.php"); ?>
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