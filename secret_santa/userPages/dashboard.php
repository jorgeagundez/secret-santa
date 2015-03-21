<?php 

session_start();

if(!isset($_SESSION['user_id'])) {
   header('Location:/secret_santa/index.php?error=' . 'You must be logged in to access dashboard');
   die();
}

$_SESSION['id_session'] = session_id();

include "../includes/header.php";
?>

  <body>
    <div class="container">
      <header>
        <h1>Welcome <?php echo $_SESSION['user_name'] ?></h1>
      </header>
    </div>
    <div class="container">
      <div class="col-md-12 well">
        <div class="userImageWrapper">
          <img alt="user image" class="pull-right" src="/secret_santa/images/users/<?php echo $_SESSION['user_image'] ?>">
        </div>
        <div class="detailsWrapper">
         
        </div>
      </div>
      <div class="col-md-12">
         <?php if (isset($_GET['error'])){ echo $_GET['error'];}?>
         <?php if (isset($_GET['info'])){ echo $_GET['info'];}?>
      </div>
       <div class="col-md-12 well">
        <a href="/secret_santa/userPages/updateImage.php" class="btn btn-default" >Update your profile image</a>
      </div>
      <div class="col-md-12 well">
        <a href="/secret_santa/userPages/update.php" class="btn btn-default" >Update your Details</a>
      </div>
      <div class="col-md-12 well">
        <a href="/secret_santa/controller/delete.php" class="btn btn-default" >Delete your account</a>
      </div>
      <div class="col-md-12 well">
        <a href="/secret_santa/controller/logout.php" class="btn btn-default" >Logout</a>
      </div>
    </div>
   
<?php 
  include "../includes/footer.php";
?>