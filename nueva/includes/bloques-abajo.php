		<?php if (($active == "recorridos" || $active == "paradas") && ($active != "home"))  { ?>
			
		<article class="span4 project zoom">
			<div class="thumbnail">
				<a href="contacto.php" title="">
					<img alt="" src="img/contactanos.jpg" />
				</a>
				<div class="project-description">
					<div class="icon-recorridos"></div>
					<b class="project-name">Pongase en contacto con nosotros!</b>
				</div>
				<!-- ribbon 
				<div class="ribbon"><span>Awarded</span></div> -->
			</div>
		</article>
		
		<?php } ?>
		
		<?php if ((($active == "recorridos") && ($active != "home")) || ($active == "home")) { ?>
				
			<article class="span4 project zoom">
			<div class="thumbnail">
				<a href="paradas.php" title="">
					<img alt="img/paradas.jpg" src="img/paradas.jpg" />
				</a>
				<a href="#"></a>
				<div class="project-description">
					<div class="icon-paradas"></div>
					<b class="name">Mira cuales son las paradas!</b>
				</div>
			</div>
		</article>
		
		<?php } ?>
		
		
		<?php if ((($active == "paradas") && ($active != "home"))  || ($active == "home")) { ?>

			<article class="span4 project zoom">
				<div class="thumbnail">	
					<a href="recorridos.php" title="">
						<img alt="" src="img/recorridos.jpg" />
					</a>	<!-- description -->
					<div class="project-description">		
						<div class="icon-recorridos"></div>
						<b class="project-name">Conoce los recorridos actuales!</b>
					</div>
					<!-- ribbon 
					<div class="ribbon"><span>Awarded</span></div> -->
				</div>
			</article>
			
		<?php } ?>

				
		<article class="span4 project">
			<div class="thumbnail">
				
					<div style="border: none;" class="fb-like-box" data-href="http://www.facebook.com/pages/Que-Cole/454207637957939" data-width="298" data-height="186" data-show-faces="true" data-stream="false" data-header="false" border="0"></div>
				
				<div class="project-description">
					<div class="icon-facebook"></div>
					<b class="name">Seguinos en Facebook!</b>
				</div>
			</div>
		</article>
