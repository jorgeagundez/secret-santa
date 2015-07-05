<?php 
session_start();

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;

include 'includes/header.php';
$template = 'frontpage';

?>
			
	<body class="<?php echo $template ?>">

		<header>
			<div class="yellow">
				<div class="fullwidth_wraper white">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<nav class="main_nav" role="navigation">
									<a class="top_bar" href="/">Secret <span class="red">Santa</span></a>
									<a class="top_bar pull-right" href="#"><small>About</small></a>
								</nav>
							</div>
						</div>	
					</div><!--/.container-->
				</div><!--/.fullwidth_wraper-->
			
				<section class="logo_wrap">
					<div class="container">
						<div class="row">
							<div class="col-xs-12">
								<div class="logo">
									<h1><span class="blue">Organiza tu propio amigo invisible en</span><br/><span class="red">60</span><span class="white">segundos!</span></h1>	
								</div>
							</div>
						</div>
					</div>
				</section>

				<section class="login_wrap">
					<div class="container">
						<div class="row">	
							<div class="col-xs-12 col-md-4 col-md-offset-4">
								<form role="form" id="login_form" method="post" action="controller/login.php" class="login">
									<div class="login_header">
										<h3>Login</h3>
									</div>
									<div class="row">
										<div class="col-xs-10 col-xs-offset-1 input_wrapper">
											<label for="useremail">Usuario</label>
											<input type="text" name="useremail" class="form-control" id="useremail" placeholder="email" required="true"/>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-10 col-xs-offset-1 input_wrapper">
							            	<label for="password">Password</label>
							            	<input type="password" name="password" class="form-control" id="password" placeholder="password" required="true"/></li>
							            	<a class="" href="pass.php">Olvidé mi contraseña</a>
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
				    <div><!-- /container -->
				</section>
			</div>
		</header>

		
		<?php if (isset($_SESSION['error'])){ 
			echo '<div class="message-error">';
			echo '<span>Error:</span></br>';
			echo '<p>' . $_SESSION['error'] . '</p>'; 
			unset($_SESSION['error']);}
			echo '</div>';
		?>
	

		<section class="blue ribbon">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<a href="#start" class="figure arrow"></a>
					</div>
				</div>
			</div>
		</section>

		<section id="start" class="info_area sky">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-4 col-md-offset-4">
						<div class="figure present"></div>
						<h2 class="white"> ¿Cómo funciona?</h2>
						<p class="blue">Simple, tan sólo tienes que seguir los tres siguientes sencillos pasos y tendrás acceso a tu propio panel de control</p>
					</div>
				</div>
			</div>
		</section>

		<section class="steps">
			<div class="container">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-0">
						<div class="step_wrap">
							<div class="figure pluma"></div>
							<h2>Paso 1</h2>
							<p class="bold">Rellena tus datos</p>
							<p>Tan sólo usando tu dirección de email, elige un usuario y contraseña para comenzar</p>
						</div>
					</div>
					<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-0">
						<div class="step_wrap">
							<div class="figure puzzle"></div>
							<h2>Paso 2</h2>
							<p class="bold">Reglas del Juego</p>
							<p>Establece las normas de tu grupo, temática, margen de precio, lugar de encuentro y todo lo que quieras!</p>
						</div>
					</div>
					<div class="col-xs-10 col-xs-offset-1 col-md-4 col-md-offset-0">
						<div class="step_wrap">
							<div class="figure ninos"></div>
							<h2>Paso 3</h2>
							<p class="bold">Invita a tus amigos</p>
							<p>Hazte con el correo electrónico de tus amigos y tan pronto todos acepten su invitación el sorteo de nombres llegará por email</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-xs-offset-3">
						<a href="/stepOne.php" type="button" class="btn btn-red">Comenzar</a>
					</div>
				</div>
			</div>
		</section>
 
<?php include 'includes/footer.php';?>