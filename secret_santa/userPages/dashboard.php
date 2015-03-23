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
          <?php 

            echo '<h2>User</h2>';

            echo ( '<strong>Id Admin User</strong>:' . $_SESSION['user_id'] . '<br/>' 
              . '<strong>User Name</strong>: ' . $_SESSION['user_name'] . '<br/>'
              . '<strong>User Email</strong>: ' . $_SESSION['user_email']);

            echo '<br/>';
            echo '<br/>';

            echo '<h2>Game Details</h2>';

            if(isset($_SESSION['game_id'])) {
                echo ('<strong>Game Id</strong>:' . $_SESSION['game_id'] . '<br/>' 
                  . '<strong>Game Title</strong>: ' . $_SESSION['game_title']  . '<br/>' 
                  . '<strong>Description</strong>: ' . $_SESSION['game_description']  . '<br/>' 
                  . '<strong>Price</strong>: ' . $_SESSION['game_price']  . '<br/>' 
                  . '<strong>Place</strong>: ' . $_SESSION['game_place'] . '<br/>' 
                  . '<strong>Game Date</strong>: ' . $_SESSION['game_date'] . '<br/>' 
                  . '<strong>Draw Date</strong>: ' . $_SESSION['game_drawdate'] . '<br/>' 
                  . '<strong>Id Admin User</strong>: ' . $_SESSION['game_user_id'] . '<br/>' 
                  . '<strong>Num of Friends</strong>: ' . $_SESSION['numberfriends']);
            }

            echo '<br/>';
            echo '<br/>';

            echo '<h2>Friends List</h2>';


            if(isset($_SESSION['friendname1'])){
              for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) {
                  echo '<strong>Name</strong>: ' . $_SESSION['friendname' . $i] . ' <strong>Email</strong>: ' . $_SESSION['friendemail' . $i] . '<br/>';
              }
            }

          ?>
         
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