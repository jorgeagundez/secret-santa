<?php 
session_start();

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;


include "includes/header.php";
?>

  <body>
    <div class="container">
      <header>
        <h1>User Subscription</h1>
      </header>
    </div>
    <div class="container">
      <form role="form" id="subscribe_form" method="post" action="controller/subs.php">
        <div class="col-md-5 well">
          <div class="col-md-12">
            <?php if (isset($_GET['error'])){ echo $_GET['error'];}?>
          </div>
          <div class="col-md-12">
            <label for="username">User</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Choose an user name" required="true"/>
          </div>
          <div class="col-md-12">
            <label for="username">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Write here your email" required="true"/>
          </div>
          <div class="col-md-12">
            <label for="username">Repeat Email</label>
            <input type="email" name="rEmail" class="form-control" id="rEmail" placeholder="Write here your email" required="true"/>
          </div>
          <div class="col-md-12">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required="true"/>
          </div>
          <div class="col-md-12">
            <label for="password">Repeat Password</label>
            <input type="password" name="rPassword" class="form-control" id="rPassword" placeholder="Password" required="true"/>
          </div>
          <div class="col-md-2">
            <br>
            <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
            <button type="submit" class="btn btn-default">Join</button>
          </div>
        </div>
      </form>
      <div class="col-md-12 well">
        <a href="/secret_santa/index.php" class="btn btn-default" >Do you have an account already? Login here</a>
      </div>
    </div>

<?php 
include "includes/footer.php";
?>