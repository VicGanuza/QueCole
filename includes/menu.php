<nav class="navbar">
	<div class="navbar-inner">
		<div class="container">
			<!-- Logo -->
			<a class="brand" href="index.php">
				<img src="img/logo.png"  alt="Que Cole!" title="Que Cole!" />
			</a>
			<ul class="nav">
				<li <?php if ($active == "home") { echo "class=\"active\""; } ?>><a href="index.php">Inicio</a></li>
				<li <?php if ($active == "recorridos") { echo "class=\"active\""; } ?>><a href="recorridos.php">Recorridos</a></li>
				<li <?php if ($active == "paradas") { echo "class=\"active\""; } ?>><a href="paradas.php">Paradas</a></li>
				
				<?php /*<li class="dropdown">
					<a href="components.html">Features</a>
					<!-- Dropdown menu -->
					<ul>
						<li><a href="components.html" title="">Components</a></li>
						<li><a href="grid.html" title="">Grid</a></li>
						<li><a href="icons.html" title="">Icons</a></li>
						<li><a href="home-variant-1.html" title="">Homepage variant #1</a></li>
						<li><a href="home-variant-2.html" title="">Homepage variant #2</a></li>
					</ul>
				</li> */ ?>
				<li <?php if ($active == "contacto") { echo "class=\"active\""; } ?>><a href="contacto.php">Contacto</a></li>
			</ul>
		</div>
	</div>
</nav>