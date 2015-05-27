<?php 
session_start();

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;

include 'includes/header.php';
$template = 'frontpage';

?>
			
	<body class="<?php echo $template ?>">

		<header>
			<div class="fullwidth_wraper">
				<div class="container">
					<nav class="main_nav" role="navigation">
						<a class="navbar-brand" href="#">Secret <span>Santa</span></a>
						<a class="navbar-brand pull-right" href="#"><small>About</small></a>
					</nav>
				</div><!--/.container-->
			</div><!--/.fullwidth_wraper-->
		
			<section class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="logo">
							<h1>Organiza tu propio amigo invisible en <br/><span class="red">60</span><span class="white">segundos!</span></h1>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<form role="form" id="login_form" method="post" action="controller/login.php" class="login">
							<div class="login_header">
								<h3>Login</h3>
							</div>
							<div class="row">
								<div class="col-xs-10 col-xs-offset-1 input_wrapper">
									<label for="username">Usuario</label>
									<input type="text" name="username" class="form-control" id="username" placeholder="username" required="true"/>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-10 col-xs-offset-1 input_wrapper">
					            	<label for="password">Password</label>
					            	<input type="password" name="password" class="form-control" id="password" placeholder="password" required="true"/></li>
			         			</div>
			         		</div>
			         		<div class="row">
			         			<div class="col-xs-10 col-xs-offset-1 input_wrapper">
					            	<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
					            	<button type="submit" class="btn btn-red">Go!</button>
					            </div>
							</div>
						</form>
			        </div>
		        </div>
			</section><!-- /container -->
		</header>

		<div class="">
			<?php if (isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);}?>
		</div>

		<section class="arrow">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<a href="#start" class="icon"></a>
					</div>
				</div>
			</div>
		</section>

		<section id="start" class="info">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="icon"></div>
						<h2>¿Cómo funciona?</h2>
						<p>Es muy sencillo, tan sólo tienes que seguir los tres siguientes sencillos pasos y tendrás acceso a tu panel de control para hacer un seguimiento y actualizar el juego siempre que quieras</p>
					</div>
				</div>
			</div>
		</section>

		<section class="steps">
			<div class="container">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<div class="step_wrap">
							<div class="step step_one"></div>
							<h2>Paso 1</h2>
							<p class="bold">Rellena tus datos</p>
							<p>Tan sólo usando tu dirección de email, elige un usuario y contraseña para comenzar</p>
						</div>
					</div>
					<div class="col-xs-10 col-xs-offset-1">
						<div class="step_wrap">
							<div class="step step_two"></div>
							<h2>Paso 2</h2>
							<p class="bold">Reglas del Juego</p>
							<p>Establece las normas de tu grupo, temática, margen de precio, lugar de encuentro y todo lo que quieras!</p>
						</div>
					</div>
					<div class="col-xs-10 col-xs-offset-1">
						<div class="step_wrap">
							<div class="step step_three"></div>
							<h2>Paso 3</h2>
							<p class="bold">Invita a tus amigos</p>
							<p>Hazte con el correo electrónico de tus amigos y tan pronto todos acepten su invitación el sorteo de nombres llegará por email</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3">
						<a href="/secret_santa/stepOne.php" type="button" class="btn btn-success btn-red">Get Start</a>
					</div>
				</div>
			</div>
		</section>

		<script>
			$(function() {
				$('a[href*=#]:not([href=#])').click(function() {
					if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
						var target = $(this.hash);
						target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
						if (target.length) {
							$('html,body').animate({
							scrollTop: target.offset().top
							}, 1000);
							return false;
						}
					}
				});
			});

		</script>
 
<?php include 'includes/footer.php';?>