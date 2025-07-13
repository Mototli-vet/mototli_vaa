<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0" />
	<title>MOTOTLI</title>
	<link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url('css/style.css') ?>" />
	<!-- Font Awesome para los iconos, puedes mantenerlo o usar los de Bootstrap -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<header>
		<div class="container-hero">
			<div class="container hero">
				<div class="customer-support">
					<i class="fa-solid fa-headset"></i>
					<div class="content-customer-support">
						<span class="text">Soporte al cliente</span>
						<span class="number">5612607540</span>
					</div>
				</div>

				<div>
					<!-- Nota: La unidad 'ren' no es válida en CSS. Probablemente querías usar 'rem' o 'px'. La he cambiado a 'px'. -->
					<center>
						<h2><img src="<?= base_url('img/silueta2.jpg') ?>" width="50px" height="50px" />MOTOTLI<img src="<?= base_url('img/SILUETA1.jpg') ?>" width="50px" height="50px" /></h2>
					</center>
				</div>

				<div class="container-user">

					<div class="content-shopping-cart">

						<span class="number">(0)</span>
					</div>
				</div>
			</div>
		</div>

		<div class="container-navbar">
			<nav class="navbar container">
				<i class="fa-solid fa-bars"></i>
				<ul class="menu">
					<li><a href="<?= site_url('/') ?>">Inicio</a></li>
					<li><a href="<?= site_url('mascotas/informacion') ?>">Mascotas</a></li>
					<?php if (session()->get('isLoggedIn')): ?>
						<!-- Este enlace ahora apunta al formuario para crear una nueva mascota y solo se muestra si el usuario está logueado -->
						<li><a href="<?= site_url('mascotas/nuevo') ?>">Registrar Mascota</a></li>
					<?php endif; ?>
					<li><a href="#">QR</a></li>
					<li><a href="#">Servicios</a></li>
					<li><a href="#">Blog</a></li>
				</ul>
				<?php if (session()->get('isLoggedIn')): ?>
					<a href="<?= site_url('logout') ?>" class="btn btn-danger fw-bold">Cerrar Sesión</a>
				<?php else: ?>
					<a href="<?= site_url('login') ?>" class="btn btn-warning fw-bold">Iniciar Sesión</a>
				<?php endif; ?>
			</nav>
		</div>
	</header>

	<section class="banner">
		<div class="content-banner">
			<p>MOTOTLI</p>
			<h2>¿QUIERES SABER MAS DE NOSOTROS? <br />TENCOLOGIA QR!</h2>
			<a href="#">PULSA AQUI</a>
		</div>
	</section>


	<section class="container top-categories">
		<h1 class="heading-1">MASCOTAS</h1>
		<div class="container-categories">
			<div class="card-category category-moca">
				<p>Perros</p>
				<a href="#">PULSA AQUI</a>
			</div>
			<div class="card-category category-expreso">
				<p>Gatos</p>
				<a href="#">Ver más</a>
			</div>
			<div class="card-category category-capuchino">
				<p>otros</p>
				<span></span>
			</div>
		</div>
	</section>


	<main class="main-content">
		<section class="container container-features">
			<div class="card-feature">
				<i class="fa-solid fa-plane-up"></i>
				<div class="feature-content">
					<span>Desde cualquier parte de Mexico </span>
					<p></p>
				</div>
			</div>
			<div class="card-feature">
				<i class="fa-solid fa-wallet"></i>
				<div class="feature-content">
					<span>METODOS DE PAGO</span>

				</div>
			</div>
			<div class="card-feature">
				<i class="fa-solid fa-gift"></i>
				<div class="feature-content">
					<span>ACTUALIZACIONES DIARIAS</span>

				</div>
			</div>
			<div class="card-feature">
				<i class="fa-solid fa-headset"></i>
				<div class="feature-content">
					<span>Servicio al cliente 24/7</span>
					<p>LLámenos 5612607540</p>
				</div>
			</div>
		</section>

		<footer class="footer">
			<div class="container container-footer">
				<div class="menu-footer">
					<div class="contact-info">
						<p class="title-footer">Información de Contacto</p>
						<ul>
							<li>
								Dirección: Nte. 21-A 5326, Lindavista Vallejo III secc, Gustavo A. Madero, 07750, Ciudad de México, CDMX.
							</li>
							<li>Teléfono: 5512955220</li>

							<li>EmaiL: lacho@anevi.com</li>
						</ul>
						<div class="social-icons">
							<span class="facebook">
								<i class="fa-brands fa-facebook-f"></i>
							</span>
							<span class="twitter">
								<i class="fa-brands fa-twitter"></i>
							</span>
							<span class="youtube">
								<i class="fa-brands fa-youtube"></i>
							</span>
							<span class="pinterest">
								<i class="fa-brands fa-pinterest-p"></i>
							</span>
							<span class="instagram">
								<i class="fa-brands fa-instagram"></i>
							</span>
						</div>
					</div>

					<div class="information">
						<p class="title-footer">Información</p>
						<ul>
							<li><a href="#">Acerca de Nosotros</a></li>

							<li><a href="#">Politicas de Privacidad</a></li>
							<li><a href="#">Términos y condiciones</a></li>
							<li><a href="#">Contactános</a></li>
						</ul>
					</div>

					<div class="my-account">
						<p class="title-footer">Mi cuenta</p>

						<ul>
							<li><a href="#">Mi cuenta</a></li>
							<li><a href="#">Mascotas</a></li>
							<li><a href="#">carnet</a></li>

						</ul>
					</div>

					<div class="newsletter">
						<p class="title-footer">Quejas y sugerencias</p>

						<div class="content">
							<p>
								ingresa tu correo para quejas y sugerencias
							</p>
							<input type="email" placeholder="Ingresa el correo aquí...">
							<button>Enviar</button>
						</div>
					</div>
				</div>

				<div class="copyright">
					<p>
						MOTOTLI &copy; 2025
					</p>

					<img src="<?= base_url('img/payment.png') ?>" alt="Pagos">
				</div>
			</div>
		</footer>
		<!-- JavaScript de Bootstrap (incluye Popper.js) -->
		<script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
		<script src="<?= base_url('js/java.js') ?>"></script>
</body>

</html>