<?php 
session_start();

if(!isset($_SESSION['user_id'])) {
  header('Location:/secret_santa/index.php?error=' . 'You must be logged in to access dashboard');
  die();
}else if($_SESSION['id_session'] != session_id()) {
  echo 'There was a mistake in the session, please, login again <a href="/secret_santa/controller/logout.php">here</a>';
  die();
}

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;


include "../includes/header.php";
?>

  <body>
    <div class="container">
      <header>
        <h1>Add an Image</h1>
      </header>
    </div>
    <div class="container">
      <div class="col-md-12 well">
        <h3> Update your Profile Image </h3>
        <div class="userImageWrapper">
          <img alt="user image" src="/secret_santa/images/users/<?php echo $_SESSION['user_image'] ?>">
        </div>
         <form role="form" id="image_form" method="post" action="../controller/img.php"  enctype="multipart/form-data">
        <div class="col-md-5 well">
          <div class="col-md-12">
            <label for="image">Image: </label>
            <input type="file" name="image" id="image"/>
          </div>
          <div class="col-md-2">
            <br>
            <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
            <button type="submit" class="btn btn-default">Update</button>
          </div>
          <div class="col-md-12">
            <br>
            <?php if (isset($_GET['error'])){ echo $_GET['error'];}?>
          </div>
        </div>
      </form>
      </div>
      <div class="col-md-12">
        <?php if (isset($_GET['error'])){ echo $_GET['error'];}?>
      </div>
       <div class="col-md-12 well">
        <a href="/secret_santa/userPages/dashboard.php" class="btn btn-default" >Go back to the member page</a>
      </div>
    </div>
   
<?php 
include "../includes/footer.php";
?>