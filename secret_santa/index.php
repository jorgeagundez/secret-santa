<?php 
include '/includes/header.php';
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
								<a class="navbar-brand" href="#">Amigo Invisible</a>
							</div>
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
								<ul class="nav navbar-nav navbar-right">
									<li><a href="#">Home</a></li>
									<li><a href="#">About</a></li>
								</ul>
							</div><!-- /.navbar-collapse -->
						</div><!-- /.container-fluid -->
					</nav>
				</div><!--/.container-->
			</div><!--/.fullwidth_wraper-->
		</header>

		<section class="banner">
			<div class="container">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
					<!-- 	<li data-target="#carousel-example-generic" data-slide-to="0"></li> -->
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="images/prebanner.jpg" alt="..." class="img-responsive banner_image">
							<div class="carousel-caption">
							<p>Home</p>
							</div>
						</div>
						<div class="item">
							<img src="images/prebanner.jpg" alt="..." class="img-responsive banner_image">
							<div class="carousel-caption">
							<p>Log in</p>
							</div>
						</div>
				</div>
				<!-- Controls -->
				<!-- <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
					<span class="sr-only">Next</span>
				</a> -->
				</div>
			</div> <!-- container -->
		</section>

		<section class="main_body">
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
						<button type="button" class="btn btn-success start_button">Comenzar</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4 well">
						<h4>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo</h4>
						<button type="button" class="btn btn-default  start_button">Log in</button>
					</div>
				</div>
			</div>

		</section>
	    
<?php include 'includes/footer.php';?>