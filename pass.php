<?php 
session_start();

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;

include 'includes/header.php';

?>
			
	<body>

		<header class="pass-page">
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
		</header>
			
		<section class="pass-wrap">
			<form role="form" id="pass" method="post" action="controller/fpass.php" class="pass-form">	
				<div class="pass_header blue">
					<p class="white">Recuperar Contraseña</p>
				</div>
				<div class="input_wrapper">
					<label for="useremail"></label>
					<input type="text" name="useremail" class="form-control" id="useremail" placeholder="Escriba su email" required="true"/>
				</div>
				<div class=" input_wrapper">
					<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
					<button type="submit" class="btn btn-red">Enviar</button>
				</div>
			</form>
		</section>	

		<section class="blue ribbon info-wrap">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center">
						<?php if (isset($_SESSION['info'])) { ?>
						<p class="white">
							<a name="info"></a>
							<?php 
								echo $_SESSION['info']; 
								unset($_SESSION['info']);
							?>
						</p>
						<a type="button" href="index.php" class="btn btn-red">Volver</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>

		
 
<?php include 'includes/footer.php';?>