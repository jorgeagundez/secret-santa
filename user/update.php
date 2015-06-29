<?php 
session_start();

if(!isset($_SESSION['user_id'])) {
  $_SESSION['error'] = 'You must be logged in to visit this page';
  header('Location:/index.php');
}else if($_SESSION['id_session'] != session_id()) {
  $_SESSION['error'] = 'There was a mistake in the session, please, login again';
  header('Location:/index.php');;
}

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;


include "../includes/header.php";
?>

  <body>
    <div class="container">
      <header>
        <h1>Update your details</h1>
      </header>
    </div>
    <div class="container">
      <div class="col-md-12 well">
        <h3>Your details: </h3></br>
        <?php 
          echo 'Username :<strong> ' . $_SESSION['user_name'] . '</strong>';          
          echo '<br><br>';
          echo 'Email  :<strong> ' . $_SESSION['user_email'] . '</strong>';
          echo '<br><br>';
        ?>
      </div>
      <form role="form" id="update_form" method="post" action="../controller/upd.php">
        <div class="col-md-5 well">
          <div class="col-md-12">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Write here your email" required="true"/>
          </div>
          <div class="col-md-12">
            <label for="rEmail">Repeat Email</label>
            <input type="email" name="rEmail" class="form-control" id="rEmail" placeholder="Write here your email" required="true"/>
          </div>
          <div class="col-md-12">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Escriba la clave" required="true"/>
          </div>
          <div class="col-md-12">
            <label for="password">Repeat Password</label>
            <input type="password" name="rPassword" class="form-control" id="rPassword" placeholder="Escriba la clave" required="true"/>
          </div>
          <div class="col-md-2">
            <br>
            <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
            <button type="submit" class="btn btn-default">Update</button>
          </div>
          <div class="col-md-12">
              <?php if (isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);}?>
          </div>
        </div>
      </form>
      <div class="col-md-12 well">
        <a href="/user/dashboard.php" class="btn btn-default" >Go back to the member page</a>
      </div>
    </div>

<?php 
include "../includes/footer.php";
?>