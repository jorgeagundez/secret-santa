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
					<nav class="navbar navbar-default main_nav" role="navigation">
						<div class="container-fluid">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<a class="navbar-brand" href="#">Secret Santa</a>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<form role="form" id="login_form" method="post" action="controller/login.php">
									<ul class="nav navbar-nav navbar-right">
										<li><a href="#">Home</a></li>
										<li><a href="#">About</a></li>
										<li>
											<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Login</a>
											<ul class="collapse" id="collapseExample">
												<li>
													<label for="username">User</label>
													<input type="text" name="username" class="form-control" id="username" placeholder="Write here your username" required="true"/>
												</li>
									            <li>
									            	<label for="password">Password</label>
									            	<input type="password" name="password" class="form-control" id="password" placeholder="Write here your password" required="true"/></li>
									            <li class="divider"></li>
									            <li>
									            	<input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
									            	<button type="submit" class="btn btn-default">Login</button>
									            </li>
											</ul>	
										</li>
									</ul>
								</form>
							</div><!-- /.navbar-collapse -->
						</div><!-- /.container-fluid -->
					</nav>
				</div><!--/.container-->
			</div><!--/.fullwidth_wraper-->
		</header>

		<section class="container">
			<div class="banner">
				<div class="row">
					<div class="col-md-12">
						<img src="/secret_santa/images/prebanner1.jpg" alt="banner" />
					</div>
				</div>
			</div> <!-- container -->
		</section>

		<div class="well">
			<?php if (isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);}?>
		</div>

		<section class="main_body" id="aqui">
			<div class="container">
				<div class="row">
					<div class="col-md-4 step_wrapper">
						<img class="step" src="images/prestep.jpg"/>
						<h2>Step 1</h2>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et</p>
					</div>
					<div class="col-md-4 step_wrapper">
						<img class="step" src="images/prestep.jpg"/>
						<h2>Step 2</h2>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et</p>
					</div>
					<div class="col-md-4 step_wrapper">
						<img class="step" src="images/prestep.jpg"/>
						<h2>Step 3</h2>
						<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3 well">
						<a href="/secret_santa/stepOne.php" type="button" class="btn btn-success start_button">Get Start</a>
					</div>
				</div>
			</div>

		</section>
	    
<?php include 'includes/footer.php';?>